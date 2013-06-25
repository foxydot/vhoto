<?php 
include( '../../../../../../../wp-load.php' );
global $wpdb;
$table = $wpdb->prefix.'ultimatum_css';
$table2 = $wpdb->prefix.'ultimatum_classes';
if($_POST){
	  $vars=$_POST["cssvar"][$_GET["container"]];
	  foreach($vars as $element=>$property){
	  	$delete = "DELETE FROM $table WHERE container='$_GET[container]' AND layout_id='$_POST[layoutid]' AND element='$element'";
	   	$wpdb->query($delete);
	  	$properties = mysql_escape_string(serialize($property));
	  	$query = "INSERT INTO $table (`container`, `layout_id`, `element`, `properties`) VALUES ('$_GET[container]','$_POST[layoutid]', '$element','$properties')";
	  	$wpdb->query($query);
	  	$query2 = "REPLACE INTO $table2 (`container`, `layout_id`, `user_class`, `hidephone`, `hidetablet`,`hidedesktop`) VALUES ('$_GET[container]','$_POST[layoutid]', '$_POST[user_class]', '$_POST[hidephone]', '$_POST[hidetablet]', '$_POST[hidedesktop]')";
	  	$wpdb->query($query2);
	  }
	  ?>
	  <script type="text/javascript">
	  	self.parent.tb_remove();
	 </script>
	  <?php 
} 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<link rel="stylesheet" href="<?php echo admin_url();?>css/global.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo admin_url();?>css/wp-admin.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo admin_url();?>css/colors-fresh.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo THEME_ADMIN_URI; ?>/css/colorpicker.css" type="text/css" />
    <link rel="stylesheet" media="screen" type="text/css" href="<?php echo THEME_ADMIN_URI; ?>/css/layout.css" />
    <link rel="stylesheet" media="screen" type="text/css" href="<?php echo THEME_ADMIN_URI; ?>/css/admin-style.css" />
	<script type="text/javascript" src="<?php echo THEME_ADMIN_URI; ?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo THEME_ADMIN_URI; ?>/js/colorpicker.js"></script>
    <script type="text/javascript" src="<?php echo THEME_ADMIN_URI; ?>/js/eye.js"></script>
    <script type="text/javascript" src="<?php echo THEME_ADMIN_URI; ?>/js/utils.js"></script>
    <script type="text/javascript" src="<?php echo THEME_ADMIN_URI; ?>/js/jquery-iphone.js"></script>
    <script type="text/javascript" src="<?php echo THEME_ADMIN_URI; ?>/js/layout.js"></script>
    <script type="text/javascript" src="<?php echo THEME_ADMIN_URI; ?>/js/ajaxupload.js"></script>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('.upload_button').each(function(){
			var clickedObject = jQuery(this);
			var clickedID = jQuery(this).attr('id');	
			new AjaxUpload(clickedID, {
				action: '<?php echo admin_url("admin-ajax.php"); ?>',
				name: clickedID, 
				data: { 
					action: 'ultimate_ajax_upload',
					type: 'upload',
					data: clickedID
					},
				autoSubmit: true, 
				responseType: false,
				onChange: function(file, extension){},
				onSubmit: function(file, extension){
					clickedObject.text('Uploading'); 	
					this.disable(); 
					interval = window.setInterval(function(){
						var text = clickedObject.val();
						if (text.length < 13){	clickedObject.val(text + '.'); }
						else { clickedObject.val('Uploading'); } 
					}, 200);
				},
				onComplete: function(file, response) {
					window.clearInterval(interval);
					clickedObject.text('Upload Image');	
					this.enable();
					if(response.search('Upload Error') > -1){
						var buildReturn = '<span class="upload-error">' + response + '</span>';
						jQuery(".upload-error").remove();
						clickedObject.parent().after(buildReturn);
					} else {
						var buildReturn = '<div id="image_'+clickedID+'" style="background-image:url('+response+');width:150px;height:150px;float:right"></div>';
						jQuery(".upload-error").remove();
						jQuery("#bgImage_upload_preview div").remove();	
						jQuery('#bgImage_upload_preview').html(buildReturn);
						//jQuery('div#image_'+clickedID).fadeIn();
						clickedObject.next('span').fadeIn();
						clickedObject.parent().prev('input').val(response);
					}
				}
			});
		});
		jQuery('table.widefat th.top') .click(
				function() {
					jQuery(this) .parents('table.widefat') .children('tbody').slideToggle();

				}
			);
		jQuery('.widefat tbody').hide();
	});
	
	</script>
