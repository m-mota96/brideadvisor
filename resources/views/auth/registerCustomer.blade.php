@extends('layouts.register')

@section('content')
    @php
        $categories = App\CategoryProvider::all();
       // dd($categories);
    @endphp

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="col-img"><img style="max-width: 100%;" src="{{asset('media/content/register-novio.jpg')}}"></div>
        </div>
        <div class="col-md-6 py-4">
            <form method="POST" action="{{ route('complete.customer') }}">
                @csrf
        <div class="stepwizard">
        <div class="setup-panel">
            <div hidden class="stepwizard-step" style="">
                <a href="#step-1" type="button" class="btn btn-circle"></a>
            </div>

            <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-circle-selected btn-circle"></a>
            </div>

            <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-circle-not-selected btn-circle"></a>
            </div>

            <div class="stepwizard-step">
                <a href="#step-4" type="button" class="btn btn-circle-not-selected btn-circle"></a>
            </div>

        </div>
        </div>

        <div class="row setup-content" id="step-1">
        <div class="col-md-12 pt-4">
            <!-- content go here -->
            <br>
            <div class="col-md-11 pt-4">
            <h1 class="display-4">Bienvenida a Bride Advisor</h1>
                <p>Antes de comenzar con la paneación de tu boda,
                nos gustaría saber un poco mas de ti.</p>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6">
                    <button id="startButton" type="button" class="btn btn-block nextBtn pull-right" style="width: 70%; border-radius: 20px; background-color: #ff89cb">
                        {{ __('Comenzar') }}
                    </button>
                </div>
            </div>
        </div>
        </div>

        <div class="row setup-content" id="step-2">
            <div class="row">
                <!-- content go here -->
                <div class="ml-4">
                    <div class="col-md-11">
                        <br>
                        <h1 class="display-4">Queremos conocer a tu otra mitad.</h1>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8">
                            <input id="name" type="text" placeholder="Nombre Completo" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 offset-md-1">
                            <ul class="user-genre">
                                <li>
                                    <input type="radio" id="novia" name="genre" value="novia" class="custom-control-input @error('genre') is-invalid @enderror" />
                                    <label for="novia">Novia</label>
                                </li>
                                <li>
                                    <input type="radio" id="novio" value="novio"  name="genre" />
                                    <label for="novio">Novio</label>
                                </li>
                                <li>
                                    <input type="radio" id="otro" value="otro" name="genre" />
                                    <label for="otro">Otro</label>
                                </li>
                            </ul>
                            @error('genre')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="engagement_date" class=" col-form-label mr-0">{{ __('Fecha de compromiso:') }}</label>
                        <div class="col-md-4">
                            <input id="engagement_date" type="date" class="form-control @error('engagement_date') is-invalid @enderror" name="engagement_date" value="{{ old('engagement_date') }}" required autocomplete="engagement_date">

                            @error('engagement_date')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <br>
                            <button type="button" class="btn btn-block nextBtn pull-right" style="width: 70%; border-radius: 20px; background-color: #ff89cb">
                                {{ __('Siguiente') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="row setup-content" id="step-3">
                <div class="row">
                    <!-- content go here -->
                    <div class="ml-4">
                        <div class="col-md-11">
                            <br>
                            <h1 class="display-4">Tu Boda.</h1>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-md-2 col-form-label text-md-right">{{ __('Fecha:') }}</label>
                            <div class="col-md-10">
                                <input id="wedding_date" type="date" class="form-control @error('wedding_date') is-invalid @enderror" name="wedding_date" value="{{ old('wedding_date') }}" required autocomplete="wedding_date">

                                @error('wedding_date')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="place" class="col-md-2 col-form-label text-md-right">{{ __('Lugar:') }}</label>

                            <div class="col-md-10">
                                <input id="place" type="text" class="form-control @error('place') is-invalid @enderror" name="place" value="{{ old('place') }}" autocomplete="place">

                                @error('place')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="invitados" class="col-md-5 col-form-label text-md-right">{{ __('No. de invitados:') }}</label>
                            <div class="col-md-7">
                                <input id="invitados" type="number" class="form-control @error('invitados') is-invalid @enderror" name="invitados" value="{{ old('invitados') }}" autocomplete="invitados">

                                @error('invitados')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="budget" class="col-md-5 col-form-label">{{ __('Presupuesto definido:') }}</label>

                            <div class="col-md-7">
                                <input id="budget" type="number" class="form-control @error('budget') is-invalid @enderror" name="budget" value="{{ old('budget') }}" autocomplete="budget">

                                @error('budget')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                            <div class="col-md-6">
                                <br>
                                <button type="button" class="btn btn-block nextBtn pull-right" style="width: 70%; border-radius: 20px; background-color: #ff89cb">
                                    {{ __('Siguiente') }}
                                </button>
                            </div>
                        </div>
                </div>
            </div>

        <div class="row setup-content" id="step-4">
            <div class="row">
                <div class="ml-4">
                <!-- content go here -->
                <div class="col-md-11">
                    <br>
                    <h1 class="display-4">Cuentanos un poco sobre lo que estás buscando.</h1>
                </div>
                <br>
                <p>Selecciona hasta seis opciones.</p>
                <div class="form-group row col-md-9">
                    @foreach ($categories as $category)
                        <div class="col-md-4col-md-4 ml-md-auto"> <input name="category[]" type="checkbox" id='{{$category->name}}' value="{{$category->id}}" class='chk-btn category' />  <label for='{{$category->name}}'>{{$category->name}}</label></div>
                    @endforeach

                </div>
                <br> <br>
                <div class="form-group row mb-0">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-block nextBtn pull-right" style="width: 70%; border-radius: 20px; background-color: #ff89cb">
                            {{ __('Finalizar') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </form>
        </div>
    </div>
</div>
    <script>
        $( document ).ready(function() {
            $('input[type=checkbox]').on('change', function (e) {
                if ($('input[type=checkbox]:checked').length > 6) {
                    $(this).prop('checked', false);
                    alert("allowed only 3");
                }
            });
        });
    </script>
@endsection
