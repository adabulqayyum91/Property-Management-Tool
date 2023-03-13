<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\VentureCreate;
use App\Http\Requests\VentureUpdate;
use App\Models\Media;
use App\Models\User;
use App\Models\Venture;
use App\Models\VentureManager;
use App\Models\VentureOwnership;
use App\Models\VentureDetail;
use App\Models\Type;
use App\Models\Log;
use App\State;
use App\City;
use Illuminate\Http\Request;
use App\Repositories\VentureRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;


class VentureController extends Controller
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
    public function index()
    {
        try{
            $allVentures = $this->ventureRepository->paginate($limit = 10, $columns = ['*']);
            $i = 1;
            return view('admin.layouts.pages.ventures.ventures',compact('allVentures','i'));
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ventureTypes = Config::get('constants.VENTURE_TYPE') ? Config::get('constants.VENTURE_TYPE') : [];
        $ventureSourceTypes = Config::get('constants.VENTURE_SOURCE_TYPE') ? Config::get('constants.VENTURE_SOURCE_TYPE') : [];
        $documentTypes = Type::where('type','Document')->get();
        $states=State::all();
        return view('admin.layouts.pages.ventures.create',compact('documentTypes','states','ventureTypes','ventureSourceTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VentureCreate $request)
    {
        try{
            $user = Auth::user();

            // Creating Unique ID of Venture
            $ventureAutomatedID = 'V'.sprintf('%06d', (Venture::withTrashed()->count() + 1));
            $venture = [
                'venture_automated_id' => $ventureAutomatedID,
                'venture_name' => $request->get('venture_name'),
                'purchase_price' => $request->get('purchase_price'),
                'initial_cap' => $request->get('initial_cap'),
                'date_of_incorporation' => $request->get('date_of_incorporation')?Carbon::createFromFormat('m-d-Y', $request->get('date_of_incorporation'))->format('Y-m-d H:i:s'): null,
                'date_of_Purchase' => $request->get('date_of_Purchase')?Carbon::createFromFormat('m-d-Y', $request->get('date_of_Purchase'))->format('Y-m-d H:i:s'): null,
                'staff_manager' => $request->get('staff_manager'),
                'managing_member' => $request->get('managing_member'),
                'venture_street' => $request->get('venture_street'),
                'venture_city' => $request->get('venture_city'),
                'venture_state' => $request->get('venture_state'),
                'venture_zip' => $request->get('venture_zip'),
                'venture_status' => $request->get('venture_status'),
                'venture_type' => $request->get('venture_type'),
                'venture_source_type' => $request->get('venture_source_type'),
                'target_amount' => $request->get('target_amount'),
            ];
            // Creating venture here
            $venture = Venture::create($venture);

            $ventureDetail = [
                'property_management_company' => $request->get('property_management_company'),
                'property_management_contact' => $request->get('property_management_contact'),
                'property_management_street' => $request->get('property_management_street'),
                'property_management_phone' => $request->get('property_management_phone'),
                'property_management_city' => $request->get('property_management_city'),
                'property_management_state' => $request->get('property_management_state'),
                'property_management_zip' => $request->get('property_management_zip'),
                'property_street' => $request->get('property_street'),
                'property_city' => $request->get('property_city'),
                'property_state' => $request->get('property_state'),
                'property_zip' => $request->get('property_zip'),
            ];

            // Creating venture detail here
            $venture->ventureDetail()->create($ventureDetail);

            // Adding Medias Against Ventures
            if($request->hasFile('images')){
                foreach($request->file('images') as $image) {
                    $path = Config::get('constants.ventureMediaPath');
                    $fileName = Helper::saveImage($image, $maxWidth = null, $path,  $callback = null);
                    if($fileName){
                        $venture->medias()->create([
                            'file_name' => $fileName,
                            'type' => Config::get('constants.mediaImageType'),
                            'user_id' => $user->id,
                            'visibility' => 'Visible',
                        ]);
                    }
                }
            }

            // Adding Document Against Ventures
            if($request->hasFile('file')){
                $file = $request->file('file');
                $path = Config::get('constants.ventureMediaPath');
                $fileName = Helper::saveFile($file, $path);

                if($fileName){
                    $venture->medias()->create([
                        'title' => $request->get('documentName'),
                        'file_name' => $fileName,
                        'document_type_id' => $request->get('document_type_id'),
                        'type' => Config::get('constants.mediaDocumentType'),
                        'user_id' => $user->id,
                        'visibility' => $request->get('visibility'),
                        'date_of_document_to_apply' =>$request->get('date_of_document')?Carbon::createFromFormat('m-d-Y', $request->get('date_of_document'))->format('Y-m-d H:i:s'): null,
                    ]);
                }
            }


            // Save Ventures Creation Log
            $log = Log::create([
                'title' => 'Venture Created!',
                'description' => "Venture#$venture->venture_automated_id Updated By ".$user->name. " UserID#". $user->id
            ]);
            $venture->logs()->save($log);

            return response()->json([
                'status' => true,
                'message' => 'Venture successfully created!'
            ]);


        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\venture  $venture
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $currentVenture = $this->ventureRepository->find($id);
            return view('admin.layouts.pages.ventures.show',compact('currentVenture'));
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
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
            $currentVenture = $this->ventureRepository->find($request->get('id'));

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
            $data =  view('admin.layouts.pages.ventures.documentTab',compact('currentVenture','documentTypes'))->render();

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

    public function uploadImages(Request $request)
    {
        try{

            $this->validate($request, [
                'images' => 'required',
                'id' => 'required',
            ]);


            $user = Auth::user();
            $currentVenture = $this->ventureRepository->find($request->get('id'));

            // Adding Medias Against Ventures
            if($request->hasFile('images')){
                foreach($request->file('images') as $image) {
                    $path = Config::get('constants.ventureMediaPath');
                    $fileName = Helper::saveImage($image, $maxWidth = null, $path,  $callback = null);
                    if($fileName){
                        $currentVenture->medias()->create([
                            'file_name' => $fileName,
                            'type' => Config::get('constants.mediaImageType'),
                            'user_id' => $user->id,
                            'visibility' => 'Visible',
                        ]);
                    }
                }
            }

            $data =  view('admin.layouts.pages.ventures.imagesSection',compact('currentVenture'))->render();

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


    public function edit(Request $request,$id)
    {                
        try{
            // $property_managers = DB::table('users')->join('role_user','users.id','=','role_user.user_id')
            // ->where('role_id', 8)->get();           
            // // return var_dump($property_managers);
            $currentVenture = Venture::with('VentureDetail')->find($id);            
            
            $ventureTypes = Config::get('constants.VENTURE_TYPE') ? Config::get('constants.VENTURE_TYPE') : [];
            $ventureSourceTypes = Config::get('constants.VENTURE_SOURCE_TYPE') ? Config::get('constants.VENTURE_SOURCE_TYPE') : [];
            $documentTypes = Type::where('type','Document')->get();
            $states=State::all();    
            return view('admin.layouts.pages.ventures.edit',compact('currentVenture','documentTypes','states','ventureTypes','ventureSourceTypes'));   //
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\venture  $venture
     * @return \Illuminate\Http\Response
     */
    public function update(VentureUpdate $request, $id)
    {               
        try{
            // return $request->get('property_manager');

            $user = Auth::user();

            $ventureObj = Venture::find($id);

            $venture = [

                'venture_name' => $request->get('venture_name'),
                'purchase_price' => $request->get('purchase_price'),
                'initial_cap' => $request->get('initial_cap'),
                'date_of_incorporation' => $request->get('date_of_incorporation')?Carbon::createFromFormat('m-d-Y', $request->get('date_of_incorporation'))->format('Y-m-d H:i:s'): null,
                'date_of_Purchase' =>$request->get('date_of_Purchase')?Carbon::createFromFormat('m-d-Y', $request->get('date_of_Purchase'))->format('Y-m-d H:i:s'): null,
                'staff_manager' => $request->get('staff_manager'),
                'managing_member' => $request->get('managing_member'),
                'venture_street' => $request->get('venture_street'),
                'venture_city' => $request->get('venture_city'),
                'venture_state' => $request->get('venture_state'),
                'venture_zip' => $request->get('venture_zip'),
                'venture_status' => $request->get('venture_status'),
                'venture_type' => $request->get('venture_type'),
                'venture_source_type' => $request->get('venture_source_type'),
                'target_amount' => $request->get('target_amount'),
                // 'property_manager' => $request->get('property_manager')
            ];

            // Creating venture here
            $ventureObj->update($venture);

            $ventureDetail = [
                'property_management_company' => $request->get('property_management_company'),
                'property_management_contact' => $request->get('property_management_contact'),
                'property_management_street' => $request->get('property_management_street'),
                'property_management_phone' => $request->get('property_management_phone'),
                'property_management_city' => $request->get('property_management_city'),
                'property_management_state' => $request->get('property_management_state'),
                'property_management_zip' => $request->get('property_management_zip'),
                'property_street' => $request->get('property_street'),
                'property_city' => $request->get('property_city'),
                'property_state' => $request->get('property_state'),
                'property_zip' => $request->get('property_zip'),
            ];

            // Creating venture detail here
            $ventureObj->ventureDetail()->update($ventureDetail);

            // $vm = [
            //     'venture_id' => $id,
            //     'user_id' => $request->get('property_manager')
            // ];
            // $venture_manager = VentureManager::create($vm);

            // Save Ventures Creation Log
            $log = Log::create([
                'title' => 'Venture Created!',
                'description' => "Venture#$ventureObj->venture_automated_id Updated By ".$user->name. " UserID#". $user->id
            ]);
            $ventureObj->logs()->save($log);

            return response()->json([
                'status' => true,
                'message' => 'Venture successfully updated!'
            ]);

        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\venture  $venture
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if(!is_null($id)) {
                $currentVenture = $this->ventureRepository->find($id);
                if(!is_null($currentVenture)) {
                    $ownershipCount = VentureOwnership::where('venture_id',$id)
                                                    ->where('isDeleted',0)
                                                    ->count();
                    if(!$ownershipCount)
                    {
                        $currentVenture->delete();
                        return response()->json([
                            'status'=>true,
                            'message' => 'Venture deleted successfully!'
                        ]);
                    }
                    else
                    {
                        return response()->json([
                            'status' => false,
                            'message' => "This venture can not be deleted."
                        ]);
                    }
                }
            }
            return back();
        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function mediaStatusChange(Request $request)
    {
        try {
            $media = Media::find($request->get('mediaID'));

            if (is_null($media)) {
                return response()->json([
                    'status' => false,
                    'message' => 'File not found!'
                ]);
            }

            $media->update([
                'visibility' => ($media->visibility == 'Visible' ? 'Hidden' : 'Visible')
            ]);

            return response()->json([
                'status' => true,
                'message' => 'File status updated!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wring, While status updating!'
            ]);
        }
    }

    public function mediaStatusDelete(Request $request){
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

    public function downloadInformation(Request $request)
    {
        try{

            $this->validate($request, [
                'from' => 'required',
            ]);

            $from = Carbon::createFromFormat('m-d-Y',$request->get('from'))->format('Y-m-d');
            $to = Carbon::createFromFormat('m-d-Y',$request->get('to'))->format('Y-m-d');

            $currentVenture = $this->ventureRepository->find($request->get('id'));

            $documentTypes = Type::where('type','Document')->get();
            $data =  view('admin.layouts.pages.ventures.documentTab',compact('currentVenture','documentTypes', 'from', 'to'))->render();

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
    /* =========================================================================================
 Description:  Search New Venture List Method for New Venture Listing Index
 ----------------------------------------------------------------------------------------
 ========================================================================================== */

    public function searchVenture(Request $request)
    {
        try{
            $ventures = Helper::ventureSearchAdmin($request->all());
            $view = (string)view('admin.layouts.pages.ventures.partials.search_table_row',compact('ventures'));
            return response()->json([
                'view' => $view,
                'status' => true,
                'message' => 'venture Data successfully Updated!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }

    }
}