</head>
<style>
table.widefat {margin-bottom:10px;}
</style>
<body style="padding:5px;">
<p>
<?php _e('Please click on title to set CSS styling for the part you want and click save to make changes happen. The CSS wont be generated till you save the layout!',THEME_ADMIN_LANG_DOMAIN);?>
</p>
<form action="" method="post" enctype="multipart/form-data">
<?php 
global $wpdb;
$table = $wpdb->prefix.'ultimatum_css';
$query = "SELECT * FROM $table WHERE `layout_id`='$_GET[layoutid]' AND `container`='$_GET[container]'";
$result = $wpdb->get_results($query,ARRAY_A);
foreach($result as $fetch){
	$valuez=unserialize($fetch["properties"]);
	foreach($valuez as $key=>$malue){
	$value[$fetch["container"]][$fetch["element"]][$key]=$malue;
	}
}
$table2 = $wpdb->prefix.'ultimatum_classes';
$query2 = "SELECT * FROM $table2 WHERE `container`='$_GET[container]'";
$fetch2 = $wpdb->get_row($query2,ARRAY_A);
	$user_class=$fetch2['user_class'];
	$hide_desktop='';
	$hide_phone='';
	$hide_tablet='';
	if($fetch2['hidephone']=="hidden-phone") $hide_phone=' checked="checked"';
	if($fetch2['hidetablet']=="hidden-tablet") $hide_tablet=' checked="checked"';
	if($fetch2['hidedesktop']=="hidden-desktop") $hide_desktop=' checked="checked"';
	
