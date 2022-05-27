@extends('provider.layout')
@section('head')
    <link rel="stylesheet" href="{{asset('css/provider/escaparate.css')}}">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center pt-5">
            <h1 class="font-weight-bold w-100 text-center">Estadísticas de tu perfil</h1>
            <h5 class="text-center description">
                Indicadores de los últimos 7 días.
            </h5>
        </div>
        <div class="row card bg-gray-100 mt-4">
            <input type="hidden" value="{{URL::asset('')}}" id="URL">
            <div id="graphic">

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="{{asset('js/provider/estadisticas.js')}}"></script>
@endsection