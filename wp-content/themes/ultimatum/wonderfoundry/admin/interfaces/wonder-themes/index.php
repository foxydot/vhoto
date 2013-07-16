<?php
add_action('init','udefaultscreen_scripts');
add_action('init','udefaultscreen_styles');
function udefaultscreen_styles(){
	wp_enqueue_style('thickbox');
}
function udefaultscreen_scripts(){
	wp_enqueue_script('jquery');
	wp_enqueue_script('thickbox');
}
	
	
function ultimatum_themes(){
	screen_icon(); 
	echo '<div class="wrap">';
	if(isset($_REQUEST['task'])){
		$task = $_REQUEST['task'];
	} else {
		$task=false;
	}
	switch ($task){
		default:
			themesMainScreen();
		break;
		case 'delete':
			deleteTheme();
		break;
		case 'export':
			exportTheme();
		break;
		case 'import':
			importTheme();
		break;
		case 'edit':
			editTheme();
		break;
		case 'default':
			makeDefault();
		break;
		case 'mobileass':
			mobileAssign();
		break;
	}
	echo '</div>'; 
	}
function curPageURL() {
 $pageURL = $_SERVER["REQUEST_URI"];
 return $pageURL;
}

function themesMainScreen(){
	echo '<h2>';
	_e('Ultimatum Templates',THEME_ADMIN_LANG_DOMAIN);
	echo '</h2>';
	global $wpdb;
	$table = $wpdb->prefix.'ultimatum_themes';
	$sql = "SELECT * FROM $table WHERE `template`='".THEME_CODE."'";
	$result = $wpdb->get_results($sql,ARRAY_A);
	$ltable = $wpdb->prefix.'ultimatum_layout';
	?>
	
	<table class="widefat">
	<thead>
	<tr><th>
	<?php _e('Default Template',THEME_ADMIN_LANG_DOMAIN);?>
	</th></tr>
	</thead>
	<tbody>
	<tr>
	<td><i><?php _e('Default layout of default template will be used when there are no layouts assigned to your front-end page. So you have to have one default template with a default layout to prevent unneeded issues.',THEME_ADMIN_LANG_DOMAIN);?></i></td>
	</tr>
	<?php 
	$defsql = "SELECT * FROM $table WHERE `published`=1 AND `template`='".THEME_CODE."'";
	$deftheme = $wpdb->get_row($defsql,ARRAY_A);
	if($deftheme){
	?>
	<tr>
	<td><?php _e('Your Default Template is ',THEME_ADMIN_LANG_DOMAIN ); ?>:<?php echo $deftheme['name']; ?></td>
	</tr>
	<?php 
	$deflsql = "SELECT * FROM $ltable WHERE `default`=1 AND `theme`='$deftheme[id]'";
	$deflayout = $wpdb->get_row($deflsql,ARRAY_A);
	if($deflayout){
	?>
	<tr>
	<td><?php _e('Your Default Layout is ',THEME_ADMIN_LANG_DOMAIN ); ?>:<?php echo $deflayout['title']; ?></td>
	</tr>
	<?php 
	} else {
		?>
		<tr><td><h3 style="color:red"><?php _e('WARNING YOU DONT SEEM TO HAVE A DEFAULT LAYOUT',THEME_ADMIN_LANG_DOMAIN);?></h3></td></tr>
		<?php
	}
	} else {
		?>
		<tr><td><h3 style="color:red"><?php _e('WARNING YOU DONT SEEM TO HAVE A DEFAULT TEMPLATE',THEME_ADMIN_LANG_DOMAIN);?></h3></td></tr>
		<?php 
	}
	?>
	</tbody>
	</table>
	<h3><?php _e('Create a New Template',THEME_ADMIN_LANG_DOMAIN);?></h3>
	<form action="" method="post">
	<table class="widefat">
	<tr>
		<td><?php _e('Theme Name ',THEME_ADMIN_LANG_DOMAIN); ?>: </td>
		<td><input type="text" name="name" value="Your New Template" /></td>
	</tr>
	<tr>
		<td><?php _e('Theme Width ',THEME_ADMIN_LANG_DOMAIN); ?>: </td>
		<td><input type="text" name="width" value="960" />px</td>
	</tr>
	<tr>
		<td><?php _e('Margins Between Columns ',THEME_ADMIN_LANG_DOMAIN); ?>: </td>
		<td><input type="text" name="margin" value="20" />px</td>
	</tr>
	<tr>
		<td><?php _e('Template Type',THEME_ADMIN_LANG_DOMAIN); ?>: </td>
		<td>
		<?php _e('Regular',THEME_ADMIN_LANG_DOMAIN); ?><input type="radio" name="type" value="0"  checked="checked" />
		<?php _e('Responsive',THEME_ADMIN_LANG_DOMAIN); ?><input type="radio" name="type" value="1" />
		<?php if(function_exists(exportTheme)) {?>
		<?php _e('Mobile Web App',THEME_ADMIN_LANG_DOMAIN); ?><input type="radio" name="type" value="2" />
		<?php  } ?>
		</td>
	</tr>
	<tr>
		<td><?php _e('Developer ',THEME_ADMIN_LANG_DOMAIN); ?>: </td>
		<td><input type="text" name="details[developer]" value="" /></td>
	</tr>
	<tr>
		<td><?php _e('Description ',THEME_ADMIN_LANG_DOMAIN); ?>: </td>
		<td><textarea name="details[description]"></textarea></td>
	</tr>
	<tr>
		<td colspan="2"><input type="hidden" name="task" value="edit" /><input type="hidden" name="theme" value="<?php echo $theme['id'];?>" /><input type="submit" class="button-primary" value="save" /></td>
	</tr>
	
	</table>
	</form>
	<h3><?php _e('Import a Template',THEME_ADMIN_LANG_DOMAIN);?></h3>
	<form action="" method="post"  enctype="multipart/form-data">
	<table class="widefat">
	<tr>
		<td><input type="file" name="importer" /></td>
		<td>
		<select name="assigners">
		<option value="donot"><?php _e('Do not import layout assignments','ultimatum_admin');?></option>
		<option value="assign"><?php _e('Import layout assignments','ultimatum_admin');?></option>
		</select>
		</td>
		<td ><input type="hidden" name="task" value="import" /><input type="submit" class="button-primary" value="save" /></td>
	</tr>
	</table>
	</form>
	<h3><?php _e('Available Templates',THEME_ADMIN_LANG_DOMAIN);?></h3>
	<table class="widefat">
	<thead>
	<tr>
		<th><?php _e('Template',THEME_ADMIN_LANG_DOMAIN);?></th>
		<th><?php _e('Actions',THEME_ADMIN_LANG_DOMAIN);?></th>
		<th><?php _e('Layouts',THEME_ADMIN_LANG_DOMAIN);?></th>
	</tr>
	</thead>
	<tbody>
	<?php 
	foreach($result as $theme){
		echo '<tr style="height:40px;">';	
		echo '<td style="font-size:14px;">';
		echo '<a href="./admin.php?page=wonder-layout&theme='.$theme['id'].'">'.$theme['name'].'</a></td>';
		?>
		<td>
		<form method="post" action="">
		<select name="task">
		<option value="default"><?php _e('Make Default',THEME_ADMIN_LANG_DOMAIN)?></option>
		<option value="edit"><?php _e('Edit Template',THEME_ADMIN_LANG_DOMAIN)?></option>
		<?php if(function_exists(exportTheme)) {?>
		<option value="export"><?php _e('Export Template',THEME_ADMIN_LANG_DOMAIN)?></option>
		<?php } ?>
		<option value="delete"><?php _e('Delete Template',THEME_ADMIN_LANG_DOMAIN)?></option>
		</select>
		<input type="hidden" name="theme" value="<?php echo $theme['id'];?>" />
		<input type="submit" value="Submit" class="button-primary" />
		</form>
		</td>
		<?php 
		echo '<td>';
		echo '<a class="button-primary autowidth" href="./admin.php?page=wonder-layout&theme='.$theme['id'].'">'.__('Layouts',THEME_ADMIN_LANG_DOMAIN).'</a>';
		echo'</td>';
		echo '</tr>';
	}
	?>
	</tbody>
	</table>
	<p>
	</p>
	<?php if(function_exists(exportTheme)) {?>
	<h3><?php _e('Mobile Web Apps per Device',THEME_ADMIN_LANG_DOMAIN);?></h3>
	<table class="widefat">
	<?php global $wpdb;
	$mtable = $wpdb->prefix.'ultimatum_mobile';
	$sql = "SELECT * FROM `$mtable` ";
	$mres = $wpdb->get_results($sql,ARRAY_A);
	foreach( $mres as $device){
		?>
		<tr><th><?php echo $device['device']; ?></th>
		<?php 
		
			echo '<td>';
			echo '<form action"" method="post"><select name="theme">';
			echo '<option value="0">'.__('Select',THEME_ADMIN_LANG_DOMAIN).'</option>';
			$table = $wpdb->prefix."ultimatum_themes WHERE type=2 AND `template`='".THEME_CODE."'";
			$sql = "SELECT * FROM $table";
			$result = $wpdb->get_results($sql,ARRAY_A);
			foreach( $result as $theme){
				if($device['theme']==$theme['id']){
					echo '<option value="'.$theme['id'].'" selected="selected">'.$theme['name'].'</option>';
				} else {
					echo '<option value="'.$theme['id'].'">'.$theme['name'].'</option>';
				}
			}
			echo '</select>
			<input type="hidden" name="device" value="'.$device['id'].'" />
			<input type="hidden" name="task" value="mobileass" />
			<input type="submit" value="Save" class="button-primary" />
			</form></td></tr>';
		
	}
	
	?>
	
	
	</table>
	
	<?php
	} 
}
function mobileAssign(){
	global $wpdb;
	$table = $wpdb->prefix.'ultimatum_mobile';
	$sql2 = "UPDATE $table SET `theme`='$_POST[theme]' WHERE id='$_REQUEST[device]'";
	$wpdb->query($sql2);
	$url = curPageURL();
	?>
<script language="JavaScript">
parent.location.href='<?php echo $url; ?>';
</script>
<?php
}
function makeDefault(){
	global $wpdb;
	$table = $wpdb->prefix.'ultimatum_themes';
	$sql1 = "UPDATE $table SET published=0 WHERE `template`='".THEME_CODE."'";
	$wpdb->query($sql1);
	$sql2 = "UPDATE $table SET published=1 WHERE id='$_REQUEST[theme]'";
	$wpdb->query($sql2);
	$url = curPageURL();
			?>
			<script language="JavaScript">
				parent.location.href='<?php echo $url; ?>';
			</script>
			<?php
}