?>
<table width="100%"  class="widefat" cellspacing="0">
	<thead>
		<tr valign="top">
			<th scope="row" colspan="3" class="top"><?php _e('Background Color and Image',THEME_ADMIN_LANG_DOMAIN);?></th>
		</tr>
	</thead>
	<tbody>
	<tr valign="top">
		<th scope="row">
			<?php _e('Background Color',THEME_ADMIN_LANG_DOMAIN);?>
		</th>
		<td colspan="2">
			<p class="description">
				<?php _e('Select your desired backround color for the body delete the text box content for transparent.',THEME_ADMIN_LANG_DOMAIN);?>
			</p>
			<div id="BgColor" class="cPicker">
			<div class="colorSelector" style="float:left">
				<div style="background-color: #<?php echo $value[$_GET["container"]]["general"]['background-color'];?>"></div>
			</div>
			<input id="bg_color" name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][background-color]" type="text" size="6"  value="<?php echo $value[$_GET["container"]]["general"]['background-color'];?>"/>
			</div>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<?php _e('Background Image',THEME_ADMIN_LANG_DOMAIN);?>
		</th>
		<td>
			<p class="description"><?php _e('Paste the full URL (include <code>http://</code>) of image here or you can insert the image through the button. To remove image just delete the text in field.',THEME_ADMIN_LANG_DOMAIN);?></p>
			<?php 
				$uploader = '';
				$val = $value[$_GET["container"]]["general"]['background-image'];
			    $uploader .= '<input size="75" name="cssvar'.'['.$_GET["container"].'][general][background-image]" id="bgImage_upload" type="text" size="6"  value="'. $val .'" />';
				$uploader .= '<div class="upload_button_div"><input type="button" class="button upload_button" id="bgImage" value="Upload Image" />';
				$uploader .='</div>' . "\n";
				echo $uploader;
				echo '<select name="bg_pattern" onChange="updadePattern(this.options[this.selectedIndex].value,\'bgImage_upload\')">';
				echo '<option value="">Select a pattern</option>';
				for ($k = 1;$k<=62;$k++){
					echo '<option value="'.THEME_URI.'/images/patterns/'.$k.'.png">Pattern-'.$k.'</option>';
				}
				echo '</select>';
			?>
		</td>
		<td style="border: medium none;" id="image_here">
			<?php 
				if(!empty($val)){
					echo '<div id="bgImage_upload_preview" style="background:#'.$value[$_GET["container"]]["general"]['background-color'].';width:150px;height:150px"><div style="background-image:url('.$val.');width:150px;height:150px"></div></div>';
				}
			?>
		</td>
	</tr>
	</tr>
	<tr valign="top">
		<th scope="row"><?php _e('Image Location',THEME_ADMIN_LANG_DOMAIN);?></th>
		<td colspan="2">
			<p class="description"></p>
			<select name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][background-position]">
				<option value="left top" <?php if($value[$_GET["container"]]["general"]['background-position']=='left top'){ echo ' selected="selected"';}?>><?php _e('top left',THEME_ADMIN_LANG_DOMAIN);?></option>
				<option value="right top" <?php if($value[$_GET["container"]]["general"]['background-position']=='right top'){ echo ' selected="selected"';}?>><?php _e('top right',THEME_ADMIN_LANG_DOMAIN);?></option>
				<option value="center top" <?php if($value[$_GET["container"]]["general"]['background-position']=='center top'){ echo ' selected="selected"';}?>><?php _e('top center',THEME_ADMIN_LANG_DOMAIN);?></option>
			 	<option value="left bottom" <?php if($value[$_GET["container"]]["general"]['background-position']=='left bottom'){ echo ' selected="selected"';}?>><?php _e('bottom left',THEME_ADMIN_LANG_DOMAIN);?></option>
				<option value="right bottom" <?php if($value[$_GET["container"]]["general"]['background-position']=='right bottom'){ echo ' selected="selected"';}?>><?php _e('bottom right',THEME_ADMIN_LANG_DOMAIN);?></option>
				<option value="center bottom" <?php if($value[$_GET["container"]]["general"]['background-position']=='center bottom'){ echo ' selected="selected"';}?>><?php _e('bottom center',THEME_ADMIN_LANG_DOMAIN);?></option>
			</select>
			<br />
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><?php _e('Image Repeat',THEME_ADMIN_LANG_DOMAIN);?></th>
		<td colspan="2">
			<p class="description"></p>
			<select name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][background-repeat]">
				<option value="repeat" <?php if($value[$_GET["container"]]["general"]['background-repeat']=='repeat'){ echo ' selected="selected"';}?>><?php _e('repeat',THEME_ADMIN_LANG_DOMAIN);?></option>
				<option value="repeat-x" <?php if($value[$_GET["container"]]["general"]['background-repeat']=='repeat-x'){ echo ' selected="selected"';}?>><?php _e('repeat horizontal',THEME_ADMIN_LANG_DOMAIN);?></option>
				<option value="repeat-y" <?php if($value[$_GET["container"]]["general"]['background-repeat']=='repeat-y'){ echo ' selected="selected"';}?>><?php _e('repeat vertical',THEME_ADMIN_LANG_DOMAIN);?></option>
				<option value="no-repeat" <?php if($value[$_GET["container"]]["general"]['background-repeat']=='no-repeat'){ echo ' selected="selected"';}?>><?php _e('No repeat',THEME_ADMIN_LANG_DOMAIN);?></option>
			</select>
			<br />
		</td>
	</tr>
