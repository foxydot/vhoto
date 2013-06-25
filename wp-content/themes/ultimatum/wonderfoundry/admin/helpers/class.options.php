<?php
class optionGenerator {
	var $name;
	var $options;
	var $saved_options;
	/**
	 * Constructor
	 * 
	 * @param string $name
	 * @param array $options
	 */
	function optionGenerator($name, $options) {
		
		$this->name = $name;
		$this->options = $options;
		
		$this->save_options();
		$this->render();
	}
	
	function save_options() {
		$setter='_';
		if(isset($_GET["layout"])){
			$setter='_'.$_GET["layout"].'_';	
		}
		$exclsiveoptions=array('general','seo','ultimatum_access');
		if(!in_array($this->name,$exclsiveoptions)){
			$optionmane=THEME_CODE .$setter. $this->name;
		} else {
			$optionmane=THEME_SLUG .$setter. $this->name;
			
		}
		$options = get_option($optionmane);
		
		if (isset($_POST['save_options'])) {
			
			foreach($this->options as $value) {
				
				if (isset($value['id']) && ! empty($value['id'])) {
					if (isset($_POST[$value['id']])) {
						if($value['type'] == 'toggle'){
							if($_POST[$value['id']] == 'true'){
								$options[$value['id']] = true;
							}else{
								$options[$value['id']] = false;
							}
						} else {
							$options[$value['id']] = $_POST[$value['id']];
						}
					} else {
						$options[$value['id']] = false;
					}
				}
				if (isset($value['process']) && function_exists($value['process'])) {
					$options[$value['id']] = $value['process']($value,$options[$value['id']]);
				}
			}
			
			if ($options != $this->options) {
				update_option($optionmane, $options);
				global $theme_options;
				$theme_options[$this->name] = $options;
				
				if($this->name=='css'){
					$this->save_skin_style($setter);	
				}
			}
			echo '<div id="message" class="updated fade"><p><strong>Updated Successfully</strong></p></div>';
		}
		
		$this->saved_options = $options;
	
	}
	
	function save_skin_style($setter) {
	
		$setter = substr($setter,0,-1);
        if (is_writable(THEME_CACHE_DIR)) {
			if(is_multisite()){
				global $blog_id;
				$file = THEME_CACHE_DIR.'/skin_'.$blog_id.$setter.'.css';
			}else{
				$file = THEME_CACHE_DIR.'/skin'.$setter.'.css';
			}
            $fhandle = @fopen($file, 'w+');
			$post = $_POST;
			
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
        	if(is_multisite()){
				global $blog_id;
				$gfile = THEME_CACHE_DIR.'/google_'.$blog_id.$setter.'.php';
			}else{
				$gfile = THEME_CACHE_DIR.'/google'.$setter.'.php';
			}
			// first delete existing one
			if(file_exists($gfile)){
				unlink($gfile);
			}
			if(isset($googlecss)){
				$gcss = array_unique($googlecss);
				if(count($gcss)>=1){
					$googleCss='';
					foreach($gcss as $google_css){
						$google_css=str_replace(' ', '+', $google_css);
						$charsets = get_theme_option('general','google_charset');
						if(count($charsets)!=0){
							$subset="&subset=".implode(',',$charsets);
							$google_css .=$subset;
						}
						$googleCss .= '<link rel="stylesheet" type="text/css" media="all" href="http://fonts.googleapis.com/css?family='.$google_css.'" />'."\n";
						$fhandler = @fopen($gfile, 'w+');
						if ($fhandler) fwrite($fhandler, $googleCss, strlen($googleCss));
					}
				}
			}
        	if(is_multisite()){
				global $blog_id;
				$fffile = THEME_CACHE_DIR.'/fontface_'.$blog_id.$setter.'.css';
			}else{
				$fffile = THEME_CACHE_DIR.'/fontface'.$setter.'.css';
			}
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
            if(is_multisite()){
				global $blog_id;
				$cfile = THEME_CACHE_DIR.'/cufon_'.$blog_id.$setter.'.php';
			}else{
				$cfile = THEME_CACHE_DIR.'/cufon'.$setter.'.php';
			}
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
        }
        return false;
    }
	
	function render() {
		echo '<div class="wrap">';
		echo '<form method="post" action="">';
		
		foreach($this->options as $option) {
			if (method_exists($this, $option['type'])) {
				$this->$option['type']($option);
			}
		
		}
		echo '</form>';
		echo '</div>';
	}
	
