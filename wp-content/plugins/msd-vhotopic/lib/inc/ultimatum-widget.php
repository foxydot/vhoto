<?php
class UltimatumContestDisplay extends WP_Widget {

	function UltimatumContestDisplay() {
        parent::WP_Widget(false, $name = 'Ultimatum Contest Display');
    }

	function widget($args, $instance) {
		global $msd_contest,$posts;
		extract( $args );
		if($instance['key']=='query'){
			print $msd_contest->form_class->display_grid($posts,$instance['cols']);
		} else {
			$msd_contest->form_class->print_photos_by($instance);
		}
    }

	function update( $new_instance, $old_instance ) {
		$instance['display'] = strip_tags( stripslashes($new_instance['display']) );
		$instance['key'] = strip_tags( stripslashes($new_instance['key']) );
		$instance['value'] = strip_tags( stripslashes($new_instance['value']) );
		$instance['cols'] = strip_tags( stripslashes($new_instance['cols']) );
        return $instance;
    }
	function form($instance) {
        $display = esc_attr($instance['display']);
        $key = esc_attr($instance['key']);
        $value = esc_attr($instance['value']);
        $cols = esc_attr($instance['cols']);
        ?>
        <p><label for="<?php echo $this->get_field_id('display'); ?>"><?php _e('Display', THEME_ADMIN_LANG_DOMAIN); ?></label>
        <select id="<?php echo $this->get_field_id('display'); ?>" name="<?php echo $this->get_field_name('display'); ?>" class="widefat">
        	<option value="grid"<?php selected($display,'grid',FALSE); ?>>Grid</option>
         	<option value="list"<?php selected($display,'list',FALSE); ?>>List</option>
        </select>
		</p>
        <p><label for="<?php echo $this->get_field_id('key'); ?>"><?php _e('Key', THEME_ADMIN_LANG_DOMAIN); ?></label>
		<select id="<?php echo $this->get_field_id('key'); ?>" name="<?php echo $this->get_field_name('key'); ?>" class="widefat">
        	<option value="query"<?php selected($key,'query',FALSE); ?>>Use main query</option>
        	<option value="contest"<?php selected($key,'contest',FALSE); ?>>Contest</option>
         	<option value="category"<?php selected($key,'category',FALSE); ?>>Category</option>
         	<option value="votes"<?php selected($key,'votes',FALSE); ?>>Votes</option>
        </select>		
        </p>
        <p><label for="<?php echo $this->get_field_id('value'); ?>"><?php _e('Value', THEME_ADMIN_LANG_DOMAIN); ?></label>
		<input id="<?php echo $this->get_field_id('value'); ?>" name="<?php echo $this->get_field_name('value'); ?>" type="text" value="<?php echo $value; ?>" class="widefat" />
		</p>
        <p><label for="<?php echo $this->get_field_id('cols'); ?>"><?php _e('Columns', THEME_ADMIN_LANG_DOMAIN); ?></label>
		<input id="<?php echo $this->get_field_id('cols'); ?>" name="<?php echo $this->get_field_name('cols'); ?>" type="text" value="<?php echo $cols; ?>" class="small" />
		</p>
        <p>
		<?php 
    }

}
add_action('widgets_init', create_function('', 'return register_widget("UltimatumContestDisplay");'));
?>