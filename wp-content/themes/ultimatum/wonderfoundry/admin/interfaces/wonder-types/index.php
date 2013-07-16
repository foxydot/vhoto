<?php 
add_action('init','udefaultscreen_scripts');
add_action('init','udefaultscreen_styles');
function udefaultscreen_styles(){
	wp_enqueue_style('thickbox');
}
function udefaultscreen_scripts(){
	wp_enqueue_script('jquery');
	wp_enqueue_script('thickbox');
	wp_enqueue_script( 'ultimatum-iphone',THEME_ADMIN_URI.'/js/jquery-iphone.js' );
	wp_enqueue_script( 'ultimatum-cpicker4',THEME_ADMIN_URI.'/js/layout.js' );
}

function curPageURL() {
 $pageURL = $_SERVER["REQUEST_URI"];
 return $pageURL;
}
function PostTypes(){
	screen_icon(); 
	echo '<div class="wrap">';?>
	<script LANGUAGE="JavaScript">
			<!--
			function confirmSubmit()
			{
			var agree=confirm("<?php _e('Are you sure you wish to delete?',THEME_ADMIN_LANG_DOMAIN);?>");
			if (agree)
				return true ;
			else
				return false ;
			}
			// -->
			</script>
	<h2><?php echo THEME_NAME; ?><?php _e('Post Types and Taxonomies',THEME_ADMIN_LANG_DOMAIN);?></h2>
	<?php 
	if(isset($_REQUEST["task"])){
		$task = $_REQUEST["task"];
	} else {
		$task=false;
	}
	switch ($task) {
		case 'editptype':
			editpostType();
		break;
		case 'edittax':
			edittaxType();
		break;
		default:
		global $wpdb;
		$table = $wpdb->prefix.'ultimatum_ptypes';
		$table2 = $wpdb->prefix.'ultimatum_tax';	
		if($_POST){
			if($_POST[action]=='delptype'){
				// delete post type
				$delete = "DELETE  FROM $table WHERE `name`='$_POST[delptype]'";
				$r = $wpdb->query($delete);
				$url = curPageURL();
				//delete taxonomies of post type
				$delete = "DELETE  FROM $table2 WHERE `pname`='$_POST[delptype]'";
				$r = $wpdb->query($delete);
			}
			if($_POST[action]=='delcptax'){
				//delete tax type
				$delete = "DELETE  FROM $table2 WHERE `tname`='$_POST[delcptax]'";
				$r = $wpdb->query($delete);
				$url = curPageURL();
			}
			?>
			<script language="JavaScript">
				parent.location.href='<?php echo $url; ?>';
			</script>
			<?php 
		}
		flush_rewrite_rules(false);
		
		$query = "SELECT * FROM $table";
		$result = $wpdb->get_results($query,ARRAY_A);
		
		echo '<table class="widefat">';
		echo '<thead>';
		echo '<tr><th width="150">'.__('Custom Post Type',THEME_ADMIN_LANG_DOMAIN).'</th><th>'.__('Taxonomies',THEME_ADMIN_LANG_DOMAIN).'</th><th style="text-align:right;" width="150"><a href="admin.php?page=wonder-types&task=editptype" class="button-primary">'.__('Add Post Type',THEME_ADMIN_LANG_DOMAIN).'</a></th></tr>';
		echo '</thead>';
		echo '<tbody>';
		foreach ($result as $ptypes){
			$properties = unserialize($ptypes["properties"]);
			echo '<tr>
					<td style="font-size:14px"><a href="admin.php?page=wonder-types&task=editptype&name='.$ptypes["name"].'">'.$properties["label"].'</a></td>
					<td>'.getTaxes($ptypes["name"]).'</td>
					<td align="right">
					<p><a href="admin.php?page=wonder-types&task=editptype&name='.$ptypes["name"].'" class="button-primary">'.__('Edit Post Type',THEME_ADMIN_LANG_DOMAIN).'</a><br /><br /><a href="admin.php?page=wonder-types&task=edittax&name='.$ptypes["name"].'" class="button-primary">'.__('Add Taxonomy',THEME_ADMIN_LANG_DOMAIN).'</a></p><form method="post" action=""><input type="hidden" name="action" value="delptype" /><input type="hidden" name="delptype" value="'.$ptypes["name"].'" /><input type="submit" value="'.__('Delete Post Type',THEME_ADMIN_LANG_DOMAIN).'" class="button-secondary" onClick="return confirmSubmit()" /></form></td></tr>';
		}
		echo '</tbody>';
		echo '</table>';
		break;
	}
	echo '</div>';
}
function getTaxes($name=null){
global $wpdb;
$table = $wpdb->prefix.'ultimatum_tax';	
$query = "SELECT * FROM $table WHERE pname='$name'";
$result = $wpdb->get_results($query,ARRAY_A);
$taxes='';
foreach ($result as $f){
	$taxes .= '<div style="margin-right:10px;height:25px;line-height:25px;padding:5px;background:#d3d3d3;border-radius:4px;width:auto;float:left;"><span style="font-size:14px;float:left;margin-right:5px;">'.$f["tname"].'</span><a href="admin.php?page=wonder-types&task=edittax&tname='.$f["tname"].'&name='.$f["pname"].'" class="button-secondary" style="float:left; font-size: 12px;line-height: 18px;padding: 3px 8px;">'.__('Edit').'</a>&nbsp;<div style="float:left"><form method="post" action="" ><input type="hidden" name="action" value="delcptax" /><input type="hidden" name="delcptax" value="'.$f["tname"].'" /><input type="submit" value="'.__('Delete',THEME_ADMIN_LANG_DOMAIN).'" class="button-secondary" onClick="return confirmSubmit()" style="float:left"/></form></div></div>';
}
return $taxes;
}