	/**
	 * prints the options page title
	 */
	function title($value) {
		echo '<h2>' . $value['name'] . '</h2>';
		if (isset($value['desc'])) {
			echo '<p>' . $value['desc'] . '</p>';
		}
	}
	
	
	function table_start($value){
		echo '<table width="100%">';
	}
	function table_end($value){
		echo '</table>';
	}
	function table_row_start($value){
		echo '<tr valign="top">';
	}
	function table_col_start($value){
		echo '<td width="'.$value['default'].'">';
	}
	function table_row_end($value){
		echo '</tr>';
	}
	function table_col_end($value){
		echo '</td>';
	}
	function explain($value){
		echo '<p><i>'.$value["name"].'</i></p>';
	}
	
	/**
	 * begins the group section
	 */
	function start($value) {
		echo '<div class="">';
		echo '<table cellspacing="0" class="widefat">';
		echo '<thead><tr valign="top">';
		echo '<th scope="row" colspan="2">' . $value['name'] . '</th>';
		echo '</tr></thead><tbody>';
	}
	
	function txtElementHead($value) {
		echo '<div class="">';
		echo '<table cellspacing="0" class="widefat">';
		echo '<thead><tr valign="top">';
		echo '<th>' . __('Element',THEME_ADMIN_LANG_DOMAIN) . '</th>';
		echo '<th>' . __('Font Family',THEME_ADMIN_LANG_DOMAIN) . '</th>';
		echo '<th>' . __('Font Size',THEME_ADMIN_LANG_DOMAIN) . '</th>';
		echo '<th>' . __('Line Height',THEME_ADMIN_LANG_DOMAIN) . '</th>';
		echo '<th>' . __('Color',THEME_ADMIN_LANG_DOMAIN) . '</th>';
		echo '<th>' . __('Font Weight',THEME_ADMIN_LANG_DOMAIN) . '</th>';
		echo '<th>' . __('Style',THEME_ADMIN_LANG_DOMAIN) . '</th>';
		echo '<th>' . __('Decoration',THEME_ADMIN_LANG_DOMAIN) . '</th>';
		echo '</tr></thead><tbody>';
	}
	
