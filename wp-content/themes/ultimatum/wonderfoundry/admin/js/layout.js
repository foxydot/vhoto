var ultimatum = {
	
	uploaderInit : function(){
		jQuery('.option-upload-button').each(function(){
			
		});	
	},

	getImage : function(attachment_id,target){
		jQuery.post(ajaxurl, {
			action:'theme-option-get-image',
			id: attachment_id, 
			cookie: encodeURIComponent(document.cookie)
		}, function(src){
			if ( src == '0' ) {
				alert( 'Could not use this image. Try a different attachment.' );
			} else {
				if(jQuery("#"+target).size()>0){
					jQuery("#"+target).val(src);
					jQuery("#"+target+"_preview").html('<a class="thickbox" href="'+src+'?"><img src="'+src+'"/></a>');
				}
			}
		});
	},
	getImageByAttachmentId : function(attachment_id,target){
		jQuery.post(ajaxurl, {
			action:'theme-option-get-image-by-attachment-id',
			id: attachment_id, 
			cookie: encodeURIComponent(document.cookie)
		}, function(data){
			if ( data == '0' ) {
				alert( 'Could not use this image. Try a different attachment.' );
			} else {
				var data = jQuery.parseJSON(data);
				imagewidth = jQuery('#'+target+'_preview').attr('data-imagewidth');
				if(data.width<imagewidth){
					imagewidth = data.width;
				}

				if(jQuery("#"+target).size()>0){
					jQuery("#"+target).val(data.src);
					jQuery("#"+target+"_preview").html('<a class="thickbox" href="'+data.src+'?"><img  width="'+imagewidth+'" src="'+data.src+'"/></a>');
				}
			}
		});
	},

	getImageByUrl : function(src,title,target){
		jQuery.post(ajaxurl, {
			action:'theme-option-get-image-by-url',
			src: src, 
			cookie: encodeURIComponent(document.cookie)
		}, function(data){
			if ( data == '0' ) {
				alert( 'Could not use this image. Try a different attachment.' );
			} else {
				var data = jQuery.parseJSON(data);
				imagewidth = jQuery('#'+target+'_preview').attr('data-imagewidth');

				if(jQuery("#"+target).size()>0){
					if(title != ''){
						jQuery("#"+target).val('{"type":"url","title":"'+title+'","value":"'+src+'"}');
					}else{
						jQuery("#"+target).val('{"type":"url","value":"'+src+'"}');
					}
					
					jQuery("#"+target+"_preview").html('<a class="thickbox" href="'+src+'?"><img  width="'+imagewidth+'" src="'+src+'"/></a>');
				}
			}
		});
	}
	
	
	
}
function updadePattern(value,target){
	jQuery("#"+target).val(value);
	jQuery("#"+target+"_preview").html('<div style="width:150px;height:150px;background-image:url('+value+');"></div>');
}

jQuery(document).ready(function() {
	jQuery(':checkbox').iphoneStyle();
    ultimatum.uploaderInit();
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
    			if(colorSelector=='#body-bgcolor'){
    				jQuery('#body_preview').css('backgroundColor', '#' + hex);
    			}
    			if(colorSelector=='#BgColor'){
    				jQuery('#bgImage_upload_preview').css('backgroundColor', '#' + hex);
    			}
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
