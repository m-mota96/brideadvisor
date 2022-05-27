@extends('providers.layout')
@section('heads')
    <title>BrideAdvisor - Proveedores</title>
    <link rel="stylesheet" href="{{asset('slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('slick/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('css/providers.css')}}">
@endsection
@section('content')
    <div class="container mt-2">
        <div class="row">
            <img class="w-100" src="{{asset('media/content/headproviders.png')}}">
        </div>
        <div class="row bg-pink-300 p-3">
            <div class="col-lg-12 text-center mb-3">
                <h5 class="text-white">¿QUÉ ESTAS BUSCANDO?</h5>
            </div>
            <div class="col-lg-6 offset-lg-1">
                <input class="form-control rounded-pill" type="text" placeholder="Categoría o proveedor" id="input-search">
            </div>
            <div class="col-lg-4">
                <select class="form-control rounded-pill" id="selectCity" required>
                    <option value="" selected>Ciudad</option>
                    <option value="28082">Guadalajara</option>
                    <option value="48153">CDMX</option>
                    <option value="12905">Monterrey</option>
                    <option value="28852">Puebla</option>
                    <option value="28945">Queretaro</option>
                    <option value="48121">San Luis Potosi</option>
                </select>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-lg-12 text-center">
                <h1>¿Algo de tu interés?</h1>
            </div>
            <div class="col-lg-12 jcarousel-categories">
                @foreach($categories as $cat)
                    <div class="col-lg-3-jcaroul post">
                        <a class="pointer categories" id="{{$cat->id}}" data-name="{{$cat->name}}">
                            <img class="icons-categories" src="{{asset('media/icons/categoryproviders/'.$cat->name.'.png')}}">
                        </a>
                    </div>
                @endforeach
            </div>
            <hr class="w-100 hr-providers">
            <input type="hidden" value="{{URL::asset('')}}" id="URL">
            <input type="hidden" id="category">
            <input type="hidden" id="nameCategory">
            <input type="hidden" id="typeSearch">
        </div>
        <div class="row pt-3" id="content">
            <h1 class="w-100 text-center mb-4">Proveedores destacados</h1>
            @foreach ($providers as $prov)
                {{-- <div class="col-lg-4 p-0 mb-4 pointer" 
                    style="
                        background-image: url('{{asset('media/providers/'.$prov->user->name.'/'.$prov->profile->name_image.'')}}');
                        background-size: cover;
                        background-repeat: no-repeat;
                        height: 210px;
                        width: 100% !important;
                        background-position: center;
                " onclick="redirectTo('{{$prov->slug}}')">
                    <div class="col-lg-12 title pt-2">
                        <div class="row">
                            <div class="col-lg-10">
                                @if (strlen($prov->user->name)>18)
                                    <h5 class="text-white m-0"><?= strtoupper(substr($prov->user->name, 0, 18)) ?>...</h5>
                                @else
                                    <h5 class="text-white m-0"><?= strtoupper($prov->user->name) ?></h5>
                                @endif
                                <p class="text-white m-0"><?= strtoupper($prov->category->name) ?></p>
                            </div>
                            <div class="col-lg-2">
                                <i class="far fa-heart text-white size-heart"></i>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <a class="col-lg-3 mb-4" href="{{route('proveedor', $prov->slug)}}">
                    <div class="card card-home-providers">
                        <img class="round-img-home" src="{{asset('media/providers/'.$prov->user->name.'/'.$prov->profile->name_image.'')}}" class="card-img-top">
                        <div class="card-body pl-0 pr-0 text-center bg-gray-200 content-card-provider">
                            @if(strlen($prov->user->name)>18)
                                <h5 class="card-title text-dark"><?= strtoupper(substr($prov->user->name, 0, 18)) ?>...</h5>  
                            @else
                                <h5 class="card-title text-dark"><?= strtoupper($prov->user->name) ?></h5>
                            @endif
                            <h6 class="card-text text-pink-300"><?= strtoupper($prov->category->name) ?></h6>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/jquery-ui.js')}}"></script>
    <script src="{{asset('slick/slick.min.js')}}"></script>
    <script src="{{asset('js/providers.js')}}"></script>
@endsection