@extends('layouts.app')

@section('title')
    <title>Kayıt Ol</title>
@endsection

@section('content')

    @include('includes.navigation')
    <section id="section-login">
        <div class="limiter">
            <div class="container-login100" style="background-image: url('https://kampdas.org/img/camp_photo-min.jpg');">
                <div class="wrap-login100">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}" class="login100-form validate-form">
                        @csrf
                        <div class="login100-form-logo">
                            <img class="wrap-login100-logo" src={{ asset('img/kampdas-logo.png') }} />
                        </div>
                        <span class="login100-form-title">
                            Kayıt Ol
                        </span>
                        <div class="wrap-input100 validate-input" data-validate = "Adınızı ve Soyadınızı Giriniz">
                            <span class="label-input100">Adınız Soyadınız</span>
                            <input class="input100" type="text" name="name" placeholder="Adınızı ve Soyadınızı Giriniz" value="{{ old('name') }}" autocomplete="name" autofocus>
                            <span class="focus-input100" data-symbol="&#xf206;"></span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate = "Kullanıcı Adınızı Giriniz">
                            <span class="label-input100">Kullanıcı Adınız</span>
                            <input class="input100" type="text" name="username" placeholder="Kullanıcı Adınızı Giriniz">
                            <span class="focus-input100" data-symbol="&#xf206;"></span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate = "Email Adresinizi Giriniz">
                            <span class="label-input100">Email Adresiniz</span>
                            <input class="input100" type="email" placeholder="Email Adresinizi Giriniz" name="email" value="{{ old('email') }}"  autocomplete="email">
                            <span class="focus-input100" data-symbol="&#xf206;"></span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate = "Yaşadığınız Şehri Giriniz">
                            <span class="label-input100">Şehriniz</span>
                            <select class="input100" type="text" placeholder="Yaşadığınız Şehri Giriniz" id="city" name="city" value="{{ old('city') }}"  autocomplete="city">
                                <option selected disabled hidden>Şehrinizi Seçiniz</option>
                            </select>
                            <span class="focus-input100" data-symbol="&#xf206;"></span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate = "Doğum Tarihinizi Giriniz">
                            <span class="label-input100">Doğum Tarihiniz</span>
                            <input class="input100" id="birthday" type="text" placeholder="Doğum Tarihinizi Giriniz" name="birthday" value="{{ old('birthday') }}"  autocomplete="birthday">
                            <span class="focus-input100" data-symbol="&#xf206;"></span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Şifrenizi Giriniz">
                            <span class="label-input100">Şifreniz</span>
                            <input class="input100" type="password" name="password" autocomplete="new-password" placeholder="Şifrenizi Giriniz">
                            <span class="focus-input100" data-symbol="&#xf190;"></span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Şifrenizi Tekrar Giriniz">
                            <span class="label-input100">Şifreniz (Tekrar)</span>
                            <input class="input100" type="password" name="password_confirmation" autocomplete="new-password" placeholder="Şifrenizi Tekrar Giriniz">
                            <span class="focus-input100" data-symbol="&#xf190;"></span>
                        </div>

                        <div class="container-login100-form-btn">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button class="login100-form-btn">
                                    Kayıt Ol
                                </button>
                            </div>
                        </div>

                        <!--                  <div class="txt1 text-center">-->
                        <!--<span>-->
                        <!--	veya-->
                        <!--</span>-->
                        <!--                  </div>-->

                        <!--                  <div class="flex-c-m">-->
                        <!--                      <a href="#" class="login100-social-item bg1">-->
                        <!--                          <i class="fa fa-facebook"></i>-->
                        <!--                      </a>-->
                        <!--                      <a href="#" class="login100-social-item bg3">-->
                        <!--                          <i class="fa fa-google"></i>-->
                        <!--                      </a>-->
                        <!--                  </div>-->

                        <div class="flex-col-c">
						<span class="txt1">
							veya
						</span>
                            <a href="{{ route('login') }}" class="txt2">
                                Giriş Yap
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
    {{--                <div class="card-header">{{ __('Kayıt Ol') }}</div>--}}

    {{--                <div class="card-body">--}}
    {{--                    <form method="POST" action="{{ route('register') }}">--}}
    {{--                        @csrf--}}

    {{--                        <div class="form-group row">--}}
    {{--                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('İsim Soyisim') }}</label>--}}

    {{--                            <div class="col-md-6">--}}
    {{--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>--}}

    {{--                                @error('name')--}}
    {{--                                    <span class="invalid-feedback" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                @enderror--}}
    {{--                            </div>--}}
    {{--                        </div>--}}

    {{--                        <div class="form-group row">--}}
    {{--                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Kullanıcı Adı') }}</label>--}}

    {{--                            <div class="col-md-6">--}}
    {{--                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}">--}}

    {{--                                @error('username')--}}
    {{--                                <span class="invalid-feedback" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                @enderror--}}
    {{--                            </div>--}}
    {{--                        </div>--}}

    {{--                        <div class="form-group row">--}}
    {{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Adresi') }}</label>--}}

    {{--                            <div class="col-md-6">--}}
    {{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">--}}

    {{--                                @error('email')--}}
    {{--                                    <span class="invalid-feedback" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                @enderror--}}
    {{--                            </div>--}}
    {{--                        </div>--}}

    {{--                        <div class="form-group row">--}}
    {{--                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Şehir') }}</label>--}}

    {{--                            <div class="col-md-6">--}}
    {{--                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" >--}}

    {{--                                @error('city')--}}
    {{--                                <span class="invalid-feedback" role="alert">--}}
    {{--                                    <strong>{{ $message }}</strong>--}}
    {{--                                </span>--}}
    {{--                                @enderror--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="form-group row">--}}
    {{--                            <label for="birthday" class="col-md-4 col-form-label text-md-right">Doğum Tarihi</label>--}}
    {{--                            <div class="col-md-6">--}}
    {{--                                <input type="text" class="form-control" name="birthday" id="birthday" value="{{ old('birthday') }}">--}}
    {{--                                @error('birthday')--}}
    {{--                                <span class="invalid-feedback" role="alert">--}}
    {{--                                    <strong>{{ $message }}</strong>--}}
    {{--                                </span>--}}
    {{--                                @enderror--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="form-group row">--}}
    {{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Şifre') }}</label>--}}

    {{--                            <div class="col-md-6">--}}
    {{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">--}}

    {{--                                @error('password')--}}
    {{--                                    <span class="invalid-feedback" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                @enderror--}}
    {{--                            </div>--}}
    {{--                        </div>--}}

    {{--                        <div class="form-group row">--}}
    {{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Şifre (Tekrar)') }}</label>--}}

    {{--                            <div class="col-md-6">--}}
    {{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">--}}
    {{--                            </div>--}}
    {{--                        </div>--}}

    {{--                        <div class="form-group row mb-0">--}}
    {{--                            <div class="col-md-6 offset-md-4">--}}
    {{--                                <button type="submit" class="btn btn-primary">--}}
    {{--                                    {{ __('Kayıt Ol') }}--}}
    {{--                                </button>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </form>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--</div>--}}
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#birthday");
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

