$(document).ready(()=> {
    var form = document.getElementById('form_subir');
	form.addEventListener("submit", (event)=> {
        event.preventDefault();
        var formulario = this;
        $('#btnVideo').attr('disabled', true);
        $.ajax({
            dataType: 'json',
            url: $('#URL').val()+'checkVideo',
            method: 'post',
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
            },
            success: (response)=> {
                if(response.status=='ok') {
                    subir_archivos(formulario);
                } else {
                    Swal.fire({
                        title: 'Solo puede cargar un video',
                        icon: 'warning'
                    });
                    $('#btnVideo').attr('disabled', false);
                }
            },
            error: ()=> {
                Swal.fire({
                    title: 'Lo sentimos ocurrio un error',
                    icon: 'error'
                });
                $('#btnVideo').attr('disabled', false);
            },
        });
	});
});

function subir_archivos(form) {
    var input = document.getElementById('archivo');
    var file = input.files[0];

    if(file.size<524288000) {
        var archivo = $('#archivo').val();
        var extensiones = archivo.substring(archivo.lastIndexOf("."));
        if(extensiones=='.mp4') {
            var peticion = new XMLHttpRequest();

            peticion.upload.addEventListener("progress", (event) => {
                var porcentaje = Math.round((event.loaded / event.total) * 100);
                $('.progress-bar').css('width', porcentaje+'%');
                $('#progress').text(porcentaje+'%');
            });

            peticion.addEventListener("load", () => {
                $('.progress-bar').removeClass('bg-info');
                $('.progress-bar').addClass('bg-success');
            });

            peticion.open('POST', '../uploadVideo');
            peticion.send(new FormData(document.getElementById('form_subir')));

            peticion.onreadystatechange = (res)=> {
                if(peticion.status==200) {
                    Swal.fire({
                        title: 'Su archivo se cargó con éxito',
                        icon: 'success'
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                    $('#btnVideo').attr('disabled', false);
                }
            };
        } else {
            Swal.fire({
                title: 'El archivo debe estar en formato MP4',
                icon: 'warning'
            });
            $('#btnVideo').attr('disabled', false);
        }
    } else {
        Swal.fire({
            title: 'El archivo debe pesar menos de 500 Mb',
            icon: 'warning'
        });
        $('#btnVideo').attr('disabled', false);
    }
}