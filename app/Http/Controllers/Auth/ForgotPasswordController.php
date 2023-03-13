<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Jobs\ForgetPasswordEmail;
use App\Models\User;
 use \Carbon\Carbon;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    /**
     * Create a new controller instance.
     */

    public function forgot_password(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => "required|email",
        );
        $validator = \Validator::make($input, $rules);
        if ($validator->fails()) 
        {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } 
        else 
        {
            try 
            {
                //You can add validation login here
                $user =User::where('email', '=', $request->email)
                        ->first();
                //Check if the user exists
                if (empty($user)) {
                    return response()->json(['message' =>trans('User does not exist'), 'status' => false], 200);
                }

                //Create Password Reset Token
                \DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => str_random(60),
                    'created_at' => Carbon::now()
                ]);
                //Get the token just created above
                $tokenData = \DB::table('password_resets')
                                ->where('email', $request->email)->first();

                // if ($this->sendResetEmail($request->email, $tokenData->token)) {


                dispatch(new ForgetPasswordEmail($user,$request->email, $tokenData->token));

                return response()->json(
                    ['message' =>trans('Reset Password Email is successfully send on the given email address'), 'status' => true], 200);
        

            } 
            catch (\Swift_TransportException $ex) 
            {
                $arr = array("status" => 200, "message" => $ex->getMessage(), "data" => []);
                return \Response::json($arr);
            } 
            catch (\Exception $ex) 
            {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
                return \Response::json($arr);
            }
        }

    }
}
