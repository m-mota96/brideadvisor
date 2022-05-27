<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/provider/sidebar.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('fontawesome5.12.1/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/provider/head.css')}}">
    <title>BrideAdvisor - {{Auth::user()->name}}</title>
    @yield('head')
</head>
<body>
    @include('provider.head')
    @yield('content')
    @include('provider.footer')
    <script src="{{asset('js/jquery-3.4.1.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/sweetalert2.js')}}"></script>
    @yield('scripts')
</body>
</html>