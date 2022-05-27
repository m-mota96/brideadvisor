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
            url: $('#URL').val()+'extractProviders',
        },
        "columns": [
            {data: 'id'},
            {data: 'user.name'},
            {data: 'category.name'},
            {
                "targets": 3,  
                "render": function (data, type, row, meta) {
                    if($('#events').val()!='' && $('#events').val()!=null) {
                        var band = 0;
                        for(var i=0; i < row.event.length; i++) {
                            if(row.event[i].id==$('#events').val()) {
                                band = 1;
                            }
                        }
                        if(band==0) {
                            option = '<span class="btn btn-primary" onclick="assignEvent('+$('#events').val()+', '+row.id+')">'+$('#events option:selected').text()+'</span>';
                        } else {
                            option = '<span class="text-orange"><b>Ya asignado</b></span>';
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

function assignEvent(event_id, provider_id) {
    $.ajax({
        dataType: 'json',
        url: $('#URL').val()+'assignProviderToEvent',
        method: 'post',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            event_id: event_id,
            provider_id: provider_id
        },
        success: (res)=> {
            if(res.status=='assigned') {
                loadProviders();
            } else {
                Swal.fire({
                    title: 'Lo sentimos, ocurrio un error',
                    icon: 'error'
                });
            }
        },
        error: ()=> {
            Swal.fire({
                title: 'Lo sentimos, ocurrio un error',
                icon: 'error'
            });
        }
    });
}