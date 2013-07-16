<?php
class UltimatumLogo extends WP_Widget {

	function UltimatumLogo() {
        parent::WP_Widget(false, $name = 'Ultimatum Logo');
    }

    function widget($args, $instance) {
       $options = get_option(THEME_SLUG.'_general');
      //print_r($options);
       echo '<div id="logo-container">';
       if($options['text_logo']!=0 && !$instance["logoimage"]){
       if($instance["logotext"]){
       		echo '<h1><a id="logo" class="logo" href="'.get_bloginfo('url').'">'.$instance["logotext"].'</a></h1>';
       } else {
       		echo '<h1><a id="logo" class="logo" href="'.get_bloginfo('url').'">'.get_bloginfo().'</a></h1>';
       }
       if($options["display_site_desc"]){
       		if($instance["logotag"]){ 
       			echo '<span id="tagline">'.$instance["logotag"].'</span>';
       		} else {
       			echo '<span id="tagline">'.get_bloginfo ( 'description' ).'</span>';
       		} 
       }
       	
       //
       } else {
       		if($instance["logoimage"]){
       			$logo_src=$instance["logoimage"];
       		} else {
       			$logo_src=$options["logo"];
       		}
       		echo '<h1><a href="'.get_bloginfo('url').'" class="logo"><img src="'.$logo_src.'" /></a></h1>';
       }
       echo '</div>';
    }

function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['logotext'] = $new_instance['logotext'];
	$instance['logotag'] = $new_instance['logotag'];
	$instance['logoimage'] = $new_instance['logoimage'];
        return $instance;
    }
function form($instance) {
        $title = esc_attr($instance['title']);
        $logotext 	= isset( $instance['logotext'] ) ? $instance['logotext'] : '';
        $logotag 	= isset( $instance['logotag'] ) ? $instance['logotag'] : '';
        $logoimage 	= isset( $instance['logoimage'] ) ? $instance['logoimage'] : '';
        ?>
        <p><i>Leave Below Empty to use default Settings</i></p>
        <p>
        	<label for="<?php echo $this->get_field_id('logotext'); ?>"><?php _e('Logo Text', THEME_ADMIN_LANG_DOMAIN); ?></label>
			<input id="<?php echo $this->get_field_id('logotext'); ?>" name="<?php echo $this->get_field_name('logotext'); ?>" type="text" value="<?php echo $logotext; ?>" class="widefat" />
		</p>
		<p>
       		<label for="<?php echo $this->get_field_id('logotag'); ?>"><?php _e('Logo Tag', THEME_ADMIN_LANG_DOMAIN); ?></label>
			<input id="<?php echo $this->get_field_id('logotag'); ?>" name="<?php echo $this->get_field_name('logotag'); ?>" type="text" value="<?php echo $logotag; ?>" class="widefat" />
		</p>
		<p>
       		<label for="<?php echo $this->get_field_id('logoimage'); ?>"><?php _e('Logo Image', THEME_ADMIN_LANG_DOMAIN); ?></label><i> Full URL to image</i>
			<input id="<?php echo $this->get_field_id('logoimage'); ?>" name="<?php echo $this->get_field_name('logoimage'); ?>" type="text" value="<?php echo $logoimage; ?>" class="widefat" />
		</p>
		<?php 
    }

}
add_action('widgets_init', create_function('', 'return register_widget("UltimatumLogo");'));
?>