<?php
global $pagenow;
if(is_admin() && isset($_GET['activated']) && $pagenow == "themes.php" ) {
	header( 'Location: '.admin_url().'admin.php?page='.THEME_SLUG ) ;
}

