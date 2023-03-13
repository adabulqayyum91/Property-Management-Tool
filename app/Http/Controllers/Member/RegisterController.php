<?php


namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Mail\UserRequestMailable;
use App\Mail\VerifyMail;
use App\Models\Plan;
use App\Models\User;
use App\Models\UserRequest;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendRegisterataionEmail;
use App\Models\Role;
class RegisterController extends Controller

{
    /* =========================================================================================
    Description: Member store method for save user request when user select Contact me First
    ----------------------------------------------------------------------------------------
    ========================================================================================== */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'about_us_source' => 'required',
            'phone' => 'required',
            'manage_income_property' => 'required|in:1,0',
            'interest' => 'required',
            'contact_timing' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        // $input['plan_id'] = $input['plan'];
        $input['name'] = $input['first_name'] . ' ' . $input['last_name'];
        $user = UserRequest::create($input);
          /*$role=Role::whereName('User')->first();
            $user->attachRole($role);*/

        //email for admin
        // \Mail::to(env('ADMIN_EMAIL'))->send(new UserRequestMailable($user));
        return response()->json(
            ['status' => true, 'message' => 'Your Request Submit Successfully'], 200);
    }

    /* =========================================================================================
    Description: Mthod when User hit the email in his registeration email
    ----------------------------------------------------------------------------------------
    ========================================================================================== */

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if (isset($verifyUser)) {
            $user = $verifyUser->user;
            if (!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = "Your e-mail is verified. You can now login.";
            } else {
                $status = "Your e-mail is already verified. You can now login.";
            }
        } else {
            return redirect('/')->with('warning', "Sorry your email cannot be identified.");
        }
        return redirect('/')->with('status', $status);
    }
    /* =========================================================================================
    Description: Member store method for save user request without stripe
    ----------------------------------------------------------------------------------------
    ========================================================================================== */
    public function zeroPlanPrice(Request $request){
        try {
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

            $name = explode('@', $input['email'])[0];
            $input['password'] = Hash::make($input['password']);
           $input['plan_id'] =  $plan->id;
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

            //email for admin

            dispatch(new SendRegisterataionEmail($user));
            return response()->json(
                ['status' => true, 'message' => 'We have sent a verification email to your email address. Please verify this email address before logging in. Thank you!'], 200);
        }catch (\Exception $e) {
            return response()->json(
                ['message' => $e->getMessage(), 'status' => false], 200);

        }
}
}
