@extends('layouts.app_provider')

@section('content')

@php
    $categories = App\CategoryProvider::all();

@endphp
<h4 class="text-center py-2">Completa la información de tu empresa</h4>
<form method="POST" action="{{ route('register') }}">
    @csrf
    <input type="hidden" name="role_id" value="2" id="">
    <div class="form-row">
        <div class="form-group col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre Comercial" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" placeholder="Persona de Contacto" name="contact" value="{{ old('contact') }}" required autocomplete="contact">

            @error('contact')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <input id="telefono" type="tel" class="form-control @error('telefono') is-invalid @enderror" placeholder="Télefono" name="telefono" value="{{ old('telefono') }}" required autocomplete="email">

            @error('telefono')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <select id="category" name="category_id" class="form-control">
                <option disabled selected>Categoria</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <input id="city" type="tel" class="form-control @error('city') is-invalid @enderror" placeholder="Ciudad" name="city" value="{{ old('city') }}" required autocomplete="city">

            @error('city')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <input id="url" type="url" class="form-control @error('url') is-invalid @enderror" placeholder="Sitio Web" name="url" value="{{ old('url') }}" required autocomplete="url">

            @error('url')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <input id="adress" type="text" class="form-control @error('adress') is-invalid @enderror" name="adress" placeholder="Direccion" value="{{ old('adress') }}" required autocomplete="adress">

            @error('adress')
            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Correo" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Ingresar Contraseña" name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <input id="password-confirm" type="password" class="form-control" placeholder="Ingresar contraseña de nuevo" name="password_confirmation" required autocomplete="new-password">
        </div>
    </div>
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-5">
            <button type="submit" class="btn bg-pink-300 text-white">
                {{ __('Ingresar') }}
            </button>
        </div>
    </div>
</form>
@endsection
