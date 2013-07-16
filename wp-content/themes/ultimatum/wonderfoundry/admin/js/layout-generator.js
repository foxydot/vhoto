var LayoutGetRow,themeGalleryImagesSetIds;
(function($){
LayoutSetRowIds = function(){
	var ids = jQuery('#sortables').sortable('toArray').toString();
	jQuery('#layout_row_ids').val(ids);
}
LayoutSetRowIds2 = function(){
	var ids = jQuery('#sortables').sortable('toArray').toString();
	jQuery('#layout_row_ids').val(ids);
	jQuery("#layout-form").submit();
}
LayoutSetBefore = function(){
	var ids = jQuery('#before').sortable('toArray').toString();
	jQuery('#before_main').val(ids);
}
LayoutSetAfter = function(){
	var ids = jQuery('#after').sortable('toArray').toString();
	jQuery('#after_main').val(ids);
}

LayoutDeleteRow = function(attachment_id){
	jQuery("#row-"+ attachment_id).remove();
	LayoutSetRowIds();
};

LayoutGetRow = function(layoutid,rowstyle){
	jQuery.post(ajaxurl, {
		action:'ultimatum-get-row',
		id: layoutid,
		style:rowstyle,
		cookie: encodeURIComponent(document.cookie)
	}, function(str){
		if ( str == '0' ) {
			alert( 'ERROR' );
		} else {
			jQuery("#sortables").append(str);
			LayoutSetRowIds2();
			}
	});
	
};
})(jQuery);
jQuery(document).ready( function() {

	jQuery("#sortables").sortable({
		opacity: 0.6,
		handle: '.drag',
		placeholder: 'ui-state-highlight',
		stop: function(event, ui) {
			LayoutSetRowIds();
		}
	});
	jQuery("#parts ,#before ,#after").sortable({
		connectWith:".connectedSortable",
		opacity: 0.6,
		placeholder: 'ui-state-highlight',
		stop: function(event, ui) {
			LayoutSetBefore();
			LayoutSetAfter();
		}
	});
	jQuery('.delete-item',"#sortables").live('click', function(){
		var where_to= confirm("Do you really want to delete this row?");
		 if (where_to== true)
		 {
			 var id = jQuery(this).parents('.rowsoflayout').attr('id').slice(4);
			LayoutDeleteRow(id);
		 } else {
		 }
	})
});