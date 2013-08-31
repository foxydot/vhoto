<?php
// Regular Desktop Template & responsive assignment
	global $wpdb;
	$layout=false;
	$before=false;
	$after=false;
	$table = $wpdb->prefix.'ultimatum_layout';
	$assign = $wpdb->prefix.'ultimatum_layout_assign';
	$prel='';
	//Look for Core
	if(is_404()){
			$posttype='404';
			$ptyql = "SELECT * FROM $assign WHERE `post_type`='$posttype' AND `template`='".THEME_CODE."'";
			$pfetch=$wpdb->get_row($ptyql,ARRAY_A);
			$layout = layoutValid($pfetch["layout_id"]);
		}
		if(is_search()){
				$posttype='search';
				$ptyql = "SELECT * FROM $assign WHERE `post_type`='$posttype' AND `template`='".THEME_CODE."'";
				$pfetch=$wpdb->get_row($ptyql,ARRAY_A);
				$layout = layoutValid($pfetch["layout_id"]);
		}
		// Wocommerce
		if(function_exists('woocommerce_get_page_id')){
		if(is_shop()){
			$posttype='archive';
			$ptyql = "SELECT * FROM $assign WHERE `post_type`='$posttype' AND `template`='".THEME_CODE."'";
			$pfetch=$wpdb->get_row($ptyql,ARRAY_A);
			$shop_page_id = woocommerce_get_page_id('shop');
			$layout =  layoutValid(get_post_meta($shop_page_id, THEME_CODE.'_layout', true));
		}
		}
	if(!$layout){
	if(is_single() || is_page()){ // look for individual post layout
		$meta_key= THEME_CODE.'_layout';
		$layout =  layoutValid(get_post_meta($post->ID, $meta_key, true));
		
		if(!$layout){
			$posttype = $post->post_type.'-single';
			$ptyql = "SELECT * FROM $assign WHERE `post_type`='$posttype' AND `template`='".THEME_CODE."'";
			$pfetch=$wpdb->get_row($ptyql,ARRAY_A);
			$layout = layoutValid($pfetch["layout_id"]);
		}
	} else { // Look for cats taxes for multiple posts
		$woopass = false;
		if(function_exists('woocommerce_get_page_id')){
		if(is_product_category()){
			$thisCatarray = wp_get_post_terms( $post->ID, 'product_cat' );
			$thisCat = $thisCatarray[0]->name;
			$ptyql = "SELECT * FROM $assign WHERE `post_type`='$posttype' AND `template`='".THEME_CODE."'";
			$pfetch=$wpdb->get_row($ptyql,ARRAY_A);
			$cat_page = get_page_by_title( $thisCat );
			//fix to allow cat pages to be created and assigned an Ult layout - must create as sub-page to 'product-category' page
			$layout = layoutValid(get_post_meta($cat_page->ID, 'ultimatum_layout', true));
		}
		$woopass=true;
		}
		if(is_category() && !$woopass){
			$thisCat = get_category(get_query_var('cat'),false);
			$posttype = 'cat-'.$thisCat->term_id;
			$ptyql = "SELECT * FROM $assign WHERE `post_type`='$posttype' AND `template`='".THEME_CODE."'";
			$pfetch=$wpdb->get_row($ptyql,ARRAY_A);
			$layout = layoutValid($pfetch["layout_id"]);;
		} else {
			$posttype = $post->post_type;
			$tax =  get_query_var('taxonomy');
			$term =  get_query_var('term');
			$posttype =  $posttype.'-'.$tax.'-'.$term;
			$ptyql = "SELECT * FROM $assign WHERE `post_type`='$posttype' AND `template`='".THEME_CODE."'";
			$pfetch=$wpdb->get_row($ptyql,ARRAY_A);
			$layout = layoutValid($pfetch["layout_id"]);
			if(!$layout){
				$posttype =  str_replace($post->post_type.'_', '',$posttype);
				$ptyql = "SELECT * FROM $assign WHERE `post_type`='$posttype' AND `template`='".THEME_CODE."'";
				$pfetch=$wpdb->get_row($ptyql,ARRAY_A);
				$layout = layoutValid($pfetch["layout_id"]);
			}
		}
	}
	}
	if(!$layout){ //look for post type layout
			$posttype=$post->post_type;
			$ptyql = "SELECT * FROM $assign WHERE `post_type`='$posttype' AND `template`='".THEME_CODE."'";
			$pfetch=$wpdb->get_row($ptyql,ARRAY_A);
			$layout = layoutValid($pfetch["layout_id"]);
		}
	if(!$layout){//none found go with default
		$ttable = $wpdb->prefix.'ultimatum_themes';
		$sql = "SELECT * FROM $ttable WHERE published=1 AND `template`='".THEME_CODE."'";
		$theme = $wpdb->get_row($sql,ARRAY_A);
		$defql = "SELECT * FROM $table WHERE `default`=1 AND `theme`='".$theme["id"]."'";
		$dfetch=$wpdb->get_row($defql,ARRAY_A);
		$layout = layoutValid($dfetch["id"]);
	}
	require_once THEME_DIR.'/helpers/Browser.php';
	$browser = new Browser();
	$browsing= $browser->getPlatform();
	
	
	// Mobile Template codes come here
	
	// Stop Cheating!! Layout is found but the layout does not exixst!
	function layoutValid($id){
		global $wpdb;
		$table = $wpdb->prefix.'ultimatum_layout';
		$query = "SELECT * FROM $table WHERE id='$id' AND type='full'";
		$fetch = $wpdb->get_row($query,ARRAY_A);
		if($fetch){
			return $fetch;
		} else {
			return false;
		}
	}
	if(function_exists('ult_ms_getter')){
		$prel = ult_ms_getter();
	}
	if($layout){
	// Get The Layout Info
	// Responsiveness check
	$ttable = $wpdb->prefix.'ultimatum_themes';
	$sql = "SELECT * FROM $ttable WHERE id='".$layout["theme"]."'";
	$tfetch=$wpdb->get_row($sql,ARRAY_A);;
	$ultimateresponsive=false;
	if($tfetch['type']==1){
		$ultimateresponsive='responsive';
	}
	// Check for mobility feature
	if($browser->isMobile() && $tfetch['type']!=2){
		$browsing= $browser->getPlatform();
		// Get the Template for device
		$mtable = $wpdb->prefix.'ultimatum_mobile';
		$mobilethemeq = "SELECT * FROM $mtable WHERE `device`='$browsing'";
		$mfetch=$wpdb->get_row($mobilethemeq,ARRAY_A);
		if($mfetch){
			$defql = "SELECT * FROM $table WHERE `default`=1 AND `theme`='".$mfetch["theme"]."'";
			$dfetch = $wpdb->get_row($defql,ARRAY_A);
			if($dfetch){
				$mobileapp=true;
				$layout = layoutValid($dfetch["id"]);
			}
		}
	}
	if(strlen($layout['before'])>=1) $before = explode(',',$layout['before']);
	if(strlen($layout['after'])>=1) $after = explode(',',$layout['after']);
	} else {
		echo 'you need to have atleast one layout';
		return;
	}
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php 
if(isset($mobileapp)){
	echo '<link rel="apple-touch-icon" href="'.get_theme_option('general', 'touchicon').'"  />'."\n";
	echo '<link rel="apple-touch-startup-image" href="'.get_theme_option('general', 'startimage').'" media="screen"   />'."\n";
	echo '<meta content="yes" name="apple-mobile-web-app-capable" />';
	echo '<meta content="600" name="MobileOptimized" />';
	echo '<meta content="telephone=no" name="format-detection" />';
	echo '<meta content="true" name="HandheldFriendly" />';
	echo '<meta content="black" name="apple-mobile-web-app-status-bar-style" />';
	echo '<script type="text/javascript" src="'. THEME_URI.'/js/bmb.js"></script>';
	echo '<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />';

}

