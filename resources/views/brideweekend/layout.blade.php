<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/materialize.min.css')}}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('fontawesome5.12.1/css/all.css') }}">
    <link rel="stylesheet" href="{{asset('css/brideweekend/head.css')}}">
    @yield('head')
</head>
<body>
    @include('brideweekend.head')
    @yield('content')
    @include('brideweekend.footer')
    <script src="{{asset('js/jquery-3.4.1.js')}}"></script>
    <script src="{{asset('js/materializecdn.min.js')}}"></script>
    @yield('scripts')
</body>
</html>