function editTheme(){
	global $wpdb;
	$table = $wpdb->prefix.'ultimatum_themes';
	if($_POST["name"]){
		$details = serialize($_POST['details']);
		if(!isset($_POST["theme"])){
			$sql = "INSERT INTO $table (`name`, `details`,`browsers`,`width`,`margin`,`type`,`published`,`template) VALUES ('$_POST[name]','$details','','$_POST[width]','$_POST[margin]','$_POST[type]','$_POST[published]'`,'".THEME_CODE."')";
		} else {
			$sql = "REPLACE INTO $table VALUES ('$_POST[theme]','$_POST[name]','$details','','$_POST[width]','$_POST[margin]','$_POST[type]','$_POST[published]','".THEME_CODE."')";
			$filename = THEME_CACHE_DIR.'/grid_'.$_POST["theme"].'.css';
			if(file_exists($filename)){
				unlink($filename);
			}
		}
		$wpdb->query($sql);
		$url = curPageURL();
			?>
			<script language="JavaScript">
				parent.location.href='<?php echo $url; ?>';
			</script>
			<?php
		
	}
	if($_REQUEST['theme']){
		
		$sql = "SELECT * FROM $table WHERE `id`='$_REQUEST[theme]'";
		$theme = $wpdb->get_row($sql,ARRAY_A);
		$details = unserialize($theme['details']);
	}
	
	?>
	<h2><?php _e('Template Details',THEME_ADMIN_LANG_DOMAIN); ?></h2>
	<p><a href="admin.php?page=wonder-themes"><?php _e('Templates',THEME_ADMIN_LANG_DOMAIN);?></a>-><?php _e('Edit Template',THEME_ADMIN_LANG_DOMAIN); ?>
	<form action="" method="post">
	<table class="widefat">
	<tr>
		<td><?php _e('Theme Name ',THEME_ADMIN_LANG_DOMAIN); ?>: </td>
		<td><input type="text" name="name" value="<?php echo $theme['name'];?>" /></td>
	</tr>
	<tr>
		<td><?php _e('Theme Width ',THEME_ADMIN_LANG_DOMAIN); ?>: </td>
		<td><input type="text" name="width" value="<?php echo $theme['width'];?>" />px</td>
	</tr>
	<tr>
		<td><?php _e('Margins Between Columns ',THEME_ADMIN_LANG_DOMAIN); ?>: </td>
		<td><input type="text" name="margin" value="<?php echo $theme['margin'];?>" />px</td>
	</tr>
	<tr>
		<td><?php _e('Template Type',THEME_ADMIN_LANG_DOMAIN); ?>: </td>
		<td>
		<?php _e('Regular',THEME_ADMIN_LANG_DOMAIN); ?><input type="radio" name="type" value="0" <?php if($theme['type']==0){ echo ' checked="checked"'; }?>/>
		<?php _e('Responsive',THEME_ADMIN_LANG_DOMAIN); ?><input type="radio" name="type" value="1" <?php if($theme['type']==1){ echo ' checked="checked"'; }?>/>
		<?php if(function_exists(exportTheme)) {?>
		<?php _e('Mobile Web App',THEME_ADMIN_LANG_DOMAIN); ?><input type="radio" name="type" value="2" <?php if($theme['type']==2){ echo ' checked="checked"'; }?>/>
		<?php } ?>
		</td>
	</tr>
	<tr>
		<td><?php _e('Developer ',THEME_ADMIN_LANG_DOMAIN); ?>: </td>
		<td><input type="text" name="details[developer]" value="<?php echo $details['developer'];?>" /></td>
	</tr>
	<tr>
		<td><?php _e('Description ',THEME_ADMIN_LANG_DOMAIN); ?>: </td>
		<td><textarea name="details[description]"><?php echo $details['description'];?></textarea></td>
	</tr>
	<tr>
		<td colspan="2">
		<?php if($theme['published']==1){ ?>
		<input type="hidden" name="published" value="1" />
		<?php } ?>
		<input type="hidden" name="task" value="edit" />
		<input type="hidden" name="theme" value="<?php echo $theme['id'];?>" />
		<input type="submit" class="button-primary" value="save" /></td>
	</tr>
	
	</table>
	</form>
	<?php 
}



