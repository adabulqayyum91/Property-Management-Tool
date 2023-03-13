<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\ReferralUserRequest;
use App\Models\Log;
use App\Models\ReferralUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferralUserController extends Controller
{

    /* =========================================================================================
     Description:  Referral Friends list
     ----------------------------------------------------------------------------------------
     ========================================================================================== */

    public function index()
    {
        try {
            $referral = ReferralUser::paginate(10);

            return view('admin.layouts.pages.referralUsers.index', compact('referral'));
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /* =========================================================================================
     Description:  Referral Friends Create Page
     ----------------------------------------------------------------------------------------
     ========================================================================================== */
    public function create()
    {
        return view('admin.layouts.pages.referralUsers.create');
    }

    /* =========================================================================================
     Description:  Referral Friends Store Data From create Page
     ----------------------------------------------------------------------------------------
     ========================================================================================== */

    public function store(ReferralUserRequest $request)
    {

        try {
            //create Referral User
            $referralUser = ReferralUser::create($request->all());
            $user = Auth::user();

            // Save Referral User Creation Log
            $log = Log::create([
                'title' => 'Friend Referral Created!',
                'description' => "Friend Referral #$referralUser->id Created By ".$user->name. " UserID#". $user->id
            ]);
            $referralUser->logs()->save($log);
            return response()->json(['status' => true,
                'message' => 'Friend Referral Added Successfully!']);

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /* =========================================================================================
        Description: Single Friends Refferal Method
        ----------------------------------------------------------------------------------------
        ========================================================================================== */

    public function show($id)
    {
        try {
            $refferal = ReferralUser::find($id);
            return view('admin.layouts.pages.referralUsers.show', compact('refferal'));
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /* =========================================================================================
    Description: update Friends Refferal status Method
    ----------------------------------------------------------------------------------------
    ========================================================================================== */

    public function referralStatus(Request $request)
    {
        try {
            $referral = ReferralUser::findorfail($request->get('id'));
            if(!is_null($referral)) {
                $referral->update([
                    'status' => $request->get('status')
                ]);
                return response()->json(['status' => true, 'message' => 'Referral Updated with Status ' . $referral->status . '!!']);

            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }

    }
    /* =========================================================================================
        Description: Delete single Friends Refferal method
        ----------------------------------------------------------------------------------------
        ========================================================================================== */

    public function destroy($id)
    {
        try {
            if(!is_null($id)) {
                $referral=ReferralUser::findorfail($id);
                if(!is_null($referral)) {
                    $name=$referral->name;
                    $referral->delete();
                    return response()->json([
                        'status'=>true,
                        'message' => 'Referral Friend('.$name.') deleted successfully.'
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
