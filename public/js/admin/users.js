$(document).ready(()=> {
    loadUsers();
});

function loadUsers() {
    $('#usersTable').dataTable().fnDestroy();
    var table = $('#usersTable').DataTable({
        "serverSide": true,
        "ajax":{  
            url: $('#URL').val()+'extractUsers',
        },
        "columns": [
            {data: 'id'},
            {data: 'name'},
            {data: 'email'},
            {
                "targets": 3,  
                "render": function (data, type, row, meta) {
                    if(row.role_id==2) {
                        return '<p>Proveedor</p>';
                    } else if(row.role_id==3) {
                        return '<p>Novio/a</p>';
                    } else {
                        return '<p>Administrador</p>';
                    }
                }
            },
            {  
                "targets": 4,  
                "render": function (data, type, row, meta){
                    return '<button type="button" class="btn bg-blue text-white" onClick="openModal('+row["id"]+',`'+row["name"]+'`,`'+row["email"]+'`,`'+row["name"]+'`'+')">EDITAR</button>';
                }
            },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
    });
}

function openModal(id, name, user) {
    $('#modalId').val(id);
    $('#modalName').val(name);
    $('#modalUser').val(user);
    $('#modalPassword').val('');
    $('#modalCPassword').val('');
    $('#exampleModal').modal('show');
}

$('#formUser').submit((e)=> {
    e.preventDefault();
    $('#saveUser').attr('disabled', true);
    $.ajax({
        url: $('#URL').val()+'updateUser',
        method: 'post',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            user_id: $('#modalId').val(),
            name: $('#modalName').val(),
            user: $('#modalUser').val(),
            password: $('#modalPassword').val(),
            c_password: $('#modalCPassword').val()
        },
        success: (res)=> {
            if(res.status=='saved') {
                loadUsers();
                $('#exampleModal').modal('hide')
                Swal.fire({
                    title: 'Datos guardados correctamente',
                    icon: 'success'
                });
                $('#saveUser').attr('disabled', false);
            } else if(res.status=='invalid') {
                Swal.fire({
                    title: 'Las contraseñas no coinciden',
                    icon: 'error'
                });
                $('#saveUser').attr('disabled', false);
            } else {
                Swal.fire({
                    title: 'Lo sentimos ocurrio un error',
                    icon: 'error'
                });
                $('#saveUser').attr('disabled', false);
            }
        },
        error: ()=> {
            Swal.fire({
                title: 'Lo sentimos ocurrio un error',
                icon: 'error'
            });
            $('#saveUser').attr('disabled', false);
        }
    });
});