@extends('layouts.app')

@section('title')
    <title>Profilim</title>
@endsection

@section('content')
    @include('includes.navigation')

    <section id="section-profile">
        <div style="height: 200px;z-index: -1"></div>
        <div class="container">
            <div class="row">
                <div class="col-10 mx-auto">
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
                                    <p>55</p>
{{--                                    <p>{{ $events->count() }}</p>--}}
                                </div>
                                <p>Şimdiye Kadar Yaptığım</p>
                                <p>Kamp Sayısı</p>
                            </div>
                            <div class="events__position-info-2">
                                <div>
                                    <img src="{{asset('img/kampdas-logo.png')}}" />
                                    <p>159</p>
{{--                                    <p>{{ $events->count() + $attendee }}</p>--}}
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
        let url = 'http://kampdas.org/api/etkinlikler';
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
                    console.log(data[0].lat)


                    var uluru = {lat: parseFloat(data[0].lat), lng: parseFloat(data[0].lng)};
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 4,
                        center: uluru
                    });

                    data.forEach((info, i) => {
                        var contentString = '<div id="content">'+
                            '<div id="siteNotice">'+
                            '</div>'+
                            `<h1 id="firstHeading" class="firstHeading text-center">${info.title}</h1>`+
                            '<div id="bodyContent">'+
                            `<p>${info.description}</p>`+
                            `<a href="/etkinlikler/${info.slug}" class="btn btn-success">Tikla</a>`
                        '</div>'+
                        '</div>';
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
                                url: 'https://kampdas.org/img/camp-logo.png',
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
