    <!-- Modal -->
    <style>
        .user-genre {
            list-style-type: none;
            margin: 25px 0 0 0;
            padding: 0;
        }

        .user-genre li {
            float: left;
            margin: 0 5px 0 0;
            width: 100px;
            height: 40px;
            position: relative;
        }

        .user-genre label,
        .user-genre input {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 32px;
        }

        .user-genre input[type="radio"] {
            opacity: 0.01;
            z-index: 100;
        }

        .user-genre input[type="radio"]:checked+label,
        .Checked+label {
            background: rgba(223, 227, 181, 0.9);
        }

        .user-genre label {
            padding: 5px;
            border: 1px solid #CCC;
            cursor: pointer;
            z-index: 90;
            padding-left: 25%;
        }

        .user-genre label:hover {
            background: #DDD;
        }
    </style>
  <div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="modalRegister" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 570px;" role="document">
      <div class="modal-content" >
        <div class="modal-body">
            {{-- Formulario --}}
            <div class="row justify-content-center" >
                <div class="col-md-10">
                    <div class="text-center">
                    <img class="width-logo-head" src="{{asset('media/logos/ba-black.png')}}">

                    <h4>Regístrate para comenzar</h4>
                    <h4>con la planeación de tu boda</h4>
                </div>
                    {{-- Logo --}}
                    <form method="POST" action="{{ route('register') }}">
                                @csrf
                        <input type="hidden" value="3" name="role_id">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input id="name" type="text" placeholder="Nombre Completo" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input id="email" type="email" placeholder="Correo" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-md-12 offset-md-1">
                                    <ul class="user-genre">
                                        <li>
                                            <input type="radio" id="novia" name="genre" value="novia"  checked="checked"/>
                                            <label for="novia">Novia</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="novio" name="genre" value="novio" />
                                            <label for="novio">Novio</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="otro" name="genre" value="otro"  />
                                            <label for="otro">Otro</label>
                                        </li>
                                    </ul>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input id="password" placeholder="Contraseña" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">

                                    <div class="col-md-12">
                                        <input id="password-confirm"  placeholder="Confirmar Contraseña"type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <br>
                                <div class="form-check">
                                    <input type="checkbox" name="accept" value="1" class="form-check-input" id="accept" required>
                                    <label class="form-check-label" for="accept">He leído y acepto las condiciones de uso y de privacidad.</label>
                                </div>
                                <br>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn bg-pink-400" style="width: 70%; border-radius: 20px;">
                                            {{ __('Registrar') }}
                                        </button>
                                    </div>

                                </div>
                                <br>
                                <div class="text-center">
                                    <hr style="width:90%; background-color: #ff0787;">
                                    <h2>¿Eres proveedor?</h2>
                                    <p>Entra al perfil de empresas.</p>
                                </div>
                            </form>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
