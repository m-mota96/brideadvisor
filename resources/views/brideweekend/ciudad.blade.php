@extends('brideweekend.layout')
@section('head')
    <title>Bride Weekend - {{$data->city->city}}</title>
    <link rel="stylesheet" href="{{asset('css/brideweekend/ciudad.css')}}">
@endsection
@section('content')
    <div class="row">
        <br>
        <div class="col l12 m12 s12 width-head"
        style="background-image: url('{{asset('media/events/'.$data->id.'/'.$data->id.'_'.$data->id.'.png'.'')}}');
            height: 350px !important;
            background-size: cover !important;
            background-position: bottom;
            background-repeat: no-repeat !important;
            padding: 0px !important;">
        </div>
        <div class="col l6 offset-l3">
            <div class="col l12 m12 s12 card paddings">
                <div class="col l12 m12 s12 grey darken-4 center-align">
                    <h3 class="size-title white-text bold">{{strtoupper($data->city->city)}}</h3>
                </div>
                <div class="col l4 s12 height-logo">
                    <img class="img img-logo" src="{{asset('media/enclosures/'.$data->enclosure->logo.'')}}">
                    <br><br>
                </div>
                <div class="col l8">
                    @if (!empty($data->initial_date))
                        <h5 class="size-date center-align">{{$data->dateParse.' | '.$data->year}}</h5>
                        <p class="bold center-align size-schedule"><?= $data->timeParse ?></p>
                    @else
                        <br><br>
                        <h5 class="size-date center-align">Fecha por definir</h5>
                    @endif
                    @if ($data->organized_by=='plexon')
                        {{-- <p class="bold center-align size-schedule">Horario de pasarelas</p> --}}
                        {{-- <p class="bold center-align size-schedule">{{$runway}}</p> --}}
                    @else

                    @endif
                </div>
            </div>
        </div>
    </div>
    @if ($data->organized_by=='plexon')
        
            {{-- <div class="col l12 m12 s12"> --}}
                <ul class="tabs center-align">
                    <li class="tab col s3"><a class="grey-text text-darken-3 title-tabs active btnSpecial" href="#test1" id="tab1">PROMOCIONES</a></li>
                    <li class="tab col s3"><a class="grey-text text-darken-3 title-tabs" href="#test2" id="tab2">PROGRAMA DE ACTIVIDADES</a></li>
                    <li class="tab col s3"><a class="grey-text text-darken-3 title-tabs" href="#test3" id="tab3">EXPOSITORES PARTICIPANTES</a></li>
                    <li class="tab col s3"><a class="grey-text text-darken-3 title-tabs" href="#test4" id="tab4">RECINTO</a></li>
                    @if ($data->city->city=='Guadalajara')
                        <li class="tab col s3"><a class="grey-text text-darken-3 title-tabs" href="#test5" id="tab5">HOTELES SEDE</a></li>
                    @endif
                </ul>
                <br>
            {{-- </div> --}}
        <div class="row paddings">
            <div id="test1" class="col l12 m12 s12">
                <div class="container">
                    <div class="col l4 m4 s4">
                        <img class="img" src="{{asset('media/brideweekend/cardMAMA.png')}}">
                    </div>
                    <div class="col l4 m4 s4">
                        <a href="{{route('brideweekend/regalos')}}">
                            <img class="img" src="{{asset('media/brideweekend/cardCRUCERO.png')}}">
                        </a>
                    </div>
                    <div class="col l4 m4 s4">
                        <img class="img" src="{{asset('media/brideweekend/cardAGENDA.png')}}">
                    </div>
                </div>
            </div>
            <div id="test2" class="col l12 m12 s12">
                @if ($data->city->city=='Guadalajara')
                    
                @elseif($data->city->city=='Puebla')

                @elseif($data->city->city=='Queretaro')

                @elseif($data->city->city=='Slp')

                @elseif($data->city->city=='Cdmx')
                    
                @endif
            </div>
            <div id="test3" class="col l12 m12 s12">
                <div class="container">
                    <div class="col l4 m4 s4 offset-l4">
                        <a href="{{route('brideweekend/expositores', $data->id)}}">
                            <img class="img" src="{{asset('media/brideweekend/cardExhibitors.png')}}">
                        </a>
                    </div>
                </div>
            </div>
            <div id="test4" class="col l12 m12 s12 paddings">
                <div class="col l6 s12 m6 paddings">
                    <img class="img object large-location" src="{{asset('media/enclosures/'.$data->enclosure->image.'')}}">
                </div>
                <div class="col l6 s12 m6 paddings">
                    <iframe class="map" src="{{$data->enclosure->map}}"></iframe>
                </div>
            </div>
            @if ($data->city->city=='Guadalajara')
                <div id="test5" class="col l12 m12 s12">
                    <div class="col l3 m3 s12">
                        <a class="hide-on-small-only"><img class="img" src="{{asset('media/brideweekend/hilton.png')}}"></a>
                        <a class="hide-on-med-and-up" href="tel:8003645800"><img class="img" src="{{asset('media/brideweekend/hilton.png')}}"></a>
                    </div>
                    <div class="col l3 m3 s12">
                        <a class="hide-on-small-only"><img class="img" src="{{asset('media/brideweekend/gdlplaza.png')}}"></a>
                        <a class="hide-on-med-and-up" href="tel:3222262714"><img class="img" src="{{asset('media/brideweekend/gdlplaza.png')}}"></a>
                    </div>
                    <div class="col l3 m3 s12">
                        <a class="hide-on-small-only"><img class="img" src="{{asset('media/brideweekend/fiestainn.png')}}"></a>
                        <a class="hide-on-med-and-up" href="tel:8005045000"><img class="img" src="{{asset('media/brideweekend/fiestainn.png')}}"></a>
                    </div>
                    <div class="col l3 m3 s12">
                        <a class="hide-on-small-only"><img class="img" src="{{asset('media/brideweekend/fiestaam.png')}}"></a>
                        <a class="hide-on-med-and-up" href="tel:4433108015"><img class="img" src="{{asset('media/brideweekend/fiestaam.png')}}"></a>
                    </div>
                </div>
            @endif
            <div class="col l12 m12 s12">
                <hr>
            </div>
        </div>
    @else
        <div class="row paddings">
            <div class="col l6 s12 m6 paddings">
                <img class="img object large-location" src="{{asset('media/enclosures/'.$data->enclosure->image.'')}}">
            </div>
            <div class="col l6 s12 m6 paddings">
                <iframe class="map" src="{{$data->enclosure->map}}"></iframe>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col l10 m10 s12 offset-l1 offset-m1">
            <video class="img" src="{{asset('media/videos/brideweekend/bw.mp4')}}" autoplay muted controls></video>
        </div>
    </div>
    @include('brideweekend.contactLOC')
@endsection
@section('scripts')
    <script src="{{asset('js/brideweekend/ciudad.js')}}"></script>
@endsection