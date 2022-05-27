var myDropzone = '';
$(document).ready(()=> {
    $('.fancybox').fancybox();
    // $('.show').on('click', function() {
    //     var id = $(this).attr("data-id");
    //     $('#options'+id).slideToggle('slow');
    // });
    // $('.card-reveal .close').on('click', function() {
    //     var id = $(this).attr("data-id");
    //     $('#options'+id).slideToggle('slow');
    // });
});
$('#upload').dropzone({
    url: $('#URL').val()+'uploadImages',
    method: 'post',
    paramName: 'files', // The name that will be used to transfer the file
    maxFilesize: 7, // MB
    uploadMultiple: true,
    createImageThumbnails: false,
    acceptedFiles: 'image/*',
    // autoProcessQueue: false,
    dataType: 'json',
    accept: function(file, done) {
        done();
    },
    success:function (file) {
        
    },
    error: function(data, xhr) {
        
    },
    init: function() {
        // var submitButton = document.querySelector("#save");
        myDropzone = this;
        // submitButton.addEventListener("click", function() {
        //     myDropzone.processQueue();
        // });
        this.on("sending", function(file, xhr, formData) {
            formData.append("_token", $("meta[name='csrf-token']").attr("content"));
        });
        this.on('success', function(file, response) {
            Swal.fire({
                title: 'Archivos cargados correctamente',
                icon: 'success'
            });
            var options = '';
            options = '<div class="col-lg-3 mb-3" id="cardImage'+response.data.id+'">';
                options += '<div class="card">';
                    options += '<div class="card-image text-center">';
                        options += '<a class="fancybox" href="'+$('#URL').val()+'/media/providers/'+response.name+'/'+response.data.name_image+'" data-fancybox-group="gallery">';
                        options += '<img class="w-100 gallery_provider" src="'+$('#URL').val()+'media/providers/'+response.name+'/'+response.data.name_image+'">';
                        options += '</a>';
                        options += '<i class="fas fa-times text-danger deleteImg mt-2" onclick="deleteImage('+response.data.id+', `image`);"></i>';
                    options += '</div>';
                options += '</div>';
            options += '</div>';
            document.getElementById('images').innerHTML += options;
            myDropzone.removeFile(file);
            $('.fancybox').fancybox();
        });
    },
});

function deleteImage(id, type) {
    if(type=='image') {
        var txt = 'esta imagen?';
    } else if(type=='video') {
        var txt = 'este video?';
    }
    Swal.fire({
        title: 'Atención',
        text: "¿Esta seguro de eliminar "+txt,
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
                url: $('#URL').val()+'deleteGalleryProvider',
                method: 'post',
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    id: id,
                    type: type
                },
                success: (res)=> {
                    if(res.status='deleted') {
                        if(type=='image') {
                            $('#cardImage'+id).remove();
                        } else if(type=='video') {
                            $('#videoProvider').remove();
                            $('#deleteVideo').remove();
                        }
                    }
                },
                error: ()=> {
                    Swal.fire({
                        title: 'Lo sentimos ocurrio un error',
                        icon: 'error'
                    });
                }
            });
        }
    });
}

$('.form-check-input').on('click', function() {
    var txt = '';
    if($(this).attr('name')=='profile') {
        txt = 'foto de perfil';
    } else if($(this).attr('name')=='logotype') {
        txt = 'logotipo';
    }
    $.ajax({
        dataType: 'json',
        url: $('#URL').val()+'profileOrLogotype',
        method: 'post',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            id: $(this).val(),
            type: $(this).attr('name')
        },
        success: (res)=> {
            if(res.status='saved') {
                Swal.fire({
                    title: 'Establecida como '+txt,
                    icon: 'success'
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