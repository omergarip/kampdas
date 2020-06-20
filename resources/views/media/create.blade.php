@extends('layouts.app')

@section('title')
    <title>Etkinlik Oluştur</title>
@endsection

@section('content')

    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                {{ isset($media) ? 'Fotoğrafları Düzenle' :  'Fotoğrafları Yükle' }}
            </div>

            <div class="card-body">
                @if(isset($media))
                    @foreach($media as $m)
                        <form action="{{ route('media.delete', $m->id) }}" enctype="multipart/form-data" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger mr-2">Sil</button>
                            <img style="width: 10rem;" class="my-2 img-fluid" src="{{ asset('storage/'.$m->image) }}"/>
                            <span hidden id="{{ $m->id }}">{{ $m->image }}</span><br>
                        </form>


                    @endforeach
                    <div class="text-center mb-5">
                        {{ $media->links() }}
                    </div>
                @endif
                <form action="{{ route('media.store',  $slug ) }}" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                    @csrf

                </form>
                <a class="btn btn-success mt-3" href="{{ route('events.show', $slug) }}">Etkinliği Oluştur</a>
            </div>

        </div>
    </div>

@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/min/dropzone.min.css">
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/min/dropzone.min.js"></script>
    <script>
        Dropzone.options.myDropzone = {
            paramName: 'file',
            maxFilesize: 5, // MB
            maxFiles: 20,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
        };
    </script>
@endsection
