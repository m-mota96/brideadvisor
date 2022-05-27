var array_categories;
$(document).ready(()=> {
    $.ajax({
        dataType: 'json',
        url: $('#URL').val()+'extractCategories',
        method: 'get',
        async: false,
        success: (res)=> {
            array_categories = res.categories;
        },
        error: ()=> {
            
        }
    });
    loadProviders();
});

$('#btncreate').on('click', function() {
    $('#createProvider').modal('show');
});

function loadProviders() {
    $('#providersTable').dataTable().fnDestroy();
    var table = $('#providersTable').DataTable({
        "serverSide": true,
        "lengthMenu": [[100, 50, 10, -1], [100, 50, 10, "All"]],
        "ajax":{  
            url: $('#URL').val()+'extractProviders',
        },
        "columns": [
            {data: 'id'},
            {data: 'user.name'},
            // {data: 'category.name'},
            {
                "targets": 2,  
                "render": function (data, type, row, meta) {
                    var string = '<select class="selects-table" data-type="category">';
                        for (var i = 0; i < array_categories.length; i++) {
                            string += '<option value="'+array_categories[i].id+'">'+array_categories[i].name+'</option>';
                        }
                    string += '</select>';
                    $select = $(string);
                    $select.find('option[value="'+row.category_id+'"]').attr('selected', 'selected');
                    return $select[0].outerHTML;
                }
            },
            {
                "targets": 3,  
                "render": function (data, type, row, meta) {
                    $select = $('<select class="selects-table" data-type="activation"><option value="0">Inactivo</option><option value="1">Activo</option></select>');
                    $select.find('option[value="'+row.user.active+'"]').attr('selected', 'selected');
                    return $select[0].outerHTML;
                }
            },
            {
                "targets": 4,  
                "render": function (data, type, row, meta) {
                    var option = '<span class="btn bg-green-400 text-white" onclick="openModalNewCity('+row.id+')">Administrar</span>';
                    return option;
                }
            },
            {
                "targets": 5,  
                "render": function (data, type, row, meta) {
                    var option = '<a class="btn bg-purple text-white" href="'+$('#URL').val()+'admin/galeria/'+row.id+'" target="_blank">Ver</a>';
                    return option;
                }
            },
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
    });
    $('#providersTable tbody').on( 'change', 'select', function (e) {
        var data = table.row( $(this).parents('tr') ).data();
        var options = $(this).find('option:selected').val();
        if(data && options) {
            if($(this).attr('data-type')=='activation') {
                $.ajax({
                    dataType: 'json',
                    method: 'post',
                    url: $('#URL').val()+'updateStatusUser',
                    data: {
                        "_token": $("meta[name='csrf-token']").attr("content"),
                        user_id: data.id,
                        status: options,
                    },
                    success: () => {

                    },
                    error: () => {
                        Swal.fire({
                            title: 'Lo sentimos, ocurrio un error',
                            icon: 'error'
                        });
                    }
                });
            } else {
                $.ajax({
                    dataType: 'json',
                    method: 'post',
                    url: $('#URL').val()+'updateCategory',
                    data: {
                        "_token": $("meta[name='csrf-token']").attr("content"),
                        provider_id: data.id,
                        category_id: options,
                    },
                    success: () => {

                    },
                    error: () => {
                        Swal.fire({
                            title: 'Lo sentimos, ocurrio un error',
                            icon: 'error'
                        });
                    }
                });
            }
        }
    });
}

function openModalNewCity(provider_id) {
    $('.form-control').val('');
    $('#newCityProviderId').val(provider_id),
    $('#newCityModal').modal('show');
}

$('#newCitySelectCity').on('change', ()=> {
    $.ajax({
        dataType: 'json',
        url: $('#URL').val()+'extractCity',
        method: 'get',
        data: {
            provider_id: $('#newCityProviderId').val(),
            city_id: $('#newCitySelectCity').val()
        },
        success: (res)=> {
            if(res.location!=null) {
                $('#newCityAddress').val(res.location.address);
                $('#newCityPostalCode').val(res.location.postal_code);
                $('#newCityContact').val(res.location.name_contact);
                $('#newCityEmail').val(res.location.email_contact);
                $('#newCityPhone').val(res.location.phone);
                $('#newCityCellPhone').val(res.location.cellphone);
                $('#newCityWebSite').val(res.location.website);
            } else {
                $('#newCityAddress').val('');
                $('#newCityPostalCode').val('');
                $('#newCityContact').val('');
                $('#newCityEmail').val('');
                $('#newCityPhone').val('');
                $('#newCityCellPhone').val('');
                $('#newCityWebSite').val('');
            }
        },
        error: ()=> {
            Swal.fire({
                title: 'Lo sentimos, ocurrio un error',
                icon: 'error'
            });
        }
    })
});

$('#formNewCity').submit(function(e) {
    e.preventDefault();
    $.ajax({
        dataType: 'json',
        url: $('#URL').val()+'saveNewCity',
        method: 'post',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            provider_id: $('#newCityProviderId').val(),
            city_id: $('#newCitySelectCity').val(),
            address: $('#newCityAddress').val(),
            postal_code: $('#newCityPostalCode').val(),
            contact: $('#newCityContact').val(),
            email: $('#newCityEmail').val(),
            phone: $('#newCityPhone').val(),
            cellphone: $('#newCityCellPhone').val(),
            website: $('#newCityWebSite').val(),
        },
        success: (res)=> {
            if(res.status=='success') {
                $('#newCityModal').modal('hide');
                $('.form-control').val('');
                Swal.fire({
                    title: 'Datos guardados con éxito',
                    icon: 'success'
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
});

$('#formProvider').submit(function(e) {
    e.preventDefault();
    if($('#modalPassword').val()==$('#modalCPassword').val()) {
        $.ajax({
            dataType: 'json',
            url: $('#URL').val()+'createProvider',
            method: 'post',
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                name: $('#modalName').val(),
                category: $('#category').val(),
                description: $('#description').val(),
                user: $('#modalUser').val(),
                password: $('#modalPassword').val(),
                city: $('#selectCity').val(),
                address: $('#address').val(),
                postal_code: $('#postalCode').val(),
                contact: $('#contact').val(),
                phone: $('#phone').val(),
                cellphone: $('#cellphone').val(),
                email: $('#email').val()
            },
            success: (res)=> {
                if(res.status=='user_duplicate') {
                    Swal.fire({
                        title: 'El nombre de usuario ya existe',
                        icon: 'warning'
                    });
                } else if(res.status=='success') {
                    $('.form-control').val('');
                    $('#createProvider').modal('hide');
                    Swal.fire({
                        title: 'Datos guardados con éxito',
                        icon: 'success'
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
    } else {
        Swal.fire({
            title: 'Las contraseñas no coinciden',
            icon: 'error'
        });
    }
});