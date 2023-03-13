<?php
/**
 * Created by PhpStorm.
 * User: Transdata
 * Date: 4/6/2020
 * Time: 4:03 PM
 */

namespace App\Http\Controllers\Web;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\VentureCommit;
use App\Models\VentureListing;
use App\Repositories\VentureRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Spatie\Searchable\Search;

class NewVentureController extends Controller
{


    protected $repository;
    public function __construct(VentureRepository $repository)
    {
        $this->ventureRepository = $repository;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /* =========================================================================================
       Description: Method for User Venture Listing
       ----------------------------------------------------------------------------------------
       ========================================================================================== */

       public function index()
       {
        try
        {
            $newVentureListing = VentureListing::where('type','=','NEW')
            ->where('list_status','=','Live')
            ->where('status','=', null)
            ->paginate($limit = 4, $columns = ['*']);
            $featureVentures = VentureListing::where('type','=','NEW')
            ->where('list_status','=','Live')
            ->where('feature','=','1')
            ->get();                                    
            
            //$a = $featureVentures[5]->medias()->where('type', 'IMAGE')->pluck('id');//->pluck();            
            // return $featureVentures[5]->featuredImageId;
            // return $featureVentures[5]->medias()->where('type', 'IMAGE')->where('id',$featureVentures[5]->featuredImageId)->first()->file_name;
            // !is_null( && ($featureVenture->medias()->id  == $featureVenture->featuredImageId)
            $types = Config::get('constants.VENTURE_TYPE') ? Config::get('constants.VENTURE_TYPE') : [];
            return view('web.layouts.venture.newVentures.index', compact('newVentureListing','types','featureVentures'));
        }catch (\Exception $e) {
            return back();
        }
    }
    /* =========================================================================================
       Description: Method For User venture detail
       ----------------------------------------------------------------------------------------
       ========================================================================================== */

       public function show($id)
       {
        try
        {
            $streetAddress = '';
            $newVentureList = VentureListing::where('list_automated_id',$id)->first();            
            // $state=State::find($newVentureList->venture->venture_state);
            if($newVentureList->useMarker == 0)
            {
                $VD = $newVentureList->venture->ventureDetail;
                $streetAddress = $VD->property_street."+".$VD->property_city."+".Helper::getState($VD->property_state)."+".$VD->property_zip;
                $streetAddress = str_replace(' ', '+', $streetAddress);
            }
            else
            {
                $streetAddress = $newVentureList->latitude .','. $newVentureList->longitude;                
            }            
            // return $streetAddress;
            if(!is_null($newVentureList))
            {
                $ventureImages = [];
                $ventureListImages = $newVentureList->medias()->where('type', 'IMAGE')->get();
                // $ventureListDocuments = $newVentureList->medias()->where('type', null)->get();

                $ventureListDocuments = $newVentureList->medias()->where('visibility','Visible')
                                                                    ->where('document_type_id',19) // 19 = Property Summary
                                                                    ->where(function($query) {
                                                                        return $query->where('type','=',null)
                                                                        ->orWhere('type','=','FILE');
                                                                    })
                                                                    ->get();
                                                                    $ventureDocuments = $newVentureList->venture->medias()->where('visibility','Visible')
                                                                    ->where('document_type_id',19) // 19 = Property Summary
                                                                    ->where(function($query) {
                                                                        return $query->where('type','=',null)
                                                                        ->orWhere('type','=','FILE');
                                                                    })
                                                                    ->get();
                                                                    $ventureListDocuments = $ventureListDocuments->merge($ventureDocuments);

                                                                    if(!is_null($newVentureList->venture->medias()))
                                                                    {
                                                                        $ventureImages = $newVentureList->venture->medias()->where('type', 'IMAGE')->get();
                                                                    }
                                                                    return view('web.layouts.venture.newVentures.show',compact('newVentureList','ventureListImages','ventureImages','ventureListDocuments', 'streetAddress'));
                                                                }
                                                            }
                                                            catch (\Exception $e) 
                                                            {
                                                                return back();
                                                            }
                                                        }
        /* =========================================================================================
           Description: Method For Venture Search
           ----------------------------------------------------------------------------------------
           ========================================================================================== */

           public function ventureSearch(Request $request){
            $ventureList= Helper::ventureListSearch($request->all(),$type='NEW');
            $view = (string)view('web.layouts.venture.newVentures.partials.search_venture_row',compact('ventureList'));
            return response()->json([
                'view' => $view,
                'status' => true,
            ]);
        }
/* =========================================================================================
       Description: Method for User Venture Listing
       ----------------------------------------------------------------------------------------
       ========================================================================================== */

       public function ventureCommit(Request $request)
       {
        try 
        {
            $request->validate([
                'amount' => 'required'
            ]);

            $input = $request->all();
            $user = Auth::user();

            if(!isProfileComplete())
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Complete your profile first.'
                ]);
            }

