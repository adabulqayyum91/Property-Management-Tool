<?php


namespace App\Http\Controllers\Web;


use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BuyNow;
use App\Models\Log;
use App\Models\Offer;
use App\Models\VentureListing;
use App\Models\VentureOwnership;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class CurrentVentureController extends Controller
{
    /* =========================================================================================
       Description: Method for User Venture Listing
       ----------------------------------------------------------------------------------------
       ========================================================================================== */

       public function index()
       {
        try{

            $currentVentureListings = VentureListing::where('type', '=', 'CURRENT')->
            orderByRaw("FIELD(list_status,'Pending', 'Live',  'Inactive') ASC")->where('list_status','=','Live')->get();
            $featureVentures= VentureListing::where('type', '=', 'CURRENT')->
            orderByRaw("FIELD(list_status,'Pending', 'Live',  'Inactive') ASC")->where('list_status','=','Live')->where('feature','=','1')->get();            
            $types = Config::get('constants.VENTURE_TYPE') ? Config::get('constants.VENTURE_TYPE') : [];
            return view('web.layouts.venture.currentVentures.index',compact('currentVentureListings','types','featureVentures'));
        }catch (\Exception $e) {
            return back();
        }
    }

    /* =========================================================================================
        Description: Method For User venture detail
        ----------------------------------------------------------------------------------------
        ========================================================================================== */

        public function show($id){
            try{
                $streetAddress = '';
                $ventureList = VentureListing::where('list_automated_id',$id)->first();
                $currentVentureList = VentureListing::where('list_automated_id',$id)->first();
                if($ventureList->useMarker == 0)
                {
                    $VD = $ventureList->venture->ventureDetail;
                    $streetAddress = $VD->property_street."+".$VD->property_city."+".Helper::getState($VD->property_state)."+".$VD->property_zip;
                    $streetAddress = str_replace(' ', '+', $streetAddress);
                }
                else
                {
                    $streetAddress = $ventureList->latitude .','. $ventureList->longitude;                
                }  
            // return $ventureList->venture->ventureDetail;
                if(!is_null($ventureList) && !is_null($currentVentureList))
                {

                    $ventureImages = [];                

                    $currentVentureListImages = $currentVentureList->medias()->where('type', 'IMAGE')->get();                                

                    $currentVentureListDocuments = $currentVentureList->medias()->where('visibility','Visible')
                                                                    ->where('document_type_id',19) // 19 = Property Summary
                                                                    ->where(function($query) {
                                                                        return $query->where('type','=',null)
                                                                        ->orWhere('type','=','FILE');
                                                                    })
                                                                    ->get();
                                                                    $ventureDocuments = $currentVentureList->venture->medias()->where('visibility','Visible')
                                                                    ->where('document_type_id',19) // 19 = Property Summary
                                                                    ->where(function($query) {
                                                                        return $query->where('type','=',null)
                                                                        ->orWhere('type','=','FILE');
                                                                    })
                                                                    ->get();
                                                                    $currentVentureListDocuments = $currentVentureListDocuments->merge($ventureDocuments);        

                                                                    if(!is_null($ventureList->venture->medias()))

                                                                    {

                                                                        $ventureImages = $currentVentureList->venture->medias()->where('type', 'IMAGE')->get();

                                                                    }

                                                                    return view('web.layouts.venture.currentVentures.show',compact('currentVentureList','ventureList','currentVentureListImages','ventureImages','currentVentureListDocuments','streetAddress'));

                                                                } 
                                                            }catch (\Exception $e) {
                                                                return back();
                                                            }
                                                        }
    /* =========================================================================================
    Description: Method for User Venture Listing
    ----------------------------------------------------------------------------------------
    ========================================================================================== */

    public function currentUserList()
    {
        try{
            $currentVentureListings = auth()->user()->ventureListings;//->paginate($limit = 4, $columns = ['*']);
            return view('web.layouts.venture.currentVentures.currentUserList',compact('currentVentureListings'));
        }catch (\Exception $e) {
            return back();
        }
    }
    /* =========================================================================================
   Description: Method for User Venture Listing Buy Now
   ----------------------------------------------------------------------------------------
   ========================================================================================== */

   public function buyNow(){
    try{
        $buyNow =BuyNow::whereUserId(auth()->user()->id)->paginate($limit = 4, $columns = ['*']);
        return view('web.layouts.venture.currentVentures.buyNow',compact('buyNow'));
    }catch (\Exception $e) {
        return back();
    }
}


public function offers(){
    try{
        $offers = Offer::whereUserId(auth()->user()->id)->paginate($limit = 4, $columns = ['*']);
        return view('web.layouts.venture.currentVentures.offer',compact('offers'));
    }catch (\Exception $e) {
        return back();
    }
}
    /* =========================================================================================
     Description: Method for User Venture Listing Buy now popup
     ----------------------------------------------------------------------------------------
     ========================================================================================== */
     public function getBuyNowModal($id)
     {
        try {
            $ventureList = VentureListing::where('list_automated_id',$id)->first();

            if (is_null($ventureList)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Listing not found!'
                ]);
            }

            $popup =  view('web.layouts.venture.currentVentures.partials.buy_now_popup',compact('ventureList'))->render();

            return response()->json([
                'status' => true,
                'message' => 'Data retrieved!',
                'data' => $popup
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wring, While getting data!'
            ]);
        }
    }
    public function getOfferModal($id)
    {
        try {
            $ventureList = VentureListing::where('list_automated_id',$id)->first();

            if (is_null($ventureList)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Listing not found!'
                ]);
            }

            $popup =  view('web.layouts.venture.currentVentures.partials.offer_popup',compact('ventureList'))->render();

            return response()->json([
                'status' => true,
                'message' => 'Data retrieved!',
                'data' => $popup
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wring, While getting data!'
            ]);
        }
    }

    public function getSellModal($id)
    {
        try {
            $user = Auth::user();
            // $ventureList = $user->ventureListings()->where('venture_listing_id',decrypt($id))->first();

            // if (is_null($ventureList)) {
            //     return response()->json([
            //         'status' => false,
            //         'message' => 'Listing not found!'
            //     ]);
            // }

            $venturOwnership = VentureOwnership::where('id',decrypt($id))->first();


            $popup =  view('web.layouts.venture.currentVentures.partials.sell-popup',compact('venturOwnership'))->render();
            return response()->json([
                'status' => true,
                'message' => 'Data retrieved!',
                'data' => $popup
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wring, While getting data!'
            ]);
        }
    }

    public function getSellDetailModal($id)
    {
        try {
            $user = Auth::user();
            $ventureList = $user->ventureListings()->where('venture_listing_id',decrypt($id))->first();

            if (is_null($ventureList)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Listing not found!'
                ]);
            }

            $ventureListDetail = $user->sellingListings()->wherePivot('venture_listing_id',decrypt($id))->first();

            $popup =  view('web.layouts.venture.currentVentures.partials.selling-listing-detail',compact('ventureList', 'ventureListDetail'))->render();

            return response()->json([
                'status' => true,
                'message' => 'Data retrieved!',
                'data' => $popup
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wring, While getting data!'
            ]);
        }
    }

    public function cancelSellListing($id)
    {
        try {
            $user = Auth::user();
            $venture = VentureListing::find(decrypt($id));

            if (count($user->sellingListings) == 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Listing not found!'
                ]);
            }

            $user->sellingListings()->wherePivot('venture_listing_id', decrypt($id))->detach();

            $log = Log::create([
                'title' => 'Selling ownership request successfully canceled!',
                'description' => "Venture Listing #$venture->list_automated_id Request canceled by ".$user->name. " UserID#". $user->member_automated_id
            ]);
            $venture->logs()->save($log);

            return response()->json([
                'status' => true,
                'message' => 'Selling ownership request successfully canceled!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wring, While cancelling Selling ownership request!'
            ]);
        }
    }

    public function saveOfferRequest(Request $request)
    {
        try {

            $this->validate($request, [
                'amount' => 'required',
                'seller_ownership' => 'required'
            ]);

            $user = Auth::user();

            if(!isProfileComplete())
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Complete your profile first.'
                ]);
            }

            $ventureList = VentureListing::where('list_automated_id',$request->get('listing_id'))->first();

            if (is_null($ventureList)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Listing not found!'
                ]);
            }

            $input = $request->except('listing_id');
            $input['status'] = Config::get('constants.VENTURE_OFFER_STATUS')[0];


            $offer = Offer::create($input);
            // Associating Listing
            $offer->venture_listing()->associate($ventureList)->save();
            // Associating User
            $offer->user()->associate($user)->save();


            $buyerUser = $offer->user;

            $sellerUser = $ventureList->users()->first();

            $venture = $offer->venture_listing;

            $subject = "Congratulations! You have an offer on Venture ".$venture->venture->venture_name." Listing ID $ventureList->list_automated_id";
            $emailJob = (new \App\Jobs\Offers\SendEmailForNewOfferMadeToSeller($sellerUser, $venture, $subject))->delay(Carbon::now()->addSecond(5));
            dispatch($emailJob);

            $subject = "Your offer on Venture ".$venture->venture->venture_name." Listing ID $ventureList->list_automated_id";
            $emailJob = (new \App\Jobs\Offers\SendEmailForNewOfferMadeToBuyer($buyerUser, $venture, $subject, $offer))->delay(Carbon::now()->addSecond(5));
            dispatch($emailJob);

            return response()->json([
                'status' => true,
                'message' => 'Offer sent successfully to seller.',
            ]);

            // Save Offer Creation Log
            $log = Log::create([
                'title' => 'Offer Created!',
                'description' => "Venture Listing #$ventureList->list_automated_id Offer created by ".$user->name. " UserID#". $user->member_automated_id
            ]);
            $ventureList->logs()->save($log);

            return response()->json([
                'status' => true,
                'message' => 'Offer Request has been created and notified to seller!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function saveBuyNowRequest(Request $request)
    {
        try {
            $user = Auth::user();
            $ventureList = VentureListing::where('list_automated_id',$request->get('listing_id'))->first();

            if (is_null($ventureList)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Listing not found!'
                ]);
            }

            if(!isProfileComplete())
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Complete your profile first.'
                ]);
            }

            // If already buy now request made for this property
            if (!is_null($ventureList->BuyNow()->first())) {
                return response()->json([
                    'status' => false,
                    'message' => 'Request already made by someone for this listing. Please, try with another listing.'
                ]);
            }

            $anyAcceptedOffers = Offer::where('venture_listing_id',$ventureList->id)
            ->whereNotIn('status',['New Offer', 'Declined'])->first();

            if(!empty($anyAcceptedOffers))
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Request already made by someone for this listing. Please, try with another listing.'
                ]);   
            }

            $buyNow = BuyNow::create([
                'status' => Config::get('constants.VENTURE_BUY_NOW_STATUS')[0]
            ]);
            // Associating Listing
            $buyNow->venture_listing()->associate($ventureList)->save();
            // Associating User
            $buyNow->user()->associate($user)->save();
            //
            $sellerUser = $ventureList->users()->first();

            $venture = $buyNow->venture_listing;

            if(!is_null($sellerUser)){
                $subject = "Great News! You have a buyer for  ".$venture->venture->venture_name."($ventureList->list_automated_id)";
                $emailJob = (new \App\Jobs\BuyNow\CurrentVentureBuyNowDocumentStatusEmails($sellerUser, 'pending', $venture, null, $subject))->delay(Carbon::now()->addSecond(5));
                dispatch($emailJob);
            }

            $subject = "Congratulations on your new purchase of ".$venture->venture->venture_name." ($ventureList->list_automated_id)";
            $emailJob = (new \App\Jobs\BuyNow\CurrentVentureBuyNowDocumentStatusEmails($user, 'complete-request-to-buyer', $venture, null, $subject))->delay(Carbon::now()->addSecond(5));
            dispatch($emailJob);

            $userIds = Offer::where('venture_listing_id',$venture->id)
            ->where('status','New Offer')
            ->pluck('user_id');
            $otherBuyers = User::whereIn('id',$userIds)->get();
            $document = $request->get('document_hash') ? $request->get('document_hash') : null;

            $subject = "Offer for Venture " . $venture->venture->venture_name . ", Listing ID ".$venture->list_automated_id." was declined by the seller";
            foreach ($otherBuyers as $key => $buyer) {
                $emailJob = (new \App\Jobs\SendVentureListingEmails($buyer, $subject, 'email.current_ventures.offers.sendEmailToBuyerForRejection', $venture, $document))->delay(Carbon::now()->addSecond(5));
                dispatch($emailJob);
            }

            $updateOffers = Offer::where('venture_listing_id',$venture->id)
            ->where('status','New Offer')
            ->update(['status'=>'Declined']);


            // Save Offer Creation Log
            $log = Log::create([
                'title' => 'BuyNow Request Created!',
                'description' => "Venture Listing #$ventureList->list_automated_id BuyNow created by ".$user->name. " UserID#". $user->member_automated_id
            ]);
            $ventureList->logs()->save($log);

            return response()->json([
                'status' => true,
                'message' => 'BuyNow Request submitted!',
            ]);

        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'status' => false,
                'message' => 'Something went wring, While submitting BuyNow request!'
            ]);
        }
    }

    public function saveSellingOwnershipRequest(Request $request)
    {
        // try 
        {
            $validator = \Validator::make($request->all(), [
                'price' => 'required',
                // 'description' => 'required',
                'selling_ownership_percentage' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->all()
                ]);
            }

            $input = [
                "asking_price"=>$request->price,
                "percentage_of_ownership"=>$request->selling_ownership_percentage,
                "description"=>$request->description,
                "venture_id"=>$request->venture_id,
                "list_status"=>"Live",
                "ownership_id"=>$request->ownership_id
            ];
            // Creating Unique ID of Venture
            $input['list_automated_id'] = 'L' . sprintf('%06d', (VentureListing::withTrashed()->count() + 1));
            $input['status'] = Config::get('constants.VENTURE_LISTING_STATUS')[0];
            $input['type'] = Config::get('constants.CURRENT_VENTURE_LISTING');
            
            //create venture List with venture id
            $venture_detail = VentureListing::create($input);

            if (!is_null($venture_detail->venture)) {
            }

            //Associate user with listing and venture
            $venture_detail->users()->attach(Auth::user()->id, [
                'venture_id' => $venture_detail->venture->id,
                'venture_listing_id' => $venture_detail->id,
            ]);
            
            $user = Auth::user();
            $log = Log::create([
                'title' => 'Listing selling Request Created!',
                'description' => "Venture Listing #$venture_detail->list_automated_id Listing selling ownership request created by ".$user->name. " UserID#". $user->member_automated_id
            ]);
            $venture_detail->logs()->save($log);

            return response()->json([
                'status' => true,
                'message' => 'BuyNow Request submitted!',
            ]);

        // } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wring, While submitting BuyNow request!'
            ]);
        }
    }

    public function ventureSearch(Request $request){
        $ventureList= Helper::ventureListSearch($request->all(),$type='CURRENT');
        $view = (string)view('web.layouts.venture.currentVentures.partials.search_row',compact('ventureList'));
        return response()->json([
            'view' => $view,
            'status' => true,
        ]);
    }

    /* =========================================================================================
    Description: Sending Document status emails
    ----------------------------------------------------------------------------------------
    ========================================================================================== */
    public function sendBuyNowDocumentStatusEmails(Request $request)
    {
        try {
            $buyNowRequest = BuyNow::where('id',$request->get('buy_now_id'))->first();

            if (is_null($buyNowRequest)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Buy now request not found!'
                ]);
            }

            $user = Auth::user();

            $document = $request->get('document_hash') ? $request->get('document_hash') : null;

            $data = ['status' => $request->get('status') ? $request->get('status') : Config::get('constants.VENTURE_BUY_NOW_STATUS')[1]];
            if(!is_null($document)){
                $data['document_hash'] = $document;
            }
            $buyNowRequest->update($data);
            $venture = $buyNowRequest->venture_listing;

            // Update listing status to hide from Current Venture Lists
            if($request->get('status') == Config::get('constants.VENTURE_BUY_NOW_STATUS')[2]){
                $venture->update([
                    'list_status' => 'Inactive'
                ]);
            }

            $sellerUser = $venture->users()->first();
            $subject = null;

            if($request->get('type') == 'declined'){
                //Now email just send to admin only
                $user = null;
                $subject = "Document Declined for ".$venture->venture->venture_name.", $venture->list_automated_id";
            }

            if($request->get('type') == 'success'){
                $subject = "Listing Closing on ".$venture->venture->venture_name.", $venture->list_automated_id";
            }

            if($request->get('sendEmails') == 'true'){
                $emailJob = (new \App\Jobs\BuyNow\CurrentVentureBuyNowDocumentStatusEmails($sellerUser, $request->get('type'), $venture, $document, $subject, null,'true'))->delay(Carbon::now()->addSecond(5));
                dispatch($emailJob);

                $emailJob = (new \App\Jobs\BuyNow\CurrentVentureBuyNowDocumentStatusEmails($user, $request->get('type'), $venture, $document, $subject, null,'true'))->delay(Carbon::now()->addSecond(5));
                dispatch($emailJob);
            }

            if($buyNowRequest->status == "Pending Seller Docs")
            {
                $emailJob = (new \App\Jobs\BuyNow\CurrentVentureBuyNowDocumentStatusEmails($sellerUser, 'buyer-signed', $venture, $document, $subject, null,'true'))->delay(Carbon::now()->addSecond(5));
                dispatch($emailJob);   
            }

            return response()->json([
                'status' => true,
                'message' => 'Thank you, Your documents has been submitted and emailed you.',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /* =========================================================================================
    Description: Update Document Singers Url in BUY NOW Table
    ----------------------------------------------------------------------------------------
    ========================================================================================== */
    public function updateBuyNowRequestSignersUrl(Request $request, $id)
    {
        try {
            $buyNowRequest = BuyNow::where('id',$id)->first();

            if (is_null($buyNowRequest)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Buy now request not found!'
                ]);
            }

            $data = [
                'document_hash' => $request->get('document_hash'),
                'buyer_document_signing_url' => $request->get('buyerSigningUrl'),
                'seller_document_signing_url' => $request->get('sellerSigningUrl'),
            ];

            $buyNowRequest->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Update Url In DB!',
            ]);

        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'status' => false,
                'message' => 'Something went wring, While sending Updating!'
            ]);
        }
    }

    /* =========================================================================================
    Description: Sending Document status emails
    ----------------------------------------------------------------------------------------
    ========================================================================================== */
    public function sendOffersDocumentStatusEmails(Request $request)
    {
        // return $request;
        try {
            $offerRequest = Offer::where('id', $request->get('offer_id'))->first();

            if (is_null($offerRequest)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Offer request not found!'
                ]);
            }

            $user = Auth::user();
            $emailJob = null;

            $document = $request->get('document_hash') ? $request->get('document_hash') : null;

            $data = ['status' => $request->get('status') ? $request->get('status') : Config::get('constants.VENTURE_OFFER_STATUS')[0]];

            if($data['status']==Config::get('constants.VENTURE_OFFER_STATUS')[1])
                $data['status'] = Config::get('constants.VENTURE_OFFER_STATUS')[4];
            if (!is_null($document)) {
                $data['document_hash'] = $document;
            }
            $offerRequest->update($data);
            $venture = $offerRequest->venture_listing;
            $buyerUser = $offerRequest->user;
            $sellerUser = $venture->users()->first();
            $subject = null;
            $type = $request->get('type');

            if ($request->get('status') == Config::get('constants.VENTURE_OFFER_STATUS')[1])
            {
                $subject = "Your offer for " . $venture->venture->venture_name . ", Listing ID ".$venture->list_automated_id." has been accepted";
                $emailJob = (new \App\Jobs\SendVentureListingEmails($buyerUser, $subject, 'email.current_ventures.offers.sendEmailToBuyerForAcception', $venture, $document))->delay(Carbon::now()->addSecond(5));
                dispatch($emailJob);
                $subject = "You accepted the offer for " . $venture->venture->venture_name . ", Listing ID ".$venture->list_automated_id.".";
                $emailJob = (new \App\Jobs\SendVentureListingEmails($sellerUser, $subject, 'email.current_ventures.offers.sendEmailToSellerForAcception', $venture, $document))->delay(Carbon::now()->addSecond(5));
                dispatch($emailJob);

                $subject = "Your offer for " . $venture->venture->venture_name . ", Listing ID ".$venture->list_automated_id." has been accepted";
                $userIds = Offer::where('venture_listing_id',$venture->id)
                ->where('status','New Offer')
                ->where('id','!=',$offerRequest->id)
                ->pluck('user_id');
                $otherBuyers = User::whereIn('id',$userIds)->get();
                $subject = "Offer for Venture " . $venture->venture->venture_name . ", Listing ID ".$venture->list_automated_id." was declined by the seller";
                foreach ($otherBuyers as $key => $buyer) {
                    $emailJob = (new \App\Jobs\SendVentureListingEmails($buyer, $subject, 'email.current_ventures.offers.sendEmailToBuyerForRejection', $venture, $document))->delay(Carbon::now()->addSecond(5));
                    dispatch($emailJob);
                }

                $updateOffers = Offer::where('venture_listing_id',$venture->id)
                ->where('status','New Offer')
                ->where('id','!=',$offerRequest->id)
                ->update(['status'=>'Declined']);

                $venture->update([
                    'list_status' => 'Inactive'
                ]);
                // TODO: Old Logic for future use
                // $subject = "Please sign required documents to complete your sale of Venture " . $venture->venture->venture_name . ", Listing ID $venture->list_automated_id";
                // $emailJob = (new \App\Jobs\SendVentureListingEmails($buyerUser, $subject, 'email.current_ventures.offers.document-pending', $venture, $document))->delay(Carbon::now()->addSecond(5));
                // dispatch($emailJob);
                // $emailJob = (new \App\Jobs\SendVentureListingEmails($sellerUser, $subject, 'email.current_ventures.offers.document-pending', $venture, $document))->delay(Carbon::now()->addSecond(5));
                // dispatch($emailJob);

            }

            if ($request->get('status') == Config::get('constants.VENTURE_OFFER_STATUS')[2] || $request->get('type') == 'declined') {
                $subject = "Offer for Venture " . $venture->venture->venture_name . ", Listing ID ".$venture->list_automated_id." was declined by the seller";
                $emailJob = (new \App\Jobs\SendVentureListingEmails($buyerUser, $subject, 'email.current_ventures.offers.sendEmailToBuyerForRejection', $venture, $document))->delay(Carbon::now()->addSecond(5));
                dispatch($emailJob);

                return response()->json([
                    'status' => true,
                    'message' => 'Thank you for your feedback – your response has been sent.',
                ]);
            }

            if ($request->get('status') == Config::get('constants.VENTURE_OFFER_STATUS')[5]) {
                $venture->update([
                    'list_status' => 'Inactive',
                    'status'=>'Sold',
                ]);

                $subject = "Documents for Venture " . $venture->venture->venture_name . ", $venture->list_automated_id have been signed and returned please start the funding process.";
                $emailJob = (new \App\Jobs\SendVentureListingEmails('admin', $subject, 'email.current_ventures.offers.fundingEmailToAdmin', $venture, $document))->delay(Carbon::now()->addSecond(5));
                dispatch($emailJob);
            }

            return response()->json([
                'status' => true,
                'message' => 'Thank you, Your documents has been submitted and emailed you.',
            ]);

        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


    /* =========================================================================================
    Description: Update Document Singers Url in BUY NOW Table
    ----------------------------------------------------------------------------------------
    ========================================================================================== */
    public function updateOffersRequestSignersUrl(Request $request, $id)
    {
        try {
            $offerRequest = Offer::where('id',$id)->first();

            if (is_null($offerRequest)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Offer request not found!'
                ]);
            }

            $data = [
                'document_hash' => $request->get('document_hash'),
                'buyer_document_signing_url' => $request->get('buyerSigningUrl'),
                'seller_document_signing_url' => $request->get('sellerSigningUrl'),
            ];

            $offerRequest->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Update Url In DB!',
            ]);

        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'status' => false,
                'message' => 'Something went wring, While sending Updating!'
            ]);
        }
    }
}

