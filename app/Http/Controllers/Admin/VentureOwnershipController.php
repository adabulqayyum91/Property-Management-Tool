<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Helper
use App\Helpers\Helper;
use App\Helpers\Message;

// Models
use App\Models\Venture;
use App\Models\VentureOwnership;


// Carbon
use Carbon\Carbon;
class VentureOwnershipController extends Controller
{
    public function index($id)
    {
        try
        {
            $venture = Venture::where('id',$id)->first();
            $ventureOwnerships = VentureOwnership::where('venture_id',$id)->where('isDeleted',0)->get();
            return view('admin.layouts.pages.ventureOwnerships.index',compact('ventureOwnerships','venture'));
        }
        catch (\Exception $e) 
        {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function delete($id)
    {
        try
        {
            $ventureOwnerships = VentureOwnership::where('id',$id)->update([
                "isDeleted" => 1,
                "deleted_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            return response()->json([
                'status' => true,
                'message' => Message::DELETE_SUCCESS
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

    public function update(Request $request)
    {
    	try
        {
            $ventureOwnership = VentureOwnership::where('id',$request->id)
            ->first();

            $limits = [
                $request->ownership_sequence_start,
                $request->ownership_sequence_end
            ];
            $existedSequenceCount = VentureOwnership::where('venture_id',$ventureOwnership->venture_id)
            ->where('id','!=',$ventureOwnership->id)
            ->where(function ($query) use ($limits){
                $query->whereBetween('ownership_sequence_start',$limits)
                ->orWhereBetween('ownership_sequence_end',$limits);
            })
            ->where('isDeleted',0)
            ->count();
            if($existedSequenceCount==0)
            {
                $ventureOwnership->ownership_sequence_start = $request->ownership_sequence_start;
                $ventureOwnership->ownership_sequence_end = $request->ownership_sequence_end;
                $ventureOwnership->save();

                return response()->json([
                    'status' => true,
                    'message' => Message::OWNERSHIP_UPDATE_SUCCESS,
                ]);
            }
            else
            {
                return response()->json([
                    'status' => false,
                    'message' => Message::SEQUENCE_CLASHED
                ]);
            }
        }
        catch (\Exception $e) 
        {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
