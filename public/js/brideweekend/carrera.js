$(document).ready(function() {
    $('.collapsible').collapsible();
    $('.jcarousel-cities').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        // speed: 1000,
        arrows: true,
        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-left flecha" aria-hidden="true"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right flecha" aria-hidden="true"></i></button>',
        // autoplay: true,
        lazyLoad: 'ondemand',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true
                },
            },
        ],
    });
});
$('.imgCarou').on('click', function() {
    $(".pageContainer").show();
    var city = $(this).attr('id');
    if(city == 1)
    {
        // Guadalajara
        $('#fecha').text('Domingo 27 de Septiembre del 2020');
        $('#lugar').text('Guadalajara, Jalisco');
        $('#entrega').text('EXPO GUADALAJARA');
        $("#registro").attr("href", " https://boletos.brideadvisor.mx/evento/Guadalajara-2020-06");
    }
    if(city == 2)
    {
       //Queretaro
        $('#fecha').text('Domingo 20 de Septiembre del 2020');
         $('#lugar').text('Querétaro, Querétaro');
        $('#entrega').text('CENTRO DE CONGRESOS');
        $("#registro").attr("href", " https://boletos.brideadvisor.mx/evento/Queretaro-2020-09");
        $('#packId').text('de 04:00pm a 08:00pm el Sábado 19 de Septiembre');
    }
    if(city == 3)
    {
        // Puebla
         $('#fecha').text('Domingo 6 de Septiembre del 2020');
         $('#lugar').text('Puebla, Puebla');
         $('#entrega').text('CENTRO EXPOSITOR LOS FUERTES');
         $("#registro").attr("href", " https://boletos.brideadvisor.mx/evento/Puebla-2020-09");
         $('#packId').text('de 11:00am a 08:00pm el Sábado 05 de Septiembre');
    }
     if(city == 4)
    {
        // CDMX
        $('#fecha').text('Domingo 30 de Agosto del 2020');
        $('#lugar').text('Ciudad de México');
         $('#entrega').text('CENTRO CITIBANAMEX');
         $("#registro").attr("href", " https://boletos.brideadvisor.mx/evento/Cdmx-2020-08");
         $('#packId').text('de 11:00am a 08:00pm el Sábado 21 de Marzo');
    }
      if(city == 5)
    {
        //SLP
        $('#fecha').text('Domingo 28 de Junio del 2020');
        $('#lugar').text('San Luis Potosí, San Luis Potosí');
         $('#entrega').text('CENTRO DE CONVENCIONES');
         $("#registro").attr("href", "https://boletos.brideadvisor.mx/evento/Slp-2020-05");
    }
});