<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        // Check user role
        if (Auth::user()->hasRole('admin')) {
            return '/admin/home';
        }
        else if (Auth::user()->hasRole('manager'))
        {
            return '/manager/communication';
        }
        else {
            abort(403);
        }
    }

    public function index()
    {
        return view('auth.login');
    }

    /* =========================================================================================
       Description: Mthod when Member Login
       ----------------------------------------------------------------------------------------
       ========================================================================================== */

    public function webLoginPost(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [

                'email' => 'required|email',
                'password' => 'required',
            ]);
//validations fail
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()]);
            }
            $remember_me = $request->has('remember') ? true : false;
            $user = User::whereEmail($request->email)->first();
//if account not exist
            if (is_null($user)) {
                return response()->json([
                    'error' => 'No account exist with this email, please register.',
                ]);
            }
            //if social account exist
            if (!is_null($user->provider)) {
                return response()->json(
                    ['error' => 'You Are already Registered with ' . $user->provider . ',Please login with ' . $user->provider], 200);
            }

            //if account status is zero
            if ($user->status == 0) {
                return response()->json(
                    ['error' => 'Your account is not activated Yet, Please Contact with Admin for further Assistance'], 200);

            }

            //if account is exist and credentials match
            if ($user->verified == 1) {
                if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me)) {
                    $user = auth()->user();
                    if(!is_null($user->defaultPaymentMethod())) {
                        $subscription = $user->subscription('default')->asStripeSubscription();
                        if($subscription->cancel_at_period_end==true && $subscription->current_period_end <= Carbon::now()){
                            Auth::logout();
                            return response()->json(['status' => true, 'message' => 'Your Package is Expired. Please Contact with admin for further Assistance.']);
                        }
                    }
                    return response()->json(['status' => true, 'message' => 'You are successfully login.']);

                } else {

                    return response()->json(['error' => 'Your username and password are wrong.']);

                }
            } else {
                return response()->json(['error' => 'Your account is not verified Yet. Please check your Email Or contact with admin for further Assistance']);
            }
        }catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
}
