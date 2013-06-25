<?php 
/**
 * Wordpress theme framework by WonderFoundry and Graphix2Html
 * @package WonderWorks
 * @author Onur Demir (WonderFoundry) http://www.wonderfoundry.com
 * @version 1.0.0
 */
/*
 * White labeling include
 */
if(file_exists(TEMPLATEPATH.'/childtheme.php')){
	require_once(TEMPLATEPATH.'/childtheme.php');
} else  { 
// Define the theme name and shortname
/*
 * Never ever edit the below lines!!!!
 */
$theme = array(
	'theme_name' => 'Ultimatum',
	'theme_slug' => 'ultimatum',
	);
}
// Call the Framework 
require_once (dirname( __FILE__ ) .'/wonderfoundry/wonderworks.php');


?>