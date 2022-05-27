$(document).ready(()=> {
    initMap();
});

var map;
var marker;
var center;
var latitud = 0, longitud = 0;

function initMap() {
    center = getPosicion();
    var elem = document.getElementById("mapa");
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

$('#location').on('change', ()=> {
    $('#btnAddress').attr('disabled', true);
    $.ajax({
        url: $('#URL').val()+'extractLocation',
        method: 'get',
        data: {
            location_id: $('#location').val()
        },
        success: (res)=> {
            $('#address').val(res.location.address);
            $('#postal_code').val(res.location.postal_code);
            $('#btnAddress').attr('disabled', false);
        },
        error: ()=> {
            Swal.fire({
                title: 'Lo sentimos ocurrio un error',
                icon: 'error'
            });
            $('#btnAddress').attr('disabled', false);
        }
    });
});

$('#btnAddress').on('click', ()=> {
    if ($('#address').val()!='') {
        $('#btnAddress').attr('disabled', true);
        $.ajax({
            url: $('#URL').val()+'updateAddress',
            method: 'post',
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                location_id: $('#location').val(),
                address: $('#address').val(),
                postal_code: $('#postal_code').val(),
                latitude: $('#latitude').val(),
                longitude: $('#longitude').val()
            },
            success: (res)=> {
                if(res.status=='saved') {
                    $('#btnAddress').attr('disabled', false);
                    Swal.fire({
                        title: 'Datos guardados correctamente',
                        icon: 'success'
                    });
                } else {
                    $('#btnAddress').attr('disabled', false);
                    Swal.fire({
                        title: 'Lo sentimos ocurrio un error',
                        icon: 'error'
                    });
                }
            },
            error: ()=> {
                $('#btnAddress').attr('disabled', false);
                Swal.fire({
                    title: 'Lo sentimos ocurrio un error',
                    icon: 'error'
                });
            }
        });
    } else {
        Swal.fire({
            title: 'Complete la dirección de su empresa',
            icon: 'error'
        });
    }
});