	function txtElement($value) {
		$values = ($this->saved_options[$value['id']]);
		echo '<tr>';
		echo '<td><h3>' .$value[name].'</h3></td>';
		echo '<td>'; 
		if($value['default']['font-family']){
		$dfonts= array(
				'"Arial Black",Gadget,sans-serif' => '"Arial Black",Gadget,sans-serif',
				'Arial,Helvetica,Garuda,sans-serif' => 'Arial,Helvetica,Garuda,sans-serif',
				'Verdana,Geneva,Kalimati,sans-serif' => 'Verdana,Geneva,Kalimati,sans-serif',
				'"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif' => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
				'Georgia,"Nimbus Roman No9 L",serif' => 'Georgia,"Nimbus Roman No9 L",serif',
				'"Palatino Linotype","Book Antiqua",Palatino,FreeSerif,serif' => '"Palatino Linotype","Book Antiqua",Palatino,FreeSerif,serif',
				'Tahoma,Geneva,Kalimati,sans-serif' => 'Tahoma,Geneva,Kalimati,sans-serif',
				'"Trebuchet MS",Helvetica,Jamrul,sans-serif' => '"Trebuchet MS",Helvetica,Jamrul,sans-serif',
				'"Times New Roman",Times,FreeSerif,serif' => '"Times New Roman",Times,FreeSerif,serif',
			);
			// Get the enabled Fonts
			$fonts =get_option(THEME_CODE . '_fonts');
			$cufon=$fonts[cufon];
			$fontface=$fonts[fontface];
			$google = $fonts[google];
		//	print_r($cufon);
			echo '<select name="' . $value['id']. '[font-family]" id="' . $value['id'] . '" style="width:200px;">';
			if (isset($dfonts)) {
				foreach($dfonts as $key => $option) {
					echo "<option value='" . $key . "'";
					if (isset($values['font-family'])) {
						if (stripslashes($values['font-family']) == $key) {
							echo ' selected="selected"';
						}
					} else {
						if($key == $value['default']['font-family']) {
								echo ' selected="selected"';
						}
					}
					echo '>' . $option . '</option>';
				}
			}
			if(count($cufon)>=1 && $value['cufon']){
				echo '<optgroup label="Cufon Fonts">';
				foreach ($cufon as $font=>$js){
					$key = 'cufon-'.$font.'-js-'.$js;
					echo '<option value="'.$key.'"';
					if (isset($values['font-family'])) {
					if (stripslashes($values['font-family']) == $key) {
							echo ' selected="selected"';
					}
					} else {
						if($key == $value['default']['font-family']) {
								echo ' selected="selected"';
						}
					}
					echo '>'.$font.'</option>';
				}
				echo '</optgroup>';
			}
			if(count($fontface)>=1){
				echo '<optgroup label="@font-face">';
				foreach ($fontface as $font=>$js){
					$key = 'fontface-'.$font.'-css-'.$js;
					echo '<option value="'.$key.'"';
					if (isset($values['font-family'])) {
					if (stripslashes($values['font-family']) == $key) {
							echo ' selected="selected"';
					}
					} else {
						if($key == $value['default']['font-family']) {
								echo ' selected="selected"';
						}
					}
					echo '>'.$font.'</option>';
				}
				echo '</optgroup>';
			}
			if(count($google)>=1){
				echo '<optgroup label="Google Fonts">';
				foreach ($google as $font=>$js){
					$key = 'google-'.$font.'-css-'.$js;
					echo '<option value="'.$key.'"';
					if (isset($values['font-family'])) {
					if (stripslashes($values['font-family']) == $key) {
							echo ' selected="selected"';
					}
					} else {
						if($key == $value['default']['font-family']) {
								echo ' selected="selected"';
						}
					}
					echo '>'.$font.'</option>';
				}
				echo '</optgroup>';
			}
			echo '</select>';
		}
		echo'</td>';
		echo '<td>';
		if($value['default']['font-size']){
			echo '<input name="' . $value['id'] . '[font-size]" id="' . $value['id'] . '" type="text" size="2" value="';
			if (isset($values['font-size'])) {
				echo stripslashes($values['font-size']);
			} else {
				echo $value['default']['font-size'];
			}
			echo '" /> px';
		}
		echo '</td>';
		echo '<td>';
		if($value['default']['line-height']){
			echo '<input name="' . $value['id'] . '[line-height]" id="' . $value['id'] . '" type="text" size="2" value="';
			if (isset($values['font-size'])) {
				echo stripslashes($values['line-height']);
			} else {
				echo $value['default']['line-height'];
			}
			echo '" /> px';
		}
		echo '</td>';
		echo '<td>';
				if (strlen($values[color])>0) {
					$the_value = ($values[color]);
				} else {
					$the_value = $value['default'][color];
				}
				
				echo '<div class="cPicker" id="'.$value['id'].'-color"><div class="colorSelector" style="float:left">';
				echo '<div style="background-color: #'.$the_value.';"></div></div>';
				echo '<input type="text" name="'.$value['id'].'[color]" value="'.$the_value.'" size="6" /></div>';
		echo '</td>';
		echo '<td>';
			echo '<select name="' . $value['id'] . '[font-weight]" id="' . $value['id'] . '">';
				$options = array ('normal'=>__('Normal',THEME_ADMIN_LANG_DOMAIN),'bold'=>__("Bold",THEME_ADMIN_LANG_DOMAIN));
				foreach($options as $key => $option) {
					echo "<option value='" . $key . "'";
					if (isset($values['font-weight'])) {
						if (stripslashes($values['font-weight']) == $key) {
							echo ' selected="selected"';
						}
					} else if ($key == $value['default']['font-weight']) {
						echo ' selected="selected"';
					}
						echo '>' . $option . '</option>';
				}
		echo '</td>';
		echo '<td>';
			echo '<select name="' . $value['id'] . '[font-style]" id="' . $value['id'] . '">';
				$options = array ('normal'=>__('Normal',THEME_ADMIN_LANG_DOMAIN),'italic'=>__("Italic",THEME_ADMIN_LANG_DOMAIN));
				foreach($options as $key => $option) {
					echo "<option value='" . $key . "'";
					if (isset($values['font-style'])) {
						if (stripslashes($values['font-style']) == $key) {
							echo ' selected="selected"';
						}
					} else if ($key == $value['default']['font-style']) {
						echo ' selected="selected"';
					}
						echo '>' . $option . '</option>';
				}
		echo '</td>';
		echo '<td>';
			echo '<select name="' . $value['id'] . '[text-decoration]" id="' . $value['id'] . '">';
				$options = array ('none'=>'None','underline'=>__("Underline",THEME_ADMIN_LANG_DOMAIN),'overline'=>__("Overline",THEME_ADMIN_LANG_DOMAIN),'line-through'=>__("Line-Through",THEME_ADMIN_LANG_DOMAIN));
				foreach($options as $key => $option) {
					echo "<option value='" . $key . "'";
					if (isset($values['font-style'])) {
						if (stripslashes($values['text-decoration']) == $key) {
							echo ' selected="selected"';
						}
					} else if ($key == $value['default']['text-decoration']) {
						echo ' selected="selected"';
					}
						echo '>' . $option . '</option>';
				}
		echo '</td>';
		echo '</tr>';
	}
	
