jQuery(document).ready(function($) {
	// $('[data-toggle="tooltip"]').tooltip();
	// mixItUp function
    $('.fa-googleplus').addClass('fa-google-plus');
    var div = $("#sortable-columns .mix").toArray();

    if (g2squidData.orderby == 'random') {
        //randomly print them back out.
        while(div.length > 0) {
            var idx = Math.floor((Math.random() * (div.length-1)));
            var element = div.splice(idx, 1);
            $('#sortable-columns').append(element[0]);
        }

    } else if (g2squidData.orderby == 'desc_date') {
        var divList = $(".mix");
        divList.sort(function(a, b){
            return $(b).find('.nmtime').data("time") + $(a).find('.nmtime').data("time");
        });
        $("#sortable-columns").html(divList);
    } else {
        var divList = $(".mix");
        divList.sort(function(a, b){
            return $(b).find('.nmtime').data("time") - $(a).find('.nmtime').data("time");
        });
        $("#sortable-columns").html(divList);        
    }



    $('#sortable-columns').isotope({
        // options
        itemSelector: '.mix',
        sortBy: 'category',
        masonry: {
            columnWidth: '.mix'
        }
    });

    $('.btn-group button').click(function(event) {
        event.preventDefault();

        var selector = $(this).data('filter');

        $('#sortable-columns').isotope({
            filter: selector,
            masonry: {
                columnWidth: '.mix'
            }            
        });
    });
});