<?php 
/*
 * CSS3 Round Corner Boxes
 */
function shortcode_roundbox($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'borderwidth'=>'1',
		'borderstyle'=>'solid',
        'bordercolor'=>'333333',
		'backgroundcolor' => 'FFFFFF',
		'color'=> '000000',
		'icon'=>''
	), $atts));
if(strlen($icon)>=1){
		return '<div class="roundbox" style="background-color:#'.$backgroundcolor.';color:#'.$color.';border:'.$borderwidth.'px '.$borderstyle.' #'.$bordercolor.'"><div class="boxinner"><div style="width:32px;min-height:32px;background-image:url('.THEME_URI.'/images/icons/32/'.$icon.'.png); background-repeat:no-repeat;background-position:top left;float:left;"></div><div class="after-32-icon">' . do_shortcode(trim($content)) . '</div></div></div>';
	} else {
		return '<div class="roundbox" style="background-color:#'.$backgroundcolor.';color:#'.$color.';border:'.$borderwidth.'px '.$borderstyle.' #'.$bordercolor.'"><div class="boxinner">' . do_shortcode(trim($content)) . '</div></div>';
	}
}
add_shortcode('roundbox', 'shortcode_roundbox');

function shortcode_cornerbox($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'borderwidth'=>'1',
		'borderstyle'=>'solid',
        'bordercolor'=>'333333',
		'backgroundcolor' => 'FFFFFF',
		'color'=> '000000',
		'icon'=>''
	), $atts));
	if(strlen($icon)>=1){
		return '<div class="cornerbox" style="background-color:#'.$backgroundcolor.';color:#'.$color.';border:'.$borderwidth.'px '.$borderstyle.' #'.$bordercolor.'"><div class="boxinner"><div style="width:32px;min-height:32px;background-image:url('.THEME_URI.'/images/icons/32/'.$icon.'.png); background-repeat:no-repeat;background-position:top left;float:left;"></div><div class="after-32-icon">' . do_shortcode(trim($content)) . '</div></div></div>';
	} else {
		return '<div class="cornerbox" style="background-color:#'.$backgroundcolor.';color:#'.$color.';border:'.$borderwidth.'px '.$borderstyle.' #'.$bordercolor.'"><div class="boxinner">' . do_shortcode(trim($content)) . '</div></div>';
	}
}
add_shortcode('cornerbox', 'shortcode_cornerbox');

function shortcode_infobox($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'borderwidth'=>'1',
		'borderstyle'=>'solid',
        'bordercolor'=>'333333',
		'backgroundcolor' => 'FFFFFF',
		'color'=> '000000',
		'icon'=>''
	), $atts));
	if(strlen($icon)>=1){
		return '<div class="infobox" style="background-color:#'.$backgroundcolor.';color:#'.$color.';border-color:#'.$bordercolor.';border-style:'.$borderstyle.'"><div class="boxinner"><div style="width:32px;min-height:32px;background-image:url('.THEME_URI.'/images/icons/32/'.$icon.'.png); background-repeat:no-repeat;background-position:top left;float:left;"></div><div class="after-32-icon">' . do_shortcode(trim($content)) . '</div></div></div><div class="clearboth"></div>';
	} else {
		return '<div class="infobox" style="background-color:#'.$backgroundcolor.';color:#'.$color.';border-color:#'.$bordercolor.';border-style:'.$borderstyle.'"><div class="boxinner">' . do_shortcode(trim($content)) . '</div></div>';
	}
}
add_shortcode('infobox', 'shortcode_infobox');


function shortcode_button($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'buttonlink' => '',
		'buttonsize' => 'small',
		'color' => '000000',
		'hovercolor' => 'FFFFFF',
		'backgroundcolor' => 'FFFFFF',
		'hoverbgcolor' => '000000',
		'icon' => '',
		'rel' => '',
	), $atts));
	$url = get_bloginfo('url');
	if(eregi($url, $buttonlink) && !eregi('timthumb.php',$buttonlink) && !eregi('.jpg',$buttonlink) && !eregi('.jpeg',$buttonlink) && !eregi('.png',$buttonlink) && !eregi('.gif',$buttonlink) && !eregi('.swf',$buttonlink) && !eregi('.mov',$buttonlink) ){
		$buttonlink .='?inframe=yes&iframe=true'; 
	}
	if(strlen($icon)>=1){
		
		if($buttonsize=='small'){
			$iconclass= 'style="width:16px;min-height:16px;background-image:url('.THEME_URI.'/images/icons/16/'.$icon.'.png); background-repeat:no-repeat;background-position:top left;float:left;"';
		} elseif($buttonsize=='medium'){
			$iconclass= 'style="width:24px;min-height:24px;background-image:url('.THEME_URI.'/images/icons/24/'.$icon.'.png); background-repeat:no-repeat;background-position:top left;float:left;"';
		}else {
			$iconclass= 'style="width:32px;min-height:32px;background-image:url('.THEME_URI.'/images/icons/32/'.$icon.'.png); background-repeat:no-repeat;background-position:top left;float:left;"';
		}
		$content = '<a href="'.$buttonlink.'" class="button '.$buttonsize.' '.$rel.'" style="background-color:#'.$backgroundcolor.';" rel="'.$rel.'"><span class="bspan" style="color:#'.$color.'"><span class="icon" '.$iconclass.'></span><span class="buttontext">' . trim($content) . '</span><span class="buttonhover" style="background-color:#'.$hoverbgcolor.';color:#'.$hovercolor.'"></span><span class="buttonnorm" style="background-color:#'.$backgroundcolor.';color:#'.$color.'"></span></span></a>';
	} else {
		$content = '<a href="'.$buttonlink.'" class="button '.$buttonsize.' '.$rel.'" style="background-color:#'.$backgroundcolor.';" rel="'.$rel.'"><span class="bspan" style="color:#'.$color.'"><span class="buttontext-noicon">' . trim($content) . '</span><span class="buttonhover" style="background-color:#'.$hoverbgcolor.';color:#'.$hovercolor.'"></span><span class="buttonnorm" style="background-color:#'.$backgroundcolor.';color:#'.$color.'"></span></span></a>';
	}
		return $content;
	
}
add_shortcode('button','shortcode_button');

