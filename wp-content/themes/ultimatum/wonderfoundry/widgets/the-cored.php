<?php
class UltimatumCored extends WP_Widget {

	function UltimatumCored() {
        parent::WP_Widget(false, $name = 'Ultimatum Author Definiton');
    }

	function widget($args, $instance) {
		extract( $args );
		$instance[width]=$grid_width;
			if ( get_the_author_meta( 'description' ) ) : ?>
				<div id="author-info">
					<div id="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), 60 ); ?>
					</div><!-- #author-avatar -->
					<div id="author-description">
						<h2><?php printf( __( 'About %s',THEME_ADMIN_LANG_DOMAIN ), get_the_author() ); ?></h2>
						<?php the_author_meta( 'description' ); ?>
					</div><!-- #author-description	-->
				</div><!-- #entry-author-info -->
				<?php endif; 
			
		
    }

	function update( $new_instance, $old_instance ) {
		
    }
	function form($instance) {
		?>
		<i>
		<?php _e('Include this in author pages so it will show the information you have inserted for author.',THEME_ADMIN_LANG_DOMAIN);?>
		</i>
		<?php 
    }

}
add_action('widgets_init', create_function('', 'return register_widget("UltimatumCored");'));
?>