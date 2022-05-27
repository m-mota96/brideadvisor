<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bride Advisor</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('bootstrap-4.4.1/css/bootstrap.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('fontawesome5.12.1/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/head.css') }}">
    @stack('styles')
    @yield('head')
</head>
<body>
    @include('public.head')
    @yield('content')
    <br><br>
    @include('provider.footer')
</body>
<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
@yield('script')
</html>