</tbody>
</table>
<table width="100%"  class="widefat" cellspacing="0">
	<thead>
		<tr valign="top">
			<th scope="row" colspan="4" class="top">
				<?php _e('Borders',THEME_ADMIN_LANG_DOMAIN);?>
			</th>
		</tr>
	</thead>
	<tbody>
	<tr><td></td><th><?php _e('Border Size',THEME_ADMIN_LANG_DOMAIN);?></th><th><?php _e('Border Color',THEME_ADMIN_LANG_DOMAIN);?></th><th><?php _e('Border Style',THEME_ADMIN_LANG_DOMAIN);?></th></tr>
	<tr>
		<th><?php _e('Border Top',THEME_ADMIN_LANG_DOMAIN);?></th>
		<td>
			<select name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][border-top-width]">
			<option value=""><?php _e('select',THEME_ADMIN_LANG_DOMAIN);?></option>
			<?php 
				for($i=0;$i<=5;$i++){
					echo '<option value="'.$i.'px"';
					if($value[$_GET["container"]]["general"]['border-top-width'] &&  $value[$_GET["container"]]["general"]['border-top-width']==$i){ echo ' selected="selected"';}
					echo '>'.$i.'px</option>';
				}
			?>
			</select>
		</td>
		<td>
			<div id="btopcolor" class="cPicker">
				<div class="colorSelector" style="float:left">
					<div style="background-color: #<?php echo $value[$_GET["container"]]["general"]['border-top-color'];?>"></div>
				</div>
				<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][border-top-color]" type="text" size="6"  value="<?php echo $value[$_GET["container"]]["general"]['border-top-color'];?>"/>
				</div>
		</td>
		<td>
			<select name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][border-top-style]">
				<option value="none" <?php if($value[$_GET["container"]]["general"]['border-top-style'] &&  $value[$_GET["container"]]["general"]['border-top-style']=='none'){ echo ' selected="selected"';}?>>none</option>
				<option value="solid" <?php if($value[$_GET["container"]]["general"]['border-top-style'] &&  $value[$_GET["container"]]["general"]['border-top-style']=='solid'){ echo ' selected="selected"';}?>>Solid</option>
				<option value="dotted" <?php if($value[$_GET["container"]]["general"]['border-top-style'] &&  $value[$_GET["container"]]["general"]['border-top-style']=='dotted'){ echo ' selected="selected"';}?>>Dotted</option>
				<option value="dashed" <?php if($value[$_GET["container"]]["general"]['border-top-style'] &&  $value[$_GET["container"]]["general"]['border-top-style']=='dashed'){ echo ' selected="selected"';}?>>Dashed</option>
			</select>
		</td>
	</tr>
		<tr>
		<th><?php _e('Border Bottom',THEME_ADMIN_LANG_DOMAIN);?></th>
		<td>
			<select name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][border-bottom-width]">
			<option value=""><?php _e('select',THEME_ADMIN_LANG_DOMAIN);?></option>
			<?php 
				for($i=0;$i<=5;$i++){
					echo '<option value="'.$i.'px"';
					if($value[$_GET["container"]]["general"]['border-bottom-width'] &&  $value[$_GET["container"]]["general"]['border-bottom-width']==$i){ echo ' selected="selected"';}
					echo '>'.$i.'px</option>';
				}
			?>
			</select>
		</td>
		<td>
			<div id="bbottomcolor" class="cPicker">
				<div class="colorSelector" style="float:left">
					<div style="background-color: #<?php echo $value[$_GET["container"]]["general"]['border-bottom-color'];?>"></div>
				</div>
				<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][border-bottom-color]" type="text" size="6"  value="<?php echo $value[$_GET["container"]]["general"]['border-bottom-color'];?>"/>
				</div>
		</td>
		<td>
			<select name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][border-bottom-style]">
				<option value="none" <?php if($value[$_GET["container"]]["general"]['border-bottom-style'] &&  $value[$_GET["container"]]["general"]['border-bottom-style']=='none'){ echo ' selected="selected"';}?>>none</option>
				<option value="solid" <?php if($value[$_GET["container"]]["general"]['border-bottom-style'] &&  $value[$_GET["container"]]["general"]['border-bottom-style']=='solid'){ echo ' selected="selected"';}?>>Solid</option>
				<option value="dotted" <?php if($value[$_GET["container"]]["general"]['border-bottom-style'] &&  $value[$_GET["container"]]["general"]['border-bottom-style']=='dotted'){ echo ' selected="selected"';}?>>Dotted</option>
				<option value="dashed" <?php if($value[$_GET["container"]]["general"]['border-bottom-style'] &&  $value[$_GET["container"]]["general"]['border-bottom-style']=='dashed'){ echo ' selected="selected"';}?>>Dashed</option>
			</select>
		</td>
	</tr>
	<?php if(!eregi('wrapper-',$_GET["container"])) {?>
	<tr>
		<th><?php _e('Border Left',THEME_ADMIN_LANG_DOMAIN);?></th>
		<td>
			<select name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][border-left-width]">
			<option value=""><?php _e('select',THEME_ADMIN_LANG_DOMAIN);?></option>
			<?php 
				for($i=0;$i<=5;$i++){
					echo '<option value="'.$i.'px"';
					if($value[$_GET["container"]]["general"]['border-left-width'] &&  $value[$_GET["container"]]["general"]['border-left-width']==$i){ echo ' selected="selected"';}
					echo '>'.$i.'px</option>';
				}
			?>
			</select>
		</td>
		<td>
			<div id="bleftcolor" class="cPicker">
				<div class="colorSelector" style="float:left">
					<div style="background-color: #<?php echo $value[$_GET["container"]]["general"]['border-left-color'];?>"></div>
				</div>
				<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][border-left-color]" type="text" size="6"  value="<?php echo $value[$_GET["container"]]["general"]['border-left-color'];?>"/>
				</div>
		</td>
		<td>
			<select name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][border-left-style]">
				<option value="none" <?php if($value[$_GET["container"]]["general"]['border-left-style'] &&  $value[$_GET["container"]]["general"]['border-left-style']=='none'){ echo ' selected="selected"';}?>>none</option>
				<option value="solid" <?php if($value[$_GET["container"]]["general"]['border-left-style'] &&  $value[$_GET["container"]]["general"]['border-left-style']=='solid'){ echo ' selected="selected"';}?>>Solid</option>
				<option value="dotted" <?php if($value[$_GET["container"]]["general"]['border-left-style'] &&  $value[$_GET["container"]]["general"]['border-left-style']=='dotted'){ echo ' selected="selected"';}?>>Dotted</option>
				<option value="dashed" <?php if($value[$_GET["container"]]["general"]['border-left-style'] &&  $value[$_GET["container"]]["general"]['border-left-style']=='dashed'){ echo ' selected="selected"';}?>>Dashed</option>
			</select>
		</td>
	</tr>
	<tr>
		<th><?php _e('Border right',THEME_ADMIN_LANG_DOMAIN);?></th>
		<td>
			<select name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][border-right-width]">
			<option value=""><?php _e('select',THEME_ADMIN_LANG_DOMAIN);?></option>
			<?php 
				for($i=0;$i<=5;$i++){
					echo '<option value="'.$i.'px"';
					if($value[$_GET["container"]]["general"]['border-right-width'] &&  $value[$_GET["container"]]["general"]['border-right-width']==$i){ echo ' selected="selected"';}
					echo '>'.$i.'px</option>';
				}
			?>
			</select>
		</td>
		<td>
			<div id="brightcolor" class="cPicker">
				<div class="colorSelector" style="float:left">
					<div style="background-color: #<?php echo $value[$_GET["container"]]["general"]['border-right-color'];?>"></div>
				</div>
				<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][border-right-color]" type="text" size="6"  value="<?php echo $value[$_GET["container"]]["general"]['border-right-color'];?>"/>
				</div>
		</td>
		<td>
			<select name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][border-right-style]">
				<option value="none" <?php if($value[$_GET["container"]]["general"]['border-right-style'] &&  $value[$_GET["container"]]["general"]['border-right-style']=='none'){ echo ' selected="selected"';}?>>none</option>
				<option value="solid" <?php if($value[$_GET["container"]]["general"]['border-right-style'] &&  $value[$_GET["container"]]["general"]['border-right-style']=='solid'){ echo ' selected="selected"';}?>>Solid</option>
				<option value="dotted" <?php if($value[$_GET["container"]]["general"]['border-right-style'] &&  $value[$_GET["container"]]["general"]['border-right-style']=='dotted'){ echo ' selected="selected"';}?>>Dotted</option>
				<option value="dashed" <?php if($value[$_GET["container"]]["general"]['border-right-style'] &&  $value[$_GET["container"]]["general"]['border-right-style']=='dashed'){ echo ' selected="selected"';}?>>Dashed</option>
			</select>
		</td>
	</tr>
	<?php } ?>
	</tbody>
