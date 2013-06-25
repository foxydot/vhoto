<?php

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
// Check current version
$ultimatumversion = get_option('ultimatum_version');
global $wp_version;
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
	<table class="widefat">
	<thead>
	<tr><th colspan="2">Ultimatum 2.38 Check</th></tr>
	</thead>
	<tbody>
	<tr><td colspan="2">If the below are not YES both you may live issues while upgrading to next version 2.38 which is coming Soon</td></tr>
	<tr><th width="200">Plugins Directory Writable :</th><td><?php if(is_writable(WP_PLUGIN_DIR)){ echo 'YES'; } else { echo 'NO'; } ?></td></tr>
	<tr><th width="200">Uploads Directory Writable :</th><td><?php if(is_writable(WP_CONTENT_DIR.'/uploads')){ echo 'YES'; } else { echo 'NO'; } ?></td></tr>
	</tbody></table><p></p>
	<table class="widefat">
	<thead>
	<tr><th colspan="2">Ultimatum Core</th></tr>
	</thead>
	<?php if($ultimatum_update['version']>$ultimatumversion){?>
	<tfoot>
	<tr><td style="text-align:right" colspan="2">
	<p><a class="button-primary autowidth" href="admin.php?page=wonder-update&task=upgrade">Update Now</a></p>
	</td></tr>
	</tfoot>
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
