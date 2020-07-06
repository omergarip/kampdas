@extends('layouts.app')

@section('title')
    <title>Giriş Yap</title>
@endsection

@section('content')
    @include('includes.navigation')
    <section id="section-login">
        <div class="limiter">
            <div class="container-login100" style="background-image: url('https://kampdas.org/img/camp_photo-min.jpg');">
                <div class="wrap-login100">
                    <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                    @csrf
                        <div class="login100-form-logo">
                            <img class="wrap-login100-logo" src={{ asset('img/PNG.png') }} />
                        </div>
                        <span class="login100-form-title">
                            Giriş Yap
                        </span>
                        <div class="wrap-input100 validate-input" data-validate = "Kullanıcı Adınızı Giriniz">
                            <span class="label-input100">Kullanıcı Adınız</span>
                            <input class="input100" type="text" name="username" placeholder="Kullanıcı Adınızı Giriniz">
                            <span class="focus-input100" data-symbol="&#xf206;"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Şifrenizi Giriniz">
                            <span class="label-input100">Şifreniz</span>
                            <input class="input100" type="password" name="password" placeholder="Şifrenizi Giriniz">
                            <span class="focus-input100" data-symbol="&#xf190;"></span>
                        </div>

                        <div class="forgot-password text-right">
                            <a href="{{ route('password.request') }}">
                                Şifreni mi unuttun?
                            </a>
                        </div>

                        <div class="container-login100-form-btn">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button class="login100-form-btn">
                                    Giriş Yap
                                </button>
                            </div>
                        </div>

                        <div class="txt1 text-center">
						<span>
							veya
						</span>
                        </div>

                        <div class="flex-c-m">
                            <a href="{{url('/redirect')}}" class="login100-social-item bg1">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a href="#" class="login100-social-item bg3">
                                <i class="fa fa-google"></i>
                            </a>
                        </div>

                        <div class="flex-col-c">
						<span class="txt1">
							veya
						</span>

                            <a href="{{ route('register-form') }}" class="txt2">
                                Kayıt Ol
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Giriş Yap') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Kullanıcı Adı') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>--}}

{{--                                @error('username')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Şifre') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Beni Hatırla') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Giriş Yap') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Şifreni mi Unuttun?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--                <br />--}}
{{--                <p style="margin-left:265px">OR</p>--}}
{{--                <br />--}}
{{--                <div class="form-group">--}}
{{--                    <div class="col-md-8 col-md-offset-4">--}}
{{--                        <a href="{{url('/redirect')}}" class="btn btn-primary">Login with Facebook</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