	function desc($value) {
		echo '<tr valign="top"><td scope="row" colspan="2">' . $value['desc'] . '</td></tr>';
	}
	
	function tabopen($value){
		echo '<div id="'.$value[id].'">';
	}
	function tabclose($value){
		echo '</div>';
	}
	function end($value) {
		echo '</tbody></table></div><p class="submit"><input type="submit" name="save_options" class="button-primary autowidth" value="'.__('Save Changes',THEME_ADMIN_LANG_DOMAIN).'" /></p>';
	}
	function endnosave($value) {
		echo '</tbody></table></div><br />';
	}
	/**
	 * displays a text input
	 */
	function text($value) {
		$size = isset($value['size']) ? $value['size'] : '10';
		
		echo '<tr valign="top"><td scope="row"><h3><label for="'.$value['id'].'">' . $value['name'] . '</label></h3></td><td>';
		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" size="' . $size . '" value="';
		if (isset($this->saved_options[$value['id']])) {
			echo stripslashes($this->saved_options[$value['id']]);
		} else {
			echo $value['default'];
		}
		echo '" /><br />';
		echo '</td></tr>';
	}
	/**
	 * displays a text inputCSS
	 */
	function textCSS($value) {
		$size = isset($value['size']) ? $value['size'] : '10';
		
		echo '<tr valign="top"><td scope="row"><h3><label for="'.$value['id'].'-'.$value['property'].'">' . $value['name'] . '</label></h3></td><td>';
		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		echo '<input name="' . $value['id'].'['.$value['property'].']" id="' . $value['id'] . '-'.$value['property'].'" type="text" size="' . $size . '" value="';
		$values=$this->saved_options[$value[id]];
		if (isset($values[$value['property']])) {
			echo stripslashes($values[$value['property']]);
		
		} else {
			echo $value['default'];
		}
		echo '" />px<br />';
		echo '</td></tr>';
	}
	/**
	 * displays a textarea
	 */
	function textarea($value) {
		$rows = isset($value['rows']) ? $value['rows'] : '5';
		
		echo '<tr valign="top"><td scope="row"><h3><label for="'.$value['id'].'">' . $value['name'] . '</label></h3></td><td>';
		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		echo '<textarea id="'.$value['id'].'" rows="' . $rows . '" name="' . $value['id'] . '" type="' . $value['type'] . '" style="width:100%">';
		if (isset($this->saved_options[$value['id']])) {
			echo stripslashes($this->saved_options[$value['id']]);
		} else {
			echo $value['default'];
		}
		echo '</textarea><br />';
		echo '</td></tr>';
	}
	
