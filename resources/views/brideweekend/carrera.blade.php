@extends('brideweekend.layout')
@section('head')
    <title>Bride Weekend - Carrera</title>
    <link rel="stylesheet" href="{{asset('slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('slick/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/brideweekend/carrera.css')}}">
@endsection
@section('content')
    <div class="container center-align">
        <div class="row">
            <br><br>
            <img class="img" src="{{asset('media/brideweekend/carrera.png')}}">
            <div class="col s12 l12 m12 center-align">
                <br><h5><b>Selecciona tu Ciudad</b></h5><br>
                <div class="row jcarousel-cities center">
                    <div class="col s12 m2 l4-jcaroul post">
                        <img class="imgCarou img" id="5" src="{{asset('media/brideweekend/carouselSLP.png')}}">
                    </div>
                    <div class="col s12 m2 l4-jcaroul post">
                        <img class="imgCarou img" id="4" src="{{asset('media/brideweekend/carouselCDMX.png')}}">
                    </div>
                    <div class="col s12 m2 l4-jcaroul post">
                        <img class="imgCarou img" id="3" src="{{asset('media/brideweekend/carouselPUE.png')}}">
                    </div>
                    <div class="col s12 m2 l4-jcaroul post">
                        <img class="imgCarou img" id="2" src="{{asset('media/brideweekend/carouselQRO.png')}}">
                    </div>
                    <div class="col s12 m2 l4-jcaroul post">
                        <img class="imgCarou img" id="1" src="{{asset('media/brideweekend/carouselGDL.png')}}">
                    </div>
                </div>
            </div>

            <div class="pageContainer">
                <div class="col l12 m12 s12 center-align">
                    <hr class="hr-carrera"/>
                    <h5 id="fecha"></h5>
                    <p id="lugar"></p>
                    <p></p>
                    <hr class="hr-carrera"/>
                </div>
                <div class="col l12 m12 s12">
                    <div class="col l6 m6 s12">
                        <br><br>
                        <p class="justify">
                            El Comité organizador de Bridal Weekend, te invita a participar a la
                            Primer Edición de la Carrera de Novios “Juntos Hasta la Meta”.
                            <br><br>

                            Un evento pensado en los corredores principiantes, que tengan el
                            gusto por recorrer 5km en pareja y que la unión de su noviazgo o
                            relacion los haga llegar juntos a la meta, buscando apoyarse el uno
                            con el otro. <br><br>

                            No te quedes fuera de la experiencia que te ofrece esta Carrera de
                            Novios. Partiendo de las instalaciones de , donde formarás parte de
                            un recorrido que en todo momento te animara a llegar Juntos Hasta la
                            Meta.
                        </p>
                    </div>
                    <div class="col l6 m6 s12">
                        <br>
                        <img class="img" src="{{asset('media/brideweekend/cardCarrera.png')}}">
                    </div>
                </div>
                <div class="col l12 m12 s12 center-align">
                    <br><br>
                    <a id="registro" href="" class="btn blue lighten-2 btn-register">Registrate Aquí</a>
                    <br><br>
                </div>
                <div class="col l12 m12 s12">
                    <br>
                    <div class="col l12 m12 s12 center-align blue lighten-2">
                        <h6 class="white-text">
                        INFORMACIÓN DEL EVENTO Y BASES PARA PARTICIPAR
                        </h6>
                    </div>
                    <div class="col l12 m12 s12">
                        <br>
                        <ul class="collapsible">
                            <li>
                                <div class="collapsible-header">
                                    REQUISITOS PARA PARTICIPAR &nbsp;
                                    <i class="fas fa-angle-down"></i>
                                </div>
                                <div class="collapsible-body left-align">
                                    <span>
                                        - Tener al día del evento la edad mimima de 18 años (en caso
                                        de ser menor de edad, debera firmar una reponsiva exhonerando
                                        al comité organizador de cualquier situacion fisica que se les
                                        presente). <br>
                                        - Estar en condiciones físicas adecuadas para competir. <br>
                                        - Realizar el regístro corespondiente. <br>
                                        - Llenar y firmar la cédula de inscripción. <br>
                                        - Cubrir la cuota de recuperación. <br>
                                    </span>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header">
                                    CATEGORÍAS &nbsp;
                                    <i class="fas fa-angle-down"></i>
                                </div>
                                <div class="collapsible-body left-align">
                                    <span class="justify">
                                        CATEGORIAS
                                        <br><br>
                                        PAREJAS PROXIMAS A CASARSE: Son aquellas parejas que estan en
                                        el proceso o con planes de casarse proximamente
                                        <br><br>
                                        PAREJAS EN GENERAL: Son aquellas parejas que ya estan casadas
                                        o con una relacion formal
                                        <br><br>
                                        CORREDORES INDEPENDIENTES: Personas solteras que deseen
                                        participar individualmente.
                                        <br><br>
                                        VESTIMENTA ORIGINAL: Se premiara a la vestimenta mas
                                        original de acuerdo a la tematica del evento y la decisión
                                        de quien gana sera a cargo del comité organizador.
                                    </span>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header">
                                    MOTIVOS DE DESCALIFICACIÓN &nbsp;
                                    <i class="fas fa-angle-down"></i>
                                </div>
                                <div class="collapsible-body left-align">
                                    <span>
                                        Además de los que señala el reglamento de competencia de La
                                        Federación Mexicana de Asociaciones de Atletismo, presentamos
                                        los siguientes: <br><br>
                                        -No tener colocado el número de corredor al frente de la
                                        camiseta durante la competencia. <br>
                                        -Estar delante de la línea de salida en el momento de dar la
                                        señal de inicio de la carrera. <br>
                                        -No pisar los tapetes de salida o los parciales. <br>
                                        -Subirse a un vehículo. <br>
                                        -No seguir la ruta marcada. <br>
                                        -Actitudes antideportivas con corredores y/o jueces. <br>
                                        <!-- -Llegar a la meta sin tu pareja. -->
                                    </span>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header">
                                    DERECHOS DEL COMPETIDOR &nbsp;
                                    <i class="fas fa-angle-down"></i>
                                </div>
                                <div class="collapsible-body left-align">
                                    <span>
                                        -Número del competidor. <br>
                                        -Playera conmemorativa. <br>
                                        -Chip para cronometraje de tiempo. <br>
                                        -Medalla de finalista. <br>
                                        -Abastecimientos en ruta y meta, de agua y bebida isotónica.
                                        <br>
                                        -Certificado de tiempo en internet en www.marcate.com.mx a
                                        partir del domingo 26 de Enero después de las 11:00 hrs.
                                    </span>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header">
                                    ENTREGA DE PAQUETES &nbsp;
                                    <i class="fas fa-angle-down"></i>
                                </div>
                                <div class="collapsible-body left-align">
                                    <span class="justify">
                                        <span id="entrega"></span> durante la EXPO BRIDAL WEEKEND <span id="packId"></span> 
                                        <br><br>
                                        Es indispensable que al recoger tu paquete presentes tú contra
                                        recibo e identificación oficial, si recogerás el paquete de
                                        algún familiar o amigo deberás otorgar copia del IFE de la
                                        misma. (En caso de recoger paquetes de equipos de corredores
                                        deberás de buscar al personal de TIME 4 SPORTS para apoyarte).
                                        <br><br>
                                        La medalla de finalista se entregará al cruzar la meta NO se
                                        entregarán números ni chips el día del evento <br><br>
                                        El competidor que no recoja su paquete el día y la hora
                                        indicada SIN EXCEPCION, PERDERA TODO DERECHO DERIVADO DE SU
                                        INSCRIPCION. NO se entregarán paquetes después del horario
                                        indicado. <br><br>
                                        Organiza tu tiempo para que puedas recoger tu paquete y
                                        disfrutar de EXPO BRIDAL WEEKEND sin contratiempos y evita el
                                        mal momento de negarte el servicio fuera de horario.
                                    </span>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header">
                                    INFORMACIÓN GENERAL &nbsp;
                                    <i class="fas fa-angle-down"></i>
                                </div>
                                <div class="collapsible-body left-align">
                                    <span>
                                        ¡QUEREMOS DARTE EL SERVICIO QUE MERECES! <br><br>
                                        RUTA: La ruta partira desde las instalaciones
                                        <span id="instalaciones"></span> en un recorrido de 5
                                        kilometros <br><br>INSCRIPCIONES: Podrás inscribirte desde la comodidad
                                        de tu casa u oficina a cualquier hora del día, en el portal
                                        web pagando con tarjeta de crédito o débito (Visa, MasterCard
                                        ó American Express) <br><br>
                                        -NO se recibirán inscripciones por vía telefónica <br>
                                        -Inscríbete únicamente en los puntos mencionados, el Comité
                                        Organizador NO se hace responsable por registros hechos en
                                        centros NO oficiales. <br>
                                        -Te recomendamos llegar una hora antes para ubicar
                                        estacionamiento, guardarropa, bloque de salida
                                        correspondiente, encontrar a tus amigos y realizar ejercicios
                                        de calentamiento. <br>
                                        -No se permitirá la entrada al área de recuperación a los
                                        competidores sin número oficial del evento. <br>
                                        -Por tu propia seguridad y la del resto de los corredores NO
                                        se permitirá el ingreso a los corrales de salida con mascotas.
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('slick/slick.min.js')}}"></script>
    <script src="{{asset('js/brideweekend/carrera.js')}}"></script>
@endsection