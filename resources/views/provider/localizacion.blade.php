@extends('provider.layout')
@section('head')
    <link rel="stylesheet" href="{{asset('css/provider/escaparate.css')}}">
@endsection
@section('content')
    @include('provider.submenu')
    <div class="container">
        <div class="row justify-content-center pt-5">
            <h1 class="font-weight-bold w-100 text-center">Localización y Mapa</h1>
            <h5 class="text-center description">
                Puede modificar la ubicación sobre el mapa arrastrando el mapa hasta el punto deseado.
                La dirección debe constar del nombre de la calle seguido de una coma y el resto de datos.
                Ejemplo: Av Siempre Viva 412, Colonia La Calma
            </h5>
        </div>
        <div class="row card bg-gray-100 pt-3 mt-4 pb-4">
            <input type="hidden" value="{{URL::asset('')}}" id="URL">
            <h4 class="pl-4">Modificar Dirección y Mapa</h4>
            <hr class="hr-card p-0 mt-1 mb-4">
            <div class="row pl-4 pr-4">
                <div class="col-lg-5">
                    <label>Ciudad:</label>
                    <select class="form-control mb-4" id="location">
                        @foreach ($company->location as $loc)
                            <option value="{{$loc->id}}">{{$loc->city}}</option>
                        @endforeach
                    </select>
                    <label>Dirección:</label>
                    <input class="form-control mb-3" type="text" id="address" value="{{$company->location[0]->address}}">
                    <label>Código postal:</label>
                    <input class="form-control" type="text" id="postal_code" value="{{$company->location[0]->postal_code}}">
                    <input type="hidden" id="latitude" value="{{$company->location[0]->latitude}}">
                    <input type="hidden" id="longitude" value="{{$company->location[0]->longitude}}">
                </div>
                <div class="col-lg-7">
                    <div class="col-lg-12" id="mapa">

                    </div>
                </div>
                <div class="row col-12 justify-content-center mt-4">
                    <button class="btn bg-pink-400 text-white pl-5 pr-5" id="btnAddress">GUARDAR</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBj6fY5sVLxsS7FswsQt_n6Oy1XRyTXxdA"></script> --}}
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBj6fY5sVLxsS7FswsQt_n6Oy1XRyTXxdA&callback=initMap"></script>
    <script src="{{asset('js/provider/localizacion.js')}}"></script>
@endsection