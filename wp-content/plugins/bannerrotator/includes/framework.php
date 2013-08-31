<?php
	$folderIncludes = dirname(__FILE__)."/";
	
	if(!function_exists("dmp"))
		require_once $folderIncludes.'functions.php';
	
	if(!class_exists("UniteFunctionsBanner"))
		require_once $folderIncludes.'functions.class.php';
		
	if(!class_exists("UniteFunctionsWPBanner"))
		require_once $folderIncludes.'functions_wordpress.class.php';
	
	if(!class_exists("UniteDBBanner"))
		require_once $folderIncludes.'db.class.php';
	
	if(!class_exists("UniteSettingsBanner"))
		require_once $folderIncludes.'settings.class.php';
	
	if(!class_exists("UniteCssParserBanner"))
		require_once $folderIncludes.'cssparser.class.php';
		
	if(!class_exists("UniteSettingsAdvancedBanner"))
		require_once $folderIncludes.'settings_advances.class.php';
	
	if(!class_exists("UniteSettingsOutputBanner"))
		require_once $folderIncludes.'settings_output.class.php';
		
		
	if(!class_exists("UniteSettingsBannerProductBanner"))
		require_once $folderIncludes.'settings_product.class.php';
	
	if(!class_exists("UniteSettingsProductSidebarBanner"))
		require_once $folderIncludes.'settings_product_sidebar.class.php';
	
	if(!class_exists("UniteImageViewBanner"))
		require_once $folderIncludes.'image_view.class.php';	
?>