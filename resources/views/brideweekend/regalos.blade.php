@extends('brideweekend.layout')
@section('head')
    <title>Bride Weekend - Regalos</title>
    <link rel="stylesheet" href="{{asset('css/brideweekend/regalos.css')}}">
@endsection
@section('content')
    <br>
    <img class="img" src="{{asset('media/brideweekend/crucero.png')}}">
    <div class="container">
        <div class="row center-align">
            <h5 class="title-gifts">¡LLÉNATE DE ENERGÍA EN EL CARIBE!</h5>
            <p class="text-principal">
                Visita el Caribe y vive una experiencia inolvidable en pareja donde podrán 
                sumergirse en las aguas color turquesa y ver la vida submarina más de 
                cerca en una aventura de buceo. Cientos de años de historia han dejado 
                ruinas en el medio de la selva que se remontan a tiempos antiguos, así 
                como agitadas ciudades coloniales con edificios coloridos que reflejan esa 
                historia fascinante.
            </p>
            <br>
            <div class="col l4 m4 s12">
                <div class="card">
                    <div class="card-image">
                        <img class="img" src="{{asset('media/brideweekend/cardRegalos1.png')}}">
                    </div>
                    <div class="card-content">
                        <p class="subtitle-gifts">LANZA TU APETITO AL VIENTO</p>
                        <p>
                            No solo disfrutarás de increíbles destinos y entretenimiento 
                            impresionante durante tus vacaciones. Tus papilas gustativas 
                            también vivirán una aventura, durante todo tu viaje te ofrecerémos 
                            excelentes propuestas gastronómicas para disfrutar con tu pareja.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col l4 m4 s12">
                <div class="card">
                    <div class="card-image">
                        <img class="img" src="{{asset('media/brideweekend/cardRegalos2.png')}}">
                    </div>
                    <div class="card-content">
                        <p class="subtitle-gifts">NOCHES QUE NUNCA OLVIDARÁS</p>
                        <p>
                            Olvídate de ir a dormir en la noche, porque las actividades están 
                            recién comenzando. Disfruta de un épico musical y baila al ritmo 
                            de tus canciones favoritas. Muestra a todos tus habilidades de vocalista 
                            en el escenario principal o una sala privada de karaoke.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col l4 m4 s12">
                <div class="card">
                    <div class="card-image">
                        <img class="img" src="{{asset('media/brideweekend/cardRegalos3.png')}}">
                    </div>
                    <div class="card-content">
                        <p class="subtitle-gifts">DISEÑADOS PARA SATISFACER TUS NECESIDADES DE COMODIDAD</p>
                        <p>
                            Nuestros camarotes ofrecen comodidad de spa para que puedas desconectarte de 
                            la realidad y reconectarte con tu pareja de aventuras. Servicio de habitaciones 
                            las 24 horas para recargar energía entre emociones.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col l8 m8 s12 offset-l2 offset-m2">
                <br><br>
                <hr class="hr-gifts">
                <h5 class="title-gifts">¡COMIENZA TU AVENTURA!</h5>
                <p class="text-principal">
                    Regístra todas tus compras al asistir a Bride Weekend Expo para 
                    tener la oportunidad de ganar ésta increíble experiencia en pareja.
                </p>
                <a class="btn btn_buys darken-3" href="https://boletos.brideadvisor.mx">COMPRA TU BOLETO</a>
                <br><br>
                <hr class="hr-gifts">
                <br><br>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    
@endsection