</table>
<!-- BG TABLE DONE -->
<table width="100%"  class="widefat" cellspacing="0">
	<thead>
		<tr valign="top">
			<th scope="row" colspan="9" class="top">
				<?php _e('Height / Margin / Padding',THEME_ADMIN_LANG_DOMAIN);?>
			</th>
		</tr>
	</thead>
	<tbody>
	<tr>
		<th><?php _e('Height',THEME_ADMIN_LANG_DOMAIN);?></th>
		<td colspan="8">
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][min-height]" value="<?php echo $value[$_GET["container"]]["general"]['min-height'];?>" type="text" size="2">px
		</td>
	</tr>
	<tr>
		<th>
			<?php _e('Margin',THEME_ADMIN_LANG_DOMAIN);?>
		</th>
		<td>
			<?php _e('margin top',THEME_ADMIN_LANG_DOMAIN);?><br />
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][margin-top]" value="<?php echo $value[$_GET["container"]]["general"]['margin-top'];?>" type="text" size="2">px
		</td>
		<td colspan="5">
			<?php _e('margin bottom',THEME_ADMIN_LANG_DOMAIN);?>
			<br />
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][margin-bottom]" value="<?php echo $value[$_GET["container"]]["general"]['margin-bottom'];?>" type="text" size="2">px
		</td>
	</tr>
	<tr>
		<th>
			<?php _e('padding',THEME_ADMIN_LANG_DOMAIN);?>
		</th>
		<td>
			<?php _e('padding top',THEME_ADMIN_LANG_DOMAIN);?>
			<br/>
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][padding-top]" value="<?php echo $value[$_GET["container"]]["general"]['padding-top'];?>" type="text" size="2">px
		</td>
		<td>
			<?php _e('padding bottom',THEME_ADMIN_LANG_DOMAIN);?>
			<br />
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][padding-bottom]" value="<?php echo $value[$_GET["container"]]["general"]['padding-bottom'];?>" type="text" size="2">px
		</td>
		<?php if(eregi('col-',$_GET["container"])) {?>
		<td>
			<?php _e('padding left',THEME_ADMIN_LANG_DOMAIN);?>
			<br />
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][padding-left]" value="<?php echo $value[$_GET["container"]]["general"]['padding-left'];?>" type="text" size="2">px
		</td>
		<td>
			<?php _e('padding right',THEME_ADMIN_LANG_DOMAIN);?>
			<br />
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][padding-right]" value="<?php echo $value[$_GET["container"]]["general"]['padding-right'];?>" type="text" size="2">px
		</td>
		<?php }?>
	</tr>
	<tr>
		<th>
			<?php _e('Margin Between Widgets',THEME_ADMIN_LANG_DOMAIN);?>
		</th>
		<td colspan="5">
			<?php _e('margin bottom',THEME_ADMIN_LANG_DOMAIN);?>
			<br />
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[.inner-container][margin-bottom]" value="<?php echo $value[$_GET["container"]]['.inner-container']['margin-bottom'];?>" type="text" size="2">px
		</td>
	</tr>
