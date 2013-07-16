<?php
class UltimatumCore extends WP_Widget {

	function UltimatumCore() {
        parent::WP_Widget(false, $name = 'Ultimatum Cat/Taxonomy Definiton');
    }

	function widget($args, $instance) {
		extract( $args );
		$instance[width]=$grid_width;
	
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	        		    if($term){  
	        			echo '<h2>' . $term->name . '</h2>';
	        			echo '<div class="tax-desc">' . do_shortcode($term->description). '</div>';
	        		    }  	
		
    }

	function update( $new_instance, $old_instance ) {
		
    }
	function form($instance) {
		?>
		<i>
		<?php _e('Include this in category or taxonomy pages so it will show the information you have inserted in the category or taxonomy',THEME_ADMIN_LANG_DOMAIN);?>
		</i>
		<?php 
    }

}
add_action('widgets_init', create_function('', 'return register_widget("UltimatumCore");'));
?>