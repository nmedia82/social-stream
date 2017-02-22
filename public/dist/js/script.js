jQuery(document).ready(function($) {
	$('.social-settings a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	});

	$('.rich-editor').wysihtml5();

	$('.nmcolorSelector').ColorPicker({
		color: '#0000ff',
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('.nmcolorSelector div').css('backgroundColor', '#' + hex);
		}
	});	
});