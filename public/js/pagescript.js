jQuery(document).ready(function($) {
	// $('[data-toggle="tooltip"]').tooltip();
	// mixItUp function
	$('#sortable-columns').mixItUp({
        activeClass: 'on',
        callbacks: { 
            onMixStart: function(state){
                $('#sortable-columns').masonry('destroy');
            },
            onMixEnd: function(state){
                $('#sortable-columns').masonry();
            },
        }
	});
});