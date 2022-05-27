$(document).ready(()=> {
    loadProviders();
});

$('#events').on('change', ()=> {
    loadProviders();
});

function loadProviders() {
    $('#providersTable').dataTable().fnDestroy();
    var table = $('#providersTable').DataTable({
        "serverSide": true,
        "ajax":{  
            url: $('#URL').val()+'extractProvidersAssigned',
            data: {
                event_id: $('#events').val()
            }
        },
        "columns": [
            {data: 'id'},
            {data: 'user.name'},
            {
                "targets": 2,  
                "render": function (data, type, row, meta) {
                    if($('#events').val()!='' && $('#events').val()!=null) {
                        var band = 0, band2 = 0, quantity = 0;
                        for(var i=0; i < row.event.length; i++) {
                            if(row.event[i].id==$('#events').val()) {
                                band = 1;
                                if(row.event[i].pivot.quantity_staff>0) {
                                    band2 = 1;
                                    quantity = row.event[i].pivot.quantity_staff;
                                }
                            }
                        }
                        if(band==1 && band2==0) {
                            option = '<span class="btn btn-primary" onclick="addQuantity('+$('#events').val()+', '+row.id+')">Agregar cantidad</span>';
                        } else {
                            option = '<span class="btn bg-orange text-white" onclick="addQuantity('+$('#events').val()+', '+row.id+', '+quantity+')">Añadir mas espacios</span>';
                        }
                    } else {
                        option = '<span><b>Elija un evento</b></span>';
                    }
                    return option;
                }
            },
            {
                "targets": 3,  
                "render": function (data, type, row, meta) {
                    if($('#events').val()!='' && $('#events').val()!=null) {
                        var band = 0, band2 = 0, quantity = 0;
                        var email = null;
                        for(var i=0; i < row.event.length; i++) {
                            if(row.event[i].id==$('#events').val()) {
                                band = 1;
                                if(row.event[i].pivot.staff_completed>0) {
                                    band2 = 1;
                                    email = row.event[i].pivot.email;
                                }
                            }
                        }
                        if(band==1 && band2==1) {
                            option = '<span class="btn btn-primary" onclick="sendMail('+$('#events').val()+', '+row.id+', `'+email+'`)">Enviar Correo</span>';
                        } else {
                            option = '<span class="text-orange"><b>Asigne una cantidad de staff</b></span>';
                        }
                    } else {
                        option = '<span><b>Elija un evento</b></span>';
                    }
                    return option;
                }
            },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
    });
}

function addQuantity(event_id, provider_id, quantityCurrent=null) {
    if(quantityCurrent==null) {
        var txt = 'Ingrese la cantidad de personal:';
    } else {
        var txt = `Ingrese la cantidad extra \n(actual ${quantityCurrent}):`;
    }
    Swal.fire({
        title: txt,
        input: 'number',
        inputAttributes: {
        autocapitalize: 'off'
    },
    confirmButtonText: 'Guardar',
    showCancelButton: true,
    cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.value) {
            if(result.value>0) {
                if(quantityCurrent==null) {
                    var sum = parseInt(result.value);
                } else {
                    var sum = parseInt(result.value) + parseInt(quantityCurrent)
                }
                saveStaff(event_id, provider_id, sum);
            } else {
                Swal.fire({
                    title: 'La cantidad ingresada debe ser mayor que 0',
                });
            }
        }
    });
}

function saveStaff(event_id, provider_id, quantity) {
    $.ajax({
        dataType: 'json',
        url: $('#URL').val()+'updateQuantityStaff',
        method: 'post',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            event_id: event_id,
            provider_id: provider_id,
            quantity: quantity
        },
        success: (res)=> {
            loadProviders();
        },
        error: ()=> {
            Swal.fire({
                title: 'Lo sentimos, ocurrio un error',
                icon: 'error'
            });
        }
    });
}

function sendMail(event_id, provider_id, email) {
    if(email!='null') {
        var txt = 'EL link se enviara al siguiente correo:';
    } else {
        var txt = 'Ingrese el correo para enviar el link:';
        email = null;
    }
    Swal.fire({
        title: txt,
        input: 'email',
        confirmButtonText: 'Enviar',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        inputValue: email
    }).then((result) => {
        if (result.value) {
            $.ajax({
                dataType: 'json',
                url: $('#URL').val()+'sendLinkStaff',
                method: 'post',
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    event_id: event_id,
                    provider_id: provider_id,
                    email: result.value,
                },
                success: (res)=> {
                    loadProviders();
                },
                error: ()=> {
                    Swal.fire({
                        title: 'Lo sentimos, ocurrio un error',
                        icon: 'error'
                    });
                }
            })
        }
    });
}