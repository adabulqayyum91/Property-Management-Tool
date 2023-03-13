<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Services\FacebookAccountService;
use Illuminate\Http\Request;
use \Socialite;
class FacebookController extends Controller
{

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function facebookStore(Request $request){
        $data=$request->all();
        $user = User::whereEmail($data['email'])->first();
        if ($user) {
            if (!is_null($user->provider)) {

                $notAccount = User::whereEmail($data['email'])
                    ->where('provider','!=','facebook')
                    ->first();
                if($notAccount){

                    toastr()->success('You Are already Registered with '.$notAccount->provider.', Please login with facebook '.$notAccount->provider);

                    return response()->json(
            ['status' => 'different_source', 'message' => 'You Are already Registered with '.$notAccount->provider, 'Please login with '.$notAccount->provider], 200);
                }
                $account = User::whereEmail($data['email'])
                    ->whereProviderUserId($data['id'])
                    ->first();
                if(!$account) {
                    $users = User::create([
                        'email' => $data['email'],
                        'name' => $data['name'],
                        'first_name' => $data['first_name'],
                        'last_name' => $data['last_name'],
                        'provider_user_id' => $data['id'],
                        'provider' => 'facebook',
                        'member_automated_id'=> 'M' . sprintf('%06d', (User::withTrashed()->count() + 1))
                    ]);
                    //create user role
                    $role=Role::whereName('User')->first();
                    $users->attachRole($role);
//                    auth()->login($users);
                    toastr()->success( 'You Account Successfully created , Please Complete your Payment Detail');

                    return response()->json(
                        ['status' => 'social_account_created', 'message' => 'You Account Successfully created , Please Complete your Payment Detail','redirect'=>'/','user'=>$users], 200);

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
                'name' => $data['name'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'provider_user_id' => $data['id'],
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



}
