@extends('layouts.app')

@section('title')
    <title>Profilim</title>
@endsection

@section('content')
    @include('includes.navigation')

    <section id="section-profile">
        <div class="container">
            <div class="row">
                <div class="col-10 mx-auto">

                    <div class="tabs">
                        <div class="tab-2">
                            <label for="tab2-1">Katıldığım Etkinlikler</label>
                            <input id="tab2-1" name="tabs-two" type="radio" checked="checked">
                            <div>
                                @foreach($attendedEvents as $event)
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
                                @endforeach
                                @foreach($createdEvents as $event)
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
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-2">
                            <label for="tab2-2">Yarım Kalan Etkinliklerim <span class="badge badge-danger">2</span></label>
                            <input id="tab2-2" name="tabs-two" type="radio" disabled>
                            <div>
                                <h4>Tab Two</h4>
                                <p>Quisque sit amet turpis leo. Maecenas sed dolor mi. Pellentesque varius elit in neque ornare commodo ac non tellus. Mauris id iaculis quam. Donec eu felis quam. Morbi tristique lorem eget iaculis consectetur. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean at tellus eget risus tempus ultrices. Nam condimentum nisi enim, scelerisque faucibus lectus sodales at.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div style="height: 200px"></div>
    </section>

@endsection
