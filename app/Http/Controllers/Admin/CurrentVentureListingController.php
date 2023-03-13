<?php
/**
 * Created by PhpStorm.
 * User: Transdata
 * Date: 4/8/2020
 * Time: 2:29 PM
 */

namespace App\Http\Controllers\Admin;

use App\Exports\ExportClosedListingReport;
use App\Http\Requests\VentureList;
use App\Http\Requests\VentureListFileRequest;
use App\Http\Requests\VentureListImageRequest;
use App\Models\BuyNow;
use App\Models\Log;
use App\Models\Media;
use App\Models\Offer;
use App\Models\SellingOwnershipVentureListing;
use App\Models\Type;
use App\Models\User;
use App\Models\Venture;
use App\Models\VentureListing;
use App\Models\UserVentureListing;
use App\Models\VentureOwnership;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\VentureRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Helpers\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use jeremykenedy\LaravelRoles\Models\Role;

class CurrentVentureListingController
{
    protected $repository;

    public function __construct(VentureRepository $repository)
    {
        $this->ventureRepository = $repository;

    }

    /* =========================================================================================
    Description: Method for Current Venture Listing
    ----------------------------------------------------------------------------------------
    ========================================================================================== */

    public function index()
    {
        $ventures = $this->ventureRepository->latest()->get();

        $users = Role::where('name', 'User')->first()->users()->latest()->take('5')->get();

        $currentVentureListing = VentureListing::where('type', '=', 'CURRENT')->
        orderByRaw("FIELD(list_status,'Pending', 'Live',  'Inactive') ASC")
        ->paginate($limit = 4, $columns = ['*']);
        $listingTypes = Type::where('type', 'Listing')->get();
        return view('admin.layouts.pages.currentVentures.index', compact('ventures', 'currentVentureListing','listingTypes', 'users'));

    }

    public function createListingSelectUser()
    {
        $ventures = $this->ventureRepository->latest()->paginate(5);

        return view('admin.layouts.pages.currentVentures.createListingSelectUser', compact('ventures'));
    }

    /* =========================================================================================
    Description: Method for Current Venture Listing Create
    ----------------------------------------------------------------------------------------
    ========================================================================================== */

    public function currentVentureListCreate($venture_id, $id)
    {
        $venture = $this->ventureRepository->where('venture_automated_id', $venture_id)->first();
        $currentVentureList = VentureListing::where('list_automated_id', $id)->first();
        if (is_null($venture) || is_null($currentVentureList)) {
            abort('404');
        }
        $listingTypes = Type::where('type', 'Listing')->get();
        $documentTypes = Type::where('type', 'Document')->get();
        return view('admin.layouts.pages.currentVentures.create', compact('venture', 'listingTypes', 'currentVentureList', 'documentTypes'));
    }

    /* =========================================================================================
         Description: Method for Save Current Venture Listing After select venture from popup
    ----------------------------------------------------------------------------------------
    ========================================================================================== */

