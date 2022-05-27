@extends('brideweekend.layout')
@section('head')
    <title>Bride Weekend - Expositor</title>
    <link rel="stylesheet" href="{{asset('css/brideweekend/expositor.css')}}">
@endsection
@section('content')
    <div class="hide-on-med-and-down"><br><br></div>
    <div class="row">
        <div class="col l10 offset-l1">
            <div class="col l6 hide-on-med-and-down">
                <img class="img" src="{{asset('media/brideweekend/expositor.png')}}">
            </div>
            <div class="col l6">
                <h5 class="title">EXPOSITOR</h5>
                <p class="justify">
                    BRIDE WEEKEND es la cita ineludible para los profesionales de la industria nupcial y el evento ideal para todas aquellas parejas que están planeando su boda y que puedan vivir la experiencia de encontrar lo necesario para el día más importante de sus vidas. <br><br>
                    Un nuevo concepto de exposición en el que las parejas, podrán disfrutar de pasarelas y otras actividades en las que obsequiarán importantes premios como productos, y servicios para su boda, lunas de miel y hasta un auto. <br><br>
                    Somos líderes en el mercado de exposiciones, debido a nuestra experiencia con diversos conceptos de éxito, esperamos a más de 5,000 asistentes en esta edición y contar con la participación de 200 expositores de diferentes giros.
                </p>
            </div>
            <div class="col l6 hide-on-large-only">
                <img class="img" src="{{asset('media/brideweekend/expositor.png')}}">
            </div>
        </div>
        <div class="col s12 l10 offset-l1 center-align space-title grey darken-3">
            <h5 class="white-text">INFORMACIÓN Y CONTÁCTO</h5>
        </div>
        <div class="col s12 l10 offset-l1 paddings">
            <form id="contactEXT">
                <div class="col l6 s6 center-align padding-left">
                    <br><br>
                    <h6>NOMBRE</h6>
                    <input type="text" class="inputs" id="name" required>
                </div>
                <div class="col l6 s6 center-align padding-right">
                    <br><br>
                    <h6>APELLIDOS</h6>
                    <input type="text" class="inputs" id="last_name" required>
                </div>
                <div class="col l6 s6 center-align padding-left">
                    <br>
                    <h6>TELÉFONO</h6>
                    <input type="number" class="inputs" id="phone" required>
                </div>
                <div class="col l6 s6 center-align padding-right">
                    <br>
                    <h6>CORREO</h6>
                    <input type="email" class="inputs" id="email" required>
                </div>
                <div class="col l12 m12 s12 center-align paddings">
                    <br>
                    <h6>COMENTARIOS</h6>
                    <textarea class="inputs" id="message" required></textarea>
                    <br><br><br>
                    <button class="btn grey darken-2 white-text" id="send">ENVIAR</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    
@endsection