<?php
wp_enqueue_script('jquery-easing',THEME_JS.'/jquery.easing.min.js');
wp_enqueue_script('jquery-anything',THEME_JS.'/jquery.anythingslider.min.js');
wp_enqueue_script('jquery-anyvid',THEME_JS.'/jquery.anythingslider.video.min.js');
wp_enqueue_script('jquery-anyfx',THEME_JS.'/jquery.anythingslider.fx.min.js');
if($instance[AnyColor]!='grey'){
	$AnyColor = 'Any'.$instance[AnyColor];
}
?>
<div class="anythingSlider <?php echo $AnyColor; ?>">
<ul class="anything" id="<?php echo $this->id.'-anything'; ?>" style="width:<?php echo $instance[Width]?>px;height:<?php echo $instance[Height]?>px;list-style: none;background-color:<?php echo $instance[AnyBg];?>">
<?php
foreach($images as $image){

echo '<li><div class="textSlide">';
if($instance[AnyType]=='full'){
	if($uslider){
		$img_src['url'] = THEME_SLIDESHOW.'/'.$instance['slide'].'/'.$image['image'];
		$img_src['fpath'] = THEME_SLIDESHOW_DIR.'/'.$instance['slide'].'/'.$image['image'];
		$imgsrc = UltimatumImageResizer( null, $img_src,$instance["Width"], $instance["Height"], true );
	} else {
		$imgsrc = UltimatumImageResizer( $image['image_id'], null,$instance["Width"], $instance["Height"], true );
	}
if($instance[AnyVideo]=='true' && strlen($image[video])>=3){
$sc ='[video width="'.$instance[Width].'" height="'.$instance[Height].'"]'.$image[video].'[/video]';
echo do_shortcode($sc);
} else {?>
<?php if($image[link]) {?>
<a href="<?php echo $image[link]; ?>"><img src="<?php echo $imgsrc; ?>" style="float:right" alt="<?php echo $image[title]; ?>" /></a>
<?php } else {?>
<img src="<?php echo $imgsrc; ?>" style="float:right" alt="<?php echo $image[title]; ?>" />
<?php }
if($instance[AnyCaption]!='false'){
echo '<div class="anyCaption" style="width:'.$instance[Width].'px"><h3 class="slidertitle">'.$image[title].'</h3><p class="slidertext">'.($image[text]).'</p></div>';
}
}
} else {
	if($uslider){
		$img_src['url'] = THEME_SLIDESHOW.'/'.$instance['slide'].'/'.$image['image'];
		$img_src['fpath'] = THEME_SLIDESHOW_DIR.'/'.$instance['slide'].'/'.$image['image'];
		$imgsrc = UltimatumImageResizer( null, $img_src,$instance["AnyWidth"], $instance["AnyHeight"], true );
	} else {
		$imgsrc = UltimatumImageResizer( $image['image_id'], null,$instance["AnyWidth"], $instance["AnyHeight"], true );
	}
echo '<div style="float:right;margin-left:10px;">';
if($instance[AnyVideo]=='true' && strlen($image[video])>=3){
$sc ='[video width="'.$instance[AnyWidth].'" height="'.$instance[AnyHeight].'"]'.$image[video].'[/video]';
echo do_shortcode($sc);
} else {?>
<?php if($image[link]) {?>
<a href="<?php echo $image[link]; ?>"><img src="<?php echo $imgsrc; ?>" style="float:right" alt="<?php echo $image[title]; ?>" /></a>
<?php } else {?>
<img src="<?php echo $imgsrc; ?>" style="float:right" alt="<?php echo $image[title]; ?>" />
<?php }

}
echo '</div><div style="padding:10px;"><h3 class="slidertitle">'.$image[title].'</h2>';
echo '<p class="slidertext">'.do_shortcode($image[text]).'</p>';
if($image[link]) {
echo '<a href="'.$image[link].'" class="anyLink" style="float:right"><span>'.__('Read More',THEME_LANG_DOMAIN).'</span> →</a>';
}
echo '</div>';
}
echo '</div></li>';
}?>
</ul></div>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function(){
jQuery('#<?php echo $this->id.'-anything'; ?>')
.anythingSlider({
hashTags            : false,
buildArrows         : <?php echo $instance["AnyArrows"]; ?>,
buildNavigation     : <?php echo $instance["AnyNavi"]; ?>,
navigationFormatter : null,
forwardText         : "&raquo;",
backText            : "&laquo;",
addWmodeToObject    : 'transparent',
autoPlay            : <?php echo $instance["AnyAuto"]; ?>,
startStopped        : false,
pauseOnHover        : <?php echo $instance["AnyHover"]; ?>,
resumeOnVideoEnd    : true,
stopAtEnd           : false,
playRtl             : false,
startText           : "Start",
stopText            : "Stop",
delay               : <?php echo $instance["Anydelay"]; ?>,
animationTime       : <?php echo $instance["AnyanimationTime"]; ?>,
easing              : "easeInOut<?php echo $instance["AnyEasing"]; ?>"
})
});
//]]>
</script>