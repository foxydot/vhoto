<?php 
function codeGeneratorChart(){
	if($_POST){
		$content.='[chart ';
		foreach ($_POST as $key=>$value){
			if($key!='content' && $key!='save_style'){
				$content.=$key.'="'.$value.'" ';
			}
		}
		$content .=']';
		?>
		<script>
			var theCode ='<?php echo str_replace("\r\n", "<br />",$content).' ';?>';
			insertUltimateContent(theCode);
		</script>
	<?php
	}
	?>
	<h2><?php _e('Insert Chart',THEME_ADMIN_LANG_DOMAIN);?></h2>
	<form method="post" action="">
	<table>
		<tr valign="top">
			<td width="40%">
				<table>
					<tr>
						<td><?php _e('Chart Title',THEME_ADMIN_LANG_DOMAIN);?></td>
						<td><input type="text" name="title" value="<?php _e('Chart Title',THEME_ADMIN_LANG_DOMAIN);?>" /></td>
					</tr>
					<tr>
						<td><?php _e('Chart Background',THEME_ADMIN_LANG_DOMAIN);?></td>
						<td><input type="text" name="bg" value="ffffff" /></td>
					</tr>
					<tr>
						<td><?php _e('Chart Type',THEME_ADMIN_LANG_DOMAIN);?></td>
						<td>
							<select name="type">
								<option value="pie"><?php _e('3D Pie Chart',THEME_ADMIN_LANG_DOMAIN);?></option>
								<option value="pie2d"><?php _e('2D Pie Chart',THEME_ADMIN_LANG_DOMAIN);?></option>
								<option value="line"><?php _e('Line Chart',THEME_ADMIN_LANG_DOMAIN);?></option>
								<option value="xyline"><?php _e('XY Line Chart',THEME_ADMIN_LANG_DOMAIN);?></option>
								<option value="sparkline"><?php _e('Sparkline Chart',THEME_ADMIN_LANG_DOMAIN);?></option>
								<option value="meter"><?php _e('Meter Chart',THEME_ADMIN_LANG_DOMAIN);?></option>
								<option value="scatter"><?php _e('Scatter Chart',THEME_ADMIN_LANG_DOMAIN);?></option>
								<option value="venn"><?php _e('Venn Chart',THEME_ADMIN_LANG_DOMAIN);?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php _e('Width',THEME_ADMIN_LANG_DOMAIN);?></td>
						<td><input type="text" name="width" value="450" /></td>
					</tr>
					<tr>
						<td><?php _e('Height',THEME_ADMIN_LANG_DOMAIN);?></td>
						<td><input type="text" name="height" value="200" /></td>
					</tr>
				</table>
			</td>
			<td>
				<table>
					<tr valign="top">
						<td><?php _e('Labels',THEME_ADMIN_LANG_DOMAIN);?>:</td>
						<td><textarea name="labels" rows="4" cols="40"></textarea></td>
						<td><?php _e('Type your labels comma(,) seperated',THEME_ADMIN_LANG_DOMAIN);?></td>
					</tr>
					<tr valign="top">
						<td><?php _e('Data',THEME_ADMIN_LANG_DOMAIN);?></td>
						<td><textarea name="data" rows="4" cols="40"></textarea></td>
						<td><?php _e('Type your Data comma (,) seperated',THEME_ADMIN_LANG_DOMAIN);?></td>
					</tr>
					<tr valign="top">
						<td><?php _e('Colors',THEME_ADMIN_LANG_DOMAIN);?></td>
						<td><textarea name="colors" rows="4" cols="40"></textarea></td>
						<td><?php _e('Type colors comma(,) seperated eg. FFFFFF,F0F0F0',THEME_ADMIN_LANG_DOMAIN);?></td>
					</tr>
				</table>
			
			</td>
		</tr>
	</table>
	<input class="button-primary" type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)">&nbsp;
	<input type="submit"class="button-primary" value="<?php _e('Insert',THEME_ADMIN_LANG_DOMAIN);?>"/>
	</form>
	<?php 
}




function codeGeneratorVideo(){
	if($_POST){
		$content.='[video ';
		foreach ($_POST as $key=>$value){
			if($key!='content' && $key!='save_style'){
				$content.=$key.'="'.$value.'" ';
			}
		}
		$content .=']'.($_POST[content]).'[/video]';
		?>
		<script>
			var theCode ='<?php echo str_replace("\r\n", "<br />",$content).' ';?>';
			insertUltimateContent(theCode);
		</script>
	<?php
	}
	?>
	<h2><?php _e('Insert Video',THEME_ADMIN_LANG_DOMAIN);?></h2>
	<form method="post" action="">
	<table>
	<tr><td><?php _e('Video URL',THEME_ADMIN_LANG_DOMAIN);?></td><td><input type="text" name="content" size="50" /></td></tr>
	<tr><td><?php _e('Video Width',THEME_ADMIN_LANG_DOMAIN);?></td><td><input type="text" name="width" value="600" /></td></tr>
	<tr><td><?php _e('Video Height',THEME_ADMIN_LANG_DOMAIN);?></td><td><input type="text" name="height" value="400" /></td></tr>
	</table>
	<input class="button-primary"  type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)">&nbsp;
	<input type="submit"class="button-primary" value="<?php _e('Insert',THEME_ADMIN_LANG_DOMAIN);?>"/>
	</form>
	<?php 
}


function codeGeneratorToggle(){
	if($_POST){
		$content.='[toggle ';
		foreach ($_POST as $key=>$value){
			if($key!='content' && $key!='save_style'){
				$content.=$key.'="'.$value.'" ';
			}
		}
		$content .=']'.($_POST[content]).'[/toggle]';
		?>
		<script>
			var theCode ='<?php echo str_replace("\r\n", "<br />",$content).' ';?>';
			insertUltimateContent(theCode);
		</script>
	<?php
	}
	?>
	<h2><?php _e('Insert Toggle Text',THEME_ADMIN_LANG_DOMAIN);?></h2>
	<form method="post" action="">
	<table>
	<tr><td><?php _e('Title',THEME_ADMIN_LANG_DOMAIN);?> :</td><td><input type="text" name="title" value="<?php _e('Title',THEME_ADMIN_LANG_DOMAIN);?>" /></td></tr>
	<tr>
		<td><?php _e('Text',THEME_ADMIN_LANG_DOMAIN);?></td>
		<td>
			<textarea name="content" rows="10" cols="50"><?php _e('Type your text here...',THEME_ADMIN_LANG_DOMAIN);?></textarea>
		</td>
	</tr>
	
	</table>
	<input class="button-primary"  type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)">&nbsp;
	<input type="submit"class="button-primary" value="<?php _e('Insert',THEME_ADMIN_LANG_DOMAIN);?>"/>
	</form>
	<?php 
}

