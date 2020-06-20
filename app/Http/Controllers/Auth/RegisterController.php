<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data,
            [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:6', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'city' => ['required'],
            'birthday' => ['required']
            ],
            [
                'name.required' => 'İsim ve Soyisim Gerekli.',
                'email.required' => 'Email gerekli',
                'email.unique' => 'Bu email adresi alindi.',
                'password.required' => 'Sifre gerekli',
                'password.confirmed' => 'Sifre eslesmiyor',
                'password.min' => 'Sifreniz 8 karakterden az olamaz.',
                'username.required' => 'Kullanici adi gerekli',
                'username.unique' => 'Bu kullanici adi adresi alindi.',
                'username.min' => 'Kullanici adiniz 6 karakterden az olamaz.',
                'city.required' => 'Sehir gerekli',
                'birthday.required' => 'Dogum tarihi gerekli'
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'city' => $data['city'],
            'birthday' => $data['birthday'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