</tbody>
</table>
<table class="widefat">
	<thead>
		<tr>
			<th class="top" colspan="4"><?php _e('Font Styling',THEME_ADMIN_LANG_DOMAIN);?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td></td>
			<td><?php _e('Color',THEME_ADMIN_LANG_DOMAIN);?></td>
			<td><?php _e('Font Size',THEME_ADMIN_LANG_DOMAIN);?></td>
			<td><?php _e('Line Height',THEME_ADMIN_LANG_DOMAIN);?></td>
		</tr>
		<tr>
			<th width="100">
				<?php _e('General Font',THEME_ADMIN_LANG_DOMAIN);?>
			</th>
			<td>
				<div id="color" class="cPicker">
				<div class="colorSelector" style="float:left">
					<div style="background-color: #<?php echo $value[$_GET["container"]]["general"]['color'];?>"></div>
				</div>
				<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][color]" type="text" size="6"  value="<?php echo $value[$_GET["container"]]["general"]['color'];?>"/>
				</div>
			</td>
			<td>
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][font-size]" type="text" value="<?php echo $value[$_GET["container"]]["general"]['font-size'];?>" size="3" />px
			</td>
			<td>
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[general][line-height]" type="text" value="<?php echo $value[$_GET["container"]]["general"]['line-height'];?>" size="3" />px
			</td>
		</tr>
		<tr>
			<th>
				H1
			</th>
			<td>
				<div id="h1color" class="cPicker" style="width:100%">
				<div class="colorSelector" style="float:left">
					<div style="background-color: #<?php echo $value[$_GET["container"]]["h1"]['color'];?>"></div>
				</div>
				<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[h1][color]" type="text" size="6"  value="<?php echo $value[$_GET["container"]]["h1"]['color'];?>"/>
				</div>
			</td>
			<td>
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[h1][font-size]" type="text" value="<?php echo $value[$_GET["container"]]["h1"]['font-size'];?>" size="3" />px
			</td>
			<td>
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[h1][line-height]" type="text" value="<?php echo $value[$_GET["container"]]["h1"]['line-height'];?>" size="3" />px
			</td>
		</tr>
		<tr>
			<th>
				H2
			</th>
			<td>
				<div id="h2color" class="cPicker">
				<div class="colorSelector" style="float:left">
					<div style="background-color: #<?php echo $value[$_GET["container"]]["h2"]['color'];?>"></div>
				</div>
				<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[h2][color]" type="text" size="6"  value="<?php echo $value[$_GET["container"]]["h2"]['color'];?>"/>
				</div>
			</td>
			<td>
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[h2][font-size]" type="text" value="<?php echo $value[$_GET["container"]]["h2"]['font-size'];?>" size="3" />px
			</td>
			<td>
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[h2][line-height]" type="text" value="<?php echo $value[$_GET["container"]]["h2"]['line-height'];?>" size="3" />px
			</td>
		</tr>
		<tr>
			<th>
				H3
			</th>
			<td>
				<div id="h3color" class="cPicker">
				<div class="colorSelector" style="float:left">
					<div style="background-color: #<?php echo $value[$_GET["container"]]["h3"]['color'];?>"></div>
				</div>
				<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[h3][color]" type="text" size="6"  value="<?php echo $value[$_GET["container"]]["h3"]['color'];?>"/>
				</div>
			</td>
			<td>
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[h3][font-size]" type="text" value="<?php echo $value[$_GET["container"]]["h3"]['font-size'];?>" size="3" />px
			</td>
			<td>
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[h3][line-height]" type="text" value="<?php echo $value[$_GET["container"]]["h3"]['line-height'];?>" size="3" />px
			</td>
		</tr>
		<tr>
			<th>
				H4
			</th>
			<td>
				<div id="h4color" class="cPicker">
				<div class="colorSelector" style="float:left">
					<div style="background-color: #<?php echo $value[$_GET["container"]]["h4"]['color'];?>"></div>
				</div>
				<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[h4][color]" type="text" size="6"  value="<?php echo $value[$_GET["container"]]["h4"]['color'];?>"/>
				</div>
			</td>
			<td>
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[h4][font-size]" type="text" value="<?php echo $value[$_GET["container"]]["h4"]['font-size'];?>" size="3" />px
			</td>
			<td>
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[h4][line-height]" type="text" value="<?php echo $value[$_GET["container"]]["h4"]['line-height'];?>" size="3" />px
			</td>
		</tr>
		<tr>
			<th>
				H5
			</th>
			<td>
				<div id="h5color" class="cPicker">
				<div class="colorSelector" style="float:left">
					<div style="background-color: #<?php echo $value[$_GET["container"]]["h5"]['color'];?>"></div>
				</div>
				<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[h5][color]" type="text" size="6"  value="<?php echo $value[$_GET["container"]]["h5"]['color'];?>"/>
				</div>
			</td>
			<td>
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[h5][font-size]" type="text" value="<?php echo $value[$_GET["container"]]["h5"]['font-size'];?>" size="3" />px
			</td>
			<td>
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[h5][line-height]" type="text" value="<?php echo $value[$_GET["container"]]["h5"]['line-height'];?>" size="3" />px
			</td>
		</tr>
		<tr>
			<th>
				H6
			</th>
			<td>
				<div id="h6color" class="cPicker">
				<div class="colorSelector" style="float:left">
					<div style="background-color: #<?php echo $value[$_GET["container"]]["h6"]['color'];?>"></div>
				</div>
				<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[h6][color]" type="text" size="6"  value="<?php echo $value[$_GET["container"]]["h6"]['color'];?>"/>
				</div>
			</td>
			<td>
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[h6][font-size]" type="text" value="<?php echo $value[$_GET["container"]]["h6"]['font-size'];?>" size="3" />px
			</td>
			<td>
			<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[h6][line-height]" type="text" value="<?php echo $value[$_GET["container"]]["h6"]['line-height'];?>" size="3" />px
			</td>
		</tr>
		<tr>
			<th>
				a
			</th>
			<td>
				<div id="a" class="cPicker">
				<div class="colorSelector" style="float:left">
					<div style="background-color: #<?php echo $value[$_GET['container']]['a']['color'];?>"></div>
				</div>
				<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[a][color]" type="text" size="6"  value="<?php echo $value[$_GET["container"]]["a"]['color'];?>"/>
				</div>
			</td>
		</tr>
		<tr>
			<th>
				a:hover
			</th>
			<td>
				<div id="ahover" class="cPicker">
				<div class="colorSelector" style="float:left">
					<div style="background-color: #<?php echo $value[$_GET['container']]['ahover']['color'];?>"></div>
				</div>
				<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[ahover][color]" type="text" size="6"  value="<?php echo $value[$_GET["container"]]["ahover"]['color'];?>"/>
				</div>
			</td>
		</tr>
		<tr>
			<th>
				<?php _e('button text',THEME_ADMIN_LANG_DOMAIN);?>
			</th>
			<td>
				<div id="button" class="cPicker">
				<div class="colorSelector" style="float:left">
					<div style="background-color: #<?php echo $value[$_GET['container']]['.button']['color'];?>"></div>
				</div>
				<input name="cssvar<?php echo '['.$_GET["container"].']'; ?>[.button][color]" type="text" size="6"  value="<?php echo $value[$_GET["container"]]['.button']['color'];?>"/>
				</div>
			</td>
		</tr>
	</tbody>
