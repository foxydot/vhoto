<?php
function recurse_copy($src,$dst) {
	$dir = opendir($src);
	@mkdir($dst);
	while(false !== ( $file = readdir($dir)) ) {
		if (( $file != '.' ) && ( $file != '..' )) {
			if ( is_dir($src . '/' . $file) ) {
				recurse_copy($src . '/' . $file,$dst . '/' . $file);
			}
			else {
				copy($src . '/' . $file,$dst . '/' . $file);
			}
		}
	}
	closedir($dir);
}
function updateUltimatumDirs(){
	// Create Directory
	$upgradefail = true;
	$dir = WP_PLUGIN_DIR.'/ultimatum-library';
	if(mkdir($dir)){
	// Move Fonts Directory
		$src = THEME_DIR.'/fonts';
		$dst = $dir.'/fonts';
		recurse_copy($src, $dst);
	// Move Icons Directory
		mkdir($dir.'/images');
		$src = THEME_DIR.'/images/icons';
		$dst = $dir.'/images/icons';
		recurse_copy($src, $dst);
	//create the php file
$content = <<<PHP
<?php
/*
Plugin Name: Ultimatum library
Plugin URI: http://ultimatumtheme.com
Description: This plugin does nothing at the moment but serves images and fonts to Ultimatum.
Version: 1.0
Author: Wonder Foundry
Author URI: http://ultimatumtheme.com
License: A "Slug" license name e.g. GPL2
*/
?>
PHP;
$file = $dir.'/ultimatum-library.php';
$fhandler = @fopen($file, 'w+');
if ($fhandler) fwrite($fhandler, $content, strlen($content));
	$upgradefail = false;
	}
	$upgradefail = true;
	// Move cache folders
	$cachesource = THEME_CACHE_DIR;
	if(is_multisite()){
		// multisites cache move
		global $wpdb;
		$blogs = $wpdb->get_results( $wpdb->prepare("SELECT blog_id, domain, path FROM $wpdb->blogs WHERE site_id = %d AND public = '1' AND archived = '0' AND mature = '0' AND spam = '0' AND deleted = '0' ORDER BY registered DESC", $wpdb->siteid), ARRAY_A );
		foreach ($blogs as $blog){
			global $switched;
			switch_to_blog($blog["blog_id"]);
			$upload_dir = wp_upload_dir();
			$uploaddir = $upload_dir["basedir"];
			$cachedir = $uploaddir.'/'.THEME_CODE;
			recurse_copy(THEME_CACHE_DIR, $cachedir);
			restore_current_blog();
		}
		$upgradefail = false;
	} else {
		$upload_dir = wp_upload_dir();
		$uploaddir = $upload_dir["basedir"];
		$cachedir = $uploaddir.'/'.THEME_CODE;
		recurse_copy(THEME_CACHE_DIR, $cachedir);
		$upgradefail = false;
	}
	if($upgradefail != true){
		update_option('ultimatum_version', 2.37038);
		?>
		<script language="JavaScript">
		parent.location.href='./admin.php?page=wonder-update';
		</script>
		<?php 
	} else {
		echo 'Something is wrong files cannot be moved please see forums';
	}
}
function wonder_update(){
screen_icon(); 
WP_Filesystem();
echo '<div class="wrap">';
?>
<h2><?php _e('Ultimatum Updates',THEME_ADMIN_LANG_DOMAIN);?></h2>
<?php
if(isset($_REQUEST['task'])){
	$task=$_REQUEST['task'];
} else {
	$task=false;
}
switch ($task){
	default:
	$api_message = false;
	// Check current version
	$ultimatumversion = get_option('ultimatum_version');
	global $wp_version;
	$url = 'http://api.ultimatumtheme.com/';
	if($_POST['api_key']){
		$options = array(
		'body' => array(
				'task'=>'api_check',
				'ultimatum_version' => $ultimatumversion,
				'wp_version' => $wp_version,
				'php_version' => phpversion(),
				'uri' => home_url(),
				'api_key' => $_POST['api_key'],
				'user-agent' => "WordPress/$wp_version;"
		)
		);
		$response = wp_remote_post($url, $options);
		$api_response = unserialize(wp_remote_retrieve_body($response));
		if($api_response['result']=="TRUE"){
			update_option('ultimatum_api', $_POST['api_key']);
			$api_message = "THANK YOU FOR REGISTERING ULTIMATUM";
		} else {
			$api_message = "WRONG API KEY PLEASE INSERT A CORRECT KEY";
		}
		
	}
	$options = array(
					'body' => array(
							'task'=>'update_check',
							'ultimatum_version' => $ultimatumversion,
							'wp_version' => $wp_version,
							'php_version' => phpversion(),
							'uri' => home_url(),
							'user-agent' => "WordPress/$wp_version;"
					)
			);
			if(function_exists(ultdupdater)){
				$options = ultdupdater();
			}
		$response = wp_remote_post($url, $options);
		$ultimatum_update = unserialize(wp_remote_retrieve_body($response));
		// Check Google Fonts Count
		$fonts = get_theme_option('googlefonts', 'fonts');
		$fontcount = count($fonts);
		$url = 'http://api.ultimatumtheme.com/';
		$options = array(
				'body' => array(
						'task'=>'googlecount',
						'user-agent' => "WordPress/$wp_version;"
				)
		);
		$response = wp_remote_post($url, $options);
		$newcount = wp_remote_retrieve_body($response);
	?>
	<?php 
	if($ultimatumversion>=2.37038) { 
	if($api_message){
		echo "<h3>".$api_message."</h3>";
	}
	if(!get_option('ultimatum_api')){
	?>
	<form method="post" action="">
	<table class="widefat">
	<thead>
	<tr><th colspan="2">Ultimatum API KEY</th></tr>
	</thead>
	<tbody>
	<tr><td colspan="2"><input type="text" size ="50" name="api_key" /></td></tr>
	<tr><td colspan="2"><input class="button-primary autowidth" type="submit" value="Save" /></td></tr>
	</tbody>
	
	</table>
	
	</form>
	<?php }?>
	<?php } else {?>
	<table class="widefat">
	<thead>
	<tr><th colspan="2">Ultimatum 2.37038 Check</th></tr>
	</thead>
	<tbody>
	<tr><td colspan="2">If the below are not YES both you may live issues while upgrading to next version 2.37038</td></tr>
	<tr><th width="200">Plugins Directory Writable :</th><td><?php if(is_writable(WP_PLUGIN_DIR)){ echo 'YES'; } else { echo 'NO'; } ?></td></tr>
	<tr><th width="200">Uploads Directory Writable :</th><td><?php if(is_writable(WP_CONTENT_DIR.'/uploads')){ echo 'YES'; } else { echo 'NO'; } ?></td></tr>
	</tbody></table><p></p>
	<table class="widefat">
	<thead>
	<tr><th colspan="2">Ultimatum Core</th></tr>
	</thead>
	<?php if($ultimatum_update['version']>$ultimatumversion){?>
	<?php if($ultimatum_update['version']=='2.37038'){ ?>
	<?php 
	if(is_writable(WP_PLUGIN_DIR)&&is_writable(WP_CONTENT_DIR.'/uploads')){
	?>
	<tfoot>
	<tr><td style="text-align:right" colspan="2">
	<p><a class="button-primary autowidth" href="admin.php?page=wonder-update&task=upgrade2">Update Now</a></p>
	</td></tr>
	</tfoot>
	<?php 	
	}
	?>
	<?php } else { ?>
	<tfoot>
	<tr><td style="text-align:right" colspan="2">
	<p><a class="button-primary autowidth" href="admin.php?page=wonder-update&task=upgrade">Update Now</a></p>
	</td></tr>
	</tfoot>
	<?php } ?>
	<?php } ?>
	<tbody>
	<tr><th width="150">Current Version</th><td><?php echo $ultimatumversion; ?></td></tr>
	<?php if($ultimatum_update['version']>$ultimatumversion){?>
	<tr><th><?php _e('Up to Date Version',THEME_ADMIN_LANG_DOMAIN)?></th><td><?php echo $ultimatum_update['version']; ?></td></tr>
	<?php } else { ?>
	<tr><td colspan="2"><?php _e('You are using the latest version of Ultimatum Core',THEME_ADMIN_LANG_DOMAIN); ?></td></tr>
	<?php } ?>
	</tbody>
	</table>
	<?php } ?>
	<p>
	</p>
	<table class="widefat">
	<thead>
	<tr><th colspan="2"><?php _e('Google Fonts',THEME_ADMIN_LANG_DOMAIN)?></th></tr>
	</thead>
	<?php if($fontcount!=$newcount){?>
	<tfoot>
	<tr><td style="text-align:right" colspan="2">
	<p><a class="button-primary autowidth" href="admin.php?page=wonder-update&task=google">Update Now</a></p>
	</td></tr>
	</tfoot>
	<?php } ?>
	<tbody>
	<tr><th><?php _e('Current Font Count',THEME_ADMIN_LANG_DOMAIN); ?></th><td><?php echo $fontcount; ?></td></tr>
	<?php if($fontcount!=$newcount){?>
	<tr><th><?php _e('Up to Date Count',THEME_ADMIN_LANG_DOMAIN)?></th><td><?php echo $newcount; ?></td></tr>
	<?php } else { ?>
	<tr><td colspan="2"><?php _e('Your Google Font Library is up to date',THEME_ADMIN_LANG_DOMAIN); ?></td></tr>
	<?php } ?>
	</tbody>
	</table>
	<?php 
	break;
	case 'google':
		$url = 'http://api.ultimatumtheme.com/';
		$options = array(
				'body' => array(
						'task'=>'gdnload',
						'user-agent' => "WordPress/$wp_version;"
				)
		);
		$response = wp_remote_post($url, $options);
		$newcount = wp_remote_retrieve_body($response);
		$newfonts['fonts']=unserialize($newcount);
		update_option('ultimatum_googlefonts', $newfonts);
		_e('Good News! You have much more Fonts now :) ',THEME_ADMIN_LANG_DOMAIN);
	break;
	case 'upgrade2':
		updateUltimatumDirs();
	break;
	case 'upgrade':
		WP_Filesystem();
		$url = 'http://api.ultimatumtheme.com/';
		$options = array(
				'body' => array(
						'task'=>'update_check',
						'ultimatum_version' => $ultimatumversion,
						'wp_version' => $wp_version,
						'php_version' => phpversion(),
						'uri' => home_url(),
						'user-agent' => "WordPress/$wp_version;"
				)
		);
		if(function_exists(ultdupdater)){
			$options = ultdupdater();
		}
	$response = wp_remote_post($url, $options);
	//print_r($response);
	$ultimatum_update = unserialize(wp_remote_retrieve_body($response));
	$temfile = download_url('http://api.ultimatumtheme.com/index.php?task=dnload&id='.$ultimatum_update['id']);
	if(file_exists($temfile)):
	$unzipit = unzip_file($temfile, THEME_DIR);
	unlink($temfile);
	_e('Good News! Your Ultimatum Core is now the latest version :) ',THEME_ADMIN_LANG_DOMAIN);
	else:
	_e('It seems your access rights does not allow this option please use FTP upload method.',THEME_ADMIN_LANG_DOMAIN);
	endif;
	break;
}
	
echo '</div>';

}
