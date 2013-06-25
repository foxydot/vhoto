<?php
class UltimatumPcontent extends WP_Widget {

	function UltimatumPcontent() {
        parent::WP_Widget(false, $name = 'Ultimatum Include Page');
    }

	function widget($args, $instance) {
		extract( $args );
		$instance["width"]=$grid_width;
		global $wp_filter;
		$the_content_filter_backup = $wp_filter['the_content'];
		if($instance["paje"]){
		$query = array(
			'page_id' => (int)$instance["paje"]
			);
		$r = new WP_Query($query);
		echo $before_widget;
			if ( $instance['title'])
				echo $before_title . $instance['title'] . $after_title;
		?>
		<?php 
		if ($r->have_posts()):
			while ($r->have_posts()) : $r->the_post();
			global $post;
			$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large') ;
			if ($img){
				$imgsrc = UltimatumImageResizer( get_post_thumbnail_id(), null,$instance["width"], $instance["height"], true );
			   	}
			if($img && $instance['image']=='btitle'){
				echo '<img src="'.$imgsrc.'" />';
			}
			if($instance["titl"]=='true'){
			echo '<h3 class="element-title">';
			the_title();
			echo '</h3>';
			}
			if($img && $instance['image']=='atitle'){
				echo '<img src="'.$imgsrc.'" />';
			}
			the_content();
			endwhile;
		endif;
		echo $after_widget;
		wp_reset_postdata();
		}
		$wp_filter['the_content'] = $the_content_filter_backup;
 		
    }

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['paje'] = strip_tags( stripslashes($new_instance['paje']) );
		$instance['image'] = strip_tags( stripslashes($new_instance['image']) );
		$instance['height'] = strip_tags( stripslashes($new_instance['height']) );
		$instance['titl'] = strip_tags( stripslashes($new_instance['titl']) );
        return $instance;
    }
	function form($instance) {
        $title = esc_attr($instance['title']);
        $paje = esc_attr($instance['paje']);
        $image = isset( $instance['image'] ) ?  $instance['image'] : 'false';
        $height= isset( $instance['height'] ) ?  $instance['height'] : '100';
        $titl = isset( $instance['titl'] ) ?  $instance['titl'] : 'true';
        ?>
        <p><i><?php _e('This will show the content of the page selected in a Position',THEME_ADMIN_LANG_DOMAIN)?></i></p>
        <p>
		<label for="<?php echo $this->get_field_id('paje'); ?>"><?php _e('Select a Page:',THEME_ADMIN_LANG_DOMAIN) ?></label>
			<select name="<?php echo $this->get_field_name('paje'); ?>" id="<?php echo $this->get_field_id('paje'); ?>"> 
	 			<option value=""><?php echo esc_attr( __( 'Select page' ) ); ?></option> 
				 <?php 
				  $pages = get_pages(); 
				  foreach ( $pages as $pagg ) {
				  	$option = '<option value="'. ( $pagg->ID ).'" '.selected($paje,$pagg->ID,false).'>';
					$option .= $pagg->post_title;
					$option .= '</option>';
					echo $option;
				  }
				 ?>
			</select>
		</p>
		<label for="<?php echo $this->get_field_id('titl'); ?>"><?php _e('Page Title',THEME_ADMIN_LANG_DOMAIN) ?></label>
			<select name="<?php echo $this->get_field_name('titl'); ?>" id="<?php echo $this->get_field_id('titl'); ?>"> 
	 			<option value="false" <?php selected($titl,'false')?>>OFF</option> 
				<option value="true" <?php selected($titl,'true')?>>ON</option>
			</select>
		</p>
		<label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Featured Image',THEME_ADMIN_LANG_DOMAIN) ?></label>
			<select name="<?php echo $this->get_field_name('image'); ?>" id="<?php echo $this->get_field_id('image'); ?>"> 
	 			<option value="false" <?php selected($image,'false')?>><?php echo esc_attr( __( 'OFF',THEME_ADMIN_LANG_DOMAIN ) ); ?></option> 
				<option value="atitle" <?php selected($image,'atitle')?>><?php echo esc_attr( __( 'After Title',THEME_ADMIN_LANG_DOMAIN ) ); ?></option>
				<option value="btitle" <?php selected($image,'btitle')?>><?php echo esc_attr( __( 'Before Title',THEME_ADMIN_LANG_DOMAIN ) ); ?></option>
			</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Image Height:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<input name="<?php echo $this->get_field_name('height'); ?>" id="<?php echo $this->get_field_id('height'); ?>" value="<?php echo $height;?>"/>
		</p>
		<?php 
    }

}
add_action('widgets_init', create_function('', 'return register_widget("UltimatumPcontent");'));
?>