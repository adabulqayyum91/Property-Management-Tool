<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\State;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Cashier\Cashier;
use Carbon\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\CancelSubscription;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $stripeSecret=Config::get('constants.STRIPE_SECRET');
            \Stripe\Stripe::setApiKey($stripeSecret);

            $currentUser = Auth::user();
            //get stripe plan
            $currentUserPlan=Plan::where('id','=',$currentUser->plan_id)->first();

            //get stripe card detail
            $billingInfo=null;
            $detail=null;
            $invoices=null;
            $subscription = null;
            if(!is_null($currentUser->defaultPaymentMethod())){
                $subscription=$currentUser->subscription('default')->asStripeSubscription();
                $detail = $currentUser->defaultPaymentMethod()->card;
                $billingInfo = $currentUser->defaultPaymentMethod()->billing_details;
                $invoices = $currentUser->invoices();
            }
            $plans = Plan::get();
            $states = State::get();
            return view('web.layouts.pages.profile', compact('currentUser', 'plans', 'detail', 'billingInfo', 'invoices','currentUserPlan','subscription','states'));
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
    public function unsubscribe(){
        try{
            $currentUser = Auth::user();
            $currentUser->subscription('default')->cancel();
            return response()->json([
                'status' => true,
                'message' => 'Plan Un subscribe Successfully!',
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {

        try{
            $input = $request->all();
            $currentUser = User::findorfail($id);
            if(isset($input['photo'])){
                if ($request->hasFile('photo')) {
                    $imageName = $this->fileUpload($request);
                    if($currentUser->photo && \File::exists(public_path('/uploads/user_profile/') . $currentUser->photo)){
                        unlink(public_path('/uploads/user_profile/') . $currentUser->photo);
                    }
                    $input['photo'] = $imageName;
                }
            }else{
                $input['photo'] = $currentUser->photo;
            }
            $currentUser->update($input);
            toastr()->success('Data successfuly updated');
            return back();
        }
        catch (\Exception $e) {
            // dd($e);
            return back()->withErrors($e->getMessage())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changePassword(Request $request, $id)
    {

        try {
            $messages = [
                'regex' => 'Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.',
            ];
            $validator = Validator::make($request->all(), [
                'old_password' => ['required', 'string', 'min:6', 'max:50'],
                'password' => 'required|string|min:6|max:50|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'confirm_password' => 'required|same:password',
            ],$messages);
            if ($validator->fails()) {
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }
            $input = $request->all();
            $user = User::find(auth()->user()->id);

            if (!Hash::check($input['old_password'], $user->password)) {
                toastr()->error('current password is not match');
                return back();
            } else {
                $user->password = bcrypt($request->get('password'));
                $user->save();
                toastr()->success('Password is successfuly  changed');
            }
            return back();
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    private function fileUpload($request)
    {
        try {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/user_profile');
            $image->move($destinationPath, $imageName);
            return $imageName;
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function accountDeleteRequest(Request $request)
    {
        try
        {
            $user = auth()->user();
            $reason = $request->reason_leaving;
            Mail::to('Sample@gmail.com')->send(new CancelSubscription($user, $reason));
            return response()->json([
                'status' => true,
                'message' => '
                Thank you for the time you were a member.
                We hope to have you as a part of our family in in the future.
                Please allow 2 business days to process your request.
                If you have quesitons, please email us at contact@gmail.com.
                Once we have cancelled your membership,
                we will send you a notice with any additional information you may need.
                ',
            ]);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }

        return $request->all();
    }
}
