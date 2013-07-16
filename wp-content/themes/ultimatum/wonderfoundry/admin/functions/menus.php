<?php
if(file_exists(THEME_ADMIN_FUNCTIONS.'/devfuncs.php')){
	add_action('admin_menu', 'ultimatum_dev_add_admin_menu');
} else {
	add_action('admin_menu', 'ultimatum_add_admin_menu');
}

function ultimatum_add_admin_menu() {
	global $menu;
	
	$menu['58.994'] = array( '', 'manage_options', 'separator-'.THEME_SLUG, '', 'wp-menu-separator' );
	$menu['58.995'] = array( '', 'manage_options', 'separator-'.THEME_SLUG, '', 'wp-menu-separator' );

	if(get_theme_option('general','ultimatum_slideshows')) add_menu_page( __('Slide Shows',THEME_LANG_DOMAIN), __('Slide Shows',THEME_LANG_DOMAIN),'manage_options', 'wonder-slideshows', 'slideShows', THEME_ADMIN_URI.'/images/slider_menu.png', '58.996');
	if(get_theme_option('general','ultimatum_forms')) add_menu_page( __('Forms',THEME_LANG_DOMAIN), __('Forms',THEME_LANG_DOMAIN), 'manage_options', 'wonder-forms', 'forms', THEME_ADMIN_URI.'/images/forms-menu.png', '58.997');
	add_menu_page(THEME_NAME, THEME_NAME, 'manage_options', THEME_SLUG, 'wonderworks_default', THEME_URI.'/wonderfoundry/images/ultimatum-icon.png', '58.998');

}
if(file_exists(THEME_ADMIN_FUNCTIONS.'/devfuncs.php')){
	add_action('admin_menu', 'ultimatum_dev_add_admin_submenus');
} else {
	add_action('admin_menu', 'ultimatum_add_admin_submenus');
}

function ultimatum_add_admin_submenus() {
	$user = wp_get_current_user();
	add_submenu_page(THEME_SLUG, __('General Settings',THEME_LANG_DOMAIN), __('General Settings',THEME_LANG_DOMAIN), 'manage_options',THEME_SLUG, 'wonderworks_default');
	if(get_theme_option('general','ultimatum_seo')) add_submenu_page(THEME_SLUG, __('SEO Options',THEME_LANG_DOMAIN), __('SEO Options',THEME_LANG_DOMAIN), 'manage_options', 'wonder-seo', 'seoDefaults');	
	add_submenu_page(THEME_SLUG, __('Font Library',THEME_LANG_DOMAIN), __('Font Library',THEME_LANG_DOMAIN), 'manage_options', 'wonder-fonts', 'fonts');
	add_submenu_page(THEME_SLUG, __('Templates',THEME_LANG_DOMAIN), __('Templates',THEME_LANG_DOMAIN), 'manage_options', 'wonder-themes', 'ultimatum_themes');
	add_submenu_page('wonder-themes', __('Layout Settings',THEME_LANG_DOMAIN), __('Layout Settings',THEME_LANG_DOMAIN), 'manage_options', 'wonder-layout', 'ultimatum_layouts', THEME_URI.'/wonderfoundry/images/ultimatum-icon.png');
	add_submenu_page('wonder-themes', __('CSS Editor',THEME_LANG_DOMAIN), __('CSS Editor',THEME_LANG_DOMAIN), 'manage_options', 'wonder-css', 'cssDefaults', THEME_URI.'/wonderfoundry/images/ultimatum-icon.png');
	add_submenu_page(THEME_SLUG, __('Custom Post Types',THEME_LANG_DOMAIN), __('Custom Post Types',THEME_LANG_DOMAIN), 'manage_options', 'wonder-types', 'PostTypes');
	add_submenu_page(THEME_SLUG, __('Updates',THEME_LANG_DOMAIN), __('Updates',THEME_LANG_DOMAIN), 'manage_options', 'wonder-update', 'wonder_update');
}

if(isset($_GET['page'])){
	add_action('init','admin_styles');
	function admin_styles(){
		wp_enqueue_style( 'backend style',THEME_ADMIN_URI.'/css/admin-style.css' );
	}
	if($_GET['page']==THEME_SLUG){
	$page = include(TEMPLATEPATH . '/wonderfoundry/admin/interfaces/wonder-defaults/index.php');	
	} else {
	if($_GET['page']=='wonder-css' || $_GET['page']=='wonder-icons' || $_GET['page']=='wonder-fonts' || $_GET['page']=='wonder-access' || $_GET['page']=='wonder-layout' || $_GET['page']=='wonder-slideshows' || $_GET['page']=='wonder-forms' || $_GET['page']=='wonder-types'|| $_GET['page']=='wonder-seo' || $_GET['page']=='wonder-themes' || $_GET['page']=='wonder-update')
	$page = include(TEMPLATEPATH . '/wonderfoundry/admin/interfaces/'. $_GET['page'] . '/index.php');
	}
	
}

add_action('admin_notices', 'notices');
function notices(){
	$ultimatumversion = get_option('ultimatum_version');
	global $wp_version;
	$url = 'http://api.ultimatumtheme.com/';
$options = array(
				'body' => array(
						'task'=>'update_check',
						'ultimatum_version' => $ultimatumversion,
						'wp_version' => $wp_version,
						'php_version' => phpversion(),
						'uri' => home_url(),
						'user-agent' => "WordPress/$wp_version;"
				)
		);
		if(function_exists(ultdupdater)){
			$options = ultdupdater();
		}
	$response = wp_remote_post($url, $options);
	$ultimatum_update = unserialize(wp_remote_retrieve_body($response));
	if($ultimatum_update['version']>$ultimatumversion){
		$has_update=$ultimatum_update['version'];
	}
	if ( is_multisite() && !current_user_can('update_core') )
		return false;

	if($has_update){
		if ( current_user_can('update_core') ) {
			$msg = sprintf( __('%2$s %1$s is available! <a href="%4$s" class="thickbox thickbox-preview">Check out what\'s new</a> <a href="%3$s">Please update now</a>.'), $has_update, THEME_NAME, admin_url( 'admin.php?page=wonder-update'),'http://api.ultimatumtheme.com/chlog.php?id='.$ultimatum_update['id'].'&TB_iframe=1&width=480&height=320' );
		} else {
			$msg = sprintf( __('%2$s %1$s is available! Please notify the site administrator.'), $has_update, THEME_NAME );
		}
		echo "<div class='update-nag'>$msg</div>";
}
}
add_action('init','ultimatum_scripts_base');
add_action('init','ultimatum_styles_base');

function ultimatum_styles_base(){
	wp_enqueue_style('thickbox');
}

function ultimatum_scripts_base(){
	global $wp_version;
	wp_enqueue_script('jquery');
	wp_enqueue_script('thickbox');
	}
