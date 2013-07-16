<?php

class UltimatumSubNav extends WP_Widget {

	function UltimatumSubNav() {
		 parent::WP_Widget(false, $name = 'Ultimatum Subpages Navigation');
	}

	function widget( $args, $instance ) {
		extract( $args );
        global $post;
        $page_id = ( function_exists('icl_object_id') && function_exists('icl_get_default_language') ) ? icl_object_id($post->ID, 'page', true, icl_get_default_language()) : $post->ID;
		$curr_page_id = get_post( $page_id, ARRAY_A );
		$curr_page_title = $curr_page_id['post_title'];
		$curr_page_parent = $post->post_parent;
		$title = apply_filters('widget_title', $instance['title'] );
		if( $curr_page_parent )
		    $children = wp_list_pages("title_li=&sort_column=menu_order&child_of=".$curr_page_parent."&echo=0");
		else
		    $children = wp_list_pages("title_li=&sort_column=menu_order&child_of=".$page_id."&echo=0");
		if ( $children ) :
		    echo $before_widget;
		    if ( $title ) :
			    echo $before_title . $title . $after_title;
		    else : ?>
			    <h3><?php $parent = get_post($post->post_parent); echo $parent->post_title; ?></h3>
			<?php
			endif;
			?>
		    <ul>
			<?php		
			echo $children;
			?>
		    </ul>
			<?php
		    echo $after_widget;
		endif; 
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( in_array( $new_instance['sortby'], array( 'post_title', 'menu_order', 'ID' ) ) ) {
			$instance['sortby'] = $new_instance['sortby'];
		} else {
			$instance['sortby'] = 'menu_order';
		}

		$instance['exclude'] = strip_tags( $new_instance['exclude'] );

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'sortby' => 'menu_order', 'title' => '', 'exclude' => '') );
		$title = esc_attr( $instance['title'] );
		$exclude = esc_attr( $instance['exclude'] );
	?>
		
<p><?php _e('Shows the sub pages related to the current page',THEME_ADMIN_LANG_DOMAIN);?></p>
<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("UltimatumSubNav");'));