@extends('layouts.app')

@section('title')
    <title>Kampdaş</title>
@endsection

@section('content')
    @include('includes.navigation')

    <section id="section-home">
        <div style="height: 200px;z-index: -1"></div>

        <div class="container">
            <div class="">
                {{--                @if(auth()->user()->hasVerifiedEmail())--}}
                {{--                    <div class="jumbotron jumbotron-fluid">--}}
                {{--                        <div class="container">--}}
                {{--                            <h1 class="display-4 text-center">Fluid jumbotron</h1>--}}
                {{--                            <p class="lead text-center">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                @endif--}}
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="events__position">
                        <div class="events__position-info">
                            <div class="events__position-info-2">
                                <div>
                                    <img src="{{asset('img/kampdas-logo.png')}}" />
                                    <p id="events__week">{{ $events->count() }}</p>
                                </div>
                                <p>Bu Hafta Gerçekleşecek</p>
                                <p>Kamp Etkinlikleri </p>
                            </div>
                            <div class="events__position-info-2">
                                <div>
                                    <img src="{{asset('img/kampdas-logo.png')}}" />
                                    <p id="events__month">{{ $events->count() + $attendee }}</p>
                                </div>
                                <p>Bu Ay Gerçekleşecek</p>
                                <p>Kamp Etkinlikleri </p>
                            </div>
                            <div class="events__position-info-2">
                                <div>
                                    <img src="{{asset('img/kampdas-logo.png')}}" />
                                    <p id="events__future">{{ $events->count() + $attendee }}</p>
                                </div>
                                <p>Gelecekte Gerçekleşecek</p>
                                <p>Kamp Etkinlikleri </p>
                            </div>
                        </div>
                        <div id="map" class="events__position-map"></div>
                        <div class="events__position-info">
                            <div class="events__position-info-1">
                                <div>
                                    <img src="{{asset('img/camp-logo.png')}}" />
                                    <p>{{ $events->count() }}</p>
                                </div>
                                <p>Toplam Açık Olan</p>
                                <p>Etkinlik Sayısı </p>
                            </div>
                            <div class="events__position-info-2">
                                <div>
                                    <img src="{{asset('img/kampdas-logo.png')}}" />
                                    <p>{{ $events->count() + $attendee }}</p>
                                </div>
                                <p>Etkinliğe Katılan</p>
                                <p>Toplam Kişi Sayısı </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="col-md-12">
                        <div class="events__banner">
                            <p class="events__banner-pinned">
                                Başa Tutturulan Etkinlikler</p>
                        </div>
                        @foreach($events as $event)
                            @if($event->is_pinned == 1)

                                <figure class="events">
                                    <div class="events__hero">
                                        <div class="events__hero-top_logo">
                                            <img src={{ asset('img/kampdas-logo1.png') }} />
                                        </div>

                                        <div id="{{$event->slug}}" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100" src="{{ asset('img/hotel-1.jpg') }}" alt="First slide">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="{{ asset('img/hotel-2.jpg') }}" alt="Second slide">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="{{ asset('img/hotel-3.jpg') }}" alt="Third slide">
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#{{$event->slug}}" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#{{$event->slug}}" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                        <div class="events__hero-bottom">
                                            <div class="events__hero-bottom_logo"></div>
                                        </div>

                                    </div>
                                    <div class="events__content">
                                        <div class="events__date">
                                            @foreach($data as $d)
                                                @if( $d['event_id'] === $event->id)
                                                    <img class="events__logo" src="{{ asset('img/calendar-512.webp') }}" alt="Kampdaş">
                                                    <span class="events__date-info">{{ $d['date'] }}</span>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="events__title">
                                            <img class="events__logo" src="{{ asset('img/camp-logo.png') }}" alt="Kampdaş">
                                            <a
                                                class="events__heading u-center-text"
                                                href="{{ route('events.show', $event->slug) }}"
                                            >
                                                {{ $event->title }}
                                            </a>


                                        </div>
                                        <div class="events__location">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <a class="events__location-detail"
                                               href="https://www.google.com/maps/search/?api=1&query={{$event->location}}" target="_blank">
                                                {{ Str::Limit($event->location,44) }}
                                            </a>
                                        </div>

                                        <div class="events__owner">
                                            <span>Etkinliği Oluşturan:</span>

                                            @if($event->user->photo == '')
                                                <img class="events__owner-profile" src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                            @else
                                                <img class="events__owner-profile" src="{{ asset('/'.$event->user->photo) }}">
                                            @endif
                                            <div class="events__owner-details">
                                                <span class="events__owner-name">{{ $event->user->name }}</span>
                                                <span class="events__owner-username">{{ '@'.$event->user->username }}</span>
                                            </div>
                                        </div>
                                        <div class="events__attendee">
                                            <span>Etkinliğe Katılanlar: </span>
                                            <span class="ml-2">{{ $event->limit === 0 ? $event->users->count() + 1 : $event->users->count() + 1 . '/' . $event->limit}}</span>
                                        </div>
                                        <div class="events__attendee-profile">
                                            @if($event->users->count() > 0)
                                                @foreach($event->users as $user)
                                                    @if($user->photo == '')
                                                        <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                                    @else
                                                        <img src="{{ asset('/'.$user->photo) }}">
                                                    @endif
                                                @endforeach
                                                @if($event->user->photo == '')
                                                    <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                                @else
                                                    <img src="{{ asset('/'.$event->user->photo) }}">
                                                @endif
                                            @else
                                                @if($event->user->photo == '')
                                                    <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                                @else
                                                    <img src="{{ asset('/'.$event->user->photo) }}">
                                                @endif
                                            @endauth
                                        </div>
                                        <div class="events__details">
                                            @auth
                                                @if(auth()->user()->id != $event->created_by)
                                                    @if($event->users->count() + 1 == $event->limit && !$isAttended)
                                                        <button
                                                            class="bttn bttn__events-attend" disabled="disabled">
                                                            Kontenjan Doldu
                                                        </button>
                                                    @elseif($event->users->isEmpty())
                                                        <form action="{{ route('events.attend', $event->slug)}}" method="POST">
                                                            @csrf
                                                            <button
                                                                class="bttn bttn__events-attend">
                                                                Katıl
                                                                <div class="bttn__events-attend__horizontal"></div>
                                                                <div class="bttn__events-attend__vertical"></div>
                                                            </button>
                                                        </form>
                                                    @elseif($isAttended)
                                                        <form action="{{ route('events.leave', $event->slug)}}" method="POST">
                                                            @csrf
                                                            <button
                                                                class="bttn bttn__events-leave">
                                                                Ayrıl
                                                                <div class="bttn__events-attend__horizontal"></div>
                                                                <div class="bttn__events-attend__vertical"></div>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('events.attend  ', $event->slug)}}" method="POST">
                                                            @csrf
                                                            <button
                                                                class="bttn bttn__events-attend">
                                                                Katıl
                                                                <div class="bttn__events-attend__horizontal"></div>
                                                                <div class="bttn__events-attend__vertical"></div>
                                                            </button>
                                                        </form>
                                                    @endif
                                                @else
                                                    <button style="visibility: hidden"
                                                            class="bttn bttn__events-attend">
                                                        Katıl
                                                        <div class="bttn__events-attend__horizontal"></div>
                                                        <div class="bttn__events-attend__vertical"></div>
                                                    </button>
                                                @endif
                                            @endauth
                                            <a href="{{ route('events.show', $event->slug) }}" class="bttn bttn__events-detail">
                                                <span>Etkinlik Sayfasına Git</span>
                                                <svg width="13px" height="10px" viewBox="0 0 13 10">
                                                    <path d="M1,5 L11,5"></path>
                                                    <polyline points="8 1 12 5 8 9"></polyline>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="events__bottom-logo">
                                        </div>
                                    </div>
                                    <div class="events__social-buttons">
                                        <a class="fb" rel="nofollow" target="_blank"
                                           href="https://www.facebook.com/share.php?u=https://www.kampdas.org/etkinlik/{{$event->slug}}"
                                           data-link="https://www.facebook.com/share.php?u=https://www.kampdas.org/etkinlik/{{$event->slug}}">
                                            <i class="fab fa-facebook-f"></i><span></span>
                                        </a>
                                        <a id="share" class="tw" href="https://twitter.com/share?original_referer=/&text=&url=
                                        https://www.kampdas.org/etkinlik/{{$event->slug}}" data-link="https://twitter.com/share?original_referer=/&text=&url=
                                        https://www.kampdas.org/etkinlik/{{$event->slug}}" target="_blank">
                                            <i class="fab fa-twitter"></i><span></span>
                                        </a>
                                        <a id="share" class="ln"
                                           href="https://www.linkedin.com/cws/share?url=https://www.kampdas.org/etkinlik/{{$event->slug}}"
                                           data-link="https://www.linkedin.com/cws/share?url=https://www.kampdas.org/etkinlik/{{$event->slug}}"
                                           target="_blank">
                                            <i class="fab fa-linkedin"></i><span></span>
                                        </a>
                                        <a name="whatsapp" id="share" class="wp"
                                           href="https://api.whatsapp.com/send?text=https://www.kampdas.org/etkinlik/{{$event->slug}}" target="_blank">
                                            <i class="fab fa-whatsapp"></i><span></span>
                                        </a>
                                    </div>
                                </figure>


                            @endif
                        @endforeach
                    </div>
                    <hr>
                    <div class="col-sm-12" style="text-align:right">
                        <a href="#">
                            <p>Devamı İçin Tıklayınız.</p>
                        </a>
                    </div>
                    <div class="col-md-12">
                        <div class="events__banner">
                            <p class="events__banner-oncoming">
                                Yaklaşan Etkinlikler</p>
                        </div>
                        @foreach($events as $event)
                            @if($event->is_pinned == 0)
                                <figure class="events">
                                    <div class="events__hero">
                                        <div class="events__hero-top_logo">
                                            <img src={{ asset('img/kampdas-logo1.png') }} />
                                        </div>

                                        <div id="{{$event->slug}}" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100" src="{{ asset('img/hotel-1.jpg') }}" alt="First slide">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="{{ asset('img/hotel-2.jpg') }}" alt="Second slide">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="{{ asset('img/hotel-3.jpg') }}" alt="Third slide">
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#{{$event->slug}}" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#{{$event->slug}}" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                        <div class="events__hero-bottom">
                                            <div class="events__hero-bottom_logo"></div>
                                        </div>

                                    </div>
                                    <div class="events__content">
                                        <div class="events__date">
                                            @foreach($data as $d)
                                                @if( $d['event_id'] == $event->id)
                                                    <img class="events__logo" src="{{ asset('img/calendar-512.webp') }}" alt="Kampdaş">
                                                    <span class="events__date-info">{{ $d['date'] }}</span>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="events__title">
                                            <img class="events__logo" src="{{ asset('img/camp-logo.png') }}" alt="Kampdaş">
                                            <a
                                                class="events__heading u-center-text"
                                                href="{{ route('events.show', $event->slug) }}"
                                            >
                                                {{ $event->title }}
                                            </a>


                                        </div>
                                        <div class="events__location">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <a class="events__location-detail"
                                               href="https://www.google.com/maps/search/?api=1&query={{$event->location}}" target="_blank">
                                                {{ Str::Limit($event->location,44) }}
                                            </a>
                                        </div>

                                        <div class="events__owner">
                                            <span>Etkinliği Oluşturan:</span>

                                            @if($event->user->photo == '')
                                                <img class="events__owner-profile" src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                            @else
                                                <img class="events__owner-profile" src="{{ asset('/'.$event->user->photo) }}">
                                            @endif
                                            <div class="events__owner-details">
                                                <span class="events__owner-name">{{ $event->user->name }}</span>
                                                <span class="events__owner-username">{{ '@'.$event->user->username }}</span>
                                            </div>
                                        </div>
                                        <div class="events__attendee">
                                            <span>Etkinliğe Katılanlar: </span>
                                            <span class="ml-2">{{ $event->limit === 0 ? $event->users->count() + 1 : $event->users->count() + 1 . '/' . $event->limit}}</span>
                                        </div>
                                        <div class="events__attendee-profile">
                                            @if($event->users->count() > 0)
                                                @foreach($event->users as $user)
                                                    @if($user->photo == '')
                                                        <img class="events__owner-profile" src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                                    @else
                                                        <img class="events__owner-profile" src="{{ asset('/'.$user->photo) }}">
                                                    @endif
                                                @endforeach
                                                @if($event->user->photo == '')
                                                    <img class="events__owner-profile" src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                                @else
                                                    <img class="events__owner-profile" src="{{ asset('/'.$event->user->photo) }}">
                                                @endif
                                            @else
                                                @if($event->user->photo == '')
                                                    <img class="events__owner-profile" src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                                @else
                                                    <img class="events__owner-profile" src="{{ asset('/'.$event->user->photo) }}">
                                                @endif
                                            @endauth
                                        </div>
                                        <div class="events__details">
                                            @auth
                                                @if(auth()->user()->id != $event->created_by)
                                                    @if($event->users->count() + 1 == $event->limit && !$isAttended)
                                                        <button
                                                            class="bttn bttn__events-attend" disabled="disabled">
                                                            Kontenjan Doldu
                                                        </button>
                                                    @elseif($event->users->isEmpty())
                                                        <form action="{{ route('events.attend', $event->slug)}}" method="POST">
                                                            @csrf
                                                            <button
                                                                class="bttn bttn__events-attend">
                                                                Katıl
                                                                <div class="bttn__events-attend__horizontal"></div>
                                                                <div class="bttn__events-attend__vertical"></div>
                                                            </button>
                                                        </form>
                                                    @elseif($isAttended)
                                                        <form action="{{ route('events.leave', $event->slug)}}" method="POST">
                                                            @csrf
                                                            <button
                                                                class="bttn bttn__events-leave">
                                                                Ayrıl
                                                                <div class="bttn__events-attend__horizontal"></div>
                                                                <div class="bttn__events-attend__vertical"></div>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('events.attend  ', $event->slug)}}" method="POST">
                                                            @csrf
                                                            <button
                                                                class="bttn bttn__events-attend">
                                                                Katıl
                                                                <div class="bttn__events-attend__horizontal"></div>
                                                                <div class="bttn__events-attend__vertical"></div>
                                                            </button>
                                                        </form>
                                                    @endif
                                                @else
                                                    <button style="visibility: hidden"
                                                            class="bttn bttn__events-attend">
                                                        Katıl
                                                        <div class="bttn__events-attend__horizontal"></div>
                                                        <div class="bttn__events-attend__vertical"></div>
                                                    </button>
                                                @endif
                                            @endauth

                                            <a href="{{ route('events.show', $event->slug) }}" class="bttn bttn__events-detail">
                                                <span>Etkinlik Sayfasına Git</span>
                                                <svg width="13px" height="10px" viewBox="0 0 13 10">
                                                    <path d="M1,5 L11,5"></path>
                                                    <polyline points="8 1 12 5 8 9"></polyline>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="events__bottom-logo">
                                        </div>
                                    </div>
                                    <div class="events__social-buttons">
                                        <a class="fb" rel="nofollow" target="_blank"
                                           href="https://www.facebook.com/share.php?u=https://www.kampdas.org/etkinlik/{{$event->slug}}"
                                           data-link="https://www.facebook.com/share.php?u=https://www.kampdas.org/etkinlik/{{$event->slug}}">
                                            <i class="fab fa-facebook-f"></i><span></span>
                                        </a>
                                        <a id="share" class="tw" href="https://twitter.com/share?original_referer=/&text=&url=
                                        https://www.kampdas.org/etkinlik/{{$event->slug}}" data-link="https://twitter.com/share?original_referer=/&text=&url=
                                        https://www.kampdas.org/etkinlik/{{$event->slug}}" target="_blank">
                                            <i class="fab fa-twitter"></i><span></span>
                                        </a>
                                        <a id="share" class="ln"
                                           href="https://www.linkedin.com/cws/share?url=https://www.kampdas.org/etkinlik/{{$event->slug}}"
                                           data-link="https://www.linkedin.com/cws/share?url=https://www.kampdas.org/etkinlik/{{$event->slug}}"
                                           target="_blank">
                                            <i class="fab fa-linkedin"></i><span></span>
                                        </a>
                                        <a name="whatsapp" id="share" class="wp"
                                           href="https://api.whatsapp.com/send?text=https://www.kampdas.org/etkinlik/{{$event->slug}}" target="_blank">
                                            <i class="fab fa-whatsapp"></i><span></span>
                                        </a>
                                    </div>
                                </figure>


                            @endif
                        @endforeach
                    </div>
                    <hr>
                    <div class="col-sm-12" style="text-align:right"><a href="#">
                            <p>Devamı İçin Tıklayınız.</p>
                        </a></div>
                </div>

                <div class="col-md-4">
                    @auth
                        @if(!auth()->user()->photo)
                            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModalCenter">
                                <img class="events__logo" src="{{ asset('img/camp-logo.png') }}" alt="Kampdaş"> Kamp Etkinliği Oluştur
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Profilini Tamamla</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Tamamlanmış bir profil kişilerin size duyacağı güveni arttırır.
                                            Oluşturacağınız kamp etkinliğine katılım oranını artırabilmek için profilinizi tamamlamalısınız.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                                            <button type="button" class="btn btn-primary">Profilini Tamamla</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('events.create') }}" class="btn btn-outline-success" id="btn-event"><img class="events__logo" src="{{ asset('img/camp-logo.png') }}" alt="Kampdaş"> Kamp Etkinliği Oluştur</a>
                        @endif
                    @else
                        <a href="{{ route('events.create') }}" class="btn btn-outline-success" id="btn-event"><img class="events__logo" src="{{ asset('img/camp-logo.png') }}" alt="Kampdaş"> Kamp Etkinliği Oluştur</a>
                    @endauth
                </div>
            </div>
        </div>
        <div style="height: 200px"></div>
    </section>

