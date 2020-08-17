<?php

namespace App;

use App\Notifications\CustomVerifyEmailNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password', 'photo',
        'username', 'birthday', 'city',
        'phone', 'is_banned', 'bio'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmailNotification());
    }

    public function events() {
        return $this->hasMany(Event::class);
    }

    public function attend() {
        return $this->belongsToMany(Event::class);
    }

    public function calculateAge() {
        return Carbon::parse($this->birthday)->diffInYears(Carbon::today());
    }
}
