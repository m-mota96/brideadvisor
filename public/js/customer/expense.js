// A $( document ).ready() block.
$( document ).ready(function() {
    $('.info').hide();
    $( "#amount" ).keyup(function() {
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            data:{
                //  id:id,
                amount:$('#amount').val(),
            },
            url:'/saveBudget',
            success:function(data){
                console.log(data);
                //  $('.budget').html('<b>$'+data+'<b>');
            },
        });
    });
    $('.gasto').click(function(){
        let id = $(this).children('.id').val();
        let info = $('.info'+id);
        if(info.is(":visible") === false){
            info.show();
        }else{
            info.hide();
        }

    });

    function saveExpense() {

    }
    function deleteExpense() {

    }
});
