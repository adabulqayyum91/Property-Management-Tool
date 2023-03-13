<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Plan;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Video;

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
    public function index() {
        try{
            $allSliders = Slider::get();
            $currentVideo = Video::first();
            $plans = Plan::where('status',1)->get();
            $priceSectionSetting = Setting::find(Setting::PRICE_SECTION_ID);
            return view('web.layouts.pages.home.home',compact('allSliders','currentVideo','plans','priceSectionSetting'));
        }catch (\Exception $e) {
            dd($e);
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
    public function faqs(){
        try{
            $allFaqs = Faq::get();
            $plans = Plan::get();

            return view('web.layouts.pages.faqs',compact('allFaqs','plans'));
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
    public function company()
    {
        try{
            $plans = Plan::get();

            return view('web.layouts.pages.company',compact('plans'));
        }catch (\Exception $e){
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

}
