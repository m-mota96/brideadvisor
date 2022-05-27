@extends('provider.layout')
@section('head')
    <link rel="stylesheet" href="{{asset('css/jquery.fancybox.css')}}">
    <link rel="stylesheet" href="{{asset('css/provider/escaparate.css')}}">
@endsection
@section('content')
    @include('provider.submenu')
    <div class="container">
        <div class="row justify-content-center pt-5">
            <h1 class="font-weight-bold w-100 text-center">Fotografías</h1>
            <h5 class="text-center description">
                Añada mínimo 8 fotografías (en formato PNG o JPG de un máximo de 3MB cada una).
                Elegir una imagen como logotipo de la empresa y seleccione la foto principal.
            </h5>
        </div>
        <div class="row card bg-gray-100 pt-3 mt-4 pb-4">
            <input type="hidden" value="{{URL::asset('')}}" id="URL">
            <input type="hidden" value="{{Auth::user()->id}}" id="idUser">
            <h4 class="pl-4">Galeria Fotográfica</h4>
            <hr class="hr-card p-0 mt-1 mb-4">
            <div class="row pl-4 pr-4">
                <div class="col-lg-12 upload rounded pt-5 pb-5 mb-4" id="upload">
                    <text class="text-upload" div="drop">
                        <i class="fa fa-upload fa-2x valign "></i><br>
                        Suelte los archivos o haga click en el recuadro para cargar.
                    </text>
                </div>
                <div class="row w-100" id="images">
                    @foreach ($gallery as $gal)
                        <div class="col-lg-3 mb-3" id="cardImage{{$gal->id}}">
                            {{-- <a class="fancybox" href="{{asset('media/providers/'.Auth::user()->name.'/'.$gal->name_image.'')}}" data-fancybox-group="gallery">
                            <img class="w-100 gallery_provider" src="{{asset('media/providers/'.Auth::user()->name.'/'.$gal->name_image.'')}}">
                            </a> --}}
                            <div class="card">
                                <div class="card-image text-center">
                                    <a class="fancybox" href="{{asset('media/providers/'.Auth::user()->name.'/'.$gal->name_image.'')}}" data-fancybox-group="gallery">
                                        <img class="w-100 gallery_provider" src="{{asset('media/providers/'.Auth::user()->name.'/'.$gal->name_image.'')}}">
                                    </a>
                                    {{-- <button type="button" id="show" data-id="{{$gal->id}}" class="btn btn-custom pull-right show" aria-label="Left Align">
                                        <i class="fas fa-cog"></i>
                                    </button> --}}
                                    <i class="fas fa-times text-danger deleteImg mt-2" onclick="deleteImage({{$gal->id}}, 'image');"></i>
                                </div>
                                {{-- <div class="card-content">
                                    <span class="card-title">Opciones</span>                    
                                    <button type="button" id="show" data-id="{{$gal->id}}" class="btn btn-custom pull-right show" aria-label="Left Align">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                </div> --}}
                                {{-- <div class="card-reveal" id="options{{$gal->id}}">
                                    <span class="card-title">Elija una opción</span>
                                    <button type="button" class="close" data-id="{{$gal->id}}" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <div class="row">
                                        <div class="col-lg-12 mb-3"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8 offset-lg-2 mb-3">
                                            <input class="form-check-input" type="radio" name="profile" id="profile{{$gal->id}}" value="{{$gal->id}}" @if($gal->profile==1) checked @endif>
                                            <label class="form-check-label" for="profile{{$gal->id}}">
                                                Foto de perfil
                                            </label>
                                        </div>
                                        <div class="col-lg-8 offset-lg-2">
                                            <input class="form-check-input" type="radio" name="logotype" id="logotype{{$gal->id}}" value="{{$gal->id}}" @if($gal->logo==1) checked @endif>
                                            <label class="form-check-label" for="logotype{{$gal->id}}">
                                                Logo
                                            </label>
                                        </div>
                                    </div>
                                    <p class="btn btn-danger text-white pl-5 pr-5" onclick="deleteImage({{$gal->id}});">ELIMINAR</p>
                                </div> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row justify-content-center pt-5">
            <h1 class="font-weight-bold w-100 text-center">Video</h1>
            <h5 class="text-center description">
                Añada un video (en formato mp4 de un máximo de 500MB).
            </h5>
        </div>
        <div class="row card bg-gray-100 pt-3 mt-4 pb-4">
            <h4 class="pl-4">Video</h4>
            <hr class="hr-card p-0 mt-1 mb-4">
            <div class="row pl-4 pr-4">
                <form class="col-lg-5" id="form_subir">
                    {{ csrf_field() }}
                    <div>
                        <p>Archivo a subir: &nbsp;&nbsp;<input type="file" name="archivo" id="archivo" required></p>
                    </div>
                    <div class="progress mb-3">
                        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 0%" aria-valuemin="0" aria-valuemax="100">
                            <span id="progress"></span>
                        </div>
                    </div>
                    <div>
                        <button class="btn bg-pink-200" id="btnVideo">GUARDAR</button>
                    </div>
                </form>
                <div class="col-lg-7 text-center" id="video">
                    @if (isset($video->name_image))
                        <video class="w-100" src="{{asset('media/videos/providers/'.Auth::user()->name.'/'.$video->name_image.'')}}" controls id="videoProvider"></video>
                        <p class="btn btn-danger text-white pl-5 pr-5" onclick="deleteImage({{$video->id}}, 'video');" id="deleteVideo">ELIMINAR VIDEO</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/dropzone.js')}}"></script>
    <script src="{{asset('js/jquery.fancybox.pack.js')}}"></script>
    <script src="{{asset('js/provider/fotos.js')}}"></script>
    <script src="{{asset('js/provider/video.js')}}"></script>
@endsection