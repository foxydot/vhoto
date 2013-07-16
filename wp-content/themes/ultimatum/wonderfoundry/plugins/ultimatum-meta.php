<?php
function ultimatum_meta_box() {
	$args=array('public'   => true,'publicly_queryable' => true);
	$post_types=get_post_types($args,'names');
	foreach ($post_types as $post_type ) {
		if($post_type!='attachment'){
			add_meta_box('ultimate_meta',__( 'Post Properties', THEME_ADMIN_LANG_DOMAIN),'ultimatum_meta',$post_type);
		}
	}
	
}

function ultimatum_meta() {
	global $wpdb;
	$table=$wpdb->prefix.'ultimatum_layout';
	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
	wp_nonce_field( plugin_basename( __FILE__ ), 'ulayoutsel_noncename' );
	echo '<p><label for="ultimatum_author">';
	_e("Show Author Info", THEME_ADMIN_LANG_DOMAIN );
	echo '</label>';
	echo '<select name="ultimatum_author">';
	$cura= get_post_meta($post_id,'ultimatum_author',true);
	echo '<option value="false"';
	if($cura=='false') { echo ' selected="selected" '; }
	echo '>OFF</option>';
	echo '<option value="true"';
	if($cura=='true') { echo ' selected="selected" '; }
	echo '>ON</option>';
	echo '</select></p>';
	echo '<p><label for="ultimatum_video">';
	_e("Video URL", THEME_ADMIN_LANG_DOMAIN );
	echo '</label>';
	$curv= get_post_meta($post_id,'ultimatum_video',true);
	echo '<input type="text" name="ultimatum_video" value="'.$curv.'" size="50" />';
	_e("Used in slideshows as post info ", THEME_ADMIN_LANG_DOMAIN );
	echo '</p>';
	
}

function ultimatum_meta_save_postdata( $post_id ) {
 if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE || defined('DOING_AJAX') && DOING_AJAX ) 
      return;
  if ( !wp_verify_nonce( $_POST['ulayoutsel_noncename'], plugin_basename( __FILE__ ) ) )
      return;
  if ( 'page' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }
  $mydata = $_POST['ultimatum_video'];
  update_post_meta($post_id, 'ultimatum_video', $mydata);
  $mydata = $_POST['ultimatum_author'];
  update_post_meta($post_id, 'ultimatum_author', $mydata);
}

add_action( 'admin_init', 'ultimatum_meta_box', 1 );
add_action( 'save_post', 'ultimatum_meta_save_postdata' );