            $ventureList = VentureListing::where('list_automated_id', $request->get('list_id'))->first();
            if (is_null($ventureList)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Listing not found!'
                ]);
            }
            else{
                $newVentureCommit = VentureCommit::where('new_venture_listing_id', '=', $ventureList->id)
                                            // TODO: For future reference ->where('status', '=', 'approval')
                ->sum('amount');
                if ($ventureList->venture->target_amount >= $newVentureCommit + $request->get('amount')) {
                    $percentage = $request->get('amount')/$ventureList->venture->target_amount;
                    $units = \App\Helpers\Helper::makeUnits($ventureList->id,$percentage);
                    $commitValue = [    
                        'amount' => $request->get('amount'),
                        'status' => Config::get('constants.VENTURE_COMMIT_STATUS')[0],
                        'unitStart' => $units['start'],
                        'unitEnd' => $units['end'] == "09999"? "10000" :$units['end']
                    ];
                    $commit = VentureCommit::create($commitValue);

                // Associating Listing
                    $commit->NewVentureListing()->associate($ventureList)->save();
                // Associating User
                    $commit->user()->associate($user)->save();


                //save logs
                // Save Offer Creation Log
                    $log = Log::create([
                        'title' => 'Commit Created!',
                        'description' => "Venture Commit # $commit->id Offer created by ".$user->name. " UserID#". $user->member_automated_id
                    ]);
                    $ventureList->logs()->save($log);

                    return response()->json([
                        'message' => 'Your Commit is Successfully Added!!',
                        'status' => true,
                    ]);
                } else {
                    $leftAmount = $ventureList->venture->target_amount - $newVentureCommit;
                    $currency= !is_null($leftAmount) ? formatCurrency($leftAmount) : '0.00';

                    return response()->json([
                        'message' => 'Sorry, we can only allow a maximum of Target Amount minus Commited Amount. Commit Amount should be '  . $currency. ' or less.',
                        'status' => false,
                    ]);
                }
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()//'Something went wring, While submitting offer request!'
            ]);
        }
    }
    /* =========================================================================================
           Description: Method for User Venture Listing
           ----------------------------------------------------------------------------------------
           ========================================================================================== */
           public function newVentureCommit()
           {

            try{
            $commits = VentureCommit::where('user_id','=', Auth::user()->id)->paginate($limit = 10, $columns = ['*']);//dd($commits);
            $i = 1;
            return view('web.layouts.venture.newVentures.commits',compact('commits','i'));
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /* =========================================================================================
   Description: Method for New Venture Listing commit popup
   ----------------------------------------------------------------------------------------
   ========================================================================================== */
   public function getCommitModal($id)
   {
    try {
        $ventureList = VentureListing::where('list_automated_id',$id)->first();

        if (is_null($ventureList)) {
            return response()->json([
                'status' => false,
                'message' => 'Listing not found!'
            ]);
        }
        $popup =  view('web.layouts.venture.newVentures.partials.commit_popup',compact('ventureList'))->render();

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


    /* =========================================================================================
    Description: Sending Document status emails
   ----------------------------------------------------------------------------------------
   ========================================================================================== */
   public function sendDocumentStatusEmails(Request $request)
   {
    try {
        $VentureCommit = VentureCommit::where('id',$request->get('commit_id'))->first();

        if (is_null($VentureCommit)) {
            return response()->json([
                'status' => false,
                'message' => 'Listing Commit not found!'
            ]);
        }

        $user = Auth::user();

        $document = $request->get('document_hash') ? $request->get('document_hash') : null;

        $data = ['status' => Config::get('constants.VENTURE_COMMIT_STATUS')[1]];
        if(!is_null($document)){
            $data['document_hash'] = $document;
        }
        $VentureCommit->update($data);
        $venture = $VentureCommit->NewVentureListing;

        $emailJob = (new \App\Jobs\Commitment\NewVentureCommitDocumentStatusEmails($user, $request->get('type'), $venture, $document))->delay(Carbon::now()->addSecond(5));
        dispatch($emailJob);

        return response()->json([
            'status' => true,
            'message' => 'Thank you, Your documents has been submitted and emailed you.',
        ]);

    } catch (\Exception $e) {
        dd($e);
        return response()->json([
            'status' => false,
            'message' => 'Something went wring, While sending emails!'
        ]);
    }
}

public function cancelCommit(Request $request)
{
    try
    {
        $commitId = $request->all();
        $commit = VentureCommit::find($commitId[0]);
        $commit->delete();

        return response()->json([
            'status' => true,
            'message' => 'Your Commitment is cancelled',
        ]);
    }
    catch (\Exception $e)
    {
        return response()->json([
            'status' => false,
            'message' => 'Could not delete your commit',
        ]);
    }
}   
}

