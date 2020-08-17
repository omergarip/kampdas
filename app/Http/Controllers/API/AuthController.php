<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data,
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
            ]
        );
        $data['password'] = Hash::make($request->password);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $user = User::create($data);
            $accessToken = $user->createToken('authToken')->accessToken;
            $user->sendEmailVerificationNotification();
            return response([ 'user' => $user, 'access_token' => $accessToken]);
        }
    }

    public function login(Request $request)
    {
        $loginData = $request->only(['username', 'password']);
        $validator = Validator::make($loginData,
            [
                'username' => 'required',
                'password' => 'required|min:6'
            ],
            [
                'password.required' => 'Sifrenizi Giriniz.',
                'password.min' => 'Sifreniz 6 Karakterden Az Olamaz.',
                'username.required' => 'Kullanıcı Adınızı Giriniz.',
            ]
        );

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        else if (!auth()->attempt($loginData)) {
            return response(['message' => 'Böyle bir kullanıcı adı bulunamadı.']);
        }
        else {
            $token = auth()->user()->createToken('authToken');
            return response(['user' => auth()->user(),
                'access_token' => $token->accessToken,
                'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString()]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
