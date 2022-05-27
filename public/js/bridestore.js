$('#categories').on('change', ()=> {
    $.ajax({
        dataType: 'json',
        url: $('#URL').val()+'filterPromotions',
        method: 'post',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            category_id: $('#categories').val()
        },
        success: (res)=> {
            var cards = '';
            for (var i = 0; i < res.promotions.length; i++) {
                cards += '<a class="col-lg-3 mb-3" href="'+$('#URL').val()+'promocion/'+res.promotions[i].id+'">';
                    cards += '<div class="card w-100 card-promotions">';
                        cards += '<img src="'+$('#URL').val()+'media/promotions/'+res.promotions[i].id+'/'+res.promotions[i].gallery[0].name+'" class="card-img-top card-img-top-promotions">';
                            cards += '<div class="card-body text-center">';
                            cards += '<h4 class="card-title mb-2"><b>'+res.promotions[i].provider.user.name+'</b></h4>';
                        cards += '<hr class="w-50 border-hr-promotions mt-0">';
                        cards +='<h5 class="card-text mb-1 line text-gray">$'+res.promotions[i].price_initial+'MXN</h5>';
                        cards +='<h4 class="card-text text-dark">$'+res.promotions[i].price_final+'MXN</h4>';
                        // cards += '<p class="size-card-promotion">*Oferta válida solo a través de BrideAdvisor</p>';
                        cards += '<h5 class="text-pink-500 mt-2">Ver promoción</h5>';
                        cards += '</div>';
                    cards += '</div>';
                cards += '</a>';
            }
            document.getElementById('divPromotions').innerHTML = cards;
        },
        error: ()=> {
            console.log('ERROR');
        }
    });
});