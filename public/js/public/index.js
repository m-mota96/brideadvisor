$('.carousel').carousel({
    interval: 7000,
});

$( "#input-search" ).autocomplete({
    source: $('#URL').val()+'autocompleteProviders',
    select: (event, ui) => {
        val = ui.item;
        $('#type').val(val.type);
    }
});

// $('#formSearch').submit(function(e) {
//     e.preventDefault();

// });