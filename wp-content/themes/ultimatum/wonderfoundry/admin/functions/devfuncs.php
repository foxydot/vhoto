<?php
/**
 * Developers License Functions
 */
/// MENUS //
function ultimatum_dev_add_admin_menu() {
	global $current_user;
	get_currentuserinfo();
	$curuser=$current_user->ID ;
	$access= get_theme_option('ultimatum_access', 'ultimatum_pane');
	$acl=0;
	$upane=true;
	$spane=true;
	$fpane=true;
	if(is_array($access)){
		if(!in_array($curuser, $access)) {
			$acl++;
			$upane=false;
		}
	}
	$access= get_theme_option('ultimatum_access', 'forms_pane');
	if(is_array($access)){
		if(!in_array($curuser, $access)) {
			$acl++;
			$fpane=false;
		}
	}
	$access= get_theme_option('ultimatum_access', 'slides_pane');
	if(is_array($access)){
		if(!in_array($curuser, $access)) {
			$acl++;
			$spane=false;
		}
	}
	global $menu;
	if($acl!=3){
		$menu['58.994'] = array( '', 'manage_options', 'separator-'.THEME_SLUG, '', 'wp-menu-separator' );
		$menu['58.995'] = array( '', 'manage_options', 'separator-'.THEME_SLUG, '', 'wp-menu-separator' );
	}
	if(get_theme_option('general','ultimatum_slideshows')) if($spane) add_menu_page( __('Slide Shows',THEME_LANG_DOMAIN), __('Slide Shows',THEME_LANG_DOMAIN),'manage_options', 'wonder-slideshows', 'slideShows', THEME_ADMIN_URI.'/images/slider_menu.png', '58.996');
	if(get_theme_option('general','ultimatum_forms')) if($fpane) add_menu_page( __('Forms',THEME_LANG_DOMAIN), __('Forms',THEME_LANG_DOMAIN), 'manage_options', 'wonder-forms', 'forms', THEME_ADMIN_URI.'/images/forms-menu.png', '58.997');
	if($upane) add_menu_page(THEME_NAME, THEME_NAME, 'manage_options', THEME_SLUG, 'wonderworks_default', THEME_URI.'/wonderfoundry/images/ultimatum-icon.png', '58.998');

}

