<?php 
if(!isset($_REQUEST['theme']) && !isset($_REQUEST['layoutid']) && !isset($_REQUEST["source"])){
	
	_e('Bad Request No theme Info Supplied');
} else {
add_action('init','layouteditor_scripts');
add_action('init','layouteditor_styles');
	
function layouteditor_styles(){
	global $wp_version;
	if($wp_version>3.2){
		wp_enqueue_style( 'layout-generator',THEME_ADMIN_URI.'/css/layout-generator.3.3.css' );
	} else {
		wp_enqueue_style( 'layout-generator',THEME_ADMIN_URI.'/css/layout-generator.css' );
	}
	wp_enqueue_style('thickbox');
	wp_enqueue_style( 'jqueryui-css','http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/themes/base/jquery-ui.css' );
}

function layouteditor_scripts(){
	global $wp_version;
	wp_enqueue_script( 'layout-generator',THEME_ADMIN_URI.'/js/layout-generator.js' );
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-widget');
	wp_enqueue_script('jquery-ui-mouse');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-draggable');
	wp_enqueue_script('jquery-ui-droppable');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('hoverIntent');
	wp_enqueue_script('common');
	wp_enqueue_script('jquery-color');
	wp_enqueue_script('thickbox');
	
	if($wp_version>3.2){
		wp_enqueue_script( 'ultimatum-widgets',THEME_ADMIN_URI.'/js/ultimatum-widgets33.js' );
	} else {
		wp_enqueue_script( 'ultimatum-widgets',THEME_ADMIN_URI.'/js/ultimatum-widgets.js' );
	}
}
function ultimatum_layouts(){
	if(isset($_REQUEST['task'])){
		$task = $_REQUEST['task'];
	} else {
		$task=false;
	}
	screen_icon(); 
	echo '<div class="wrap">';
	switch ($task){
		default:
			ultimatum_list_layouts();
		break;
		case 'edit':
			ultimatum_layout_generator();
		break;
	}
	echo '</div>';
}
}
function ultimatum_list_layouts(){
	require_once('ultimatum-widgets.php');
	global $wp_registered_widgets, $wp_registered_widget_controls;
	$sidebars_widgets = wp_get_sidebars_widgets();
	global $wpdb;
	$table = $wpdb->prefix.'ultimatum_layout';
	$atable = $wpdb->prefix.'ultimatum_layout_assign';
	$rtable = $wpdb->prefix.'ultimatum_rows';
	$ctable = $wpdb->prefix.'ultimatum_css';
	$classtable = $wpdb->prefix.'ultimatum_classes';
	if($_GET['delassigner']){
		$sql1 = "DELETE FROM $atable WHERE `post_type`='".$_GET['delassigner']."' AND `template`='".THEME_CODE."'";
		$wpdb->query($sql1);
		$url = "admin.php?page=wonder-layout&theme=".$_GET['theme'];
		?>
		<script language="JavaScript">
		parent.location.href='<?php echo $url; ?>';
		</script>
		<?php 
	}
	if($_POST){
		switch ($_POST[action]){
			case 'delete':
			echo '<p>Deleting Layout :'.$layout['title'].'... ';
			$sql1 = "DELETE FROM $ctable WHERE `layout_id`='$_POST[source]'";
			$wpdb->query($sql1);
			$sql1 = "DELETE FROM $rtable WHERE `layout_id`='$_POST[source]'";
			$wpdb->query($sql1);
			$sql1 = "DELETE FROM $atable WHERE `layout_id`='$_POST[source]'";
			$wpdb->query($sql1);
			$sql1 = "DELETE FROM $table WHERE `id`='$_POST[source]'";
			$wpdb->query($sql1);
			if(function_exists(ult_ms_getter)){
				$prel = ult_ms_getter();
			}
			$files[] = THEME_CACHE_DIR.'/skin_'.$prel.$_POST[source].'.css';
			$files[] = THEME_CACHE_DIR.'/custom_'.$prel.$_POST[source].'.css';
			$files[] = THEME_CACHE_DIR.'/layout_'.$prel.$_POST[source].'.css';
			$files[] = THEME_CACHE_DIR.'/cufon_'.$prel.$_POST[source].'.php';
			$files[] = THEME_CACHE_DIR.'/google_'.$prel.$_POST[source].'.php';
			$files[] = THEME_CACHE_DIR.'/fontface_'.$prel.$_POST[source].'.css';
			foreach ($files as $file){
				if(file_exists($file)){
					unlink($file);
				}
			}
			echo 'Done.</p>';
			$url = curPageURL();
			?>
			<script language="JavaScript">
				parent.location.href='<?php echo $url; ?>';
			</script>
			<?php
			break;
			case 'create_new':
		
				$query = "INSERT INTO $table (`title`, `type`,`theme`) VALUES ('$_POST[title]', '$_POST[type]','$_REQUEST[theme]')";
				$wpdb->query($query);
				$layoutid = $wpdb->insert_id;
				if($_POST[type]=="full"){
					if(function_exists(ult_ms_getter)){
					$prel = ult_ms_getter();
					}
					$defql = "SELECT * FROM $table WHERE  `theme`='$_REQUEST[theme]' AND `default`=1";
					$dfetch= $wpdb->get_row($defql,ARRAY_A);
					$dlayout = ($dfetch["id"]); 
					$option = get_option(THEME_SLUG.'_'.$dlayout.'_css');
					$newopt = update_option(THEME_SLUG.'_'.$layoutid.'_css', $option);
					$file1 = THEME_CACHE_DIR.'/skin_'.$prel.$dlayout.'.css';
					$file1new = THEME_CACHE_DIR.'/skin_'.$prel.$layoutid.'.css';
					$file2 = THEME_CACHE_DIR.'/cufon_'.$prel.$dlayout.'.php';
					$file2new = THEME_CACHE_DIR.'/cufon_'.$prel.$layoutid.'.php';
					$file3 = THEME_CACHE_DIR.'/google_'.$prel.$dlayout.'.php';
					$file3new = THEME_CACHE_DIR.'/google_'.$prel.$layoutid.'.php';
					$file4 = THEME_CACHE_DIR.'/fontface_'.$prel.$dlayout.'.css';
					$file4new = THEME_CACHE_DIR.'/fontface_'.$prel.$layoutid.'.css';
					$file5 = THEME_CACHE_DIR.'/custom_'.$prel.$dlayout.'.css';
					$file5new = THEME_CACHE_DIR.'/custom_'.$prel.$layoutid.'.css';
					if(file_exists($file1)){
						copy($file1, $file1new);
					}
					if(file_exists($file2)){
						copy($file2, $file2new);
					}
					if(file_exists($file3)){
						copy($file3, $file3new);
					}
					if(file_exists($file4)){
						copy($file4, $file4new);
					}
					if(file_exists($file5)){
						copy($file5, $file5new);
					}
				}
				$url = curPageURL().'&task=edit&layoutid='.$layoutid;
			?>
			<script language="JavaScript">
				parent.location.href='<?php echo $url; ?>';
			</script>
			<?php
			break;
			case 'copycss':
		if(function_exists(ult_ms_getter)){
		$prel = ult_ms_getter();
	}
				$tobecloned = $_POST["source"];
				$cloneid = $_POST["cloneid"];
				$select = "SELECT * FROM $table WHERE `id`='$tobecloned'";
				$sourcelayout = $wpdb->get_row($select,ARRAY_A);
				$option = get_option(THEME_SLUG.'_'.$tobecloned.'_css');
				$newopt = update_option(THEME_SLUG.'_'.$cloneid.'_css', $option);
				$file1 = THEME_CACHE_DIR.'/skin_'.$prel.$tobecloned.'.css';
				$file1new = THEME_CACHE_DIR.'/skin_'.$prel.$cloneid.'.css';
				$file2 = THEME_CACHE_DIR.'/cufon_'.$prel.$tobecloned.'.php';
				$file2new = THEME_CACHE_DIR.'/cufon_'.$prel.$cloneid.'.php';
				$file3 = THEME_CACHE_DIR.'/google_'.$prel.$tobecloned.'.php';
				$file3new = THEME_CACHE_DIR.'/google_'.$prel.$cloneid.'.php';
				$file4 = THEME_CACHE_DIR.'/fontface_'.$prel.$tobecloned.'.css';
				$file4new = THEME_CACHE_DIR.'/fontface_'.$prel.$cloneid.'.css';
				$file5 = THEME_CACHE_DIR.'/custom_'.$prel.$tobecloned.'.css';
				$file5new = THEME_CACHE_DIR.'/custom_'.$prel.$cloneid.'.css';
				if(file_exists($file1)){
					copy($file1, $file1new);
				}
				if(file_exists($file2)){
					copy($file2, $file2new);
				}
				if(file_exists($file3)){
						copy($file3, $file3new);
				}
				if(file_exists($file4)){
						copy($file4, $file4new);
				}
				if(file_exists($file5)){
						copy($file5, $file5new);
					}
				$url= 'admin.php?page=wonder-css&layout='.$cloneid;
			?>
			<script language="JavaScript">
				parent.location.href='<?php echo $url;?>';
			</script>
			<?php	
			break;
			case 'clone':
				$messedids=array();
				if(function_exists(ult_ms_getter)){
					$prel = ult_ms_getter();
				}
				$ultimatum_sidebars_widgets = get_option('ultimatum_sidebars_widgets');
				$tobecloned = $_POST["source"];
				$select = "SELECT * FROM $table WHERE `id`='$tobecloned'";
				$sourcelayout = $wpdb->get_row($select,ARRAY_A);
				// Clone it and get its id
				$title = $sourcelayout[title].'(copy)';
				$cloneql = "INSERT INTO $table (`title`,`type`,`before`,`after`,`theme`) VALUES ('$title','$sourcelayout[type]','$sourcelayout[before]','$sourcelayout[after]','$sourcelayout[theme]')";
				$cloneql = $wpdb->query($cloneql);
				$cloneid = $wpdb->insert_id;
				$option = get_option(THEME_SLUG.'_'.$tobecloned.'_css');
				if($option) {
						$newopt = update_option(THEME_SLUG.'_'.$cloneid.'_css', $option);
				}
				$file1 = THEME_CACHE_DIR.'/skin_'.$prel.$tobecloned.'.css';
				$file1new = THEME_CACHE_DIR.'/skin_'.$prel.$cloneid.'.css';
				$file2 = THEME_CACHE_DIR.'/cufon_'.$prel.$tobecloned.'.php';
				$file2new = THEME_CACHE_DIR.'/cufon_'.$prel.$cloneid.'.php';
				$file3 = THEME_CACHE_DIR.'/google_'.$prel.$tobecloned.'.php';
				$file3new = THEME_CACHE_DIR.'/google_'.$prel.$cloneid.'.php';
				$file4 = THEME_CACHE_DIR.'/fontface_'.$prel.$tobecloned.'.css';
				$file4new = THEME_CACHE_DIR.'/fontface_'.$prel.$cloneid.'.css';
				$file5 = THEME_CACHE_DIR.'/custom_'.$prel.$tobecloned.'.css';
				$file5new = THEME_CACHE_DIR.'/custom_'.$prel.$cloneid.'.css';
				if(file_exists($file1)){
					copy($file1, $file1new);
				}
				if(file_exists($file2)){
					copy($file2, $file2new);
				}
				if(file_exists($file3)){
						copy($file3, $file3new);
				}
				if(file_exists($file4)){
						copy($file4, $file4new);
				}
				if(file_exists($file5)){
						copy($file5, $file5new);
					}
				// Do the Rows 
				$rows = explode(',',$sourcelayout["rows"]);
				foreach ($rows as $row){
					$query = "SELECT * FROM $rtable WHERE id=$row";
					$sourcerow = $wpdb->get_row($query,ARRAY_A);
					$rtype = $sourcerow["type_id"];
					$insertrow = "INSERT INTO $rtable (`layout_id`,`type_id`) VALUES ('$cloneid','$rtype')";
					$insertrow = $wpdb->query($insertrow);
					$newrowid = $wpdb->insert_id;
					$newrows[]=$newrowid;
					// DO CSS
					// 1- Wrapper
					$oldw= 'wrapper-'.$row;
					$qw = "SELECT * FROM $ctable WHERE `container`='$oldw' AND `layout_id`='$tobecloned'";
					$qwf = $wpdb->get_row($qw,ARRAY_A);
					$qwsn = "SELECT * FROM $classtable WHERE `container`='$oldw' AND `layout_id`='$tobecloned'";
					$qwsnf = $wpdb->get_row($qwsn,ARRAY_A);
					if($qwf){
					$neww = 'wrapper-'.$newrowid;
					$newwi = "INSERT INTO $ctable (`container`,`layout_id`,`element`,`properties`) VALUES ('$neww','$cloneid','$qwf[element]','$qwf[properties]')";
					$newwi = $wpdb->query($newwi);
					}
					if($qwsnf){
						$neww = 'wrapper-'.$newrowid;
						$newwi = "INSERT INTO $classtable (`container`,`layout_id`,`user_class`,`hidephone`,`hidetablet`,`hidedesktop`) VALUES ('$neww','$cloneid','$qwsnf[user_class]','$qwsnf[hidephone]','$qwsnf[hidetablet]','$qwsnf[hidedesktop]')";
						$newwi = $wpdb->query($newwi);
					}
					
					// 2- Container
					$oldw= 'container-'.$row;
					$qw = "SELECT * FROM $ctable WHERE `container`='$oldw' AND `layout_id`='$tobecloned'";
					$qwf = $wpdb->get_row($qw,ARRAY_A);
					$qwsn = "SELECT * FROM $classtable WHERE `container`='$oldw' AND `layout_id`='$tobecloned'";
					$qwsnf = $wpdb->get_row($qwsn,ARRAY_A);
					if($qwf){
					$neww = 'container-'.$newrowid;
					$newwi = "INSERT INTO $ctable (`container`,`layout_id`,`element`,`properties`) VALUES ('$neww','$cloneid','$qwf[element]','$qwf[properties]')";
					$newwi = $wpdb->query($newwi);
					}
					if($qwsnf){
						$neww = 'container-'.$newrowid;
						$newwi = "INSERT INTO $classtable (`container`,`layout_id`,`user_class`,`hidephone`,`hidetablet`,`hidedesktop`) VALUES ('$neww','$cloneid','$qwsnf[user_class]','$qwsnf[hidephone]','$qwsnf[hidetablet]','$qwsnf[hidedesktop]')";
						$newwi = $wpdb->query($newwi);
					}
					// 3- Columns
					
					global $wp_registered_widgets;
					for($j=1;$j<=5;$j++){
						$oldw= 'col-'.$row.'-'.$j;
						$olds= 'sidebar-'.$row.'-'.$j;
						$neww = 'col-'.$newrowid.'-'.$j;
						$newsb = 'sidebar-'.$newrowid.'-'.$j;
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
										if(isset($messedids[$option])){
											$nextid=$messedids[$option]+1;
											$messedids[$option]= $nextid;
										} else {
											$nextid = next_widget_id_number($id_base);
											$messedids[$option]= $nextid;
										}
										$warray[$nextid] = $warray[$currentwid];
										//print_r($warray);
										update_option($option, $warray);
										$ultimatum_sidebars_widgets[$newsb][]=$id_base.'-'.$nextid;
										update_option('ultimatum_sidebars_widgets',$ultimatum_sidebars_widgets);
										unset($warray);
									}
								}
							
							
							}
						$qw = "SELECT * FROM $ctable WHERE `container`='$oldw' AND `layout_id`='$tobecloned'";
						$qwf = $wpdb->get_row($qw,ARRAY_A);
						$qwsn = "SELECT * FROM $classtable WHERE `container`='$oldw' AND `layout_id`='$tobecloned'";
						$qwsnf = $wpdb->get_row($qwsn,ARRAY_A);
						if($qwf){
							$newwi = "INSERT INTO $ctable (`container`,`layout_id`,`element`,`properties`) VALUES ('$neww','$cloneid','$qwf[element]','$qwf[properties]')";
							$newwi = $wpdb->query($newwi);
						}
						if($qwsnf){
							$newwi = "INSERT INTO $classtable (`container`,`layout_id`,`user_class`,`hidephone`,`hidetablet`,`hidedesktop`) VALUES ('$neww','$cloneid','$qwsnf[user_class]','$qwsnf[hidephone]','$qwsnf[hidetablet]','$qwsnf[hidedesktop]')";
							$newwi = $wpdb->query($newwi);
						}
						
					}
					
				}
				// Insert rows
				$newrow = implode(',',$newrows);
				$update = "UPDATE $table SET `rows`='$newrow' WHERE id='$cloneid'";
				$wpdb->query($update);
				// Generate CSS file
				$query = "SELECT * FROM $ctable WHERE layout_id='$cloneid'";
				$res = $wpdb->get_results($query,ARRAY_A);
				$css='';
				foreach($res as $fetch){
					 if($fetch["element"]=='general'){
					 	if($fetch["container"]!='body'){
					 		if(eregi('col-',$fetch["container"])){
					 			$el = '#'.$fetch["container"].' .colwrapper';
					 		} else {
					 			$el = '#'.$fetch["container"];
					 		}	
					 	}else{
					 	$el = $fetch["container"];
					 	}
					 } elseif($fetch["container"]=='body'){
					 if($fetch["element"]=='h1' || $fetch["element"]=='h2' || $fetch["element"]=='h3' || $fetch["element"]=='h4' || $fetch["element"]=='h5' || $fetch["element"]=='h6'){
					 		$fetch["element"]=$fetch["element"].', '.$fetch["element"].' a,'.$fetch["element"].' a:hover';
					 	}
					 	$el = $fetch["element"];
					 	if($el=='ahover'){$el = 'a:hover'; }
					 	
					 } else {
					 	if($fetch["element"]=='ahover'){$fetch["element"] = 'a:hover'; }
					 	if($fetch["element"]=='h1' || $fetch["element"]=='h2' || $fetch["element"]=='h3' || $fetch["element"]=='h4' || $fetch["element"]=='h5' || $fetch["element"]=='h6'){
					 		//$fetch["element"]=$fetch["element"].', '.$fetch["element"].' a,'.$fetch["element"].' a:hover';
					 		$el = '#'.$fetch["container"].' '.$fetch["element"].', #'.$fetch["container"].' '.$fetch["element"].' a, #'.$fetch["container"].' '.$fetch["element"].' a:hover';
					 	} else {
					 	$el = '#'.$fetch["container"].' '.$fetch["element"];
					 	}
					 }
					 $proprties = parseCSS($fetch["properties"]);
					 if(count($proprties)!=0){
					 $css .= $el.'{'.implode(';',$proprties).'}';
					 }
				}
				if(is_multisite()){
					global $blog_id;
						$file = THEME_CACHE_DIR.'/layout_'.$blog_id.'_'.$cloneid.'.css';
					}else{
						$file = THEME_CACHE_DIR.'/layout_'.$cloneid.'.css';
					}
				$fhandle = @fopen($file, 'w+');
				if ($fhandle) fwrite($fhandle, $css, strlen($css));
					unset($_POST);
		
				$url = curPageURL();
			?>
			<script language="JavaScript">
				parent.location.href='<?php echo $url; ?>';
			</script>
			<?php
			break;
			case 'assign':
				//
				$query = "REPLACE INTO $atable VALUES ('".THEME_CODE."','$_POST[posttype]','$_POST[layout]')";
				$wpdb->query($query);
			break;
			case 'setdefault':
				$query = "UPDATE $table SET `default`=0 WHERE `theme`='$_REQUEST[theme]'";
				$wpdb->query($query);
				$query = "UPDATE $table SET `default`=1 WHERE `id`='$_POST[default]'";
				$wpdb->query($query);
				unset($_POST);
				$url = curPageURL();
			?>
			<script language="JavaScript">
				parent.location.href='<?php echo $url; ?>';
			</script>
			<?php
				
			break;
			default:
				echo '<h3>Illegal operation</h3>';
			break;
		}
	}
	
	$query = "SELECT * FROM $table WHERE `type`='full' AND `theme`='$_REQUEST[theme]' ORDER BY `default` DESC, `title` ASC";
	$result = $wpdb->get_results($query,ARRAY_A);
	$queryp = "SELECT * FROM $table WHERE `type`='part' AND `theme`='$_REQUEST[theme]' ORDER BY `title` ASC";
	$resultp = $wpdb->get_results($queryp,ARRAY_A);
	foreach($result as $layout){
		$full[]=$layout;
		$lid = $layout["id"];
	}
	$next_id=$lid+1;
	?>
	<script langage="JavaScript">
