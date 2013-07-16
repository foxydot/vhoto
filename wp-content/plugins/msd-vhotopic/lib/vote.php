<?php
define('DOING_AJAX', true);
define('WP_ADMIN', true);

if ( ! isset( $_POST['action'] ) )
	die('no direct access');

require_once( dirname(__FILE__) . '../../../../../wp-load.php' );
@header('Content-Type: text/html; charset=' . get_option('blog_charset'));
send_nosniff_header();

if($post_id = $_POST['vote_id']){
	$meta_key = 'contest_entry_votes';
	$prev_value = get_post_meta($post_id, $meta_key, true);
	$meta_value = $prev_value+1;
	//TODO: get contest
	//TODO: set usermeta for contest with date
	if(update_post_meta($post_id, $meta_key, $meta_value, $prev_value)){
		print $meta_value;
	}
}