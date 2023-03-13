<?php
/**
 * Created by PhpStorm.
 * User: Transdata
 * Date: 3/15/2020
 * Time: 11:00 PM
 */

namespace App\Http\Controllers;
use App\Jobs\SendRegisterataionEmail;
use App\Models\Plan;
use App\Models\Role;
use App\Models\UserPlan;
use App\Models\VerifyUser;
use App\Services\FacebookAccountService;
use App\Http\Controllers\Controller;
//use \Laravel\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use \Socialite;

use \Auth;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback(FacebookAccountService $service)
    {



        $socialite=Socialite::driver('google')->user();
        $account = User::whereEmail($socialite->email)->whereProvider('google')
            ->whereProviderUserId($socialite->id)
            ->first();
        if(!$account) {
            $user = User::whereEmail($socialite->email)->first();
            if ($user) {
                if (!is_null($user->provider)) {


                    return redirect()->to('/issue is here');
//                    return response()->json(
//                        ['status' => true, 'message' => 'You Are already Registered with ' . $user->provider.', Please login with '.$user->provider], 200);


                } else {
//                    toastr()->success('Data has been saved successfully!');
                    return redirect()->to('/');
//                    return response()->json(
//                        ['status' => true, 'message' => 'You Are already Registered. Please use your credentials for login'], 200);

                }
            }

        }
        $user = $service->createOrGetUser($socialite, 'google');

        auth()->login($user);
        return redirect()->to('/');
    }

    //---PostGoogle Method---//
    public function googleStore(Request $request, Redirector $redirector,$origin = null){
        if((!$request->ajax())){
            return redirect('login');
        }
        $token = $request->get('token');

        $url = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token='.$token;
        $respData = $this->curlGetData($url);
        $data = json_decode($respData,true);
        $user = User::whereEmail($data['email'])->first();
        if ($user) {
            if (!is_null($user->provider)) {

                $notAccount = User::whereEmail($data['email'])
                    ->where('provider','!=','google')
                    ->first();
                if($notAccount){

                    toastr()->success('You Are already Registered with '.$notAccount->provider.', Please login with '.$notAccount->provider);

                    return response()->json(
                        ['status' => 'different_source', 'message' => 'You Are already Registered with '.$notAccount->provider, 'Please login with '.$notAccount->provider], 200);
                }
                $account = User::whereEmail($data['email'])
                    ->whereProviderUserId($data['id'])
                    ->first();
                if(!$account) {
                    $users = User::create([
                        'email' => $data['email'],
                        'name' => (isset($data['name']))?$data['name']:'',
                        'first_name' => (isset($data['given_name']))?$data['given_name']:'',
                        'last_name' => (isset($data['family_name']))?$data['family_name']:'',
                        'provider_user_id' => $data['id'],
                        'photo' => (isset($data['picture']))?$data['picture']:'',
                        'provider' => 'google',
                        'member_automated_id'=> 'M' . sprintf('%06d', (User::withTrashed()->count() + 1))
                    ]);
                    //create user role
                    $role=Role::whereName('User')->first();
                    $users->attachRole($role);
//                    auth()->login($users);
                    toastr()->success('You Are Successfully login Please Complete your Profile');
                    return response()->json(
                        ['status' => 'social_account_created', 'message' => 'You Are Successfully login, Please Complete your Profile',
                            'redirect'=>'/profiles','user'=>$users], 200);

                }else{
                    $users=$account;
                    auth()->login($users);
                    toastr()->success('You Are Successfully login');

                    return response()->json(
                        ['status' => 'social_login', 'message' => 'You Are Successfully login' ,'redirect'=>'/'], 200);
                }

            } else {
                toastr()->success('You Are already Registered. Please use your credentials for login');
                return response()->json(
                    ['status' => 'web_register', 'message' => 'You Are already Registered. Please use your credentials for login' ,'redirect'=>'/'], 200);
            }
        }else{
            $users = User::create([
                'email' => $data['email'],
                'name' => (isset($data['name']))?$data['name']:'',
                'first_name' => (isset($data['given_name']))?$data['given_name']:'',
                'last_name' => (isset($data['family_name']))?$data['family_name']:'',
                'provider_user_id' => $data['id'],
                'photo' => (isset($data['picture']))?$data['picture']:'',
                'provider' => 'google',
                'member_automated_id'=> 'M' . sprintf('%06d', (User::withTrashed()->count() + 1))
            ]);
            //create user role
            $role=Role::whereName('User')->first();
            $users->attachRole($role);
//            auth()->login($users);
            toastr()->success('You Are Successfully login Please Complete your Profile');
            return response()->json(
                ['status' => 'social_account_created', 'message' => 'You Are Successfully login, Please Complete your Profile','redirect'=>'/profiles','user'=>$users], 200);

        }
        return response()->json(['status' => true, 'message' => 'You Are already Registered. Please use your credentials for login','redirect'=>'/profiles'], 200);
    }

    //---CurlGetData Method---//
    public static function curlGetData($url, $returnData = false)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/json'
        ));
        $data = curl_exec($ch);
        curl_close($ch);
        if ($returnData) {
            return $data;
        }

        return $data;
    }

    //---CurlGetData Method---//
    public function zeroPricePlanSocialLogin(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
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

            $input['plan_id'] =  $plan->id;
            //update user
            $user=User::where('email','=',$request->get('email'))->first();
            //create user role
            $role=\App\Models\Role::whereName('User')->first();
            $user->attachRole($role);
            VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            //email for admin
//            dispatch(new SendRegisterataionEmail($user));
            auth()->login($user);
            return response()->json(
                ['status' => true, 'message' => 'You Are Registered Successfully','redirect'=>'profiles'], 200);
        }catch (\Exception $e) {
            return response()->json(
                ['message' => $e->getMessage(), 'status' => false], 200);
        }
    }
}
