<?php

/**
 * Created by PhpStorm.
 * User: Transdata
 * Date: 3/14/2020
 * Time: 10:27 PM
 */
namespace App\Services;
use App\FacebookAccount;
use App\Models\User;
use Laravel\Socialite\Contracts\User as ProviderUser;



class FacebookAccountService
{
    public function createOrGetUser(ProviderUser $providerUser,$source)
    {
      /*  $user = User::whereEmail($providerUser->getEmail())->first();
//        dd(!is_null($user->provider));
      if(!is_null($user->provider)){
            return response()->json(
                ['status' => true, 'message' => 'You Are Registered with '.$user->provider], 200);

        }else{
            return response()->json(
                ['status' => true, 'message' => 'You Are already Registered. Please use your credentials for login'], 200);

      }*/

        $account = User::whereEmail($providerUser->getEmail())->whereProvider($source)
            ->whereProviderUserId($providerUser->getId())
            ->first();
//dd($account);
        if ($account) {
            return $account;
        } else {
            if (!$account) {
                $user = User::whereEmail($providerUser->getEmail())->first();
if($user){
                if(!is_null($user->provider)){
                    return $user;
//                    return response()->json(
//                        ['status' => true, 'message' => 'You Are Registered with '.$user->provider], 200);

                }else{
                    return $user;
//                    return response()->json(
//                        ['status' => true, 'message' => 'You Are already Registered. Please use your credentials for login'], 200);

                }
                }

                $account = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'first_name' => $providerUser->getName(),
                    'last_name' => $providerUser->getName(),
                  /*  'phone' => '123456',
                    'manage_income_property' => '0',
                    'interest' => 'sss',
                    'password' => md5(rand(1,10000)),*/
                    'provider_user_id' => $providerUser->getId(),
                    'provider' => $source
                ]);
            }
//            $account->user()->associate($user);
//            $account->save();
            return $account;
        }
    }
}