<?php
class UltimatumBcumb extends WP_Widget {

	function UltimatumBcumb() {
        parent::WP_Widget(false, $name = 'Ultimatum BreadCrumbs');
    }

    function widget($args, $instance) {
      breadcrumbs_plus();
    }

function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
function form($instance) {
        $title = esc_attr($instance['title']);
    }

}
add_action('widgets_init', create_function('', 'return register_widget("UltimatumBcumb");'));
?>