if($ultimateresponsive){
	?><meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" /><?php 
}
?>
<?php 
if(get_theme_option('general', 'ultimatum_seo')){
	do_action( 'ultimatum_title' );
	do_action( 'ultimatum_meta' );
} else { 
?>
<title><?php wp_title( '-', true, 'right' ); ?></title>
<?php } ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php 
	$grid_css = false;
	$css[]="/css/reset.css";
	if(!isset($_GET["inframe"])){
		if(file_exists(THEME_CACHE_DIR.'/grid_'.$layout['theme'].'.css')){
			$grid_css ='grid_'.$layout['theme'].'.css';
		} else { 
			$css[]="/css/grid.php?thm=".$layout['theme'];
		}
	}
	$css[]="/css/menus.css";
	$css[]="/css/sliders.css";
	$css[]="/css/icons.css";
	$css[]="/css/prettyphoto.css";
	
	$css[]="/css/text.css";
	if(isset($_GET["inframe"])){
		$css[]="/css/lbox.css";
	}
	$css[]="/css/wordpress.css";
	$css[]="/css/tabsslides.css";
	require_once (THEME_DIR.'/helpers/Browser.php');
	$browser = new Browser();
	if( $browser->getBrowser() == Browser::BROWSER_IE && $browser->getVersion() <= 8 ) {
		$css[]="/css/iefixer.php";
	}
	if(file_exists(THEME_CACHE_DIR.'/skin_'.$prel.$layout["id"].'.css')){ 
		$css_cache[]="skin_".$prel.$layout["id"].".css";
	} 
	if(is_array($before) && count($before)>=1){
		foreach($before as $bl){
			if(file_exists(THEME_CACHE_DIR.'/layout_'.$prel.$bl.'.css')){
				$css_cache[]="layout_".$prel.$bl.".css";
			}
		}
	}
	if(file_exists(THEME_CACHE_DIR.'/layout_'.$prel.$layout["id"].'.css')){
		$css_cache[]="layout_".$prel.$layout["id"].".css";
	}
	if(is_array($after) && count($after)>=1){
		foreach($after as $al){
			if(file_exists(THEME_CACHE_DIR.'/layout_'.$prel.$al.'.css')){
				$css_cache[]="layout_".$prel.$al.".css";
			}
		}
	}
	
	if(file_exists(THEME_CACHE_DIR.'/google_'.$prel.$layout["id"].'.php')){
		include(THEME_CACHE_DIR.'/google_'.$prel.$layout["id"].'.php');	
	}
	if(file_exists(THEME_CACHE_DIR.'/fontface_'.$prel.$layout["id"].'.css')){
	wp_enqueue_style( 'fontface_'.$prel.$layout["id"].'.css', THEME_CACHE_URI.'/fontface_'.$prel.$layout["id"].'.css');	
	
		 	
	}
	if($grid_css) {
		wp_enqueue_style( str_replace('.css','',$grid_css), THEME_CACHE_URI.'/'.$grid_css);
	}
	foreach($css as $cssfile){
		if(file_exists(get_stylesheet_directory().$cssfile)){
			wp_enqueue_style( str_replace('/','',$cssfile), get_stylesheet_directory_uri().$cssfile);
		} else {
			wp_enqueue_style( str_replace('/','',$cssfile), THEME_URI.$cssfile);
		}
		//echo '<link rel="stylesheet" type="text/css" media="all" href="'.get_bloginfo('stylesheet_directory').''.$cssfile.'" />'."\n";
	}
	if(count($css_cache)!=0){
		foreach($css_cache as $cached_css){
			wp_enqueue_style( str_replace('.css','',$cached_css), THEME_CACHE_URI.'/'.$cached_css);
		}
	}
	if(file_exists(THEME_CACHE_DIR.'/custom_'.$prel.$layout["id"].'.css')){
		wp_enqueue_style( 'custom_'.$prel.$layout["id"].'.css', THEME_CACHE_URI.'/custom_'.$prel.$layout["id"].'.css');	
	//echo '<link rel="stylesheet" type="text/css" media="all" href="'.get_bloginfo('stylesheet_directory').'/cache/custom_'.$prel.$layout.'.css" />'."\n";
		 	
	}
	echo '<link rel="stylesheet" type="text/css" media="all" href="'.get_bloginfo('stylesheet_directory').'/style.css" />'."\n";
	if(get_theme_option('general', 'favicon')){
		echo '<link rel="shortcut" href="'.get_theme_option('general', 'favicon').'" type="image/x-icon" />'."\n";
	    echo '<link rel="shortcut icon" href="'.get_theme_option('general', 'favicon').'" type="image/x-icon" />'."\n";
	}
