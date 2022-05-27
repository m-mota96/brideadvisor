<nav class="navbar navbar-expand-lg justify-content-center p-0 navbar-light bg-white container">
    <div class="">
    <a class="navbar-brand" href="#">
       {{--  <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">--}}
        Bride Advisor
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    <div class="navbar-collapse collapse justify-content-center pl-4" id="navbarNav">
       <!-- Left Side Of Navbar -->
       <ul class="navbar-nav mr-auto">
        <li class="nav-item"> <a class="nav-link" href="">{{ __('MI BODA') }}</a></li>
    </ul>

    <ul class="navbar-nav mr-auto">
        <li class="nav-item"> <a class="nav-link" href="{{ route('proveedores') }}">{{ __('PROVEEDORES') }}</a></li>
    </ul>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item"> <a class="nav-link" href="{{ route('login') }}">{{ __('BRIDE MAG') }}</a></li>
    </ul>

    <ul class="navbar-nav mr-auto">
        <li class="nav-item"> <a class="nav-link" href="{{ route('login') }}">{{ __('BRIDE WEEKEND') }}</a></li>
    </ul>
    </div>
</nav>