function shortcode_icontext( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'icon'      => '',
    	'size'		=> '',
    	'tag'		=> 'p',
    	'link'		=> '',
    	'rel'		=> '',
    	
    ), $atts));
    if($size=='small'){
    	$px = 16;
    	if($tag!='p' || $tag !='span'){
    		$fpx=16;
    	}
    } elseif ($size=='medium'){
    	$px= 24;
    	if($tag!='p' && $tag !='span'){
    		$fpx=24;
    	}
    } elseif ($size=='huge'){
    	$px= 48;
    	if($tag!='p' && $tag !='span'){
    		$fpx=48;
    	}
    } else {
    	$px= 32;
    	if($tag!='p' && $tag !='span'){
    		$fpx=32;
    	}
    }
    $iconclass= 'background-image:url('.THEME_URI.'/images/icons/'.$px.'/'.$icon.'.png); background-repeat:no-repeat;background-position:top left;';
    if($tag!='p') {
    $output= '<'.$tag;
    
    $output.= ' style="padding-left:'.($px+2).'px;'.$iconclass;
    if($fpx){
    $output.= 'line-height:'.$fpx.'px;font-size:'.$fpx.'px;';
    }
    $output.='">';
    } else {
    	$output = '<p><span style="'.$iconclass.'width:'.$px.'px;height:'.$px.'px;float:left;margin-right:2px;"></span>';
    }
    if($link){
    	$output.='<a class="'.$rel.'" href="'.$link.'" style="';
	    if($fpx){
	    $output.= 'line-height:'.$fpx.'px;font-size:'.$fpx.'px;';
	    }
	    $output.='">';
    }
    $output.=trim($content);
	if($link){
    	$output.='</a>';
    }
    $output.='</'.$tag.'>';
    return $output;
    
}
add_shortcode('icontext', 'shortcode_icontext');

function listitem_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'icon'      => '',
    ), $atts));
    global $list_array;
    $list_array[] = array('icon' => $icon, 'content' => trim(do_shortcode($content)));
    return $list_array;
}
add_shortcode('listitem', 'listitem_func');

function shortcode_list($atts, $content = null ) {
    global $list_array;
    $list_array = array(); // clear the array
	$list = '';
    $list .= '<ul class="iconizedlist">';
    do_shortcode($content); 
    foreach ($list_array as $li => $li_attr_array) {
    	 $iconclass= 'background-image:url('.THEME_URI.'/images/icons/24/'.$li_attr_array['icon'].'.png); background-repeat:no-repeat;background-position:top left;float:left;width:24px;height:24px;';
		$list .= '<li class="icon-list"><span class="list-span" style="'.$iconclass.'"></span>'.$li_attr_array['content'].'</li>';
	}
    $list .= '</ul>';
    return $list;
}
add_shortcode('list','shortcode_list');


function shortcode_dropcaps($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'color' => '',
		'bcolor' => '',
		'type' => '',
	), $atts));
	if($type!='normal'){
		$typ = $type;
	}
	if($color){
		$color = 'color:#'.$color.';';
	}
	if($bcolor){
		$bcolor = 'background-color:#'.$bcolor.';';
	}
	return '<span class="dropcap '.$typ.'" style="'.$color.$bcolor.'" >' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap', 'shortcode_dropcaps');


function shortcode_blockquote($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'align' => false,
		'cite' => false,
		'color' => '',
		'bcolor' => '',
	), $atts));
	if($color){
		$color = 'color:#'.$color.';';
	}
	if($bcolor){
		$bcolor = 'background-color:#'.$bcolor.';';
	}
	return '<blockquote' . ($align ? ' class="align' . $align . '"' : ' class="full"') . ' style="'.$color.$bcolor.'">' . do_shortcode($content) . ($cite ? '<span><cite>- ' . $cite . '</cite></span>' : '') . '</blockquote>';
}
add_shortcode('blockquote', 'shortcode_blockquote');

function shortcode_code($atts, $content = null, $code) {
	extract(shortcode_atts(array(
			'lang' => 'html',
	), $atts));
	
	return '<pre' . ' class="prettyprint lang-'.$lang.' linenums">'.($content) .'</pre>';
}
add_shortcode('code', 'shortcode_code');

?>