?>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	wp_head();
	if(file_exists(THEME_CACHE_DIR.'/cufon_'.$prel.$layout["id"].'.php')){
		include(THEME_CACHE_DIR.'/cufon_'.$prel.$layout["id"].'.php');	
	}
	echo "\n";
	
	if(get_theme_option('general', 'head_scripts')){
		echo stripslashes(get_theme_option('general', 'head_scripts'));
	}
	echo "\n";
	do_action('ultimatum_before_head_close');
?>
</head>
<body <?php body_class(); ?>>
<?php do_action('ultimatum_after_body_open');?>
<div class="clear"></div>
<?php
	if(is_array($before) && count($before)>=1){
		do_action('ultimatum_before_headwrapper_open');
		echo '<div class="headwrapper">';
		do_action('ultimatum_after_headwrapper_open');
		foreach($before as $bl){
			callLayout($bl,$ultimateresponsive);
		}
		do_action('ultimatum_before_headwrapper_close');
		echo '</div>';
		do_action('ultimatum_after_headwrapper_close');
	}
	do_action('ultimatum_before_bodywrapper_open');
 	echo '<div class="bodywrapper">';
 	do_action('ultimatum_after_bodywrapper_open');
 	callLayout($layout["id"],$ultimateresponsive);
 	do_action('ultimatum_before_bodywrapper_close');
 	echo '</div>';
 	do_action('ultimatum_after_bodywrapper_close');
	if(is_array($after) && count($after)>=1){
		do_action('ultimatum_before_footwrapper_open');
		echo '<div class="footwrapper">';
		do_action('ultimatum_after_footwrapper_open');
		foreach($after as $al){
				callLayout($al,$ultimateresponsive);
		}
		do_action('ultimatum_before_footwrapper_close');
		echo '</div>';
		do_action('ultimatum_after_footwrapper_close');
	 }
	echo "\n";
	echo "<!-- Footer -->";
	
	wp_footer();
	if(get_theme_option('general', 'footer_scripts')){
		echo stripslashes(get_theme_option('general', 'footer_scripts'));
	}
