jQuery(function($) {
	$('.contest_management div.tabs').tabs();
	$('.contest_management input.date').datepicker();
});

function edit_contest(id){
	jQuery('.info_panel').show();
	jQuery('.info_panel_'+id).hide();
	jQuery('.edit_panel').hide();
	jQuery('.edit_panel_'+id).show();
}