function edittaxType(){
global $wpdb;
	$table = $wpdb->prefix.'ultimatum_tax';
		if($_POST){
			if(!$_GET["tname"]){
			$_POST["custom_tax"]["name"]=$_POST["pname"].'_'.$_POST["custom_tax"]["name"];
			}
			$name = str_replace($_POST[pname].'_', '',$_POST["custom_tax"]["name"]);
			
			if(!$_POST["custom_tax"]["slug"]){
				$_POST["custom_tax"]["slug"] = $name;
			}
			$properties = serialize($_POST["custom_tax"]);
			if(!$name || !$_POST["custom_tax"]["singular_label"] || !$_POST["custom_tax"]["label"]){
				?><script language="JavaScript">
					alert('Please fill in all Fields');
				</script>	
				<?php 
			} else {
			$ins = "REPLACE INTO $table VALUES('$name','$_POST[pname]','$properties')";
			$wpdb->query($ins);
			$url = 'admin.php?page=wonder-types';
			
		?>
		<script language="JavaScript">
			parent.location.href='<?php echo $url; ?>';
		</script>
		<?php
			} 
		}
		if(isset($_GET["tname"])){
			$query = "SELECT * FROM $table WHERE tname='$_GET[tname]'";
			$fetch=$wpdb->get_row($query,ARRAY_A);
			$properties = unserialize($fetch["properties"]);
			foreach ($properties as $key=>$value){
			 $$key = $value;
			}
		}
	?>
	<form method="post" action="">
	<input name="pname" type="hidden" value="<?php echo $_GET["name"];?>">
	<table class="widefat">
                    <tr valign="top">
                    <th scope="row"><?php _e('Taxonomy Name', THEME_ADMIN_LANG_DOMAIN) ?> <span style="color:red;">*</span></th>
                    <td><input type="text" name="custom_tax[name]" tabindex="21" <?php if (isset($name)) { echo 'value="'.esc_attr($name).'" disabled="disabled"'; } ?> /></td><td><?php _e('The taxonomy name.  Used to retrieve custom taxonomy content.  Should be short and sweet (e.g. actors)',THEME_ADMIN_LANG_DOMAIN);?></td>
                    </tr>

                   <tr valign="top">
                    <th scope="row"><?php _e('Label', THEME_ADMIN_LANG_DOMAIN) ?></th>
                    <td><input type="text" name="custom_tax[label]" tabindex="22" value="<?php if (isset($label)) { echo esc_attr($label); } ?>" /></td><td><?php _e('Taxonomy label.  Used in the admin menu for displaying custom taxonomy. (e.g. Actors)',THEME_ADMIN_LANG_DOMAIN);?></td>
                    </tr>

                   <tr valign="top">
                    <th scope="row"><?php _e('Singular Label', THEME_ADMIN_LANG_DOMAIN) ?></th>
                    <td><input type="text" name="custom_tax[singular_label]" tabindex="23" value="<?php if (isset($singular_label)) { echo esc_attr($singular_label); } ?>" /></td><td><?php _e('Taxonomy Singular label.  Used in WordPress when a singular label is needed. (e.g. Actor)',THEME_ADMIN_LANG_DOMAIN);?></td>
                    </tr>
					<tr valign="top">
                    <th scope="row"><?php _e('Rewrite Slug', THEME_ADMIN_LANG_DOMAIN) ?></th>
                    <td><input type="text" name="custom_tax[slug]" tabindex="23" value="<?php if (isset($slug)) { echo esc_attr($slug); } ?>" /></td><td><?php _e('Rewrite slug for your Taxonomy use no spaces and all small lettters leave blank if you want it created from your Taxonomy name',THEME_ADMIN_LANG_DOMAIN);?></td>
                    </tr>
                    
                </table>

                <p class="submit">
                <?php if (isset($name)) { ?>
                	<input type="hidden" name="custom_tax[name]" value="<?php echo $name;?>" />
                <?php } ?>
                	<input type="submit" class="button-primary" tabindex="29" value="<?php _e('Save Taxonomy', THEME_ADMIN_LANG_DOMAIN) ?>" />
                </p>
            </form>
	<?php
}


