$(document).ready( ()=> {
    $('.slider').slider();
    $('#selectCity').on('change', function() {
        document.location.href = $('#URL').val()+'brideweekend/ciudad/'+$('#selectCity').val();
    });
});