@include('public.top')
<div class="container">
    <div class="row text-center">
        {{-- <img class="width-logo-head" src="{{asset('media/logos/ba-black.png')}}">
        <hr class="hr-h">
        <div class="row row-cols-4">
            <div class="col">MI BODA</div>
            <div class="col"><a class="text-dark" href="{{route('proveedores')}}">PROVEEDORES</a></div>
            <div class="col">BRIDE MAG</div>
            <div class="col"><a class="text-dark" href="{{route('brideweekend')}}">BRIDE WEEKEND</a></div>
        </div>
        <hr class="hr-h"> --}}
        <div class="col-lg-2 mt-5 pt-3 border-top border-bottom border-dark">
            <div class="col">MI BODA</div>
        </div>
        <div class="col-lg-2 mt-5 pt-3 border-top border-bottom border-dark">
            <div class="col"><a class="text-dark" href="{{route('proveedores')}}">PROVEEDORES</a></div>
        </div>
        <div class="col-lg-4 border-bottom border-dark">
            <div class="col"><a href="{{URL::asset('')}}"><img class="width-logo-head" src="{{asset('media/logos/ba-black.png')}}"></a></div>
        </div>
        <div class="col-lg-2 mt-5 pt-3 border-top border-bottom border-dark">
            <div class="col">BRIDE MAG</div>
        </div>
        <div class="col-lg-2 mt-5 pt-3 border-top border-bottom border-dark">
            <div class="col"><a class="text-dark" href="{{route('brideweekend')}}">BRIDE WEEKEND</a></div>
        </div>
    </div>
</div>

@include('public.modals.login')
@include('public.modals.register')