function importTheme(){
	WP_Filesystem();
	$messedids=array();
	global $wpdb;
	if(is_multisite()){
		global $blog_id;
		$prel=$blog_id.'_';
		
	}else{
		$prel='';
	}
	move_uploaded_file($_FILES["importer"]["tmp_name"], THEME_CACHE_DIR."/" . $_FILES["importer"]["name"]);
    $nfile = THEME_CACHE_DIR."/" . $_FILES["importer"]["name"];
    $unzipit = unzip_file($nfile, THEME_CACHE_DIR.'/'.str_replace('.zip', '', $_FILES["importer"]["name"]));
    $file = THEME_CACHE_DIR."/" . str_replace('.zip', '', $_FILES["importer"]["name"]).'/export.utx';
   
    $raw_content = file_get_contents($file);
    $content = base64_decode($raw_content);
    $theme = unserialize($content);
   /*echo '<pre>';
    print_r($theme);
    echo "</pre>";
    die();*/
    // Do Images
    if(is_array($theme['images'])){
    $images = $theme['images'];
    foreach($images as $image){
    	$imagespath = THEME_CACHE_DIR.'/'.$prel.$theme['name'];
    	$imagesurlpath = THEME_CACHE_URI.'/'.$prel.$theme['name'];
    	
    		$imagefilename = basename($image['name']);
    		$imagefile = $imagespath.'/'.$imagefilename;
    		
			if (is_file($imagefile)){
				$newimage= $imagesurlpath.'/'.$imagefilename;
				$theme = replaceTree($image['name'],$newimage,$theme);
			}
    	
    } // Images Done
    }
	// Create the Theme
	$table = $wpdb->prefix.'ultimatum_themes';
	$ltable = $wpdb->prefix.'ultimatum_layout';
	$atable = $wpdb->prefix.'ultimatum_layout_assign';
	$rtable = $wpdb->prefix.'ultimatum_rows';
	$ctable = $wpdb->prefix.'ultimatum_css';
	$classtable = $wpdb->prefix.'ultimatum_classes';
	$themesql = "INSERT INTO $table (`name`, `details`,`browsers`,`width`,`margin`,`type`,`published`,`template`) VALUES ('$theme[name]','$theme[details]','','$theme[width]','$theme[margin]','$theme[type]','$theme[published]','".THEME_CODE."')";
	$wpdb->query($themesql);
	$themeid = $wpdb->insert_id;
	foreach($theme['layouts'] as $layout){
		if($layout['type']=='part'){
			$layoutsql = "INSERT INTO $ltable  (`title`,`type`,`theme`,`default`) VALUES ('$layout[name]','$layout[type]','$themeid','$layout[default]')";
			$wpdb->query($layoutsql);
			$layoutid = $wpdb->insert_id;
			$old_lay_id=$layout['oldid'];
			$partconv[$old_lay_id]=$layoutid;
		} else {
			$new_parts_before=array();
			$lbefore='';
			if($layout['before']){
				$old_parts_before=explode(',',$layout['before']);
				foreach($old_parts_before as $p_b){
					$new_parts_before[]=$partconv[$p_b];
				}
				$lbefore = implode(',', $new_parts_before);
			}
			$new_parts_after=array();
			$lafter='';
			if($layout['after']){
				$old_parts_after=explode(',',$layout['after']);
				foreach($old_parts_after as $p_b){
					$new_parts_after[]=$partconv[$p_b];
				}
				$lafter = implode(',', $new_parts_after);
			}
			$layoutsql = "INSERT INTO $ltable  (`title`,`type`,`theme`,`default`,`before`,`after`) VALUES ('$layout[name]','$layout[type]','$themeid','$layout[default]','$lbefore','$lafter')";
			$wpdb->query($layoutsql);
			$layoutid = $wpdb->insert_id;
			if($_POST['assigners']=='assign'){
				if(count($layout['assigned'])!=0){
					foreach ($layout['assigned'] as $assignemnt){
						$query = "REPLACE INTO $atable VALUES ('".THEME_CODE."','$assignemnt','$layoutid')";
						$wpdb->query($query);
					}
				}
			}
		}
		// Insert Layout CSS in WP Options and Generate file
		if($layout['type']=='full'){
			$optionname = THEME_CODE.'_'.$layoutid.'_css';
			update_option($optionname,$layout['css']);
		    createCSS($layoutid,$prel,$layout['css']);
		// Create Custom CSS file
			if(strlen($layout['custom_css'])>0){
				$file = THEME_CACHE_DIR.'/custom_'.$prel.$layoutid.'.css';
				if(file_exists($file)){
						unlink($file);
					}
				$fhandle = @fopen($file, 'w+');
				if ($fhandle) fwrite($fhandle, $layout['custom_css'], strlen($layout['custom_css']));
			}
		}
		// Do the ROWS
		$rows = $layout['rows'];
		foreach ($rows as $row){
			// Insert the row and get id
			$rowsql = "INSERT INTO $rtable (`layout_id`, `type_id`) VALUES ('$layoutid','$row[type]')";
			$wpdb->query($rowsql);
			$rowid = $wpdb->insert_id;
			$layoutrows[]=$rowid;
			// Insert row wrapper CSS
			$wrapper = 'wrapper-'.$rowid;
		foreach($row['wrapper'] as $element=>$property){
				if($element!='custom_classes'){
					$properties = serialize($property);
					$wrappersql = "INSERT INTO $ctable VALUES ('','$wrapper','$layoutid','$element','$properties')";
					$wpdb->query($wrappersql);
				} else {
					$properties = unserialize($property);
					if(count($properties)!=0):
					$classql = "REPLACE INTO $classtable (`container`,`user_class`,`hidephone`,`hidetablet`,`hidedesktop`,`layout_id`) VALUES ('$wrapper','".$properties["user_class"]."','".$properties["hidephone"]."','".$properties["hidetablet"]."','".$properties["hidedesktop"]."','".$properties["layout_id"]."')";
					$wpdb->query($classql);
					endif;
				}
			}
			// Insert row container CSS
			$container = 'container-'.$rowid;
			foreach($row['container'] as $element=>$property){
				if($element!='custom_classes'){
					$properties = serialize($property);
					$containersql = "INSERT INTO $ctable VALUES ('','$container','$layoutid','$element','$properties')";
					$wpdb->query($containersql);
				} else {
					$properties = unserialize($property);
					if(count($properties)!=0):
					$classql = "REPLACE INTO $classtable (`container`,`user_class`,`hidephone`,`hidetablet`,`hidedesktop`,`layout_id`) VALUES ('$container','".$properties["user_class"]."','".$properties["hidephone"]."','".$properties["hidetablet"]."','".$properties["hidedesktop"]."','".$properties["layout_id"]."')";
					$wpdb->query($classql);
					endif;
				}
			}
			// Insert row Column CSS
			foreach ($row['col'] as $colid=>$colcss){
				$column = 'col-'.$layoutid.'-'.$colid;
				foreach ($colcss as $element=>$property){
					if($element!='custom_classes'){
						$properties = serialize($property);
						$colsql = "INSERT INTO $ctable VALUES ('','$column','$layoutid','$element','$properties')";
						$wpdb->query($colsql);
					} else {
						$properties = unserialize($property);
						if(count($properties)!=0):
						$classql = "REPLACE INTO $classtable (`container`,`user_class`,`hidephone`,`hidetablet`,`hidedesktop`,`layout_id`) VALUES ('$column','".$properties["user_class"]."','".$properties["hidephone"]."','".$properties["hidetablet"]."','".$property["hidedesktop"]."','".$properties["layout_id"]."')";
						$wpdb->query($classql);
						endif;
					}
				}
			}
			//Import the widgets
			foreach($row["widgets"] as $sidebar=>$widgets){
				foreach($widgets as $widget){
				$option = $widget['widget_name'];
				$id_base=$widget['id_base'];
				if(isset($messedids[$option])){
					$nextid=$messedids[$option]+1;
					$messedids[$option]= $nextid;
				} else {
					$nextid = next_widget_id_number($widget['id_base']);
					$messedids[$option]= $nextid;
				}
				$warray = get_option($option);
				unset($widget['widget_name']);
				unset($widget['id_base']);
				$warray[$nextid] = $widget;
				update_option($option, $warray);
				$ultimatum_sidebars_widgets = get_option('ultimatum_sidebars_widgets');
				$ultimatum_sidebars_widgets['sidebar-'.$rowid.'-'.$sidebar][]=$id_base.'-'.$nextid;
				update_option('ultimatum_sidebars_widgets',$ultimatum_sidebars_widgets);
				unset($warray);
				
				}
			}
			
			// Widget import Done :)
					
		}
		// GENERATE Layout specific CSS
		// Save the CSS
			$file = THEME_CACHE_DIR.'/layout_'.$prel.$layoutid.'.css';
			$query = "SELECT * FROM $ctable WHERE layout_id='$layoutid'";
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
				 		//$fetch[element]=$fetch[element].', '.$fetch[element].' a,'.$fetch[element].' a:hover';
				 		$el = '#'.$fetch["container"].' '.$fetch["element"].', #'.$fetch["container"].' '.$fetch["element"].' a, #'.$fetch["container"].' '.$fetch["element"].' a:hover';
				 	} else {
				 	$el = '#'.$fetch["container"].' '.$fetch["element"];
				 	}
				 }
				 $proprties = parseCSS($fetch["properties"]);
				 if(count($proprties)!=0){
				 $css .= $el.'{'.@implode(';',$proprties).'}';
				 }
			}
			if(strlen($css)!=0){
			$fhandle = @fopen($file, 'w+');
			if ($fhandle) fwrite($fhandle, $css, strlen($css));
			}
			$rowss = implode(',', $layoutrows);
			unset($layoutrows);
		$layoutupdatesql = "UPDATE $ltable SET `rows`='$rowss' WHERE `id`='$layoutid'";
		$wpdb->query($layoutupdatesql);
	}// layouts foreach finish
	$file = THEME_CACHE_DIR."/" . $_FILES["importer"]["name"];
	unlink($file);
 	echo 'Import Successfull';
 	$url = curPageURL();
			
}