</table>
<table class="widefat">
	<thead>
		<tr>
			<th class="top" colspan="2"><?php _e('Additional Classes',THEME_ADMIN_LANG_DOMAIN);?></th>
		</tr>
	</thead>
	<tbody>
	<tr><td><?php _e('Custom CSS Classes',THEME_ADMIN_LANG_DOMAIN)?></td><td><i><?php _e('Add any classes you want for extra styling in your custom CSS with spaces in between. eg. class1 class2 ',THEME_ADMIN_LANG_DOMAIN);?></i><br /></br><input type="text" name="user_class" value="<?php echo $user_class;?>" /></td></tr>
	<tr><td><?php _e('Hide Form Desktop',THEME_ADMIN_LANG_DOMAIN)?></td><td><i><?php _e('If the layout is responsive this option will make sure the element selected will not show for desktops',THEME_ADMIN_LANG_DOMAIN);?></i><input type="checkbox" name="hidedesktop" value="hidden-desktop" <?php echo $hide_desktop;?> /></td></tr>
	<tr><td><?php _e('Hide From Tablets',THEME_ADMIN_LANG_DOMAIN)?></td><td><i><?php _e('If the layout is responsive this option will make sure the element selected will not show for tablets',THEME_ADMIN_LANG_DOMAIN);?></i><input type="checkbox" name="hidetablet" value="hidden-tablet" <?php echo $hide_tablet;?> /></td></tr>
	<tr><td><?php _e('Hide from Phones',THEME_ADMIN_LANG_DOMAIN)?></td><td><i><?php _e('If the layout is responsive this option will make sure the element selected will not show for phones',THEME_ADMIN_LANG_DOMAIN);?></i><input type="checkbox" name="hidephone" value="hidden-phone" <?php echo $hide_phone;?> /></td></tr>
	</tbody>
</table>
<input type="submit" value="<?php _e('Save',THEME_ADMIN_LANG_DOMAIN);?>" class="button-primary"/><input type="button" value="Cancel" onClick="self.parent.tb_remove();" class="button-primary"/>
<input type="hidden" name="layoutid" value="<?php echo $_GET["layoutid"];?>" />

</form>
</body>
</html>