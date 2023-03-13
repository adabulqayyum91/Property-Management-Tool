<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\Helper;

// Models
use App\Models\Venture;
use App\Models\VentureRental;

class VentureRentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        try{
            $venture = Venture::where('id',$id)->first();
            $ventureRentals = VentureRental::where('venture_id',$id)->orderBy('date_rent_collected', 'desc')->get();
            return view('admin.layouts.pages.ventureRentals.index',compact('ventureRentals','venture'));
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function store(Request $request)
    {
        // return $request;
        try{

            $request->date_rent_collected = \Carbon\Carbon::parse($request->date_rent_collected)->format('Y-m-d');
            $request->net_income = $request->amount_collected + $request->fees_and_other_income - $request->management_fee - $request->repairs_and_other_expenses;
            $obj = [
                "venture_id" => $request->venture_id,
                "date_rent_collected"=>$request->date_rent_collected,
                "rent_due" => Helper::ifNullReturnZero($request->rent_due),
                "amount_collected" => Helper::ifNullReturnZero($request->amount_collected),
                "rent_past_due" => Helper::ifNullReturnZero($request->rent_past_due),
                "fees_and_other_income" => Helper::ifNullReturnZero($request->fees_and_other_income),
                "management_fee" => Helper::ifNullReturnZero($request->management_fee),
                "repairs_and_other_expenses" => Helper::ifNullReturnZero($request->repairs_and_other_expenses),
                "net_income" => Helper::ifNullReturnZero($request->net_income),
            ];
            // return $obj;
            $ventureRentals = VentureRental::create($obj);
            return redirect()->back()->with('success','Data updated successfully.');
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function delete($id)
    {
        try{

            $ventureRentals = VentureRental::where('id',$id)->delete();
            return redirect()->back()->with('success','Data deleted successfully.');
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}