	/**
	 * displays a select
	 */
	function select($value) {
		if (isset($value['target'])) {
			if (isset($value['options'])) {
				$value['options'] = $value['options'] + $this->get_select_target_options($value['target']);
			} else {
				$value['options'] = $this->get_select_target_options($value['target']);
			}
		}
		echo '<tr valign="top"><td scope="row"><h3><label for="'.$value['id'].'">' . $value['name'] . '</label></h3></td><td>';
		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		echo '<select name="' . $value['id'] . '" id="' . $value['id'] . '">';
		
		if(isset($value['prompt'])){
			echo '<option value="">'.$value['prompt'].'</option>';
		}
		if (isset($value['options'])) {
			foreach($value['options'] as $key => $option) {
				echo "<option value='" . $key . "'";
				if (isset($this->saved_options[$value['id']])) {
					if (stripslashes($this->saved_options[$value['id']]) == $key) {
						echo ' selected="selected"';
					}
				} else if ($key == $value['default']) {
					echo ' selected="selected"';
				}
			
				echo '>' . $option . '</option>';
			}
		}
	}	
	function selectCSS($value) {
		
		if (isset($value['target'])) {
			if (isset($value['options'])) {
				$value['options'] = $value['options'] + $this->get_select_target_options($value['target']);
			} else {
				$value['options'] = $this->get_select_target_options($value['target']);
			}
		}
		echo '<tr valign="top"><td scope="row"><h3><label for="'.$value['id'].'">' . $value['name'] . '</label></h3></td><td>';
		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		echo '<select name="' . $value['id'] . '['.$value['property'].']" id="' . $value['id'] . '">';
		
		if(isset($value['prompt'])){
			echo '<option value="">'.$value['prompt'].'</option>';
		}
		$values=$this->saved_options[$value[id]];
		if (isset($values[$value['property']])) {
			$the_value = stripslashes($values[$value['property']]);
		}
		if (isset($value['options'])) {
			foreach($value['options'] as $key => $option) {
				echo "<option value='" . $key . "'";
				if (isset($the_value)) {
					if ($the_value == $key) {
						echo ' selected="selected"';
					}
				} else if ($key == $value['default']) {
					echo ' selected="selected"';
				}
			
				echo '>' . $option . '</option>';
			}
		}
		echo '</select><br />';
		echo '</td></tr>';
	}
	
	/**
	 * displays a multiselect
	 */
	function multiselect($value) {
		$size = isset($value['size']) ? $value['size'] : '5';
		if (isset($value['target'])) {
			if (isset($value['options'])) {
				$value['options'] = $value['options'] + $this->get_select_target_options($value['target']);
			} else {
				$value['options'] = $this->get_select_target_options($value['target']);
			}
		}
		echo '<tr valign="top"><td scope="row"><h3>' . $value['name'] . '</h3></td><td>';
		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		echo '<select name="' . $value['id'] . '[]" id="' . $value['id'] . '" multiple="multiple" size="' . $size . '" style="height:auto">';
		
		if(!empty($value['options']) && is_array($value['options'])){
			foreach($value['options'] as $key => $option) {
				echo '<option value="' . $key . '"';
				if (isset($this->saved_options[$value['id']])) {
					if (is_array($this->saved_options[$value['id']])) {
						if (in_array($key, $this->saved_options[$value['id']])) {
							echo ' selected="selected"';
						}
					}
				} else if (in_array($key, $value['default'])) {
					echo ' selected="selected"';
				}
				echo '>' . $option . '</option>';
			}
		}
		
		echo '</select><br />';
		echo '</td></tr>';
	}
	/**
	 * displays a user selection
	 */
	function userselect($value) {
		$size = isset($value['size']) ? $value['size'] : '5';
		if (isset($value['target'])) {
			if (isset($value['options'])) {
				$value['options'] = $value['options'] + $this->get_select_target_options($value['target']);
			} else {
				$value['options'] = $this->get_select_target_options($value['target']);
			}
		}
		echo '<tr valign="top"><td scope="row"><h3>' . $value['name'] . '</h3></td><td>';
		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		echo '<select name="' . $value['id'] . '[]" id="' . $value['id'] . '" multiple="multiple" size="' . $size . '" style="height:auto">';
		
		//if(!empty($value['options']) && is_array($value['options'])){
			$authors = get_users('&orderby=nicename&role=administrator');
			// Loop through each author
			foreach($authors as $userr) {
				echo '<option value="' . $userr->ID . '"';
				if (isset($this->saved_options[$value['id']])) {
					if (is_array($this->saved_options[$value['id']])) {
						if (in_array($userr->ID, $this->saved_options[$value['id']])) {
							echo ' selected="selected"';
						}
					}
				}
				echo '>' . $userr->user_nicename . '</option>';
			}
		//}
		
		echo '</select><br />';
		
		echo '</td></tr>';
	}

	/**
	 * displays a checkbox
	 */
	function checkbox($value) {
		echo '<tr valign="top"><td scope="row"><h3>' . $value['name'] . '</h3></td><td>';
		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		$i = 0;
		foreach($value['options'] as $key => $option) {
			$i++;
			$checked = '';
			if (isset($this->saved_options[$value['id']])) {
				if (is_array($this->saved_options[$value['id']])) {
					if (in_array($key, $this->saved_options[$value['id']])) {
						$checked = ' checked="checked"';
					}
				}
			} else if (in_array($key, $value['default'])) {
				$checked = ' checked="checked"';
			}
			
			echo '<input type="checkbox" id="' . $value['id'] . '_' . $i . '" name="' . $value['id'] . '[]" value="' . $key . '" ' . $checked . ' />';
			echo '<label for="' . $value['id'] . '_' . $i . '">' . $option . '</label><br />';
		}
		echo '</td></tr>';
	}
	
