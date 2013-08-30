<?php
add_action('init','udefaultscreen_scripts');
add_action('init','udefaultscreen_styles');
function udefaultscreen_scripts(){
wp_enqueue_script('jquery');
wp_enqueue_script( 'ultimatum-iphone',THEME_ADMIN_URI.'/js/jquery-iphone.js' );
wp_enqueue_script( 'ultimatum-cpicker4',THEME_ADMIN_URI.'/js/layout.js' );
wp_enqueue_script( 'ultimatum-lazyload',THEME_ADMIN_URI.'/js/lazyload.js' );
}
function udefaultscreen_styles(){
}

function fonts(){
	if(isset($_REQUEST["task"])){
		$task = $_REQUEST["task"];
	} else {
		$task=false;
	}
	switch ($task){
		case 'cufon':
			cufonFonts();
		break;
		case 'google':
			googleFonts();
		break;
		case 'fontface':
			fontFace();
		break;
		default:
			fontsPanel();
		break;	
	}	
}

function fontsPanel(){
	$google_f='';
	$fontface_css='';
	$fonts =get_option(THEME_CODE . '_fonts');
	$cufon = $fonts['cufon'];
	$fontface = $fonts['fontface'];
	$google = $fonts['google'];
	if(is_array($cufon)){
		wp_enqueue_script( 'cufon-yui', THEME_JS .'/cufon-yui.js');
			$cufon_scripts = "<script type='text/javascript'>\njQuery(document).ready(function() {\n";
			$count = 1;
			foreach($cufon as $font_name => $file_name){
				wp_enqueue_script( $font_name, THEME_CUFON_URI .'/'.$file_name);
				$cufon_scripts .= stripslashes("Cufon('#previewCufon-$count', { fontFamily: '$font_name' });\n");
				$count ++;
			}
			do_action('admin_print_scripts');
			echo $cufon_scripts."});\n</script>";
	}
	if(is_array($fontface)){
		$url = THEME_URI.'/fonts/fontface';
		
	foreach ($fontface as $font_str){
				$font_info = explode("|", $font_str);
				$stylesheet = THEME_FONTFACE_DIR.'/'.$font_info[0].'/stylesheet.css';
				if(file_exists($stylesheet)){
					$file_content = file_get_contents($stylesheet);
					if( preg_match("/@font-face\s*{[^}]*?font-family\s*:\s*('|\")$font_info[1]\\1.*?}/is", $file_content, $match) ){
						$fontface_css .= preg_replace("/url\s*\(\s*['|\"]\s*/is","\\0$url/$font_info[0]/",$match[0])."\n";
					}
				}
			}
	}
	if(is_array($google)){
	foreach ($google as $font=>$css){
		$css= str_replace(' ', '+', $css);
		$google_f .='@import url(http://fonts.googleapis.com/css?family='.$css.');'."\n";
	}
	}
	echo '<style>';
	echo $google_f;
	echo $fontface_css;
	echo '</style>';
	screen_icon(); 
	echo '<div class="wrap">';
if($_POST){
		$type=$_POST[type];
		switch ($type){
			case 'cufon':
				$upload_dir = THEME_CUFON_DIR;
				$ext = pathinfo($_FILES["cufon"]["name"], PATHINFO_EXTENSION);
				if($ext=='js'){
					if(move_uploaded_file($_FILES["cufon"]["tmp_name"],$upload_dir."/" . $_FILES["cufon"]["name"])){
						$msg = 'Font uploaded check it on cufon panel and enable if you want so.';
					} else {
						$msg = 'Upload Failed.';
					}
				} else {
					$msg = 'Please upload .js files only';
				}			
			break;
			case 'fontface':
				//
				$ext = pathinfo($_FILES['fontface']['name'], PATHINFO_EXTENSION);
				if($ext=='zip'){
				
				require_once(THEME_ADMIN_HELPERS.'/pclzip.lib.php'); //include class
				$upload_dir = THEME_FONTFACE_DIR; //your upload directory NOTE: CHMODD 0777
				$filename = $_FILES['fontface']['name']; //the filename
				if(move_uploaded_file($_FILES['fontface']['tmp_name'], $upload_dir.'/'.$filename)){
				   	$zip_dir = basename($filename, ".zip"); //get filename without extension fpr directory creation
				 	if(!@mkdir($upload_dir.'/'.$zip_dir, 0777)){
				 		$msg = 'Could not create directory check premissions.';
				 	} else {
						$archive = new PclZip($upload_dir.'/'.$filename);
						if ($archive->extract(PCLZIP_OPT_PATH, $upload_dir.'/'.$zip_dir) == 0){
							$msg = 'Unzipping the archive failed';
						} else {
							$msg = 'Font uploaded check it on @font-face panel and enable if you want so.';	
							unlink($upload_dir.'/'.$filename); //delete uploaded file
						}
				 	}
				} else {
					$msg = 'Upload Failed.';
				}
				
				} else {
					$msg = 'Please upload .zip files only';
				}
			break;
		}
		$url = 'admin.php?page=wonder-fonts&u_msg='.$msg;
		?>
		<script language="JavaScript">
				parent.location.href='<?php echo $url; ?>';
		</script>
		<?php 
	}
	if(isset($_GET["u_msg"])){
	?>
	<div class="updated fade below-h2" id="message"><p><strong><?php echo $_GET[u_msg];?></strong></p></div>
	<?php 
	}
	?>
	<h2><?php echo THEME_NAME; ?> <?php _e('Font Library',THEME_ADMIN_LANG_DOMAIN); ?></h2>
	<p>
	<a class="button-primary autowidth" href="admin.php?page=wonder-fonts&task=cufon"><?php _e('Cufon Panel',THEME_ADMIN_LANG_DOMAIN);?></a>
	<a class="button-primary autowidth" href="admin.php?page=wonder-fonts&task=fontface">@font-face Panel</a>
	<a class="button-primary autowidth" href="admin.php?page=wonder-fonts&task=google">Google Web Fonts Panel</a>
	</p>
	<table class="widefat">
	<tr><th>What is Font Library?</th></tr>
	<tr>
		<td>
			<p>With this template we intended to make sure that our clients can use variety of fonts.However making the user select fonts via dropdown with hundreds of options is not good in terms of usability. This is why we developed this smart font library.</p>
			<p>With font library you can add new fonts to the theme by simply uploading them via boxes below. Also until a font is enabled it wont show in the dropdown selection boxes. So that the user would know which fonts they have enabled and will select among them.In this screen you can see your enabled fonts as well.</p>
			<p>After enabling fonts for selection you do not need to do any extra settings or type any code. If a font from a library is called in layout it will automatically load itself.</p>
		</td>
	</tr>
	</table>
	<p></p>
	<table width="100%">
	<tr valign="top">
	<td width="33%">
	<table class="widefat">
	<tr><th><h2 style="width:auto;float:left;padding:0;line-height:22px;">Cufon Fonts</h2><p style="float:right">
	<a class="button-primary autowidth" href="admin.php?page=wonder-fonts&task=cufon">Cufon Panel</a>
	</p></th></tr>
	
	<?php 
	if(is_array($cufon)){
		$c=1;
		foreach($cufon as $font=>$js){
			echo '<tr>';
			echo '<td><div id="previewCufon-'.$c.'" style="font-size:18px;line-height:22px;height:30px;">'.$font.'</div></td></tr>';
			$c++;		
		}
	} else {
		echo '<tr><td>No Cufon Fonts are enabled yet. To enable some go to Cufon Panel</td></tr>';	
	}
	?>
	
	</table>
	<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="type" value="cufon" />
	<table class="widefat">
	<tr><th>Upload a Cufon Font</th></tr>
	<tr><td>Only *.js files please</td></tr>
	<tr><td><input type="file" name="cufon" /></td></tr>
	<tr><td><input type="submit" class="button-primary autowidth" value="Upload" /></td></tr>
	</table>
	</form>
	</td>
	<td width="33%">
	<table class="widefat">
	<tr><th><h2 style="width:auto;float:left;padding:0;line-height:22px;">Font-Face Fonts</h2><p style="float:right">
	<a class="button-primary autowidth" href="admin.php?page=wonder-fonts&task=fontface">Font-Face Panel</a>
	</p></th></tr>
	<?php 
	if(is_array($fontface)){
		$c=1;
		foreach($fontface as $font=>$value){
			echo '<tr>';
			echo '<td><div style="font-family:'.$font.';font-size:18px;line-height:22px;height:30px;">'.$font.'</div></td></tr>';
			$c++;		
		}
	} else {
		echo '<tr><td>No Font Faces are enabled yet. To enable some go to Font-Face Panel</td></tr>';	
	}
	?>
	</td></tr>
	</table>
	<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="type" value="fontface" />
	<table class="widefat">
	<tr><th>Upload a @font-face kit</th></tr>
	<tr><td>Only *.zip files please You can get @font-face kits from <a href="http://www.fontsquirrel.com">fontsquirrel</a></td></tr>
	<tr><td><input type="file" name="fontface" /></td></tr>
	<tr><td><input type="submit" class="button-primary autowidth" value="Upload" /></td></tr>
	</table>
	</form>
	</td>
	<td>
	<table class="widefat">
	<tr><th><h2 style="width:auto;float:left;padding:0;line-height:22px;">Google Fonts</h2><p style="float:right">
	<a class="button-primary autowidth" href="admin.php?page=wonder-fonts&task=google">Google Fonts Panel</a>
	</p></th></tr>
	<?php 
	if(is_array($google)){
		$c=1;
		foreach($google as $font=>$value){
			echo '<tr>';
			echo '<td><div style="font-family:'.$font.';font-size:18px;line-height:22px;height:30px;">'.$font.'</div></td></tr>';
			$c++;		
		}
	} else {
		echo '<tr><td>No Google Fonts are enabled yet. To enable some go to Google Font Panel</td></tr>';	
	}
	?>
	</table>
	</td>
	</tr>
	</table>
	<?php
	echo '</div>';
}

