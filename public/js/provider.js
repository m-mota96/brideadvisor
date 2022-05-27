$(document).ready(()=> {
    $('.fancybox').fancybox();
    $('#image-gallery').lightSlider({
        gallery:true,
        item:1,
        thumbItem:4,
        slideMargin: 0,
        speed:1000,
        controls: true,
        prevHtml: '',
        nextHtml: '',
        enableDrag:false,
        // auto:true,
        // loop:true,
        onSliderLoad: function() {
            $('#image-gallery').removeClass('cS-hidden');
        }  
    });

    initMap();

});

function initMap() {
    center = getPosicion();
    var elem = document.getElementById("map");
    if (center == null) {
        center = {lat: 20.676580, lng: -103.34785};
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (pos) {
                center = {lat: pos.coords.latitude, lng: pos.coords.longitude};
                drawMap(elem, center);
                setPosicion(center);
            }, function () {
                drawMap(elem, center);
            });
        } else {
            drawMap(elem, center);
        }
    } else {
        drawMap(elem, center);
    }
}

function drawMap(elem, center) {
    map = new google.maps.Map(elem, {
        center: center,
        zoom: 14
    });
    marker = new google.maps.Marker({
        position: center,
        map: map,
        animation: google.maps.Animation.DROP,
        title: 'Mueve el mapa'
    });
    map.addListener('center_changed', function () {
        var p = map.getCenter();
        marker.setPosition({lat: p.lat(), lng: p.lng()});
        setPosicion({lat: p.lat(), lng: p.lng()});
    });
}

function setPosicion(center) {
    $("#latitude").val(center.lat);
    $("#longitude").val(center.lng);
    latitud = center.lat;
    longitud = center.lng;
}

function getPosicion() {
    if ($("#latitude").val() != "" && $("#latitude").val() != undefined) {
        return {lat: parseFloat($("#latitude").val()), lng: parseFloat($("#longitude").val())};
    }
    return null;
}

$("input[name='locradio']").change(function() {
    $.ajax({
        dataType: 'json',
        url: $('#URL').val()+'extractLocation',
        method: 'get',
        data: {
            'location_id': $(this).val()
        },
        success: (res)=> {
            if(res.location.postal_code!=null) {
                $('#addressLocation').text(res.location.address+', '+res.location.postal_code);
            } else {
                $('#addressLocation').text(res.location.address);
            }
            if(res.location.latitude!=null && res.location.longitude!=null) {
                $("#latitude").val(res.location.latitude);
                $("#longitude").val(res.location.longitude);
                initMap();
                $('#map').css('height', '500px');
            } else {
                var text = '<h5 class="mt-5">Acceder a <a href="https://www.google.com.mx/maps" target="_blank">Google Maps</a></h5>';
                $('#map').css('height', 'unset');
                document.getElementById('map').innerHTML = text;
            }
        },
        error: ()=> {
            console.log('Error');
        }
    })
});

$('#clickMap').on('click', ()=> {
    $('html,body').animate({
        scrollTop: $("#divMap").offset().top
    }, 1000);
});

$('#clickOpinions').on('click', ()=> {
    $('html,body').animate({
        scrollTop: $("#divOpinions").offset().top
    }, 1000);
});

$('#btnComment').on('click', ()=> {
    $('#modalComment').modal('show');
});

$('#saveComment').on('click', ()=> {
    if($('#areaComment').val()!='') {
        saveInfo(null, null, null, null, $('#areaComment').val(), 'comment');
    } else {
        Swal.fire({
            title: 'Por favor escriba sus comentarios',
            icon: 'error'
        });
    }
});

$('#saveQualification').on('click', ()=> {
    var price = $('input:radio[name=price]:checked').val();
    var quality = $('input:radio[name=quality]:checked').val();
    var professionalism = $('input:radio[name=professionalism]:checked').val();
    var attention = $('input:radio[name=attention]:checked').val();
    if(price!=undefined && quality!=undefined && professionalism!=undefined && attention!=undefined) {
        saveInfo(price, quality, professionalism, attention, null, 'qualification');
    } else {
        Swal.fire({
            title: 'Debe poner calificación a todas las opciones',
            icon: 'error'
        });
    }
});

function saveInfo(price=null, quality=null, professionalism=null, attention=null, message=null, type) {
    // console.log(price+', '+quality+', '+professionalism+', '+attention+', '+message+', '+type);
    $.ajax({
        dataType: 'json',
        url: $('#URL').val()+'saveQualification',
        method: 'post',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            provider_id: $('#providerId').val(),
            price: price,
            quality: quality,
            professionalism: professionalism,
            attention: attention,
            message: message,
            type: type,
        },
        success: (res)=> {
            if(res.status=='success') {
                if(type=='comment') {
                    $('#modalComment').modal('hide');
                }
                Swal.fire({
                    title: 'Datos guardados con éxito',
                    icon: 'success'
                });
            } else if(res.status=='not_session') {
                Swal.fire({
                    title: 'Inicie sesión para guardar',
                    icon: 'warning'
                });
            } else if(res.status=='not_customer') {
                Swal.fire({
                    title: 'Los proveedores no pueden calificar ni comentar perfiles',
                    icon: 'warning'
                });
            } else if(res.status=='denied_access') {
                if(type=='comment') {
                    $('#modalComment').modal('hide');
                }
                Swal.fire({
                    title: res.msg,
                    icon: 'error'
                });
            } else {
                Swal.fire({
                    title: 'Lo sentimos, ocurrio un error al guardar',
                    icon: 'error'
                });
            }
        },
        error: ()=> {
            Swal.fire({
                title: 'Lo sentimos, ocurrio un error al guardar',
                icon: 'error'
            });
        }
    });
}