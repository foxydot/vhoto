<?php
define('DOING_AJAX', true);
define('WP_ADMIN', true);

if ( ! isset( $_POST['action'] ) )
	die('no direct access');

require_once( dirname(__FILE__) . '../../../../../wp-load.php' );
@header('Content-Type: text/html; charset=' . get_option('blog_charset'));
send_nosniff_header();

if($post_id = $_POST['vote_id']){
	global $current_user;
	$meta_key = 'contest_entry_votes';
	$prev_value = get_post_meta($post_id, $meta_key, true);
	$meta_value = $prev_value+1;
	$contests = get_the_terms($post_id,'contest');
	$contest = $contests[0]->term_id;
	if(update_post_meta($post_id, $meta_key, $meta_value, $prev_value)){
		update_usermeta($current_user->ID, 'voted_contest_'.$contest, time());
		print $meta_value;
	}
}