function ultimatum_dev_add_admin_submenus() {
	$user = wp_get_current_user();
	add_submenu_page(THEME_SLUG, __('General Settings',THEME_LANG_DOMAIN), __('General Settings',THEME_LANG_DOMAIN), 'manage_options',THEME_SLUG, 'wonderworks_default');
	if(get_theme_option('general','ultimatum_seo')) add_submenu_page(THEME_SLUG, __('SEO Options',THEME_LANG_DOMAIN), __('SEO Options',THEME_LANG_DOMAIN), 'manage_options', 'wonder-seo', 'seoDefaults');
	add_submenu_page(THEME_SLUG, __('Font Library',THEME_LANG_DOMAIN), __('Font Library',THEME_LANG_DOMAIN), 'manage_options', 'wonder-fonts', 'fonts');
	add_submenu_page(THEME_SLUG, __('Templates',THEME_LANG_DOMAIN), __('Templates',THEME_LANG_DOMAIN), 'manage_options', 'wonder-themes', 'ultimatum_themes');
	add_submenu_page('wonder-themes', __('Layout Settings',THEME_LANG_DOMAIN), __('Layout Settings',THEME_LANG_DOMAIN), 'manage_options', 'wonder-layout', 'ultimatum_layouts', THEME_URI.'/wonderfoundry/images/ultimatum-icon.png');
	add_submenu_page('wonder-themes', __('CSS Editor',THEME_LANG_DOMAIN), __('CSS Editor',THEME_LANG_DOMAIN), 'manage_options', 'wonder-css', 'cssDefaults', THEME_URI.'/wonderfoundry/images/ultimatum-icon.png');
	add_submenu_page(THEME_SLUG, __('Custom Post Types',THEME_LANG_DOMAIN), __('Custom Post Types',THEME_LANG_DOMAIN), 'manage_options', 'wonder-types', 'PostTypes');
	add_submenu_page(THEME_SLUG, __('Developer Options',THEME_LANG_DOMAIN), __('Developer Options',THEME_LANG_DOMAIN), 'manage_options', 'wonder-access', 'wonder_access');
	add_submenu_page(THEME_SLUG, __('Updates',THEME_LANG_DOMAIN), __('Updates',THEME_LANG_DOMAIN), 'manage_options', 'wonder-update', 'wonder_update');
}
// MENUS FINISH //
// Theme Exporter //
function exportTheme(){
	// EXPORT Theme Details
	global $wpdb;
	$table = $wpdb->prefix.'ultimatum_themes';
	$ltable = $wpdb->prefix.'ultimatum_layout';
	$atable = $wpdb->prefix.'ultimatum_layout_assign';
	$rtable = $wpdb->prefix.'ultimatum_rows';
	$classtable = $wpdb->prefix.'ultimatum_classes';
	$ctable = $wpdb->prefix.'ultimatum_css';
	$themesql = "SELECT * FROM $table WHERE `id`='$_POST[theme]'";
	$theme = $wpdb->get_row($themesql,ARRAY_A);
	// Export Layouts
	$lsql = "SELECT * FROM $ltable WHERE `theme`='$_POST[theme]' ORDER BY `type` DESC ";
	$layos = $wpdb->get_results($lsql,ARRAY_A);
	// Layout Details (name ,type)
	foreach($layos as $layo){
		$layout['name']=$layo['title'];
		$layout['type']=$layo['type'];
		$layout['default']=$layo['default'];
		$layout['oldid']=$layo['id'];
		$assingsql = "SELECT * FROM $atable WHERE `layout_id`='".$layo['id']."'";
		$assigneds = $wpdb->get_results($assingsql,ARRAY_A);
		if($assigneds){
			foreach($assigneds as $assigned){
			$layout['assigned'][]=$assigned['post_type'];
			}
			
		}
		if($layo["before"]) { $layout['before']=$layo['before'];}
		if($layo['after']){	$layout['after']=$layo['after'];}
		// Layout Assignments
		
		// Layout CSS
		if($layo['type']=='full'){

			$optionname = 'ultimatum_'.$layo['id'].'_css';
			$layout['css']=(get_option($optionname));
			foreach(get_option($optionname) as $option){
				if(isset($option['background-image']) && strlen($option['background-image'])>0){
					$images[]=$option['background-image'];
				}
			}
			if(is_multisite()){
				global $blog_id;
				$customcss = THEME_CACHE_DIR.'/custom_'.$blog_id.'_'.$layo['id'].'.css';
			}else{
				$customcss = THEME_CACHE_DIR.'/custom_'.$layo['id'].'.css';
			}
			if(file_exists($customcss)){
				//echo $customcss;
				$css_file_content = file_get_contents($customcss);
				$layout['custom_css']=$css_file_content;
				preg_match_all('#url\((.*?)\)#', str_replace('"','',str_replace("'",'',$css_file_content)), $css_images);
				if(count($css_images[1])>=1){
					foreach($css_images[1] as $image){
						$images[] = $image;
					}
				}
			}

		}
		// Layout ROWS
		$lrows = explode(',',$layo['rows']);
		foreach($lrows as $lrow){
			$rtable = $wpdb->prefix.'ultimatum_rows';
			$rsql = "SELECT * FROM $rtable WHERE `id`='$lrow'";
			$rrow = $wpdb->get_row($rsql,ARRAY_A);
			$row['type']=$rrow['type_id'];
			// Do the widgets!!
			global $wp_registered_widgets, $wp_registered_widget_controls;
			$ultimatum_sidebars_widgets =get_option('ultimatum_sidebars_widgets', array());
			for($j=1;$j<=5;$j++){
				$oldw= 'col-'.$rrow['id'].'-'.$j;
				$olds= 'sidebar-'.$rrow['id'].'-'.$j;
				// 4- Widgets !!! next_widget_id_number
				if(count($ultimatum_sidebars_widgets[$olds])>=1){
					foreach ($ultimatum_sidebars_widgets[$olds] as $id){
						if(isset($wp_registered_widgets[$id])){
							$fwidget = $wp_registered_widgets[$id];
							$id_base = $wp_registered_widget_controls[$fwidget['id']]['id_base'];
							$currentwid = str_replace($id_base.'-', '', $fwidget[id]);
							$callback = $wp_registered_widgets[$id]['callback'][0];
							$option= $callback->option_name;
							$warray = get_option($option);
							$warray[$currentwid]['widget_name']=$option;
							$warray[$currentwid]['id_base']=$id_base;
							$row['widgets'][$j][]=$warray[$currentwid];;
							unset($warray);

						}
					}


				}
			}

			//End the widgets

			// Layout ROW CSS (wrapper, container ,column)
			// do the wrapper
			$wrapsql = "SELECT * FROM $ctable WHERE `container`='wrapper-".$rrow['id']."'";
			$xwrappers = $wpdb->get_results($wrapsql,ARRAY_A);
			$wrapsql = "SELECT * FROM $classtable WHERE `container`='wrapper-".$rrow['id']."'";
			$wrapper_class = $wpdb->get_row($wrapsql,ARRAY_A);
			$row['wrapper']['custom_classes']=serialize($wrapper_class);
			foreach($xwrappers as $xwrapper){
				$row['wrapper'][$xwrapper['element']]=unserialize($xwrapper['properties']);
				$tmp = unserialize($xwrapper['properties']);
				if(isset($tmp['background-image']) && strlen($tmp['background-image'])>0){
					$images[]=$tmp['background-image'];
				}
				unset($tmp);
			}
			//container
			$containersql = "SELECT * FROM $ctable WHERE `container`='container-".$rrow['id']."'";
			$xcontainers = $wpdb->get_results($containersql,ARRAY_A);
			$wrapsql = "SELECT * FROM $classtable WHERE `container`='container-".$rrow['id']."'";
			$wrapper_class = $wpdb->get_row($wrapsql,ARRAY_A);
			$row['container']['custom_classes']=serialize($wrapper_class);
			foreach($xcontainers as $xcontainer){
				$row['container'][$xcontainer['element']]=unserialize($xcontainer['properties']);
				$tmp = unserialize($xcontainer['properties']);
				if(isset($tmp['background-image']) && strlen($tmp['background-image'])>0){
					$images[]=$tmp['background-image'];
				}
				unset($tmp);
			}
			// Columns
			for($j=1;$j<=5;$j++){
				$colsql = "SELECT * FROM $ctable WHERE `container`='col-".$rrow['id']."-".$j."'";
				$colfetchs = $wpdb->get_results($colsql,ARRAY_A);
				$wrapsql = "SELECT * FROM $classtable WHERE `container`='col-".$rrow['id']."-".$j."'";
				$wrapper_class = $wpdb->get_row($wrapsql,ARRAY_A);
				$row['col'][$j]['custom_classes']=serialize($wrapper_class);
				foreach($colfetchs as $colfetch){
					$row['col'][$j][$colfetch['element']]=unserialize($colfetch['properties']);
					$tmp = unserialize($colfetch['properties']);
					if(isset($tmp['background-image']) && strlen($tmp['background-image'])>0){
						$images[]=$tmp['background-image'];
					}
					unset($tmp);
				}

			}
			$layout["rows"][]=$row;
			unset($row);
		}
		$theme["layouts"][]=$layout;
		unset($layout);
	}
	$resimages = array_unique($images);
	foreach($resimages as $img){
		$image['name']=$img;
		$theme['images'][]=$image;
		$filename=THEME_CACHE_DIR.'/'.basename($img);
		$curl = curl_init($img);
		curl_setopt($curl, CURLOPT_HEADER, 0);  // ignore any headers
		ob_start();  // use output buffering so the contents don't get sent directly to the browser
		curl_exec($curl);  // get the file
		curl_close($curl);
		$content = ob_get_contents();  // save the contents of the file into $file
		ob_end_clean();  // turn output buffering back off
		$fhandle = @fopen($filename, 'w+');
		if ($fhandle) fwrite($fhandle, $content, strlen($content));
		$backuplist[]=$filename;
		unset($image);
	}
	$content =base64_encode(serialize($theme));
	set_time_limit(0);
	$file = THEME_CACHE_DIR.'/export.utx';
	if(file_exists($file)){
		unlink($file);
	}
	$fhandle = @fopen($file, 'w+');
	if ($fhandle) fwrite($fhandle, $content, strlen($content));
	$backuplist[]=$file;
	if(file_exists(THEME_CACHE_DIR.'/'.$theme["name"].'.zip')){
		unlink(THEME_CACHE_DIR.'/'.$theme["name"].'.zip');
	}
	require_once(ABSPATH . 'wp-admin/includes/class-pclzip.php');
	$archive = new PclZip(THEME_CACHE_DIR.'/'.$theme["name"].'.zip');
	$v_list = $archive->add($backuplist,	PCLZIP_OPT_REMOVE_PATH, THEME_CACHE_DIR);
	
	?>
<h2>Your File...</h2>
<p>You have successfully Created your Export file you can download it via below link</p>
<a href="<?php echo THEME_CACHE_URI; ?>/<?php echo $theme["name"]?>.zip">Download File</a>
<?php

}
//Theme exporter finish //

