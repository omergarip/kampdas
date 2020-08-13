@extends('layouts.app')

@section('title')
    <title>Profilim</title>
@endsection

@section('content')
    @include('includes.navigation')

    <section id="section-profile">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-md-11 mx-auto">
                    <div class="events__position">
                        @if(auth()->user()->username === $user->username)
                            <p>Şimdiye Kadar Yaptığım Kamplar</p>
                        @else
                            <p>{{ $user->name }} Adlı Kullanıcının Şimdiye Kadar Yaptığı Kamplar</p>
                        @endif
                        <div id="map" class="events__position-map"></div>
                        <div class="events__position-info">
                            <div class="events__position-info-1">
                                <div>
                                    <img src="{{asset('img/camp-logo.png')}}" />
                                    <p>{{ $numberOfEvent }}</p>
                                </div>
                                <p>Şimdiye Kadar Yaptığım</p>
                                <p>Kamp Sayısı</p>
                            </div>
                            <div class="events__position-info-2">
                                <div>
                                    <img src="{{asset('img/kampdas-logo.png')}}" />
                                    <p>-</p>
                                </div>
                                <p>Birlikte Kamp Yaptığım</p>
                                <p>Kampdaş Sayısı</p>
                            </div>
                        </div>
                    </div>
                    <div class="profile__owner">
                        @if($user->photo == '')
                            <img class="profile__owner-profile" src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                        @else
                            <img class="profile__owner-profile" src="{{ asset('/'.$user->photo) }}">
                        @endif
                        <div class="profile__owner-info">
                            <h4>{{ $user->name . ', ' . $user->calculateAge() }}</h4>
                            <h6>{{ '@' . $user->username }}</h6>
                        </div>
                        @if(auth()->user()->username === $user->username)
                            <div class="profile__owner-edit">
                                <div>
                                    <p>Profili </p>
                                    <p>Düzenle</p>
                                </div>
                                <a href="{{ route('profile.edit', $user->username) }}" >
                                    <img src="{{ asset('img/editicon.png') }}" />
                                </a>
                            </div>

                        @endif

                    </div>
                    <div class="profile__bio">
                        <p>{{ $user->bio }}</p>
                    </div>
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
        let url = `https://kampdas.org/api${location.pathname}/katildigim-etkinlikler`;
        let thisMonth = "https://kampdas.org/api/etkinlikler/bu-ay"
        let thisWeek = "https://kampdas.org/api/etkinlikler/bu-hafta"
        let future = "https://kampdas.org/api/etkinlikler/gelecekte"
        $.getJSON(thisWeek , data => $('#events__week').text(data.length));
        $.getJSON(thisMonth , data => $('#events__month').text(data.length));
        $.getJSON(future , data => $('#events__future').text(data.length));
        getEvents = () => {
            return window
                .fetch(url, {
                    method: 'GET'
                })
                .then(response => {
                    return response.json();
                })
                .catch(err => console.log(err));
        };
        getEventsInWeek = () => {
            return window
                .fetch(thisWeek, {
                    method: 'GET'
                })
                .then(response => {
                    return response.json();
                })
                .catch(err => console.log(err));
        };
        getEventsInMonth = () => {
            return window
                .fetch(thisMonth, {
                    method: 'GET'
                })
                .then(response => {
                    return response.json();
                })
                .catch(err => console.log(err));
        };

        function initMap() {
            var activeInfoWindow;

            getEvents().then(data => {
                if (data.error) {
                    console.log(data.error);
                } else {

                    var uluru = {lat: 39.142401, lng: 35.408133};
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 5.5,
                        center: uluru
                    });

                    data.forEach((info, i) => {
                        console.log(info);
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
                                               href="https://www.facebook.com/share.php?u=https://www.kampdas.org/etkinlik/${info.slug}"
                                               data-link="https://www.facebook.com/share.php?u=https://www.kampdas.org/etkinlik/${info.slug}">
                                                <i class="fab fa-facebook-f"></i><span></span>
                                            </a>
                                            <a id="share" class="tw" href="https://twitter.com/share?original_referer=/&text=&url=
                                        https://www.kampdas.org/etkinlik/${info.slug}" data-link="https://twitter.com/share?original_referer=/&text=&url=
                                        https://www.kampdas.org/etkinlik/${info.slug}" target="_blank">
                                                <i class="fab fa-twitter"></i><span></span>
                                            </a>
                                            <a id="share" class="ln"
                                               href="https://www.linkedin.com/cws/share?url=https://www.kampdas.org/etkinlik/${info.slug}"
                                               data-link="https://www.linkedin.com/cws/share?url=https://www.kampdas.org/etkinlik/${info.slug}"
                                               target="_blank">
                                                <i class="fab fa-linkedin"></i><span></span>
                                            </a>
                                            <a name="whatsapp" id="share" class="wp"
                                               href="https://api.whatsapp.com/send?text=https://www.kampdas.org/etkinlik/${info.slug}" target="_blank">
                                                <i class="fab fa-whatsapp"></i><span></span>
                                            </a>
                                        </div>
                                    </figure> `;



                        var marker = new google.maps.Marker({
                            position: {
                                lat: parseFloat(info.lat),
                                lng: parseFloat(info.lng)
                            },
                            animation: google.maps.Animation.DROP,
                            map: map,
                            title: info.title,
                            icon: {
                                url: 'https://kampdas.org/img/camp-logo.png',
                                scaledSize: new google.maps.Size(25, 25),
                            }
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
