$(document).ready(()=> {
    var arr = $('[name="checks"]:checked').map(function(){
        return this.value;
    }).get();
    days = arr.join(',');
});

var ban = false;
var addresses = [];
$('#formPromotions').submit(function(e) {
    e.preventDefault();
    if(ban==true) {
        for (var i = 0; i < idAddress-1; i++) {
            addresses[i] = $('#address'+(i+1)).val()+'/';
        }
        var dropzone = Dropzone.forElement(".upload");
        dropzone.processQueue();
    } else {
        Swal.fire({
            title: 'Debe cargar al menos una imágen',
            icon: 'warning'
        });
    }
});

var days = '';
$('[name="checks"]').click(function() {
    var arr = $('[name="checks"]:checked').map(function(){
        return this.value;
    }).get();
    days = arr.join(',');
});

var idAddress = 2;
$('#moreAddress').on('click', ()=> {
    var input = '<input class="form-control mb-2" type="text" id="address'+idAddress+'" placeholder="Ingrese una dirección" required>';
    idAddress++;
    document.getElementById('divAddress').innerHTML += input;
});

$('#saveSchedules').on('click', ()=> {
    if(days!='' && $('#initialTime').val()!='' && $('#finalTime').val()!='') {
        $.ajax({
            dataType: 'json',
            url: $('#URL').val()+'saveSchedules',
            method: 'post',
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                days: days,
                initial_time: $('#initialTime').val(),
                final_time: $('#finalTime').val()
            },
            success: (res)=> {
                Swal.fire({
                    title: 'Días y horarios guardados con éxito',
                    icon: 'success'
                });
            },
            error: ()=> {
                Swal.fire({
                    title: 'Lo sentimos, ocurrio un error',
                    icon: 'error'
                });
            }
        })
    } else {
        Swal.fire({
            title: "Debe tener por lo menos 1 día de atención y marcar sus horarios",
            icon: "error",
        });
    }
});

var myDropzone = '';
$('#upload').dropzone({
    url: $('#URL').val()+'createPromotion',
    method: 'post',
    paramName: 'files', // The name that will be used to transfer the file
    maxFilesize: 7, // MB
    uploadMultiple: true,
    createImageThumbnails: false,
    acceptedFiles: 'image/*',
    autoProcessQueue: false,
    dataType: 'json',
    accept: function(file, done) {
        done();
        $('.dz-success-mark').hide();
        $('.dz-error-mark').hide();
        ban = true;
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
            formData.append('name', $('#name').val());
            formData.append('category_id', $('#category').val());
            formData.append('price_initial', $('#price_initial').val());
            formData.append('price_final', $('#price_final').val());
            formData.append('date', $('#date').val());
            formData.append('description', $('#description').val());
            formData.append('addresses', addresses);
        });
        this.on('success', function(file, response) {
            $('.form-control').val('');
            myDropzone.removeFile(file);
            ban = false;
            Swal.fire({
                title: 'Su promoción se creo correctamente',
                icon: 'success'
            });
            // var options = '';
            // options = '<div class="col-lg-3 mb-3" id="cardImage'+response.data.id+'">';
            //     options += '<div class="card">';
            //         options += '<div class="card-image text-center">';
            //             options += '<a class="fancybox" href="'+$('#URL').val()+'/media/providers/'+response.name+'/'+response.data.name_image+'" data-fancybox-group="gallery">';
            //             options += '<img class="w-100 gallery_provider" src="'+$('#URL').val()+'media/providers/'+response.name+'/'+response.data.name_image+'">';
            //             options += '</a>';
            //             options += '<i class="fas fa-times text-danger deleteImg mt-2" onclick="deleteImage('+response.data.id+', `image`);"></i>';
            //         options += '</div>';
            //     options += '</div>';
            // options += '</div>';
            // document.getElementById('images').innerHTML += options;
            // myDropzone.removeFile(file);
            // $('.fancybox').fancybox();
        });
    },
});