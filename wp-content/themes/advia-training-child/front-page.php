<?php
remove_all_actions('genesis_sidebar');
remove_all_actions('genesis_sidebar_alt');
add_action('genesis_after_header','msd_child_hero');
remove_action('genesis_before_footer','genesis_footer_widget_areas');
add_action('genesis_before_footer','msd_child_homepage_widgets');
add_action('genesis_before_footer','genesis_footer_widget_areas');

function msd_child_hero(){
	if(is_active_sidebar('homepage-top')){
		print '<div id="hp-top">';
		print '<div class="wrap">';
		dynamic_sidebar('homepage-top');
		print '</div>';
		print '<div class="wrap2">';
		do_action( 'genesis_site_description' );
		print '</div>';
		print '</div>';
	}
}
	
function msd_child_homepage_widgets(){
	?>
	<div id="hp-bot">
		<div class="wrap">
			<div id="widgets-one" class="widget-area"><div class="wrap"><div class="wrap">
	<?php dynamic_sidebar('homepage-one'); ?>
		</div></div></div>
		<div id="widgets-two" class="widget-area"><div class="wrap"><div class="wrap">
	<?php dynamic_sidebar('homepage-two'); ?>
		</div></div></div>
		<div id="widgets-three" class="widget-area"><div class="wrap"><div class="wrap">
	<?php dynamic_sidebar('homepage-three'); ?>
		</div></div></div>
	</div>
	</div>
	<?php 
}
genesis();