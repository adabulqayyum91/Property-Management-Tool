<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\Venture;
use App\Models\VentureListing;
use App\Models\VentureOwnership;
use App\Models\VentureRental;

use App\Helpers\Helper;
use Carbon\Carbon;

class HomeController extends Controller
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
    public function index()
    {
        try{
            // Date Values
            $today  =  Carbon::now()->format('Y-m-d');
            $sevenDayBefore = Carbon::parse($today)->subDay(7)->format('Y-m-d');
            $thirtyDayBefore = Carbon::parse($today)->subDay(30)->format('Y-m-d');


            // Users Counters
            $userIds        = UserRole::where('role_id',Role::USER)->pluck('user_id');
            $totalUsers     = User::whereIn('id',$userIds)
                                ->count();
            $todayUsers     = User::whereIn('id',$userIds)
                                ->whereDate('created_at',$today)
                                ->count();
            $sevenDayUsers  = User::whereIn('id',$userIds)
                                ->whereDate('created_at','>=',$sevenDayBefore)
                                ->whereDate('created_at','<=',$today)
                                ->count();
            $thirtyDayUsers = User::whereIn('id',$userIds)
                                ->whereDate('created_at','>=',$thirtyDayBefore)
                                ->whereDate('created_at','<=',$today)
                                ->count();

            // Ventures Counters
            $totalVentures      = Venture::count();
            $todayVentures      = Venture::whereDate('created_at',$today)
                                    ->count();
            $sevenDayVentures   = Venture::whereDate('created_at','>=',$sevenDayBefore)
                                    ->whereDate('created_at','<=',$today)
                                    ->count();
            $thirtyDayVentures  = Venture::whereDate('created_at','>=',$thirtyDayBefore)
                                    ->whereDate('created_at','<=',$today)
                                    ->count();

            // New Ventures Listing Counters
            $type = VentureListing::TYPE_NEW;
            $totalNewVentures      = VentureListing::where('type', $type)
                                            ->count();
            $todayNewVentures      = VentureListing::where('type', $type)
                                            ->whereDate('created_at',$today)
                                            ->count();
            $sevenDayNewVentures   = VentureListing::where('type', $type)
                                            ->whereDate('created_at','>=',$sevenDayBefore)
                                            ->whereDate('created_at','<=',$today)
                                            ->count();
            $thirtyDayNewVentures  = VentureListing::where('type', $type)
                                            ->whereDate('created_at','>=',$thirtyDayBefore)
                                            ->whereDate('created_at','<=',$today)
                                            ->count();

            // Current Ventures Listing Counters
            $type = VentureListing::TYPE_CURRENT;
            $totalCurrentVentures      = VentureListing::where('type', $type)
                                            ->count();
            $todayCurrentVentures      = VentureListing::where('type', $type)
                                            ->whereDate('created_at',$today)
                                            ->count();
            $sevenDayCurrentVentures   = VentureListing::where('type', $type)
                                            ->whereDate('created_at','>=',$sevenDayBefore)
                                            ->whereDate('created_at','<=',$today)
                                            ->count();
            $thirtyDayCurrentVentures  = VentureListing::where('type', $type)
                                            ->whereDate('created_at','>=',$thirtyDayBefore)
                                            ->whereDate('created_at','<=',$today)
                                            ->count();

            // Valuation Statistics
            $totalPurchasePrice  = Venture::sum('purchase_price');
            $ventureOwnerships = VentureOwnership::where('isDeleted',0)->get();
            $estimatedValue = 0;
            foreach ($ventureOwnerships as $ventureOwnership) 
            {
                $estimatedValue += Helper::calculateCurrentApproximateValuation($ventureOwnership->id,$ventureOwnership->venture_id);
            }

            $currentDate = Carbon::now()->format('Y-m-d');
            $monthRentalIncome = VentureRental::whereMonth('date_rent_collected',$currentDate)
                                            ->whereYear('date_rent_collected',$currentDate)
                                            ->sum('amount_collected');
            $totalRentalIncome = VentureRental::sum('amount_collected');


            $totalMembersWithOwnership = VentureOwnership::where('isDeleted',0)->distinct()->pluck('user_id')->count();

            if($totalMembersWithOwnership>0)
                $averagePortfolioValue = $estimatedValue/$totalMembersWithOwnership;
            else
                $averagePortfolioValue = 0;
            
            $counters = [
                            "totalUsers"            => $totalUsers,
                            "todayUsers"            => $todayUsers,
                            "sevenDayUsers"         => $sevenDayUsers,
                            "thirtyDayUsers"        => $thirtyDayUsers,
                            "totalVentures"         => $totalVentures,
                            "todayVentures"         => $todayVentures,
                            "sevenDayVentures"      => $sevenDayVentures,
                            "thirtyDayVentures"     => $thirtyDayVentures,
                            "totalNewVentures"      => $totalNewVentures,
                            "todayNewVentures"      => $todayNewVentures,
                            "sevenDayNewVentures"   => $sevenDayNewVentures,
                            "thirtyDayNewVentures"  => $thirtyDayNewVentures,
                            "totalCurrentVentures"      => $totalCurrentVentures,
                            "todayCurrentVentures"      => $todayCurrentVentures,
                            "sevenDayCurrentVentures"   => $sevenDayCurrentVentures,
                            "thirtyDayCurrentVentures"  => $thirtyDayCurrentVentures,
                            "estimatedValue"            => $estimatedValue,
                            "totalPurchasePrice"        => $totalPurchasePrice,
                            "monthRentalIncome"         => $monthRentalIncome,
                            "totalRentalIncome"         => $totalRentalIncome,
                            "averagePortfolioValue"     => $averagePortfolioValue,
                        ];
            return view('admin.layouts.pages.home',compact('counters'));
        }catch (\Exception $e) {
            dd($e);
            return back()->withErrors($e->getMessage())->withInput();
        }
    }


}
