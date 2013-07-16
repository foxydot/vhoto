<?php

add_action('init','layouteditor_scripts');
add_action('init','layouteditor_styles');

function layouteditor_styles(){
	wp_enqueue_style( 'jqueryui-css','http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/themes/base/jquery-ui.css' );
	wp_enqueue_style( 'colorpicker css',THEME_ADMIN_URI.'/css/colorpicker.css' );
	wp_enqueue_style('thickbox');
}

function layouteditor_scripts(){
	global $wp_version;
	wp_enqueue_script('jquery');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script( 'ultimatum-cpicker',THEME_ADMIN_URI.'/js/colorpicker.js' );
	wp_enqueue_script( 'ultimatum-cpicker2',THEME_ADMIN_URI.'/js/eye.js' );
	wp_enqueue_script( 'ultimatum-cpicker3',THEME_ADMIN_URI.'/js/utils.js' );
	wp_enqueue_script( 'ultimatum-iphone',THEME_ADMIN_URI.'/js/jquery-iphone.js' );
	wp_enqueue_script( 'ultimatum-cpicker4',THEME_ADMIN_URI.'/js/layout.js' );
}
	

function cssDefaults(){
	global $theme_options;
	include_once THEME_ADMIN_HELPERS.'/class.options.php';
	screen_icon(); 
	echo '<div class="wrap">';
	if($_GET[layout]){?>
	<h2><?php _e('CSS Properties',THEME_ADMIN_LANG_DOMAIN);?> :<?php global $wpdb; $table =$wpdb->prefix.'ultimatum_layout';$sql= "SELECT * FROM $table WHERE id='$_GET[layout]'";  $fetch=$wpdb->get_row($sql,ARRAY_A); echo $fetch[title];  ?> </h2>
	<p><a class="button-primary" href="admin.php?page=wonder-layout&task=edit&layoutid=<?php echo $_GET[layout];?>"><?php _e('Back to Layout Editor',THEME_ADMIN_LANG_DOMAIN);?></a></p>
	<p><a href="#postel"><?php _e('Post Elements',THEME_ADMIN_LANG_DOMAIN);?></a> | <a href="#comments"><?php _e('Comments',THEME_ADMIN_LANG_DOMAIN);?></a> | <a href="#bcumb"><?php _e('Bread Crumbs',THEME_ADMIN_LANG_DOMAIN);?></a> | <a href="#navi"><?php _e('Pagination',THEME_ADMIN_LANG_DOMAIN);?></a> | <a href="#hmm"><?php _e('Horizontal Mega Menu',THEME_ADMIN_LANG_DOMAIN);?></a> | <a href="#hm"><?php _e('Horizontal Drop Down Menu',THEME_ADMIN_LANG_DOMAIN);?></a> | <a href="#hndm"><?php _e('Horizontal Menu',THEME_ADMIN_LANG_DOMAIN);?></a> | <a href="#vmm"><?php _e('Vertical Mega Menu',THEME_ADMIN_LANG_DOMAIN);?></a> | <a href="#vm"><?php _e('Vertical Drop Down Menu',THEME_ADMIN_LANG_DOMAIN);?></a> | <a href="#vndm"><?php _e('Vertical Menu',THEME_ADMIN_LANG_DOMAIN);?></a> | <a href="#tab"><?php _e('Tabs',THEME_ADMIN_LANG_DOMAIN);?></a> | <a href="#accord"><?php _e('Acoordions',THEME_ADMIN_LANG_DOMAIN);?></a> | <a href="#toggle"><?php _e('Togglers',THEME_ADMIN_LANG_DOMAIN);?></a> | <a href="#slider"><?php _e('Slide Show Elements',THEME_ADMIN_LANG_DOMAIN);?></a>  | <a href="#widget"><?php _e('Widgets',THEME_ADMIN_LANG_DOMAIN);?></a> | <a class="button-primary autowidth thickbox"  href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-css/custom-css-editor.php?layout_id=<?php echo $_GET[layout];?>&TB_iframe=1&width=770&height=480" title="<?php _e('Type your Custom CSS',THEME_ADMIN_LANG_DOMAIN);?>"><?php _e('Custom CSS',THEME_ADMIN_LANG_DOMAIN);?></a>
	</p>
	
	<?php } else { // Got o Default Layout CSS 
		global $wpdb;
		$table = $wpdb->prefix.'ultimatum_layout';
		$defql = "SELECT * FROM $table WHERE `default`=1";
		$dfetch = $wpdb->get_row($defql,ARRAY_A);
		$layout = ($dfetch[id]); 
		$url = curPageURL().'&layout='.$layout;
		?>
		<script language="JavaScript">
				parent.location.href='<?php echo $url; ?>';
			</script>
		<?php 
	
	}
	?>
	<table class="widefat" cellspacing="0">
	<thead><tr><th><?php _e('Copy CSS From another Layout',THEME_ADMIN_LANG_DOMAIN);?></th></tr></thead>
	<tbody>
	<tr valign="top"><td>
	<form method="post" action="admin.php?page=wonder-layout">
	<?php  _e('Copy CSS From',THEME_ADMIN_LANG_DOMAIN);?> :
	<select name="source">
	<?php 
		$defql = "SELECT * FROM $table WHERE `type`='full' AND `id`<>'$_GET[layout]'";
		$lss = $wpdb->get_results($defql,ARRAY_A);
		if($lss){
			foreach($lss as $ls){
				echo '<option value="'.$ls[id].'">'.$ls[title].'</option>';
			}
		}
	?>
	</select>
	<input type="hidden" name="cloneid" value="<?php echo $_GET[layout];?>" />
	<input type="hidden" name="action" value="copycss" />
	<input type="submit" value="Clone CSS" class="button-primary" />
	</form></td></tr>
	</tbody>
	</table>
	<br /><br />
	<?php
				$tbg = include_once THEME_ADMIN_OPTIONS.'/css-options.php';
				$onur = new optionGenerator($tbg[name], $tbg[options]);?>
	<?php
	//Custom CSS
	?>

	<?php 
	
	echo '</div>'; 
}
function curPageURL() {
 $pageURL = $_SERVER["REQUEST_URI"];
 return $pageURL;
}