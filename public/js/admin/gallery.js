$('.btn-delete').on('click', function() {
    $.ajax({
        dataType: 'json',
        url: $('#URL').val()+'deleteGalleryProvider',
        method: 'post',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            id: this.id,
            type: 'image'
        },
        success: (res)=> {
            if(res.status='deleted') {
                $('#cardImage'+this.id).remove();
            }
        },
        error: ()=> {

        }
    })
});