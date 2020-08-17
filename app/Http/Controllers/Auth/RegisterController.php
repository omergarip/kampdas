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
    | This controller handles the registration of new profile as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect profile after registration.
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
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'city' => ['required'],
                'birthday' => ['required']
            ],
            [
                'name.required' => 'Adınızı ve Soyadınız Giriniz.',
                'email.required' => 'Email Adresinizi Giriniz.',
                'email.unique' => 'Bu Email Adresi Başka Bir Kullanıcı Tarafından Kullanılmaktadır.',
                'password.required' => 'Sifrenizi Giriniz.',
                'password.confirmed' => 'Sifreniz Eşleşmemektedir.',
                'password.min' => 'Sifreniz 6 Karakterden Az Olamaz.',
                'username.required' => 'Kullanıcı Adınızı Giriniz.',
                'username.unique' => 'Bu Kullanıcı Adı Başka Bir Kullanıcı Tarafından Kullanılmaktadır.',
                'username.min' => 'Kullanıcı Adınız 6 Karakterden Az Olamaz.',
                'city.required' => 'Sehrinizi Giriniz.',
                'birthday.required' => 'Dogum Tarihinizi Giriniz.'
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
            'password' => Hash::make($data['password'])
        ]);
    }
}
