$(document).ready(()=> {
    $('.tabs').tabs();
});

$('.title-tabs').on('click', function() {
    $('.title-tabs').removeClass('btnSpecial');
    var id = $(this).attr('id');
    $('#'+id).addClass('btnSpecial');
});