    public function store(Request $request)
    {
        try{
            $input = $request->except('user_id');
            // Creating Unique ID of Venture
            $input['list_automated_id'] = 'L' . sprintf('%06d', (VentureListing::withTrashed()->count() + 1));
            $input['status'] = Config::get('constants.VENTURE_LISTING_STATUS')[0];
            $input['type'] = Config::get('constants.CURRENT_VENTURE_LISTING');

            //create venture List with venture id
            $venture_detail = VentureListing::create($input);

            if (!is_null($venture_detail->venture)) {
            }

            //Associate user with listing and venture
            $venture_detail->users()->attach($request->get('user_id'), [
                'venture_id' => $venture_detail->venture->id,
                'venture_listing_id' => $venture_detail->id,
            ]);

            return response()->json(
                [
                    'status' => true,
                    'message' => 'Your venture detail created against selected Venture',
                    'url' => url('/').'/admin/current-venture-listing/' . $venture_detail->venture->venture_automated_id . '/venture-detail/' . $venture_detail->list_automated_id . '/create'], 200);

        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


    /* =========================================================================================
    Description: Store Method for Current Venture Listing Create Form
    ----------------------------------------------------------------------------------------
    ========================================================================================== */

    public function updateCurrentVentureForm(VentureList $request, $id)
    {
        try{
            $currentVentureList = VentureListing::find($id);
            $user = Auth::user();
            
            $featureListing = isset($request->feature) ? 1 : 0;
            if (!is_null($currentVentureList)) {
                $currentVentureList->update([
                    'description' => $request->description,
                    'list_status' => $request->listing_status,
                    'asking_price' => $request->asking_price,
                    'percentage_of_ownership' => $request->percentage_of_ownership,
                    'feature' => $featureListing
                ]);
            }
            // Save images in Medias

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = Config::get('constants.ventureMediaPath');
                    $fileName = Helper::saveImage($image, $maxWidth = null, $path, $callback = null);
                    if ($fileName) {
                        $currentVentureList->medias()->create([
                            'file_name' => $fileName,
                            'type' => Config::get('constants.mediaImageType'),
                            'user_id' => $user->id,
                            'visibility' => 'Visible',
                        ]);
                    }
                }
            }

            // Adding Document Against Ventures
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = Config::get('constants.ventureMediaPath');
                $fileName = Helper::saveFile($file, $path);
                if ($fileName) {
                    $currentVentureList->medias()->create([
                        'title' => $request->get('documentName'),
                        'file_name' => $fileName,
                        'type' => Config::get('constants.mediaDocumentType'),
                        'user_id' => $user->id,
                        'visibility' => 'Visible',
                        'date_of_document_to_apply' => $request->get('date_of_document') ? Carbon::createFromFormat("d/m/Y", $request->get('date_of_document'))->format('Y-m-d H:i:s') : null,
                    ]);
                }
            }
            // Save Ventures Creation Log
            $log = Log::create([
                'title' => 'Current Venture listing Created!',
                'description' => "Current Venture listing #.$currentVentureList->id Created By ".$user->name. " UserID#". $user->id
            ]);
            $currentVentureList->logs()->save($log);
            return response()->json([
                'status' => true,
                'message' => 'Current Venture List Updated successfully!',
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


    /* =========================================================================================
    Description:  Method for edit Form Current Venture Listing
    ----------------------------------------------------------------------------------------
    ========================================================================================== */

    public function currentVentureListEdit($venture_id, $id)
    {
        $venture = $this->ventureRepository->find($venture_id);        
        $currentVentureList = VentureListing::find($id);
        $listingTypes = Type::where('type', 'Listing')->get();
        $documentTypes = Type::where('type', 'Document')->get();
        $propertySummaries = $venture->medias()->where('document_type_id',19)->get();
        
        return view('admin.layouts.pages.currentVentures.edit', compact('venture', 'listingTypes', 'currentVentureList', 'documentTypes', 'propertySummaries'));

    }

    /* =========================================================================================
   Description:  Update Method for edit Form Current Venture Listing
   ----------------------------------------------------------------------------------------
   ========================================================================================== */

   public function update(Request $request, $id)
   {        
    $useMarker = '';
    if(isset($request->useMarker))
    {
        $useMarker = 1;
    }else{
        $useMarker = 0;
    }

    try {
        $currentVentureList = VentureListing::find($id);
        $featureListing = isset($request->feature_listing) ? 1 : 0;            
        $currentVentureList->update([
            'description' => $request->description,
            'list_status' => $request->listing_status,
            'longitude' => $request->get('longitude'),
            'latitude' => $request->get('latitude'),
            'asking_price' => $request->asking_price,
            'percentage_of_ownership' => $request->percentage_of_ownership,
            'feature' => $featureListing,
            'useMarker' => $useMarker
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Current Venture List Updated successfully!',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ]);
    }
}

    /* =========================================================================================
   Description:  Upload Method for edit Form Current Venture Listing
   ----------------------------------------------------------------------------------------
   ========================================================================================== */

   public function uploadImages(VentureListImageRequest $request)
   {
    try {
        $user = Auth::user();
        $currentVentureList = VentureListing::find($request->get('id'));
            // Adding Medias Against Ventures
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = Config::get('constants.ventureMediaPath');
                $fileName = Helper::saveImage($image, $maxWidth = null, $path, $callback = null);
                if ($fileName) {
                    $currentVentureList->medias()->create([
                        'file_name' => $fileName,
                        'type' => Config::get('constants.mediaImageType'),
                        'user_id' => $user->id,
                        'visibility' => 'Visible',
                    ]);
                }
            }
        }

        $data = view('admin.layouts.pages.currentVentures.partials.imagesSection', compact('currentVentureList'))->render();

        return response()->json([
            'status' => true,
            'message' => 'Image successfully uploaded!',
            'data' => $data
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ]);
    }
}

    /* =========================================================================================
   Description:  uploadDocument Method for edit Form Current Venture Listing
   ----------------------------------------------------------------------------------------
   ========================================================================================== */

   public function uploadDocument(VentureListFileRequest $request)
   {
    try {

        $user = Auth::user();
        $currentVentureList = VentureListing::find($request->get('id'));

            // Adding Document Against Ventures
        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $path = Config::get('constants.ventureMediaPath');
            $fileName = Helper::saveFile($file, $path);
                //if document is added
            if ($fileName) {
                $currentVentureList->medias()->create([
                    'title' => $request->get('documentName'),
                    'file_name' => $fileName,
                    'user_id' => $user->id,
                    'visibility' => 'Visible',
                    'date_of_document_to_apply' => $request->get('date_of_document') ? Carbon::createFromFormat("d/m/Y", $request->get('date_of_document'))->format('Y-m-d H:i:s') : null,
                ]);
            }
        }

        $documentTypes = Type::where('type', 'Document')->get();
        $data = view('admin.layouts.pages.currentVentures.partials.documentTab', compact('currentVentureList', 'documentTypes'))->render();

        return response()->json([
            'status' => true,
            'message' => 'Document successfully uploaded!',
            'data' => $data
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ]);
    }
}

    /* =========================================================================================
     Description:  Search Current Venture List Method for Current Venture Listing Index
     ----------------------------------------------------------------------------------------
     ========================================================================================== */

     public function searchCurrentVenture(Request $request)
     {
        $currentVentureListing = Helper::ventureListAdminSearch($request->all(),$type='CURRENT');
        $view = (string)view('admin.layouts.pages.currentVentures.partials.table_row', compact('currentVentureListing'));

        return response()->json([
            'view' => $view,
            'status' => true,
            'message' => 'Current Venture Data successfully Updated!',
        ]);
    }

    /* =========================================================================================
 Description:  Delte Method for Current Venture Listing
 ----------------------------------------------------------------------------------------
 ========================================================================================== */

 public function destroy($id)
 {
    try {
        $ventureList = VentureListing::find($id);
        if (!is_null($ventureList)) {
            $ventureList->delete();
        }
        return response()->json([
            'status' => true,
            'message' => 'Current Venture successfully Deleted!',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' =>$e->getMessage(),

        ]);
    }
}

    /* =========================================================================================
   Description:  Search  Method for Ventures on Current Venture Listing popup
   ----------------------------------------------------------------------------------------
   ========================================================================================== */

   public function searchVenture(Request $request)
   {
    $ventures = Helper::ventureSearch($request->all());
    $view = (string)view('admin.layouts.pages.currentVentures.partials.popupSearchTableRow', compact('ventures'));

    return response()->json([
        'view' => $view,
        'status' => true,
        'message' => Message::DATA_UPDATED_SUCCESS,

    ]);
}
    /* =========================================================================================
Description:  Search  Method for Ventures on Current Venture Listing popup
----------------------------------------------------------------------------------------
========================================================================================== */

public function searchUser(Request $request)
{
    try {
        $venture_id = $request->get('venture_id');

        if(isset($venture_id))
        {
            $user_id = $request->get('user_id');
            $username = $request->get('username');

            $venture = Venture::findorfail($venture_id);

            $userVentureListing = UserVentureListing::where('venture_id',$venture_id)
            ->pluck('user_id');
            $owners = VentureOwnership::where('venture_id',$venture_id)
            ->whereNotIn('user_id',$userVentureListing)
            ->where('isDeleted',0)
            ->pluck('user_id');
            $users = User::whereIn('id',$owners);

            if(!is_null($user_id))
                $users = $users->where('member_automated_id', 'like', '%' . $user_id . '%');

            if(!is_null($username))
                $users = $users->where('name', 'like', '%' . $username . '%');


            $users = $users->latest()->paginate(5);

            $view = (string)view('admin.layouts.pages.currentVentures.partials.popupUserSearchTableRow', compact('users'));

            return response()->json([
                'view' => $view,
                'status' => true,
                'message' => Message::DATA_UPDATED_SUCCESS,

            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'view' => '',
                'message' => Message::SELECT_VENTURE_FIRST
            ]);
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'view' => '',
            'message' => Message::SOMETHING_WENT_WRONG
        ]);
    }
}

    /* =========================================================================================
     Description:  Delete Method for Media Delete on edit Current Venture Listing
     ----------------------------------------------------------------------------------------
     ========================================================================================== */

     public function mediaStatusDelete(Request $request)
     {
        try {
            $media = Media::find($request->get('mediaID'));

            if (is_null($media)) {
                return response()->json([
                    'status' => false,
                    'message' => 'File not found!'
                ]);
            }

            $media->delete();

            return response()->json([
                'status' => true,
                'message' => 'File deleted successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wring, While file deleting!'
            ]);
        }
    }


    /* =========================================================================================
   Description: Method for User Venture Listing Buy Now
   ----------------------------------------------------------------------------------------
   ========================================================================================== */

   public function buyNow(){

    try{
        $buyNow =BuyNow::paginate($limit = 10, $columns = ['*']);
        return view('admin.layouts.pages.currentVentures.buyNow',compact('buyNow'));
    }catch (\Exception $e) {
        return back();
    }
}


    /* =========================================================================================
 Description:  Delte Method for Current Venture Listing
 ----------------------------------------------------------------------------------------
 ========================================================================================== */

 public function deleteBuyNowRequests($id)
 {
    try {
        $buyNow = BuyNow::find($id);
        if (!is_null($buyNow)) {
            $buyNow->delete();
            toastr()->info('Buy Now Request Successfully deleted');
        }else{
            toastr()->error('Request not found!');
        }

        return back();
    } catch (\Exception $e) {
        dd($e);
        toastr()->error('Something went wrong!');
        return back();
    }
}
    /* =========================================================================================
   Description: Method for User Venture Listing offers
   ----------------------------------------------------------------------------------------
   ========================================================================================== */

   public function offers(){
    try{
        $offers = Offer::paginate($limit = 10, $columns = ['*']);
        return view('admin.layouts.pages.currentVentures.offer',compact('offers'));
    }catch (\Exception $e) {
        return back();
    }
}

     /* =========================================================================================
    Description: Delete Offer By Admin
    ----------------------------------------------------------------------------------------
    ========================================================================================== */
    public function deleteVentureOffer(Request $request)
    {
        try {
            $offerRequest = Offer::where('id', $request->get('offer_id'))->first();

            if (is_null($offerRequest)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Offer request not found!'
                ]);
            }

            $offerRequest->delete();
            return response()->json([
                'status' => true,
                'message' => 'Offer removed successfully.',
            ]);

        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    /* =========================================================================================
  Description: Method for User Venture Listing Buy now Status
  ----------------------------------------------------------------------------------------
  ========================================================================================== */

  public function status(Request $request){
    try {
        if ($request->get('page') == 'buyNow') {
            $buyNow = BuyNow::findorfail($request->get('id'));
            if(!is_null($buyNow)) {
                $buyNow->update([
                    'status' => $request->get('status')
                ]);

                $venture = $buyNow->venture_listing;
                $buyerUser = $buyNow->user;
                $sellerUser = $venture->users()->first();


                if($request->status=="Closing")
                {
                    $subject = "The transaction is in closing status.";
                    $emailJob = (new \App\Jobs\SendVentureListingEmails($buyerUser, $subject, 'email.current_ventures.buy_now.StatusClosingEmail', $venture))->delay(Carbon::now()->addSecond(5));
                    dispatch($emailJob);
                    $emailJob = (new \App\Jobs\SendVentureListingEmails($sellerUser, $subject, 'email.current_ventures.buy_now.StatusClosingEmail', $venture))->delay(Carbon::now()->addSecond(5));
                    dispatch($emailJob);
                }
                else
                {
                    $emailOwnershipPercentage = Helper::percentageOwnershipForSell($venture->ownership_id,$venture->percentage_of_ownership);

                    $oldVentureOwnership = VentureOwnership::where('id',$venture->ownership_id)
                    ->first();
                    $oldSequenceS = (int)$oldVentureOwnership->ownership_sequence_start;
                    $oldSequenceE = (int)$oldVentureOwnership->ownership_sequence_end;

                    $percentageOfOwnership = $venture->percentage_of_ownership/100;
                    $oldMemberTotalShares  = $oldSequenceE - $oldSequenceS + 1;

                    $newMemberTotalShare  = round($oldMemberTotalShares*$percentageOfOwnership);

                    $newMemberSequenceS = $oldSequenceS;
                    $newMemberSequenceE = $oldSequenceS + $newMemberTotalShare - 1;

                    $oldMemberSequenceS = $newMemberSequenceE + 1;
                    $oldMemberSequenceE = $oldSequenceE;

                    $oldVentureOwnership->update([
                        "isDeleted" => 1,
                        "deleted_at" => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);

                    if($newMemberSequenceE<$oldSequenceE)
                    {
                        $oldVentureOwnership = VentureOwnership::create([
                            "ownership_sequence_start" => Helper::leftZeroPadding($oldMemberSequenceS),
                            "ownership_sequence_end" => Helper::leftZeroPadding($oldMemberSequenceE),
                            "user_id" => $oldVentureOwnership->user_id,
                            "venture_id" => $oldVentureOwnership->venture_id,
                            "amount_paid"=>$oldVentureOwnership->amount_paid-round($oldVentureOwnership->amount_paid*$percentageOfOwnership),
                            "amount_sold"=>$oldVentureOwnership->amount_sold,
                            "ownership_begin_date"=>$oldVentureOwnership->ownership_begin_date,
                            "ownership_end_date"=>$oldVentureOwnership->ownership_end_date
                        ]);
                    }
                        // if($venture->percentage_of_ownership!=100)
                        // {
                        //     $oldVentureOwnership->update([
                        //                             "ownership_sequence_start" => Helper::leftZeroPadding($oldMemberSequenceS),
                        //                             "ownership_sequence_end" => Helper::leftZeroPadding($oldMemberSequenceE),
                        //                         ]);
                        // }
                        // else
                        // {
                        //     $oldVentureOwnership->delete();
                        // }

                    $newVentureOwnership = VentureOwnership::create([
                        "ownership_sequence_start" => Helper::leftZeroPadding($newMemberSequenceS),
                        "ownership_sequence_end" => Helper::leftZeroPadding($newMemberSequenceE),
                        "user_id" => $buyerUser->id,
                        "venture_id" => $venture->venture_id,
                        "amount_paid"=>$venture->asking_price,
                        "amount_sold"=>0,
                        "ownership_begin_date"=>Carbon::now()->format('m/d/Y'),
                        "ownership_end_date"=>null
                    ]);

                    $venture->update([
                        "status"=>"Sold"
                    ]);


                    $subject = "Congratulations! Your transaction is complete.";
                    $emailJob = (new \App\Jobs\SendVentureListingEmails($buyerUser, $subject, 'email.current_ventures.buy_now.StatusClosedEmailBuyer', $venture, null, $emailOwnershipPercentage))->delay(Carbon::now()->addSecond(5));
                    dispatch($emailJob);
                    $emailJob = (new \App\Jobs\SendVentureListingEmails($sellerUser, $subject, 'email.current_ventures.buy_now.StatusClosedEmailSeller', $venture))->delay(Carbon::now()->addSecond(5));
                    dispatch($emailJob);
                }

                return response()->json(['status' => true, 'message' => 'Buy Now Updated with Status ' . $buyNow->status . '!!']);
            }
        }elseif($request->get('page') == 'offer'){
            $offer = Offer::findorfail($request->get('id'));
            if(!is_null($offer)) {
                $offer->update([
                    'status' => $request->get('status')
                ]);

                $venture = $offer->venture_listing;
                $buyerUser = $offer->user;
                $sellerUser = $venture->users()->first();

                if($request->status=="Closing")
                {
                    $subject = "The transaction is in closing status.";
                    $emailJob = (new \App\Jobs\SendVentureListingEmails($buyerUser, $subject, 'email.current_ventures.offers.StatusClosingEmail', $venture))->delay(Carbon::now()->addSecond(5));
                    dispatch($emailJob);
                    $emailJob = (new \App\Jobs\SendVentureListingEmails($sellerUser, $subject, 'email.current_ventures.offers.StatusClosingEmail', $venture))->delay(Carbon::now()->addSecond(5));
                    dispatch($emailJob);
                }
                else
                {

                    $emailOwnershipPercentage = Helper::percentageOwnershipForSell($venture->ownership_id,($venture->percentage_of_ownership*($offer->seller_ownership/100)));

                    $oldOwnerOrignalOwnership = Helper::percentageOwnershipForSell($venture->ownership_id,100);

                    $oldMemberActualPercentageForSell = $venture->percentage_of_ownership * ($offer->seller_ownership/100);
                    $oldOwnerNewOwnership = 100 - $oldMemberActualPercentageForSell;

                    $oldVentureOwnership = VentureOwnership::where('id',$venture->ownership_id)
                    ->first();

                    $oldSequenceS = (int)$oldVentureOwnership->ownership_sequence_start;
                    $oldSequenceE = (int)$oldVentureOwnership->ownership_sequence_end;

                    $percentageOfOwnership = $venture->percentage_of_ownership/100;
                    $oldMemberTotalShares  = $oldSequenceE - $oldSequenceS + 1;

                    $newMemberTotalShare  = round(10000*($emailOwnershipPercentage/100));

                    $newMemberSequenceS = $oldSequenceS;
                    $newMemberSequenceE = $oldSequenceS + $newMemberTotalShare - 1;

                    $oldMemberSequenceS = $newMemberSequenceE + 1;
                    $oldMemberSequenceE = $oldSequenceE;

                    $oldVentureOwnership->update([
                        "isDeleted" => 1,
                        "deleted_at" => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);

                    if($newMemberSequenceE<$oldSequenceE)
                    {
                        $oldVentureOwnership = VentureOwnership::create([
                            "ownership_sequence_start" => Helper::leftZeroPadding($oldMemberSequenceS),
                            "ownership_sequence_end" => Helper::leftZeroPadding($oldMemberSequenceE),
                            "user_id" => $oldVentureOwnership->user_id,
                            "venture_id" => $oldVentureOwnership->venture_id,
                            "amount_paid"=>$oldVentureOwnership->amount_paid*($oldOwnerNewOwnership/100),
                            // "amount_paid"=>$oldVentureOwnership->amount_paid-round($oldVentureOwnership->amount_paid*$percentageOfOwnership),
                            "amount_sold"=>$oldVentureOwnership->amount_sold,
                            "ownership_begin_date"=>$oldVentureOwnership->ownership_begin_date,
                            "ownership_end_date"=>$oldVentureOwnership->ownership_end_date
                        ]);
                    }
                        // if($venture->percentage_of_ownership!=100)
                        // {
                        //     $oldVentureOwnership->update([
                        //                             "ownership_sequence_start" => Helper::leftZeroPadding($oldMemberSequenceS),
                        //                             "ownership_sequence_end" => Helper::leftZeroPadding($oldMemberSequenceE),
                        //                         ]);
                        // }
                        // else
                        // {
                        //     $oldVentureOwnership->delete();
                        // }

                    $newVentureOwnership = VentureOwnership::create([
                        "ownership_sequence_start" => Helper::leftZeroPadding($newMemberSequenceS),
                        "ownership_sequence_end" => Helper::leftZeroPadding($newMemberSequenceE),
                        "user_id" => $buyerUser->id,
                        "venture_id" => $venture->venture_id,
                        "amount_paid"=>$offer->amount,
                        "amount_sold"=>0,
                        "ownership_begin_date"=>Carbon::now()->format('m/d/Y'),
                        "ownership_end_date"=>null
                    ]);

                    $venture->update([
                        "status"=>"Sold"
                    ]);

                    $subject = "Congratulations! Your transaction is complete.";
                    $emailJob = (new \App\Jobs\SendVentureListingEmails($buyerUser, $subject, 'email.current_ventures.offers.StatusClosedEmailBuyer', $venture, null, $emailOwnershipPercentage))->delay(Carbon::now()->addSecond(5));
                    dispatch($emailJob);
                    $emailJob = (new \App\Jobs\SendVentureListingEmails($sellerUser, $subject, 'email.current_ventures.offers.StatusClosedEmailSeller', $venture))->delay(Carbon::now()->addSecond(5));
                    dispatch($emailJob);
                }


                return response()->json([ 'status' => true,'message' => 'Offer Updated with Status '.$offer->status.'!!']);
            }
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ]);
    }
}

public function sellingOwnershipListing(){
    try{
        $listings = SellingOwnershipVentureListing::paginate($limit = 10, $columns = ['*']);
        return view('admin.layouts.pages.currentVentures.selling-ownership-listing',compact('listings'));
    }catch (\Exception $e) {
        return back();
    }
}


public function getBuyNowReport(){

    return Excel::download(new ExportClosedListingReport, 'documents-report.xlsx');

}


}
