<?php 
add_action('init','udefaultscreen_scripts');
add_action('init','udefaultscreen_styles');
function udefaultscreen_styles(){
	wp_enqueue_style('jquery.fileupload-ui.css',THEME_ADMIN_URI.'/css/jquery.fileupload-ui.css');
}
function udefaultscreen_scripts(){
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-dialog'); 
	wp_enqueue_script('jquery.fileupload.js', THEME_ADMIN_JS_URI.'/jquery.fileupload.js');
	wp_enqueue_script('jquery.fileupload-ui.js', THEME_ADMIN_JS_URI.'/jquery.fileupload-ui.js');
	wp_enqueue_script('jquery.fileupload-uix.js', THEME_ADMIN_JS_URI.'/jquery.fileupload-uix.php');
	wp_enqueue_script('application.js', THEME_ADMIN_JS_URI.'/application.js');
}



function curPageURL() {
 $pageURL = $_SERVER["REQUEST_URI"];
 return $pageURL;
}
function slideShows(){
	screen_icon(); 
	echo '<div class="wrap">';?>
	<h2><?php _e('Slide Shows',THEME_ADMIN_LANG_DOMAIN);?></h2>
	<?php 
		if(isset($_REQUEST['task'])){
		$task=$_REQUEST['task'];
	} else {
		$task=false;
	}	
	switch ($task){
		case 'edit':
			slideShow();
		break;
		default:
		global $wpdb;
		$table = $wpdb->prefix.'ultimatum_slides';
		if($_POST){
			if($_POST[action]=='delete'){
				$delete = "DELETE  FROM $table WHERE `id`='$_POST[delid]'";
				$wpdb->query($delete);
				$url = curPageURL();
			} else {
				$ins = "INSERT INTO $table (`name`,`images`) VALUES ('$_POST[name]','')";
				$wpdb->query($ins);
				$id =$wpdb->insert_id;
				$url = curPageURL().'&task=edit&id='.$id;
			}
			?>
			<script language="JavaScript">
				parent.location.href='<?php echo $url; ?>';
			</script>
			<?php 
		}
		$query = "SELECT * FROM $table";
		$result = $wpdb->get_results($query,ARRAY_A);
		?>
		<form method="post" action="">
			<table class="widefat">
				<thead>
					<tr><th colspan="2"><?php _e('Create a New Slide Show',THEME_ADMIN_LANG_DOMAIN);?></th></tr>
				</thead>
				<tbody>
					<tr><td width="20"><?php _e('Name',THEME_ADMIN_LANG_DOMAIN);?>:</td><td><input type="text" name="name" /></tr>
				</tbody>
				<tfoot>
					<tr><td colspan="2" style="text-align:right"><input type="submit" value="<?php _e('Create',THEME_ADMIN_LANG_DOMAIN);?>" class="button-primary" /></td></tr>
				</tfoot>
			</table>
		</form>
		<p></p>
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
		<table class="widefat">
			<thead>
			<tr><th><?php _e('SlideShows Stored in System',THEME_ADMIN_LANG_DOMAIN);?></th><th style="text-align:right" colspan="2"></th></tr>
			</thead>
			<tbody>
				<?php 
					foreach( $result as $fetch){
						echo '<tr valign="middle"><td><a href="'.curPageURL().'&task=edit&id='.$fetch["id"].'">'.$fetch["name"].'</a></td><td align="right" width="100"><form method="post" action=""><input type="hidden" name="action" value="delete" /><input type="hidden" name="delid" value="'.$fetch["id"].'" /><input type="submit" value="'.__('Delete',THEME_ADMIN_LANG_DOMAIN).'" class="button-primary" onClick="return confirmSubmit()" /></form></td><td align="right" width=25" style="padding-top:10px;"><a href="'.curPageURL().'&task=edit&id='.$fetch["id"].'" class="button-primary">'.__('Edit Slides',THEME_ADMIN_LANG_DOMAIN).'</a></td></tr>';
					}
				?>	
			</tbody>
		</table>
		<?php 
		break;
	}
	echo '</div>';	
	
	
}

