@extends('layouts.app')

@section('content')
    @include('includes.navigation')
    <div style="height: 200px;z-index: -1"></div>
    <div class="container">
        @if(auth()->id() == $event->created_by)
            <div class="form-group mb-5">
                <a href="{{ route('events.edit', $event->slug) }}" class="form-control btn btn-sm btn-primary">Güncelle</a>
                <form action="{{ route('events.delete', $event->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="form-control btn btn-sm btn-danger">Sil</button>
                </form>
            </div>
        @endif
        <div class="row">

            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <h4> <i class="fas fa-thumbtack"></i> Salda Gölü Kamp Etkinliği</h4>
                        <div class="container text-center mt-5">
                            <div class="row mx-auto my-auto js--wp-2">
                                <div id="myCarousel2" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner w-100" role="listbox">
                                        <div class="carousel-item active">
                                            <div class="col-lg-12">
                                                <img class="d-block w-100 km-radius" src="{{ asset('/' . $first_media[0]->photo) }}" alt="First slide">
                                            </div>
                                        </div>
                                        @foreach($media as $m)
                                            <div class="carousel-item">
                                                <div class="col-lg-12 ">
                                                    <img class="d-block w-100 km-radius" src="{{ asset('/' . $m->photo) }}" alt="Second slide">
                                                </div>
                                            </div>
                                        @endforeach
                            </div>
                                <a class="carousel-control-prev bg-dark w-auto" href="#myCarousel2" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next bg-dark w-auto" href="#myCarousel2" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    </div>
                    <div class="row" style="text-align: center; padding: 10px;">
                        <div class="col-sm">
                            <button type="button" class="btn btn-primary" style="margin: 5px;">Paylaşım <span class="badge">63</span></button>
                        </div>
                        <div class="col-sm" style="margin: 5px;">
                            <i class="fab fa-facebook-square"></i> Facebook'ta Paylaş
                        </div>
                        <div class="col-sm" style="margin: 5px;">
                            <i class="fab fa-twitter-square"></i> Twitter'da Paylaş
                        </div>
                        <div class="col-sm" style="margin: 5px;">
                            <i class="fab fa-whatsapp-square"></i> Whatsapp'ta Paylaş
                        </div>
                    </div>
                    <div class="row" style="text-align: center; padding: 20px;">
                        <div class="col-md-4">
                            @if(auth()->user()->photo == '')
                                <img class="rounded-circle z-depth-0" style="width: 4rem; height: 4rem;" src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                            @else
                                <img class="rounded-circle z-depth-0" style="width: 4rem; height: 4rem;" src="{{ asset('storage/'.auth()->user()->photo) }}">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h4>{{ auth()->user()->name }}</h4>
                            <p> {{ '@' . auth()->user()->username }} </p>
                            <p></p>
                        </div>

                    </div><div class="col-md-12">
                        <h6 style="margin:10px;"><i class="fas fa-map-marker-alt"></i><a href="https://www.google.com/maps/search/?api=1&query={{$event->location}}" target="_blank">Etkinlik Yeri: {{ $event->location }}</a> </h6>
                        <blockquote class="info">
                            <p>{{ $event->description }}</p>
                        </blockquote>
                    </div>
                    <div class="row" style="padding: 20px;">
                        <div class="col-md-12">
                            <p>Katılımcılar:</p>

                            <div class="col">
                                <img src="img/merve.jpg" class="km-thumbnail-img">
                                <img src="img/selcuk.jpg" class="km-thumbnail-img">
                                <img src="img/yucel.jpg" class="km-thumbnail-img">
                                <img src="img/ilayda.jpg" class="km-thumbnail-img">
                            </div>
                        </div>
                    </div>

                </div>





            </div>
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
                                <h4>{{ auth()->user()->name }}</h4>
                                <p> {{ '@' . auth()->user()->username }} </p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-default km-dark-green-btn"><b>Yeni Etkinlik Oluştur</b></button>
                </div>
            </div>
        </div>

    </div>





@endsection
