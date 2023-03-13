<?php
/**
 * Created by PhpStorm.
 * User: Transdata
 * Date: 4/8/2020
 * Time: 2:29 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NewVentureListRequest;
use App\Http\Requests\UpdateNewVentureListRequest;
use App\Http\Requests\VentureListFileRequest;
use App\Http\Requests\VentureListImageRequest;
use App\Models\Log;
use App\Models\Media;
use App\Models\VentureCommit;
use App\Models\VentureListing;
use App\Models\Type;
use App\Models\Venture;
use App\Repositories\VentureRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use App\Models\VentureOwnership;

use App\Notifications\DealDeadEmail;

class NewVentureListingController
{
    protected $repository;

    public function __construct(VentureRepository $repository)
    {
        $this->ventureRepository = $repository;

    }

    /* =========================================================================================
    Description: Method for New Venture Listing
    ----------------------------------------------------------------------------------------
    ========================================================================================== */

    public function index()
    {
        try {
            $ventures = $this->ventureRepository->latest()->take('5')->get();
            $VentureListing = VentureListing::where('type', '=', 'NEW')->
            orderByRaw("FIELD(list_status,'Pending', 'Live',  'Inactive') ASC")
            ->paginate($limit = 4, $columns = ['*']);
            $listingTypes = Type::where('type', 'Listing')->get();
            return view('admin.layouts.pages.newVentures.index', compact('ventures', 'VentureListing', 'listingTypes'));
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /* =========================================================================================
    Description: Method for New Venture Listing Create
    ----------------------------------------------------------------------------------------
    ========================================================================================== */

    public function newVentureListCreate($venture_id, $id)
    {
        $venture = $this->ventureRepository->where('venture_automated_id', $venture_id)->first();
        if(is_null($venture) ){
            abort('404');
        }
        $listingTypes = Type::where('type', 'Listing')->get();
        $documentTypes = Type::where('type', 'Document')->get();
        return view('admin.layouts.pages.newVentures.create', compact('venture', 'listingTypes', 'documentTypes'));
    }

    /* =========================================================================================
    Description: Method for Save New Venture Listing After select venture from popup
    ----------------------------------------------------------------------------------------
    ========================================================================================== */

    public function store(Request $request)
    {
        try{

                // Creating Unique ID of Venture
         $listAutomatedId = 'L' . sprintf('%06d', (VentureListing::withTrashed()->count() + 1));
         $venture_id=$request->get('venture_id');
                //create venture List with venture id
         $venture=Venture::where('venture_automated_id',$venture_id)->first();
         if (is_null($venture)) {
            return response()->json([
                'status' => false,
                'message' => 'Venture not found!'
            ]);
        }else {
            return response()->json(
                ['status' => true, 'message' => 'Your venture detail created against selected Venture', 'url' => url('/').'/admin/new-venture-listing/' . $venture->venture_automated_id . '/venture-detail/' . $listAutomatedId . '/create'], 200);
        }
    }catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ]);
    }
}


    /* =========================================================================================
    Description: Store Method for New Venture Listing Create Form
    ----------------------------------------------------------------------------------------
    ========================================================================================== */

    public function updateCreateForm(NewVentureListRequest $request)
    {
        try{
            $user = Auth::user();
            $venture=Venture::where('venture_automated_id',$request->get('vendor_id'))->first();
            if(is_null($venture)){
                return response()->json([
                    'status' => false,
                    'message' => 'Venture not found!'
                ]);
            }
            $featureListing = isset($request->feature_listing) ? 1 : 0;        
            $ventureListData=[
                'list_automated_id'=>$request->listing_id,
                'description' => $request->description,
                'list_status' => $request->listing_status,
                'feature' => $featureListing,
                'type' => Config::get('constants.NEW_VENTURE_LISTING'),
                'venture_id'=>$venture->id,
            ];

            // Creating venture here
            $ventureList = VentureListing::create($ventureListData);
        // Save images in Medias

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = Config::get('constants.ventureMediaPath');
                    $fileName = Helper::saveImage($image, $maxWidth = null, $path, $callback = null);
                    if ($fileName) {
                        $ventureList->medias()->create([
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
                    $ventureList->medias()->create([
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
                'title' => 'New Venture listing Created!',
                'description' => "New Venture listing #.$ventureList->id Created By ".$user->name. " UserID#". $user->id
            ]);
            $ventureList->logs()->save($log);
            return response()->json([
                'status' => true,
                'message' => 'New Venture List Updated successfully!',
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


    /* =========================================================================================
    Description:  Method for edit Form New Venture Listing
    ----------------------------------------------------------------------------------------
    ========================================================================================== */

    public function newVentureListEdit($venture_id, $id)
    {
        try{
            $venture = $this->ventureRepository->where('venture_automated_id',$venture_id)->first();
            $newVentureList = VentureListing::where('list_automated_id',$id)->first();
            if(is_null($venture) || is_null($newVentureList)){
                abort('404');
            }
            $listingTypes = Type::where('type', 'Listing')->get();
            $documentTypes = Type::where('type', 'Document')->get();
            $newVentureListImages = $newVentureList->medias()->where('type', 'IMAGE')->get();
            $ventureListImages = $newVentureList->venture->medias()->where('type', 'IMAGE')->get();
            // return $newVentureListImages;            
            return view('admin.layouts.pages.newVentures.edit', compact('venture', 'listingTypes', 'newVentureList', 'documentTypes','newVentureListImages','ventureListImages'));
        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /* =========================================================================================
   Description:  Update Method for edit Form New Venture Listing
   ----------------------------------------------------------------------------------------
   ========================================================================================== */

   public function update(UpdateNewVentureListRequest $request, $id)
   {
    $useMarker = '';
    if(isset($request->useMarker))
    {
        $useMarker = 1;
    }else{
        $useMarker = 0;
    }
    try{  
        $ventureList = VentureListing::find($id);
        $featureListing = isset($request->feature_listing) ? 1 : 0;            
        $ventureList->update([
            'description' => $request->description,
            'list_status' => $request->listing_status,
            'longitude' => $request->get('longitude'),
            'latitude' => $request->get('latitude'),
            'feature' => $featureListing,
            'useMarker' => $useMarker
        ]);
        return response()->json([
            'status' => true,
            'message' => 'New Venture List Updated successfully!',
        ]);

    }catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ]);
    }
}

    /* =========================================================================================
   Description:  Upload Method for edit Form New Venture Listing
   ----------------------------------------------------------------------------------------
   ========================================================================================== */

   public function uploadImages(VentureListImageRequest $request)
   {
    try {

        $user = Auth::user();
        $newVentureList = VentureListing::find($request->get('id'));
            // Adding Medias Against Ventures
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = Config::get('constants.ventureMediaPath');
                $fileName = Helper::saveImage($image, $maxWidth = null, $path, $callback = null);
                if ($fileName) {
                    $newVentureList->medias()->create([
                        'file_name' => $fileName,
                        'type' => Config::get('constants.mediaImageType'),
                        'user_id' => $user->id,
                        'visibility' => 'Visible',
                    ]);
                }
            }
        }

        $data = view('admin.layouts.pages.newVentures.partials.imagesSection', compact('newVentureList'))->render();

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
   Description:  uploadDocument Method for edit Form New Venture Listing
   ----------------------------------------------------------------------------------------
   ========================================================================================== */

   public function uploadDocument(VentureListFileRequest $request)
   {
    try {
        $user = Auth::user();
        $newVentureList = VentureListing::find($request->get('id'));

            // Adding Document Against Ventures
        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $path = Config::get('constants.ventureMediaPath');
            $fileName = Helper::saveFile($file, $path);
                //if document is added
            if ($fileName) {
                $newVentureList->medias()->create([
                    'title' => $request->get('documentName'),
                    'file_name' => $fileName,
//                        'document_type_id' => $request->get('document_type_id'),
                    'user_id' => $user->id,
                    'visibility' => 'Visible',
                    'date_of_document_to_apply' => $request->get('date_of_document') ? Carbon::createFromFormat("d/m/Y", $request->get('date_of_document'))->format('Y-m-d H:i:s') : null,
                ]);
            }
        }

        $documentTypes = Type::where('type', 'Document')->get();
        $data = view('admin.layouts.pages.newVentures.partials.documentTab', compact('newVentureList', 'documentTypes'))->render();

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
     Description:  Search New Venture List Method for New Venture Listing Index
     ----------------------------------------------------------------------------------------
     ========================================================================================== */

     public function searchNewVenture(Request $request)
     {
        try
        {
            $VentureListing = Helper::ventureListAdminSearch($request->all(),$type='NEW');
            $view = (string)view('admin.layouts.pages.newVentures.partials.table_row',compact('VentureListing'));
            return response()->json([
                'view' => $view,
                'status' => true,
                'message' => 'Venture Data successfully Updated!',
            ]);
        } 
        catch (\Exception $e) 
        {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }

    }
    /* =========================================================================================
 Description:  Delte Method for New Venture Listing
 ----------------------------------------------------------------------------------------
 ========================================================================================== */

 public function destroy($id)
 {
    try {
        $ventureList = VentureListing::find($id);
        if (!is_null($ventureList)) {
            $ventureList->delete();
        }
        return redirect()->back()->with('success','New Venture successfully Deleted!');
            // TODO: For Future Reference
            // return response()->json([
            //     'status' => true,
            //     'message' => 'New Venture successfully Deleted!',
            // ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' =>$e->getMessage(),

        ]);
    }
}
    /* =========================================================================================
   Description:  Search  Method for Ventures on New Venture Listing popup
   ----------------------------------------------------------------------------------------
   ========================================================================================== */

   public function searchVenture(Request $request)
   {
    try
    {
        $ventures = Helper::ventureSearch($request->all());
        $view = (string)view('admin.layouts.pages.newVentures.partials.popupSearchTableRow',compact('ventures'));
        return response()->json([
            'view' => $view,
            'status' => true,
            'message' => 'venture Data successfully Updated!',
        ]);
    } 
    catch (\Exception $e) 
    {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ]);
    }
}

    /* =========================================================================================
     Description:  Delete Method for Media Delete on edit New Venture Listing
     ----------------------------------------------------------------------------------------
     ========================================================================================== */

     public function mediaStatusDelete(Request $request){
        try
        {
            $media = Media::find($request->get('mediaID'));

            if(is_null($media)){
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

        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong, While file deleting!'
            ]);
        }
    }
    public function imageDelete(Request $request){
        try{
            $media = Media::find($request->get('mediaID'));

            if(is_null($media)){
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

        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wring, While file deleting!'
            ]);
        }
    }


    /* =========================================================================================
     Description:  Delete Method for Media Delete on edit New Venture Listing
     ----------------------------------------------------------------------------------------
     ========================================================================================== */
     public function userCommit($id){
        try{
            $ventureList = VentureListing::where('list_automated_id',$id)->first();
            $userCommits=$ventureList->commits()->paginate($limit = 10, $columns = ['*']);
            return view('admin.layouts.pages.newVentures.userCommit',compact('userCommits'));
        }catch (\Exception $e) {
            return back();
        }
    }

    public function removeUserCommit($id){
        \DB::beginTransaction();

        try{

            $commit  = VentureCommit::where('id', $id)->first();
            $lastUnitStart = $commit->unitStart;
            $lastUnitEnd = $commit->unitEnd;
            $commit->delete();
            $otherCommits = VentureCommit::where('new_venture_listing_id', $commit->new_venture_listing_id)->get();
            $firstDelete = true;

            foreach($otherCommits as $data)
            {
                if($data->id > $id)
                {
                    
                    $currentUnitStart = (int)$data->unitStart;
                    $currentUnitEnd = (int)$data->unitEnd;

                    $totalUnits = $currentUnitEnd - $currentUnitStart;

                    if($firstDelete){
                        $newUnitStart = 0;
                        $firstDelete = false;
                    }
                    else{
                        $newUnitStart = $lastUnitEnd+1;
                    }
                    $newUnitEnd = $newUnitStart  + $totalUnits;

                    // TODO: For Future refference
                    // if($counter==6){
                    //     // return $totalUnits;
                    //     return $currentUnitStart." ".$currentUnitEnd;
                    //     return $newUnitStart." ".$newUnitEnd;
                    // }
                    $data->unitStart = Helper::leftZeroPadding($newUnitStart);
                    $data->unitEnd = Helper::leftZeroPadding($newUnitEnd);
                    $data->save();

                    $lastUnitStart = (int)$data->unitStart;
                    $lastUnitEnd = (int)$data->unitEnd; 
                }
                else
                {
                    $firstDelete = false;
                    $lastUnitStart = (int)$data->unitStart;
                    $lastUnitEnd = (int)$data->unitEnd;   
                }
            }

            \DB::commit();
            return redirect()->back()->with('success','Commit removed successfully!');
        }catch (\Exception $e) {
            \DB::rollBack();

            dd($e);
            return back();
        }
    }

    public function userCommitStatus(Request $request)
    {
        try {
            $commit = VentureCommit::findorfail($request->get('commit_id'));

            if($request->input('status')){
                if ($request->input('status') == 'false') {
                    $commit->status = Config::get('constants.VENTURE_COMMIT_STATUS')[1];
                } else {
                    $commit->status = Config::get('constants.VENTURE_COMMIT_STATUS')[2];
                }
            }
            $commit->save();
            return response()->json([ 'status'=>true,'message' => 'This Commitment status successfully Updated.']);

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }

    }

    public function changeListingCommitmentStatus(Request $request)
    {        
        \DB::beginTransaction();
        try {
            $ventureList = VentureListing::findorfail($request->get('venture_listing_id'));

            $status = strtolower(str_slug($request->get('status'),'-'));

            $commitments = $ventureList->commits()->get();
            

            if(count($commitments) > 0){
                $sent = [];                
                foreach ($commitments as $commit){
                    $oldStatus = $commit->status;
                    $commit->update([
                        'status' => $request->get('status')
                    ]);
                    $user = !is_null($commit->user) ? $commit->user : null;
                    if(Helper::compareStatuses($oldStatus, $commit->status) && !in_array($user->email, $sent))
                    {
                        $sent[] = $user->email;
                        $emailJob = (new \App\Jobs\Commitment\NewVentureCommitListingStatusEmails($user, $status))->delay(Carbon::now()->addSecond(5));
                        dispatch($emailJob);
                    }

                    if($request->status == 'Closed' && $user)
                    {
                        $oldPercentage = (($commit->unitEnd - $commit->unitStart)+1)/10000;
                        $newAmount = $request->get('target_amount') * $oldPercentage;
                        $ventureOwnership = VentureOwnership::create([
                            "ownership_sequence_start" => Helper::leftZeroPadding($commit->unitStart),
                            "ownership_sequence_end" => Helper::leftZeroPadding($commit->unitEnd),
                            "user_id" => $user->id,
                            "venture_id" => $ventureList->venture_id,
                            "amount_paid"=>$newAmount,
                            "amount_sold"=>0,
                            "ownership_begin_date"=>Carbon::now()->format('m/d/Y'),
                            "ownership_end_date"=>null
                        ]);
                    }                                        
                }
            }

            if($request->status == 'Closed')
            {   
                $ventureList->venture->update([
                    "purchase_price"=> $request->get('target_amount')
                ]);
                $ventureList->update([
                    'status' => 'Closed',
                    'list_status' => 'Inactive'
                ]);
            }
            else
            {
                $ventureList->update([
                    'status' => $request->get('status')
                ]);
            }
            \DB::commit();

            toastr()->success('Status updated and emailed to all committed members');
            return back();

        } catch (\Exception $e) {
            \DB::rollBack();
            
            dd($e);
            return back()->withErrors($e->getMessage());
        }

    }

    public function imageFeatured(Request $request)
    {
        try
        {
            $imageId = $request->ImageID;
            $ventureId = $request->ventureID;

            $venture =  VentureListing::find($ventureId);        
            $venture->featuredImageId = $imageId;
            $venture->save();
            return response()->json([ 'status'=>true,'message' => 'Image was featured successfully.']);
        } 
        catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'There was a problem setting image as featured'
            ]);
        }
        // return $ventureId;
    }
}
