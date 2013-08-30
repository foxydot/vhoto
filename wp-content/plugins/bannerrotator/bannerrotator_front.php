<?php
	class BannerRotatorFront extends UniteBaseFrontClassBanner {
		
		//Constructor
		public function __construct($mainFilepath) {			
			parent::__construct($mainFilepath,$this);
			
			//Set table names
			GlobalsBannerRotator::$table_sliders = self::$table_prefix.GlobalsBannerRotator::TABLE_SLIDERS_NAME;
			GlobalsBannerRotator::$table_slides = self::$table_prefix.GlobalsBannerRotator::TABLE_SLIDES_NAME;
		}		
		
		//Add scripts and styles
		public static function onAddScripts() {
			//Banner Rotator CSS settings
			self::addStyle("banner-rotator","banner-rotator","css");
			self::addStyle("caption","banner-rotator-caption","css");
			
			//jQuery
			$url_jquery = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js";
			self::addScriptAbsoluteUrl($url_jquery, "jquery");
			
			//Banner Rotator JS
			self::addScript("jquery.flashblue-plugins","js","flashblue.plugins");
			self::addScript("jquery.banner-rotator","js");
		}
		
	}
?>