function codeGeneratorContent(){
	global $wpdb;
	$termstable = $wpdb->prefix.'ultimatum_tax';
	if($_POST){
			foreach ($_POST as $key=>$value){
				if($key!='insert')
				$content .= $key.'="'.$value.'" ';
			}
			$content = '[content '.$content.'] ';
			?>
			<script>
			var theCode ='<?php echo str_replace("\r\n", "<br />",$content).' ';?>';
			insertUltimateContent(theCode);
		</script>
			<?php 
			
		}
	?>
	<h2><?php _e( 'Insert Content Items' ,THEME_ADMIN_LANG ); ?></h2>
	<i style="color:red;font-weight:bold"><?php _e( 'Do not use this in Column Layout!!' ,THEME_ADMIN_LANG ); ?></i><br />
	<form method="post" action="">
	<label for="<?php echo ('source'); ?>"><?php _e( 'Select Content Source' ,THEME_ADMIN_LANG ); ?></label>
		<select  name="<?php echo ('source'); ?>" id="<?php echo ('source'); ?>" >
		<optgroup label="Post Type">
		<?php 
			$args=array('public'   => true,'publicly_queryable' => true);
			$post_types=get_post_types($args,'names');
			foreach ($post_types as $post_type ) {
				if($post_type!='attachment')
				echo '<option value="ptype-'.$post_type.'">'.$post_type.'</option>';
			}
		?>
		</optgroup>
		<?php 
		$entries = get_categories('title_li=&orderby=name&hide_empty=0');
		if(count($entries)>=1){
			echo '<optgroup label="Categories(Post)">';
			foreach ($entries as $key => $entry) {
				echo '<option value="cat-'.$entry->term_id.'" '.selected($source,'cat-'.$entry->term_id,false).'>'.$entry->name.'</option>';
			}
			echo '</optgroup>';
		}
			?>
		<?php 
		
		$termsql = "SELECT * FROM $termstable";
		$termresult = $wpdb->get_results($termsql,ARRAY_A);
		foreach ($termresult as $term){
			$properties = unserialize($term["properties"]);
			echo '<optgroup label="'.$properties["label"].'('.$term["pname"].')">';
			$entries = get_terms($term["tname"],'orderby=name&hide_empty=0');
			foreach($entries as $key => $entry) {
				$optiont='taxonomy-'.$term["pname"].'|'.$term["tname"].'|'.$entry->slug;
				echo '<option value="'.$optiont.'" '.selected($source,$optiont,false).'>'.$entry->name.'</option>';
				}
			echo '</optgroup>';
		}
		
		?>
		</select>
	<p>
		<label for="<?php echo ('layout'); ?>"><?php _e('Layout:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<select name="<?php echo ('layout'); ?>" id="<?php echo ('layout'); ?>">
			<option value="1-col-i" <?php selected($multiple,'1-col-i');?>><?php _e('One Column With Full Image',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="1-col-li" <?php selected($multiple,'1-col-li');?>><?php _e('One Column With Image On Left',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="1-col-ri" <?php selected($multiple,'1-col-ri');?>><?php _e('One Column With Image On Right',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="1-col-gl" <?php selected($multiple,'1-col-gl');?>><?php _e('One Column Gallery With Image On Left' ,THEME_ADMIN_LANG ); ?></option>
			<option value="1-col-gr" <?php selected($multiple,'1-col-gr');?>><?php _e('One Column Gallery With Image On Right' ,THEME_ADMIN_LANG ); ?></option>
			<option value="1-col-n" <?php selected($multiple,'1-col-n');?>><?php _e('One Column With No Image' ,THEME_ADMIN_LANG ); ?></option>
			<option value="2-col-i" <?php selected($multiple,'2-col-i');?>><?php _e('Two Columns With Image' ,THEME_ADMIN_LANG ); ?></option>
			<option value="2-col-g" <?php selected($multiple,'2-col-g');?>><?php _e('Two Columns Gallery' ,THEME_ADMIN_LANG ); ?></option>
			<option value="2-col-n" <?php selected($multiple,'2-col-n');?>><?php _e('Two Columns With No Image' ,THEME_ADMIN_LANG ); ?></option>
			<option value="3-col-i" <?php selected($multiple,'3-col-i');?>><?php _e('Three Columns With Image' ,THEME_ADMIN_LANG ); ?></option>
			<option value="3-col-g" <?php selected($multiple,'3-col-g');?>><?php _e('Three Columns Gallery' ,THEME_ADMIN_LANG ); ?></option>
			<option value="3-col-n" <?php selected($multiple,'3-col-n');?>><?php _e('Three Columns With No Image' ,THEME_ADMIN_LANG ); ?></option>
			<option value="4-col-i" <?php selected($multiple,'4-col-i');?>><?php _e('Four Columns With Image' ,THEME_ADMIN_LANG ); ?></option>
			<option value="4-col-g" <?php selected($multiple,'4-col-g');?>><?php _e('Four Columns Gallery' ,THEME_ADMIN_LANG ); ?></option>
			<option value="4-col-n" <?php selected($multiple,'4-col-n');?>><?php _e('Four Columns With No Image' ,THEME_ADMIN_LANG ); ?></option>
		</select>
		</p>
		<p>
		<label for="<?php echo ('width'); ?>"><?php _e('Image Width:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<input type="text" value="<?php echo $width;?>" name="<?php echo ('width'); ?>" id="<?php echo ('width'); ?>" /><i><?php _e('Applied on Image on Left/Right Aligned pages' ,THEME_ADMIN_LANG ); ?></i>
		</p>
		<p>
		<label for="<?php echo ('height'); ?>"><?php _e('Image Height:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<input type="text" value="220" name="<?php echo ('height'); ?>" id="<?php echo ('multipleh'); ?>" />
		</p>
		<p>
		<label for="<?php echo ('meta'); ?>"><?php _e('Meta:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<select name="<?php echo ('meta'); ?>" id="<?php echo ('mmeta'); ?>">
		<option value="atitle" <?php selected($mmeta,'atitle');?>><?php _e('After Title',THEME_ADMIN_LANG_DOMAIN) ?></option>
		<option value="aimage" <?php selected($mmeta,'aimage');?>><?php _e('After Image',THEME_ADMIN_LANG_DOMAIN) ?></option>
		<option value="atext" <?php selected($mmeta,'atext');?>><?php _e('After Content',THEME_ADMIN_LANG_DOMAIN) ?></option>
		<option value="false" <?php selected($mmeta,'false');?>>OFF</option>
		</select>
		</p>
		<fieldset><legend><?php _e('Meta Variables',THEME_ADMIN_LANG_DOMAIN);?></legend>
		<p>
		<label for="<?php echo ('mdate'); ?>"><?php _e('Date:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<select name="<?php echo ('mdate'); ?>" id="<?php echo ('mdate'); ?>">
		<option value="true" <?php selected($mdate,'true');?>>ON</option>
		<option value="false" <?php selected($mdate,'false');?>>OFF</option>
		</select>
		
		<label for="<?php echo ('mauthor'); ?>"><?php _e('Author:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<select name="<?php echo ('mauthor'); ?>" id="<?php echo ('mauthor'); ?>">
		<option value="true" <?php selected($mauthor,'true');?>>ON</option>
		<option value="false" <?php selected($mauthor,'false');?>>OFF</option>
		</select>
		
		<label for="<?php echo ('mcomments'); ?>"><?php _e('Comments:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<select name="<?php echo ('mcomments'); ?>" id="<?php echo ('mcomments'); ?>">
		<option value="true" <?php selected($mcomments,'true');?>>ON</option>
		<option value="false" <?php selected($mcomments,'false');?>>OFF</option>
		</select>
		
		<label for="<?php echo ('mtags'); ?>"><?php _e('Tags:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<select name="<?php echo ('mtags'); ?>" id="<?php echo ('mtags'); ?>">
		<option value="true" <?php selected($mtags,'true');?>>ON</option>
		<option value="false" <?php selected($mtags,'false');?>>OFF</option>
		</select>
		
		<label for="<?php echo ('mcats'); ?>"><?php _e('Categories:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<select name="<?php echo ('mcats'); ?>" id="<?php echo ('mcats'); ?>">
		<option value="true" <?php selected($mcats,'true');?>>ON</option>
		<option value="false" <?php selected($mcats,'false');?>>OFF</option>
		</select>
		</p>
		</fieldset>
		<p></p>
	<input class="button-primary"  type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)">&nbsp;
	<input type="submit"class="button-primary" value="<?php _e('Insert',THEME_ADMIN_LANG_DOMAIN);?>"/>
	</form>
	<?php
}


function codeGeneratorMap(){
if($_POST){
		$content= '[googlemap ';
		foreach($_POST as $key=>$value){
			$content.=$key.'="'.$value.'" ';
		}
		$content.= '] ';
		?>
		<script>
			var theCode ='<?php echo str_replace("\r\n", "<br />",$content).' ';?>';
			insertUltimateContent(theCode);
		</script>
		<?php 
	}
	?>
	<h2><?php _e('Insert a Map',THEME_ADMIN_LANG_DOMAIN);?></h2>
	<form action="" method="post">
<table>
	<tr>
		<td><?php _e('Width', THEME_ADMIN_LANG_DOMAIN); ?></td>
		<td>
			<input value="0" name="width" type="text" /><i><?php _e('Enter 0 for full width', THEME_ADMIN_LANG_DOMAIN); ?></i>
			
		</td>
	</tr>
	<tr>
		<td><?php _e('Height', THEME_ADMIN_LANG_DOMAIN); ?></td>
		<td><input value="400" name="height" type="text" />
		</td>
	</tr>
	<tr>
		<td><?php _e('Address (optional)', THEME_ADMIN_LANG_DOMAIN); ?></td>
		<td><input name="address" size="30" value="" type="text"></td>
	</tr>
	<tr>
		<td><?php _e('Latitude',THEME_ADMIN_LANG_DOMAIN);?>:</td>
		<td><input name="latitude" id="latitude" size="30" value="" type="text"></td>
	</tr>
	<tr>
		<td><?php _e('Longitude',THEME_ADMIN_LANG_DOMAIN);?></td>
		<td><input name="longitude" size="30" value="" type="text"></td>
	</tr>
	<tr>
		<td><?php _e('Zoom',THEME_ADMIN_LANG_DOMAIN);?></td>
		<td><select name="zoom">
		<option value="7">7</option>
		<?php 
		for($i=1;$i<=19;$i++){
			echo '<option value="'.$i.'">'.$i.'"</option>';
		}
		?>
		</select></td>
	</tr>
	<tr>
		<td><?php _e('Marker',THEME_ADMIN_LANG_DOMAIN);?></td>
		<td><input name="marker" value="true" checked="checked" type="checkbox"></td>
	</tr>
	<tr>
		<td><?php _e('Html',THEME_ADMIN_LANG_DOMAIN);?></td>
		<td><input name="html"  size="30" value="" type="text"></td>
	</tr>
	<tr>
		<td><?php _e('Popup Marker',THEME_ADMIN_LANG_DOMAIN);?></td>
		<td><input name="popup" id="popup" value="true" type="checkbox"></td>
	
		<td><?php _e('Controls',THEME_ADMIN_LANG_DOMAIN);?></td>
		<td><input name="controls" id="controls" value="true" type="checkbox"></td>
	</tr>
	<tr>
		<td><?php _e('panControl',THEME_ADMIN_LANG_DOMAIN);?></td>
		<td><input name="panControl" id="panControl" value="true" type="checkbox"></td>
	
		<td><?php _e('zoomControl',THEME_ADMIN_LANG_DOMAIN);?></td>
		<td><input name="zoomControl" id="zoomControl" value="true" type="checkbox"></td>
	</tr>
	<tr>
		<td><?php _e('doubleclickzoom',THEME_ADMIN_LANG_DOMAIN);?></td>
		<td><input name="doubleclickzoom" id="doubleclickzoom" value="true" type="checkbox"></td>
	
		<td><?php _e('mapTypeControl',THEME_ADMIN_LANG_DOMAIN);?></td>
		<td><input name="mapTypeControl" id="mapTypeControl" value="true" type="checkbox"></td>
	</tr>
	<tr>
		<td><?php _e('scaleControl',THEME_ADMIN_LANG_DOMAIN);?></td>
		<td><input name="scaleControl" id="scaleControl" value="true" type="checkbox"></td>
	
		<td><?php _e('streetViewControl',THEME_ADMIN_LANG_DOMAIN);?></td>
		<td><input name="streetViewControl" id="streetViewControl" value="true" type="checkbox"></td>
	</tr>
	<tr>
		<td><?php _e('overviewMapControl',THEME_ADMIN_LANG_DOMAIN);?></td>
		<td><input name="overviewMapControl" id="overviewMapControl" value="true" type="checkbox"></td>
	
		<td><?php _e('Scrollwheel',THEME_ADMIN_LANG_DOMAIN);?></td>
		<td><input name="scrollwheel" value="true" type="checkbox" /></td>
	</tr>
	<tr>
		<td><?php _e('Map Type',THEME_ADMIN_LANG_DOMAIN);?></td>
		<td>
		<select name="maptype" id="maptype">
			<option value="G_NORMAL_MAP" selected="selected"><?php _e('Default road map',THEME_ADMIN_LANG_DOMAIN);?></option>
			<option value="G_SATELLITE_MAP"><?php _e('Google Earth satellite',THEME_ADMIN_LANG_DOMAIN);?></option>
			<option value="G_HYBRID_MAP"><?php _e('Mixture of normal and satellite',THEME_ADMIN_LANG_DOMAIN);?></option>
			<option value="G_DEFAULT_MAP_TYPES"><?php _e('Mixture of above three maps',THEME_ADMIN_LANG_DOMAIN);?></option>
			<option value="G_PHYSICAL_MAP"><?php _e('Physical map',THEME_ADMIN_LANG_DOMAIN);?></option>
		</select>
		</td>
	</tr>
	<tr>
		<td><?php _e('Align',THEME_ADMIN_LANG_DOMAIN);?></td>
		<td>
		<select name="align" id="align">
			<option value="left" selected="selected"><?php _e('Left',THEME_ADMIN_LANG_DOMAIN);?></option>
			<option value="right"><?php _e('Right',THEME_ADMIN_LANG_DOMAIN);?></option>
			<option value="center"><?php _e('Center',THEME_ADMIN_LANG_DOMAIN);?></option>
		</select>
		</td>
	</tr>
</table>
<input class="button-primary"  type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)">&nbsp;
<input type="submit"class="button-primary" value="<?php _e('Insert',THEME_ADMIN_LANG_DOMAIN);?>"/>
</form>
	<?php 
	
}
function codeGeneratorHome(){
	?>
	<h2><?php _e('Click on the ShortCode to Create Yours',THEME_ADMIN_LANG_DOMAIN);?></h2>
	<table class="mce-start" width="100%">
		<tr>
			<td><a href="<?php echo curPageURL().'&task=mcols'?>"><img src="images/column-layout.png" /><?php _e('Columns',THEME_ADMIN_LANG_DOMAIN);?></a></td>
			<td><a href="<?php echo curPageURL().'&task=tabsh'?>"><img src="images/toggle.png" /><?php _e('Toggle/Accordion/Tabs',THEME_ADMIN_LANG_DOMAIN);?></a></td>
		</tr>
		<tr>
			<td><a href="<?php echo curPageURL().'&task=typo'?>"><img src="images/typography.png" /><?php _e('Typography',THEME_ADMIN_LANG_DOMAIN);?></a></td>
			<td><?php if(get_theme_option('general','ultimatum_forms')){?><a href="<?php echo curPageURL().'&task=forms'?>"><img src="images/forms.png" /><?php _e('Forms',THEME_ADMIN_LANG_DOMAIN);?></a><?php } ?></td>
		</tr>
		<tr>
			<td><a href="<?php echo curPageURL().'&task=gmap'?>"><img src="images/map.png" /><?php _e('Google Map',THEME_ADMIN_LANG_DOMAIN);?></a></td>
			<td><a href="<?php echo curPageURL().'&task=chart'?>"><img src="images/googlecharts.png" /><?php _e('Google Chart',THEME_ADMIN_LANG_DOMAIN);?></a></td>
		</tr>
		<tr>
			<td><a href="<?php echo curPageURL().'&task=video'?>"><img src="images/video.png" /><?php _e('Videos',THEME_ADMIN_LANG_DOMAIN);?></a></td>
			<td></td>
		</tr>
		
	</table>
<?php
}
function codeGeneratorForm(){
	if($_POST){
		$content= '[form id="'.$_POST[form].'"]';
		?>
		<script>
			var theCode ='<?php echo str_replace("\r\n", "<br />",$content).' ';?>';
			insertUltimateContent(theCode);
		</script>
		<?php 
	}
	global $wpdb;
	$table = $wpdb->prefix.'ultimatum_forms'; 
	$query = "SELECT * FROM $table";
	$result = $wpdb->get_results($query,ARRAY_A);
	?>
	<form method="post" action="">
		<h2>Select a Form</h2><br/><br/>
		<select name="form">
		<?php 
			foreach($result as $fetch){
				echo '<option value="'.$fetch["id"].'">'.$fetch["name"].'</option>';
			}
		?>
		</select>
		<br/><br/><br/>
		<input class="button-primary"  type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)">
		<input class="button-primary" type="submit" value="<?php _e('Insert',THEME_ADMIN_LANG_DOMAIN);?>" />
	</form>
	<?php 

}



function codeGeneratorBoxes($icons){
	global $wpdb;
	$sctable = $wpdb->prefix.'ultimatum_sc';
	switch ($_GET[type]){
			case 'roundbox':
			if($_POST){
				$content.='[roundbox ';
				foreach ($_POST as $key=>$value){
					if($key!='content' && $key!='save_style'){
						$content.=$key.'="'.$value.'" ';
						$property[$key]=$value;
					}
				}
				$content .=']'.($_POST[content]).'[/roundbox]';
				if(strlen($_POST[save_style])>=1){
					$properties = serialize($property);
					$query = "INSERT INTO $sctable (`type`,`name`,`properties`) VALUES ('roundbox','$_POST[save_style]','$properties')";
					$wpdb->query($query);
				}
				?>
				<script>
				var theCode ='<?php echo str_replace("\r\n", "<br />",$content).' ';?>';
				insertUltimateContent(theCode);
				</script>
			<?php 
			}
			if($_GET[id]){
				$query = "SELECT * FROM $sctable WHERE id='".$_GET["id"]."'";
				$fetch = $wpdb->get_row($query,ARRAY_A);
				$properties = unserialize($fetch["properties"]);
			}
			?>
			<form method="post" action="">
			<table width="100%">
				<tr valign="top">
					<td width="50%">
						<h2><?php _e('Box Styling',THEME_ADMIN_LANG_DOMAIN);?></h2>
						<table>
							<tr>
								<td><?php _e('Text Color',THEME_ADMIN_LANG_DOMAIN);?>:</td>
								<td>
									<div id="txtColor" class="cPicker">
										<div class="colorSelector">
											<div style="background-color:<?php if(isset($properties)){ echo '#'.$properties[color]; } else { echo '#000000'; } ?>"></div>
										</div>
										<input name="color" type="text" value="<?php if(isset($properties)){ echo $properties[color]; } else { echo '000000'; } ?>"/>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php _e('Background Color',THEME_ADMIN_LANG_DOMAIN);?>:</td>
								<td>
									<div id="bgColor" class="cPicker">
										<div class="colorSelector">
											<div style="background-color:<?php if(isset($properties)){ echo '#'.$properties[backgroundcolor]; } else { echo '#FFFFFF'; } ?>"></div>
										</div>
										<input  name="backgroundcolor" type="text" value="<?php if(isset($properties)){ echo $properties[backgroundcolor]; } else { echo 'FFFFFF'; } ?>"/>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php _e('Border Color',THEME_ADMIN_LANG_DOMAIN);?>:</td>
								<td>
									<div id="brColor" class="cPicker">
										<div class="colorSelector">
											<div style="background-color:<?php if(isset($properties)){ echo '#'.$properties[bordercolor]; } else { echo '#000000'; } ?>"></div>
										</div>
										<input name="bordercolor" type="text" value="<?php if(isset($properties)){ echo $properties[bordercolor]; } else { echo '000000'; } ?>"/>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php _e('Border Size',THEME_ADMIN_LANG_DOMAIN);?>:</td>
								<td><input type="text" name="borderwidth" value="<?php if(isset($properties)){ echo $properties[borderwidth]; } else { echo '1'; } ?>" />
							</tr>
							<tr>
								<td><?php _e('Border Style',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td>
									<select name="borderstyle">
										<option value="solid" <?php if($properties[borderstyle]=='solid') echo 'selected="selected"';?>>Solid</option>
										<option value="dotted" <?php if($properties[borderstyle]=='dotted') echo 'selected="selected"';?>>Dotted</option>
										<option value="dashed" <?php if($properties[borderstyle]=='dashed') echo 'selected="selected"';?>>Dashed</option>
										<option value="none" <?php if($properties[borderstyle]=='none') echo 'selected="selected"';?>>None</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><?php _e('Icon',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td>
									<select name="icon">
										<option value="">None</option>
										<?php 
										foreach($icons as $icon){
											echo '<option value="'.$icon.'"';
											$key=$icon;
											if($properties[icon]==$key) echo 'selected="selected"';
											echo'>'.$icon.'</option>';
										}
										?>
									</select>
								</td>
							</tr>
							<tr><td><?php _e('Save as favorite',THEME_ADMIN_LANG_DOMAIN);?>:</td><td><input type="text" name="save_style" /></td></tr>
						</table>
					</td>
					<td>
						<h2><?php _e('Box Content',THEME_ADMIN_LANG_DOMAIN);?></h2>
						<textarea rows="10" style="width:100%" name="content"></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:right;">
						<input class="button-primary"  type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)">
						<input class="button-primary" type="submit" value="<?php _e('Insert',THEME_ADMIN_LANG_DOMAIN);?>" />
					</td>
				</tr>
			</table>
			</form>
			<?php  	
			break;
			case 'cornerbox':
						if($_POST){
				$content.='[cornerbox ';
				foreach ($_POST as $key=>$value){
					if($key!='content' && $key!='save_style'){
						$content.=$key.'="'.$value.'" ';
						$property[$key]=$value;
					}
				}
				$content .=']'.($_POST[content]).'[/cornerbox]';
				if(strlen($_POST[save_style])>=1){
					$properties = serialize($property);
					$query = "INSERT INTO $sctable (`type`,`name`,`properties`) VALUES ('cornerbox','$_POST[save_style]','$properties')";
					$wpdb->query($query);
				}
				?>
				<script>
				var theCode ='<?php echo str_replace("\r\n", "<br />",$content).' ';?>';
				insertUltimateContent(theCode);
				</script>
			<?php 
			}
			if($_GET[id]){
				$query = "SELECT * FROM $sctable WHERE id='".$_GET["id"]."'";
				$fetch = $wpdb->get_row($query,ARRAY_A);
				$properties = unserialize($fetch["properties"]);
					}
			?>
			<form method="post" action="">
			<table width="100%">
				<tr valign="top">
					<td width="50%">
						<h2><?php _e('Box Styling',THEME_ADMIN_LANG_DOMAIN);?></h2>
						<table>
							<tr>
								<td><?php _e('Text Color',THEME_ADMIN_LANG_DOMAIN);?>:</td>
								<td>
									<div id="txtColor" class="cPicker">
										<div class="colorSelector">
											<div style="background-color:<?php if(isset($properties)){ echo '#'.$properties[color]; } else { echo '#000000'; } ?>"></div>
										</div>
										<input name="color" type="text" value="<?php if(isset($properties)){ echo $properties[color]; } else { echo '000000'; } ?>"/>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php _e('Background Color',THEME_ADMIN_LANG_DOMAIN);?>:</td>
								<td>
									<div id="bgColor" class="cPicker">
										<div class="colorSelector">
											<div style="background-color:<?php if(isset($properties)){ echo '#'.$properties[backgroundcolor]; } else { echo '#FFFFFF'; } ?>"></div>
										</div>
										<input  name="backgroundcolor" type="text" value="<?php if(isset($properties)){ echo $properties[backgroundcolor]; } else { echo 'FFFFFF'; } ?>"/>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php _e('Border Color',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td>
									<div id="brColor" class="cPicker">
										<div class="colorSelector">
											<div style="background-color:<?php if(isset($properties)){ echo '#'.$properties[bordercolor]; } else { echo '#000000'; } ?>"></div>
										</div>
										<input name="bordercolor" type="text" value="<?php if(isset($properties)){ echo $properties[bordercolor]; } else { echo '000000'; } ?>"/>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php _e('Border Size',THEME_ADMIN_LANG_DOMAIN);?>:</td>
								<td><input type="text" name="borderwidth" value="<?php if(isset($properties)){ echo $properties[borderwidth]; } else { echo '1'; } ?>" />
							</tr>
							<tr>
								<td><?php _e('Border Style',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td>
									<select name="borderstyle">
										<option value="solid" <?php if($properties[borderstyle]=='solid') echo 'selected="selected"';?>>Solid</option>
										<option value="dotted" <?php if($properties[borderstyle]=='dotted') echo 'selected="selected"';?>>Dotted</option>
										<option value="dashed" <?php if($properties[borderstyle]=='dashed') echo 'selected="selected"';?>>Dashed</option>
										<option value="none" <?php if($properties[borderstyle]=='none') echo 'selected="selected"';?>>None</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><?php _e('Icon',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td>
									<select name="icon">
										<option value="">None</option>
										<?php 
										foreach($icons as $icon){
											echo '<option value="'.$icon.'"';
											$key=$icon;
											if($properties[icon]==$key) echo 'selected="selected"';
											echo'>'.$icon.'</option>';
										}
										?>
									</select>
								</td>
							</tr>
							<tr><td><?php _e('Save as favorite',THEME_ADMIN_LANG_DOMAIN);?>:</td><td><input type="text" name="save_style" /></td></tr>
						</table>
					</td>
					<td>
						<h2><?php _e('Box Content',THEME_ADMIN_LANG_DOMAIN);?></h2>
						<textarea rows="10" style="width:100%" name="content"></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:right;">
						<input class="button-primary"  type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)">
						<input class="button-primary" type="submit" value="<?php _e('Insert',THEME_ADMIN_LANG_DOMAIN);?>" />
					</td>
				</tr>
				
			</table>
			</form>
			<?php  	
			break;
			case 'infobox':
			if($_POST){
				$content.='[infobox ';
				foreach ($_POST as $key=>$value){
					if($key!='content' && $key!='save_style'){
						$content.=$key.'="'.$value.'" ';
						$property[$key]=$value;
					}
				}
				$content .=']'.($_POST[content]).'[/infobox]';
				if(strlen($_POST[save_style])>=1){
					$properties = serialize($property);
					$query = "INSERT INTO $sctable (`type`,`name`,`properties`) VALUES ('infobox','$_POST[save_style]','$properties')";
					$wpdb->query($query);
				}
				?>
				<script>
				var theCode ='<?php echo str_replace("\r\n", "<br />",$content).' ';?>';
				insertUltimateContent(theCode);
				</script>
				<?php 
				
			}
			if($_GET[id]){
				$query = "SELECT * FROM $sctable WHERE id='".$_GET["id"]."'";
				$fetch = $wpdb->get_row($query,ARRAY_A);
				$properties = unserialize($fetch["properties"]);
			}
			?>
			<form method="post" action="">
			<table width="100%">
				<tr valign="top">
					<td width="50%">
						<h2><?php _e('Box Styling',THEME_ADMIN_LANG_DOMAIN);?></h2>
						<table>
							<tr>
								<td><?php _e('Text Color',THEME_ADMIN_LANG_DOMAIN);?>:</td>
								<td>
									<div id="txtColor" class="cPicker">
										<div class="colorSelector">
											<div style="background-color:<?php if(isset($properties)){ echo '#'.$properties[color]; } else { echo '#000000'; } ?>"></div>
										</div>
										<input name="color" type="text" value="<?php if(isset($properties)){ echo $properties[color]; } else { echo '000000'; } ?>"/>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php _e('Background Color',THEME_ADMIN_LANG_DOMAIN);?>:</td>
								<td>
									<div id="bgColor" class="cPicker">
										<div class="colorSelector">
											<div style="background-color:<?php if(isset($properties)){ echo '#'.$properties[backgroundcolor]; } else { echo '#FFFFFF'; } ?>"></div>
										</div>
										<input  name="backgroundcolor" type="text" value="<?php if(isset($properties)){ echo $properties[backgroundcolor]; } else { echo 'FFFFFF'; } ?>"/>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php _e('Border Color',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td>
									<div id="brColor" class="cPicker">
										<div class="colorSelector">
											<div style="background-color:<?php if(isset($properties)){ echo '#'.$properties[bordercolor]; } else { echo '#000000'; } ?>"></div>
										</div>
										<input name="bordercolor" type="text" value="<?php if(isset($properties)){ echo $properties[bordercolor]; } else { echo '000000'; } ?>"/>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php _e('Icon',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td>
									<select name="icon">
										<option value="">None</option>
										<?php 
										foreach($icons as $icon){
											echo '<option value="'.$icon.'"';
											$key=$icon;
											if($properties[icon]==$key) echo 'selected="selected"';
											echo'>'.$icon.'</option>';
										}
										?>
									</select>
								</td>
							</tr>
							<tr><td><?php _e('Save as favorite',THEME_ADMIN_LANG_DOMAIN);?>:</td><td><input type="text" name="save_style" /></td></tr>
						</table>
					</td>
					<td>
						<h2><?php _e('Box Content',THEME_ADMIN_LANG_DOMAIN);?></h2>
						<textarea rows="10" style="width:100%" name="content"></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:right;">
						<input class="button-primary"  type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)">
						<input class="button-primary" type="submit" value="<?php _e('Insert',THEME_ADMIN_LANG_DOMAIN);?>" />
					</td>
				</tr>
			</table>
			</form>
			<?php  	
			break;
			default:
			?>
			<table width="100%">
			<tr valign="top">
			<td width="50%">
				<table class="mce-start" width="100%">
				<tr><td style="width:100%"><a href="<?php echo curPageURL().'&amp;type=roundbox'?>"><?php _e('Rounded Corner Box',THEME_ADMIN_LANG_DOMAIN);?></a></td></tr>
				<tr><td><a href="<?php echo curPageURL().'&amp;type=cornerbox'?>"><?php _e('Bordered Box',THEME_ADMIN_LANG_DOMAIN);?></a></td></tr>
				<tr><td><a href="<?php echo curPageURL().'&amp;type=infobox'?>"><?php _e('Info Box',THEME_ADMIN_LANG_DOMAIN);?></a></td></tr>
				</table>
			</td>
			<td>
			<table class="mce-start" width="100%">
				<tr><td style="width:100%" class="savedstyles">
				<h2><?php _e('Saved Box Styles',THEME_ADMIN_LANG_DOMAIN);?></h2>
					<ul>
						<?php 
						$query = "SELECT * FROM $sctable WHERE type='roundbox' OR type='cornerbox' OR type='infobox'";
						$result = $wpdb->get_results($query,ARRAY_A);
						foreach ($result as $fetch){
							echo '<li><a href="'.curPageURL().'&amp;type='.$fetch["type"].'&amp;id='.$fetch["id"].'">'.$fetch["name"].'-'.$fetch["type"].'</a>';
						}
						?>
					</ul>
					</td></tr></table>
			</td>
			</tr>			
			</table>
			
			<input class="button-primary" type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)">
			<?php
			break;
		} 
}

function codeGeneratorCols(){
if($_POST["insert"]){
			
			foreach ($_POST["content"] as $pcontent){
				foreach ($pcontent as $key=>$value){
					$content .= '['.$key.']'.($value).'[/'.$key.']'." ";
				}
			}
			$content = str_replace("\r\n", "<br />",$content);  
			?>
			<script>
			var theCode ="<?php echo $content; ?>";
			insertUltimateContent(theCode);
			</script>
			<?php 
			
		} elseif($_POST["row_style"]){
			?>
			<h2><?php _e('Type in your content in boxes below and click Insert',THEME_ADMIN_LANG_DOMAIN);?></h2>
			<form method="post" action="">
			<?php 
			switch ($_POST["row_style"]){
				case '1':
					echo '<table class="preview" style="width:100%">
							<tr>
								<td width="25%">One Fourth<br/><textarea style="width:100%" rows="10"  name="content[][one_fourth]">Your Content Here</textarea></td>
								<td width="25%">One Fourth<br/><textarea style="width:100%" rows="10"  name="content[][one_fourth]">Your Content Here</textarea></td>
								<td width="25%">One Fourth<br/><textarea style="width:100%" rows="10"  name="content[][one_fourth]">Your Content Here</textarea></td>
								<td width="25%">One Fourth Last<br/><textarea style="width:100%" rows="10"  name="content[][one_fourth_last]">Your Content Here</textarea></td>
							</tr>
						</table>';
				break;
				case '2':
					echo '<table class="preview" style="width:100%">
							<tr>
								<td width="33%">One Third<br/><textarea style="width:100%" rows="10"  name="content[][one_third]">Your Content Here</textarea></td>
								<td width="33%">One Third<br/><textarea style="width:100%" rows="10"  name="content[][one_third]">Your Content Here</textarea></td>
								<td width="33%">One Third Last<br/><textarea style="width:100%" rows="10"  name="content[][one_third_last]">Your Content Here</textarea></td>
							</tr>
						</table>';
				break;
				case '3':
					echo '<table class="preview" style="width:100%">
							<tr>
								<td width="50%">One Half<br/><textarea style="width:100%" rows="10"  name="content[][one_half]">Your Content Here</textarea></td>
								<td width="50%">One Half Last<br/><textarea style="width:100%" rows="10"  name="content[][one_half_last]">Your Content Here</textarea></td>
							</tr>
						</table>';
				break;
				case '4':
					echo '<table class="preview" style="width:100%">
							<tr>
								<td width="25%">One Fourth<br/><textarea style="width:100%" rows="10"  name="content[][one_fourth]">Your Content Here</textarea></td>
								<td width="25%">One Fourth<br/><textarea style="width:100%" rows="10"  name="content[][one_fourth]">Your Content Here</textarea></td>
								<td width="50%">One Half Last<br/><textarea style="width:100%" rows="10"  name="content[][one_half_last]">Your Content Here</textarea></td>
							</tr>
						</table>';
				break;
				case '5':
					echo '<table class="preview" style="width:100%">
							<tr>
								<td width="50%">One Half<br/><textarea style="width:100%" rows="10"  name="content[][one_half]">Your Content Here</textarea></td>
								<td width="25%">One Fourth<br/><textarea style="width:100%" rows="10"  name="content[][one_fourth]">Your Content Here</textarea></td>
								<td width="25%">One Fourth Last<br/><textarea style="width:100%" rows="10"  name="content[][one_fourth_last]">Your Content Here</textarea></td>
							</tr>
						</table>';
				break;
				case '6':
					echo '<table class="preview" style="width:100%">
							<tr>
								<td width="25%">One Fourth<br/><textarea style="width:100%" rows="10"  name="content[][one_fourth]">Your Content Here</textarea></td>
								<td width="50%">One Half<br/><textarea style="width:100%" rows="10"  name="content[][one_half]">Your Content Here</textarea></td>
								<td width="25%">One Fourth Last<br/><textarea style="width:100%" rows="10"  name="content[][one_fourth_last]">Your Content Here</textarea></td>
							</tr>
						</table>';
				break;
				case '7':
					echo '<table class="preview" style="width:100%">
							<tr>
								<td width="25%">One Fourth<br/><textarea style="width:100%" rows="10"  name="content[][one_fourth]">Your Content Here</textarea></td>
								<td width="75%">Three Fourth Last<br/><textarea style="width:100%" rows="10"  name="content[][three_fourth_last]">Your Content Here</textarea></td>
							</tr>
						</table>';
				break;
				case '8':
					echo '<table class="preview" style="width:100%">
							<tr>
								<td width="75%">Three Fourth<br/><textarea style="width:100%" rows="10"  name="content[][three_fourth]">Your Content Here</textarea></td>
								<td width="25%">One Fourth Last<br/><textarea style="width:100%" rows="10"  name="content[][one_fourth_last]">Your Content Here</textarea></td>
							</tr>
						</table>';
				break;
				case '9':
					echo '<table class="preview" style="width:100%">
							<tr>
								<td width="33%">One Third<br/><textarea style="width:100%" rows="10"  name="content[][one_third]">Your Content Here</textarea></td>
								<td width="66%">Two Third Last<br/><textarea style="width:100%" rows="10"  name="content[][two_third_last]">Your Content Here</textarea></td>
							</tr>
						</table>';
				break;
				case '10':
					echo '<table class="preview" style="width:100%">
							<tr>
								<td width="66%">Two Third<br/><textarea style="width:100%" rows="10"  name="content[][two_third]">Your Content Here</textarea></td>
								<td width="33%">One Third Last<br/><textarea style="width:100%" rows="10"  name="content[][one_third_last]">Your Content Here</textarea></td>
							</tr>
						</table>';
				break;
				
			}
			?>
			<input class="button-primary" type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)">
			<input type="hidden" name="insert" value="1" />
			<input class="button-primary" type="submit" value="<?php _e('Insert',THEME_ADMIN_LANG_DOMAIN);?>" />
			</form>
			<?php
		} else {
		?>
		<ol id="selectable">
		<li class="ui-widget-content">
		<table class="preview2">
			<tr>
				<td width="25%">25%</td>
				<td width="25%">25%</td>
				<td width="25%">25%</td>
				<td width="25%">25%</td>
			</tr>
		</table>
		
		</li>
		<li class="ui-widget-content">
		<table class="preview2">
			<tr>
				<td width="33%">33%</td>
				<td width="33%">33%</td>
				<td width="33%">33%</td>
			</tr>
		</table>
		
		</li>
		<li class="ui-widget-content">
		<table class="preview2">
			<tr>
				<td width="50%">50%</td>
				<td width="50%">50%</td>
			</tr>
		</table>
		
		</li>
		<li class="ui-widget-content">
		<table class="preview2">
			<tr>
				<td width="25%">25%</td>
				<td width="25%">25%</td>
				<td width="50%">50%</td>
			</tr>
		</table>
		
		</li>
		<li class="ui-widget-content">
		<table class="preview2">
			<tr>
				<td width="50%">50%</td>
				<td width="25%">25%</td>
				<td width="25%">25%</td>
			</tr>
		</table>
		
		</li>
		<li class="ui-widget-content">
		<table class="preview2">
			<tr>
				<td width="25%">25%</td>
				<td width="50%">50%</td>
				<td width="25%">25%</td>
			</tr>
		</table>
		
		</li>
		<li class="ui-widget-content">
		<table class="preview2">
			<tr>
				<td width="25%">25%</td>
				<td width="75%">75%</td>
			</tr>
		</table>
		
		</li>
		<li class="ui-widget-content">
		<table class="preview2">
			<tr>
				<td width="75%">75%</td>
				<td width="25%">25%</td>
			</tr>
		</table>
		
		</li>
		<li class="ui-widget-content">
		<table class="preview2">
			<tr>
				<td width="33%">33%</td>
				<td width="66%">66%</td>
			</tr>
		</table>
		
		</li>
		<li class="ui-widget-content">
		<table class="preview2">
			<tr>
				<td width="66%">66%</td>
				<td width="33%">33%</td>
			</tr>
		</table>
		</li>
		</ol>
		<h2><?php _e('Select Layout',THEME_ADMIN_LANG_DOMAIN);?></h2>
		<p>
		<?php _e('Click on any layout you want on Left and click Continue Button below.',THEME_ADMIN_LANG_DOMAIN);?>
		</p>
		<form action="" method="post">
			<input id="select-result" name="row_style" type="hidden" />
			<INPUT class="button-primary" type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)">
			<input class="button-primary" type="submit" value="<?php _e('Continue',THEME_ADMIN_LANG_DOMAIN);?>" />
		</form>
		
		
			<script>
				jQuery(function() {
					jQuery( "#selectable" ).selectable({
						stop: function() {
							var result = jQuery( "#select-result" ).empty();
							jQuery( ".ui-selected", this ).each(function() {
								var index = jQuery( "#selectable li" ).index( this );
								result.val(( index + 1 ) );
							});
						}
					});
					jQuery( "#selectable" ).selectable( "option", "filter", 'li' );
				});
				jQuery( "#selectable" ).disableSelection();
				function InsertRowtoLayout(){
					var id= "<?php echo $_GET[layout_id]; ?>";
					var style = jQuery( "#select-result" ).val();
					var win = window.dialogArguments || opener || parent || top;
					win.LayoutGetRow(id,style);
					win.tb_remove();
				}
				</script>
		<?php 
		}
}
function codeGeneratorTabsh($uri){
	?>
	<table class="mce-start" width="100%">
		<tr>
			<td><a href="<?php echo $uri;?>?task=tabs"><?php _e('Tabs',THEME_ADMIN_LANG_DOMAIN);?></a></td>
		</tr>
		<tr>
			<td><a href="<?php echo $uri;?>?task=acc"><?php _e('Accordion',THEME_ADMIN_LANG_DOMAIN);?></a></td>
		</tr>
		<tr>
			<td><a href="<?php echo $uri;?>?task=toggle"><?php _e('Toggle',THEME_ADMIN_LANG_DOMAIN);?></a></td>
		</tr>
	
	</table>
	<input class="button-primary" type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)">
	<?php
}

function codeGeneratorTypo($uri){
	?>
	<h2><?php _e('Click on the ShortCode to Create Yours',THEME_ADMIN_LANG_DOMAIN);?></h2>
	<table class="mce-start" width="100%">
		<tr>
			<td><a href="<?php echo $uri;?>?task=boxes"><?php _e('Boxes',THEME_ADMIN_LANG_DOMAIN);?></a></td>
			<td><a href="<?php echo $uri;?>?task=button"><?php _e('Buttons',THEME_ADMIN_LANG_DOMAIN);?></a></td>
		</tr>
		<tr>
			<td><a href="<?php echo $uri;?>?task=dcap"><?php _e('Dropcap',THEME_ADMIN_LANG_DOMAIN);?></a></td>
			<td><a href="<?php echo $uri;?>?task=list"><?php _e('Lists',THEME_ADMIN_LANG_DOMAIN);?></a></td>
		</tr>
		<tr>
			<td><a href="<?php echo $uri;?>?task=quote"><?php _e('Quotes',THEME_ADMIN_LANG_DOMAIN);?></a></td>
			<td><a href="<?php echo $uri;?>?task=icontext"><?php _e('Icon Text',THEME_ADMIN_LANG_DOMAIN);?></a></td>
		</tr>
	</table>
	<input class="button-primary" type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)">
	<?php
}

function codeGeneratorButton($icons){
	global $wpdb;
	$sctable = $wpdb->prefix.'ultimatum_sc';
				if($_POST){
				$content.='[button ';
				foreach ($_POST as $key=>$value){
					if($key!='buttontext' && $key!='save_style'){
						$cont[]=$key.'="'.$value.'"';
						$property[$key]=$value;
					}
				}
				$content .= implode(' ',$cont);
				$content .=']'.($_POST[buttontext]).'[/button] ';
				if(strlen($_POST[save_style])>=1){
					$properties = serialize($property);
					$query = "INSERT INTO $sctable (`type`,`name`,`properties`) VALUES ('button','$_POST[save_style]','$properties')";
					$wpdb->query($query);
				}
				?>
				<script>
				var theCode ='<?php echo $content;?>';
				insertUltimateContent(theCode);
				</script>
			<?php 
			}
			if($_GET[id]){
				$query = "SELECT * FROM $sctable WHERE id='".$_GET["id"]."'";
				$fetch = $wpdb->get_row($query,ARRAY_A);
				$properties = unserialize($fetch["properties"]);
					}
			?>

			<form method="post" action="">
			<table width="100%">
				<tr valign="top">
					<td width="40%">
					<h2>Saved Button Styles</h2>	
					<ul>
						<?php 
						$query = "SELECT * FROM $sctable WHERE type='button'";
						$result = $wpdb->get_results($query,ARRAY_A);
						if($result){
						foreach ($result as $fetch){
							echo '<li><a href="'.curPageURL().'&amp;type='.$fetch[type].'&amp;id='.$fetch[id].'">'.$fetch[name].'-'.$fetch[type].'</a>';
						}
						}
						?>
					</ul>
					</td>
					<td>
						<h2><?php _e('Button Styling',THEME_ADMIN_LANG_DOMAIN);?></h2>
						<table>
							<tr>
								<td><?php _e('Button Text',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td><input type="text" name="buttontext" value="<?php if(isset($properties)){ echo $properties[buttontext]; } ?>" />
							</tr>
							<tr>
								<td><?php _e('Button Link',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td><input type="text" name="buttonlink" value="<?php if(isset($properties)){ echo $properties[buttonlink]; } ?>" />
							</tr>
							<tr>
								<td><?php _e('Button Size',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td>
									<select name="buttonsize">
										<option value="small" <?php if($properties[buttonsize]=='small') echo 'selected="selected"';?>>small</option>
										<option value="medium" <?php if($properties[buttonsize]=='medium') echo 'selected="selected"';?>>medium</option>
										<option value="large" <?php if($properties[buttonsize]=='large') echo 'selected="selected"';?>>large</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><?php _e('Text Color',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td>
									<div id="txtColor" class="cPicker">
										<div class="colorSelector">
											<div style="background-color:<?php if(isset($properties)){ echo '#'.$properties[color]; } else { echo '#000000'; } ?>"></div>
										</div>
										<input name="color" type="text" value="<?php if(isset($properties)){ echo $properties[color]; } else { echo '000000'; } ?>"/>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php _e('Text Hover Color',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td>
									<div id="txthColor" class="cPicker">
										<div class="colorSelector">
											<div style="background-color:<?php if(isset($properties)){ echo '#'.$properties[hovercolor]; } else { echo '#FFFFFF'; } ?>"></div>
										</div>
										<input name="hovercolor" type="text" value="<?php if(isset($properties)){ echo $properties[hovercolor]; } else { echo 'none'; } ?>"/>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php _e('Background Color',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td>
									<div id="bgColor" class="cPicker">
										<div class="colorSelector">
											<div style="background-color:<?php if(isset($properties)){ echo '#'.$properties[backgroundcolor]; } else { echo '#FFFFFF'; } ?>"></div>
										</div>
										<input  name="backgroundcolor" type="text" value="<?php if(isset($properties)){ echo $properties[backgroundcolor]; } else { echo 'FFFFFF'; } ?>"/>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php _e('Background Hover Color',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td>
									<div id="brColor" class="cPicker">
										<div class="colorSelector">
											<div style="background-color:<?php if(isset($properties)){ echo '#'.$properties[hoverbgcolor]; } else { echo '#FFFFFF'; } ?>"></div>
										</div>
										<input name="hoverbgcolor" type="text" value="<?php if(isset($properties)){ echo $properties[hoverbgcolor]; } else { echo 'none'; } ?>"/>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php _e('Icon',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td>
									<select name="icon">
										<option value="">None</option>
										<?php 
										foreach($icons as $icon){
											echo '<option value="'.$icon.'"';
											$key=$icon;
											if($properties[icon]==$key) echo 'selected="selected"';
											echo'>'.$icon.'</option>';
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td><?php _e('Open in Light box?',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td>
									<select name="rel">
										<option value="" <?php if($properties[rel]=='') echo 'selected="selected"';?>>No</option>
										<option value="prettyPhoto" <?php if($properties[rel]=='prettyPhoto') echo 'selected="selected"';?>>Yes</option>
									</select>
								</td>
							</tr>
							<tr><td><?php _e('Save as favorite',THEME_ADMIN_LANG_DOMAIN);?>:</td><td><input type="text" name="save_style" /></td></tr>
						</table>
						
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:right;">
						<input class="button-primary"  type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)">
						<input class="button-primary" type="submit" value="<?php _e('Insert',THEME_ADMIN_LANG_DOMAIN);?>" />
					</td>
				</tr>
			</table>
			</form>
	<?php 
}
function codeGeneratorIcontext($icons){
			if($_POST){
				$content.='[icontext ';
				foreach ($_POST as $key=>$value){
					if($key!='content' && $key!='save_style'){
						$content.=$key.'="'.$value.'" ';
						$property[$key]=$value;
					}
				}
				$content .=']'.($_POST[content]).'[/icontext]';
				
				?>
				<script>
				var theCode ='<?php echo str_replace("\r\n", "<br />",$content).' ';?>';
				insertUltimateContent(theCode);
				</script>
			<?php 
			}
			?>

			<form method="post" action="">
			<table width="100%">
				<tr valign="top">
					<td>
						<h2><?php _e('Icon Text',THEME_ADMIN_LANG_DOMAIN);?></h2>
						<table>
							<tr>
								<td><?php _e('Text',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td><input type="text" name="content" value="<?php if(isset($properties)){ echo $properties[buttontext]; } ?>" />
							</tr>
							<tr>
								<td><?php _e('Link',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td><input type="text" name="link" value="<?php if(isset($properties)){ echo $properties[buttonlink]; } ?>" />
							</tr>
							<tr>
								<td><?php _e('Size',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td>
									<select name="size">
										<option value="small" <?php if($properties[buttonsize]=='small') echo 'selected="selected"';?>>small</option>
										<option value="medium" <?php if($properties[buttonsize]=='medium') echo 'selected="selected"';?>>medium</option>
										<option value="large" <?php if($properties[buttonsize]=='large') echo 'selected="selected"';?>>large</option>
										<option value="huge" <?php if($properties[buttonsize]=='large') echo 'selected="selected"';?>>huge</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><?php _e('HTML Tag',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td>
									<select name="tag">
										<option value="h1">H1</option>
										<option value="h2">H2</option>
										<option value="h3">H3</option>
										<option value="h4">H4</option>
										<option value="h5">H5</option>
										<option value="h6">H6</option>
										<option value="p">p</option>
										<option value="span">span</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><?php _e('Icon',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td>
									<select name="icon">
										<option value="">None</option>
										<?php 
										foreach($icons as $icon){
											echo '<option value="'.$icon.'"';
											$key=$icon;
											if($properties["icon"]==$key) echo 'selected="selected"';
											echo'>'.$icon.'</option>';
										}
										?>
									</select>
								</td>
							</tr>
								<tr>
								<td><?php _e('Open in Light box?',THEME_ADMIN_LANG_DOMAIN);?> :</td>
								<td>
									<select name="rel">
										<option value="" <?php if($properties["rel"]=='') echo 'selected="selected"';?>>No</option>
										<option value="prettyPhoto" <?php if($properties[rel]=='prettyPhoto') echo 'selected="selected"';?>>Yes</option>
									</select>
								</td>
							</tr>
						</table>
						
					</td>
				</tr>
				<tr>
					<td style="text-align:right;">
						<input class="button-primary"  type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)">
						<input class="button-primary" type="submit" value="<?php _e('Insert',THEME_ADMIN_LANG_DOMAIN);?>" />
					</td>
				</tr>
			</table>
			</form>
	<?php 
}

function codeGeneratorList($icons){
	if($_POST){
		$content ='';
		$content.='[list] ';
		foreach($_POST[icon] as $key=>$value){
			$content.= '[listitem icon="'.$_POST[icon][$key].'"]'.$_POST[content][$key].'[/listitem] ';
		}
		$content.= '[/list] ';
		?>
		<script>
			var theCode ='<?php echo str_replace("\r\n", "<br />",$content).' ';?>';
			insertUltimateContent(theCode);
		</script>
		<?php 
		
	}
	?>
	<h2><?php _e('Insert a Styled List',THEME_ADMIN_LANG_DOMAIN);?></h2>
	<form method="post" action="">
	<table>
		<tr><td colspan="3"><input type="button" class="addRow button-primary" value="Add Row"/></td></tr>
		<tr valign="top"><td><?php _e('Icon',THEME_ADMIN_LANG_DOMAIN);?> :</td>
									<td>
										<select name="icon[]">
											<?php 
											foreach($icons as $icon){
												echo '<option value="'.$icon.'"';
												echo'>'.$icon.'</option>';
											}
											?>
										</select>
									</td><td><?php _e('Text',THEME_ADMIN_LANG_DOMAIN);?></td><td><input type="text" name="content[]" size="24"/></td><td><input type="button" class="delRow button-primary" value="Delete Row"/></td></tr>
	</table>
	<input class="button-primary"  type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)"><input type="submit"class="button-primary" value="<?php _e('Insert',THEME_ADMIN_LANG_DOMAIN);?>"/>
	</form>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery(".addRow").btnAddRow();
			jQuery(".delRow").btnDelRow();
		});
	</script>
	<?php 
}

function codeGeneratorDropCap(){
	if($_POST){
		$content.='[dropcap ';
		foreach ($_POST as $key=>$value){
			if($key!='content' && $key!='save_style'){
				$content.=$key.'="'.$value.'" ';
			}
		}
		$content .=']'.($_POST[content]).'[/dropcap]';
		?>
		<script>
			var theCode ='<?php echo str_replace("\r\n", "<br />",$content).' ';?>';
			insertUltimateContent(theCode);
		</script>
	<?php
	}
	?>
	<h2><?php _e('Insert a DropCap',THEME_ADMIN_LANG_DOMAIN);?></h2>
	<form method="post" action="">
	<table>
	<tr><td><?php _e('Letter',THEME_ADMIN_LANG_DOMAIN);?> :</td><td><input type="text" name="content" /></td></tr>
	<tr>
		<td><?php _e('Style',THEME_ADMIN_LANG_DOMAIN);?> :</td>
		<td>
			<select name="type">
			<option value="normal">Normal</option>
			<option value="round">Round</option>
			</select>
		</td>
	</tr>
	<tr>
		<td><?php _e('Text Color',THEME_ADMIN_LANG_DOMAIN);?> :</td>
		<td>
			<div id="txtColor" class="cPicker">
				<div class="colorSelector">
					<div style="background-color:<?php if(isset($properties)){ echo '#'.$properties[color]; } else { echo '#000000'; } ?>"></div>
				</div>
				<input name="color" type="text" value="<?php if(isset($properties)){ echo $properties[color]; } else { echo ''; } ?>"/>
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e('Background Color',THEME_ADMIN_LANG_DOMAIN);?> :</td>
		<td>
			<div id="bgColor" class="cPicker">
				<div class="colorSelector">
					<div style="background-color:<?php if(isset($properties)){ echo '#'.$properties[backgroundcolor]; } else { echo '#FFFFFF'; } ?>"></div>
				</div>
				<input  name="bcolor" type="text" value="<?php if(isset($properties)){ echo $properties[backgroundcolor]; } else { echo ''; } ?>"/>
			</div>
		</td>
	</tr>
	</table>
	<input class="button-primary"  type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)"><input type="submit"class="button-primary" value="<?php _e('Insert',THEME_ADMIN_LANG_DOMAIN);?>"/>
	</form>
	<?php 
}


function codeGeneratorQuote(){
	if($_POST){
		$content.='[blockquote ';
		foreach ($_POST as $key=>$value){
			if($key!='content' && $key!='save_style'){
				$content.=$key.'="'.$value.'" ';
			}
		}
		$content .=']'.($_POST[content]).'[/blockquote]';
		?>
		<script>
			var theCode ='<?php echo str_replace("\r\n", "<br />",$content).' ';?>';
			insertUltimateContent(theCode);
		</script>
	<?php
	}
	?>
	<h2><?php _e('Insert a Quote',THEME_ADMIN_LANG_DOMAIN);?></h2>
	<form method="post" action="">
	<table>
	<tr><td><?php _e('Text',THEME_ADMIN_LANG_DOMAIN);?> :</td><td><textarea name="content" rows="5" cols="50">Your Content Here</textarea></td></tr>
	<tr><td><?php _e('Align',THEME_ADMIN_LANG_DOMAIN);?> :</td><td><select name="align"><option value="">none</option><option value="left">Left</option><option value="right">Right</option></select>
	<tr><td><?php _e('Cite',THEME_ADMIN_LANG_DOMAIN);?> :</td><td><input type="text" name="cite" /></td></tr>
	<tr>
		<td><?php _e('Text Color',THEME_ADMIN_LANG_DOMAIN);?> :</td>
		<td>
			<div id="txtColor" class="cPicker">
				<div class="colorSelector">
					<div style="background-color:<?php if(isset($properties)){ echo '#'.$properties[color]; } else { echo '#000000'; } ?>"></div>
				</div>
				<input name="color" type="text" value="<?php if(isset($properties)){ echo $properties[color]; } else { echo ''; } ?>"/>
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e('Background Color',THEME_ADMIN_LANG_DOMAIN);?> :</td>
		<td>
			<div id="bgColor" class="cPicker">
				<div class="colorSelector">
					<div style="background-color:<?php if(isset($properties)){ echo '#'.$properties[backgroundcolor]; } else { echo '#FFFFFF'; } ?>"></div>
				</div>
				<input  name="bcolor" type="text" value="<?php if(isset($properties)){ echo $properties[backgroundcolor]; } else { echo ''; } ?>"/>
			</div>
		</td>
	</tr>
	</table>
	<input class="button-primary"  type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)"><input type="submit"class="button-primary" value="<?php _e('Insert',THEME_ADMIN_LANG_DOMAIN);?>"/>
	</form>
	<?php 
}

function codeGeneratorAccord(){
	if($_POST){
		$content.='[accordion] ';
		foreach ($_POST[title] as $key=>$value){
			$content .= '[accrow title="'.$_POST[title][$key].'"]'.$_POST[content][$key].'[/accrow] ';
		}
		$content .='[/accordion]';
		?>
		<script>
			var theCode ='<?php echo str_replace("\r\n", "<br />",$content).' ';?>';
			insertUltimateContent(theCode);
		</script>
	<?php
	}
	?>
	<h2><?php _e('Insert Accordion Content',THEME_ADMIN_LANG_DOMAIN);?></h2>
<form method="post" action="">
	<table>
		<tr><td colspan="3"><input type="button" class="addRow button-primary" value="Add Row"/></td></tr>
		<tr valign="top">
			<td><?php _e('Title',THEME_ADMIN_LANG_DOMAIN);?>:</td>
			<td><input type="text" name="title[]" value="Accordion Title" /></td>
			<td><?php _e('Content',THEME_ADMIN_LANG_DOMAIN);?></td>
			<td><textarea name="content[]" rows="3" cols="50"><?php _e('Your Content Here',THEME_ADMIN_LANG_DOMAIN);?>...</textarea></td>
			<td><input type="button" class="delRow button-primary" value="Delete Row"/></td>
		</tr>
	</table>
	<input class="button-primary"  type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)"><input type="submit"class="button-primary" value="<?php _e('Insert',THEME_ADMIN_LANG_DOMAIN);?>"/>
	</form>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery(".addRow").btnAddRow();
			jQuery(".delRow").btnDelRow();
		});
	</script>
	<?php 
}

function codeGeneratorTabs(){
	if($_POST){
		$content.='[tabs] ';
		foreach ($_POST[title] as $key=>$value){
			$content .= '[tab title="'.$_POST[title][$key].'"]'.$_POST[content][$key].'[/tab] ';
		}
		$content .='[/tabs]';
		?>
		<script>
			var theCode ='<?php echo str_replace("\r\n", "<br />",$content).' ';?>';
			insertUltimateContent(theCode);
		</script>
	<?php
	}
	?>
	<h2><?php _e('Insert Tabbed Content',THEME_ADMIN_LANG_DOMAIN);?></h2>
<form method="post" action="">
	<table>
		<tr><td colspan="3"><input type="button" class="addRow button-primary" value="Add Tab"/></td></tr>
		<tr valign="top">
			<td><?php _e('Title',THEME_ADMIN_LANG_DOMAIN);?>:</td>
			<td><input type="text" name="title[]" value="Tab Title" /></td>
			<td><?php _e('Content',THEME_ADMIN_LANG_DOMAIN);?></td>
			<td><textarea name="content[]" rows="3" cols="50"><?php _e('Your Content Here',THEME_ADMIN_LANG_DOMAIN);?>...</textarea></td>
			<td><input type="button" class="delRow button-primary" value="Delete Tab"/></td>
		</tr>
	</table>
	<input class="button-primary"  type="button" value="<?php _e('Back',THEME_ADMIN_LANG_DOMAIN);?>" onclick="history.go(-1)"><input type="submit"class="button-primary" value="<?php _e('Insert',THEME_ADMIN_LANG_DOMAIN);?>"/>
	</form>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery(".addRow").btnAddRow();
			jQuery(".delRow").btnDelRow();
		});
	</script>
	<?php 
}

function curPageURL() {
	return $_SERVER['REQUEST_URI'];
}
?>