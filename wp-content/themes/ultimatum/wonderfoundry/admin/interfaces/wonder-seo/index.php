<?php
add_action('init','udefaultscreen_scripts');
add_action('init','udefaultscreen_styles');
function udefaultscreen_scripts(){
	wp_enqueue_script('jquery');
	wp_enqueue_script('thickbox');
	wp_enqueue_script( 'ultimatum-iphone',THEME_ADMIN_URI.'/js/jquery-iphone.js' );
	wp_enqueue_script( 'ultimatum-cpicker4',THEME_ADMIN_URI.'/js/layout.js' );
}
function udefaultscreen_styles(){
	wp_enqueue_style('thickbox');
}
function seoDefaults(){
	global $theme_options;
	include_once THEME_ADMIN_HELPERS.'/class.options.php';
	screen_icon(); 
	echo '<div class="wrap">';
	?>
	<h2><?php _e('SEO Settings',THEME_ADMIN_LANG_DOMAIN);?> </h2>
	<?php
				$tbg = include_once THEME_ADMIN_OPTIONS.'/seo-options.php';
				$onur = new optionGenerator($tbg["name"], $tbg["options"]);?>
	<?php
	echo '</div>'; 
}
function curPageURL() {
 $pageURL = $_SERVER["REQUEST_URI"];
 return $pageURL;
}