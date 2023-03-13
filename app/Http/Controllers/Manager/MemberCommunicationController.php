<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Communication;
use App\Models\VentureOwnership;
use App\Models\VentureManager;
use App\Models\Venture;
use App\Models\User;

use App\Helpers\Helper;
use Auth;

class MemberCommunicationController extends Controller
{
    
    public function index()
    {
    	$communication = Communication::where('to_user',auth()->user()->id)->has('venture')->latest()->paginate(5);
        $ventureIds = VentureManager::where('user_id',auth()->user()->id)->pluck('venture_id');
        $ventures = Venture::whereIn('id',$ventureIds)->get();

    	return view('manager.communication.list',compact('communication','ventures'));
    }

    public function show($id)
    {
		$communication = Communication::findOrFail($id);
		$communication->read_status = 1;
		$communication->save();
    	return view('manager.communication.show',compact('communication'));
    }

    public function storeCommunicationVO(Request $request)
    {
    	$venture_id = $request->venture_id;
    	$subject 	= $request->subject;
    	$body 		= $request->body;

    	$user 		= Auth::user();
    	$user_ids 	= VentureOwnership::where('venture_id',$venture_id)->where('isDeleted',0)->pluck('user_id');
    	$emails 	= User::whereIn('id',$user_ids)->pluck('email')->toArray();
    	$venture 	= Venture::where('id',$venture_id)->first();

    	$communicationObj = Helper::makeCommunicationObj($user->id,$user_ids,$venture_id,$subject,$body);
    	$insert = Communication::insert($communicationObj);

    	// Send Email
    	Helper::sendCommunicationEmail($request,$user,$venture,$emails);

    	return redirect()->back()->with('success','Message Sent Successfully');
    }
	
	public function bulkDestroy(Request $request)
	{
		$result = $request->ids;
		
		$status = Communication::whereIn('id',explode(",",$result))->delete();	
		if($status)
		{
			return response()->json([
				'message' => "Deleted Successfully",
				'status' => true,
			]);
		}	
		else{
			return response()->json([
				'message' => "There was an error deleting",
				'status' => false,
			]);
		}
	}

    public function communicationSearch(Request $request)
    {
        try{
            $communication = Helper::communicationSearch($request->all());
            $view = (string)view('manager.communication.search_table_row',compact('communication'));
            return response()->json([
                'view' => $view,
                'status' => true,
                'message' => 'Inbox data successfully updated!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