/**
 * Recursive alternative to str_replace that supports replacing keys as well
 *
 * @param string  $search
 * @param string  $replace
 * @param array   $array
 * @param boolean $keys_too
 *
 * @return array
 */
function replaceTree($search="", $replace="", $array=false, $keys_too=false)
{
  if (!is_array($array)) {
    // Regular replace
    return str_replace($search, $replace, $array);
  }
 
  $newArr = array();
  foreach ($array as $k=>$v) {
    // Replace keys as well?
    $add_key = $k;
    if ($keys_too) {
      $add_key = str_replace($search, $replace, $k);
    }
 
    // Recurse
    $newArr[$add_key] = replaceTree($search, $replace, $v, $keys_too);
  }
  return $newArr;
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
			$css[]=$key.": url('".$value."')";
		} else { 
		$css[]=$key.':'.$value;
		}
		}
	}
	return $css;
}
function createCSS($layoutid,$prel,$css){
if (is_writable(THEME_CACHE_DIR)) {
			$file = THEME_CACHE_DIR.'/skin_'.$prel.$layoutid.'.css';
			$fhandle = @fopen($file, 'w+');
			$post = $css;
             foreach($post as $el=>$values){
            	$cssvar = array(
				"cssvar1" => "body",
				"cssvar2" => "#logo-container",
				"cssvar3" => "h1, h1 a, h1 a:hover, h1 a:visited",
				"cssvar4" => "h2, h2 a, h2 a:hover, h2 a:visited",
				"cssvar5" => "h3, h3 a, h3 a:hover, h3 a:visited",
				"cssvar6" => "h4, h4 a, h4 a:hover, h4 a:visited",
				"cssvar7" => "h5, h5 a, h5 a:hover, h5 a:visited",
				"cssvar8" => "h6, h6 a, h6 a:hover, h6 a:visited",
				"cssvar9" => "a",
				"cssvar10" => "a:hover",
				"cssvar11" => "h1.multi-post-title, h1.multi-post-title a, h1.multi-post-title a:hover, h1.multi-post-title a:visited",
				"cssvar12" => ".multi-post-title",
				"cssvar13" => "div.post-inner, .post-inner-single",
				"cssvar14" => ".post-inner, .post-inner-single",
				"cssvar15" => ".post-header",
				"cssvar16" => "div.post-meta",
				"cssvar17" => ".post-meta",
				"cssvar18" => "h2.post-header, h2.post-header a, h2.post-header a:hover, h2.post-header a:visited",
				"cssvar19" => "div.post-meta, div.post-meta a",
				"cssvar20" => "div.post-taxonomy span",
				"cssvar21" => "div.post-taxonomy a",
				"cssvar22" => "a.readmorecontent",
				"cssvar23" => "h3#comments_title, h3#comments_title a, h3#comments_title a:hover, h3#comments_title a:visited",
				"cssvar24" => "cite.comment_author",
				"cssvar25" => "div.comment_time",
				"cssvar26" => "div.comment_text",
				"cssvar27" => "a.comment-reply-link, a.cancel-comment-reply-link",
				"cssvar28" => "h3.respond, h3.respond a, h3.respond a:hover, h3.respond a:visited",
				"cssvar29" => "form#commentform label",
				"cssvar30" => "div.breadcrumbs-plus p span, div.breadcrumbs-plus p, div.breadcrumbs-plus p a",
				"cssvar31" => "div.breadcrumbs-plus p span.breadcrumbs-title",
				"cssvar32" => "div.breadcrumbs-plus p strong",
				"cssvar33" => ".wp-pagenavi a, .wp-pagenavi span",
				"cssvar34" => ".wp-pagenavi span.current",
				"cssvar35" => "div.wp-pagenavi a, div.wp-pagenavi span",
				"cssvar36" => "div.wp-pagenavi span.current",
				"cssvar37" => ".wfm-mega-menu",
				"cssvar38" => ".wfm-mega-menu ul li:hover, .wfm-mega-menu ul li .sub-container",
				"cssvar39" => ".wfm-mega-menu ul li .sub li.mega-hdr a.mega-hdr-a",
				"cssvar40" => ".wfm-mega-menu ul li .sub-container.non-mega li a:hover, .wfm-mega-menu ul li .sub ul.sub-menu li a:hover",
				"cssvar41" => ".wfm-mega-menu ul.menu li a",
				"cssvar42" => ".wfm-mega-menu ul.menu li:hover a",
				"cssvar43" => ".wfm-mega-menu ul li .sub li.mega-hdr a.mega-hdr-a:hover",
				"cssvar44" => ".wfm-mega-menu ul li .sub ul.sub-menu li a",
				"cssvar45" => ".wfm-mega-menu ul li .sub ul.sub-menu li a:hover",
				"cssvar46" => ".wfm-mega-menu ul li .sub-container.non-mega li a",
				"cssvar47" => ".wfm-mega-menu ul li .sub-container.non-mega li a:hover",
				"cssvar48" => ".ddsmoothmenuh",
				"cssvar49" => ".ddsmoothmenuh ul li ul",
				"cssvar50" => ".ddsmoothmenuh ul li a",
				"cssvar51" => ".ddsmoothmenuh ul li:hover,.ddsmoothmenuh ul li a.selected,.ddsmoothmenuh ul li a:hover,.ddsmoothmenuh ul li ul.sub-menu li, .ddsmoothmenuh ul li ul.sub-menu li a",
				"cssvar52" => ".ddsmoothmenuh ul li ul li:hover, .ddsmoothmenuh ul li ul li a:hover",
				"cssvar53" => ".ddsmoothmenuh ul li a:link,.ddsmoothmenuh ul li a:visited",
				"cssvar54" => ".ddsmoothmenuh ul li a:hover",
				"cssvar55" => ".ddsmoothmenuh ul li  ul li a:link,.ddsmoothmenuh ul li  ul li a:visited",
				"cssvar56" => ".ddsmoothmenuh ul li  ul li a:hover",
				"cssvar57" => "div.horizontal-menu",
				"cssvar58" => "div.horizontal-menu ul li a",
				"cssvar59" => "div.horizontal-menu ul li a:hover",
				"cssvar60" => "div.horizontal-menu ul li",
				"cssvar61" => "div.horizontal-menu ul li, div.horizontal-menu ul li a:link,div.horizontal-menu ul li a:visited",
				"cssvar62" => "div.horizontal-menu ul li a:hover",
				"cssvar63" => ".wfm-vertical-mega-menu",
				"cssvar64" => ".wfm-vertical-mega-menu ul li:hover, .wfm-vertical-mega-menu ul li .sub-container",
				"cssvar65" => ".wfm-vertical-mega-menu ul li .sub li.mega-hdr a.mega-hdr-a",
				"cssvar66" => ".wfm-vertical-mega-menu ul li .sub-container.non-mega li a:hover, .wfm-vertical-mega-menu ul li .sub ul.sub-menu li a:hover",
				"cssvar67" => ".wfm-vertical-mega-menu ul li a",
				"cssvar68" => ".wfm-vertical-mega-menu ul li a:hover",
				"cssvar69" => ".wfm-vertical-mega-menu ul li .sub li.mega-hdr a.mega-hdr-a:hover",
				"cssvar70" => ".wfm-vertical-mega-menu ul li .sub ul.sub-menu li a",
				"cssvar71" => ".wfm-vertical-mega-menu ul li .sub ul.sub-menu li a:hover",
				"cssvar72" => ".wfm-vertical-mega-menu ul li .sub-container.non-mega li a",
				"cssvar73" => ".wfm-vertical-mega-menu ul li .sub-container.non-mega li a:hover",
				"cssvar74" => ".ddsmoothmenuv",
				"cssvar75" => ".ddsmoothmenuv ul li a:link,.ddsmoothmenuv ul li a:visited,.ddsmoothmenuv ul li a:active",
				"cssvar76" => ".ddsmoothmenuv ul li:hover,.ddsmoothmenuv ul li a.selected,.ddsmoothmenuv ul li a:hover,.ddsmoothmenuv ul li ul.sub-menu li, .ddsmoothmenuv ul li ul.sub-menu li a",
				"cssvar77" => ".ddsmoothmenuv ul li ul li:hover, .ddsmoothmenuv ul li ul li a:hover",
				"cssvar78" => ".ddsmoothmenuv ul li a:link,.ddsmoothmenuv ul li a:visited",
				"cssvar79" => ".ddsmoothmenuv ul li a:hover",
				"cssvar80" => ".ddsmoothmenuv ul li  ul li a:link,.ddsmoothmenuv ul li  ul li a:visited",
				"cssvar81" => ".ddsmoothmenuv ul li  ul li a:hover",
				"cssvar82" => ".vertical-menu a",
				"cssvar83" => "div.vertical-menu a:hover",
				"cssvar84" => ".vertical-menu a:link,.vertical-menu a:visited",
				"cssvar85" => ".vertical-menu a:hover",
				"cssvar86" => "ul.tabs li a",
				"cssvar87" => "ul.tabs li a:hover",
				"cssvar88" => "ul.tabs li a.current",
				"cssvar89" => "div.tabs-wrapper div.panes",
				"cssvar90" => ".accordion-toggle",
				"cssvar91" => ".accordion .current",
				"cssvar92" => "div.accordion div.pane",
				"cssvar93" => "h4.accordion-toggle, h4.accordion-toggle a, h4.accordion-toggle a:hover, h4.accordion-toggle a:visited",
				"cssvar94" => ".toggle_title",
				"cssvar95" => ".acctogg_active",
				"cssvar96" => "div.toggle",
				"cssvar97" => ".toggle_title a.toggle-title",
				"cssvar98" => "div.toggle_content",
				"cssvar99" => "h2.slidertitle, h2.slidertitle a, h2.slidertitle a:hover, h2.slidertitle a:visited",
				"cssvar100" => "p.slidertext",
				"cssvar101" => ".slidedeck > dt",
				"cssvar102" => "h1.super-title, h1.super-title a, h1.super-title a:hover, h1.super-title a:visited",
				"cssvar103" => "h3.element-title, h3.element-title a, h3.element-title a:hover, h3.element-title a:visited",
				"cssvar104" => ".element-title",
				"cssvar105" => "h3.slidertitle, h3.slidertitle a, h3.slidertitle a:hover, h3.slidertitle a:visited",
				"cssvar106" => ".anyCaption h3.slidertitle, .s3caption h3.slidertitle, .anyCaption h3.slidertitle, .s3caption h3.slidertitle a, .anyCaption h3.slidertitle, .s3caption h3.slidertitle a:hover, .anyCaption h3.slidertitle, .s3caption h3.slidertitle a:visited",
				"cssvar107" => ".anyCaption p.slidertext, .s3caption p.slidertext",
				"cssvar108" => "a#logo",
				"cssvar109" => "span#tagline",
				"cssvar110" => "blockquote",
				"cssvar111" => ".wfm-mega-menu ul li.current-menu-ancestor, .wfm-mega-menu ul li.current-menu-item",
				"cssvar112" => ".wfm-mega-menu ul li.current-menu-ancestor a, .wfm-mega-menu ul li.current-menu-item a",
            	"cssvar113" => ".wfm-vertical-mega-menu ul li.current-menu-ancestor, .wfm-vertical-mega-menu ul li.current-menu-item",
            	"cssvar114" => ".wfm-vertical-mega-menu ul li.current-menu-ancestor a, .wfm-vertical-mega-menu ul li.current-menu-item a",
            	"cssvar115" => ".ddsmoothmenuh ul li.current-menu-ancestor a, .ddsmoothmenuh ul li.current-menu-item a",
            	"cssvar116" => ".ddsmoothmenuh ul li.current-menu-ancestor a, .ddsmoothmenuh ul li.current-menu-item a",
            	"cssvar117" => ".ddsmoothmenuv ul li.current-menu-ancestor a, .ddsmoothmenuv ul li.current-menu-item a",
            	"cssvar118" => ".ddsmoothmenuv ul li.current-menu-ancestor a, .ddsmoothmenuv ul li.current-menu-item a",
            	"cssvar119" => ".horizontal-menu ul li.current-menu-ancestor a, .horizontal-menu ul li.current-menu-item a ",
            	"cssvar120" => ".horizontal-menu ul li.current-menu-ancestor a, .horizontal-menu ul li.current-menu-item a ",
            	"cssvar121" => ".vertical-menu  ul li.current-menu-item>a",
            	"cssvar122" => ".vertical-menu  ul li.current-menu-item>a",
				);
            	if($el!='save_options' && $el!='bg_pattern'){
            		$el = $cssvar[$el];
            		foreach ($values as $property=>$value){
            			// add px and #
            			if(strlen($value)!=0){
	            			if(eregi('color',$property)){
	            				$element[]=$property.': #'.stripslashes($value);
	            			} elseif (eregi('width',$property) || eregi('size',$property) || eregi('height',$property) || eregi('margin',$property) || eregi('padding',$property)){
	            				$element[]=$property.': '.stripslashes($value).'px';
	            			} elseif (eregi('image',$property)){
	            				$element[]=$property.': url('.stripslashes($value).')';
	            			} elseif (eregi('family',$property)){
	            				// cufon fontface google
	            				if(eregi('cufon-',$value)){ //cufon
	            					$cf = str_replace('cufon-', '', $value);
	            					$cfonts = explode('-js-',$cf);
	            					$cufonjs[]=$cfonts[1];
	            					$cufonreplace[$cfonts[0]][]=$el;
	            					unset($cfonts);
	            					$element[]=$property.': Arial,sans-serif';
	            				}elseif(eregi('google-',$value)){ //google
								$gfont=explode('-css-',str_replace('google-','',$value));
								$font = $gfont[0];
								$googlecss[] = $gfont[1];
								unset($gfont);
	            				$element[]=$property.': "'.stripslashes($font).'", Arial, sans-serif';
	            				}elseif(eregi('fontface-',$value)){ //fontface
	            				$ffont=explode('-css-',str_replace('fontface-','',$value));
								$font = $ffont[0];
								$fontfacer[] = $ffont[1];
								unset($ffont);	
	            				$element[]=$property.': "'.stripslashes($font).'", Arial, sans-serif';
	            				} else {
	            				$element[]=$property.': '.stripslashes($value);
	            				}
	            			} else {
	            				$element[]=$property.': '.stripslashes($value);
	            			}
            			}
            		}
            		$linebreak=';'."\n";
            		if(is_array($element)){ $content.= $el.' {'."\n".@implode($linebreak, $element).';'."\n".'}'."\n\n"; }
            		unset($element);
            	}
            }
            // Intelligent Google
            $google_css='';
            if(isset($googlecss)){
            	$gcss = array_unique($googlecss);
            	if(count($gcss)>=1){
            		$google_css=implode('|',$gcss);
            	}
            }
            //Intelligent @font-face
            $fontfacecss='';
        	if(isset($fontfacer)){
            	$fcss = array_unique($fontfacer);
            	if(count($fcss)>=1){
            		$url = THEME_URI.'/fonts/fontface';
	            	foreach ($fcss as $font_str){
					$font_info = explode("|", $font_str);
					$stylesheet = THEME_FONTFACE_DIR.'/'.$font_info[0].'/stylesheet.css';
					if(file_exists($stylesheet)){
						$file_content = file_get_contents($stylesheet);
						if( preg_match("/@font-face\s*{[^}]*?font-family\s*:\s*('|\")$font_info[1]\\1.*?}/is", $file_content, $match) ){
							$fontfacecss .= preg_replace("/url\s*\(\s*['|\"]\s*/is","\\0$url/$font_info[0]/",$match[0])."\n";
						}
						}
					}
            	}
            }
            
            $content = $content;
            if ($fhandle) fwrite($fhandle, $content, strlen($content));
            // Intelligent Fonts
            // $fontsCss = $google_css.$fontfacecss;
            //@import url(http://fonts.googleapis.com/css?family='.
        	$gfile = THEME_CACHE_DIR.'/google_'.$prel.$layoutid.'.php';
			
			// first delete existing one
			if(file_exists($gfile)){
				unlink($gfile);
			}
			$google_css=str_replace(' ', '+', $google_css);
            $googleCss = '<link rel="stylesheet" type="text/css" media="all" href="http://fonts.googleapis.com/css?family='.$google_css.'" />'."\n";
            $fhandler = @fopen($gfile, 'w+');
		    if ($fhandler) fwrite($fhandler, $googleCss, strlen($googleCss));
		  	$fffile = THEME_CACHE_DIR.'/fontface_'.$prel.$layoutid.'.css';
			
			// first delete existing one
			if(file_exists($fffile)){
				unlink($fffile);
			}
			if(strlen($fontfacecss)!=0){
			$fhandler = @fopen($fffile, 'w+');
		    if ($fhandler) fwrite($fhandler, $fontfacecss, strlen($fontfacecss));
			}
			//$fontfacecss
            // Intelligent Cufon
            $cfile = THEME_CACHE_DIR.'/cufon_'.$prel.$layoutid.'.php';
			
			// first delete existing one
			if(file_exists($cfile)){
				unlink($cfile);
			}
         	
			if(isset($cufonjs)){
				 $cufjs = array_unique($cufonjs);
	
	            if(count($cufjs)>=1){
	            	$phpcontent .= '<script type="text/javascript" src="<?php bloginfo("stylesheet_directory"); ?>/js/cufon-yui.js"></script>'."\n";
		            foreach ($cufjs as $cjsi){
		            	//
						$phpcontent.='<script type="text/javascript" src="<?php bloginfo("stylesheet_directory"); ?>/fonts/cufon/'.$cjsi.'"></script>'."\n";
		            }
		            $phpcontent.='<script type="text/javascript">'."\n";
		            //$phpcontent.="jQuery(document).ready(function() {\n";
		            foreach($cufonreplace as $font=>$item){
		            	$phpcontent .= 'Cufon.replace("'.implode(', ',$item).'", {fontFamily : "'.$font.'",hover:true});'."\n";
		            }
		            //$phpcontent .= "});\n";
		            $phpcontent .= '</script>';
		            $fhandler = @fopen($cfile, 'w+');
		            if ($fhandler) fwrite($fhandler, $phpcontent, strlen($phpcontent));
	            }
	            
	        }
	        unset($post);
        }
        
}

