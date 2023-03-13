<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\status;
use App\Models\User;
use App\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $allReferrals = Referral::with('statuses','users')->paginate(10);
//            dd($allReferrals);
            return view('admin.layouts.pages.referrals.referrals',compact('allReferrals'));
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
        try{
            $allStatuses = status::where('type','Referral')->get();
            $allUsers = User::all();
            return view('admin.layouts.pages.referrals.create',compact('allStatuses','allUsers'));
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|integer',
                'status_id' => 'required|integer',
                'first_name' => 'required|string|min:2|max:191',
                'last_name' => 'required|string|min:2|max:191',
                'phone' => 'required|min:2|max:15',
                'email' => 'required|unique:referrals',
                'referred_by_name' => 'required|string|min:2|max:191',
                'referred_by_id' => 'required|integer',
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $input = $request->all();
            Referral::create($input);
            return redirect('admin/referrals');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $currentReferral = Referral::find($id);
            $allStatuses = status::where('type','Referral')->get();
            $allUsers = User::all();
            return view('admin.layouts.pages.referrals.edit',compact('currentReferral','allStatuses','allUsers'));
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|integer',
                'status_id' => 'required|integer',
                'first_name' => 'required|string|min:2|max:191',
                'last_name' => 'required|string|min:2|max:191',
                'phone' => 'required|min:2|max:15',
                'referred_by_name' => 'required|string|min:2|max:191',
                'referred_by_id' => 'required|integer',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $input = $request->all();
            $currentReferral = Referral::findorfail($id);
            $currentReferral->update($input);
            return back();
        }
        catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $currentReferral = Referral::find($id);
            $currentReferral->delete();
            return back();
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}
