<?php 
add_theme_support( 'woocommerce' );
if(!function_exists('get_theme_option')){
	function get_theme_option($type,$key){
		$themesettings = get_option(THEME_SLUG.'_'.$type);
		$value = $themesettings[$key];
		return $value;
	}
}
function ult_ms_getter(){
		if(is_multisite()){
				global $blog_id;
				$prel=$blog_id.'_';
				
			}else{
				$prel='';
			}
			return $prel;
}
// Check if BuddyPress is active
//................................................................

if ( ! function_exists( 'bp_plugin_is_active' ) ) :
function bp_plugin_is_active() {
	//check if the function "bp_include" exists (this is a shortcut to checking if BP is loaded)
	return ( function_exists( 'bp_include' ) ) ? true : false;
}
endif;

// Check if bbPress is active (site wide, not BP groups version)
//................................................................

if ( ! function_exists( 'bbPress_plugin_is_active' ) ) :
function bbPress_plugin_is_active() {
	//check if the calss "bbPress" exists (this is a shortcut to checking if bbPress is loaded)
	return ( class_exists('bbPress') ) ? true : false;
}
endif;


$woo = get_theme_option('general', 'woocommerce');
if(in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )  && $woo=="true"){

function woocommerce_ultimatum_layered_pricefilter_init( ) {
	global $woocommerce;
	wp_register_script( 'wc-price-slider', $woocommerce->plugin_url() . '/assets/js/frontend/price-slider.min.js', array( 'jquery-ui-slider' ), '1.6', true );
	add_filter( 'loop_shop_post_in', 'woocommerce_price_filter' );
}
	//
	function woocommerce_ultimatum_layered_nav_init( ) {
		global $_chosen_attributes, $woocommerce, $_attributes_array;
		$_chosen_attributes = $_attributes_array = array();
		$attribute_taxonomies = $woocommerce->get_attribute_taxonomies();
		if ( $attribute_taxonomies ) {
			foreach ( $attribute_taxonomies as $tax ) {
		    	$attribute = sanitize_title( $tax->attribute_name );
		    	$taxonomy = $woocommerce->attribute_taxonomy_name( $attribute );
				// create an array of product attribute taxonomies
				$_attributes_array[] = $taxonomy;
		    	$name = 'filter_' . $attribute;
		    	$query_type_name = 'query_type_' . $attribute;
		    	if ( ! empty( $_GET[ $name ] ) && taxonomy_exists( $taxonomy ) ) {
		    		$_chosen_attributes[ $taxonomy ]['terms'] = explode( ',', $_GET[ $name ] );
		    		if ( ! empty( $_GET[ $query_type_name ] ) && $_GET[ $query_type_name ] == 'or' )
		    			$_chosen_attributes[ $taxonomy ]['query_type'] = 'or';
		    		else
		    			$_chosen_attributes[ $taxonomy ]['query_type'] = 'and';
				}
			}
	    }
	    add_filter('loop_shop_post_in', 'woocommerce_layered_nav_query');
	}
	add_action( 'init', 'woocommerce_ultimatum_layered_pricefilter_init', 1 );
add_action( 'init', 'woocommerce_ultimatum_layered_nav_init', 1 );
	//
	add_theme_support( 'woocommerce' );
	add_filter('loop_shop_per_page', 'ultimatum_shop_perpage',20);
	function ultimatum_shop_perpage() {
		$perpage = get_theme_option('general','woocount' );
		if ( !$perpage ) $perpage = 12;
		return $perpage;
	}
	
	add_filter('loop_shop_columns', 'ultimatum_shop_columns');
	function ultimatum_shop_columns() {
		$columns = get_theme_option('general','woocols' );
		if ( !$columns ) $columns = 4;
		return $columns;
	}


if(!get_option('theme_woocommerce_pages_raw_fix')){
	function theme_woocommerce_pages_raw_fix(){
		global $wpdb;
		$pages = array(
		//'woocommerce_shop_page_id' => _x('shop', 'page_slug', 'woothemes'),
				'woocommerce_cart_page_id' => _x('cart', 'page_slug', 'woothemes'),
				'woocommerce_checkout_page_id' => _x('checkout', 'page_slug', 'woothemes'),
				'woocommerce_order_tracking_page_id' => _x('order-tracking', 'page_slug', 'woothemes'),
				'woocommerce_myaccount_page_id' =>  _x('my-account', 'page_slug', 'woothemes'),
				'woocommerce_edit_address_page_id' => _x('edit-address', 'page_slug', 'woothemes'),
				'woocommerce_view_order_page_id' => _x('view-order', 'page_slug', 'woothemes'),
				'woocommerce_change_password_page_id' => _x('change-password', 'page_slug', 'woothemes'),
				'woocommerce_pay_page_id' => _x('pay', 'page_slug', 'woothemes'),
				'woocommerce_thanks_page_id' => _x('order-received', 'page_slug', 'woothemes'),
		);
		$i =0;
		foreach($pages as $option => $slug){
			$option_value = get_option($option);

			if ($option_value>0 && $p = get_post( $option_value )){
				$pattern = '/(?<!\[raw\])\s*(\[woocommerce_[a-zA-Z_]+?\])\s*(?!\[\/raw\])/i';
				$replacement = '[raw]$1[/raw]';
				$post_content = preg_replace($pattern, $replacement, $p->post_content);
				$wpdb->update( $wpdb->posts, stripslashes_deep(array('post_content' => $post_content)), array( 'ID' => $p->ID ));
				$i ++;
			}
		}
		if($i > 5){
			update_option('theme_woocommerce_pages_raw_fix',1);
		}
	}
	theme_woocommerce_pages_raw_fix();
}
}
function activate_ult_bp(){
	wp_enqueue_script('bp-core',BP_PLUGIN_URL . '/bp-themes/bp-default/_inc/global.js', array('jquery'));
	wp_enqueue_script('bp-members',BP_PLUGIN_URL . '/bp-core/js/widget-members.js', array('jquery'));
	wp_enqueue_script('bp-groups',BP_PLUGIN_URL . '/bp-groups/js/widget-groups.js', array('jquery'));
}
function include_bp_required(){
	require_once( BP_PLUGIN_DIR . '/bp-themes/bp-default/_inc/ajax.php' );
}


?>