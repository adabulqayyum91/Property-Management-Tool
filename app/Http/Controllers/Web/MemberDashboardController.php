<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Plan;
use App\Models\Slider;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use App\Charts\UserChart;
use App\Models\User;
use App\Models\VentureRental;
use App\Models\VentureOwnership;
use App\Models\Venture;
use App\Helpers\Helper;
use Carbon\Carbon;

class MemberDashboardController extends Controller
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

            $currentYear = Carbon::now()->startOfYear()->format('Y-m-d');
            // LINE CHART
            $lineChart = new UserChart;
            $lineChart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
            $lineChart2 = new UserChart;
            $lineChart2->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);

            $ventureOwnerships = VentureOwnership::where('user_id',auth()->user()->id)->where('isDeleted',0)->has('venture')->get();

            $labels = [];
            $fillColors = [];
            $currentEsimatedValueArr=[];
            $sum = 0;
            foreach ($ventureOwnerships as $ownership) {
                if($ownership->venture)
                {
                    $rentalArray = [];
                    $estimatedValueArr = [];
                    
                    for($i=1;$i<=12;$i++)
                    {
                        $ventureRental =VentureRental::where('venture_id',$ownership->venture_id)
                                ->whereYear('date_rent_collected', date('Y'))
                                ->whereMonth('date_rent_collected','=', $i)
                                ->first();
                        if(!empty($ventureRental))
                            $rentalArray[] = $ventureRental->amount_collected* (Helper::percentageOwned($ownership->id)/100);
                        else
                            $rentalArray[] = 0;

                        $estimatedValueArr[] =  Helper::calculateApproximateValuation($ownership->id,$ownership->venture_id,Carbon::parse($currentYear)->addMonth($i-1)->format('Y-m-d'));

                    }
                    $lineChart->dataset($ownership->venture->venture_automated_id, 'line', $rentalArray)->options([
                        'fill' => 'true',
                        'borderColor' => Helper::dynamicColors(),//'#376bff'
                    ]);
                    $lineChart2->dataset($ownership->venture->venture_automated_id, 'line', $estimatedValueArr)->options([
                        'fill' => 'true',
                        'borderColor' => Helper::dynamicColors(),//'#51C1C0'
                    ]);

                    $fillColors[] = Helper::dynamicColors();
                    $labels[] = $ownership->venture->venture_automated_id;

                    $currentEsimatedValue = Helper::calculateCurrentApproximateValuation($ownership->id,$ownership->venture_id);
                    $currentEsimatedValueArr[] = $currentEsimatedValue;
                    $sum = $sum+$currentEsimatedValue;
                }
            }
            $percentages = Helper::getPercentageArr($currentEsimatedValueArr,$sum);

            // DONUT CHART
            // $borderColors = [
            // "rgba(255, 99, 132, 1.0)",
            // "rgba(22,160,133, 1.0)",
            // "rgba(255, 205, 86, 1.0)",
            // ];
            // $fillColors = [
            //     "rgba(255, 99, 132, 0.2)",
            //     "rgba(22,160,133, 0.2)",
            //     "rgba(255, 205, 86, 0.2)",
            // ];

            // return $labels;
            $userBarChart = new UserChart;
            $userBarChart->displayAxes(false);
            $userBarChart->labels($labels);
            $userBarChart->dataset('Ventures', 'doughnut', $percentages)->backgroundcolor($fillColors);
            // ->color($borderColors);
            // END DONUT CHART

            $ventureIds = VentureOwnership::where('user_id',auth()->user()->id)->where('isDeleted',0)->has('venture')->pluck('venture_id');
            $ventures = Venture::whereIn('id',$ventureIds)->get();


            $offersCount = $user->offers()->count();
            $receiveOffersCount = $user->ventureListings()->whereHas('offers')->with(['offers' => function($q) use($user){
                $q->whereHas('venture_listing')->where('user_id','!=',$user->id);
            }])->count();
            $buyNowCount = $user->buyNowListingRequests()->count();
            $buyNowReceivedCount = $user->ventureListings()->whereHas('BuyNow')->with(['BuyNow' => function($q) use($user){
                $q->whereHas('venture_listing')->where('user_id','!=',$user->id);
            }])->count();

            return view('web.memberDashboard',compact('offersCount','receiveOffersCount','buyNowCount','buyNowReceivedCount','lineChart','lineChart2','userBarChart','percentages','ventures'));
        }catch (\Exception $e) {
            dd($e);
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

}
