<?php
wp_enqueue_script('jquery-flex',THEME_JS.'/jquery.flexslider-min.js');
?>
<div class="flex-container">
<div class="flexslider" id="<?php echo $this->id.'-flex'; ?>" >
<ul class="slides">

<?php
foreach($images as $image){
if($uslider){$image["image"] = THEME_SLIDESHOW.'/'.$instance["slide"].'/'.$image["image"];}
$imgsrc = ($image["image"]); ?>
<li>
<?php if(isset($image["link"])){?>
<a href="<?php echo $image["link"]; ?>"><img src="<?php echo $imgsrc; ?>" style="float:right" alt="<?php echo $image["title"]; ?>" title="<?php echo $image["title"]; ?>" /></a>
<?php } else { ?>
<img src="<?php echo $imgsrc; ?>" style="float:right" alt="<?php echo $image["title"]; ?>" title="<?php echo $image["title"]; ?>" />
<?php  } ?>
<p class="slidertext"><?php echo do_shortcode($image["text"]); ?></p>

</li>
<?php }	?>
</ul>
</div>
</div>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function() {
jQuery('#<?php echo $this->id.'-flex'; ?>').flexslider({
animation: "<?php echo $instance['flexanimation']; ?>",
slideDirection: "<?php echo $instance['flexslideDirection']; ?>",
slideshow: <?php echo $instance['flexslideshow']; ?>,
slideshowSpeed: <?php echo $instance['flexslideshowSpeed']; ?>,
animationDuration: <?php echo $instance['flexanimationDuration']; ?>,
directionNav: <?php echo $instance['flexdirectionNav']; ?>,
controlNav: <?php echo $instance['flexcontrolNav']; ?>,
keyboardNav: <?php echo $instance['flexkeyboardNav']; ?>,
mousewheel: <?php echo $instance['flexmousewheel']; ?>,
randomize: <?php echo $instance['flexrandomize']; ?>,
animationLoop: <?php echo $instance['flexanimationLoop']; ?>,
pauseOnAction: <?php echo $instance['flexpauseOnAction']; ?>,
pauseOnHover: <?php echo $instance['flexpauseOnHover']; ?>

});
});
//]]>
</script>