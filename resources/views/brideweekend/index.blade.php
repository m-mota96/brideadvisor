@extends('brideweekend.layout')
@section('head')
    <title>Bride Weekend</title>
@endsection
@section('content')
    <div class="row">
        <div class="row">
            <div class="slider">
                <ul class="slides">
                    <li>
                        <img src="{{asset('media/slides/bw-index/slider01.png')}}">
                    </li>
                    <li>
                        <a href="{{route('brideweekend/regalos')}}"><img src="{{asset('media/slides/bw-index/slider02.png')}}"></a>
                    </li>
                    <li>
                        <img src="{{asset('media/slides/bw-index/slider03.png')}}">
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container center-align">
            <br>
            <h5>¡Consulta los próximos eventos en tu ciudad!</h5><br>
            <div class="ciudad">
                <h5>Selecciona tu ciudad</h5>
            </div>
            <div class="select-ciudad">
                <select class="select-city" id="selectCity">
                    <option value="" disabled selected>______________</option>
                    @foreach ($data as $val)
                        <option value="{{$val->id}}">{{$val->city->city}}</option>
                    @endforeach
                </select>
                <input type="hidden" id="URL" value="{{URL::asset('')}}">
            </div>
            <a href="{{URL::asset('/')}}"><img class="img space-banner" src="{{URL::asset('media/brideweekend/banner01.png')}}"></a>
        </div>
        <div class="col l10 offset-l1 space-banner center-align">
            <h4>EXPERIENCIA BRIDE WEEKEND</h4>
            <br>
            <video class="img" src="{{asset('media/videos/brideweekend/bw.mp4')}}" autoplay controls autobuffer muted></video>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/brideweekend/index.js')}}"></script>
@endsection