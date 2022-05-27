Conekta.setPublicKey("key_DbNsWQRkxnUzTSJLdCrnDxQ");
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
    // var calendarEl = document.getElementById('calendar');
    // var calendar = new FullCalendar.Calendar(calendarEl, {
    //     initialView: 'dayGridMonth',
    //     locale: 'es',
    // });
    // calendar.render();
});

$('#formPromotions').submit((e)=> {
    e.preventDefault();
    var $form = $('#formPromotions');
    Conekta.Token.create($form, conektaSuccessReponseHandler, conektaErrorReponseHandler);
});

$('#selectDates').on('change', ()=> {
    $.ajax({
        datatype: 'json',
        url: $('#URL').val()+'checkSchedules',
        method: 'post',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            date: $('#selectDates').val(),
            provider_id: $('#provider_id').val(),
        },
        success: (res)=> {
            var options = '<option value="" selected disabled>Seleccione la hora</option>';
            for (var i = 0; i < res.data.length; i++) {
                options += '<option value="'+res.data[i]+'">'+res.data[i]+'</option>';
            }
            document.getElementById('selectSchedules').innerHTML = options;
            // Swal.fire({
            //     title: 'Su cita fue generada con éxito \n recibirá un correo con su cupón canjeable por $1,000.00MXN',
            //     icon: 'success'
            // });
        },
        error: ()=> {
            Swal.fire({
                title: 'Lo sentimos ocurrio un error',
                icon: 'error'
            });
        }
    });
});

var conektaSuccessReponseHandler = function(token) {
    $('#conektaTokenId').val(token.id);
    Swal.fire({
        title: "¡Atención!",
        text: "Tus cupón de descuento se enviará a: "+$('#emailSchedules').val()+" ¿Es correcta esta información?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            var msgAlert = 'Procesando pago, no cierre ni actualice esta página. Por favor espere!!';
            var msgSuccess = 'Su pago se realizó con éxito, recibirá un correo electrónico con su cupon canjeable';
            jsPay(msgAlert, msgSuccess);
        }
    });
};

var conektaErrorReponseHandler = function(response) {
    Swal.fire({
        title: response.message_to_purchaser,
        icon: 'error'
    });
};

function jsPay(msgAlert, msgSuccess) {
    jsShowWindowLoad(msgAlert);
    
    $.ajax({
        dataType: 'json',
        url: $('#URL').val()+'makePayment',
        method: 'post',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            conektaTokenId: $('#conektaTokenId').val(),
            name: $('#nameSchedules').val(),
            email: $('#emailSchedules').val(),
            card: $('#card').val(),
            phone: $('#phone').val(),
            date: $('#selectDates').val(),
            hour: $('#selectSchedules').val(),
            provider_id: $('#provider_id').val(),
            promotion_id: $('#promotion_id').val(),
            address: $('#selectAddresses').val()
        },
        success: function(response) {
            if(response.status=='success') {
                jsRemoveWindowLoad();
                Swal.fire({
                    title: msgSuccess,
                    icon: 'success'
                });
                setTimeout(function(){
                    location.reload();
                },2000);
            } else {
                jsRemoveWindowLoad();
                Swal.fire({
                    title: response.error, 
                    icon: 'error'
                });
            }
        },
        error: function() {
            Swal.fire({
                title: 'Lo sentimos ocurrio un error. Si el problema persiste intente con otro navegador',
                icon: 'error',
            });
            jsRemoveWindowLoad();
        },
    });
}