<!--

function confirmSubmit()
{
var agree=confirm("Are you sure you wish to continue?");
if (agree)
	return true ;
else
	return false ;
}
// -->
</script>
	<h2><?php echo _e('Layouts',THEME_ADMIN_LANG_DOMAIN); ?> - <?php themeName($_REQUEST['theme']);?></h2>
<table width="100%">
	<tr valign="top">
		<td rowspan="2">
				<form method="post" action="">
				<table class="widefat" style="height:100%">
					<thead>
						<tr>
							<th colspan="2"><?php _e('Create a new Layout',THEME_ADMIN_LANG_DOMAIN); ?></th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="2">
								<input type="hidden" name="action" value="create_new" />
								
								<input type="submit" value="<?php _e('Save',THEME_ADMIN_LANG_DOMAIN);?>" />
							</td>
						</tr>
					</tfoot>
					<tbody>
						<tr>
							<td nowrap="nowrap"><label><?php _e('Layout Name',THEME_ADMIN_LANG_DOMAIN);?> :</label></td>
							<td><input type="text" name="title" value="<?php _e('Layout Name',THEME_ADMIN_LANG_DOMAIN);?>" /></td>
						</tr>
						<tr>
							<td nowrap="nowrap">
								<label><?php _e('Layout Type',THEME_ADMIN_LANG_DOMAIN);?> :</label>
							</td>
							<td>
							<p><i><strong><?php _e('Full Layouts',THEME_ADMIN_LANG_DOMAIN);?></strong> <?php _e('are the main layouts that you can assign to post types and posts or pages.',THEME_ADMIN_LANG_DOMAIN);?></i></p>
							<p><i><strong><?php _e('Partial Layouts',THEME_ADMIN_LANG_DOMAIN);?></strong> <?php _e('are the layouts that you might want to use more then once. You can include them before or after the main section of a full layout.',THEME_ADMIN_LANG_DOMAIN);?></i></p>
								<select name="type">
									<option value="full"><?php _e('Full',THEME_ADMIN_LANG_DOMAIN);?></option>
									<option value="part"><?php _e('Part',THEME_ADMIN_LANG_DOMAIN);?></option>
								</select>
							</td>
						</tr>
						
					</tbody>
				</table>
				</form>
		</td>
		<td>
			<form method="post" action="">
			<table class="widefat">
					<thead>
						<tr>
							<th colspan="2"><?php _e('Set Default Layout',THEME_ADMIN_LANG_DOMAIN);?></th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="2">
								<input type="hidden" name="action" value="setdefault" />
								<input type="submit" value="<?php _e('Save',THEME_ADMIN_LANG_DOMAIN);?>" />
							</td>
						</tr>
					</tfoot>
					<tbody>
						<tr>
							<td>
								<label><?php _e('Layout',THEME_ADMIN_LANG_DOMAIN);?>:</label>
							</td>
							<td>
								<p><i><?php _e('If no layouts for the requested page/post and their types this layout will be shown',THEME_ADMIN_LANG_DOMAIN);?>.</i></p>
								<select name="default">
									<?php
									if($full){ 
									foreach($full as $layout){
											echo '<option value="'.$layout["id"].'">'.$layout["title"].'</option>';
										}}
									?>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
				</form>
		</td>
	</tr>
	<tr>
		<td>
			<form method="post" action="">
			<table class="widefat">
					<thead>
						<tr>
							<th colspan="2"><?php _e('Assign Layout to Post/Page Types',THEME_ADMIN_LANG_DOMAIN);?></th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="2">
								<input type="hidden" name="action" value="assign" />
								<input type="submit" value="<?php _e('Save',THEME_ADMIN_LANG_DOMAIN);?>" />
							</td>
						</tr>
					</tfoot>
					<tbody>
						<tr>
							<td>
								<label><?php _e('Layout',THEME_ADMIN_LANG_DOMAIN);?>:</label>
							</td>
							<td>
								<p><i><?php _e('If no layouts for the requested page/post this layout will be shown for it',THEME_ADMIN_LANG_DOMAIN);?>.</i></p>
								<select name="layout">
								
									<?php 
									if($full){foreach($full as $layout){
											echo '<option value="'.$layout["id"].'">'.$layout["title"].'</option>';
											
										}}
									?>
								
								</select>
							</td>
						</tr>
						<tr>
							<td nowrap="nowrap">
								<label><?php _e('Post/Page Type',THEME_ADMIN_LANG_DOMAIN);?>:</label>
							</td>
							<td>
								<select name="posttype">
									<optgroup label="Core">
										<option value="search"><?php _e('Search',THEME_ADMIN_LANG_DOMAIN);?></option>
										<option value="404">404</option>
										<option value="author"><?php _e('author',THEME_ADMIN_LANG_DOMAIN);?></option>
									</optgroup>
									<optgroup label="<?php _e('Post Types',THEME_ADMIN_LANG_DOMAIN);?>">
									<option value="page">page</option>
									<?php 
									$args=array('public'   => true,'publicly_queryable' => true);
									$post_types=get_post_types($args,'names');
									foreach ($post_types as $post_type ) {
										if($post_type!='attachment'){
										echo '<option value="'. $post_type. '">'. $post_type. '</option>';
										echo '<option value="'. $post_type. '-single">'. $post_type. '-'.__('single',THEME_ADMIN_LANG_DOMAIN).'</option>';
										}
									}
									echo '</optgroup>';
									$entries = get_categories('title_li=&orderby=name&hide_empty=1');
										if(count($entries)>=1){
											echo '<optgroup label="'.__('Categories (post)',THEME_ADMIN_LANG_DOMAIN).'">';
											foreach ($entries as $key => $entry) {
												echo '<option value="cat-'.$entry->term_id.'" '.'>'.$entry->name.'</option>';
											}
											echo '</optgroup>';
										}
									$termstable = $wpdb->prefix.'ultimatum_tax';
									$termsql = "SELECT * FROM $termstable";
									$termresult = $wpdb->get_results($termsql,ARRAY_A);
									foreach ($termresult as $term){
										$properties = unserialize($term["properties"]);
										echo '<optgroup label="'.$properties["label"].'('.$term["pname"].')">';
										$entries = get_terms($properties["name"],'orderby=name&hide_empty=1');
										foreach($entries as $key => $entry) {
											$optiont= $term["pname"].'-'.$term["tname"].'-'.$entry->slug;
											echo '<option value="'.$optiont.'" '.'>'.$entry->name.'</option>';
											}
										echo '</optgroup>';
									}
									?>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
				</form>			
		</td>
	</tr>
