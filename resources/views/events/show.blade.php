@extends('layouts.app')

@section('title')
    <title>{{ $event->title }}</title>
@endsection

@section('content')
    @include('includes.navigation')
    <div style="height: 200px;z-index: -1"></div>
    <section id="section-event">
        <div class="container">
            <div class="row">
                {{--        @if(auth()->id() == $event->created_by)--}}
                {{--            <div class="form-group mb-5">--}}
                {{--                <a href="{{ route('events.edit', $event->slug) }}" class="form-control btn btn-sm btn-primary">Güncelle</a>--}}
                {{--                <form action="{{ route('events.delete', $event->id)}}" method="POST">--}}
                {{--                    @csrf--}}
                {{--                    @method('DELETE')--}}
                {{--                    <button class="form-control btn btn-sm btn-danger">Sil</button>--}}
                {{--                </form>--}}
                {{--            </div>--}}
                {{--        @endif--}}
                {{--        <div class="col-md-6">--}}
                {{--            @if($event->profile->isEmpty())--}}
                {{--                <form action="{{ route('events.attend', $event->slug)}}" method="POST">--}}
                {{--                    @csrf--}}
                {{--                    <button class="form-control btn btn-sm btn-info">Katil</button>--}}
                {{--                </form>--}}
                {{--            @elseif(!$isAttended)--}}
                {{--                <form action="{{ route('events.attend', $event->slug)}}" method="POST">--}}
                {{--                    @csrf--}}
                {{--                    <button class="form-control btn btn-sm btn-info">Katil</button>--}}
                {{--                </form>--}}
                {{--            @else--}}
                {{--                <form action="{{ route('events.leave', $event->slug)}}" method="POST">--}}
                {{--                    @csrf--}}
                {{--                    @method('DELETE')--}}
                {{--                    <button class="form-control btn btn-sm btn-danger">Ayril</button>--}}
                {{--                </form>--}}
                {{--            @endif--}}
                {{--        </div>--}}



                <div class="col-md-10 mx-auto">
                    <figure class="event">
                        <div class="event__header">
                            <img class="event__header-logo" src="{{ asset('img/camp-logo.png') }}" />
                            <p class="event__header-title">{{ Str::Limit($event->title,75) }}</p>
                            @if(auth()->user()->id === $event->created_by)
                                <a class="event__header-edit" href="{{ route('events.edit', $event->slug) }}" >
                                    <img src="{{ asset('img/editicon.png') }}" />
                                </a>
                            @endif
                        </div>
                        <div class="event__slider">
                            @if($media->count() == 0)
                                <img class="d-block w-100" src="{{ '/' .  $first_media[0]->photo }}" alt="{{ $event->title }}">
                            @else
                                <div id="{{$event->slug}}" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" src="{{ '/' .  $first_media[0]->photo }}" alt="{{ $event->title }}">
                                        </div>
                                        @foreach($media as $m)
                                            <div class="carousel-item">
                                                <img class="d-block w-100" src="{{ '/' .  $m->photo }}" alt="{{ $event->title }}">
                                            </div>
                                        @endforeach
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
                            @endif

                        </div>
                        <div class="event__share">
                            <div class="event__share-button">
                                <span><i class="fas fa-share-alt"></i>  Paylaş</span>
                                <a class="fb" rel="nofollow" target="_blank"href="https://www.facebook.com/share.php?u=https://www.kampdas.org/etkinlik/{{$event->slug}}"
                                   data-link="https://www.facebook.com/share.php?u=https://www.kampdas.org/etkinlik/{{$event->slug}}">
                                    <i class="fab fa-facebook-f"></i>
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
                        </div>
                        <div class="event__location">
                            <div id="map" class="event__location-map"></div>
                        </div>
                        <section id="section-login">
                            <div class="container-login100-form-btn" style="width: 45rem; height: 5rem; margin: 0 auto;">
                                <div class="wrap-login100-form-btn">
                                    <div class="login100-form-bgbtn"></div>
                                    <button class="login100-form-btn"
                                            onclick="window.open('https://www.google.com/maps/search/?api=1&query={{$event->location}}')" >
                                        Yol Tarifi İçin Buraya Tıklayınız
                                    </button>
                                </div>
                            </div>
                        </section>
                        <div class="event__owner-header">
                            <h3>Etkinliği Oluşturan:</h3>
                        </div>
                        <div class="event__owner">
                            @if($event->user->photo == '')
                                <a href="{{ route('profile', $event->user->username) }}">
                                    <img class="events__owner-profile" src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png"></a>
                            @else
                                <a href="{{ route('profile', $event->user->username) }}">
                                    <img class="events__owner-profile" src="{{ asset('/'.$event->user->photo) }}"></a>
                            @endif
                            <div class="event__owner-info">
                                <h4>{{ $event->user->name }}</h4>
                                <h6>{{ '@' . $event->user->username }}</h6>
                            </div>
                        </div>
                        <div class="event__description">
                            <p>{{ $event->description }}</p>
                        </div>
                        <div class="event__attendee">
                            <div class="event__attendee-header">
                                <h3>Etkinliğe Katılanlar: {{ $event->limit === 0 ? $event->users->count() + 1 : $event->users->count() + 1 . '/' . $event->limit}}</h3>
                                @if(auth()->user()->id !== $event->created_by)
                                    @if($event->users->count() + 1 === $event->limit && !$isAttended)
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
                                @endif

                            </div>
                            <div class="event__attendee-profile">
                                @if($event->users->count() > 0)
                                    @foreach($event->users as $user)
                                        @if($user->photo == '')
                                            <a href="{{ route('profile', $user->username) }}">
                                                <img class="events__owner-profile" src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                            </a>
                                        @else
                                            <a href="{{ route('profile', $user->username) }}">
                                                <img class="events__owner-profile" src="{{ asset('/'.$user->photo) }}">
                                            </a>
                                        @endauth
                                    @endforeach
                                    @if($event->user->photo == '')
                                        <a href="{{ route('profile', $event->user->username) }}">
                                            <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                            @else
                                                <a href="{{ route('profile', $event->user->username) }}">
                                                    <img src="{{ asset('/'.$event->user->photo) }}">
                                                </a>
                                            @endif
                                            @else
                                                @if($event->user->photo == '')
                                                    <a href="{{ route('profile', $event->user->username) }}">
                                                        <img src="https://www.pngkey.com/png/detail/230-230
                                        </a>1779_best-classified-apps-default-user-profile.png">
                                                        @else
                                                            <a href="{{ route('profile', $event->user->username) }}">
                                                                <img src="{{ asset('/'.$event->user->photo) }}">
                                                            </a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                        <div class="event__comments">
                            <div class="fb-comments" data-href="http://kampdas.test/etkinlik/{{$event->slug}}" data-numposts="10" data-width="100%"></div>
                        </div>
                    </figure>
                </div>
            </div>
        </div>
        <div style="height: 200px;z-index: -1"></div>
    </section>
    <div id="fb-root"></div>
@endsection

@section('scripts')

    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/tr_TR/sdk.js#xfbml=1&version=v7.0" nonce="wwo9Zgxt"></script>
    <script>
        console.log(window.location.hostname + '/api' + window.location.pathname)
        let url = '/api' + window.location.pathname + '/bilgileri-al';
        getEventInfo = () => {
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
            getEventInfo().then(data => {
                if (data.error) {
                    console.log(data.error);
                } else {
                    console.log(typeof (data.lng))
                    var uluru = {lat: parseFloat(data.lat), lng: parseFloat(data.lng)};
                    var map = new google.maps.Map(
                        document.getElementById('map'), {zoom: 12, center: uluru});
                    var marker = new google.maps.Marker({position: uluru, map: map});
                }
            });

        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpDW9uG7D9V4RMWQKJKO4iaYKijkOKmvI&callback=initMap">
    </script>
@endsection

