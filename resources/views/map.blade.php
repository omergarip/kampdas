{{--@extends('layouts.app')--}}

{{--@section('title')--}}
{{--    <title>Türkiye Kamp Haritası</title>--}}
{{--@endsection--}}

{{--@section('content')--}}
{{--    @include('includes.navigation')--}}

{{--    <div style="height: 200px;z-index: -1"></div>--}}

{{--    <div style="height: 200px"></div>--}}
{{--@endsection--}}
    <!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Info Windows</title>
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
<div id="map"></div>

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
</body>
</html>
