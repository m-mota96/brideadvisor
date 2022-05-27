<div id="header" class="">
    <nav>
        <div class="nav-wrapper">
            <a href="{{route('brideweekend')}}" class="brand-logo center"><img class="logo" src="{{asset('media/logos/bw.png')}}"></a>
            
            <ul id="nav-mobile" class="left hide-on-med-and-down nav-left">
                <li><a href="{{route('brideweekend/concepto')}}">CONCEPTO</a></li>
                <li><a href="{{route('brideweekend/ciudades')}}">CIUDADES</a></li>
            </ul>
            <ul id="nav-mobile" class="right hide-on-med-and-down nav-right">
                <li><a href="{{route('brideweekend/expositor')}}">EXPOSITOR</a></li>
                <li><a href="">GANADORES</a></li>
            </ul>
        </div>
    </nav>
</div>
<div class="row center-align hide-on-large-only">
    <p></p>
</div>
<hr class="hr-nav">
<div class="row center-align hide-on-large-only">
    <div class="col s3">
        <a class="grey-text" href="{{route('brideweekend/concepto')}}">CONCEPTO</a>
    </div>
    <div class="col s3">
        <a class="grey-text" href="{{route('brideweekend/ciudades')}}">CIUDADES</a>
    </div>
    <div class="col s3">
        <a class="grey-text" href="{{route('brideweekend/expositor')}}">EXPOSITOR</a>
    </div>
    <div class="col s3">
        <a class="grey-text" href="">GANADORES</a>
    </div>
</div>