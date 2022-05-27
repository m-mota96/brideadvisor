@extends('providers.layout')
@section('heads')
    <title>BrideAdvisor - {{$promotion->name}}</title>
    <link rel="stylesheet" href="{{asset('css/jquery.fancybox.css')}}">
    <link rel="stylesheet" href="{{ asset('css/lightslider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightslider.css') }}">
    {{-- <link rel="stylesheet" href="{{asset('css/glDatePicker.default.css')}}">
    <link rel="stylesheet" href="{{asset('css/glDatePicker.flatwhite.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('fullcalendar/lib/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/providers.css')}}">
@endsection
@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="item">            
                    <div class="clearfix" >
                        <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                            @foreach ($promotion->gallery as $gal)
                                <li class="text-center" data-thumb="{{asset('media/promotions/'.$promotion->id.'/'.$gal->name.'')}}">
                                    <a class="fancybox" href="{{asset('media/promotions/'.$promotion->id.'/'.$gal->name.'')}}" data-fancybox-group="gallery">
                                    <img src="{{asset('media/promotions/'.$promotion->id.'/'.$gal->name.'')}}" style="height:400px; object-fit: contain;">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="w-100 border-hr-promotions2 mt-2">
            <div class="col-lg-7">
                <h2><b>{{$promotion->provider->user->name}}</b></h2>
                <h4>{{$promotion->name}}</h4>
            </div>
            {{-- <div class="col-lg-3 text-right pt-3">
                <h2 class="text-gray line">${{$promotion->price_initial}}MXN</h2>
            </div> --}}
            <div class="col-lg-5 text-center">
                <h3 class="text-gray line">${{$promotion->price_initial}}MXN</h3>
                <h2><b>${{$promotion->price_final}}MXN</b></h2>
            </div>
            <hr class="border border-gray w-100 mt-1">
            <div class="col-lg-7">
                <div class="card card-promotion bg-gray-100 text-center p-5">
                    <h3><b>Descripción</b></h3>
                    <p class="text-justify mt-3">{{$promotion->description}}</p>
                    <p class="text-justify mt-3 mb-0">ANTICIPO NECESARIO: $1,000 MXN</p>
                    <input type="hidden" value="{{URL::asset('')}}" id="URL">
                    <input type="hidden" value="{{$providerId}}" id="provider_id">
                    <input type="hidden" value="{{$promotion->id}}" id="promotion_id">
                </div>
                <img class="w-100 mt-4" src="{{asset('media/content/cardPromotions.png')}}">
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="col-lg-12 bg-pink-200 text-center pt-3 pb-2 mb-3">
                        <h3 class="text-white">AGENDAR CITA</h3>
                    </div>
                    <div class="col-lg-12 p-4">
                        <form id="formPromotions">
                            <label>Fecha:</label>
                            <select class="form-control mb-3" id="selectDates" required>
                                <option value="" selected disabled>Seleccione una fecha</option>
                                @for ($i=0; $i < sizeof($dates); $i++)
                                    <option value="{{$dates[$i][0]}}">{{$dates[$i][2]}}</option>
                                @endfor
                            </select>
                            <label>Hora:</label>
                            <select class="form-control mb-3" id="selectSchedules" required>
                                <option value="" selected disabled>Seleccione la hora</option>
                            </select>
                            <label>Seleccione la dirección de una sucursal:</label>
                            <select class="form-control mb-3" id="selectAddresses" required>
                                <option value="" selected disabled>Seleccione una dirección</option>
                                @for ($i = 0; $i < sizeof($addresses); $i++)
                                    <option value="{{$addresses[$i]}}">{{$addresses[$i]}}</option>
                                @endfor
                            </select>
                            <label>Nombre completo:</label>
                            <input class="form-control mb-3" type="text" id="nameSchedules" required>
                            <label>Teléfono:</label>
                            <input class="form-control mb-3" type="text" id="phone" required>
                            <label>Correo electrónico:</label>
                            <input class="form-control mb-3" type="email" id="emailSchedules" required>
                            <label>Nombre del propietario de la tarjeta:</label>
                            <input class="form-control mb-3" type="text" data-conekta="card[name]" required>
                            <label>No. de tarjeta (Crédito/Débito):</label>
                            <input class="form-control mb-3" type="number" id="card" maxlength="16" data-conekta="card[number]">
                            <div class="row p-0">
                                <div class="col-lg-3">
                                    <label>Mes</label>
                                    <input class="form-control" type="number" placeholder="01" data-conekta="card[exp_month]">
                                </div>
                                <div class="col-lg-4">
                                    <label>Año</label>
                                    <input class="form-control" type="number" placeholder="<?= date('Y') ?>" data-conekta="card[exp_year]">
                                </div>
                                <div class="col-lg-5 p-0">
                                    <label>Código de seguridad</label>
                                    <input class="form-control" type="number" data-conekta="card[cvc]">
                                </div>
                            </div>
                            <div class="row mt-4 justify-content-center">
                                <input type="hidden" id="conektaTokenId">
                                <button class="btn bg-pink-400 text-white pl-5 pr-5" type="submit">Reservar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/jquery.fancybox.pack.js')}}"></script>
    <script src="{{asset('js/lightslider.js')}}"></script>
    {{-- <script src="{{asset('js/glDatePicker.min.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/fullcalendar.min.js')}}"></script> --}}
    {{-- <script src="{{asset('fullcalendar/lib/main.js')}}"></script>
    <script src="{{asset('fullcalendar/lib/locales/es.js')}}"></script> --}}
    <script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>
    <script src="{{asset('js/sweetalert2.js')}}"></script>
    <script src="{{asset('js/charging.js')}}"></script>
    <script src="{{asset('js/promotion.js')}}"></script>
@endsection