function ultdupdater(){
	$ultimatumversion = get_option('ultimatum_version');
	global $wp_version;
	$options = array(
			'body' => array(
					'task'=>'update_check',
					'ultimatum_version' => $ultimatumversion,
					'wp_version' => $wp_version,
					'php_version' => phpversion(),
					'uri' => home_url(),
					'type'=>'developer',
					'user-agent' => "WordPress/$wp_version;"
			)
	);
	if(get_theme_option('ultimatum_access', 'beta')){
		$options["body"]["beta"]="beta-enabled";
	}
	return $options;
}
$woo = get_theme_option('general', 'woocommerce');
if(in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )  && $woo=="true"){
function ultimatum_woocommerce_frontend_styles_setting() {
	global $woocommerce;
	?><tr valign="top" class="woocommerce_frontend_css_colors">
		<th scope="row" class="titledesc">
			<label><?php _e( 'Styles', 'woocommerce' ); ?></label>
		</th>
	    <td class="forminp"><?php

			$base_file		= THEME_DIR . '/woocommerce/less/woocommerce-base.less';
			$css_file		= THEME_DIR . '/woocommerce/style.css';

			if ( is_writable( $base_file ) && is_writable( $css_file ) ) {

				// Get settings
				$colors = array_map( 'esc_attr', (array) get_option( 'woocommerce_frontend_css_colors' ) );

				// Defaults
				if ( empty( $colors['primary'] ) ) $colors['primary'] = '#ad74a2';
				if ( empty( $colors['secondary'] ) ) $colors['secondary'] = '#f7f6f7';
				if ( empty( $colors['highlight'] ) ) $colors['highlight'] = '#85ad74';
				if ( empty( $colors['content_bg'] ) ) $colors['content_bg'] = '#ffffff';
	            if ( empty( $colors['subtext'] ) ) $colors['subtext'] = '#777777';

				// Show inputs
	    		woocommerce_frontend_css_color_picker( __( 'Primary', 'woocommerce' ), 'woocommerce_frontend_css_primary', $colors['primary'], __( 'Call to action buttons/price slider/layered nav UI', 'woocommerce' ) );
	    		woocommerce_frontend_css_color_picker( __( 'Secondary', 'woocommerce' ), 'woocommerce_frontend_css_secondary', $colors['secondary'], __( 'Buttons and tabs', 'woocommerce' ) );
	    		woocommerce_frontend_css_color_picker( __( 'Highlight', 'woocommerce' ), 'woocommerce_frontend_css_highlight', $colors['highlight'], __( 'Price labels and Sale Flashes', 'woocommerce' ) );
	    		woocommerce_frontend_css_color_picker( __( 'Content', 'woocommerce' ), 'woocommerce_frontend_css_content_bg', $colors['content_bg'], __( 'Your themes page background - used for tab active states', 'woocommerce' ) );
	    		woocommerce_frontend_css_color_picker( __( 'Subtext', 'woocommerce' ), 'woocommerce_frontend_css_subtext', $colors['subtext'], __( 'Used for certain text and asides - breadcrumbs, small text etc.', 'woocommerce' ) );

	    	} else {

	    		echo '<span class="description">' . __( 'To edit colours <code>woocommerce/assets/css/woocommerce-base.less</code> and <code>woocommerce.css</code> need to be writable. See <a href="http://codex.wordpress.org/Changing_File_Permissions">the Codex</a> for more information.', 'woocommerce' ) . '</span>';

	    	}

	    ?></td>
		</tr>
		<script type="text/javascript">
			jQuery('input#woocommerce_frontend_css').change(function() {
				if (jQuery(this).is(':checked')) {
					jQuery('tr.woocommerce_frontend_css_colors').show();
				} else {
					jQuery('tr.woocommerce_frontend_css_colors').hide();
				}
			}).change();
		</script>
		<?php
}

add_action('woocommerce_admin_field_frontend_styles','alter_woo_hooks',1);
function alter_woo_hooks(){
	$priority = has_action('woocommerce_admin_field_frontend_styles', 'woocommerce_frontend_styles_setting');
	remove_action( 'woocommerce_admin_field_frontend_styles','woocommerce_frontend_styles_setting',$priority);
	add_action( 'woocommerce_admin_field_frontend_styles', 'ultimatum_woocommerce_frontend_styles_setting',10);
}
add_action( 'woocommerce_update_options', 'ult_woo_less_prep',10);
function ult_woo_less_prep(){
	$current_tab 		= ( empty( $_GET['tab'] ) ) ? 'general' : sanitize_text_field( urldecode( $_GET['tab'] ) );
if ( $current_tab == 'general') {

		// Save settings
		$primary 		= ( ! empty( $_POST['woocommerce_frontend_css_primary'] ) ) ? woocommerce_format_hex( $_POST['woocommerce_frontend_css_primary'] ) : '';
		$secondary 		= ( ! empty( $_POST['woocommerce_frontend_css_secondary'] ) ) ? woocommerce_format_hex( $_POST['woocommerce_frontend_css_secondary'] ) : '';
		$highlight 		= ( ! empty( $_POST['woocommerce_frontend_css_highlight'] ) ) ? woocommerce_format_hex( $_POST['woocommerce_frontend_css_highlight'] ) : '';
		$content_bg 	= ( ! empty( $_POST['woocommerce_frontend_css_content_bg'] ) ) ? woocommerce_format_hex( $_POST['woocommerce_frontend_css_content_bg'] ) : '';
		$subtext 		= ( ! empty( $_POST['woocommerce_frontend_css_subtext'] ) ) ? woocommerce_format_hex( $_POST['woocommerce_frontend_css_subtext'] ) : '';
	
		$colors = array(
				'primary' 		=> $primary,
				'secondary' 	=> $secondary,
				'highlight' 	=> $highlight,
				'content_bg' 	=> $content_bg,
				'subtext' 		=> $subtext
		);
	
		$old_colors = get_option( 'woocommerce_frontend_css_colors' );
		update_option( 'woocommerce_frontend_css_colors', $colors );
	
		if ( $old_colors != $colors )
			ult_woocommerce_compile_less_styles();
	}
}

function ult_woocommerce_compile_less_styles() {
	global $woocommerce;

	$colors 		= array_map( 'esc_attr', (array) get_option( 'woocommerce_frontend_css_colors' ) );
	$base_file		= THEME_DIR . '/woocommerce/less/woocommerce-base.less';
	$less_file		= THEME_DIR . '/woocommerce/less/woocommerce.less';
	$css_file		= THEME_DIR . '/woocommerce/style.css';

	// Write less file
	if ( is_writable( $base_file ) && is_writable( $css_file ) ) {

		// Colours changed - recompile less
		if ( ! class_exists( 'lessc' ) )
			include_once($woocommerce->plugin_path().'/admin/includes/class-lessc.php');
		if ( ! class_exists( 'cssmin' ) )
			include_once($woocommerce->plugin_path().'/admin/includes/class-cssmin.php');

		try {
			// Set default if colours not set
			if ( ! $colors['primary'] ) $colors['primary'] = '#ad74a2';
			if ( ! $colors['secondary'] ) $colors['secondary'] = '#f7f6f7';
			if ( ! $colors['highlight'] ) $colors['highlight'] = '#85ad74';
			if ( ! $colors['content_bg'] ) $colors['content_bg'] = '#ffffff';
			if ( ! $colors['subtext'] ) $colors['subtext'] = '#777777';

			// Write new color to base file
			$color_rules = "
@primary: 		" . $colors['primary'] . ";
@primarytext: 	" . woocommerce_light_or_dark( $colors['primary'], 'desaturate(darken(@primary,50%),18%)', 'desaturate(lighten(@primary,50%),18%)' ) . ";

@secondary: 	" . $colors['secondary'] . ";
@secondarytext: " . woocommerce_light_or_dark( $colors['secondary'], 'desaturate(darken(@secondary,60%),18%)', 'desaturate(lighten(@secondary,60%),18%)' ) . ";

@highlight: 	" . $colors['highlight'] . ";
@highlightext:	" . woocommerce_light_or_dark( $colors['highlight'], 'desaturate(darken(@highlight,60%),18%)', 'desaturate(lighten(@highlight,60%),18%)' ) . ";

@contentbg:		" . $colors['content_bg'] . ";

@subtext:		" . $colors['subtext'] . ";
			";

			file_put_contents( $base_file, $color_rules );

			$less 			= new lessc( $less_file );
			$compiled_css 	= $less->parse();

			$compiled_css = CssMin::minify( $compiled_css );

			if ( $compiled_css )
				file_put_contents( $css_file, $compiled_css );

		} catch ( exception $ex ) {
			wp_die( __( 'Could not compile woocommerce.less:', 'woocommerce' ) . ' ' . $ex->getMessage() );
		}
	}
}
}

