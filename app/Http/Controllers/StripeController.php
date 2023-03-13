<?php
/**
 * Created by PhpStorm.
 * User: Transdata
 * Date: 3/21/2020
 * Time: 12:33 PM
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\VerifyMail;
use App\Models\Plan;
use App\Models\User;
use App\Models\UserPlan;
use App\Models\VerifyUser;
use App\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use App\Jobs\SendRegisterataionEmail;
use Illuminate\Support\Facades\Config;
use App\Notifications\VerificationEmail;

class StripeController extends Controller
{
    /* =========================================================================================
       Description: Method when User select join now and fill stripe detail
       ----------------------------------------------------------------------------------------
       ========================================================================================== */

    public function stripeStore(Request $request)
    {
        try {
        // Handle post-payment fulfillment
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'about_us_source' => 'required',
            'phone' => 'required',
            'manage_income_property' => 'required|in:1,0',
            'interest' => 'required',
            'contact_timing' => 'required',
            'plan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $input = $request->all();

        //make plan in stripe dashboard
        $plan= Plan::find(decrypt($request->get('plan')));

        if(is_null($plan)){
            return response()->json(['status' => false, 'message' => 'Please select valid plan!'], 403);
        }
            $stripeSecret=Config::get('constants.STRIPE_SECRET');
            \Stripe\Stripe::setApiKey($stripeSecret);
        $stripePlan= \Stripe\Plan::create(array(
            "amount" =>$plan->price*100,
            "interval" => $plan->plan_type,
            "product" => array(
                "name" => $plan->name,
            ),
            "currency" => "usd",
            "billing_scheme"=> "per_unit",
            "nickname"=>$plan->name
        ));
        $input['password'] = Hash::make($input['password']);
        $input['name'] = $input['first_name'] . ' ' . $input['last_name'];
        $input['plan_id'] = $input['plan'];
        // Creating Unique ID of Venture
        $input['member_automated_id'] = 'M' . sprintf('%06d', (User::withTrashed()->count() + 1));
        //create user
        $user = User::create($input);
        //create user role
            $role=Role::whereName('User')->first();
            $user->attachRole($role);
        VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1(time())
        ]);
            //create user plan
            $userPlan= UserPlan::create ([
                'user_id' => $user->id,
                'plan_id' => $input['plan'],
                'token' => $stripePlan->id
            ]);
        //user verification
        // $user->markEmailAsVerified();

        //save user_id for catch case in sessions
        \Session::put('key', $user->id);

        //if user already subscribed
        if ($user->subscribedToPlan('default',  $stripePlan->id)) {
            dispatch(new SendRegisterataionEmail($user));
            \Session::forget('key');
            return response()->json(
                ['status' => true, 'message' => 'You Are Registered Successfully, and you are already subscribed the plan'], 200);
        }else {
        // user created and subscribed
        $user->newSubscription('default',  $stripePlan->id)
            ->create($request->get('stripeToken'));
            dispatch(new SendRegisterataionEmail($user));
            \Session::forget('key');
            return response()->json(
            ['status' => true, 'message' => 'We have sent a verification email to your email address. Please verify this email address before logging in. Thank you!'], 200);

    }

    } catch (\Exception $e) {
        $val=\Session::get('key');
        //delete user if any error occur in try section
        if(!is_null($val)) {
            $data = User::where('id', '=', $val)->first();
            if(!is_null($data)) {
                $data->forceDelete();
            }
            //delete user verification if any error occur in try section
            VerifyUser::whereUserId($val)->forceDelete();
            //delete user role if any error occur in try section
            UserRole::whereUserId($val)->forceDelete();
        }

            // forget the key in session
        \Session::forget('key');
        return response()->json(
            ['message' => $e->getMessage(), 'stripeStatus' => false], 200);
        }
}

    /* =========================================================================================
          Description: Method when User select plan and fill stripe detail on get started popup
          ----------------------------------------------------------------------------------------
          ========================================================================================== */

    public function getStartedStripeStore(Request $request)
    {

        try
        {
            // Handle post-payment fulfillment
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required',
                'plan' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()]);
            }
            $input = $request->all();

            //make plan in stripe dashboard
            $plan= Plan::find(decrypt($request->get('plan')));

            if(is_null($plan)){
                return response()->json(['status' => false, 'message' => 'Please select valid plan!'], 403);
            }
            $stripeSecret=Config::get('constants.STRIPE_SECRET');
            \Stripe\Stripe::setApiKey($stripeSecret);
            $stripePlan= \Stripe\Plan::create(array(
                "amount" =>$plan->price*100,
                "interval" => $plan->plan_type,
                "product" => array(
                    "name" => $plan->name,
                ),
                "currency" => "usd",
                "billing_scheme"=> "per_unit",
                "nickname"=>$plan->name
            ));

            $name = explode('@', $input['email'])[0];
            $input['password'] = Hash::make($input['password']);
            $input['plan_id'] = $plan->id;
            $input['name'] = $name;
            // Creating Unique ID of Venture
            $input['member_automated_id'] = 'M' . sprintf('%06d', (User::withTrashed()->count() + 1));
            //create user
            $user = User::create($input);
            //create user role
            $role=\App\Models\Role::whereName('User')->first();
            $user->attachRole($role);
            VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            //create user plan
            $userPlan= UserPlan::create ([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                // 'token' => $stripePlan->id
                'stripe_plan_id' => $stripePlan->id
            ]);
            //user verification
            // $user->markEmailAsVerified();

            //save user_id for catch case in sessions
            \Session::put('key', $user->id);

            //if user already subscribed
            if ($user->subscribedToPlan('default',  $stripePlan->id))
            {
                // TODO: Old logic for future use
                // dispatch(new SendRegisterataionEmail($user));
                $user->notify(new VerificationEmail());

                \Session::forget('key');
                return response()->json(
                    ['status' => false, 'message' => 'You Are Registered Successfully, and you are already subscribed the plan'], 200);
            }
            else
            {
                // user created and subscribeds
                $user->createAsStripeCustomer(["name"=>$input['first_name'].' '.$input['last_name']]);
                // $user->updateStripeCustomer(['name' => $input['name']]);
                $user->newSubscription('default', $stripePlan->id)
                        ->create($input['stripeToken']);

                // TODO: Old logic for future use
                // dispatch(new SendRegisterataionEmail($user));
                $user->notify(new VerificationEmail());

                \Session::forget('key');
                return response()->json(
                   ['status' => true, 'message' => 'We have sent a verification email to your email address. Please verify this email address before logging in. Thank you!'], 200);
            }
        }
        catch (\Exception $e)
        {
            $val=\Session::get('key');
            //delete user if any error occur in try section
            if(!is_null($val))
            {
                $data = User::where('id', '=', $val)->first();
                if(!is_null($data)) {
                    $data->forceDelete();
                }

                //delete user verification if any error occur in try section
                VerifyUser::whereUserId($val)->forceDelete();
                //delete user role if any error occur in try section
                UserRole::whereUserId($val)->forceDelete();
            }

            // forget the key in session
            \Session::forget('key');
            return response()->json(
                ['message' => $e->getMessage(), 'stripeStatus' => false], 200);
        }
    }

    /* =========================================================================================
          Description: Method when User  fill stripe detail on user profile and
            add stripe add in customer as default
          ----------------------------------------------------------------------------------------
      ========================================================================================== */

    public function stripeUpdate(Request $request)
    {
        try {
            $data = $request->all();
            $user = User::find($data['user_id']);
            $user->updateDefaultPaymentMethod($data['stripeToken']);
            return response()->json(
                ['status' => true, 'message' => 'Your New Card is Added and set as default successfully!!!'], 200);
        } catch (\Exception $e) {
            return response()->json(
                ['message' => $e->getMessage()], 200);

        }
    }

    /* =========================================================================================
           Description: Method when User download stripe
           ----------------------------------------------------------------------------------------
       ========================================================================================== */

    public function downloadStripeInvoice($userId, $invoiceId, $productName, $inv_no)
    {
        $user = User::find($userId);
        return $user->downloadInvoice($invoiceId, [
            'vendor' => 'Property Management Tool',
            'product' => $productName,
            'id' => $inv_no,
            'description' => 'Property Management Tool',
        ]);
    }

    /* =========================================================================================
           Description: Method when user login through google r facebook redirect with this page
            for stripe payment (pending for client approval)
           ----------------------------------------------------------------------------------------
       ========================================================================================== */

    public function socialLoginPayment(Request $request)
    {
        $data = $request->all();
        $user = User::find($data['user_id']);
//        $user->markEmailAsVerified();
//
        if ($user->subscribedToPlan('default', $request->get('plan'))) {
            dispatch(new SendRegisterataionEmail($user));
            return response()->json(
                ['status' => true, 'message' => 'You Are Registered Successfully, and you are already subscribed the plan'], 200);

        }

        $user->newSubscription('default', $request->get('plan'))
            ->create($request->get('stripeToken'));
            dispatch(new SendRegisterataionEmail($user));
        return response()->json(
            ['status' => true, 'message' => 'We have sent a verification email to your email address. Please verify this email address before logging in. Thank you!'], 200);

    }

    /* =========================================================================================
           Description: Stripe form after google r facebook login
           ----------------------------------------------------------------------------------------
       ========================================================================================== */

    public function StripePayment()
    {
        $plans = Plan::get();
        return view('auth.paymentForm', compact('plans'));
    }

    public function socialStripeStore(Request $request){
        try {
            // Handle post-payment fulfillment
            $validator = Validator::make($request->all(), [
                'plan' => 'required',
                'email' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()]);
            }
            //make plan in stripe dashboard
            $plan= Plan::find(decrypt($request->get('plan')));

            if(is_null($plan)){
                return response()->json(['status' => false, 'message' => 'Please select valid plan!'], 403);
            }
            $stripeSecret=Config::get('constants.STRIPE_SECRET');
            \Stripe\Stripe::setApiKey($stripeSecret);
            $stripePlan= \Stripe\Plan::create(array(
                "amount" =>$plan->price*100,
                "interval" => $plan->plan_type,
                "product" => array(
                    "name" => $plan->name,
                ),
                "currency" => "usd",
                "billing_scheme"=> "per_unit",
                "nickname"=>$plan->name
            ));

            $input['plan_id'] = $plan->id;
            $user=User::where('email','=',$request->get('email'))->first();


  /*          //create user role
            $role=\App\Models\Role::whereName('User')->first();
            $user->attachRole($role);*/
            VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            //create user plan
            $userPlan= UserPlan::create ([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'token' => $stripePlan->id
            ]);
            //user verification

            //save user_id for catch case in sessions
            \Session::put('key', $user->id);

            //if user already subscribed
            if ($user->subscribedToPlan('default',  $stripePlan->id)) {
//                dispatch(new SendRegisterataionEmail($user));
                \Session::forget('key');
                return response()->json(
                    ['status' => false, 'message' => 'You Are Registered Successfully, and you are already subscribed the plan','redirect'=>'profiles'], 200);
            }else {
                // user created and subscribeds
                $user->newSubscription('default', $stripePlan->id)
                    ->create($request->get('stripeToken')
                    );
//                dispatch(new SendRegisterataionEmail($user));
                auth()->login($user);
                $user->update(['verified' => 1,'plan_id'=>$plan->id]);
                return response()->json(
                    ['status' => true, 'message' => 'We have sent a verification email to your email address. Please verify this email address before logging in. Thank you!','redirect'=>'profiles'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(
                ['message' => $e->getMessage(), 'stripeStatus' => false], 200);
        }
    }
}
