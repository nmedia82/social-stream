jQuery(document).ready(function($) {
	$('.social-settings a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	})	
});