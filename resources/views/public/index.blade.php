@extends('public.layout')
@section('head')
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection
@section('content')
    <div class="container text-center mt-2">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                {{-- <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li> --}}
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{asset('media/slides/ba-index/slide1.png')}}" class="d-block w-100">
                </div>
                {{-- <div class="carousel-item">
                    <img src="{{asset('media/slides/ba-index/slide1.png')}}" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('media/slides/ba-index/slide1.png')}}" class="d-block w-100">
                </div> --}}
            </div>
        </div>
    </div>
    <div class="container text-center mt-3">
        <div class="row">
            <div class="col-xl-12 background-search">
                <br>
                <h5 class="bold">¿QUÉ ESTAS BUSCANDO?</h5><br>
                {{-- <div class="row"> --}}
                    <form class="row" action="{{route('proveedores')}}" method="GET">
                        <div class="col-xl-6 offset-xl-1">
                            <input class="form-control rounded-pill" type="text" placeholder="Categoría o proveedor" id="input-search" name="search" required>
                            <input type="hidden" id="type" name="type">
                            <input type="hidden" value="{{URL::asset('')}}" id="URL">
                        </div>
                        <div class="col-xl-3">
                            <select class="form-control rounded-pill" id="selectCity" name="city">
                                <option value="" selected>Ciudad</option>
                                <option value="28082">Guadalajara</option>
                                <option value="48153">CDMX</option>
                                <option value="12905">Monterrey</option>
                                <option value="28852">Puebla</option>
                                <option value="28945">Queretaro</option>
                                <option value="48121">San Luis Potosi</option>
                            </select>
                        </div>
                        <div class="col-xl-1">
                            <button class="btn btn-dark" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <br><br><br>
                {{-- </div> --}}
            </div>
            <div class="col-xl-12 text-center">
                <br>
                <h1 class="bold">Mi planeador de boda</h1><br>
                <div class="row">
                    <div class="col-xl-3">
                        <img class="icons-index" src="{{asset('media/icons/index/profile.png')}}">
                        <p>
                            <br>
                            MI PERFIL
                            <br>
                            Actualiza tu perfil y ten el 
                            control de tu progreso durante 
                            la planeación de tu evento.
                        </p>
                    </div>
                    <div class="col-xl-3">
                        <img class="icons-index" src="{{asset('media/icons/index/agenda.png')}}">
                        <p>
                            <br>
                            AGENDA
                            <br>
                            No olvides agendar todos tus pendientes y actividades.
                        </p>
                    </div>
                    <div class="col-xl-3">
                        <img class="icons-index" src="{{asset('media/icons/index/invitados.png')}}">
                        <p>
                            <br>
                            CONTROL DE INVITADOS
                            <br>
                            Lleva el control de tus 
                            invitados con herramientas 
                            como acomodo de mesas y 
                            confirmación de asistencia.
                        </p>
                    </div>
                    <div class="col-xl-3">
                        <img class="icons-index" src="{{asset('media/icons/index/presupuestador.png')}}">
                        <p>
                            <br>
                            PRESUPUESTADOR
                            <br>
                            Administrar y maximizar tu 
                            dinero y a seleccionar el 
                            proveedor ideal de acuerdo 
                            a tus necesidades.
                        </p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xl-3 offset-exclusive">
                        <img class="icons-index" src="{{asset('media/icons/index/megusta.png')}}">
                        <p>
                            <br>
                            MIS ME GUSTA
                            <br>
                            Selecciona inspiración para 
                            tu boda y encuentrala siempre 
                            dentro de tu perfil.
                        </p>
                    </div>
                    <div class="col-xl-3">
                        <img class="icons-index" src="{{asset('media/icons/index/web.png')}}">
                        <p>
                            <br>
                            MIS WEB
                            <br>
                            Podrás compartir información 
                            de tu boda con tus invitados 
                            a traves de un perfil social.
                        </p>
                    </div>
                    <div class="col-xl-3">
                        <img class="icons-index" src="{{asset('media/icons/index/web.png')}}">
                        <p>
                            <br>
                            MESA DE REGALOS
                            <br>
                            Personaliza tu mesa de regalos 
                            a tu gusto y recibe justamente 
                            lo que deseas.
                        </p>
                    </div>
                </div>
            </div>
            {{-- <br> --}}
            {{-- <hr class="hr-h"> --}}
            {{-- <br>
            <img class="img" src="{{asset('media/content/img-home.png')}}">
            <br><br>
            <div class="col-xl-12 background-why mt-3">
                <h2 class="text-white">ARTÍCULOS RECIENTES</h2>
            </div>
            <br>
            <div class="row justify-content-center mt-4">
                <p class="btn-home text-white">Ir a bride mag</p>
            </div> --}}
            <div class="col-lg-12 bg-pink-200 mt-5 pt-3 pb-4 pl-5 pr-5">
                <h2 class="text-white">NUEVOS PROVEEDORES</h2>
                <div class="row">
                    @foreach ($providers as $prov)
                        <a class="col-lg-3 p-1" href="{{route('proveedor', $prov->slug)}}">
                        {{-- <div class="col-lg-12 pl-2 pr-2">
                            <div class="row w-100 p-0" style="
                            background-image: url('{{asset('media/providers/'.$prov->user->name.'/'.$prov->profile->name_image.'')}}');
                            background-size: cover;
                            background-repeat: no-repeat;
                            height: 210px;
                            width: 100% !important;
                            background-position: center;
                            ">
                                <div class="col-lg-12 text-left title pt-1">
                                    <h5 class="text-white m-0"></h5>
                                    <p class="text-white m-0"></p>
                                </div>
                            </div>
                        </div> --}}
                            <div class="card">
                                <img class="round-img-home" src="{{asset('media/providers/'.$prov->user->name.'/'.$prov->profile->name_image.'')}}" class="card-img-top">
                                <div class="card-body pl-0 pr-0">
                                    @if(strlen($prov->user->name)>18)
                                        <h5 class="card-title text-dark"><?= strtoupper(substr($prov->user->name, 0, 18)) ?>...</h5>  
                                    @else
                                        <h5 class="card-title text-dark"><?= strtoupper($prov->user->name) ?></h5>
                                    @endif
                                    <h6 class="card-text text-pink-300"><?= strtoupper($prov->category->name) ?></h6>
                                    {{-- <a href="{{route('proveedor', $prov->slug)}}" class="btn bg-pink-300 text-white">Ver perfil</a> --}}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/jquery-ui.js')}}"></script>
    <script src="{{asset('js/public/index.js')}}"></script>
@endsection