@extends('layouts.app')

@section('title')
    <title>Kampdaş</title>
@endsection

@section('content')
    @include('includes.navigation')

    <section id="section-home">
        <div style="height: 200px;z-index: -1"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p
                        style="background-color: #cfda5d; border-radius: 3px; color: #000; text-align: center; border: 0 solid #1a1a1a; border-left-width: 4px;">
                        <i class="fas fa-thumbtack"></i>Başa Tutturulan Etkinlikler.</p>
{{--                    @foreach($events as $event)--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-4">--}}
{{--                                <a href="#">--}}
{{--                                    <img class="events__image" src=" ./img/hotel-1.jpg" style="width: 100%; border-radius: 5px;" alt="">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-8">--}}

{{--                                <div class="km-post">--}}
{{--                                    <!--<img src="img/post-1.jpg" style="max-width: 100%; height: 400px; vertical-align: top; border-radius: 25px"> -->--}}


{{--                                    <div>--}}
{{--                                        <a href="/">--}}
{{--                                            <strong> <i class="fas fa-thumbtack"></i><a href="etkinlik.html">--}}
{{--                                                    Salda Gölü Kamp Etkinliği / 14-15--}}
{{--                                                    Nisan--}}
{{--                                                    2018--}}
{{--                                                </a> </strong>--}}
{{--                                        </a>--}}

{{--                                    </div>--}}
{{--                                    <div class="km-post-statistics">--}}
{{--                                        <i class="fas fa-map-marker-alt"></i> <a--}}
{{--                                            href="https://www.google.com/maps/place/Salda+G%C3%B6l%C3%BC/@37.5475037,29.6474713,13z/data=!4m13!1m7!3m6!1s0x14c6c43d6be9db11:0xb027419946d9738b!2zU2FsZGEgR8O2bMO8!3b1!8m2!3d37.5509434!4d29.6730939!3m4!1s0x14c6c5ac1c267ebf:0xa11cbf0c826d11e4!8m2!3d37.5313057!4d29.6567774"--}}
{{--                                            target="_blank">Etkinlik Yeri: Salda Gölü / Burdur</a>--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-sm-3" style="word-break: break-all;">--}}
{{--                                                Düzenleyen:</div>--}}

{{--                                            <img src="./img/user-1.jpg" class="km-circle-icon-img">--}}
{{--                                            <div class="col-sm-4"><small>Omer Garip @omergarip</small></div>--}}
{{--                                        </div>--}}
{{--                                        <!--  <small ><i class="fas fa-user"></i> Yücel Beki</small>--}}
{{--                                       <small >/</small>--}}
{{--                                       <small >11.06.2019</small>--}}
{{--                                       <small >/</small>--}}
{{--                                       <small ><i class="fas fa-comment-dots"></i> 3 COMMENTS</small>--}}
{{--                                       <small >/</small>--}}
{{--                                       <small ><i class="fas fa-users"></i> 51 kampçı gidiyor</small>-->--}}
{{--                                    </div>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-sm-4">--}}
{{--                                            <small>Katılanlar: 51 kişi</small>--}}
{{--                                            <div class="col">--}}
{{--                                                <img src="./img/user-1.jpg" class="km-thumbnail-img">--}}
{{--                                                <img src="./img/user-3.jpg" class="km-thumbnail-img">--}}
{{--                                                <img src="./img/user-4.jpg" class="km-thumbnail-img">--}}
{{--                                                <img src="./img/user-5.jpg" class="km-thumbnail-img">--}}
{{--                                                <img src="./img/user-6.jpg" class="km-thumbnail-img">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-6">--}}
{{--                                            <small><i class="fas fa-comment-dots"></i>Etkinlik Hakkında 63 yorum</small>--}}
{{--                                            <a href="#"><small>Yorumları Görmek İçin Tıkla</small></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}

                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <a href="#">
                                <img class="events__image" src=" ./img/hotel-2.jpg" style="width: 100%; border-radius: 5px;" alt="">
                            </a>
                        </div>
                        <div class="col-md-8">

                            <div class="km-post">
                                <!--<img src="img/post-1.jpg" style="max-width: 100%; height: 400px; vertical-align: top; border-radius: 25px"> -->


                                <div>
                                    <a href="/">
                                        <strong> <i class="fas fa-thumbtack"></i> Salda Gölü Kamp Etkinliği / 14-15
                                            Nisan
                                            2018</strong>
                                    </a>
                                </div>
                                <div class="km-post-statistics">
                                    <i class="fas fa-map-marker-alt"></i> <a
                                        href="https://www.google.com/maps/place/Salda+G%C3%B6l%C3%BC/@37.5475037,29.6474713,13z/data=!4m13!1m7!3m6!1s0x14c6c43d6be9db11:0xb027419946d9738b!2zU2FsZGEgR8O2bMO8!3b1!8m2!3d37.5509434!4d29.6730939!3m4!1s0x14c6c5ac1c267ebf:0xa11cbf0c826d11e4!8m2!3d37.5313057!4d29.6567774"
                                        target="_blank">Etkinlik Yeri: Salda Gölü / Burdur</a>
                                    <div class="row">
                                        <div class="col-sm-3" style="word-break: break-all;">
                                            Düzenleyen:</div>

                                        <img src="./img/user.jpg" class="km-circle-icon-img">
                                        <div class="col-sm-4"><small>Yucel Beki @yucelbeki</small></div>
                                    </div>
                                    <!--  <small ><i class="fas fa-user"></i> Yücel Beki</small>
                                   <small >/</small>
                                   <small >11.06.2019</small>
                                   <small >/</small>
                                   <small ><i class="fas fa-comment-dots"></i> 3 COMMENTS</small>
                                   <small >/</small>
                                   <small ><i class="fas fa-users"></i> 51 kampçı gidiyor</small>-->
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <small>Katılanlar: 51 kişi</small>
                                        <div class="col">
                                            <img src="./img/user-1.jpg" class="km-thumbnail-img">
                                            <img src="./img/user-3.jpg" class="km-thumbnail-img">
                                            <img src="./img/user-4.jpg" class="km-thumbnail-img">
                                            <img src="./img/user-5.jpg" class="km-thumbnail-img">
                                            <img src="./img/user-6.jpg" class="km-thumbnail-img">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <small><i class="fas fa-comment-dots"></i>Etkinlik Hakkında 25 yorum</small>
                                        <a href="#"><small>Yorumları Görmek İçin Tıkla</small></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-12" style="text-align:right"><a href="#">
                            <p>Devamı İçin Tıklayınız.</p>
                        </a></div>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('events.create') }}" class="btn btn-primary btn-event"><i class="fas fa-plus"></i> Kamp Etkinliği Oluştur</a>
                </div>
                <div class="col-md-8">
                    <p
                        style="background-color: #f7cd51; border-radius: 3px; color: #000; text-align: center; border: 0 solid #1a1a1a; border-left-width: 4px;">
                        Yaklaşan etkinlikler.</p>

                    @foreach($events as $event)
                        <div class="row">
                            <div class="col-md-4">
                                <a href="#">
                                    <img class="events__image" src=" ./img/hotel-1.jpg" style="width: 100%; border-radius: 5px;" alt="">
                                </a>
                            </div>
                            <div class="col-md-8">

                                <div class="km-post">
                                    <!--<img src="img/post-1.jpg" style="max-width: 100%; height: 400px; vertical-align: top; border-radius: 25px"> -->


                                    <div>
                                        <a href="/">
                                            <strong> <i class="fas fa-thumbtack"></i><a href="etkinlik.html">
                                                    Salda Gölü Kamp Etkinliği / 14-15
                                                    Nisan
                                                    2018
                                                </a> </strong>
                                        </a>

                                    </div>
                                    <div class="km-post-statistics">
                                        <i class="fas fa-map-marker-alt"></i> <a
                                            href="https://www.google.com/maps/place/Salda+G%C3%B6l%C3%BC/@37.5475037,29.6474713,13z/data=!4m13!1m7!3m6!1s0x14c6c43d6be9db11:0xb027419946d9738b!2zU2FsZGEgR8O2bMO8!3b1!8m2!3d37.5509434!4d29.6730939!3m4!1s0x14c6c5ac1c267ebf:0xa11cbf0c826d11e4!8m2!3d37.5313057!4d29.6567774"
                                            target="_blank">Etkinlik Yeri: Salda Gölü / Burdur</a>
                                        <div class="row">
                                            <div class="col-sm-3" style="word-break: break-all;">
                                                Düzenleyen:</div>

                                            <img src="./img/user-1.jpg" class="km-circle-icon-img">
                                            <div class="col-sm-4"><small>Omer Garip @omergarip</small></div>
                                        </div>
                                        <!--  <small ><i class="fas fa-user"></i> Yücel Beki</small>
                                       <small >/</small>
                                       <small >11.06.2019</small>
                                       <small >/</small>
                                       <small ><i class="fas fa-comment-dots"></i> 3 COMMENTS</small>
                                       <small >/</small>
                                       <small ><i class="fas fa-users"></i> 51 kampçı gidiyor</small>-->
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <small>Katılanlar: 51 kişi</small>
                                            <div class="col">
                                                <img src="./img/user-1.jpg" class="km-thumbnail-img">
                                                <img src="./img/user-3.jpg" class="km-thumbnail-img">
                                                <img src="./img/user-4.jpg" class="km-thumbnail-img">
                                                <img src="./img/user-5.jpg" class="km-thumbnail-img">
                                                <img src="./img/user-6.jpg" class="km-thumbnail-img">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <small><i class="fas fa-comment-dots"></i>Etkinlik Hakkında 63 yorum</small>
                                            <a href="#"><small>Yorumları Görmek İçin Tıkla</small></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                    <hr>
                    <div class="col-sm-12" style="text-align:right"><a href="#">
                            <p>Devamı İçin Tıklayınız.</p>
                        </a></div>
                </div>
            </div>
        </div>
        <div style="height: 200px"></div>
    </section>

@endsection