function slideShow(){
	global $wpdb;
	$table = $wpdb->prefix.'ultimatum_slides';
	$upldir = wp_upload_dir();
	$uplurl = $upldir['baseurl'];
	$uplurl = $uplurl.'/slideShow/';
	if($_POST){
		if($_POST["images"]){
		foreach($_POST["images"] as $key=>$value){
			$images[$key]["image"]=$value;
			$images[$key]["title"]=$_POST["title"][$key];
			wpml_register_string('Ultimatum Slideshow', 'Slide-'.$_POST["name"].'- Title '.$images[$key]["title"], $images[$key]["title"]);
			$images[$key]["text"]=$_POST["text"][$key];
			wpml_register_string('Ultimatum Slideshow', 'Slide-'.$_POST["name"].'- Title '.$images[$key]["title"], $images[$key]["text"]);
			$images[$key]["link"]=$_POST["link"][$key];
			wpml_register_string('Ultimatum Slideshow', 'Slide-'.$_POST["name"].'- Title '.$images[$key]["title"], $images[$key]["link"]);
			$images[$key]["video"]=$_POST["video"][$key];
			wpml_register_string('Ultimatum Slideshow', 'Slide-'.$_POST["name"].'- Title '.$images[$key]["title"], $images[$key]["video"]);
			$images[$key]["target"]=$_POST["target"][$key];
		}
		}
		$image =serialize($images);
		$q = "REPLACE INTO $table VALUES('$_GET[id]','$_POST[name]','$image')";
		$wpdb->query($q);
	}	
	if(isset($_GET["id"])){
		$s = "SELECT * FROM $table WHERE id='$_GET[id]'";
		$f = $wpdb->get_row($s,ARRAY_A);
		$images = unserialize($f["images"]);
	} 
	?>
	
	<form action="" method="post">
	<?php _e('Gallery Name',THEME_ADMIN_LANG_DOMAIN);?> : <input type="text" name="name" value="<?php echo $f["name"];?>" />
	<input type="submit" class="button-primary" value="<?php _e('Save',THEME_ADMIN_LANG_DOMAIN);?>"/>
	<div id="file_upload">
	
    <ul class="files" id="sortable">
        <li class="ui-state-default file_upload_template" style="display:none;"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
        <table>
         <tr valign="top">
         <td style="width:22px;"><div class="drag"></div></td>
         <td>
        <table class="fuploadd"><tr>
            <td class="file_upload_preview"></td>
            <td class="file_name"></td>
            <td class="file_size"></td>
            <td class="file_upload_progress"><div></div></td>
            <td class="file_upload_start"><button class="button-primary"><?php _e('Start',THEME_ADMIN_LANG_DOMAIN);?></button></td>
            <td class="file_upload_cancel"><button class="button-primary"><?php _e('Cancel',THEME_ADMIN_LANG_DOMAIN);?></button></td>
         </tr></table>
</td></tr></table>
        </li>
        <li class="ui-state-default file_download_template" style="display:none;">
        <table>
         <tr valign="top">
         <td style="width:22px;"><div class="drag"></div></td>
         <td>
         <table class="fuploadd" cellspacing="0">
         	<tr valign="top">
         	<td>
            <span class="file_download_preview">
            </span>
             <span class="file_download_delete" colspan="2"><button class="button-secondary centered" role="button" title="<?php _e('Delete',THEME_ADMIN_LANG_DOMAIN);?>">
				<?php _e('Delete',THEME_ADMIN_LANG_DOMAIN);?>
				</button></span>
            </td>
           
           
            <td class="slide_details"></td>
            <td class="slide_text"></td>
            </tr>
         </table>
         </td></tr></table>
            
        </li>
        <?php if($images){ foreach($images as $image){?>
        <li class="file_download_template" data-id="<?php echo $image["image"]; ?>" ><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
        
         <table>
         <tr valign="top">
         <td style="width:22px;"><div class="drag"></div></td>
         <td>
         <table class="fuploadd" cellspacing="0">
         <tr valign="top">
         <td>
           <span class="file_download_preview">
           		<a target="_blank" href="<?php echo $uplurl; ?><?php echo $f["id"];?>/<?php echo $image["image"]; ?>">
            	<img src="<?php echo $uplurl; ?><?php echo $f["id"];?>/thumbnails/<?php echo $image["image"]; ?>">
            	<input type="hidden" name="images[]" value="<?php echo $image["image"]; ?>"></a>
            	</span>
            	<span class="file_download_delete">
            	<button class="button-secondary centered" role="button" title="<?php _e('Delete',THEME_ADMIN_LANG_DOMAIN);?>">
				<?php _e('Delete',THEME_ADMIN_LANG_DOMAIN);?>
				</button>
			</span>
            </td>
			<td class="slide_details">
            	<?php _e('Title',THEME_ADMIN_LANG_DOMAIN);?><br /><input name="title[]" type="text" class="widefat" value="<?php echo $image["title"];?>"/><br/>
            	<?php _e('Link',THEME_ADMIN_LANG_DOMAIN);?><br /><input name="link[]" type="text" class="widefat" value="<?php echo $image["link"];?>"/><br/>
            	<?php _e('Video',THEME_ADMIN_LANG_DOMAIN);?><br /><input name="video[]" type="text" class="widefat" value="<?php echo $image["video"];?>"/><br/>
            	
            </td>
            <td class="slide_text"><?php _e('Slide Text',THEME_ADMIN_LANG_DOMAIN);?><br /><textarea name="text[]" rows="5" cols="50"><?php echo $image["text"];?></textarea></td>
            </tr>
            
         </table>
         </td></tr></table>
            
        </li>
        <?php } } ?>
    </ul>
    <div class="file_upload_overall_progress"><div style="display:none;"></div></div>
    <div class="file_upload_buttons">
        <button class="file_upload_start button-primary"><?php _e('Start All',THEME_ADMIN_LANG_DOMAIN);?></button> 
        <button class="file_upload_cancel button-primary"><?php _e('Cancel All',THEME_ADMIN_LANG_DOMAIN);?></button> 
        <button class="file_download_delete button-primary"><?php _e('Delete All',THEME_ADMIN_LANG_DOMAIN);?></button>
    </div>
    </form>
    <br><br>
    <form action="<?php echo THEME_ADMIN_URI;?>/ajax/upload.php?id=<?php echo $_GET["id"];?>" method="post" enctype="multipart/form-data">
    	<input type="hidden" name="id" value="<?php echo $_GET["id"];?>" />
        <input type="file" name="file[]" multiple>
        <button type="submit"><?php _e('Upload',THEME_ADMIN_LANG_DOMAIN);?></button>
        <div class="file_upload_label"><?php _e('Upload files',THEME_ADMIN_LANG_DOMAIN);?></div>
    </form>
    </div>
	<?php 
}

?>