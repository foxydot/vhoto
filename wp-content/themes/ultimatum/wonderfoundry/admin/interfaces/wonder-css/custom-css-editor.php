<?php include( '../../../../../../../wp-load.php' );
global $wp_version;
?>
<html>
<head>
<script type='text/javascript' src='<?php bloginfo('wpurl');?>/wp-includes/js/jquery/jquery.js?ver=1.6.1'></script>
<script type='text/javascript' src='<?php echo THEME_ADMIN_URI;?>/js/edit_area/edit_area_full.js'></script>
<style>
body{
	margin:0;
	font-family:Arial,sans-serif;
}

#wpadminbar { display:none; }
</style>
</head>
<body>
<?php 
global $blog_id;
if(is_multisite()){
		global $blog_id;
		$prel = $blog_id.'_';
	}else{
		
	}
$layout_id = $_REQUEST['layout_id'];
$cssfile = THEME_CACHE_DIR.'/custom_'.$prel.$layout_id.'.css';
if($_POST){
	// first delete existing one
	if(file_exists($cssfile)){ unlink($cssfile); }
	$css = str_replace('\\','',$_POST['custom_css']);
	if(strlen($css)>1){
		$fhandler = @fopen($cssfile, 'w+');
		if ($fhandler) fwrite($fhandler, $css, strlen($css));
	}
}
if(file_exists($cssfile)){ $css= file_get_contents($cssfile); }
?>
<form method="post" action="">
<textarea id="custom_css" style="height: 350px; width: 100%;" name="custom_css">
<?php echo $css; ?>
</textarea>
<p>When using images in your CSS use their absolute URL so that you wont have any problems while exporting.</p>
<input type="submit" />
</form>
	<script language="JavaScript">
		jQuery(document).ready(function(){
			editAreaLoader.init({
				id: "custom_css"	// id of the textarea to transform	
				,start_highlight: true	
				,font_size: "8"
				,font_family: "verdana, monospace"
				,allow_resize: "y"
				,allow_toggle: false
				,language: "en"
				,syntax: "css"	
				,toolbar: ""
				
				,plugins: "charmap"
				,charmap_default: "arrows"
					
			});
		});
	</script>
</body>
</html>