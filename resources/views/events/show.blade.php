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
                        <div class="event__owner-header">
                            <h3>Etkinliği Oluşturan:</h3>
                        </div>
                        <div class="event__owner">
                            @if($event->user->photo == '')
                                <img class="event__owner-profile" src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                            @else
                                <img class="event__owner-profile" src="{{ asset('storage/'.$event->user->photo) }}">
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
                                            <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                        @else
                                            <img src="{{ asset('storage/'.$user->photo) }}">
                                        @endif
                                    @endforeach
                                    @if($event->user->photo == '')
                                        <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                    @else
                                        <img src="{{ asset('storage/'.$event->user->photo) }}">
                                    @endif
                                @else
                                    @if($event->user->photo == '')
                                        <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                    @else
                                        <img src="{{ asset('storage/'.$event->user->photo) }}">
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
        // Initialize and add the map
        function initMap() {
            // The location of Uluru
            var uluru = {lat: 37.5525, lng: 29.6814};
            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 12, center: uluru});
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({position: uluru, map: map});
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpDW9uG7D9V4RMWQKJKO4iaYKijkOKmvI&callback=initMap">
    </script>
@endsection

