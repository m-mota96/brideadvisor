$(document).ready(()=> {
    loadEvents();
});

$('#btnCreate').on('click', ()=> {
    $('#modalCreateEvent').modal('show');
});

$('#selectType').on('change', ()=> {
    if($('#selectType option:selected').text()=='brideweekend' || $('#selectType option:selected').text()=='carrera') {
        var file = '<label>Imágen de boletera: </label>';
        file += '<input class="mb-4" type="file" name="imageTickets" accept=".png, .jpg">';
        document.getElementById('treeColumn').innerHTML += file;
    }
});

function loadEvents() {
    $('#eventsTable').dataTable().fnDestroy();
    var table = $('#eventsTable').DataTable({
        "serverSide": true,
        "order": [[ 3, "asc" ]],
        "ajax":{  
            url: $('#URL').val()+'extractEvents',
        },
        "columns": [
            {data: 'id'},
            {data: 'name'},
            {data: 'initial_date', "visible": false},
            {
                "targets": 3,  
                "render": function (data, type, row, meta) {
                    if(row.initial_date!=null) {
                        fecha = new Date(row.initial_date.replace(/-/g, '\/'));
                        var options = { year: 'numeric', month: 'long', day: 'numeric' };
                        var date = fecha.toLocaleDateString("es-ES", options);
                    } else {
                        date = 'Fecha por definir';
                    }
                    return '<span>'+date+'</span>';
                }
            },
            {
                "targets": 4,  
                "render": function (data, type, row, meta) {
                    if(row.final_date!=null) {
                        fecha = new Date(row.final_date.replace(/-/g, '\/'));
                        var options = { year: 'numeric', month: 'long', day: 'numeric' };
                        var date = fecha.toLocaleDateString("es-ES", options);
                    } else if(row.initial_date!=null) {
                        fecha = new Date(row.initial_date.replace(/-/g, '\/'));
                        var options = { year: 'numeric', month: 'long', day: 'numeric' };
                        var date = fecha.toLocaleDateString("es-ES", options);
                    } else {
                        date = 'Fecha por definir';
                    }
                    return '<span>'+date+'</span>';
                }
            },
            {
                "targets": 5,
                // "width": "30%",
                "render": (data, type, row, meta) => {
                    $select = $('<select class="form-control"><option value="0">Inactivo</option><option value="1">Activo</option></select>');
                    $select.find('option[value="'+row.active+'"]').attr('selected', 'selected');
                    return $select[0].outerHTML;
                }
            },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
    });
    $('#eventsTable tbody').on( 'change', 'select', function (e) {
        var data = table.row( $(this).parents('tr') ).data();
        var options = $(this).find('option:selected').val();
        // let tableIndice = this.id;
        if(data && options) {
            $.ajax({
                dataType: 'json',
                method: 'post',
                url: $('#URL').val()+'updateStatusEvent',
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    id: data.id,
                    status: options,
                },
                success: () => {

                },
                error: () => {
                    console.log('error');
                }
            });
        }
    });
}