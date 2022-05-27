<nav class="navbar navbar-expand-md navbar-light bg-gray-200 container p-0">

        <div class=" navbar-collapse" id="navbarSupportedContent" style="font-size: 0.75em;">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item text-center">
                    <a class="nav-link" href="{{ route('customer.home') }}">
                        <div>
                        <img class="" style="width:20%;" src="{{asset('Iconos/navbar/MiPerfil.png')}}">
                        <p>{{ __('MI PERFIL') }}</p>
                        </div>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav mr-auto">
                <li class="nav-item text-center">
                    <a class="nav-link" href="{{ route('customer.checklist') }}">
                        <div>
                            <img class="" style="width:20%;" src="{{asset('Iconos/navbar/Agenda.png')}}">
                        <p>{{ __('AGENDA') }}</p>
                        </div>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav mr-auto">
                <li class="nav-item text-center">
                    <a class="nav-link" href="{{ route('customer.invitation') }}">
                        <div>
                            <img class="" style="width:20%;" src="{{asset('Iconos/navbar/ControldeInvitados.png')}}">
                        <p>{{ __('CONTROL DE INVITACIONES') }}</p>
                        </div>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav mr-auto">
                <li class="nav-item text-center">
                    <a class="nav-link" href="{{ route('customer.expense') }}">
                        <div>
                            <img class="" style="width:20%;" src="{{asset('Iconos/navbar/Presupuesto.png')}}">
                        <p>{{ __('PRESUPUESTO') }}</p>
                        </div>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav mr-auto">
                <li class="nav-item text-center">
                    <a class="nav-link" href="{{ route('login') }}">
                        <div>
                            <img class="" style="width:20%;"src="{{asset('Iconos/navbar/MeGusta.png')}}">
                        <p class="text-center">{{ __('ME GUSTA') }}</p>
                        </div>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav mr-auto">
                <li class="nav-item text-center">
                    <a class="nav-link " href="{{ route('login') }}">
                        <div class="">
                            <img class="" style="width:20%;" src="{{asset('Iconos/navbar/MesAdeRegalos.png')}}">
                            <p>{{ __('MESA DE REGALOS') }}</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
</nav>
