@extends('brideweekend.layout')
@section('head')
    <title>Bride Weekend - Expositores</title>
    <link rel="stylesheet" href="{{asset('css/brideweekend/ciudad.css')}}">
@endsection
@section('content')
    <div class="container">
        <br>
        <div class="row center-align">
            <h4>EXPOSITORES PARTICIPANTES</h4><br>
            @foreach ($event->provider as $ev)
                <div class="col l4 m4 s6">
                    <div class="card center-align">
                        <div class="card-image">
                            <img class="img" src="{{asset('media/providers/'.$ev->user->name.'/'.$ev->profile->name_image.'')}}">
                        </div>
                        <div class="card-content scroll-x">
                            <h5>{{$ev->user->name}}</h5>
                            @foreach ($ev->location as $loc)
                                <h6><b><?= strtoupper($loc->city->city) ?></b></h6>
                                @if(!empty($loc->email_contact))
                                    <p><i class="far fa-envelope"></i> {{$loc->email_contact}}</p>
                                @endif
                                @if(!empty($loc->phone))
                                    <p><i class="fas fa-phone-alt"></i> {{$loc->phone}}</p>
                                @endif
                                @if(!empty($loc->cellphone))
                                    <p><i class="fas fa-mobile-alt"></i> {{$loc->cellphone}}</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')
    {{-- <script src="{{asset('js/brideweekend/ciudad.js')}}"></script> --}}
@endsection