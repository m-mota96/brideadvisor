    <!-- Modal -->

  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 570px;" role="document">
      <div class="modal-content" style="border-bottom: 15px solid #ff7b7b;">
         {{--<div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>  --}}
        <div class="modal-body">
            {{-- Formulario --}}
            <div class="row justify-content-center" >
                <div class="col-md-10">
                    <div class="text-center">
                    <img class="width-logo-head" src="{{asset('media/logos/ba-black.png')}}">

                    <h1>Accede a tu cuenta</h1>
                    <p><a href="http://"> ¿No tienes cuenta? Regístrate aquí.</a></p>
                </div>
                    {{-- Logo --}}
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input id="email" type="text" placeholder="Correo" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input id="password" type="password" placeholder="Contraseña" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn bg-pink-400" style="width: 70%; border-radius: 20px;">
                                            {{ __('Entrar') }}
                                        </button>
                                    </div>

                                </div>
                                <br>
                                <div class="text-center">
                                       @if (Route::has('password.request'))
                                           <a class=" btn-link" href="{{ route('password.request') }}">
                                               {{ __('¿Olvidaste tu contraseña?') }}
                                           </a>
                                       @endif
                                       <hr style="width:90%;" class=" bg-pink-400">
                                       <h2>¿Eres proveedor?</h2> <br>
                                       <a href="#">Entra al perfil de empresas.</a>
                                </div>
                                <br>
                            </form>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
