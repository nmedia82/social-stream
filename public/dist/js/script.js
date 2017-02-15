jQuery(document).ready(function($) {
	$('.social-settings a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	});

	$('.rich-editor').wysihtml5();

	$('.colorpicker').colorPicker();
});