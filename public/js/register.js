$(document).ready(function () {
    $( "#startButton" ).click(function() {
        $('.stepwizard-step').show();
    });

    $('.stepwizard-step').hide();
    let navListItems = $('div.setup-panel div a'), // tab nav items
        allWells = $('.setup-content'), // content div
        allNextBtn = $('.nextBtn'); // next button

    allWells.hide(); // hide all contents by defauld
    $('#step-1').show();

    navListItems.click(function (e) {
        e.preventDefault();
        let $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-circle-selected').addClass('btn-circle-not-selected');
            $item.addClass('btn-circle-selected');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });
    // next button
    allNextBtn.click(function(){
        let curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='email'],input[type='password'],input[type='url']"),
            isValid = true;
        // Validation

            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
});
