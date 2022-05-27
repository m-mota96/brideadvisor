$(document).ready(function() {
    $('.jcarousel-categories').slick({
        infinite: false,
        slidesToShow: 7,
        slidesToScroll: 1,
        // speed: 300,
        arrows: true,
        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-left flecha" aria-hidden="true"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right flecha" aria-hidden="true"></i></button>',
        // autoplay: true,
        lazyLoad: 'ondemand',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true
                },
            },
        ],
    });
});

$( "#input-search" ).autocomplete({
    source: $('#URL').val()+'autocompleteProviders',
    select: (event, ui) => {
        val = ui.item;
        $('#typeSearch').val(val.type);
        search(val.value, val.type);
    }
});

$('.categories').on('click', function() {
    $('#nameCategory').val($(this).attr('data-name'));
    filterCategory($(this).attr('id'), $('#selectCity').val(), $(this).attr('data-name'));
});

$('#selectCity').on('change', ()=> {
    if($( "#input-search" ).val()=='') {
        filterCategory($('#category').val(), $('#selectCity').val(), $('#nameCategory').val());
    } else {
        search($( "#input-search" ).val(), $('#typeSearch').val());
    }
});

function search(value, type) {
    $.ajax({
        dataType: 'json',
        url: $('#URL').val()+'searchWord',
        method: 'post',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            type: type,
            value, value,
            city_id: $('#selectCity').val()
        },
        success: (res)=> {
            if(type=='provider') {
                redirectTo(res.data);
            } else {
                var content = '';
                for (var i = 0; i < res.providers.length; i++) {
                    content += '<a class="col-lg-3 mb-4" href="'+$('#URL').val()+'proveedor/'+res.providers[i].slug+'">';
                        content += '<div class="card card-home-providers">';
                            content += '<img class="round-img-home" src="'+$('#URL').val()+'media/providers/'+res.providers[i].user.name+'/'+res.providers[i].profile.name_image+'" class="card-img-top">';
                                content += '<div class="card-body pl-0 pr-0 text-center bg-gray-200 content-card-provider">';
                                if(res.providers[i].user.name.length>18) {
                                    content += '<h5 class="card-title text-dark">'+res.providers[i].user.name.substr(0, 18)+'...</h5>';
                                } else {
                                    content += '<h5 class="card-title text-dark">'+res.providers[i].user.name+'</h5>';
                                }
                                content += '<h6 class="card-text text-pink-300">'+res.providers[i].category.name+'</h6>';
                            content += '</div>';
                        content += '</div>';
                    content += '</a>';
                }
                if(type=='category') {
                    var filters = '<div class="col-lg-12 text-center mb-4"><h1 class="w-100 text-center mb-2">Filtrando por:</h1>';
                    filters += '<span class="sizefilters">Categoría: &nbsp;</span><span class="badge badge-pill bg-gray-200 text-gray p-2 pointer" onclick="deleteCategory()">'+value+' &nbsp;&nbsp;<i class="fas fa-times"></i></span></div>';
                    content = filters + content;
                }
                document.getElementById('content').innerHTML = content;
            }
        },
        error: ()=> {
            console.log('ERROR');
        }
    });
}

function filterCategory(category_id=null, city_id=null, name_category=null) {
    $('#category').val(category_id);
    $.ajax({
        dataType: 'json',
        url: $('#URL').val()+'filterForCategory',
        method: 'POST',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            category_id: category_id,
            city_id: city_id
        },
        success: (res)=> {
            var content = '';
            for (var i = 0; i < res.providers.length; i++) {
                content += '<a class="col-lg-3 mb-4" href="'+$('#URL').val()+'proveedor/'+res.providers[i].slug+'">';
                    content += '<div class="card card-home-providers">';
                        content += '<img class="round-img-home" src="'+$('#URL').val()+'media/providers/'+res.providers[i].user.name+'/'+res.providers[i].profile.name_image+'" class="card-img-top">';
                            content += '<div class="card-body pl-0 pr-0 text-center bg-gray-200 content-card-provider">';
                            if(res.providers[i].user.name.length>18) {
                                content += '<h5 class="card-title text-dark">'+res.providers[i].user.name.substr(0, 18)+'...</h5>';
                            } else {
                                content += '<h5 class="card-title text-dark">'+res.providers[i].user.name+'</h5>';
                            }
                            content += '<h6 class="card-text text-pink-300">'+res.providers[i].category.name+'</h6>';
                        content += '</div>';
                    content += '</div>';
                content += '</a>';
            }
            if(category_id!='' && city_id!='') {
                var filters = '<div class="col-lg-12 text-center mb-4"><h1 class="w-100 text-center mb-2">Filtrando por:</h1>';
                filters += '<span class="sizefilters">Categoría: &nbsp;</span><span class="badge badge-pill bg-gray-200 text-gray p-2 pointer" onclick="deleteCategory()">'+name_category+' &nbsp;&nbsp;<i class="fas fa-times"></i></span> &nbsp;&nbsp;&nbsp;&nbsp;';
                filters += '<span class="sizefilters">Ciudad: &nbsp;</span><span class="badge badge-pill bg-gray-200 text-gray p-2 pointer" onclick="deleteCity()">'+$('#selectCity option:selected').text()+' &nbsp;&nbsp;<i class="fas fa-times"></i></span></div>';
            } else if(city_id!='') {
                var filters = '<div class="col-lg-12 text-center mb-4"><h1 class="w-100 text-center mb-2">Filtrando por:</h1>';
                filters += '<span class="sizefilters">Ciudad: &nbsp;</span><span class="badge badge-pill bg-gray-200 text-gray p-2 pointer" onclick="deleteCity()">'+$('#selectCity option:selected').text()+' &nbsp;&nbsp;<i class="fas fa-times"></i></span></div>';
            } else if(category_id!='') {
                var filters = '<div class="col-lg-12 text-center mb-4"><h1 class="w-100 text-center mb-2">Filtrando por:</h1>';
                filters += '<span class="sizefilters">Categoría: &nbsp;</span><span class="badge badge-pill bg-gray-200 text-gray p-2 pointer" onclick="deleteCategory()">'+name_category+' &nbsp;&nbsp;<i class="fas fa-times"></i></span></div>';
            } else {
                var filters = '<h1 class="w-100 text-center mb-4">Proveedores destacados</h1>';
            }
            content = filters + content;
            document.getElementById('content').innerHTML = content;
        },
        error: ()=> {
            console.log('ERROR');
        }
    });
}

function deleteCategory() {
    $('#category').val('');
    $('#nameCategory').val('');
    filterCategory($('#category').val(), $('#selectCity').val(), $('#nameCategory').val());
}

function deleteCity() {
    $('#selectCity').val('');
    filterCategory($('#category').val(), $('#selectCity').val(), $('#nameCategory').val());
}

function redirectTo(slug) {
    location.href = $('#URL').val()+'proveedor/'+slug;
}