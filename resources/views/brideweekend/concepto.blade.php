@extends('brideweekend.layout')
@section('head')
    <title>Bride Weekend - Concepto</title>
    <link rel="stylesheet" href="{{asset('slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('slick/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/brideweekend/ciudad.css')}}">
@endsection
@section('content')
<div class="hide-on-med-and-down"><br><br></div>
<div class="row">
    <div class="col l10 offset-l1">
        <div class="col l6 hide-on-med-and-down">
            <img class="img" src="{{asset('media/brideweekend/concepto.png')}}">
        </div>
        <div class="col l6">
            <h5 class="title">CONCEPTO</h5>
            <p class="justify">
                En BRIDE WEEKEND reinventamos el concepto tradicional de las expos de boda en una experiencia única capaz de ofrecer a las parejas, en un solo fin de semana y en un único espacio, todo lo necesario para crear su boda perfecta.  <br><br>
                Nos mantenemos a la vanguardia en la industria nupcial, al contar con más de 2,000 modelos de vestidos de diferentes marcas para estar completamente seguros de que aquí encontrarás el ideal para ti. <br><br>
                Tendencias, creatividad y emoción se dan cita en un fin de semana, donde encontrarás una variada y seleccionada oferta de servicios nupciales. Conocer novedades, obtener el mejor asesoramiento, disfrutar de pasarelas y obtener regalos, para hacer realidad la boda de tus sueños.
            </p>
        </div>
        <div class="col l6 hide-on-large-only">
            <img class="img" src="{{asset('media/brideweekend/concepto.png')}}">
        </div>
        <div class="col l12 m12 s12 space"></div>
        <div class="col l6">
            <h5 class="title">NOVIA</h5>
            <p class="justify">
                En BRIDE WEEKEND nos esforzamos cada día para que todo salga impecable, nuestro compromiso es hacer realidad el sueño de la boda perfecta de cada pareja según sus gustos e ideas. <br><br>
                Somos especialistas en reducir el estrés y calmar a los novios en esos momentos de nervios durante la organización de su boda, logrando que las vivencias durante todo este proceso resulten divertidas, excitantes, con ilusión y sobre todo con un concepto vanguardista, jóven, moderno e incluyendo las ultimas tendencias de moda. Por ello contamos con dos pasarelas por día, durante el evento, con las últimas tendencias de vestidos de novia. <br><br>
                Consulta la información de tu ciudad  para enterarte de todos los detalles del evento y no perder la oportunidad de vivirlo. 
            </p>
        </div>
        <div class="col l6">
            <img class="img" src="{{asset('media/brideweekend/novia.png')}}">
        </div>
    </div>
    <div class="col l12 m12 s12 space"></div>
    <div class="col l12 m12 s12 center-align">
        <h4 class="grey-text text-darken-3 bold">PRÓXIMOS EVENTOS</h4>
        <hr class="hr-concept">
        @include('brideweekend.carousel')
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{asset('slick/slick.min.js')}}"></script>
    <script src="{{asset('js/brideweekend/concepto.js')}}"></script>
@endsection