	/**
	 * displays checkboxs
	 */
	function checkboxs($value) {
		$size = isset($value['size']) ? $value['size'] : '5';
		if (isset($value['target'])) {
			if (isset($value['options'])) {
				$value['options'] = $value['options'] + $this->get_select_target_options($value['target']);
			} else {
				$value['options'] = $this->get_select_target_options($value['target']);
			}
		}
		echo '<tr valign="top"><td scope="row"><h3>' . $value['name'] . '</h3></td><td>';
		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		
		if(!empty($value['options']) && is_array($value['options'])){
			foreach($value['options'] as $key => $option) {
				echo '<label><input type="checkbox" value="' . $key . '" name="' . $value['id'] . '[]"';
				if (isset($this->saved_options[$value['id']])) {
					if (is_array($this->saved_options[$value['id']])) {
						if (in_array($key, $this->saved_options[$value['id']])) {
							echo ' checked="checked"';
						}
					}
				} else if (in_array($key, $value['default'])) {
					echo ' checked="checked"';
				}
				echo '>' . $option . '</label><br/>';
			}
		}
		
		echo '</td></tr>';
	}
	
	/**
	 * displays a radio
	 */
	function radio($value) {
		
		if (isset($this->saved_options[$value['id']])) {
			$checked_key = $this->saved_options[$value['id']];
		} else {
			$checked_key = $value['default'];
		}
		echo '<tr valign="top"><td scope="row"><h3>' . $value['name'] . '</h3></td><td>';
		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		$i = 0;
		foreach($value['options'] as $key => $option) {
			$i++;
			$checked = '';
			if ($key == $checked_key) {
				$checked = ' checked="checked"';
			}
			
			echo '<input type="radio" id="' . $value['id'] . '_' . $i . '" name="' . $value['id'] . '" value="' . $key . '" ' . $checked . ' />';
			echo '<label for="' . $value['id'] . '_' . $i . '">' . $option . '</label><br />';
		}
		
		echo '</td></tr>';
	}
	
	/**
	 * displays a upload field
	 */
	function upload($value) {
		
		$size = isset($value['size']) ? $value['size'] : '50';
		$button = isset($value['button']) ? $value['button'] : 'Insert Image';
		if (isset($this->saved_options[$value['id']])) {
			$value['default'] = stripslashes($this->saved_options[$value['id']]);
		}
		echo '<tr valign="top"><td scope="row"><h3>' . $value['name'] . '</h3></td><td><table><tr valign="top"><td style="border:none">';
		
		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		echo '<input type="text" id="' . $value['id'] . '" name="' . $value['id'] . '" size="' . $size . '"  value="';
		echo $value['default'];
		echo '" /><br /><div class="option-upload-buttons"><a class="thickbox button option-upload-button" id="' . $value['id'] . '" href="media-upload.php?&target=' . $value['id'] . '&option_image_upload=1&type=image&TB_iframe=1&width=640&height=644">'.$button.'</a></div><br />';
		echo '</td><td style="border:none">';
		echo '<div id="' . $value['id'] . '_preview">';
		if (! empty($value['default'])) {
			echo '<a class="thickbox" href="' . $value['default'] . '" target="_blank"><img src="' . $value['default'] . '" width="150" /></a>';
		}
		echo '</div>';
		echo '</td></tr></table>';
		echo '</td></tr>';
	}
	
	
	function uploadCSS($value) {
		$size = isset($value['size']) ? $value['size'] : '50';
		$button = isset($value['button']) ? $value['button'] : 'Insert Image';
		$values=$this->saved_options[$value[id]];
		if (isset($values[$value['property']])) {
			$value['default'] = stripslashes($values[$value['property']]);
			$value['color'] = stripslashes($values['background-color']);
		}
		echo '<tr valign="top"><td scope="row"><h3>' . $value['name'] . '</h3></td><td><table><tr valign="top"><td style="border:none">';
		
		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		echo '<input type="text" id="' . $value['id'] . '-bgi" name="' . $value['id'] . '['.$value[property].']" size="' . $size . '"  value="';
		echo $value['default'];
		echo '" /><br /><div class="option-upload-buttons"><a class="thickbox button option-upload-button" id="' . $value['id'] . '" href="media-upload.php?&target=' . $value['id'] . '-bgi&option_image_upload=1&type=image&TB_iframe=1&width=640&height=644">'.$button.'</a></div><br />';
		echo '<select name="bg_pattern" onChange="updadePattern(this.options[this.selectedIndex].value,\''.$value[id].'-bgi\')">';
		echo '<option value="">Select a pattern</option>';
		
		for ($k = 1;$k<=62;$k++){
			echo '<option value="'.THEME_URI.'/images/patterns/'.$k.'.png">Pattern-'.$k.'</option>';
		}
		echo '</select>';
		echo '</td><td style="border:none">';
		echo '<div id="' . $value['id'] . '_preview"'; 
		if(! empty($value['color'])){
			
			echo ' style="background-color:#'.$value['color'].'" ';
		}
		echo '>';
		if (! empty($value['default'])) {
			echo '<div style="width:150px;height:150px;background-image:url(' . $value['default'] . ');"></div>';
		}
		echo '</div>';
		echo '</td></tr></table>';
		echo '</td></tr>';
	}
	/**
	 * displays a range input
	 */
	function range($value) {
		echo '<tr valign="top"><td scope="row"><h3>' . $value['name'] . '</h3></td><td>';
		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		echo '<div class="range-input-wrap"><input name="' . $value['id'] . '" id="' . $value['id'] . '" type="range" value="';
		if (isset($this->saved_options[$value['id']])) {
			echo stripslashes($this->saved_options[$value['id']]);
		} else {
			echo $value['default'];
		}
		if (isset($value['min'])) {
			echo '" min="' . $value['min'];
		}
		if (isset($value['max'])) {
			echo '" max="' . $value['max'];
		}
		if (isset($value['step'])) {
			echo '" step="' . $value['step'];
		}
		echo '" />';
		if (isset($value['unit'])) {
			echo '<span>' . $value['unit'] . '</span>';
		}
		echo '</div></td></tr>';
	}
	