function cufonFonts(){
	global $theme_options;
	include_once THEME_ADMIN_HELPERS.'/class.options.php';
	screen_icon(); 
	echo '<div class="wrap">';?>
	<h2><?php echo THEME_NAME; ?> Cufon Fonts</h2>
	<p>
	<a class="button-primary autowidth" href="admin.php?page=wonder-fonts">Font Library</a>
	<a class="button-primary autowidth" href="admin.php?page=wonder-fonts&task=fontface">@font-face Panel</a>
	<a class="button-primary autowidth" href="admin.php?page=wonder-fonts&task=google">Google Web Fonts Panel</a>
	</p>
	<?php 
				$tbg = include_once THEME_ADMIN_OPTIONS.'/cufon-fonts.php';
				$onur = new optionGenerator($tbg["name"], $tbg["options"]);?>
	<?php
	echo '</div>'; 
}

function fontFace(){
	global $theme_options;
	include_once THEME_ADMIN_HELPERS.'/class.options.php';
	screen_icon(); 
	echo '<div class="wrap">';?>
	<h2><?php echo THEME_NAME; ?> @font-face Fonts</h2>
	<p>
	<a class="button-primary autowidth" href="admin.php?page=wonder-fonts">Font Library</a>
	<a class="button-primary autowidth" href="admin.php?page=wonder-fonts&task=cufon">Cufon Panel</a>
	<a class="button-primary autowidth" href="admin.php?page=wonder-fonts&task=google">Google Web Fonts Panel</a>
	</p>
	<?php 
				$tbg = include_once THEME_ADMIN_OPTIONS.'/fontface-fonts.php';
				$onur = new optionGenerator($tbg["name"], $tbg["options"]);?>
	<?php
	echo '</div>'; 
}











