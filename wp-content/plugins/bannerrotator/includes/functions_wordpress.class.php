<?php
	class UniteFunctionsWPBanner {		
		
		//Get blog id
		public static function getBlogID() {
			global $blog_id;
			return($blog_id);
		}		
		
		//Check if multisite
		public static function isMultisite() {
			$isMultisite = is_multisite();
			return($isMultisite);
		}		
		
		//Check if some db table exists
		public static function isDBTableExists($tableName) {
			global $wpdb;			
			if(empty($tableName)) {
				UniteFunctionsBanner::throwError("Empty table name!!!");
			}
			$sql = "show tables like '$tableName'";			
			$table = $wpdb->get_var($sql);			
			if($table == $tableName) return(true);				
			return(false);
		}		
		
		//Get wordpress base path
		public static function getPathBase() {
			return ABSPATH;
		}
		
		//Get wp-content path
		public static function getPathContent() {		
			if(self::isMultisite()) {
				$pathContent = BLOGUPLOADDIR;
			} else {
				$pathContent = WP_CONTENT_DIR;
				if(!empty($pathContent)) {
					$pathContent .= "/";
				} else {
					$pathBase = self::getPathBase();
					$pathContent = $pathBase."wp-content/";
				}
			}			
			return($pathContent);
		}
		
		//Get content url
		public static function getUrlContent() {
		
			if(self::isMultisite() == false) {	
				//Without multisite
				$baseUrl = content_url()."/";
			} else {	
				//For multisite
				$arrUploadData = wp_upload_dir();
				$baseUrl = $arrUploadData["baseurl"]."/";
			}			
			return($baseUrl);			
		}
		
		//Register widget (must be class)
		public static function registerWidget($widgetName) {
			add_action('widgets_init', create_function('', 'return register_widget("'.$widgetName.'");'));
		}

		//Get image relative path from image url (from upload)
		public static function getImagePathFromURL($urlImage) {			
			$baseUrl = self::getUrlContent();
			$pathImage = str_replace($baseUrl, "", $urlImage);			
			return($pathImage);
		}
		
		//Get image real path phisical on disk from url
		public static function getImageRealPathFromUrl($urlImage) {
			$filepath = self::getImagePathFromURL($urlImage);
			$realPath = UniteFunctionsWPBanner::getPathContent().$filepath;
			return($realPath);
		}		
		
		//Get image url from image path
		public static function getImageUrlFromPath($pathImage) {
			//Protect from absolute url
			$pathLower = strtolower($pathImage);
			if(strpos($pathLower, "http://") !== false || strpos($pathLower, "www.") === 0) {
				return($pathImage);
			}
			$urlImage = self::getUrlContent().$pathImage;
			return($urlImage); 
		}
		
	}
?>