</table>
	<h2><a name="full"><?php _e('Full Layouts',THEME_ADMIN_LANG_DOMAIN);?></a></h2>
	<table class="widefat wp-list-table">
	<thead>
	<tr>
		<th><?php _e('Layout Name',THEME_ADMIN_LANG_DOMAIN);?></th>
		<th><?php _e('Assigned to',THEME_ADMIN_LANG_DOMAIN);?></th>
		<th><?php _e('Actions',THEME_ADMIN_LANG_DOMAIN);?></th>
	</tr>
	</thead>
	<tbody>
	<?php 
	if($full){
	foreach($full as $layout){
		echo '<tr style="height:40px;">';	
		echo '<td style="font-size:14px;">';
		echo '<a href="./admin.php?page=wonder-layout&task=edit&theme='.$_REQUEST['theme'].'&layoutid='.$layout["id"].'">'.$layout["title"].'</a>';
		if($layout['default']=='1'){
			echo '[default] ';
		}		
		echo '</td>';
		echo '<td>';
		$getassigned = "SELECT * FROM $atable WHERE `layout_id`='$layout[id]'";
		$gres =$wpdb->get_results($getassigned,ARRAY_A);
		foreach ($gres as $gfecth){
			if(eregi('cat-',$gfecth["post_type"])){
				$cat = str_replace('cat-', '', $gfecth["post_type"]);
				$thisCat = get_category($cat,false);
				$gfecth["post_type"] = 'posts-'.$thisCat->name;
			
			}
			$posttypes[]=$gfecth["post_type"];
		}
		if(isset($posttypes)){
		foreach($posttypes as $posttyped):
		?>
		<div style="margin-right:10px;height:25px;line-height:25px;padding:5px;background:#d3d3d3;border-radius:4px;width:auto;float:left;">
		<a style="color:red;margin-left:-3px;margin-top:-15px;" href="admin.php?page=wonder-layout&delassigner=<?php echo $posttyped ?>&theme=<?php echo $_REQUEST['theme']; ?>">x</a>
		<?php echo $posttyped;?>
		</div>
		<?php 
		endforeach;
		unset($posttypes);
		}
		echo '</td>';
		echo '<td><p>';
		echo '<a class="button-primary autowidth" href="./admin.php?page=wonder-layout&task=edit&theme='.$_REQUEST['theme'].'&layoutid='.$layout["id"].'">'.__('Edit',THEME_ADMIN_LANG_DOMAIN).'</a>&nbsp;<a class="button-primary autowidth" href="./admin.php?page=wonder-css&&layout='.$layout["id"].'">'.__('Edit CSS',THEME_ADMIN_LANG_DOMAIN).'</a>';
		echo '<form method="post" action=""><input type="hidden" name="action" value="clone"/><input type="hidden" name="source" value="'.$layout["id"].'" /><input type="submit" value="'.__('Clone Layout',THEME_ADMIN_LANG_DOMAIN).'" /></form>';
		echo '<form method="post" action=""><input type="hidden" name="action" value="delete"/><input type="hidden" name="source" value="'.$layout["id"].'" /><input type="submit" value="'.__('Delete Layout',THEME_ADMIN_LANG_DOMAIN).'" onClick="return confirmSubmit()" /></form>';
		echo '</p></td>';
		echo '</tr>';
	}
	}
	?>
	</tbody>
	</table>
	<h2><a name="part"><?php _e('Partial Layouts',THEME_ADMIN_LANG_DOMAIN);?></a></h2>
	<table class="widefat">
	<thead>
	<tr>
		<th><?php _e('Layout Name',THEME_ADMIN_LANG_DOMAIN);?></th>
		<th><?php _e('Actions',THEME_ADMIN_LANG_DOMAIN);?></th>
	</tr>
	</thead>
	<tbody>
	<?php 
	foreach ($resultp as $layout){
		echo '<tr style="height:40px;">';	
		echo '<td style="font-size:14px;">';
		echo '<a href="./admin.php?page=wonder-layout&task=edit&layoutid='.$layout["id"].'">'.$layout["title"].'</a></td>';
		echo '<td>';
		echo '<a class="button-primary autowidth" href="./admin.php?page=wonder-layout&task=edit&theme='.$_REQUEST['theme'].'&layoutid='.$layout["id"].'">'.__('Edit',THEME_ADMIN_LANG_DOMAIN).'</a>';
		echo '<form method="post" action=""><input type="hidden" name="action" value="clone"/><input type="hidden" name="source" value="'.$layout["id"].'" /><input type="submit" value="'.__('Clone Layout',THEME_ADMIN_LANG_DOMAIN).'" /></form>';
		echo '<form method="post" action=""><input type="hidden" name="action" value="delete"/><input type="hidden" name="source" value="'.$layout["id"].'" /><input type="submit" value="'.__('Delete Layout',THEME_ADMIN_LANG_DOMAIN).'" onClick="return confirmSubmit()" /></form>';
		echo'</td>';
		echo '</tr>';
	}
	?>
	</tbody>
	</table>
	<?php
}