if (! function_exists("theme_cufon_get_fonts")){
	function theme_cufon_get_fonts(){
		$fonts = array();
		foreach(glob(THEME_CUFON_DIR."/*.js") as $font_file){
			$file_content = file_get_contents($font_file);
			if(preg_match('/font-family":"(.*?)"/i',$file_content,$match)){
				$fonts[$match[1]] = basename($font_file);
			}
		}
		array_multisort(array_keys($fonts), array_values($fonts), $fonts);
		return $fonts;
	}
}
if(isset($_GET['page']) &&  isset($_GET['task']) && $_GET['page']=='wonder-fonts' && $_GET["task"] == 'cufon'){
	if (! function_exists("theme_cufon_add_script_option")){
		function theme_cufon_add_script_option(){
			wp_enqueue_script( 'cufon-yui', THEME_JS .'/cufon-yui.js');
			$cufon_scripts = "<script type='text/javascript'>\njQuery(document).ready(function() {\n";
			$count = 1;
			foreach(theme_cufon_get_fonts() as $font_name => $file_name){
				wp_enqueue_script( $font_name, THEME_CUFON_URI .'/'.$file_name);
				$cufon_scripts .= stripslashes("Cufon('#preview-$count', { fontFamily: '$font_name' });\n");
				$count ++;
			}
			do_action('admin_print_scripts');
			echo $cufon_scripts."});\n</script>";
		}
		add_filter('admin_head', 'theme_cufon_add_script_option');
	}
}
if (! function_exists("theme_cufon_fonts_option")) {
	function theme_cufon_fonts_option($value, $default) {
		echo '<tr colspan="2"><td style="padding:0"><table class="widefat cufon_table" cellspacing="0"><tbody>';
		$count = 1;
		foreach(theme_cufon_get_fonts() as $font_name => $file_name){
			if(is_array($default)){
				$checked = in_array($file_name,$default)?' checked="checked"':'';
			}else{
				$checked = '';
			}
			echo '<tr><td style="width:15%"><div class="font_name_wrap" style="position: relative;">
			'.$font_name.'</div></td>
			<td style="width:10%">
			<input type="checkbox" name="cufon['.$font_name.']" class="toggle-button" value="'.$file_name.'"'.$checked.'/>
			</td><td>
			<span style="font-size:18px;line-height:22px;height:30px;" id="preview-'.$count.'">The quick brown fox jumps over the lazy dog. 1234567890&!#$</span></td></tr>';
			$count ++;
		}
		echo '</tbody></table></td></tr>';
	}
}



