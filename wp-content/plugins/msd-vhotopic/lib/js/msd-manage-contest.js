jQuery(function($) {
	$('.contest_management div.tabs').tabs();
	$('.contest_management input.date').datepicker();
	$('.delete-btn').click(function(){
		var form = $(this).parents('form');
		var post_name = form.find('input[name="contest_name"]').val();
		var $yes = confirm('Are you sure you want to delete '+post_name+'? This cannot be undone!');
		if($yes){
			$(this).siblings('input[name="msd_manage_contest"]').val('delete');
			form.submit();
		}
	});
});

function edit_contest(id){
	jQuery('.info_panel').show();
	jQuery('.info_panel_'+id).hide();
	jQuery('.edit_panel').hide();
	jQuery('.edit_panel_'+id).show();
}