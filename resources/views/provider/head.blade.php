<nav class="navbar navbar-expand-lg pb-0 pt-0 bg-gray-dark-500">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav justify-content-end">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i class="fas fa-user-circle session"></i>
                    <i class="fas fa-bars session"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('provider.cuenta')}}">
                        <i class="fas fa-cog"></i> Mi cuenta
                    </a>
                    <a class="dropdown-item" href="{{route('provider.pagos')}}">
                        <i class="fas fa-shopping-cart"></i> Mis pagos
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row pt-3 mb-1 border-bottom border-dark bg-gray-100">
        <div class="col-lg-2 text-center">
            <a class="text-dark active" href="{{route('provider.home')}}">
                <i class="fas fa-pen size-icon-menu"></i>
                <p>Editar perfil</p>
            </a>
        </div>
        <div class="col-lg-2 text-center">
            <a class="text-dark" href="">
                <i class="far fa-comment-dots size-icon-menu"></i>
                <p>Mensajes</p>
            </a>
        </div>
        <div class="col-lg-4 text-center">
            <img src="{{asset('media/logos/ba_black.png')}}">
        </div>
        <div class="col-lg-2 text-center">
            <a class="text-dark" href="{{route('provider.estadisticas')}}">
                <i class="fas fa-chart-line size-icon-menu"></i>
                <p>Estadísticas</p>
            </a>
        </div>
        <div class="col-lg-2 text-center">
            <a class="text-dark" href="{{route('provider.recomendaciones')}}">
                <i class="far fa-star size-icon-menu"></i>
                <p>Opiniones</p>
            </a>
        </div>
    </div>
    <div class="row">
        {{-- <img class="w-100" src="{{asset('media/providers/'.Auth::user()->name.'/j5t4b43m3n5.png')}}"> --}}
        <div class="col-lg-12 text-center pt-5 pb-4 bg-dark">
            <h1 class="text-white mb-0">{{Auth::user()->name}}</h1>
            {{-- <h5 class="text-white">{{Auth::category()->name}}</h5> --}}
        </div>
    </div>
</div>