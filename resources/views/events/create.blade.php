@extends('layouts.app')

@section('title')
    <title>Etkinlik Oluştur</title>
@endsection

@section('content')
    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                        <li class="list-group-item">
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card card-default">
            <div class="card-header">
                {{ isset($event) ? 'Etkinliği Düzenle' :  'Yeni Etkinlik Ekle' }}
            </div>
            <div class="card-body">
                <form action="{{ isset($event) ? route('events.update', $event->slug) : route('events.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($event))
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="title">Başlık</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ isset($event) ? $event->title : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="location">Konum</label>
                        <input type="text" class="form-control" name="location" id="location" value="{{ isset($event) ? $event->location : '' }}">
                        <input type="hidden" name="lat" id="lat" value="{{ isset($event) ? $event->lat : '' }}" >
                        <input type="hidden" name="lng" id="lng" value="{{ isset($event) ? $event->lng : '' }}" >
                    </div>
                    <div class="form-group">
                        <label for="description">Açıklama</label>
                        <input type="text" class="form-control" name="description" id="description" value="{{ isset($event) ? $event->description : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="limit">Kontejyan</label>
                        <input type="text" class="form-control" name="limit" id="limit" value="{{ isset($event) ? $event->limit : '' }}">
                        <input type="checkbox" id="limitless">Sinirsiz
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">
                            {{ isset($event) ? 'Güncelle' : 'İkinci Adım' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection




@section('scripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGutj4a-6ZWDix23sZTPt30IFrKjo_iFM&libraries=places"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
    <script>
        flatpickr("#deadline");

        var input = document.getElementById('location');
        var options = {
            componentRestrictions: {country: "TR"}
        };
        var autocomplete = new google.maps.places.Autocomplete(input, options);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            document.getElementById("lat").value = lat;
            document.getElementById("lng").value = lng;
        });

    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
@endsection
