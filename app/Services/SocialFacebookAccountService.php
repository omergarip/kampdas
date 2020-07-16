<?php
namespace App\Services;
use App\SocialFacebookAccount;
use App\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as ProviderUser;
class SocialFacebookAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
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
                    'username' => Str::slug($providerUser->getName(), '-'),
                    'photo' => $providerUser->getAvatar(),
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'password' => md5(rand(1,10000)),
                    'city' => 'Şehrinizi Seçiniz',
                    'bio' => ''
                ]);
            }
            $account->user()->associate($user);
            $account->save();
            return $user;
        }
    }
}