function editpostType(){
	global $wpdb;
	$table = $wpdb->prefix.'ultimatum_ptypes';
		if($_POST){
			if(!$_POST["custom_post_type"]["slug"]){
				$_POST["custom_post_type"]["slug"] = $_POST["custom_post_type"]["name"];
			}
			$properties = serialize($_POST["custom_post_type"]);
			$name = strtolower(str_replace(' ','',$_POST["custom_post_type"]["name"]));
			$ins = "REPLACE INTO $table VALUES('$name','$properties')";
			$wpdb->query($ins);
			$url = 'admin.php?page=wonder-types';
			flush_rewrite_rules(false);
		?>
		<script language="JavaScript">
			parent.location.href='<?php echo $url; ?>';
		</script>
		<?php 
		}
		if(isset($_GET["name"])){
			$name = $_GET["name"];
			$query = "SELECT * FROM $table WHERE name='$_GET[name]'";
			$fetch = $wpdb->get_row($query,ARRAY_A);
			$properties = unserialize($fetch["properties"]);
			foreach ($properties as $key=>$value){
			 $$key = $value;
			}
		}
		?>
            <form method="post" action="">
            	<table class="widefat">
            	    <tr valign="top">
                    <th scope="row"><?php _e('Post Type Name', THEME_ADMIN_LANG_DOMAIN) ?> <span style="color:red;">*</span></th>
                    <td colspan="2">
                    	<input type="text" name="custom_post_type[name]" tabindex="1" <?php if (isset($name)) { echo 'value="'.esc_attr($name).'" disabled="disabled"'; } ?> /><?php _e('The post type name.  Used to retrieve custom post type content.  Should be short and sweet.(e.g. movies)',THEME_ADMIN_LANG_DOMAIN);?>
                    	<?php if (isset($name)) { echo '<input type="hidden" name="custom_post_type[name]" tabindex="1" value="'.esc_attr($name).'" />'; } ?>
                    
                    </td>
                    </tr>
                    <tr valign="top">
                    <th scope="row"><?php _e('Label', THEME_ADMIN_LANG_DOMAIN) ?></th>
                    <td colspan="2"><input type="text" name="custom_post_type[label]" tabindex="2" value="<?php if (isset($label)) { echo esc_attr($label); } ?>" /><?php _e('Post type label.  Used in the admin menu for displaying post types.(e.g. Movies)',THEME_ADMIN_LANG_DOMAIN);?></td>
                    </tr>
	                <tr valign="top">
                    <th scope="row"><?php _e('Singular Label', THEME_ADMIN_LANG_DOMAIN) ?></th>
                    <td colspan="2"><input type="text" name="custom_post_type[singular_label]" tabindex="3" value="<?php if (isset($singular_label)) { echo esc_attr($singular_label); } ?>" /><?php _e('Custom Post Type Singular label.  Used in WordPress when a singular label is needed. (e.g. Movie)',THEME_ADMIN_LANG_DOMAIN);?></td>
                    </tr>
                     </tr>
	                <tr valign="top">
                    <th scope="row"><?php _e('Rewrite Slug', THEME_ADMIN_LANG_DOMAIN) ?></th>
                    <td colspan="2"><input type="text" name="custom_post_type[slug]" tabindex="3" value="<?php if (isset($slug)) { echo esc_attr($slug); } ?>" /><?php _e('Rewrite slug for your Post Type use no spaces and all small lettters leave blank if you want it created from your post type name',THEME_ADMIN_LANG_DOMAIN);?></td>
                    </tr>
            	    <tr valign="top">
                    <th scope="row" colspan="3"><?php _e('Supports', THEME_ADMIN_LANG_DOMAIN) ?></th>
                    </tr>
                    <tr><th scope="row"><?php _e('Title',THEME_ADMIN_LANG_DOMAIN);?></th><td><input type="checkbox" name="custom_post_type[supports][]" tabindex="11" value="title" <?php if (isset($supports) && is_array($supports)) { if (in_array('title', $supports)) { echo 'checked="checked"'; } }elseif (!isset($_GET['edittype'])) { echo 'checked="checked"'; } ?> /></td><td><?php _e('Adds the title meta box when creating content for this custom post type',THEME_ADMIN_LANG_DOMAIN);?></td></tr>
                    <tr><th scope="row"><?php _e('Editor',THEME_ADMIN_LANG_DOMAIN);?></th><td><input type="checkbox" name="custom_post_type[supports][]" tabindex="12" value="editor" <?php if (isset($supports) && is_array($supports)) { if (in_array('editor', $supports)) { echo 'checked="checked"'; } }elseif (!isset($_GET['edittype'])) { echo 'checked="checked"'; } ?> /></td><td><?php _e('Adds the content editor meta box when creating content for this custom post type',THEME_ADMIN_LANG_DOMAIN);?></td></tr>
                    <tr><th scope="row"><?php _e('Excerpt',THEME_ADMIN_LANG_DOMAIN);?></th><td><input type="checkbox" name="custom_post_type[supports][]" tabindex="13" value="excerpt" <?php if (isset($supports) && is_array($supports)) { if (in_array('excerpt', $supports)) { echo 'checked="checked"'; } }elseif (!isset($_GET['edittype'])) { echo 'checked="checked"'; } ?> /></td><td><?php _e('Adds the excerpt meta box when creating content for this custom post type',THEME_ADMIN_LANG_DOMAIN);?></td></tr>
                    <tr><th scope="row"><?php _e('Trackbacks',THEME_ADMIN_LANG_DOMAIN);?></th><td><input type="checkbox" name="custom_post_type[supports][]" tabindex="14" value="trackbacks" <?php if (isset($supports) && is_array($supports)) { if (in_array('trackbacks', $supports)) { echo 'checked="checked"'; } }elseif (!isset($_GET['edittype'])) { echo 'checked="checked"'; } ?> /></td><td><?php _e('Adds the trackbacks meta box when creating content for this custom post type',THEME_ADMIN_LANG_DOMAIN);?></td></tr>
                    <tr><th scope="row"><?php _e('Custom Fields',THEME_ADMIN_LANG_DOMAIN);?></th><td><input type="checkbox" name="custom_post_type[supports][]" tabindex="15" value="custom-fields" <?php if (isset($supports) && is_array($supports)) { if (in_array('custom-fields', $supports)) { echo 'checked="checked"'; } }elseif (!isset($_GET['edittype'])) { echo 'checked="checked"'; }  ?> /></td><td><?php _e('Adds the custom fields meta box when creating content for this custom post type',THEME_ADMIN_LANG_DOMAIN);?></td></tr>
                    <tr><th scope="row"><?php _e('Comments',THEME_ADMIN_LANG_DOMAIN);?></th><td><input type="checkbox" name="custom_post_type[supports][]" tabindex="16" value="comments" <?php if (isset($supports) && is_array($supports)) { if (in_array('comments', $supports)) { echo 'checked="checked"'; } }elseif (!isset($_GET['edittype'])) { echo 'checked="checked"'; }  ?> /></td><td><?php _e('Adds the comments meta box when creating content for this custom post type',THEME_ADMIN_LANG_DOMAIN);?></td></tr>
                    <tr><th scope="row"><?php _e('Revisions',THEME_ADMIN_LANG_DOMAIN);?></th><td><input type="checkbox" name="custom_post_type[supports][]" tabindex="17" value="revisions" <?php if (isset($supports) && is_array($supports)) { if (in_array('revisions', $supports)) { echo 'checked="checked"'; } }elseif (!isset($_GET['edittype'])) { echo 'checked="checked"'; }  ?> /></td><td><?php _e('Adds the revisions meta box when creating content for this custom post type',THEME_ADMIN_LANG_DOMAIN);?></td></tr>
                    <tr><th scope="row"><?php _e('Featured Image',THEME_ADMIN_LANG_DOMAIN);?></th><td><input type="checkbox" name="custom_post_type[supports][]" tabindex="18" value="thumbnail" <?php if (isset($supports) && is_array($supports)) { if (in_array('thumbnail', $supports)) { echo 'checked="checked"'; } }elseif (!isset($_GET['edittype'])) { echo 'checked="checked"'; }  ?> /></td><td><?php _e('Adds the featured image meta box when creating content for this custom post type',THEME_ADMIN_LANG_DOMAIN);?></td></tr>
                    <tr><th scope="row"><?php _e('Author',THEME_ADMIN_LANG_DOMAIN);?></th><td><input type="checkbox" name="custom_post_type[supports][]" tabindex="19" value="author" <?php if (isset($supports) && is_array($supports)) { if (in_array('author', $supports)) { echo 'checked="checked"'; } }elseif (!isset($_GET['edittype'])) { echo 'checked="checked"'; }  ?> /></td><td><?php _e('Adds the author meta box when creating content for this custom post type',THEME_ADMIN_LANG_DOMAIN);?></td></tr>
                    
                 </table>
                    <p class="submit">
                    
                <input type="submit" class="button-primary" value="<?php _e('Save Post Type', THEME_ADMIN_LANG_DOMAIN) ?>" />
                </p>
            </form>
		<?php 
	
}
