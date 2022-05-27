@extends('provider.layout')
@section('head')
    <link rel="stylesheet" href="{{asset('css/provider/escaparate.css')}}">
@endsection
@section('content')
    @include('provider.submenu')
    <div class="container">
        <div class="row justify-content-center pt-5">
            <h1 class="font-weight-bold w-100 text-center">Descripción de tu empresa</h1>
            <h5 class="text-center description">
                Describe detalladamente tu empresa así como los servicios 
                o productos de bodas que ofreces con la máxima información 
                de interés para los novios.
            </h5>
        </div>
        <div class="row card bg-gray-100 pt-3 mt-4 pb-4">
            <h4 class="m-0 p-0 pl-4">Datos de la empresa</h4>
            <hr class="hr-card p-0 mt-1 mb-4">
            <form id="formCompany">
                <div class="row pl-4">
                    <div class="col-lg-2 mb-4">
                        <p>Nombre de la empresa:</p>
                    </div>
                    <div class="col-lg-8 mb-4">
                        <input class="form-control" type="text" id="nameCompany" value="{{$company->user->name}}" required>
                    </div>
                    <div class="col-lg-12"></div>
                    <div class="col-lg-2 mb-4">
                        <p>Categoria:</p>
                    </div>
                    <div class="col-lg-8 mb-4">
                        <select class="form-control" id="category" required>
                            @foreach ($categories as $cat)
                                @if ($company->category_id==$cat->id)
                                    <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                                @else
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        {{-- <button class="btn bg-pink-200" id="btnCategory">GUARDAR</button> --}}
                    </div>
                    <div class="col-lg-10">
                        <p>Descripción:</p>
                        <textarea class="form-control" rows="10" id="descriptionCompany" required>{{$company->description}}</textarea>
                    </div>
                    <div class="col-lg-12 pt-3 text-center">
                        <button class="btn bg-pink-400 text-white pl-5 pr-5" type="submit">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row justify-content-center mt-5 mb-5">
            <h5 class="text-center description">
                Para recibir las solicitudes de información de usuarios interesados completa los 
                siguientes datos. Así mismo nos servirá para proporcionarte todas las novedades 
                del portal que puedan ser de tu interés.
            </h5>
        </div>
        <div class="row card bg-gray-100 pt-3 mt-4 pb-4">
            <h4 class="m-0 p-0 pl-4">Datos de contacto</h4>
            <hr class="hr-card p-0 mt-1 mb-4">
            <div class="row pl-4 pr-4">
                <div class="col-lg-2 mb-4">
                    <p>Ciudad:</p>
                </div>
                <div class="col-lg-4 mb-4">
                    <select class="form-control" id="locations">
                        @foreach ($company->location as $loc)
                            <option value="{{$loc->id}}">{{$loc->city}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 mb-4">
                    <p>Nombre de la persona encargada:</p>
                </div>
                <div class="col-lg-4 mb-4">
                    <input class="form-control" type="text" id="name_contact" value="{{$company->location[0]->name_contact}}">
                </div>
                <div class="col-lg-2 mb-4">
                    <p>Teléfono:</p>
                </div>
                <div class="col-lg-4 mb-4">
                    <input class="form-control" type="text" id="phone" value="{{$company->location[0]->phone}}">
                </div>
                <div class="col-lg-2 mb-4">
                    <p>Celular:</p>
                </div>
                <div class="col-lg-4 mb-4">
                    <input class="form-control" type="text" id="cellphone" value="{{$company->location[0]->cellphone}}">
                </div>
                <div class="col-lg-2 mb-4">
                    <p>Correo electrónico:</p>
                </div>
                <div class="col-lg-4 mb-4">
                    <input class="form-control" type="text" id="email_contact" value="{{$company->location[0]->email_contact}}">
                </div>
                <div class="col-lg-2 mb-4">
                    <p>Sitio web:</p>
                </div>
                <div class="col-lg-4 mb-4">
                    <input class="form-control" type="text" id="website" value="{{$company->location[0]->website}}">
                </div>
                <div class="col-lg-12 text-center">
                    <input type="hidden" value="{{URL::asset('')}}" id="URL">
                    <button class="btn bg-pink-400 text-white pl-5 pr-5" id="btnContact">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/provider/escaparate.js')}}"></script>
@endsection