function parseCSS($properties){
	$property = unserialize($properties);
	foreach($property as $key=>$value){
		if(strlen($value)!=0){
		if($key=='color' || $key=='background-color' || $key=='border-top-color' || $key=='border-bottom-color' || $key=='border-left-color' || $key=='border-right-color'){
			$css[]=$key.': #'.$value;
		} elseif (eregi('margin',$key) || eregi('padding',$key) || eregi('height',$key) || eregi('size',$key)) {
			 $css[]=$key.': '.$value.'px';
		}elseif ($key=='background-image') {
			$css[]=$key.': url('.$value.')';
		} else { 
		$css[]=$key.':'.$value;
		}
		}
	}
	return $css;
}


function ultimatum_layout_generator() {
	global $wpdb;
	$table = $wpdb->prefix.'ultimatum_layout';
	$tablerows = $wpdb->prefix.'ultimatum_rows';
	require_once('ultimatum-widgets.php');
	$layoutid=$_GET["layoutid"];
	if(isset($_POST["saveandcontinue"]) && $_POST["saveandcontinue"]='no'){
		$before=str_replace('layout-','', $_POST["before"]);
		$after=str_replace('layout-','', $_POST["after"]);
		$rows=str_replace('row-','', $_POST["rows"]);
		$tr = explode(',', $rows);
		foreach ($tr as $t){
			if(strlen($t)>=1){
				$r[]=$t;
			}
		}
		$rows = @implode(',', $r);
		$query = "REPLACE INTO $table (`id`,`title`,`rows`,`before`,`after`,`type`,`default`,`theme`) VALUES ($layoutid,'$_POST[layoutname]','$rows','$before','$after','$_POST[type]','$_POST[default]','$_REQUEST[theme]')";
		$wpdb->query($query);
		
		// Save the CSS
			if(is_multisite()){
			global $blog_id;
				$file = THEME_CACHE_DIR.'/layout_'.$blog_id.'_'.$layoutid.'.css';
			}else{
				$file = THEME_CACHE_DIR.'/layout_'.$layoutid.'.css';
			}
	$csstable = $wpdb->prefix.'ultimatum_css';
	$query = "SELECT * FROM $csstable WHERE layout_id='$layoutid'";
	
	$res = $wpdb->get_results($query,ARRAY_A);
	$css='';
	
	foreach($res as $fetch){
		 if($fetch["element"]=='general'){
		 	if($fetch["container"]!='body'){
		 		if(eregi('col-',$fetch["container"])){
		 			$el = '#'.$fetch["container"].' .colwrapper';
		 		} else {
		 			$el = '#'.$fetch["container"];
		 		}	
		 	}else{
		 	$el = $fetch["container"];
		 	}
		 } elseif($fetch["container"]=='body'){
		 if($fetch["element"]=='h1' || $fetch["element"]=='h2' || $fetch["element"]=='h3' || $fetch["element"]=='h4' || $fetch["element"]=='h5' || $fetch["element"]=='h6'){
		 		$fetch["element"]=$fetch["element"].', '.$fetch["element"].' a,'.$fetch["element"].' a:hover';
		 	}
		 	$el = $fetch["element"];
		 	if($el=='ahover'){$el = 'a:hover'; }
		 	
		 } else {
		 	if($fetch["element"]=='ahover'){$fetch["element"] = 'a:hover'; }
		 	if($fetch["element"]=='h1' || $fetch["element"]=='h2' || $fetch["element"]=='h3' || $fetch["element"]=='h4' || $fetch["element"]=='h5' || $fetch["element"]=='h6'){
		 		//$fetch["element"]=$fetch["element"].', '.$fetch["element"].' a,'.$fetch["element"].' a:hover';
		 		$el = '#'.$fetch["container"].' '.$fetch["element"].', #'.$fetch["container"].' '.$fetch["element"].' a, #'.$fetch["container"].' '.$fetch["element"].' a:hover';
		 	} else {
		 	$el = '#'.$fetch["container"].' '.$fetch["element"];
		 	}
		 }
		 $proprties = parseCSS($fetch["properties"]);
		 
		 
		 if(count($proprties)!=0){
		 	//print_r($proprties);
		 $css .= $el.'{'.@implode(';',$proprties).'}';
		 }
	}
	$fhandle = @fopen($file, 'w+');
	//echo 'test-'.$css;
	if ($fhandle) fwrite($fhandle, $css, strlen($css));
		unset($_POST);
		$url = curPageURL();
		?>
		<script language="JavaScript">
		parent.location.href='<?php echo $url; ?>';
		</script>
		<?php
	}
	$query = "SELECT * FROM $table WHERE `id`='$layoutid'";
	$layout = $wpdb->get_row($query,ARRAY_A);
?>
<h2><?php echo esc_html( 'Layout Creator/Editor' ); ?></h2>
<p><a href="admin.php?page=wonder-layout&theme=<?php echo $layout[theme];?>"><?php _e("Back to layouts screen",THEME_ADMIN_LANG_DOMAIN );?></a></p>
<table class="widefat ultimatum-layout-top" width="100%">
	<tr>
		<td>
			<form action="" method="post" id="layout-form">
				<label for="layout-name"><strong><?php _e('Layout Name',THEME_ADMIN_LANG_DOMAIN);?>: </strong></label><input type="text" name="layoutname" value="<?php echo $layout["title"];?>" size="50" /><br />
				<?php if($layout["type"]=='full'){?>
				<h3><?php _e('Include Partial Layouts',THEME_ADMIN_LANG_DOMAIN);?></h3>
				<i><?php _e('You can drag and drop the partial layouts you want to use above or below your layout',THEME_ADMIN_LANG_DOMAIN);?>.</i>
				<table width="100%">
				<tr valign="top">
				<td width="33%" style="border:none">
				<table class="widefat">
				<tr><th><?php _e('Available Parts',THEME_ADMIN_LANG_DOMAIN);?></th></tr>
				<tr><td>
				<ul id="parts" class="connectedSortable" style="min-height:30px"> 
				<?php printPartial($layout);?>				       
				</ul>
				</td></tr>
				</table>
				</td>
				<td width="33%" style="border:none">
				<table class="widefat">
				<tr><th><?php _e('Above Layout Body',THEME_ADMIN_LANG_DOMAIN);?></th></tr>
				<tr><td>
				<ul id="before" class="connectedSortable" style="min-height:30px;">
				<?php printParts($layout,'before');?>  
			    </ul>
			    </td></tr>
				</table>
				</td>
				<td width="33%" style="border:none">
				<table class="widefat">
				<tr><th><?php _e('Below Layout Body',THEME_ADMIN_LANG_DOMAIN);?></th></tr>
				<tr><td>
				<ul id="after" class="connectedSortable" style="min-height:30px;">
				<?php printParts($layout,'after');?>  
			    </ul>
			    </td></tr>
				</table>  
				</td>
				</tr>
				</table>
				<?php echo '<a class="button-primary autowidth" href="./admin.php?page=wonder-css&layout='.$layout["id"].'">'.__('Edit CSS',THEME_ADMIN_LANG_DOMAIN).'</a>'; ?>
				<?php } ?>
				<a class="button-primary autowidth thickbox"  href="<?php echo THEME_ADMIN_URI; ?>/interfaces/wonder-layout/row-layouts.php?layout_id=<?php echo $_GET["layoutid"];?>&TB_iframe=1&width=770&height=480" title="<?php _e('Click on row style you want to insert and then click insert button',THEME_ADMIN_LANG_DOMAIN);?>"><?php _e('Insert Row',THEME_ADMIN_LANG_DOMAIN);?></a>
				<input type="hidden" name="rows" id="layout_row_ids" value="<?php echo $layout["rows"];?>"/>
				<input type="hidden" name="before" id="before_main" value="<?php echo $layout["before"];?>"/>
				<input type="hidden" name="after" id="after_main" value="<?php echo $layout["after"];?>"/>
				<input type="hidden" name="type" value="<?php echo $layout['type'];?>" />
				<input type="hidden" name="default" value="<?php echo $layout['default'];?>" />
				<input type="hidden" name="theme" value="<?php echo $layout['theme'];?>" />
				<input type="hidden" name="saveandcontinue" value="no" />
				<input class="button-primary autowidth" type="submit" value="<?php _e('Save Layout',THEME_ADMIN_LANG_DOMAIN);?>"/>
			</form>
		</td>
	</tr>
	</table>
	<h2><?php _e('The Layout Body',THEME_ADMIN_LANG_DOMAIN);?></h2>
			<?php if($layoutid){?>
				<div class="widget-liquid-left">
					<div id="widgets-right" >
					<ul id="sortables"> 
					<?php
					$rows = explode(',',$layout["rows"]);
					foreach ($rows as $row_id){
					$query = "SELECT * FROM $tablerows WHERE id='$row_id'";
					$row = $wpdb->get_row($query,ARRAY_A);
					include (THEME_ADMIN.'/ajax/row-generator.php');
					}
					?>
					</ul>
						
					</div>
				</div>
				<div class="widget-liquid-right">
				<div id="widgets-left">
					<div id="available-widgets" class="widgets-holder-wrap">
						<div class="sidebar-name">
						<div class="sidebar-name-arrow"><br /></div>
						<h3><?php _e('Elements',THEME_ADMIN_LANG_DOMAIN);?> <span id="removing-widget"><?php _ex('Deactivate', 'removing-widget'); ?> <span></span></span></h3></div>
						<div class="widget-holder">
						<div id="widget-list">
						<?php ultimatum_list_widgets(); ?>
						</div>
						<br class='clear' />
						</div>
						<br class="clear" />
					</div>
				</div>
				</div>
				
				
				<br class="clear" />
				<form action="" method="post">
				<?php wp_nonce_field( 'save-sidebar-widgets', '_wpnonce_widgets', false ); ?>
				</form>
				<?php } ?>

<?php }

