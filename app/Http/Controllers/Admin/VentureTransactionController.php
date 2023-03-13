<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Venture;
use App\Models\Transaction;
use App\Models\User;
use App\Models\VentureOwnership;
use App\Helpers\Helper;

use Carbon\Carbon;

class VentureTransactionController extends Controller
{
    public function index($id)
    {
        try
        {
            $venture = Venture::where('id',$id)->first();
            $transactions = Transaction::where('venture_id',$id)->get();
            $ventureOwnership  = VentureOwnership::where('venture_id',$id)->get();
            
            $userIds  = VentureOwnership::where('venture_id',$id)->where('isDeleted',0)->pluck('user_id');
            $users  = User::whereIn('id',$userIds)->get();
            return view('admin.layouts.pages.transactions.index',compact('transactions','venture','users','ventureOwnership'));
        }
        catch (\Exception $e) 
        {
        	dd($e);
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function store(Request $request)
    {
        try
        {
        	$ventureOwnership = VentureOwnership::where('id',$request->ownership_id)->first();
            $dateTime = Carbon::createFromFormat('m/d/Y', $request->date_time)->format('Y-m-d');
            $ventureManager = Transaction::create([
              "user_id"   =>$ventureOwnership->user_id,
              "venture_id"=>$request->venture_id,
              "ownership_id"=>$request->ownership_id,
              "label"		=>$request->label,
              "type"		=>$request->type,
              "value"		=>$request->value,
              "date_time"	=>$dateTime,
              "note"		=>$request->note,
          ]);
            return redirect()->back()->with('success','Transaction Added Successfully');
        }
        catch (\Exception $e) 
        {
        	dd($e);
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function update(Request $request)
    {
        try
        {
            $ventureOwnership = VentureOwnership::where('id',$request->ownership_id)->first();
            $dateTime = Carbon::createFromFormat('m/d/Y', $request->date_time)->format('Y-m-d');
            $transaction = Transaction::where('id',$request->id)
            ->update([
                "user_id"   =>$ventureOwnership->user_id,
                "ownership_id"=>$request->ownership_id,
                "label"     =>$request->label,
                "type"      =>$request->type,
                "value"     =>$request->value,
                "date_time" =>$dateTime,
                "note"      =>$request->note,
            ]);

            return redirect()->back()->with('success','Transaction Updated Successfully');
        }
        catch (\Exception $e) 
        {
            dd($e);
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function delete($id)
    {
        try
        {
        	$ventureTransaction = Transaction::where('id',$id)->delete();
            return redirect()->back()->with('success','Transaction Removed Successfully');
        }
        catch (\Exception $e) 
        {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}
