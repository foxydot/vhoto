<?php
class UltimatumStitle extends WP_Widget {

	function UltimatumStitle() {
        parent::WP_Widget(false, $name = 'Ultimatum Super Title');
    }

	function widget($args, $instance) {
		extract( $args );
		echo '<h1 class="super-title">';
		if($instance["title"]){
			echo $instance["title"];	
		} else {
			
		echo strip_tags(wp_title('',false,'left'));
		}
		echo '</h1>';
    }

	function update( $new_instance, $old_instance ) {
		$instance['title'] = ( stripslashes($new_instance['title']) );
		$instance['style'] = strip_tags( stripslashes($new_instance['style']) );
        return $instance;
    }
	function form($instance) {
        $title = esc_attr($instance['title']);
        $style = esc_attr($instance['style']);
        ?>
        <i><?php _e('Fill in the Title or leave blank to have default WordPress Ttile',THEME_ADMIN_LANG_DOMAIN); ?></i>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', THEME_ADMIN_LANG_DOMAIN); ?></label>
		<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" class="widefat" />
		</p>
        <p>
		<?php 
    }

}
add_action('widgets_init', create_function('', 'return register_widget("UltimatumStitle");'));
?>