if(isset($_GET['page']) &&  isset($_GET['task']) && $_GET['page']=='wonder-fonts' && $_GET["task"] == 'fontface'){
	if (! function_exists("theme_fontface_getfonts")){
		function theme_fontface_getfonts(){
			$fonts = array();
			$dirs = array_filter(glob(THEME_FONTFACE_DIR.'/*'), 'is_dir');
			
			foreach($dirs as $dir){
				$stylesheet = $dir.'/stylesheet.css';
				if(file_exists($stylesheet)){
					$file_content = file_get_contents($stylesheet);
					if( preg_match_all("/@font-face\s*{.*?font-family\s*:\s*('|\")(.*?)\\1.*?}/is", $file_content, $matchs) ){
						foreach($matchs[0] as $index => $css){
							$font_folder = basename($dir);
							$fonts[$font_folder.'|'.$matchs[2][$index]] = array(
								'folder' => $font_folder,
								'name' => $matchs[2][$index],
								'css' => $css,
							);
						}
						
					}
				}
			}
			return $fonts;
		}
	}
if (! function_exists("theme_fontface_add_head")){
		function theme_fontface_add_head(){
			$fonts = theme_fontface_getfonts();
			
			$count = 1;
			$style = "<style type='text/css'>\n";
			foreach($fonts as $value => $font){
				wp_enqueue_style('font|'.$value , THEME_FONTFACE_URI . '/'.$font['folder'].'/stylesheet.css');
				$style .= "#preview-".$count."{\n\tfont-family:".$font['name'].";\n}\n";
				$count ++;
			}
			
			$style .= "</style>";
			echo $style;
			
			do_action('admin_print_styles');
			
		}
		add_filter('admin_head', 'theme_fontface_add_head');
	}
}
if (! function_exists("theme_fontface_fonts_option")) {
	function theme_fontface_fonts_option($value, $default) {
		$fonts = theme_fontface_getfonts();
		echo '<tr colspan="2"><td style="padding:0"><table class="widefat fontface_table" cellspacing="0"><tbody>';
		$count = 1;
		foreach($fonts as $value => $font){
			if(is_array($default)){
				$checked = in_array($value,$default)?' checked="checked"':'';
			}else{
				$checked = '';
			}
			
			echo '<tr>
						<td style="width:15%">
						<div class="font_name_wrap" style="position: relative;">'
						.$font['name']
						.'</div></td><td style="width:10%">
						<input type="checkbox" name="fontface['.$font['name'].']" value="'.$value.'"'.$checked.'/>
						</td><td>
						<span style="font-size:18px;line-height:22px;height:30px;" id="preview-'.$count.'">The quick brown fox jumps over the lazy dog. 1234567890&!#$</span></td></tr>
						';
			$count ++;
		}
		echo '</tbody></table></td></tr>';
	}
}


