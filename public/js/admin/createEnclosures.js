$(document).ready(()=> {
    loadEvents();
});

$('#btnCreate').on('click', ()=> {
    $('#modalCreateEnclosure').modal('show');
});

function loadEvents() {
    $('#enclosuresTable').dataTable().fnDestroy();
    var table = $('#enclosuresTable').DataTable({
        "serverSide": true,
        "ajax":{  
            url: $('#URL').val()+'extractEnclosures',
        },
        "columns": [
            {data: 'id'},
            {data: 'name'},
            {data: 'address'},
            {data: 'description'},
            {
                "targets": 3,  
                "render": function (data, type, row, meta) {
                    option = '<p class="btn btn-danger" onclick="deleteEnclosure(`'+row.id+'`)">Eliminar</p>';
                    return option;
                }
            },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
    });
}

function deleteEnclosure(id) {
    Swal.fire({
        title: 'Atención',
        text: "¿Esta seguro de eliminar este recinto?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                dataType: 'json',
                url: $('#URL').val()+'deleteEnclosure',
                method: 'POST',
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    id: id,
                },
                success: (res)=> {
                    if(res.status=='deleted') {
                        loadEvents();
                        Swal.fire({
                            title: 'Recinto eliminado correctamente',
                            icon: 'success'
                        });
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
    });
}