@endsection

@section('scripts')
    <script>

        // This example displays a marker at the center of Australia.
        // When the user clicks the marker, an info window opens.
        let url = 'https://kampdas.org/api/etkinlikler';
        getAdvisers = () => {
            return window
                .fetch(url, {
                    method: 'GET'
                })
                .then(response => {
                    return response.json();
                })
                .catch(err => console.log(err));
        };



        function initMap() {
            var activeInfoWindow;
            var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            getAdvisers().then(data => {
                if (data.error) {
                    console.log(data.error);
                } else {

                    var uluru = {lat: 39.142401, lng: 35.408133};
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 5.5,
                        center: uluru
                    });

                    data.forEach((info, i) => {
                        var contentString = `<figure class="events">
                                        <div class="events__hero">
                                            <div class="events__hero-top_logo">
                                                <img src='/img/kampdas-logo1.png' />
                                            </div>
                                            <div id="${info.slug}" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <img class="d-block w-100" src='/img/hotel-1.jpg' alt="First slide">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100" src='/img/hotel-3.jpg' alt="Second slide">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100" src='/img/hotel-2.jpg'" alt="Third slide">
                                                    </div>
                                                </div>
                                                <a class="carousel-control-prev" href="#${info.slug}" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#${info.slug}" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                            <div class="events__hero-bottom">
                                                <div class="events__hero-bottom_logo"></div>
                                            </div>

                                        </div>
                                        <div class="events__content">
                                            <div class="events__title">
                                                <img class="events__logo" src='/img/camp-logo.png' alt="Kampdaş">
                                                <a
                                                    class="events__heading u-center-text"
                                                    href="/etkinlik/${info.slug}"
                                                >
                                                    ${info.title}
                                                </a>
                                            </div>
                                            <div class="events__location">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <a class="events__location-detail"
                                                   href="https://www.google.com/maps/search/?api=1&query=${info.location}" target="_blank">
                                                    ${info.location}
                                                </a>
                                            </div>

                                            <div class="events__owner">
                                                <span>Etkinliği Oluşturan:</span>
                                                    <img class="events__owner-profile" src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                                <div class="events__owner-details">
                                                    <span class="events__owner-name">Omer Garip</span>
                                                    <span class="events__owner-username">ogarip</span>
                                                </div>
                                            </div>
                                            <div class="events__attendee">
                                                <span>Etkinliğe Katılanlar: </span>
                                                <span class="ml-2">1/10</span>
                                            </div>
                                            <div class="events__attendee-profile">
                                               <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                            </div>
                                            <div class="events__details">
                                                <button
                                                    onclick="window.location='/etkinlik/${info.slug}"
                                                    class="bttn bttn__events-attend">
                                                    Katıl
                                                    <div class="bttn__events-attend__horizontal"></div>
                                                    <div class="bttn__events-attend__vertical"></div>
                                                </button>
                                                <a href="/etkinlik/${info.slug}" class="bttn bttn__events-detail">
                                                    <span>Etkinlik Sayfasına Git</span>
                                                    <svg width="13px" height="10px" viewBox="0 0 13 10">
                                                        <path d="M1,5 L11,5"></path>
                                                        <polyline points="8 1 12 5 8 9"></polyline>
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="events__bottom-logo">
                                            </div>
                                        </div>
                                        <div class="events__social-buttons">
                                            <a class="fb" rel="nofollow" target="_blank"
                                               href="https://www.facebook.com/share.php?u=https://www.kampdas.org/etkinlik/{{$event->slug}}"
                                               data-link="https://www.facebook.com/share.php?u=https://www.kampdas.org/etkinlik/{{$event->slug}}">
                                                <i class="fab fa-facebook-f"></i><span></span>
                                            </a>
                                            <a id="share" class="tw" href="https://twitter.com/share?original_referer=/&text=&url=
                                        https://www.kampdas.org/etkinlik/{{$event->slug}}" data-link="https://twitter.com/share?original_referer=/&text=&url=
                                        https://www.kampdas.org/etkinlik/{{$event->slug}}" target="_blank">
                                                <i class="fab fa-twitter"></i><span></span>
                                            </a>
                                            <a id="share" class="ln"
                                               href="https://www.linkedin.com/cws/share?url=https://www.kampdas.org/etkinlik/{{$event->slug}}"
                                               data-link="https://www.linkedin.com/cws/share?url=https://www.kampdas.org/etkinlik/{{$event->slug}}"
                                               target="_blank">
                                                <i class="fab fa-linkedin"></i><span></span>
                                            </a>
                                            <a name="whatsapp" id="share" class="wp"
                                               href="https://api.whatsapp.com/send?text=https://www.kampdas.org/etkinlik/{{$event->slug}}" target="_blank">
                                                <i class="fab fa-whatsapp"></i><span></span>
                                            </a>
                                        </div>
                                    </figure> `;

                        var infowindow = new google.maps.InfoWindow({
                            content: contentString
                        });

                        var marker = new google.maps.Marker({
                            position: {
                                lat: parseFloat(info.lat),
                                lng: parseFloat(info.lng)
                            },
                            animation: google.maps.Animation.DROP,
                            map: map,
                            title: info.title,
                            icon: {
                                url: 'https://image.flaticon.com/icons/svg/2673/2673330.svg',
                                scaledSize: new google.maps.Size(25, 25),
                            },
                            label: labels[i % labels.length]
                        });


                        marker.addListener('click', function() {

                            if (activeInfoWindow) { activeInfoWindow.close();}
                            infowindow.open(map, marker);
                            activeInfoWindow = infowindow;
                        });
                    })

                }
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpDW9uG7D9V4RMWQKJKO4iaYKijkOKmvI&callback=initMap">
    </script>
@endsection
