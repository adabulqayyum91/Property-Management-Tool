<?php

namespace App\Http\Controllers\Admin;

use App\Follow;
use App\Http\Controllers\Controller;
use App\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
//            $allFollows = Follow::paginate(10);
            $allFollows = Follow::with('referrals')->paginate(10);
            return view('admin.layouts.pages.follows.follows',compact('allFollows'));
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
            $allFollows = Follow::all();
            $allReferral = Referral::all();
            return view('admin.layouts.pages.follows.create',compact('allFollows','allReferral'));
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
                'referral_id' => 'required|integer',
                'date_referral_first_contact' => 'required|date',
                'date_last_Contact' => 'required|date',
                'date_next_follow' => 'required|date',
                'comment' => 'required|min:2|max:191',
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $input = $request->all();
            Follow::create($input);
            return redirect('admin/follows');
        } catch (\Exception $e) {
//            dd($e);
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function show(Follow $follow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $currentFollow = Follow::find($id);
            $allReferral = Referral::all();
            return view('admin.layouts.pages.follows.edit',compact('currentFollow','allReferral'));
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $validator = Validator::make($request->all(), [
                'referral_id' => 'required|integer',
                'date_referral_first_contact' => 'required|date',
                'date_last_Contact' => 'required|date',
                'date_next_follow' => 'required|date',
                'comment' => 'required|min:2|max:191',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $input = $request->all();
            $currentFollow = Follow::findorfail($id);
            $currentFollow->update($input);
            return back();
        }
        catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $currentFollow = Follow::find($id);
            $currentFollow->delete();
            return back();
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}
