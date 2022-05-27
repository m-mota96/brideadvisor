@extends('admin.layout')
@section('heads')
    <link rel="stylesheet" href="{{asset('datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/admin.css')}}">
@endsection
@section('content')
    @if (isset($gallery[0]->provider->user->name))
        <h2 class="mt-4">Galería {{$gallery[0]->provider->user->name}}</h2>
    @else
        <h2 class="mt-4">Galería</h2>
    @endif
    <div class="row card ml-1 p-3 mr-2">
        <input type="hidden" value="{{URL::asset('')}}" id="URL">
        <div class="row">
            @foreach ($gallery as $gal)
        <div class="col-lg-3 mb-3" id="cardImage{{$gal->id}}">
                    <div class="card">
                        <img class="gallery-admin" src="{{asset('media/providers/'.$gal->provider->user->name.'/'.$gal->name_image.'')}}" class="card-img-top" alt="...">
                        <div class="card-body text-center p-0">
                            <p class="btn btn-danger mb-2 mt-2 btn-delete" id="{{$gal->id}}">Eliminar</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('datatables/datatables.js')}}"></script>
    <script src="{{asset('js/admin/gallery.js')}}"></script>
@endsection