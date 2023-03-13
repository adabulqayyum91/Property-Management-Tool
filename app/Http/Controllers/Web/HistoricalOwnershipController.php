<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Venture;
use App\Models\Transaction;
use App\Models\User;
use App\Models\VentureOwnership;
use App\Models\VentureRental;
use App\Helpers\Helper;

use Carbon\Carbon;

class HistoricalOwnershipController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            $from = $request->from;
            $to = $request->to;
            $venture_name="";

            if(isset($from) && $from!= null )
            {
                $fromDate = Carbon::createFromFormat('m/d/Y', $from)->format('Y-m-d');
            }
            if(isset($to) && $to!= null)
            {
                $toDate = Carbon::createFromFormat('m/d/Y', $to)->format('Y-m-d');
            }

            $userId = auth()->user()->id;

            if(isset($request->venture_name) && $request->venture_name!= null )
            {
                $venture_name = $request->venture_name;
                $ventureOwnerships = VentureOwnership::where('user_id',$userId)
                ->wherehas('venture', function ($query) use ($venture_name) {
                    $query->where('venture_name', 'like', '%' . $venture_name . '%');
                })->get();
            }
            else
            {
                $ventureOwnerships = VentureOwnership::where('user_id',$userId)
                ->has('venture')
                ->get();
            }



            $arr = [];
            $totalRentalIncome = 0;
            foreach ($ventureOwnerships as $key => $onwership) 
            {
                $ownership_begin_date =  Carbon::parse($onwership->ownership_begin_date)->format('Y-m-d');
                $ventureId = $onwership->venture_id;
                $ownershipId = $onwership->id;


                $transactions = Transaction::where('ownership_id',$ownershipId);

                if(isset($from) && $from!= null)
                    $transactions  =  $transactions->whereDate('date_time','>=',$fromDate);
                if(isset($to) && $to!= null)
                    $transactions  =  $transactions->whereDate('date_time','<=',$toDate);

                $transactions  =  $transactions->get();

                $ventureRentals = VentureRental::where('venture_id',$ventureId);

                if(isset($from) && $from!= null)
                    $ventureRentals  =  $ventureRentals->whereDate('date_rent_collected','>=',$fromDate);
                if(isset($to) && $to!= null)
                    $ventureRentals  =  $ventureRentals->whereDate('date_rent_collected','<=',$toDate);


                if($onwership->isDeleted == 1)
                {
                    $ownership_end_date =  Carbon::parse($onwership->deleted_at)->format('Y-m-d');

                    $ventureRentals  =  $ventureRentals->whereDate('date_rent_collected','>=',$ownership_begin_date)->whereDate('date_rent_collected','<=',$ownership_end_date);
                }
                else
                {
                    $ventureRentals  =  $ventureRentals->whereDate('date_rent_collected','>=',$ownership_begin_date);
                }
                $ventureRentals  =  $ventureRentals->get();

                foreach ($ventureRentals as $key => $data) {
                  $rentalIncome = $data->net_income*(Helper::percentageOwnedByObj($onwership)/100);
                  $arr[] = [
                     "date" => Helper::carbonParseFormat($data->date_rent_collected),
                     "venture" => $data->venture,
                     "label" => 'Rental Income',
                     "debit" => 0,
                     "credit"=> $rentalIncome
                 ];
                 $totalRentalIncome += $rentalIncome;
             }

             foreach ($transactions as $key => $data) {
                $arr[] = [
                 "date" => Helper::carbonParseFormat($data->date_time),
                 "venture" => $data->venture,
                 "label" => $data->label,
                 "debit" => $data->type==0?$data->value:0,
                 "credit"=> $data->type==1?$data->value:0
             ];
         }	
     }

     $collection = collect($arr);
     $lookups = $collection->sortBy('date')->values()->all();

     return view('web.layouts.historicalOwnership.index',compact('lookups','totalRentalIncome','from','to','venture_name'));
 }
 catch (\Exception $e) 
 {
   dd($e);
   return back()->withErrors($e->getMessage())->withInput();
}
}
}
