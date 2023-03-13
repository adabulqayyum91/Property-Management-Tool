<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Venture;
use App\Models\VentureManager;
use App\Helpers\Helper;

class VentureManagerController extends Controller
{
    public function index($id)
    {
        try
        {
            $venture = Venture::where('id',$id)->first();
            $userIds = VentureManager::where('venture_id',$id)->pluck('user_id');
            $ventureManagers = VentureManager::where('venture_id',$id)->with('user')->get();
        	$managers = Helper::propertyManagersNotIncluded($userIds);

            return view('admin.layouts.pages.ventureManagers.index',compact('ventureManagers','venture','managers'));
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
        	$ventureManager = VentureManager::create([
        						"user_id"=> $request->manager_id,
        						"venture_id"=>$request->venture_id
        					]);
            return redirect()->back()->with('success','Manager Added Successfully');
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
        	$ventureManager = VentureManager::where('id',$id)->delete();
            return redirect()->back()->with('success','Manager Removed Successfully');
        }
        catch (\Exception $e) 
        {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}
