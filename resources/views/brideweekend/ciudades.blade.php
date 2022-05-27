@extends('brideweekend.layout')
@section('head')
    <title>Bride Weekend - Ciudades</title>
    <link rel="stylesheet" href="{{asset('css/brideweekend/ciudades.css')}}">
@endsection
@section('content')
    <div class="hide-on-med-and-down"><br><br></div>
    {{-- <div class="container">
        <a href="{{route('brideweekend/carrera')}}"><img class="img" src="{{asset('media/brideweekend/indexCareer.png')}}"></a>
    </div> --}}
    <div class="row center-align">
        <h3>PRÓXIMOS EVENTOS</h3>
        @foreach ($years as $y)
            <br>
            <div class="col l8 offset-l2 s8 offset-s2 calendario"> <h5>CALENDARIO {{$y->year}}</h5></div>
            <div class="row ciudades">
                <br>
                <?php foreach($cities as $c){ ?>
                    @if ($y->year == $c->year && !empty($c->initial_date))
                        <a href="{{route('brideweekend/ciudad', $c->id)}}" class="col l4 s12 m6 div-ciudad">
                            <div class="ciudad-general" style="background: url('{{asset('media/enclosures/'.$c->enclosure->image.'')}}');
                            background-size: cover;
                            background-position: center;">
                                <div class="grises">
                                    <br>
                                    <h4>{{$c->city->city}}</h4>
                                    <h5>{{$c->dateParse}}</h5>
                                    <div class="div-logo-index">
                                        <img class="img-logo" src="{{asset('media/enclosures/'.$c->enclosure->logo.'')}}">
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endif
                    {{-- @elseif($y->year==2021 && empty($c->initial_date) && empty($c->final_date))
                        <a href="{{route('brideweekend/ciudad', $c->id)}}" class="col l4 s12 m6 div-ciudad">
                            <div class="ciudad-general" style="background: url('{{asset('media/enclosures/'.$c->enclosure->image.'')}}');
                            background-size: cover;
                            background-position: center;">
                                <div class="grises">
                                    <br>
                                    <h4>{{$c->city->city}}</h4>
                                    <h5>Fecha por definir</h5>
                                    <div class="div-logo-index">
                                        <img class="img-logo" src="{{asset('media/enclosures/'.$c->enclosure->logo.'')}}">
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endif --}}
                <?php } ?>
            </div>
        @endforeach
    </div>
@endsection
@section('scripts')
    
@endsection