function deleteTheme(){
	if($_POST['confirm']){
		global $wpdb;
		$table = $wpdb->prefix.'ultimatum_themes';
		$ltable = $wpdb->prefix.'ultimatum_layout';
		$latable = $wpdb->prefix.'ultimatum_layout_assign';
		$rtable = $wpdb->prefix.'ultimatum_rows';
		$ctable = $wpdb->prefix.'ultimatum_css';
		echo '<h2>Deleting Template...</h2>';
		$findlsql = "SELECT * FROM $ltable WHERE `theme`='$_POST[theme]'";
		$result = $wpdb->get_results($findlsql,ARRAY_A);
		foreach ($result as $layout){
			echo '<p>Deleting Layout :'.$layout['title'].'... ';
			$sql1 = "DELETE FROM $ctable WHERE `layout_id`='$layout[id]'";
			$wpdb->query($sql1);
			$sql1 = "DELETE FROM $rtable WHERE `layout_id`='$layout[id]'";
			$wpdb->query($sql1);
			$sql1 = "DELETE FROM $latable WHERE `layout_id`='$layout[id]'";
			$wpdb->query($sql1);
			$sql1 = "DELETE FROM $ltable WHERE `id`='$layout[id]'";
			$wpdb->query($sql1);
			if(is_multisite()){
				global $blog_id;
				$prel=$blog_id.'_';
				
			}else{
				$prel='';
			}
			$files[] = THEME_CACHE_DIR.'/skin_'.$prel.$layout[id].'.css';
			$files[] = THEME_CACHE_DIR.'/custom_'.$prel.$layout[id].'.css';
			$files[] = THEME_CACHE_DIR.'/layout_'.$prel.$layout[id].'.css';
			$files[] = THEME_CACHE_DIR.'/cufon_'.$prel.$layout[id].'.php';
			$files[] = THEME_CACHE_DIR.'/google_'.$prel.$layout[id].'.php';
			$files[] = THEME_CACHE_DIR.'/fontface_'.$prel.$layout[id].'.css';
			foreach ($files as $file){
				if(file_exists($file)){
					unlink($file);
				}
			}
			echo 'Done.</p>';
		}
		echo '<p>Deleting the Template... ';
		$sql1 = "DELETE FROM $table WHERE `id`='$_POST[theme]'";
		$wpdb->query($sql1);
		echo 'Done. </p>';
		$url = curPageURL();
			?>
			<script language="JavaScript">
				parent.location.href='<?php echo $url; ?>';
			</script>
			<?php
	} else {
		?>
		<h2><?php _e('Confirm Action',THEME_LANG_DOMAIN);?></h2>
		<h3><?php _e('The action of deleting a template is an irreversible action. It will delete the template and all layouts conatined in it. Are you sure? '); ?></h3>
		<form method="post" action="" >
		<input type="hidden" name="theme" value="<?php echo $_REQUEST["theme"]; ?>" />
		<input type="hidden" name="task" value="delete" />
		<input type="submit" value="Delete" name="confirm" /><input type="submit" value="Cancel" name="" />
		</form>
		<?php 
	}
}
function next_widget_id_number($id_base) {
	global $wp_registered_widgets;
	$number = 1;

	foreach ( $wp_registered_widgets as $widget_id => $widget ) {
		if ( preg_match( '/' . $id_base . '-([0-9]+)$/', $widget_id, $matches ) )
			$number = max($number, $matches[1]);
	}
	$number++;

	return $number;
}