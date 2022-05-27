<div class="row">
    <br><br>
    <div class="col s12 l10 offset-l1">
        <div class="row jcarousel-cities center">
            @foreach($cities as $val)
                <div class="col s12 m3 l4-jcaroul post">
                    <a href="{{route('brideweekend/ciudad', $val->id)}}">
                        <div class="col l12 m12 s12" 
                        style="
                            background-image: url('{{asset('media/enclosures/'.$val->enclosure->image.'')}}');
                            background-size: cover;
                            background-repeat: no-repeat;
                            height: 350px;
                            width: 100% !important;
                            background-position: center;
                        ">
                            <h4 class="white-text title-carousel"><?= strtoupper($val->city->city) ?></h4> 
                            {{-- <h6 class="white-text title-carousel size-subtitle">{{$val->dateFormat}}</h6> --}}
                            <h6 class="white-text title-carousel size-subtitle">{{$val->dateParse}}</h6>
                            <div class="div-logo">
                                    <img class="img img-carousel" src="{{asset('media/enclosures/'.$val->enclosure->logo.'')}}">
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>