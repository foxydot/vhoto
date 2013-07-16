<?php
header('Content-Type: text/css');
include('../../../../wp-load.php');
$theme=$_REQUEST['thm'];
global $wpdb;
$table = $wpdb->prefix.'ultimatum_themes';
$sql = "SELECT * FROM $table WHERE id='$theme'";
$row =$wpdb->get_row($sql,ARRAY_A);
if(isset($row['width'])){
	$width		= 	$row['width'];
	$rawmargin	=	$row['margin'];
	$margin		= 	$row['margin']/2;
} else {
	$width		= 	960;
	$rawmargin	=	30;
	$margin		= 	15;
}
$grid_12	= 	$width-($margin*2);
$grid_3		= 	($width-($rawmargin*4))/4;
$grid_4 	= 	($width-($rawmargin*3))/3;
$grid_6 	= 	($width-($rawmargin*2))/2;
$grid_8 	= 	$grid_12-($grid_4+$rawmargin);
$grid_9 	= 	$grid_12-($grid_3+$rawmargin);
ob_start();
?>
/* Table of Contents
==================================================
    #Base Grid
    #Tablet (Portrait)
    #Mobile (Portrait)
    #Mobile (Landscape)
    #Clearing */



/* #Base Grid
================================================== */
div.wrapper{width:100%;margin-left:0px;margin-right:0px;float:left;}
.one_fourth {display: inline;float: left; margin-right: 4%;overflow: hidden;position: relative;width: 22%;}
.one_third {display: inline;float: left; margin-right: 4%;overflow: hidden;position: relative;width: 30%;}
.one_half { display: inline;float: left;margin-right: 4%;overflow: hidden;position: relative;width: 48%;}
.two_third {display: inline;float: left; margin-right: 4%;overflow: hidden;position: relative;width: 66%;}
.three_fourth {display: inline;float: left; margin-right: 4%;overflow: hidden;position: relative;width: 74%;}
.last {margin-right: 0 !important;clear: right;}
.container_12{margin-left:auto;margin-right:auto;width:<?php echo $width; ?>px}
.grid_1,.grid_2,.grid_3,.grid_4,.grid_5,.grid_6,.grid_7,.grid_8,.grid_9,.grid_10,.grid_11,.grid_12{display:inline;float:left;margin-left:<?php echo $margin; ?>px;margin-right:<?php echo $margin; ?>px}
.alpha{margin-left:0}.omega{margin-right:0}
.container_12 .grid_3{width:<?php echo $grid_3; ?>px}
.container_12 .grid_4{width:<?php echo $grid_4; ?>px}
.container_12 .grid_6{width:<?php echo $grid_6; ?>px}
.container_12 .grid_8{width:<?php echo $grid_8; ?>px}
.container_12 .grid_9{width:<?php echo $grid_9; ?>px}
.container_12 .grid_12{width:<?php echo $grid_12; ?>px}
.clear{clear:both;display:block;overflow:hidden;visibility:hidden;width:0;height:0}
.clearfix:before,.clearfix:after,.container_12:before,.container_12:after{content:'.';display:block;overflow:hidden;visibility:hidden;font-size:0;line-height:0;width:0;height:0}
.clearfix:after,.container_12:after{clear:both}
.clearfix,.container_12{zoom:1}
.regular-nav {display:block}
.ultimatum-responsive-menu{display:none;}
.hidden-desktop { display: none !important;}
<?php if($width>='960' && $row['type']==1){?>
/* #Tablet (Portrait)
================================================== */
@media only screen and (min-width: 768px) and (max-width: 959px) {
	.hidden-desktop {display: inherit !important;}
	.hidden-tablet {display: none !important;}
	.container_12{margin-left:auto;margin-right:auto;width:720px}
	.grid_1,
	.grid_2,
	.grid_3,
	.grid_4,
	.grid_5,
	.grid_6,
	.grid_7,
	.grid_8,
	.grid_9,
	.grid_10,
	.grid_11,
	.grid_12{display:inline;float:left;margin-left:10px;margin-right:10px}
	.container_12 .grid_1{width:40px}
	.container_12 .grid_2{width:100px}
	.container_12 .grid_3{width:160px}
	.container_12 .grid_4{width:220px}
	.container_12 .grid_5{width:280px}
	.container_12 .grid_6{width:340px}
	.container_12 .grid_7{width:400px}
	.container_12 .grid_8{width:460px}
	.container_12 .grid_9{width:520px}
	.container_12 .grid_10{width:580px}
	.container_12 .grid_11{width:640px}
	.container_12 .grid_12{width:700px}
	.ultimatepost{float:left;width:100%;}
	img {max-width: 100%;height: auto;}
}
/*  #Mobile (Portrait)
================================================== */
@media only screen and (max-width: 767px) {
	.one_fourth, .one_third, .one_half, .two_third, .three_fourth {display: inline;float: left; margin-right: 0;overflow: hidden;position: relative;width: 100%;}
	.hidden-desktop {display: inherit !important; }
  	.hidden-phone {display: none !important; }
  	.regular-nav {display:none}
	.ultimatum-responsive-menu{display:block;}
	.container_12{width:300px;margin:0 auto;padding:0}
	.container_12 .grid_1,
	.container_12 .grid_2,
	.container_12 .grid_3,
	.container_12 .grid_4,
	.container_12 .grid_5,
	.container_12 .grid_6,
	.container_12 .grid_7,
	.container_12 .grid_8,
	.container_12 .grid_9,
	.container_12 .grid_10,
	.container_12 .grid_11,
	.container_12 .grid_12 {width:300px;margin:0;}
	.alpha, .omega { margin-left: 0; margin-right: 0;}
	.align_center,.align_right { text-align: left;}
	.regular-nav {display:none}
	.ultimatum-responsive-menu{display:block;}
	img {max-width: 100%;height: auto;}
}
/* #Mobile (Landscape)
================================================== */
@media only screen and (min-width: 480px) and (max-width: 767px) {
	.container_12{width:420px;margin:0 auto;padding:0}
	.container_12 .grid_1,
	.container_12 .grid_2,
	.container_12 .grid_3,
	.container_12 .grid_4,
	.container_12 .grid_5,
	.container_12 .grid_6,
	.container_12 .grid_7,
	.container_12 .grid_8,
	.container_12 .grid_9,
	.container_12 .grid_10,
	.container_12 .grid_11,
	.container_12 .grid_12 {width:420px;margin:0}
	.alpha, .omega { margin-left: 0; margin-right: 0;}
	.align_center,.align_right { text-align: left;}
	img {max-width: 100%;height: auto;}
}
<?php } ?>

<?php 
$content = ob_get_contents();  // save the contents of the file into $file
ob_end_clean();  // turn output buffering back off
$filename = THEME_CACHE_DIR.'/grid_'.$theme.'.css';
$fhandle = @fopen($filename, 'w+');
if ($fhandle) fwrite($fhandle, $content, strlen($content));
echo $content;


?>