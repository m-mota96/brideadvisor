@extends('provider.layout')
@section('head')
    
@endsection
@section('content')
<div class="row">
    @include('provider.submenu')
    <div class="col pl-4 pr-5">
        <div class="col-12 card pb-4">
            <input type="hidden" value="{{URL::asset('')}}" id="URL">
            <input type="hidden" value="{{Auth::user()->id}}" id="idUser">
            <input type="hidden" value="{{$company->id}}" id="provider_id">
            <br>
            <h4 class="m-0">Mis datos</h4>
            <hr>
            <div class="col-l12 card bg-dark p-2">
                <p class="text-white m-0">
                    Modifica la información general de tu empresa. Es muy importante 
                    que toda la información publicada en tu escaparate y tus datos de 
                    contacto estén actualizados y sean veraces.
                </p>
            </div>
            <br><h4 class="m-0">Datos de Acceso</h4>
            <hr>
            <div class="row mb-3">
                <div class="col-6">
                    <label>Usuario:</label>
                    <input class="form-control" type="text" id="user" value="{{Auth::user()->email}}">
                </div>
                <div class="col-6">
                    <label>Contraseña actual:</label>
                    <input class="form-control" type="password" id="password">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-6">
                    <label>Contraseña nueva:</label>
                    <input class="form-control" type="password" id="newpassword">
                </div>
                <div class="col-6">
                    <label>Confirmar nueva contraseña:</label>
                    <input class="form-control" type="password" id="passwordconfirm">
                </div>
            </div>
            <div class="row justify-content-center">
                <button class="btn bg-pink-200" id="btnCredentials">GUARDAR</button>
            </div>
            <br><h4 class="m-0">Describe tu empresa</h4>
            <hr>
            <div class="row mb-4">
                <div class="col-8">
                    <form id="formCompany">
                        <label>Nombre de Empresa:</label>
                        <input class="form-control" type="text" value="{{$company->user->name}}" id="nameCompany" required>
                        <br><label>Descripción del servicio:</label>
                        <textarea class="form-control" id="descriptionCompany" required rows="10">{{$company->description}}</textarea>
                        <div class="row justify-content-center pt-4">
                            <button class="btn bg-pink-200">GUARDAR</button>
                        </div>
                    </form>
                </div>
                <div class="col">
                    <p class="text-justify">
                        Describe detalladamente tu empresa así como los 
                        servicios o productos de bodas que ofreces con 
                        la máxima información de interés para los novios.
                    </p>
                    <div class="card p-3">
                        <p class="text-center"><b>Precio de tus servicios</b></p>
                        <label>Precio mínimo:</label>
                        <input class="form-control mb-3" type="number" id="price_min" value="{{$company->price_min}}">
                        <label>Precio máximo:</label>
                        <input class="form-control mb-3" type="number" id="price_max" value="{{$company->price_max}}">
                        <p class="text-justify">
                            <b>Nota:</b> complete los precios para que su 
                            perfil se recomiende a las novias que tengan un 
                            presupuesto dentro de su rango de precios.
                        </p>
                        <div class="row justify-content-center">
                            <button class="btn bg-pink-200" id="btnPrice">GUARDAR</button>
                        </div>
                    </div>
                </div>
            </div>
            <br><h4 class="m-0">Datos de contacto</h4>
            <hr>
            <div class="row mb-4 justify-content-center">
                <select class="col-4 mb-5 form-control" id="locations">
                    @foreach ($company->location as $loc)
                        <option value="{{$loc->id}}">{{$loc->city}}</option>
                    @endforeach
                </select>
                <div class="row col-12 mb-4">
                    <div class="col-4">
                        <label>Persona de contacto:</label>
                        <input class="form-control" type="text" id="name_contact" value="{{$company->location[0]->name_contact}}">
                    </div>
                    <div class="col-4">
                        <label>Correo electrónico:</label>
                        <input class="form-control" type="text" id="email_contact" value="{{$company->location[0]->email_contact}}">
                    </div>
                    <div class="col-4">
                        <label>Teléfono:</label>
                        <input class="form-control" type="number" id="phone" value="{{$company->location[0]->phone}}">
                    </div>
                    <div class="col-4 mt-3">
                        <label>Celular:</label>
                        <input class="form-control" type="number" id="cellphone" value="{{$company->location[0]->cellphone}}">
                    </div>
                    <div class="col-4 mt-3">
                        <label>Página Web:</label>
                        <input class="form-control" type="text" id="website" value="{{$company->location[0]->website}}">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <button class="btn bg-pink-200" id="btnContact">GUARDAR</button>
                </div>
            </div>
            <br><h4 class="m-0">Categoría</h4>
            <hr>
            <div class="row mb-4 p-3 justify-content-center">
                <select class="form-control mb-4" id="category">
                    @foreach ($categories as $cat)
                        @if ($company->category_id==$cat->id)
                            <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                        @else
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endif
                    @endforeach
                </select>
                <button class="btn bg-pink-200" id="btnCategory">GUARDAR</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/provider/escaparate.js')}}"></script>
@endsection