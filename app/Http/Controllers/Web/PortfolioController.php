<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BuyNow;
use App\Models\Offer;
use App\Models\VentureCommit;
use App\Models\Venture;
use App\Models\Type;
use App\Models\VentureOwnership;
use App\Models\VentureListing;
use App\Models\UserVentureListing;
use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class PortfolioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        try{
            $user = Auth::user();

            $commits = VentureCommit::whereHas('NewVentureListing')->where('user_id','=', Auth::user()->id)->get();//paginate($limit = 10, $columns = ['*']);
            $currentVentureListings = auth()->user()->ventureListings;//->paginate($limit = 4, $columns = ['*']);
            $ventureOwnerships = VentureOwnership::where('user_id',auth()->user()->id)->where('isDeleted',0)->get();
            // Request Made by this user
            $buyNow = $user->buyNowListingRequests()->paginate($limit = 4, $columns = ['*']);
            // Request Made by this user

            $buyNowReceived = $user->ventureListings()->whereHas('BuyNow')->with(['BuyNow' => function($q) use($user){
                $q->whereHas('venture_listing')->where('user_id','!=',$user->id);
            }])->get();
            $buyNowReceived = collect($buyNowReceived->pluck('BuyNow'))->flatten()->filter(function($value, $key) {
                return  $value != null;
            });

            //Offer you have made
            $offers = Offer::whereUserId(auth()->user()->id)->paginate($limit = 4, $columns = ['*']);

            //Offer Received from others
            $receiveOffers = $user->ventureListings()->whereHas('offers')->with(['offers' => function($q) use($user){
                $q->whereHas('venture_listing')->where('user_id','!=',$user->id);
            }])->get();
            $receiveOffers = collect($receiveOffers->pluck('offers'))->flatten()->filter(function($value, $key) {
                return  $value != null;
            });

            return view('web.layouts.portfolio.index',compact('commits','buyNow','offers','currentVentureListings','buyNowReceived','receiveOffers','ventureOwnerships'));
        }catch (\Exception $e) {
            dd($e);
            return back()->withErrors($e->getMessage());
        }
    }


    public function searchPendingTransactions(Request $request) {
        try{
            $user = User::where('id',$request->user_id)->first();


            $from = $request->from == null? null: formatYMD($request->from);
            $to = $request->to == null? null: formatYMD($request->to);

            $commits = VentureCommit::whereHas('NewVentureListing')->where('user_id','=', $user->id);

            if(!is_null($from))
                $commits = $commits->whereDate('created_at','>=',$from);
            if(!is_null($to))
                $commits = $commits->whereDate('created_at','<=',$to);

            $commits = $commits->paginate($limit = 10, $columns = ['*']);


            // Request Made by this user
            $buyNow = $user->buyNowListingRequests();
            if(!is_null($from))
                $buyNow = $buyNow->whereDate('created_at','>=',$from);
            if(!is_null($to))
                $buyNow = $buyNow->whereDate('created_at','<=',$to);

            $buyNow = $buyNow->paginate($limit = 4, $columns = ['*']);
            
            // Request Made by this user
            $buyNowReceived = $user->ventureListings()->whereHas('BuyNow')->with(['BuyNow' => function($q) use($user,$from,$to){
                $q->whereHas('venture_listing')->where('user_id','!=',$user->id);
                if(!is_null($from))
                    $q = $q->whereDate('created_at','>=',$from);
                if(!is_null($to))
                    $q = $q->whereDate('created_at','<=',$to);
            }])->get();


            $buyNowReceived = collect($buyNowReceived->pluck('BuyNow'))->flatten()->filter(function($value, $key) {
                return  $value != null;
            });
            //Offer you have made
            $offers = Offer::whereUserId($user->id);

            if(!is_null($from))
                $offers = $offers->whereDate('created_at','>=',$from);
            if(!is_null($to))
                $offers = $offers->whereDate('created_at','<=',$to);

            $offers = $offers->paginate($limit = 4, $columns = ['*']);

            //Offer Received from others
            $receiveOffers = $user->ventureListings()->whereHas('offers')->with(['offers' => function($q) use($user,$from,$to){
                $q->whereHas('venture_listing')->where('user_id','!=',$user->id);
                if(!is_null($from))
                    $q = $q->whereDate('created_at','>=',$from);
                if(!is_null($to))
                    $q = $q->whereDate('created_at','<=',$to);

            }])->get();

            $receiveOffers = collect($receiveOffers->pluck('offers'))->flatten()->filter(function($value, $key) {
                return  $value != null;
            });

            $view = (string)view('web.layouts.portfolio.pendingTransactions',compact('commits','buyNow','offers','buyNowReceived','receiveOffers'));

            return response()->json([
                'view' => $view,
                'status' => true,
                'message' => 'Pending Transactions Data successfully Updated!',
            ]);
        }catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function cancelSell($id)
    {
        try {
            $ventureList = VentureListing::find($id);
            if (!is_null($ventureList)) {
                $ventureList->delete();
            }
            UserVentureListing::where('venture_listing_id',$id)
            ->where('user_id',Auth::user()->id)
            ->delete();

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

    public function ventureDocuments($ventureId)
    {
        try{
            $currentVenture = Venture::with('VentureDetail')->find($ventureId);            
            
            $ventureTypes = Config::get('constants.VENTURE_TYPE') ? Config::get('constants.VENTURE_TYPE') : [];
            $ventureSourceTypes = Config::get('constants.VENTURE_SOURCE_TYPE') ? Config::get('constants.VENTURE_SOURCE_TYPE') : [];
            $documentTypes = Type::where('type','Document')->get();

            return view('web.layouts.portfolio.documents',compact('currentVenture','documentTypes','ventureTypes','ventureSourceTypes'));
        }catch (\Exception $e) {
            dd($e);
            return back()->withErrors($e->getMessage());
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\venture  $venture
     * @return \Illuminate\Http\Response
     */

    public function uploadDocument(Request $request)
    {
        try{

            $this->validate($request, [
                'file' => 'required',
                'documentName' => 'required',
                'date_of_document' => 'required',
                'id' => 'required',
            ]);
            $user = Auth::user();
            // $currentVenture = $this->ventureRepository->find($request->get('id'));
            $currentVenture = Venture::where('id',$request->get('id'))->first();

            // Adding Document Against Ventures
            if($request->hasFile('file')){
                $file = $request->file('file');
                $path = Config::get('constants.ventureMediaPath');
                $fileName = Helper::saveFile($file, $path);
                if($fileName){
                    $currentVenture->medias()->create([
                        'title' => $request->get('documentName'),
                        'file_name' => $fileName,
                        'document_type_id' => $request->get('document_type_id'),
                        'type' => Config::get('constants.mediaDocumentType'),
                        'user_id' => $user->id,
                        'visibility' => $request->get('visibility'),
                        'date_of_document_to_apply' =>
                        $request->get('date_of_document')?Carbon::createFromFormat('m-d-Y', $request->get('date_of_document'))->format('Y-m-d H:i:s'): null,
                    ]);
                }
            }

            $documentTypes = Type::where('type','Document')->get();
            $data =  view('web.layouts.venture.documentTab',compact('currentVenture','documentTypes'))->render();

            return response()->json([
                'status' => true,
                'message' => 'Document successfully uploaded!',
                'data' => $data
            ]);

        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function downloadInformation(Request $request)
    {
        try{

            $this->validate($request, [
                'from' => 'required',
            ]);

            $from = Carbon::createFromFormat('m-d-Y',$request->get('from'))->format('Y-m-d');
            $to = Carbon::createFromFormat('m-d-Y',$request->get('to'))->format('Y-m-d');

            $currentVenture = Venture::with('VentureDetail')->find($request->get('id'));            
            $documentTypes = Type::where('type','Document')->get();
            $data =  view('web.layouts.venture.documentTab',compact('currentVenture','documentTypes', 'from', 'to'))->render();


            return response()->json([
                'status' => true,
                'message' => 'Documents data successfully retrieved!',
                'data' => $data
            ]);

        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function eversignApi(Request $request)
    {
        $url = 'https://api.eversign.com/api/document?access_key=64d93fee391111089f3b33e2e0b98922&business_id=153222&type=completed';
        // Initialize a CURL session.
        $ch = curl_init();

        

        $signers = [];
        for($i=0; $i<count($request['signers']); $i++)
        {
            $signers[] = [
                "name"=>$request['signers'][$i]['name'],
                "email"=>$request['signers'][$i]['email'],
                "role"=>$request['signers'][$i]['role']
            ];
        }

        $fields = [];
        for($i=0; $i<count($request['fields']); $i++)
        {
            $fields[] = [
                "identifier"=>$request['fields'][$i]['identifier'],
                "value"=>$request['fields'][$i]['value'],
            ];
        }

        $data = [
            "sandbox"=> 1,
            "template_id"=> $request->template_id,
            "embedded_signing_enabled"=> $request->embedded_signing_enabled,
            "signers"=> $signers,
            "fields"=> $fields
        ];


        $payload = json_encode($data);
        // return $payload;
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        // Attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        // Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        
        //grab URL and pass it to the variable.
        curl_setopt($ch, CURLOPT_URL, $url);
        
        curl_exec($ch); 
        // return $request;
    }
}
