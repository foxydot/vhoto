<?php
add_action('init','load_ujquery');
function load_ujquery(){
wp_enqueue_script('jquery');
}


function enqueue_general_scripts() {
	if(is_admin()){
		return;
	}
	
	wp_enqueue_script('jquery-tools', THEME_JS .'/jquery.tools.min.js', array('jquery'));
	wp_enqueue_script('jquery-prettyphoto', THEME_JS .'/jquery.prettyPhoto.js', array('jquery'));
	$fitvids = get_theme_option('general', 'fitvids');
	if($fitvids){
		wp_enqueue_script('jquery-fitvids', THEME_JS .'/jquery.fitvids.js', array('jquery'));
	}
	wp_enqueue_script('theme.js',THEME_JS .'/theme.js.php',array('jquery-tools'));
	if(function_exists('bp_plugin_is_active')):
		if(bp_plugin_is_active()){
			activate_ult_bp();
		}
	endif;
}
if(function_exists('bp_plugin_is_active')):
	if(bp_plugin_is_active()){
		include_bp_required();
	}
endif;
add_action('wp_head', 'enqueue_general_scripts');
add_filter('widget_text', 'do_shortcode');
if(!function_exists('get_theme_option')){
function get_theme_option($type,$key){
	$themesettings = get_option(THEME_SLUG.'_'.$type);
	$value = $themesettings[$key];
	return $value;
}
}
function new_excerpt_more($more) {
	return '';
}
function new_excerpt_length($length) {
	return 1000;
}
add_filter('excerpt_length', 'new_excerpt_length');
add_filter('excerpt_more', 'new_excerpt_more');

function additonalClass($classes,$container){
	if(isset($classes[$container])){
		return $classes[$container];
	}
}
// Add widgets Sidebars
$sidebars = get_theme_option('general', 'sidebars');
$sidebars = explode(';',$sidebars);
if(is_array($sidebars)){
	foreach($sidebars as $sidbar){
		register_sidebar( array(
				'name' => __( $sidbar, THEME_LANG_DOMAIN ),
				'id' => 'ultimatum-'.strtolower(str_replace(' ','',$sidbar)),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => "</div>",
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
		) );
	}
}

?>