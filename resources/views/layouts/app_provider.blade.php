<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{asset('js/jquery-3.4.1.js')}}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/register.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontawesome5.12.1/css/all.css') }}">
    <style>
        body {
            background: url("{{asset("media/bck-prov.png")}}") no-repeat;
            background-size: 100% auto;
        }
        .contain{
            position: absolute;
            top: 55%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: inline-flex;
        }
    </style>

</head>
<body>
@include('public.top')
<div class="container" id="app">
    <main class="">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-5 contain">
                <div class="card bg-gray-100" style="border-radius: 1.5rem !important;">
                    <div class="card-body mx-5">
                        <div><img src="{{asset("media/logos/LOGO_N.png")}}"  class="rounded mx-auto d-block w-25"></div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
