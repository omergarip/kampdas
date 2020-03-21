@extends('layouts.app')

@section('title')
    <title>Kampdaş</title>
@endsection

@section('content')
    @include('includes.navigation')

    <div style="height: 200px;z-index: -1"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <p style="background-color: #cfda5d; border-radius: 3px; color: #000; text-align: center; border: 0 solid #1a1a1a; border-left-width: 4px;"><i class="fas fa-thumbtack"></i>Başa Tutturulan Etkinlikler.</p>

                <div class="row">
                    <div class="col-md-4">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item">
                                    <img class="d-block w-100 km-radius" src="img/post-1.jpg" alt="First slide">
                                </div>
                                <div class="carousel-item active carousel-item-left">
                                    <img class="d-block w-100 km-radius" src="img/post-1.jpg" alt="Second slide">
                                </div>
                                <div class="carousel-item carousel-item-next carousel-item-left">
                                    <img class="d-block w-100 km-radius" src="img/post-1.jpg" alt="Third slide">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>
                    <div class="col-md-8" >

                        <div class="km-post">
                            <!--<img src="img/post-1.jpg" style="max-width: 100%; height: 400px; vertical-align: top; border-radius: 25px"> -->


                            <div>
                                <strong> <i class="fas fa-thumbtack"></i> Salda Gölü Kamp Etkinliği / 14-15 Nisan 2018</strong>
                            </div>
                            <div class="km-post-statistics">
                                <i class="fas fa-map-marker-alt"></i> <a href="https://www.google.com/maps/place/Salda+G%C3%B6l%C3%BC/@37.5475037,29.6474713,13z/data=!4m13!1m7!3m6!1s0x14c6c43d6be9db11:0xb027419946d9738b!2zU2FsZGEgR8O2bMO8!3b1!8m2!3d37.5509434!4d29.6730939!3m4!1s0x14c6c5ac1c267ebf:0xa11cbf0c826d11e4!8m2!3d37.5313057!4d29.6567774" target="_blank">Etkinlik Yeri: Salda Gölü / Burdur</a>
                                <div class="row">
                                    <div class="col-sm-3" style="word-break: break-all;">
                                        Düzenleyen:</div>

                                    <img src="img/merve.jpg" class="km-circle-icon-img"><div class="col-sm-4"><small>Merve Akgörmüş @merveakgormus</small></div>
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
                                    <small>Katılanlar: 51 kişi</small><div class="col">
                                        <img src="img/merve.jpg" class="km-thumbnail-img">
                                        <img src="img/merve.jpg" class="km-thumbnail-img">
                                        <img src="img/merve.jpg" class="km-thumbnail-img">
                                        <img src="img/merve.jpg" class="km-thumbnail-img">
                                        <img src="img/merve.jpg" class="km-thumbnail-img">
                                    </div></div>
                                <div class="col-sm-6">
                                    <small><i class="fas fa-comment-dots"></i>Etkinlik Hakkında 63 yorum</small>
                                    <a href="#"><small>Yorumları Görmek İçin Tıkla</small></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><hr>

                <div class="col-sm-12" style="text-align:right"><a href="#"><p>Devamı İçin Tıklayınız.</p></a></div>

            </div>
            @auth
            <div class="col-md-4">
                <div class="sidenav">
                    <div class="row">
                        <div class="km-right-bar">
                            <div class="col-md-4">
                                @if(auth()->user()->photo == '')
                                    <img class="rounded-circle z-depth-0" style="width: 4rem; height: 4rem;" src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                @else
                                    <img class="rounded-circle z-depth-0" style="width: 4rem; height: 4rem;" src="{{ asset('storage/'.auth()->user()->photo) }}">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h4 >{{ auth()->user()->name }}</h4>
                                <p > {{ '@' . auth()->user()->username }} </p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('events.create') }}" class="btn btn-default km-dark-green-btn">Yeni Etkinlik Oluştur</a>
                </div>
            </div>
            @endauth




            <div class="col-md-8">
                <p style="background-color: #f7cd51; border-radius: 3px; color: #000; text-align: center; border: 0 solid #1a1a1a; border-left-width: 4px;">Yaklaşan etkinlikler.</p>
                @foreach($events as $event)
                <div class="row">

                    <div class="col-md-4">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active carousel-item-left">
                                    <img class="d-block w-100 km-radius" src="img/post-1.jpg" alt="First slide">
                                </div>
                                <div class="carousel-item carousel-item-next carousel-item-left">
                                    <img class="d-block w-100 km-radius" src="img/post-1.jpg" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 km-radius" src="img/post-1.jpg" alt="Third slide">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>
                    <div class="col-md-8">

                        <div class="km-post">
                            <!--<img src="img/post-1.jpg" style="max-width: 100%; height: 400px; vertical-align: top; border-radius: 25px"> -->


                            <div>
                                <a href="{{ route('events.show', $event->slug) }}">
                                    <strong> <i class="fas fa-thumbtack"></i> {{ $event->title }} / 14-15 Nisan 2018</strong>
                                </a>
                            </div>
                            <div class="km-post-statistics">
                                <h6 style="margin:10px;"><i class="fas fa-map-marker-alt"></i><a href="https://www.google.com/maps/search/?api=1&query={{$event->location}}" target="_blank">Etkinlik Yeri: {{ $event->location }}</a> </h6>
                                <div class="row">
                                    <div class="col-sm-3" style="word-break: break-all;">
                                        Düzenleyen:</div>

{{--                                    @if(auth()->user()->photo == '')--}}
{{--
{{--                                    @else--}}
                                    <img class="rounded-circle z-depth-0" style="width: 4rem; height: 4rem;" src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">--}}
{{--                                        <img class="rounded-circle z-depth-0" style="width: 4rem; height: 4rem;" src="{{ asset('storage/'.auth()->user()->photo) }}">--}}
{{--                                    @endif--}}
                                    <div class="col-sm-4"><small>{{ $event->user }} {{ '@' . $event->user  }}</small></div>
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
                                    <small>Katılanlar: 51 kişi</small><div class="col">
                                        <img src="img/merve.jpg" class="km-thumbnail-img">
                                        <img src="img/merve.jpg" class="km-thumbnail-img">
                                        <img src="img/merve.jpg" class="km-thumbnail-img">
                                        <img src="img/merve.jpg" class="km-thumbnail-img">
                                        <img src="img/merve.jpg" class="km-thumbnail-img">
                                    </div></div>
                                <div class="col-sm-6">
                                    <small><i class="fas fa-comment-dots"></i>Etkinlik Hakkında 63 yorum</small>
                                    <a href="#"><small>Yorumları Görmek İçin Tıkla</small></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>@endforeach<hr>




                <div class="col-sm-12" style="text-align:right"><a href="#"><p>Devamı İçin Tıklayınız.</p></a></div>











            </div>
        </div>
    </div>





    <div style="height: 200px"></div>
@endsection

