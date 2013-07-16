jQuery(document).ready(function() {
	jQuery('.cPicker').each(function() {
    	var colorSelector = '#'+jQuery(this).attr('id');
    	addColorPicker(colorSelector);
    });
    function addColorPicker(colorSelector) {
       	jQuery(colorSelector+' div').ColorPicker({
    		color: '#'+jQuery(colorSelector+' div div').css('background-color'),
    		onShow: function (colpkr) {
    			jQuery(colpkr).fadeIn(500);
    			return false;
    		},
    		onHide: function (colpkr) {
    			jQuery(colpkr).fadeOut(500);
    			return false;
    		},
    		onChange: function (hsb, hex, rgb) {
    			jQuery(colorSelector+' div div').css('backgroundColor', '#' + hex);
    			jQuery(colorSelector+' input').val(hex);
    		},
    		onSubmit: function(hsb, hex, rgb, el,inputField) {
    			jQuery(el).val(hex);
    			jQuery(el).ColorPickerHide();
    		}
    	});
        }
    
    
});