<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Models\Log;
use App\Models\Plan;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Repositories\PlanRepository;

class PlanController extends Controller
{
    protected $repository;
    public function __construct(PlanRepository $repository)
    {
        $this->planRepository = $repository;

    }
    // Fetch all records from Plan Repository
    public function index()
    {
        try{
            $allPlans= $this->planRepository->paginate($limit = 10, $columns = ['*']);
            $priceSectionSetting = Setting::find(Setting::PRICE_SECTION_ID);
            $i = 1;
            return view('admin.layouts.pages.plans.plans',compact('allPlans','i','priceSectionSetting'));
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
        return view('admin.layouts.pages.plans.create');   //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanRequest $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:191',
                'price' => 'required|max:191',
                'description' => 'required|max:191',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $user = Auth::user();
            $plan=Plan::create($request->all());
            // Save Ventures Creation Log
            $log = Log::create([
                'title' => 'Plan Created!',
                'description' => "Plan#.$plan->id Created By ".$user->name. " UserID#". $user->id
            ]);
            $plan->logs()->save($log);

            return response()->json([
                'status' => true,
                'message' => 'Plan successfully created!'
            ]);


        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $currentPlan = $this->planRepository->find($id);
            return view('admin.layouts.pages.plans.show',compact('currentPlan'));
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        try{

            $currentPlan = $this->planRepository->find($id);
            return view('admin.layouts.pages.plans.edit',compact('currentPlan'));
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:191',
                'price' => 'required|numeric',
                'description' => 'required|max:191',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $this->planRepository->update([
                'name'=>$request->get('name'),
                'price'=>$request->get('price'),
                'description'=>$request->get('description'),
            ],$id);



            return back();
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {
        try{
            $plan = Plan::find($request->id);
            
            if (is_null($plan)) {
                return response()->json([
                    'status' => false,
                    'message' => "Plan does not exist"
                ],400);
            }
            $plan= Plan::where('id',$request->id)->update([
                            'status' => $request->status,
                        ]);

            return response()->json([
                    'status' => true,
                    'message' => 'Status was updated successfully!'
                ], 200);
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
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if(!is_null($id)) {
                $currentPlan = $this->planRepository->find($id);
                if(!is_null($currentPlan)) {
                    $currentPlan->delete();
                    return response()->json([
                        'status'=>true,
                        'message' => 'Plan deleted successfully!'
                    ]);
                }
                }
        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
