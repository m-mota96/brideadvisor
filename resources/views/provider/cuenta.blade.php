@extends('provider.layout')
@section('head')
    <link rel="stylesheet" href="{{asset('css/provider/escaparate.css')}}">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center pt-5">
            <h1 class="font-weight-bold w-100 text-center">Mi cuenta</h1>
            <h5 class="text-center description">
                Modifica tu usuario y/ó contraseña, así como tu foto principal.
            </h5>
        </div>
        <div class="row card bg-gray-100 pt-3 mt-4 pb-4">
            <div class="col-lg-6">
                <input type="text">
            </div>
            <div class="col-lg-4">
                <input class="form-control" type="text" value="{{Auth::user()->email}}">
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    
@endsection