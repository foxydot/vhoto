<?php
add_action('init','udefaultscreen_scripts');
add_action('init','udefaultscreen_styles');
function udefaultscreen_styles(){
	wp_enqueue_style('form-builder',THEME_ADMIN_URI.'/css/site.forms.css');
}
function udefaultscreen_scripts(){
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-dialog'); 
	wp_enqueue_script( 'jquery-meta',THEME_ADMIN_JS_URI.'/jquery.metadata.js' );
	wp_enqueue_script( 'jquery-forms',THEME_ADMIN_JS_URI.'/jqueryforms.js' );
	wp_enqueue_script( 'form-builder',THEME_ADMIN_JS_URI.'/formbuilder.php' );
}



function forms(){
	if(isset($_REQUEST['task'])){
		$task=$_REQUEST['task'];
	} else {
		$task=false;
	}	
	switch ($task){
		case 'edit':
			formBuilder();
		break;
		case 'bind':
			bindForm2Post();
		break;
		default:
	screen_icon(); 
	echo '<div class="wrap">';?>
	<h2>Forms</h2>
	<?php
		global $wpdb;
		$table = $wpdb->prefix.'ultimatum_forms'; 
		if($_POST){
			if($_POST[action]=='delete'){
				$delete = "DELETE  FROM $table WHERE `id`='$_POST[delid]'";
				$r = $wpdb->query($delete);
				$url = curPageURL();
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
			<tr><th><?php _e('Forms Stored in System',THEME_ADMIN_LANG_DOMAIN);?></th><th style="text-align:right" width="200"><a href="admin.php?page=wonder-forms&task=edit" class="button-primary"><?php _e('Add Form',THEME_ADMIN_LANG_DOMAIN);?></a></th></tr>
			</thead>
			<tbody>
				<?php 
					foreach($result as $fetch){
						echo '<tr>
								<td>'.$fetch["name"].'</td>
								<td align="right">
								
									<p>
										<a href="admin.php?page=wonder-forms&task=edit&id='.$fetch["id"].'" class="button-primary">'
										.__('Edit Form',THEME_ADMIN_LANG_DOMAIN).'</a></p>
										<form method="post" action=""><input type="hidden" name="action" value="delete" /><input type="hidden" name="delid" value="'.$fetch["id"].'" /><input type="submit" value="'.__('Delete',THEME_ADMIN_LANG_DOMAIN).'" class="button-secondary" onClick="return confirmSubmit()" /></form>
										</td></tr>';
					}
				?>	
			</tbody>
		</table>
		<?php
		break; 
	}
}

function curPageURL() {
 $pageURL = $_SERVER["REQUEST_URI"];
  return $pageURL;
}

function formBuilder(){
	
	screen_icon(); 
	echo '<div class="wrap">';?>
	<h2>Forms</h2>
	<p><?php 
		echo '<a href="admin.php?page=wonder-forms" class="button-primary">'
										.__('Back to Forms Panel',THEME_ADMIN_LANG_DOMAIN).'</a>'
	?></p>
	<?php
		global $wpdb;
		$table = $wpdb->prefix.'ultimatum_forms'; 
		if($_POST){
			foreach ($_POST as $key=>$value){
				if($key!=='name' && $key!=='notify' && $key!=='thank' && $key!=='button'){
					$field[$key]=$value;
					
				} 
			if($key=='button'){
					wpml_register_string('Ultimatum Forms', 'Form-'.$_POST["name"].'- Button ('.$value.')', $value);
				}
			if($key=='button'){
					wpml_register_string('Ultimatum Forms', 'Form-'.$_POST["name"].'- ThankYou ('.$value.')', $value);
				}
			}
			// WMPL
			foreach($field['properties'] as $keey=>$element){
				foreach($element as $key=>$value){
					if($key =='label'){
						wpml_register_string('Ultimatum Forms', 'Form-'.$_POST['name'].'- Label ('.$value.')', $value);
					}
					if($key =='values'){
						wpml_register_string('Ultimatum Forms', 'Form-'.$_POST['name'].'- Values ('.$element['label'].')', $value);
					}
				}
				
			}
			// WPML
			
			$fields = (serialize($field));
			if(!isset($_GET["id"])){
				$insert = "INSERT INTO $table (`name`,`notify`,`thank`,`fields`,`button`) VALUES ('$_POST[name]','$_POST[notify]','$_POST[thank]','$fields','$_POST[button]')";
			} else {
				$insert = "REPLACE INTO $table (`id`,`name`,`notify`,`thank`,`fields`,`button`) VALUES ('$_POST[id]','$_POST[name]','$_POST[notify]','$_POST[thank]','$fields','$_POST[button]')";
			}
			$res = $wpdb->query($insert);
			$id = $wpdb->insert_id;
			if(!isset($_GET["id"])){
			$url = curPageURL().'&id='.$id;
			?>
			<script language="JavaScript">
				parent.location.href='<?php echo $url; ?>';
			</script>
			<?php 
			}
		}
		$fields=false;
		$fetch=false;
		if(isset($_GET["id"])){
			$query = "SELECT * FROM $table WHERE `id`='$_GET[id]'";
			$fetch = $wpdb->get_row($query,ARRAY_A);
			$fields = unserialize($fetch["fields"]);
		}
	?>
	<table class="widefat">
	<thead>
		<tr><th><?php _e('Form Properties',THEME_ADMIN_LANG_DOMAIN);?></th><th style="text-align:right"></th></tr>
	</thead>
	<tbody>
		<tr valign="top">
		<td>
		<div id="form_builder_panel">
			<form method="post" action="" class="fancy">
				<table class="form_options">
					<tr>
						<td style="border:none">
		        		  <strong><?php _e('Form Name',THEME_ADMIN_LANG_DOMAIN);?>: </strong>
		        		 </td>
		        		 <td style="border:none">
		        		  <input type="text" name="name" value="<?php echo ($fetch["name"]);?>" />
		        		 </td>
					</tr>
					<tr>
						<td style="border:none"><strong><?php _e('Notify Email',THEME_ADMIN_LANG_DOMAIN);?>:</strong></td>
						<td style="border:none"><input type="text" name="notify" value="<?php echo ($fetch["notify"]);?>" /></td>
						
					</tr>
					<tr>
						<td style="border:none"><strong><?php _e('Button Text',THEME_ADMIN_LANG_DOMAIN);?>:</strong></td>
						<td style="border:none"><input type="text" name="button" value="<?php echo ($fetch["button"]);?>" /></td>
					</tr>
					<tr>
						<td style="border:none"><strong><?php _e('Thank You Page or Message',THEME_ADMIN_LANG_DOMAIN);?>:</strong>
						<br /><small><?php _e('if message contains http it will try redirect and if not it will show an ajax response in forms place.',THEME_ADMIN_LANG_DOMAIN);?></small></td>
						<td style="border:none"><textarea name="thank"><?php echo ($fetch["thank"]);?></textarea></td>
						
					</tr>
					
				</table>
				<fieldset class='sml'>
					<legend><?php _e('Form Fields',THEME_ADMIN_LANG_DOMAIN);?></legend>
						<ol>
						<?php if($fields){
							include('formbuilder.php');
							$items = $fb->build($fields);
							if (!empty($items)) {
								foreach($items as $key=>$value){
									$fb->elements($items[$key],$key);
								}
							}
						}?>
						</ol>
				</fieldset>
				
				<input type="hidden" name="id" value="<?php echo $fetch['id'];?>" />
		      	<input type="submit" class="button-primary" value="<?php _e('Save Form',THEME_ADMIN_LANG_DOMAIN);?>" />
		     </form>
     	</div>
		</td>
		<td width="252">
		<div id="form_builder_nav">
			<ul id="form_builder_toolbox">
				<li id='textarea' class='toolbox'><?php _e('Text Area',THEME_ADMIN_LANG_DOMAIN);?></li>
				<li id='textbox' class='toolbox'><?php _e('Text Box',THEME_ADMIN_LANG_DOMAIN);?></li>
				<li id='dropdown' class='toolbox'><?php _e('Drop Down',THEME_ADMIN_LANG_DOMAIN);?></li>
				<li id='checkbox' class='toolbox'><?php _e('Check Box',THEME_ADMIN_LANG_DOMAIN);?></li>
				<li id='radio' class='toolbox'><?php _e('Radio Button',THEME_ADMIN_LANG_DOMAIN);?></li>
			</ul>
			<ul id="form_builder_properties">
				<li><?php _e('Select an element to display its options',THEME_ADMIN_LANG_DOMAIN);?></li>
			</ul>
			
		</div>
		</td>
		</tr>
		</tbody>
		</table>
      <?php 
	echo '</div>'; 
}