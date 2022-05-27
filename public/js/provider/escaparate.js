$(document).ready(()=> {
    // $('.dropdown-menu').dropdown('show');
});

// $('#btnCredentials').on('click', ()=> {
//     $('#btnCredentials').attr('disabled', true);
//     if($('#password').val()!='' && $('#newpassword').val()!='' && $('#passwordconfirm').val()!='') {
//         $.ajax({
//             url: $('#URL').val()+'checkPassword',
//             method: 'post',
//             data: {
//                 "_token": $("meta[name='csrf-token']").attr("content"),
//                 password: $('#password').val(),
//                 idUser: $('#idUser').val(),
//             },
//             success: (response)=> {
//                 if(response.status=='match') {
//                     if($('#newpassword').val()==$('#passwordconfirm').val()) {
//                         updateCredentials();
//                     } else {
//                         Swal.fire({
//                             title: 'Las contraseñas no coinciden',
//                             icon: 'error'
//                         });
//                         $('#btnCredentials').attr('disabled', false);
//                     }
//                 } else {
//                     Swal.fire({
//                         title: 'La contraseña actual no coincide',
//                         icon: 'error',
//                     });
//                     $('#btnCredentials').attr('disabled', false);
//                 }
//             },
//             error: ()=> {
//                 Swal.fire({
//                     title: 'Lo sentimos ocurrio un error',
//                     icon: 'error'
//                 });
//                 $('#btnCredentials').attr('disabled', false);
//             },
//         });
//     } else {
//         updateCredentials();
//     }
// });

$('#formCompany').on('submit', (e)=> {
    e.preventDefault();
    $.ajax({
        url: $('#URL').val()+'updateInfo',
        method: 'post',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            name_company: $('#nameCompany').val(),
            description_company: $('#descriptionCompany').val(),
            category: $('#category').val()
        },
        success: (res)=> {
            if(res.status=='saved') {
                Swal.fire({
                    title: 'Datos guardados correctamente',
                    icon: 'success'
                });
            } else {
                Swal.fire({
                    title: 'Lo sentimos ocurrio un error',
                    icon: 'error'
                });
            }
        },
        error: ()=> {
            Swal.fire({
                title: 'Lo sentimos ocurrio un error',
                icon: 'error'
            });
        }
    });
});

// $('#btnPrice').on('click', ()=> {
//     if($('#price_min').val()!='' && $('#price_max').val()!='') {
//         $.ajax({
//             url: $('#URL').val()+'updatePrices',
//             method: 'post',
//             data: {
//                 "_token": $("meta[name='csrf-token']").attr("content"),
//                 provider_id: $('#provider_id').val(),
//                 price_min: $('#price_min').val(),
//                 price_max: $('#price_max').val(),
//             },
//             success: (res)=> {
//                 if(res.status=='saved') {
//                     Swal.fire({
//                         title: 'Datos guardados correctamente',
//                         icon: 'success'
//                     });
//                 } else {
//                     Swal.fire({
//                         title: 'Lo sentimos ocurrio un error',
//                         icon: 'error'
//                     });
//                 }
//             },
//             error: ()=> {
//                 Swal.fire({
//                     title: 'Lo sentimos ocurrio un error',
//                     icon: 'error'
//                 });
//             }
//         });
//     } else {
//         Swal.fire({
//             title: 'Debe completar ambos campos',
//             icon: 'warning'
//         });
//     }
// });

$('#locations').on('change', ()=> {
    $('#btnContact').attr('disabled', true);
    $.ajax({
        url: $('#URL').val()+'extractLocation',
        method: 'get',
        data: {
            location_id: $('#locations').val()
        },
        success: (res)=> {
            $('#btnContact').attr('disabled', false);
            $('#name_contact').val(res.location.name_contact);
            $('#email_contact').val(res.location.email_contact);
            $('#phone').val(res.location.phone);
            $('#cellphone').val(res.location.cellphone);
            $('#website').val(res.location.website);
        },
        error: ()=> {
            Swal.fire({
                title: 'Lo sentimos ocurrio un error',
                icon: 'error'
            });
            $('#btnContact').attr('disabled', false);
        }
    });
});

$('#btnContact').on('click', ()=> {
    $('#btnContact').attr('disabled', true);
    $.ajax({
        url: $('#URL').val()+'updateContact',
        method: 'post',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            location_id: $('#locations').val(),
            name_contact: $('#name_contact') .val(),
            email_contact: $('#email_contact') .val(),
            phone: $('#phone') .val(),
            cellphone: $('#cellphone') .val(),
            website: $('#website') .val(),
        },
        success: (res)=> {
            if(res.status=='saved') {
                $('#btnContact').attr('disabled', false);
                Swal.fire({
                    title: 'Datos guardados correctamente',
                    icon: 'success'
                });
            } else {
                $('#btnContact').attr('disabled', false);
                Swal.fire({
                    title: 'Lo sentimos ocurrio un error',
                    icon: 'error'
                });
            }
        },
        error: ()=> {
            $('#btnContact').attr('disabled', false);
            Swal.fire({
                title: 'Lo sentimos ocurrio un error',
                icon: 'error'
            });
        }
    });
});

// $('#btnCategory').on('click', ()=> {
//     $.ajax({
//         url: $('#URL').val()+'updateCategory',
//         method: 'post',
//         data: {
//             "_token": $("meta[name='csrf-token']").attr("content"),
//             idCategory: $('#category').val()
//         },
//         success: (res)=> {
//             if(res.status=='saved') {
//                 Swal.fire({
//                     title: 'Datos guardados correctamente',
//                     icon: 'success'
//                 });
//             } else {
//                 Swal.fire({
//                     title: 'Lo sentimos ocurrio un error',
//                     icon: 'error'
//                 });
//             }
//         },
//         error: ()=> {
//             Swal.fire({
//                 title: 'Lo sentimos ocurrio un error',
//                 icon: 'error'
//             });
//         }
//     });
// });

// function updateCredentials() {
//     $.ajax({
//         url: $('#URL').val()+'updateCredentials',
//         method: 'post',
//         data: {
//             "_token": $("meta[name='csrf-token']").attr("content"),
//             user: $('#user').val(),
//             password: $('#newpassword').val(),
//         },
//         success: (response)=> {
//             if(response.status=='saved') {
//                 $('#password').val('');
//                 $('#newpassword').val('');
//                 $('#passwordconfirm').val('');
//                 Swal.fire({
//                     title: 'Datos guardados correctamente',
//                     icon: 'success'
//                 });
//                 $('#btnCredentials').attr('disabled', false);
//             } else {
//                 Swal.fire({
//                     title: 'Lo sentimos ocurrio un error',
//                     icon: 'error'
//                 });
//                 $('#btnCredentials').attr('disabled', false);
//             }
//         },
//         error: ()=> {
//             Swal.fire({
//                 title: 'Lo sentimos ocurrio un error',
//                 icon: 'error'
//             });
//             $('#btnCredentials').attr('disabled', false);
//         }
//     });
// }