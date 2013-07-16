<?php
function ultimate_dynamic_sidebar($responsive=false,$index = 1,$grid=null) {
	global $wp_registered_sidebars, $wp_registered_widgets;
	
	if ( is_int($index) ) {
		$index = "sidebar-$index";
		echo $index;
	} else {
		$index = sanitize_title($index);
		foreach ( (array) $wp_registered_sidebars as $key => $value ) {
			if ( sanitize_title($value['name']) == $index ) {
				$index = $key;
				break;
			}
		}
	}
	$ultimatum_sidebars_widgets = ultimatum_get_sidebars_widgets();
	$sidebar["name"] = $index;
	$sidebar["id"] = $index; 
	$did_one = false;
	if(isset($ultimatum_sidebars_widgets[$index])):
	foreach ( (array) $ultimatum_sidebars_widgets[$index] as $id ) {
		if ( !isset($wp_registered_widgets[$id]) ) continue;
		$params = array_merge(
			array( array_merge( $sidebar, array('widget_id' => $id, 'widget_name' => $wp_registered_widgets[$id]['name']) ) ),
			(array) $wp_registered_widgets[$id]['params']
		);
		$classname_ = '';
		foreach ( (array) $wp_registered_widgets[$id]['classname'] as $cn ) {
			if ( is_string($cn) )
				$classname_ .= '_' . $cn;
			elseif ( is_object($cn) )
				$classname_ .= '_' . get_class($cn);
		}
		$classname_ = ltrim($classname_, '_');
		
		// If padding occurs on left and right we need to cut some of grid width so images wont be effected!!!
		$col = str_replace('sidebar', 'col',$index);
		global $wpdb;
		$csstable = $wpdb->prefix.'ultimatum_css';
		$query = "SELECT * FROM $csstable WHERE `container`='$col' AND `element`='general'";
		$fecth = $wpdb->get_row($query,ARRAY_A);
		if($fecth){
			$properties =unserialize($fecth['properties']);
		} 
		$lw=0;
		$rw=0;
		if(isset($properties['padding-left'])){
			$lw = str_replace('px','', $properties['padding-left']);
		}
		if(isset($properties['padding-right'])){
			$rw = str_replace('px','', $properties['padding-right']);
		}
		$params[0]['grid_width']=$grid-($lw+$rw);
		$params[0]['before_widget']='<div class="widget '.$classname_.' inner-container">';
		$params[0]['after_widget']='</div>';
		$params[0]['before_title']=' <h3 class="element-title">';
		$params[0]['after_title'] = '</h3>';
		$params[0]['responsivetheme']=$responsive;
		$params = apply_filters( 'dynamic_sidebar_params', $params );
		$callback = $wp_registered_widgets[$id]['callback'];
		//echo '<pre>';print_r($params);echo '</pre>';
		//echo $callback;
		do_action( 'dynamic_sidebar', $wp_registered_widgets[$id] );
		if ( is_callable($callback) ) {
			call_user_func_array($callback, $params);
			$did_one = true;
		}
	}
	endif;
	return $did_one;
}


function ultimate_wp_list_widget_controls( $sidebar ) {
	add_filter( 'dynamic_sidebar_params', 'wp_list_widget_controls_dynamic_sidebar' );
	echo "<div id='$sidebar' class='widgets-sortables ui-sortable'>\n";
	$description = wp_sidebar_description( $sidebar );
	if ( !empty( $description ) ) {
		echo "<div class='sidebar-description'>\n";
		echo "\t<p class='description'>$description</p>";
		echo "</div>\n";
	}
	ultimate_dynamic_sidebar(false, $sidebar );
	echo "</div>\n";
}


function ultimate_widget_order_callback(){
	check_ajax_referer( 'save-sidebar-widgets', 'savewidgets' );
	if ( !current_user_can('edit_theme_options') )
		die('-1');
	unset( $_POST['savewidgets'], $_POST['action'] );
	$sidebars =ultimatum_get_sidebars_widgets();
	if ( is_array($_POST['sidebars']) ) {		
		foreach ( $_POST['sidebars'] as $key => $val ) {
			$sb = array();
			if ( !empty($val) ) {
				$val = explode(',', $val);
				foreach ( $val as $k => $v ) {
					if ( strpos($v, 'widget-') === false )
						continue;
					$sb[$k] = substr($v, strpos($v, '_') + 1);
				}
			}
			$sidebars[$key] = $sb;
		}
		ultimatum_set_sidebars_widgets($sidebars);
		die('1');
	}
	die('-1');
}
add_action('wp_ajax_ultimatum-widgets-order', 'ultimate_widget_order_callback');





function ultimatum_get_row_callback() {
	$html = ultimatum_create_row($_POST['id'],$_POST['style']);
	if (! empty($html)) {
		echo $html;
	} else {
		die(0);
	}
}
add_action('wp_ajax_ultimatum-get-row', 'ultimatum_get_row_callback');

function ultimatum_create_row($layout_id,$row_style) {
		global $wpdb;
		$table = $wpdb->prefix.'ultimatum_rows';
		$insert = "INSERT INTO $table (`layout_id`,`type_id`) VALUES ('$layout_id','$row_style')";
		$wpdb->query($insert);
		$row_id = $wpdb->insert_id;
		$query = "SELECT * FROM $table WHERE id='$row_id'";
		$row=$wpdb->get_row($query,ARRAY_A);
		include (THEME_ADMIN.'/ajax/row-generator.php');
	}
	
function ultimatum_get_sidebars_widgets($deprecated = true) {
		if ( $deprecated !== true )
			_deprecated_argument( __FUNCTION__, '2.8.1' );
	
		global $wp_registered_widgets, $_wp_sidebars_widgets, $ultimatum_sidebars_widgets;
	
		// If loading from front page, consult $_wp_sidebars_widgets rather than options
		// to see if wp_convert_widget_settings() has made manipulations in memory.
		if ( !is_admin() ) {
			 
			$ultimatum_sidebars_widgets = get_option('ultimatum_sidebars_widgets', array());
		} else {
			$ultimatum_sidebars_widgets = get_option('ultimatum_sidebars_widgets', array());
		}
	
		if ( is_array( $ultimatum_sidebars_widgets ) && isset($ultimatum_sidebars_widgets['array_version']) )
			unset($ultimatum_sidebars_widgets['array_version']);
	
		$ultimatum_sidebars_widgets = apply_filters('sidebars_widgets', $ultimatum_sidebars_widgets);
		return $ultimatum_sidebars_widgets;
	}

	function ultimatum_set_sidebars_widgets( $ultimatum_sidebars_widgets ) {
		if ( !isset( $ultimatum_sidebars_widgets['array_version'] ) )
			$ultimatum_sidebars_widgets['array_version'] = 3;
		update_option( 'ultimatum_sidebars_widgets', $ultimatum_sidebars_widgets );
	}