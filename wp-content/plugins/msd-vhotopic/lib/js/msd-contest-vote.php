<?php require_once( dirname(__FILE__) . '../../../../../../wp-load.php' );?>
jQuery(document).ready(function($) {	
	$('.vote-button').click(function(){
		var entry = $(this).parents('.entry-item');
		var vote_id = $(this).attr('id');
		//do ajax call to post the vote to the correct post id AND blog id.
		$.post('<?php print plugins_url('/vote.php', dirname(__FILE__)); ?>',{'action':'vote','vote_id':vote_id}, function(data) {
				var data_array = data.split('|');
				if(data_array[0]>0){
					  entry.find('.total_votes').html(data_array[0]);
					  entry.find('.vote-button').html('VOTE ADDED!').removeClass('vote-button').css('cursor','default');
				} 
			});
		//reload the page for now.
	});
});