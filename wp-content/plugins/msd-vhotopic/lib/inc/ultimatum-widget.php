<?php
class UltimatumContestDisplay extends WP_Widget {

	function UltimatumContestDisplay() {
        parent::WP_Widget(false, $name = 'Ultimatum Contest Display');
    }

	function widget($args, $instance) {
		global $msd_contest,$post,$posts;
		extract( $args );
		if(is_single()){
			while ( have_posts() ) : the_post(); 
			$social_sharing_toolkit = new MR_Social_Sharing_Toolkit();
			$share = $social_sharing_toolkit->create_bookmarks(get_permalink($post->ID), $post->post_title.' on '.get_option('blogname'));
			$votes = !empty($post->votes)?$post->votes:get_post_meta($post->ID,'contest_entry_votes',TRUE);
				
			?>			
<div class="contest-grid contest-grid-single">
	<div id="contest-entry-<?php the_ID(); ?>" class="entry-item post post-<?php the_ID(); ?>">
		<div class="post-inner">
			<div class="aligner">
				<div class="featured-image">
					<?php print wp_get_attachment_image( get_post_thumbnail_id(get_the_ID()), 'medium' ); ?>
				</div>
			<h4><?php the_title(); ?></h4>
			<div class="post-meta"><span class="date"><a href="<?php get_post_permalink(); ?>"><?php echo get_the_date(); ?></a></span> | <span class="comments"><a title="Comment on " href="<?php get_post_permalink(); ?>#respond"><?php comments_number(); ?></a></span></div>
			</div>
			<div class="post-content"><?php the_content(); ?></div>
			<div class="votes">Votes: <span class="total_votes"><?php print $votes; ?></span></div>
			<?php print $msd_contest->display_class->msd_get_vote_button(get_the_ID()); ?>
			<div class="sharing"><?php print $share; ?></div>
		</div>
	</div>
</div>

				<?php comments_template( '', true ); ?>
			<?php 
			endwhile;
		} else {
			if($instance['key']=='query'){
				print $msd_contest->display_class->display_grid($posts,$instance['cols']);
			} else {
				$msd_contest->display_class->print_photos_by($instance);
			}
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