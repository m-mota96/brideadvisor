@extends('provider.layout')
@section('head')
    <link rel="stylesheet" href="{{asset('fontawesome5.12.1/css/all.css')}}">
@endsection
@section('content')
<div class="container">
    <div class="row card p-3">
        <h5 class="mb-0">Recomendaciones</h5>
        <hr>
        @foreach ($recomendations as $rec)
            <div class="col-4">
                <div class="card p-3">
                    <h5 class="mb-3">{{$rec->customer->boyfriend_name}}</h5>
                    <h6 class="mb-3">{{strftime('%e de %B del %Y', strtotime($rec->created_at))}}</h6>
                    <p>
                        Calificación: &nbsp;&nbsp;
                        @for ($i = 1; $i < 6; $i++)
                            @if ($i<=$rec->qualification)
                                <i class="fas fa-star text-yellow"></i>
                            @else
                                <i class="far fa-star text-yellow"></i>
                            @endif
                        @endfor
                    </p>
                    <p class="text-justify">
                        {{$rec->message}}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
@section('scripts')
    
@endsection