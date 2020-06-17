<?php

namespace App\Providers;

use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

//        VerifyEmail::toMailUsing(function ($notifiable){
//            $verifyUrl = URL::temporarySignedRoute(
//                'verification.verify',
//                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
//                [
//                    'id' => $notifiable->getKey(),
//                    'hash' => sha1($notifiable->getEmailForVerification()),
//                ]
//            );
//
//            $user = User::whereEmail($notifiable->getEmailForVerification())->first();
//            return (new MailMessage)
//                ->subject('Hesap Doğrulama!')
//                ->markdown('vendor.notifications.email', ['user' => $user, 'url' => $verifyUrl]);
//        });
    }
}
