@extends('provider.layout')
@section('head')
    <link rel="stylesheet" href="{{asset('css/provider/escaparate.css')}}">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center pt-5">
            <h1 class="font-weight-bold w-100 text-center">Opiniones y Calificación</h1>
            <h5 class="text-center description">
                Las buenas recomendaciones ayudan a que más clientes te contacten.
            </h5>
        </div>
        <div class="row card bg-gray-100 pt-3 mt-4 pb-4">
            <h4 class="pl-4"><i class="far fa-star"></i> Opiniones</h4>
            <hr class="hr-card p-0 mt-1 mb-4">
            <div class="row pl-4 pr-4">
                @foreach ($opinions as $op)
                    <div class="col-lg-6">
                        <div class="card cardRecomendations pt-3 pl-3 pr-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <span class="mb-5 mt-0">
                                        <h4>{{$op->customer->user->name}}</h4>
                                        <p>{{$op->date_parse}}</p>
                                    </span>
                                    <p class="mt-1">
                                        Precio &nbsp;&nbsp;&nbsp;
                                        @for ($i = 1; $i < 6; $i++)
                                            @if ($op->price>=$i)
                                                <i class="fas fa-star text-yellow"></i>
                                            @else
                                                <i class="far fa-star text-yellow"></i>
                                            @endif
                                        @endfor
                                    </p>
                                    <p>
                                        Calidad &nbsp;&nbsp;&nbsp;
                                        @for ($i = 1; $i < 6; $i++)
                                            @if ($op->quality>=$i)
                                                <i class="fas fa-star text-yellow"></i>
                                            @else
                                                <i class="far fa-star text-yellow"></i>
                                            @endif
                                        @endfor
                                    </p>
                                    <p>
                                        Profesionalismo &nbsp;&nbsp;&nbsp;
                                        @for ($i = 1; $i < 6; $i++)
                                            @if ($op->professionalism>=$i)
                                                <i class="fas fa-star text-yellow"></i>
                                            @else
                                                <i class="far fa-star text-yellow"></i>
                                            @endif
                                        @endfor
                                    </p>
                                    <p>
                                        Atención &nbsp;&nbsp;&nbsp;
                                        @for ($i = 1; $i < 6; $i++)
                                            @if ($op->attention>=$i)
                                                <i class="fas fa-star text-yellow"></i>
                                            @else
                                                <i class="far fa-star text-yellow"></i>
                                            @endif
                                        @endfor
                                    </p>
                                </div>
                                <div class="col-lg-6 border-left border-dark">
                                    <p class="text-justify">
                                        {{$op->message}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    
@endsection