	/**
	 * displays a color input
	 */
	function color($value) {
		echo '<tr valign="top"><td scope="row"><h3>' . $value['name'] . '</h3></td><td>';
		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		$values=$this->saved_options[$value[id]];
		if (isset($values[$value['property']])) {
			$the_value = stripslashes($values[$value['property']]);
		}
		if (isset($the_value)) {
			$the_value = $the_value;
		} else {
			$the_value = $value['default'];
		}
		echo '<div class="cPicker" id="'.$value['id'].'-'.$value['property'].'-bgcolor">'; 
		echo '<div class="colorSelector" style="float:left;">';
		echo '<div style="background-color: #'.$the_value.';"></div></div>';
		echo '<input type="text" name="'.$value['id'].'['.$value['property'].']" value="'.$the_value.'" size="6" /></div>';
		echo '</td></tr>';
	}
	
	/**
	 * displays a toggle checkbox
	 */
	function toggle($value) {
		$checked = '';
		if (isset($this->saved_options[$value['id']])) {
			if ($this->saved_options[$value['id']] == true) {
				$checked = 'checked="checked"';
			}
		} elseif ($value['default'] == true) {
			$checked = 'checked="checked"';
		}
		
		echo '<tr valign="top"><td scope="row"><h3>' . $value['name'] . '</h3></td><td>';
		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		
		echo '<input type="checkbox" class="iPhonelike" name="' . $value['id'] . '" id="' . $value['id'] . '" value="true" ' . $checked . ' />';
		echo '</td></tr>';
	}
	

	
	
	
	/**
	 * displays a custom field
	 */
	function custom($value) {
		if (isset($this->saved_options[$value['id']])) {
			$default = $this->saved_options[$value['id']];
		} else {
			$default = $value['default'];
		}
		if(isset($value['layout']) && $value['layout']==false){
			if (isset($value['function']) && function_exists($value['function'])) {
				$value['function']($value, $default);
			} else {
				echo $value['html'];
			}
		}else{
			echo '<tr valign="top"><td scope="row"><h3>' . $value['name'] . '</h3></td><td>';
			if(isset($value['desc'])){
				echo '<p class="description">' . $value['desc'] . '</p>';
			}
			if (isset($value['function']) && function_exists($value['function'])) {
				$value['function']($value, $default);
			} else {
				echo $value['html'];
			}
			echo '</td></tr>';
		}
	}
	


}