?>

<?php 
if(isset($mobileapp)){
	?>
	<script>
var a=document.getElementsByTagName("a");
for(var i=0;i<a.length;i++)
{
    a[i].onclick=function()
    {
        window.location=this.getAttribute("href");
        return false
    }
}
	
	</script>
	<?php 
}
?>
<script type='text/javascript' src="<?php echo THEME_JS.'/prettify.js';?>"></script>
<script>
prettyPrint();
</script>
<?php do_action('ultimatum_before_body_close');?>
</body>
</html>
<?php 
$content=ob_get_contents();
ob_end_clean();
preg_match_all('|<style[^>]*>(.*?)</style>|si',$content,$matches);
foreach($matches[0] as $match){
$content = str_replace($match,'',$content);
$content = str_replace('</head>', $match.'</head>', $content);
}
echo $content;
function callLayout($layout,$ultimateresponsive){
	global $wpdb;
	$table = $wpdb->prefix.'ultimatum_layout';
	$rtable = $wpdb->prefix.'ultimatum_rows';
	$query = "SELECT * FROM $table WHERE `id`='$layout'";
	$layout = $wpdb->get_row($query,ARRAY_A);
	$table2 = $wpdb->prefix.'ultimatum_classes';
	$query2 = "SELECT * FROM $table2 WHERE `layout_id`='$layout[id]'";
	$results = $wpdb->get_results($query2);
	$classes=array();
	foreach($results as $result){
		$classes[$result->container] = $result->user_class.' '.$result->hidephone.' '.$result->hidetablet.' '.$result->hidedesktop.' ';
	}
	if(!$layout){
		return;
	}
	$rows = explode(',',$layout["rows"]);
	$ttable = $wpdb->prefix.'ultimatum_themes';
	$sql = "SELECT * FROM $ttable WHERE id='".$layout['theme']."'";
	$theme =  $wpdb->get_row($sql,ARRAY_A);
	if(isset($theme['width'])){
		$width		= 	$theme['width'];
		$rawmargin	=	$theme['margin'];
		$margin		= 	$theme['margin']/2;
	} else {
		$width		= 	960;
		$rawmargin	=	30;
		$margin		= 	15;
	}
	$grid_12	= 	$width-($margin*2);
	$grid_3		= 	($width-($rawmargin*4))/4;
	$grid_4 	= 	($width-($rawmargin*3))/3;
	$grid_6 	= 	($width-($rawmargin*2))/2;
	$grid_8 	= 	$grid_12-($grid_4+$rawmargin);
	$grid_9 	= 	$grid_12-($grid_3+$rawmargin);
	if(count($rows)>=1){
		foreach ($rows as $row_id){
			$query = "SELECT * FROM $rtable WHERE id='$row_id'";
			$row = $wpdb->get_row($query,ARRAY_A);
			include (TEMPLATEPATH . '/wonderfoundry/row-generator.php');
		}
	}
}
?>