if (! function_exists("google_fonts_option")) {
	function google_fonts_option($value, $default) {
		echo '<tr colspan="2"><td style="padding:0">This page uses Lazy Load please wait after you scroll to see font previews.</td></tr>';
		echo '<tr colspan="2"><td style="padding:0"><table class="widefat" cellspacing="0"><tbody>';
		$count = 1;
		foreach (get_google_fonts() as $font_name=>$file_name){
			$font = str_replace('+', ' ', $font_name);
			if(stripos($font,':')){
				$sty = explode(':', $font);
				$styles = $sty[1];
				$fontname = $fontname .'<br/><i>Includes styles:'.$styles.'</i>';
			}
			if(is_array($default)){
				$checked = in_array($file_name,$default)?' checked="checked"':'';
			}else{
				$checked = '';
			}
			echo '<tr><td style="width:15%;height:24px;">';
			echo '<div class="font_name_wrap" style="position: relative;">
			'.$font_name.'</div></td>
			<td style="width:10%">
			<input type="checkbox" name="google['.$font_name.']" value="'.$file_name.'"'.$checked.'/>
			</td><td><pre class="googlefont"><!--'."\n";
			 echo "<style type='text/css'>";
			$font = str_replace(' ', '+', $font_name);
			echo '@import url(http://fonts.googleapis.com/css?family='.$font.');';
			echo "</style>";
			echo '<span style="font-family:'.$font_name.';font-size:18px;line-height:22px;height:30px;"">The quick brown fox jumps over the lazy dog. 1234567890&!#$</span>';
			echo "\n".'--></pre></td></tr>';
			$count ++;
		}
		echo '</tbody></table></td></tr>';
	}
}

if(isset($_GET['page']) &&  isset($_GET['task']) &&  $_GET['page']=='wonder-fonts' && $_GET["task"] == 'google'){
	if (! function_exists("get_google_fonts")){
	function get_google_fonts(){
	include_once ('google_fonts.php');
	return $google_webfonts;
	}
	}
if (! function_exists("google_fonts_add_head")){
		function google_fonts_add_head(){
			$google_webfonts = get_google_fonts();
			
			$count = 1;
			$style = "<style type='text/css'>\n";
			foreach ($google_webfonts as $fontname=>$font){
				$font = str_replace(' ', '+', $font);
				$style .= '@import url(http://fonts.googleapis.com/css?family='.$font.');'."\n";
			}
			$style .= "</style>";
			echo $style;
			
			do_action('admin_print_styles');
			
		}
		//add_filter('admin_head', 'google_fonts_add_head');
	}
}


function googleFonts(){
	global $theme_options;
	include_once THEME_ADMIN_HELPERS.'/class.options.php';
	screen_icon(); 
	echo '<div class="wrap">';?>
	<h2><?php echo THEME_NAME; ?> Google Web Fonts</h2>
	<p>
	<a class="button-primary autowidth" href="admin.php?page=wonder-fonts">Font Library</a>
	<a class="button-primary autowidth" href="admin.php?page=wonder-fonts&task=cufon">Cufon Panel</a>
	<a class="button-primary autowidth" href="admin.php?page=wonder-fonts&task=fontface">@font-face Panel</a></p>
	<?php 
				$tbg = include_once THEME_ADMIN_OPTIONS.'/google-fonts.php';
				$onur = new optionGenerator($tbg["name"], $tbg["options"]);?>
	<?php
	echo '</div>'; 
}