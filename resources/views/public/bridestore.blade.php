@extends('providers.layout')
@section('heads')
    <title>BrideStore</title>
    <link rel="stylesheet" href="{{asset('slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('slick/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('css/providers.css')}}">
    <style>
        body {
            background: #f8f7f7 !important;
        }
    </style>
@endsection
@section('content')
    <div class="container mt-2 back-promotions">
        <div class="row">
            <img class="w-100" src="{{asset('media/content/headbridestore.png')}}">
            <div class="col-lg-12 bg-pink-300 justify-content-center pt-5 pb-5 mb-4">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <select class="form-control rounded-pill justify-content-center" id="categories">
                            <option value="">Selecciona una categoría</option>
                            @foreach ($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" value="{{URL::asset('')}}" id="URL">
                    </div>
                    <div class="col-lg-2">
                        
                    </div>
                </div>
            </div>
            <div class="row p-0" id="divPromotions">
                @foreach ($promotions as $prom)
                    <a class="col-lg-3 mb-3 cardPromotions" href="{{route('promocion', $prom->id)}}">
                        <div class="card w-100 card-promotions">
                            <img src="{{asset('media/promotions/'.$prom->id.'/'.$prom->gallery[0]->name.'')}}" class="card-img-top card-img-top-promotions">
                            <div class="card-body text-center">
                            <h4 class="card-title mb-2 text-dark"><b>{{$prom->provider->user->name}}</b></h4>
                            <hr class="w-50 border-hr-promotions mt-0">
                            {{-- <p class="card-text"><?= //substr($prom->description, 0, 60); ?>...</p> --}}
                            <h5 class="card-text mb-1 line text-gray">${{$prom->price_initial}}MXN</h5>
                            <h4 class="card-text text-dark">${{$prom->price_final}}MXN</h4>
                            {{-- <p class="size-card-promotion">*Oferta válida solo a través de BrideAdvisor</p> --}}
                            <h5 class="text-pink-500 mt-2">Ver promoción</h5>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/jquery-ui.js')}}"></script>
    <script src="{{asset('slick/slick.min.js')}}"></script>
    <script src="{{asset('js/bridestore.js')}}"></script>
@endsection