function curPageURL() {
 $pageURL =$_SERVER["REQUEST_URI"];
 
 return $pageURL;
}

function printPartial($layout){
	global $wpdb;
	$table = $wpdb->prefix.'ultimatum_layout';
	$partsb = explode(',',$layout["before"]);
	$partsa = explode(',',$layout["after"]);
	$resultarray = array_merge($partsb, $partsa);
	$resultant = implode(',',$resultarray);
	$query = "SELECT * FROM $table WHERE `type`='part' AND `theme`='$layout[theme]'";
	if($resultant!=','){
		if(substr($resultant,-1)==','){
			$resultant = substr($resultant,0,-1);
		}
		if(substr($resultant,0,1)==','){
			$resultant = substr($resultant,1);
		}
		$query.=" AND `id` NOT IN ($resultant)";
	}
	//echo $query;
	$result = $wpdb->get_results($query,ARRAY_A);
	foreach ($result as $fetch){
		echo '<li id="layout-'.$fetch["id"].'"><div class="sdrag"></div>'.$fetch["title"].'</li>';
	}	
	
}

function printParts($layout,$place){
	global $wpdb;
	$table = $wpdb->prefix.'ultimatum_layout';
	$parts = explode(',',$layout[$place]);
	foreach ($parts as $part){
		$query = "SELECT * FROM $table WHERE `type`='part' AND `id`='$part' AND `theme`='$layout[theme]'";
		$result = $wpdb->get_results($query,ARRAY_A);
		foreach ($result as $fetch){
			echo '<li id="layout-'.$fetch[id].'"><div class="sdrag"></div>'.$fetch[title].'</li>';
		}
	}
}
function ultimatum_list_widgets() {
	global $wp_registered_widgets, $sidebars_widgets, $wp_registered_widget_controls;
	$sort = $wp_registered_widgets;
	usort( $sort, '_sort_name_callback_ultimatum' );
	$done = array();
	foreach ( $sort as $widget ) {
		if ( in_array( $widget['callback'], $done, true ) ) // We already showed this multi-widget
			continue;
		$sidebar = is_active_widget( $widget['callback'], $widget['id'], false, false );
		$done[] = $widget['callback'];
		if ( ! isset( $widget['params'][0] ) )
			$widget['params'][0] = array();
		$args = array( 'widget_id' => $widget['id'], 'widget_name' => $widget['name'], '_display' => 'template' );
		if ( isset($wp_registered_widget_controls[$widget['id']]['id_base']) && isset($widget['params'][0]['number']) ) {
			$id_base = $wp_registered_widget_controls[$widget['id']]['id_base'];
			$args['_temp_id'] = "$id_base-__i__";
			$args['_multi_num'] = next_widget_id_number($id_base);
			$args['_add'] = 'multi';
		} else {
			$args['_add'] = 'single';
			if ( $sidebar )
				$args['_hide'] = '1';
		}
		$args = wp_list_widget_controls_dynamic_sidebar( array( 0 => $args, 1 => $widget['params'][0] ) );
		
		call_user_func_array( 'wp_widget_control', $args );
	}
}
function _sort_name_callback_ultimatum( $a, $b ) {
	return strnatcasecmp( $b['name'], $a['name'] );
}

function themeName($id){
	global $wpdb;
	$table = $wpdb->prefix.'ultimatum_themes';
	$sql = "SELECT * FROM $table WHERE  `id`='$id'";
	$theme = $wpdb->get_row($sql,ARRAY_A);
	echo $theme['name'];
}
?>