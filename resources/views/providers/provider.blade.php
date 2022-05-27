<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BrideAdvisor - {{$provider->user->name}}</title>
    <link rel="stylesheet" href="{{ asset('css/stars.css') }}">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontawesome5.12.1/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightslider.css') }}">
    <link rel="stylesheet" href="{{asset('css/jquery.fancybox.css')}}">
    <link rel="stylesheet" href="{{ asset('css/head.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fotorama.css') }}">
    <link rel="stylesheet" href="{{ asset('css/providers.css') }}">
</head>
<body>
    @include('public.head')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <input type="hidden" value="{{URL::asset('')}}" id="URL">
                <h2 class="mb-0">{{$provider->user->name}} 
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="size-average">
                        Calificación &nbsp;&nbsp;
                        @for ($i = 1; $i < 6; $i++)
                            @if($average >= $i)
                                <i class="fas fa-star text-yellow mb-0"></i>
                            @else
                                <i class="far fa-star text-yellow mb-0"></i>
                            @endif
                        @endfor
                    </span>
                </h2>
                <h5>{{$provider->category->name}}</h5>
                <input type="hidden" value="{{$provider->id}}" id="providerId">
            </div>
            <div class="col-lg-8">
                <div class="item">            
                    <div class="clearfix" >
                        <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                            @foreach ($provider->gallery as $gal)
                                @if($gal->profile!=1 && $gal->type=="img")
                                    <li class="text-center" data-thumb="{{asset('media/providers/'.$provider->user->name.'/'.$gal->name_image.'')}}">
                                        <a class="fancybox" href="{{asset('media/providers/'.$provider->user->name.'/'.$gal->name_image.'')}}" data-fancybox-group="gallery">
                                        <img src="{{asset('media/providers/'.$provider->user->name.'/'.$gal->name_image.'')}}" style="height:400px; object-fit: contain;">
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 text-center bg-gray-200">
                        <h5 class="mt-3 pointer" id="clickDescription">Descripción</h5>
                    </div>
                    <div class="col-lg-3 text-center bg-gray-200 border-left border-dark">
                        <h5 class="mt-3 pointer" id="clickOpinions">Opiniones</h5>
                    </div>
                    <div class="col-lg-3 text-center bg-gray-200 border-left border-dark">
                        <h5 class="mt-3 pointer" id="clickMap">Mapa</h5>
                    </div>
                    <div class="col-lg-3 text-center bg-gray-200 border-left border-dark">
                        <h5 class="mt-2 pointer" id="clickQuestions">Preguntas frecuentes</h5>
                    </div>
                </div>
            </div>
            @if(isset($provider->location[0]->email_contact))
                <div class="col-lg-4">
                    <div class="card border-card text-center pt-5 pl-3 pr-3 bg-gray-200">
                        <form id="formContact">
                            <h3 class="mb-3">Contactar</h3>
                            <input class="form-control mb-3" type="text" placeholder="Nombre completo" required>
                            <input class="form-control mb-3" type="email" placeholder="Correo" required>
                            <input class="form-control mb-3" type="number" placeholder="Teléfono" min="1" required>
                            <textarea class="form-control mb-3" rows="5" placeholder="Escribe tu solicitud a la empresa" required></textarea>
                            @if (sizeof($provider->location)<2)
                                <input class="form-control mb-4" type="hidden" value="{{$provider->location[0]->email_contact}}" disabled required>
                            @else
                                <select class="form-control mb-4" id="" required>
                                    <option value="" selected disabled>Ciudad de interés</option>
                                    @foreach ($provider->location as $loc)
                                        @if (!empty($loc->email_contact))
                                            <option value="{{$loc->email_contact}}">{{$loc->city->city}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif
                            <div class="row justify-content-center w-100">
                                <button class="btn bg-pink-400 text-white pl-2 pr-2 mb-4 w-50" type="submit">Enviar solicitud</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
            <div class="col-lg-8 mt-3 pl-5 pr-5">
                <h5 class="text-justify">
                    {{$provider->description}}
                </h5>
            </div>
            <div class="col-lg-8 mt-5" id="divOpinions">
                <div class="row pl-3 pr-3">
                    <div class="col-lg-6 pt-3 pb-2 border-top border-bottom border-dark">
                        <h3><i class="far fa-star"></i> Opiniones</h3>
                    </div>
                    <div class="col-lg-6 pt-3 pb-2 border-top border-bottom border-dark text-right">
                        @if (isset(Auth::user()->id))
                            @if (Auth::user()->role_id==3)
                                <span class="btn bg-pink-400 text-white pl-4 pr-4 mr-4" id="btnComment">Deja tu opinión</span>
                            @else
                                <span><b>Los proveedores no pueden hacer comentarios</b></span>
                            @endif
                        @else
                            <span><b>Inicia sesión para dejar tu comentario</b></span>
                        @endif
                    </div>
                </div>
                <div class="row pl-3 pr-3">
                    <div class="col-lg-6 mt-3 pt-3">
                        <div class="row">
                            @if ($opinions>0)
                                <div class="col-lg-3 text-center">
                                    <h2 class="mt-2"><b>{{$average}}</b></h2>
                                </div>
                                <div class="col-lg-9">
                                    @for ($i = 1; $i < 6; $i++)
                                        @if($average >= $i)
                                            <i class="fas fa-star text-yellow mb-0"></i>
                                        @else
                                            <i class="far fa-star text-yellow mb-0"></i>
                                        @endif
                                    @endfor
                                    <p class="m-0">{{$opinions}} opiniones</p>
                                </div>
                            @else
                                <h5><b>Este proveedor aun no tiene calificaciones</b></h5>
                            @endif
                        </div>
                        <div class="row pt-3">
                            @if (isset(Auth::user()->id))
                                @if (Auth::user()->role_id==3)
                                    <span class="text-stars mt-2 mr-3">Precio</span>
                                    <fieldset class="rating">
                                        <input type="radio" id="star5" name="price" class="rating" value="5" required /><label class = "full" for="star5" title="5 estrellas"></label>
                                        <input type="radio" id="star4" name="price" class="rating" value="4" /><label class = "full" for="star4" title="4 estrellas"></label>
                                        <input type="radio" id="star3" name="price" class="rating" value="3" /><label class = "full" for="star3" title="3 estrellas"></label>
                                        <input type="radio" id="star2" name="price" class="rating" value="2" /><label class = "full" for="star2" title="2 estrellas"></label>
                                        <input type="radio" id="star1" name="price" class="rating" value="1" /><label class = "full" for="star1" title="1 estrella"></label>
                                    </fieldset>
                                    <div class="col-lg-12"></div>
                                    <span class="text-stars mt-2 mr-3">Calidad</span>
                                    <fieldset class="rating">
                                        <input type="radio" id="star10" name="quality" class="rating" value="5" required /><label class = "full" for="star10" title="5 estrellas"></label>
                                        <input type="radio" id="star9" name="quality" class="rating" value="4" /><label class = "full" for="star9" title="4 estrellas"></label>
                                        <input type="radio" id="star8" name="quality" class="rating" value="3" /><label class = "full" for="star8" title="3 estrellas"></label>
                                        <input type="radio" id="star7" name="quality" class="rating" value="2" /><label class = "full" for="star7" title="2 estrellas"></label>
                                        <input type="radio" id="star6" name="quality" class="rating" value="1" /><label class = "full" for="star6" title="1 estrella"></label>
                                    </fieldset>
                                    <div class="col-lg-12"></div>
                                    <span class="text-stars mt-2 mr-3">Profesionalismo</span>
                                    <fieldset class="rating">
                                        <input type="radio" id="star15" name="professionalism" class="rating" value="5" required /><label class = "full" for="star15" title="5 estrellas"></label>
                                        <input type="radio" id="star14" name="professionalism" class="rating" value="4" /><label class = "full" for="star14" title="4 estrellas"></label>
                                        <input type="radio" id="star13" name="professionalism" class="rating" value="3" /><label class = "full" for="star13" title="3 estrellas"></label>
                                        <input type="radio" id="star12" name="professionalism" class="rating" value="2" /><label class = "full" for="star12" title="2 estrellas"></label>
                                        <input type="radio" id="star11" name="professionalism" class="rating" value="1" /><label class = "full" for="star11" title="1 estrella"></label>
                                    </fieldset>
                                    <div class="col-lg-12"></div>
                                    <span class="text-stars mt-2 mr-3">Atención</span>
                                    <fieldset class="rating">
                                        <input type="radio" id="star20" name="attention" class="rating" value="5" required /><label class = "full" for="star20" title="5 estrellas"></label>
                                        <input type="radio" id="star19" name="attention" class="rating" value="4" /><label class = "full" for="star19" title="4 estrellas"></label>
                                        <input type="radio" id="star18" name="attention" class="rating" value="3" /><label class = "full" for="star18" title="3 estrellas"></label>
                                        <input type="radio" id="star17" name="attention" class="rating" value="2" /><label class = "full" for="star17" title="2 estrellas"></label>
                                        <input type="radio" id="star16" name="attention" class="rating" value="1" /><label class = "full" for="star16" title="1 estrella"></label>
                                    </fieldset>
                                    <div class="col-lg-12"></div>
                                    <span class="btn bg-pink-400 text-white pl-4 pr-4 mr-4" id="saveQualification">Guardar</span>
                                @else
                                    <span><b>Los proveedores no pueden calificar</b></span>
                                @endif
                            @else
                                <span><b>Inicia sesión para calificar al proveedor</b></span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 border-left border-dark mt-3 pt-3" id="divComments">
                        @foreach ($provider->rating as $rat)
                            <h6 class="mb-0"><b>Por {{$rat->customer->user->name}}</b></h6>
                            <h6 class="mt-0"><b>{{$rat->date_parse}}</b></h6>
                            <h6 class="mt-0">
                                @for ($i = 1; $i < 6; $i++)
                                    @if($rat->average >= $i)
                                        <i class="fas fa-star text-yellow"></i>
                                    @else
                                        <i class="far fa-star text-yellow"></i>
                                    @endif
                                @endfor
                            </h6>
                            <h6 class="text-justify mb-4">{{$rat->message}}</h6>
                        @endforeach
                    </div>
                </div>
            </div>
            @if(isset($provider->location[0]->address))
                <div class="col-lg-8 mt-5" id="divMap">
                    <div class="row">
                        <div class="col-lg-2">
                            <h3><i class="fas fa-map-marker-alt"></i> Mapa</h3>
                        </div>
                        <div class="col-lg-10">
                            <h5>
                                @foreach ($provider->location as $key => $loc)
                                    @if($key==0)
                                        <label class="pointer"><input type="radio" name="locradio" value="{{$loc->id}}" checked> <b>{{$loc->city->city}}</b></label> &nbsp;&nbsp;
                                    @else
                                        <label class="pointer"><input type="radio" name="locradio" value="{{$loc->id}}"> <b>{{$loc->city->city}}</b></label> &nbsp;&nbsp;
                                    @endif
                                @endforeach
                                <br>
                                <span id="addressLocation">{{$provider->location[0]->address}}@if(!empty($provider->location[0]->postal_code)), {{$provider->location[0]->postal_code}} @endif</span>
                            </h5>
                            @if (isset($provider->location[0]->latitude) && isset($provider->location[0]->longitude))
                                <input type="hidden" value="{{$provider->location[0]->latitude}}" id="latitude">
                                <input type="hidden" value="{{$provider->location[0]->longitude}}" id="longitude">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row w-100 justify-content-center" id="map"></div>
                    </div>
                </div>
            @endif
            {{-- <div class="col-lg-8 mt-5" id="divQuestions">
                <div class="card card-questions">
                    <div class="col-lg-12 border-bottom border-dark mb-5">
                        <h3 class="ml-5 mt-3 mb-3">Preguntas frecuentes</h3>
                    </div>
                </div>
            </div> --}}
        </div>
        @include('providers.modalComment')
    </div>
    @include('provider.footer')
    <script src="{{asset('js/jquery-3.4.1.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/lightslider.js')}}"></script>
    <script src="{{asset('js/jquery.fancybox.pack.js')}}"></script>
    <script src="{{asset('js/fotorama.js')}}"></script>
    <script src="{{asset('js/sweetalert2.js')}}"></script>
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBj6fY5sVLxsS7FswsQt_n6Oy1XRyTXxdA&callback=initMap"></script>
    <script src="{{asset('js/provider.js')}}"></script>
</body>
</html>