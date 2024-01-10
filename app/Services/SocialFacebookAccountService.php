<?php

namespace App\Services;
use App\Models\SocialFacebookAccount;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialFacebookAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        // dd($providerUser);
        $account = SocialFacebookAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialFacebookAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'f_name' => $providerUser->getName(),
                    'l_name' => $providerUser->getName(),
                    'username' => Str::random(10),
                    'type' => 'ADMIN',
                    'status' => 1,
                    'category_id' => 0,
                    'admin_id' => 0,
                    'password' => md5(rand(1,10000)),
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}