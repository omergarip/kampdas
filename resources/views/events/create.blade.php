@extends('layouts.app')

@section('title')
    <title>Etkinlik Oluştur</title>
@endsection

@section('content')
    <div class="container">
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
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ isset($event) ? $event->title :  old('title') }}">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="location">Konum</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror " name="location" id="location" value="{{ isset($event) ? $event->location : '' }}">

                        <input type="hidden" name="lat" id="lat" value="{{ isset($event) ? $event->lat : '' }}" >
                        <input type="hidden" name="lng" id="lng" value="{{ isset($event) ? $event->lng : '' }}" >
                        <input type="hidden" class="@error('county') is-invalid @enderror" name="county" id="county">
                        @if(!$errors->has('location'))
                            @error('county')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{!! $message !!}</strong>
                                </span>
                            @enderror
                        @else
                            @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description">Açıklama</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" value="{{ isset($event) ? $event->description : old('description') }}">
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="limit">Kontejyan</label>
                        <select name="limit" id="limit" class="form-control @error('limit') is-invalid @enderror">
                            <option selected disabled hidden>Kontejyan Seçiniz</option>
                            @if(isset($event))
                                <option selected value="{{ $event->limit  }}">{{ $event->limit  }}</option>
                            @endif
                        </select>
                        @error('limit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
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

        let input = document.getElementById('location');
        let options = {
            componentRestrictions: {country: "TR"}
        };
        let autocomplete = new google.maps.places.Autocomplete(input, options);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            let place = autocomplete.getPlace();
            let test = autocomplete.getPlace().address_components
            console.log(test);
            let county = document.getElementById("county");
            county.value = '';
            test.forEach(function(data){
                if(data.types.includes('administrative_area_level_4')){
                    console.log(data);
                    county.value = data.types[0];
                }
            });
            let lat = place.geometry.location.lat();
            let lng = place.geometry.location.lng();
            document.getElementById("lat").value = lat;
            document.getElementById("lng").value = lng;
        });

    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
@endsection
