// init Isotope
var $grid = jQuery('.grid').isotope({
    itemSelector: '.element-item',
    layoutMode: 'fitRows'
});

// filter items on button click
jQuery('#filters li').click(function(){
    var filterValue = jQuery( this ).attr('data-filter');
    $grid.isotope({ filter: filterValue });
});