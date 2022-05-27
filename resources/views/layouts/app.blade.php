<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} @yield('title') </title>

    <!-- Scripts -->

    {{-- <script src="{{ asset('js/register.js') }}" defer></script> --}}
    <script src="{{asset('js/jquery-3.4.1.js')}}"></script>
   {{-- <script src="{{asset('js/bootstrap.js')}}"></script> --}}
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/register.css') }}" rel="stylesheet"> --}}
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('fontawesome5.12.1/css/all.css') }}"/>
    @livewireStyles
    @livewireScripts
</head>
<body>
    @section('menu')
        @include('public.top')
        @auth
            @include('layouts.menu')
            @include('layouts.nav-icons')
        @endauth
    @show
    <div class="container" id="app">
        <main class="py-4 p-0">
            @yield('content')
        </main>
    </div>
    @section('footer')
        @include('public.footer')
        @stack('scripts')
    @show
</body>
</html>
