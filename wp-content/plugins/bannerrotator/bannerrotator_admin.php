<?php
	class BannerRotatorAdmin extends UniteBaseAdminClassBanner {
		
		const DEFAULT_VIEW = "sliders";		
		const VIEW_SLIDER = "slider";
		const VIEW_SLIDERS = "sliders";		
		const VIEW_SLIDES = "slides";
		const VIEW_SLIDE = "slide";
		
		//Constructor
		public function __construct($mainFilepath) {			
			parent::__construct($mainFilepath,$this,self::DEFAULT_VIEW);
			
			//Set table names
			GlobalsBannerRotator::$table_sliders = self::$table_prefix.GlobalsBannerRotator::TABLE_SLIDERS_NAME;
			GlobalsBannerRotator::$table_slides = self::$table_prefix.GlobalsBannerRotator::TABLE_SLIDES_NAME;
			
			//Set captions file path
			GlobalsBannerRotator::$filepath_captions = self::$path_plugin."css/caption.css";
			GlobalsBannerRotator::$filepath_captions_original = self::$path_plugin."css/caption-original.css";
			GlobalsBannerRotator::$urlCaptionsCSS = self::$url_plugin."css/caption.css";
			
			$this->init();
		}		
		
		//Init all actions
		private function init() {			
			$this->checkCopyCaptionsCSS();			
			self::addMenuPage('Banner Rotator', "adminPages", self::$url_plugin."images/icon.png");
			
			//Ajax response to save slider options
			self::addActionAjax("ajax_action", "onAjaxAction");
		}
		
		
		//Process activate event - install the db (with delta)
		public static function onActivate() {			
			self::createTable(GlobalsBannerRotator::TABLE_SLIDERS_NAME);
			self::createTable(GlobalsBannerRotator::TABLE_SLIDES_NAME);
		}
		
		//If caption file don't exists - copy it from the original file
		public static function checkCopyCaptionsCSS() {
			if(file_exists(GlobalsBannerRotator::$filepath_captions) == false) {
				copy(GlobalsBannerRotator::$filepath_captions_original,GlobalsBannerRotator::$filepath_captions);
			}
			if(!file_exists(GlobalsBannerRotator::$filepath_captions) == true) {
				self::setStartupError("Can't copy <b>caption-original.css </b> to <b>caption.css</b> in <b> plugins/bannerrotator/css </b> folder. Please try to copy the file by hand or turn to support.");
			}			
		}		
		
		//Add all page scripts and styles
		public static function onAddScripts() {
			self::addStyle("edit_layers","edit_layers");
			
			self::addScriptCommon("edit_layers","unite_layers");
			self::addScript("banner_admin");
			
			//Include all media upload scripts
			self::addMediaUploadIncludes();
			
			//Add banner rotator css
			self::addStyle("banner-rotator","banner-rotator","css");
			self::addStyle("caption","banner-rotator-caption","css");
		}		
		
		//Admin main page function
		public static function adminPages() {			
			parent::adminPages();
			
			//Require styles by view
			switch(self::$view){
				case self::VIEW_SLIDERS:
				case self::VIEW_SLIDER:
					self::requireSettings("slider_settings");
				break;
				case self::VIEW_SLIDES:					
				break;
				case self::VIEW_SLIDE:
				break;
			}
			
			self::setMasterView("master_view");
			self::requireView(self::$view);
		}		
		
		//Create tables
		public static function createTable($tableName) {			
			//If table exists - don't create it
			$tableRealName = self::$table_prefix.$tableName;
			if(UniteFunctionsWPBanner::isDBTableExists($tableRealName))
				return(false);
			
			switch($tableName){
				case GlobalsBannerRotator::TABLE_SLIDERS_NAME:					
				$sql = "CREATE TABLE " .self::$table_prefix.$tableName ." (
						  id int(9) NOT NULL AUTO_INCREMENT,
						  title tinytext NOT NULL,
						  alias tinytext,
						  params text NOT NULL,
						  PRIMARY KEY (id)
						);";
				break;
				case GlobalsBannerRotator::TABLE_SLIDES_NAME:
					$sql = "CREATE TABLE " .self::$table_prefix.$tableName ." (
							  id int(9) NOT NULL AUTO_INCREMENT,
							  slider_id int(9) NOT NULL,
							  slide_order int not NULL,		  
							  params text NOT NULL,
							  layers text NOT NULL,
							  PRIMARY KEY (id)
							);";
				break;
				default:
					UniteFunctionsBanner::throwError("table: $tableName not found");
				break;
			}
			
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
		
		//Import slider handle (not ajax response)
		private static function importSliderHandle() {			
			dmp("Importing slider settings and data...");
			
			$slider = new BannerRotator();
			$response = $slider->importSliderFromPost();
			$sliderID = $response["sliderID"];
			
			$viewBack = self::getViewUrl(self::VIEW_SLIDER,"id=".$sliderID);
			if(empty($sliderID))
				$viewBack = self::getViewUrl(self::VIEW_SLIDERS);
			
			//handle error
			if($response["success"] == false){
				$message = $response["error"];
				dmp("<b>Error: ".$message."</b>");
				echo UniteFunctionsBanner::getHtmlLink($viewBack, "Go Back");
			}
			else{	//handle success, js redirect.
				dmp("Slider Import Success, redirecting...");
				echo "<script>location.href='$viewBack'</script>"; 
			}
			exit();
		}		
		
		//OnAjax action handler
		public static function onAjaxAction() {			
			$slider = new BannerRotator();
			$slide = new BannerSlide();
			$operations = new BannerOperations();
			
			$action = self::getPostGetVar("client_action");
			$data = self::getPostGetVar("data");
			
			try {				
				switch($action){
					case "export_slider":
						$sliderID = self::getGetVar("sliderid");
						$slider->initByID($sliderID);
						$slider->exportSlider();
						break;
					case "import_slider":
						self::importSliderHandle();
						break;
					case "create_slider":
						$newSliderID = $slider->createSliderFromOptions($data);						
						self::ajaxResponseSuccessRedirect(
						            "The slider successfully created", 
									self::getViewUrl("sliders"));						
						break;
					case "update_slider":
						$slider->updateSliderFromOptions($data);
						self::ajaxResponseSuccess("Slider updated");
						break;					
					case "delete_slider":						
						$slider->deleteSliderFromData($data);						
						self::ajaxResponseSuccessRedirect(
						            "The slider deleted", 
									self::getViewUrl(self::VIEW_SLIDERS));
						break;
					case "duplicate_slider":						
						$slider->duplicateSliderFromData($data);						
						self::ajaxResponseSuccessRedirect(
						            "The duplicate successfully, refreshing page...", 
									self::getViewUrl(self::VIEW_SLIDERS));
						break;					
					case "add_slide":
						$slider->createSlideFromData($data);
						$sliderID = $data["sliderid"];						
						self::ajaxResponseSuccessRedirect(
						            "Slide Created", 
									self::getViewUrl(self::VIEW_SLIDES,"id=$sliderID"));
						break;
					case "update_slide":
						$slide->updateSlideFromData($data);
						self::ajaxResponseSuccess("Slide updated");
						break;
					case "delete_slide":
						$slide->deleteSlideFromData($data);
						$sliderID = UniteFunctionsBanner::getVal($data, "sliderID");
						self::ajaxResponseSuccessRedirect(
						            "Slide Deleted Successfully", 
									self::getViewUrl(self::VIEW_SLIDES,"id=$sliderID"));					
						break;
					case "duplicate_slide":
						$sliderID = $slider->duplicateSlideFromData($data);
						self::ajaxResponseSuccessRedirect(
						            "Slide Duplicated Successfully", 
									self::getViewUrl(self::VIEW_SLIDES,"id=$sliderID"));
						break;
					case "get_captions_css":
						$contentCSS = $operations->getCaptionsContent();
						self::ajaxResponseData($contentCSS);
						break;
					case "update_captions_css":
						$arrCaptions = $operations->updateCaptionsContentData($data);
						self::ajaxResponseSuccess("CSS file saved succesfully!",array("arrCaptions"=>$arrCaptions));
						break;
					case "restore_captions_css":
						$operations->restoreCaptionsCss();
						$contentCSS = $operations->getCaptionsContent();
						self::ajaxResponseData($contentCSS);
						break;
					case "update_slides_order":
						$slider->updateSlidesOrderFromData($data);
						self::ajaxResponseSuccess("Order updated successfully");
						break;
					case "change_slide_image":
						$slide->updateSlideImageFromData($data);
						$sliderID = UniteFunctionsBanner::getVal($data, "slider_id");						
						self::ajaxResponseSuccessRedirect(
						            "Slide Changed Successfully", 
									self::getViewUrl(self::VIEW_SLIDES,"id=$sliderID"));
						break;	
					case "preview_slide":
						$operations->putSlidePreviewByData($data);
						break;
					case "preview_slider":
						$sliderID = UniteFunctionsBanner::getPostVariable("sliderid");
						$operations->previewOutput($sliderID);
						break;
					default:
						self::ajaxResponseError("wrong ajax action: $action ");
						break;
				}				
			} catch(Exception $e) {
				$message = $e->getMessage();				
				self::ajaxResponseError($message);
			}
			
			self::ajaxResponseError("No response output on <b> $action </b> action. please check with the developer.");
			exit();
		}
		
	}	
?>