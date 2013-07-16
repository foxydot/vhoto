<?php
function ultimatum_select_layout() {
	$args=array('public'   => true,'publicly_queryable' => true);
	$post_types=get_post_types($args,'names');
	foreach ($post_types as $post_type ) {
		if($post_type!='attachment'){
			add_meta_box('ultimate_layoutselector',__( 'Layout Selection', THEME_ADMIN_LANG_DOMAIN),'ultimatum_select_layout_form',$post_type,'side','high');
		}
	}
	add_meta_box('ultimate_layoutselector',__( 'Layout Selection', THEME_ADMIN_LANG_DOMAIN),'ultimatum_select_layout_form','page','side','high');
}

function ultimatum_select_layout_form() {
	global $wpdb;
	$meta_key= THEME_CODE.'_layout';
	$ttable=$wpdb->prefix.'ultimatum_themes';
	$table=$wpdb->prefix.'ultimatum_layout';
	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
	wp_nonce_field( plugin_basename( __FILE__ ), 'ulayoutsel_noncename' );
	echo '<label for="ultimatum_layout">';
	_e("Select a Layout", THEME_ADMIN_LANG_DOMAIN );
	echo '</label><br /> ';
	$curr= get_post_meta($post_id,$meta_key,true);
	echo '<select name="ultimatum_layout">';
	echo '<option value="">The Default</option>';
	$query1 = "SELECT * FROM $ttable WHERE `template`='".THEME_CODE."'";
	$result1 = $wpdb->get_results($query1,ARRAY_A);
	foreach ($result1 as $theme){
	$query = "SELECT * FROM $table WHERE type='full' AND `theme`='$theme[id]'";
	$result = $wpdb->get_results($query,ARRAY_A);
	if($result){
		echo '<optgroup label="'.$theme['name'].'">';
	foreach ($result as $fetch){
		echo '<option value="'.$fetch["id"].'" ';
		if($fetch["id"]==$curr){ echo ' selected="selected" ';}
   		echo '>'.$fetch["title"].'</option>';
   }
   echo '</optgroup>';
	}
	}
   echo '</select>';
}

function ultimatum_select_layout_save_postdata( $post_id ) {
 if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE || defined('DOING_AJAX') && DOING_AJAX ) 
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
  $mydata = $_POST['ultimatum_layout'];
  $meta_key= THEME_CODE.'_layout';
  update_post_meta($post_id, $meta_key, $mydata);
}

add_action( 'admin_init', 'ultimatum_select_layout', 1 );
add_action( 'save_post', 'ultimatum_select_layout_save_postdata' );