@extends('layouts.app')

@section('title')
    <title>Etkinlik Oluştur</title>
@endsection

@section('content')
    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                {{ isset($event) ? 'Etkinliği Düzenle' :  'Yeni Kamp Etkinliği Oluştur' }}
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
                    <div class="form-inline d-flex justify-content-between">
                            <label for="start_date" class="mr-3">Başlangıç Tarihi</label>
                            <input type="text" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date" value="{{ isset($event) ? $event->start_date :  old('start_date') }}">
                            @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror


                            <label for="end_date" class="mx-3">Bitiş Tarihi</label>
                            <input type="text" class="form-control @error('end_date') is-invalid @enderror" name="end_date" id="end_date" value="{{ isset($event) ? $event->end_date :  old('end_date') }}">
                            @error('end_date')
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
                        <small className="form-text text-muted">
                            Sizinle birlikte kamp yapacak kampdaşların kamp yerini daha kolay bulabilmesi için lütfen daha ayrıntılı bir adres giriniz.<br/>
                            Ör. Akvaryum Koyu, Bozcaada/Çanakkale, Türkiye&emsp;&emsp;&emsp;<strike>Bozcaada/Çanakkale, Türkiye</strike>
                        </small>
                        @if($errors->has('location'))
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
                        <label for="limit">Kontenjan</label>
                        <select name="limit" id="limit" class="form-control @error('limit') is-invalid @enderror">
                            <option selected disabled hidden>Kontenjan Seçiniz</option>
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
                            {{ isset($event) ? 'Güncelle' : 'Fotoğraf Yükleme Adımına Geç' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection




@section('scripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpDW9uG7D9V4RMWQKJKO4iaYKijkOKmvI&libraries=places"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/tr.js"></script>
    <script>
        $("#start_date").flatpickr({
            locale: 'tr',
            enableTime: true,
            dateFormat: "d.m.Y H:i",
            minDate: new Date().fp_incr(5),
            onChange: function(date) {

                var selectedDate = new Date(date);
                var msecsInADay = 86400000;
                var endDate = new Date(selectedDate.getTime() + msecsInADay);
                $("#end_date").flatpickr({
                    minDate: endDate,
                    locale: 'tr',
                    enableTime: true,
                    dateFormat: "d.m.Y H:i"
                })
            }

        });

        let input = document.getElementById('location');
        let options = {
            componentRestrictions: {country: "TR"}
        };
        let autocomplete = new google.maps.places.Autocomplete(input, options);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            let place = autocomplete.getPlace();
            let lat = place.geometry.location.lat();
            let lng = place.geometry.location.lng();
            document.getElementById("lat").value = lat;
            document.getElementById("lng").value = lng;
        });

    </script>

@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
