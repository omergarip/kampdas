@extends('layouts.app')

@section('title')
    <title>Profil Düzenle</title>
@endsection

@section('content')

    @include('includes.navigation')
    <section id="section-edit_profile">
        <div class="limiter profile">
            <div class="container-login100" style="background-image: url('https://kampdas.org/img/camp_photo-min.jpg');">
                <div class="wrap-login100">
                    <form method="POST" action="{{ route('profile.update', $user->username) }}"  class="login100-form validate-form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="login100-form-logo">
                            <img class="wrap-login100-logo" src={{ asset('img/kampdas-logo.png') }} />
                        </div>
                        <span class="login100-form-title">
                            Profili Düzenle
                        </span>
                        <div class="wrap-input100">
                            <span class="label-input100">Profil Fotoğrafınız</span>
                            @if(auth()->user()->photo == '')
                                <img class="km-circle-icon-img profile__photo" src="{{'https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png'}}">
                            @else
                                <img class="km-circle-icon-img profile__photo" src="{{ '/' . auth()->user()->photo}}">
                            @endauth
                            <div class="custom-file">
                                <input type="file" name="photo" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Bir Fotoğraf Seçiniz</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="label-input100">Hakkınızda</span>
                            <textarea name="bio" maxlength="280" class="form-control" id="userBio" rows="5">{{ $user->bio  }}</textarea>
                            <small class="muted">Hakkınızda kısmı 280 karakterden fazla olamaz</small>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate = "Adınızı ve Soyadınızı Giriniz">
                            <span class="label-input100">Adınız Soyadınız</span>
                            <input class="input100" type="text" name="name" placeholder="Adınızı ve Soyadınızı Giriniz" value="{{ $user->name ?? old('name') }}" autocomplete="name" autofocus>
                            <span class="focus-input100" data-symbol="&#xf206;"></span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate = "Kullanıcı Adınızı Giriniz">
                            <span class="label-input100">Kullanıcı Adınız</span>
                            <input disabled class="input100" type="text" name="username" value="{{ $user->username ?? old('username') }}" placeholder="Kullanıcı Adınızı Giriniz">
                            <span class="focus-input100" data-symbol="&#xf206;"></span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate = "Email Adresinizi Giriniz">
                            <span class="label-input100">Email Adresiniz</span>
                            <input class="input100" type="email" placeholder="Email Adresinizi Giriniz" name="email" disabled value="{{ $user->email ?? old('email') }}"  autocomplete="email">
                            <span class="focus-input100" data-symbol="&#xf206;"></span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate = "Yaşadığınız Şehri Giriniz">
                            <span class="label-input100">Şehriniz</span>
                            <select class="input100" type="text" placeholder="Yaşadığınız Şehri Giriniz" id="city" name="city" value="{{ old('city') }}"  autocomplete="city">
                                <option selected disabled hidden>{{ $user->city }}</option>
                            </select>
                            <span class="focus-input100" data-symbol="&#xf206;"></span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate = "Doğum Tarihinizi Giriniz">
                            <span class="label-input100">Doğum Tarihiniz</span>
                            <input class="input100" id="birthday" type="text" placeholder="Doğum Tarihinizi Giriniz" name="birthday" value="{{ $user->birthday ?? old('birthday') }}"  autocomplete="birthday">
                            <span class="focus-input100" data-symbol="&#xf206;"></span>
                        </div>
                        <div class="wrap-input100">
                            <span class="label-input100">Şifreniz</span>
                            <input class="input100" type="password" name="password" autocomplete="new-password" placeholder="Şifrenizi Giriniz">
                            <span class="focus-input100" data-symbol="&#xf190;"></span>
                        </div>
                        <div class="wrap-input100" >
                            <span class="label-input100">Şifreniz (Tekrar)</span>
                            <input class="input100" type="password" name="password_confirmation" autocomplete="new-password" placeholder="Şifrenizi Tekrar Giriniz">
                            <span class="focus-input100" data-symbol="&#xf190;"></span>
                        </div>

                        <div class="container-login100-form-btn my-5">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button class="login100-form-btn">
                                    Düzenle
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
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

