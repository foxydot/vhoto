<?php
	class BannerRotator extends UniteElementsBaseBanner {
		
		const VALIDATE_NUMERIC = "numeric";
		const VALIDATE_EMPTY = "empty";		
		private $id;
		private $title;
		private $alias;
		private $arrParams;
		private $arrSlides = null;
		
		public function __construct() {
			parent::__construct();
		}
		
		//Validate that the slider is inited. if not - throw error
		private function validateInited() {
			if(empty($this->id))
				UniteFunctionsBanner::throwError("The slider is not inited!");
		}
		
		//Init slider by db data
		public function initByDBData($arrData) {			
			$this->id = $arrData["id"];
			$this->title = $arrData["title"];
			$this->alias = $arrData["alias"];			
			$params = $arrData["params"];
			$params = (array)json_decode($params);			
			$this->arrParams = $params;
		}		
		
		//Init the slider object by database id
		public function initByID($sliderID) {
			UniteFunctionsBanner::validateNumeric($sliderID,"Slider ID");
			$sliderID = $this->db->escape($sliderID);			
			try {
				$sliderData = $this->db->fetchSingle(GlobalsBannerRotator::$table_sliders,"id=$sliderID");								
			} catch(Exception $e) {
				UniteFunctionsBanner::throwError("Slider with ID: $sliderID Not Found");
			}			
			$this->initByDBData($sliderData);
		}

		//Init slider by alias
		public function initByAlias($alias) {
			$alias = $this->db->escape($alias);
			try {
				$where = "alias='$alias'";				
				$sliderData = $this->db->fetchSingle(GlobalsBannerRotator::$table_sliders,$where);				
			} catch(Exception $e) {
				$arrAliases = $this->getAllSliderAliases();
				$strAliases = "";
				if(!empty($arrAliases)) {
					$strAliases = "'".implode("' or '", $arrAliases)."'";
				}
				$errorMessage = "Slider with alias <strong>$alias</strong> not found.";
				if(!empty($strAliases)) {
					$errorMessage .= " <br><br>Maybe you mean: ".$strAliases;
				}
				UniteFunctionsBanner::throwError($errorMessage);
			}			
			$this->initByDBData($sliderData);
		}		
		
		//Init by id or alias
		public function initByMixed($mixed) {
			if(is_numeric($mixed)) {
				$this->initByID($mixed);
			} else {
				$this->initByAlias($mixed);
			}
		}		
		
		//Get data functions
		public function getTitle() {
			return($this->title);
		}
		
		public function getID() {
			return($this->id);
		}
		
		public function getParams() {
			return($this->arrParams);
		}
		
		//Set slider params
		public function setParams($arrParams) {
			$this->arrParams = $arrParams;
		}
		
		//Get parameter from params array. if no default, then the param is a must!
		function getParam($name,$default=null,$validateType = null,$title="") {			
			if($default === null) {
				if(!array_key_exists($name, $this->arrParams)) {
					UniteFunctionsBanner::throwError("The param <b>$name</b> not found in slider params.");
				}
				$default = "";
			}			
			$value = UniteFunctionsBanner::getVal($this->arrParams, $name,$default);
						
			//Validation
			switch($validateType){
				case self::VALIDATE_NUMERIC:
				case self::VALIDATE_EMPTY:
					$paramTitle = !empty($title)?$title:$name;
					if($value !== "0" && $value !== 0 && empty($value)) {
						UniteFunctionsBanner::throwError("The param <strong>$paramTitle</strong> should not be empty.");
					}
					break;
				case self::VALIDATE_NUMERIC:
					$paramTitle = !empty($title)?$title:$name;
					if(is_numeric($value)) {
						UniteFunctionsBanner::throwError("The param <strong>$paramTitle</strong> should be numeric. Now it's: $value");
					}
					break;
			}			
			return $value;
		}
		
		public function getAlias() {
			return($this->alias);
		}
		
		//Get combination of title (alias)
		public function getShowTitle() {
			$showTitle = $this->title." ($this->alias)";
			return($showTitle);
		}
		
		//Get slider shortcode
		public function getShortcode() {
			$shortCode = "[banner_rotator {$this->alias}]";
			return($shortCode);
		}		
		
		//Check if alias exists in DB
		private function isAliasExistsInDB($alias) {
			$alias = $this->db->escape($alias);			
			$where = "alias='$alias'";
			if(!empty($this->id)) $where .= " and id != '{$this->id}'";				
			$response = $this->db->fetch(GlobalsBannerRotator::$table_sliders,$where);
			return(!empty($response));			
		}
		
		//Validate settings for add
		private function validateInputSettings($title,$alias,$params) {
			UniteFunctionsBanner::validateNotEmpty($title,"title");
			UniteFunctionsBanner::validateNotEmpty($alias,"alias");			
			if($this->isAliasExistsInDB($alias)) {
				UniteFunctionsBanner::throwError("Some other slider with alias '$alias' already exists");
			}
		}		
		
		//Create / update slider from options
		private function createUpdateSliderFromOptions($options,$sliderID = null) {			
			$arrMain = UniteFunctionsBanner::getVal($options, "main");
			$params = UniteFunctionsBanner::getVal($options, "params");
			
			//Trim all input data
			$arrMain = UniteFunctionsBanner::trimArrayItems($arrMain);
			$params = UniteFunctionsBanner::trimArrayItems($params);			
			$params = array_merge($arrMain,$params);			
			$title = UniteFunctionsBanner::getVal($arrMain, "title");
			$alias = UniteFunctionsBanner::getVal($arrMain, "alias");			
			if(!empty($sliderID)) {
				$this->initByID($sliderID);
			}
			$this->validateInputSettings($title, $alias, $params);			
			$jsonParams = json_encode($params);
			
			//Insert slider to database
			$arrData = array();
			$arrData["title"] = $title;
			$arrData["alias"] = $alias;
			$arrData["params"] = $jsonParams;			
			if(empty($sliderID)) {	
				//Create slider	
				$sliderID = $this->db->insert(GlobalsBannerRotator::$table_sliders,$arrData);
				return($sliderID);				
			} else {	
				//Update slider
				$this->initByID($sliderID);				
				$sliderID = $this->db->update(GlobalsBannerRotator::$table_sliders,$arrData,array("id"=>$sliderID));				
			}
		}		
		
		//Delete slider from database
		private function deleteSlider() {
			$this->validateInited();
			
			//Delete slider
			$this->db->delete(GlobalsBannerRotator::$table_sliders,"id=".$this->id);
			
			//Delete slides
			$this->deleteAllSlides();
		}

		//Delete all slides
		private function deleteAllSlides() {
			$this->validateInited();			
			$this->db->delete(GlobalsBannerRotator::$table_slides,"slider_id=".$this->id);			
		}		
		
		//Duplicate slider in datatase
		private function duplicateSlider() {		
			$this->validateInited();
			
			//Get slider number
			$response = $this->db->fetch(GlobalsBannerRotator::$table_sliders);
			$numSliders = count($response);
			$newSliderSerial = $numSliders+1;			
			$newSliderTitle = "Slider".$newSliderSerial;
			$newSliderAlias = "slider".$newSliderSerial;
			
			//Insert a new slider
			$sqlSelect = "select ".GlobalsBannerRotator::FIELDS_SLIDER." from ".GlobalsBannerRotator::$table_sliders." where id={$this->id}";
			$sqlInsert = "insert into ".GlobalsBannerRotator::$table_sliders." (".GlobalsBannerRotator::FIELDS_SLIDER.") ($sqlSelect)";						
			$this->db->runSql($sqlInsert);
			$lastID = $this->db->getLastInsertID();
			UniteFunctionsBanner::validateNotEmpty($lastID);
			
			//Update the new slider with the title and the alias values
			$arrUpdate = array();
			$arrUpdate["title"] = $newSliderTitle;
			$arrUpdate["alias"] = $newSliderAlias;
			$this->db->update(GlobalsBannerRotator::$table_sliders, $arrUpdate, array("id"=>$lastID));
			
			//Duplicate slides
			$fields_slide = GlobalsBannerRotator::FIELDS_SLIDE;
			$fields_slide = str_replace("slider_id", $lastID, $fields_slide);			
			$sqlSelect = "select ".$fields_slide." from ".GlobalsBannerRotator::$table_slides." where slider_id={$this->id}";
			$sqlInsert = "insert into ".GlobalsBannerRotator::$table_slides." (".GlobalsBannerRotator::FIELDS_SLIDE.") ($sqlSelect)";			
			$this->db->runSql($sqlInsert);
		}		
		
		//Duplicate slide
		private function duplicateSlide($slideID) {
			$slide = new BannerSlide();
			$slide->initByID($slideID);
			$order = $slide->getOrder();
			$slides = $this->getSlides();
			$newOrder = $order+1;
			$this->shiftOrder($newOrder);
			
			//Do duplication
			$sqlSelect = "select ".GlobalsBannerRotator::FIELDS_SLIDE." from ".GlobalsBannerRotator::$table_slides." where id={$slideID}";
			$sqlInsert = "insert into ".GlobalsBannerRotator::$table_slides." (".GlobalsBannerRotator::FIELDS_SLIDE.") ($sqlSelect)";			
			$this->db->runSql($sqlInsert);
			$lastID = $this->db->getLastInsertID();
			UniteFunctionsBanner::validateNotEmpty($lastID);
			
			//Update order
			$arrUpdate = array("slide_order"=>$newOrder);			
			$this->db->update(GlobalsBannerRotator::$table_slides,$arrUpdate, array("id"=>$lastID));
		}
		
		
		//Shift order of the slides from specific order
		private function shiftOrder($fromOrder) {			
			$where = " slider_id={$this->id} and slide_order >= $fromOrder";
			$sql = "update ".GlobalsBannerRotator::$table_slides." set slide_order=(slide_order+1) where $where";
			$this->db->runSql($sql);			
		}		
		
		//Create slider in database from options
		public function createSliderFromOptions($options){
			$sliderID = $this->createUpdateSliderFromOptions($options);
			return($sliderID);			
		}		
		
		//Export slider from data, output a file for download
		public function exportSlider() {
			$this->validateInited();			
			$sliderParams = $this->getParamsForExport();
			$arrSlides = $this->getSlidesForExport();			
			$arrSliderExport = array("params"=>$sliderParams,"slides"=>$arrSlides);			
			$strExport = serialize($arrSliderExport);			
			if(!empty($this->alias)) {
				$filename = $this->alias.".txt";
			} else {
				$filename = "slider_export.txt";
			}
			UniteFunctionsBanner::downloadFile($strExport,$filename);
		}		
		
		//Import slider from multipart form
		public function importSliderFromPost() {			
			try {			
				$sliderID = UniteFunctionsBanner::getPostVariable("sliderid");
				$this->initByID($sliderID);
				$filepath = $_FILES["import_file"]["tmp_name"];				
				if(file_exists($filepath) == false) {
					UniteFunctionsBanner::throwError("Import file not found!!!");
				}
				
				//Get content array
				$content = @file_get_contents($filepath);			
				$arrSlider = @unserialize($content);
				if(empty($arrSlider)) {
					 UniteFunctionsBanner::throwError("Wrong export slider file format!");
				}
				
				//Update slider params				
				$sliderParams = $arrSlider["params"];
				$sliderParams["title"] = $this->arrParams["title"];
				$sliderParams["alias"] = $this->arrParams["alias"];
				$sliderParams["shortcode"] = $this->arrParams["shortcode"];				
				if(isset($sliderParams["background_image"])) {
					$sliderParams["background_image"] = UniteFunctionsWPBanner::getImageUrlFromPath($sliderParams["background_image"]);
				}
				$json_params = json_encode($sliderParams);
				$arrUpdate = array("params"=>$json_params);
				$this->db->update(GlobalsBannerRotator::$table_sliders,$arrUpdate,array("id"=>$sliderID));
				
				//Delete current slides
				$this->deleteAllSlides();
				
				//Create all slides
				$arrSlides = $arrSlider["slides"];
				foreach($arrSlides as $slide) {					
					$params = $slide["params"];
					$layers = $slide["layers"];
					
					//Convert params images
					if(isset($params["image"])) {
						$params["image"] = UniteFunctionsWPBanner::getImageUrlFromPath($params["image"]);
					}
					
					//Convert layers images
					foreach($layers as $key=>$layer) {					
						if(isset($layer["image_url"])) {
							$layer["image_url"] = UniteFunctionsWPBanner::getImageUrlFromPath($layer["image_url"]);
							$layers[$key] = $layer;
						}
					}
					
					//Create new slide
					$arrCreate = array();
					$arrCreate["slider_id"] = $sliderID;
					$arrCreate["slide_order"] = $slide["slide_order"];				
					$arrCreate["layers"] = json_encode($layers);
					$arrCreate["params"] = json_encode($params);					
					$this->db->insert(GlobalsBannerRotator::$table_slides,$arrCreate);									
				}

			} catch(Exception $e) {
				$errorMessage = $e->getMessage();
				return(array("success"=>false,"error"=>$errorMessage,"sliderID"=>$sliderID));
			}			
			return(array("success"=>true,"sliderID"=>$sliderID));
		}		
		
		//Update slider from options
		public function updateSliderFromOptions($options) {			
			$sliderID = UniteFunctionsBanner::getVal($options, "sliderid");
			UniteFunctionsBanner::validateNotEmpty($sliderID,"Slider ID");			
			$this->createUpdateSliderFromOptions($options,$sliderID);
		}		
		
		//Delete slider from input data
		public function deleteSliderFromData($data) {
			$sliderID = UniteFunctionsBanner::getVal($data, "sliderid");
			UniteFunctionsBanner::validateNotEmpty($sliderID,"Slider ID");
			$this->initByID($sliderID);
			$this->deleteSlider();
		}
		
		//Delete slider from input data
		public function duplicateSliderFromData($data) {
			$sliderID = UniteFunctionsBanner::getVal($data, "sliderid");
			UniteFunctionsBanner::validateNotEmpty($sliderID,"Slider ID");
			$this->initByID($sliderID);
			$this->duplicateSlider();
		}		
		
		//Duplicate slide from input data
		public function duplicateSlideFromData($data) {			
			//Init the slider
			$sliderID = UniteFunctionsBanner::getVal($data, "sliderID");
			UniteFunctionsBanner::validateNotEmpty($sliderID,"Slider ID");
			$this->initByID($sliderID);
			
			//Get the slide id
			$slideID = UniteFunctionsBanner::getVal($data, "slideID");
			UniteFunctionsBanner::validateNotEmpty($slideID,"Slide ID");
			$this->duplicateSlide($slideID);			
			return($sliderID);
		}		
		
		//Create a slide from input data
		public function createSlideFromData($data) {			
			$sliderID = UniteFunctionsBanner::getVal($data, "sliderid");
			$urlImage = UniteFunctionsBanner::getVal($data, "url_image");			
			UniteFunctionsBanner::validateNotEmpty($sliderID,"Slider ID");
			UniteFunctionsBanner::validateNotEmpty($urlImage,"image url");
			$this->initByID($sliderID);						
			$slide = new BannerSlide();
			$slideID = $slide->createSlide($sliderID, $urlImage);
			return($slideID);
		}
		
		//Update slides order from data
		public function updateSlidesOrderFromData($data) {
			$sliderID = UniteFunctionsBanner::getVal($data, "sliderID");
			$arrIDs = UniteFunctionsBanner::getVal($data, "arrIDs");
			UniteFunctionsBanner::validateNotEmpty($arrIDs,"slides");			
			$this->initByID($sliderID);			
			foreach($arrIDs as $index=>$slideID){
				$order = $index+1;
				$arrUpdate = array("slide_order"=>$order);
				$where = array("id"=>$slideID);
				$this->db->update(GlobalsBannerRotator::$table_slides,$arrUpdate,$where);
			}			
		}
		
		//Get the "main" and "settings" arrays, for dealing with the settings.
		public function getSettingsFields() {
			$this->validateInited();			
			$arrMain = array();
			$arrMain["title"] = $this->title;
			$arrMain["alias"] = $this->alias;			
			$arrRespose = array("main"=>$arrMain, "params"=>$this->arrParams);			
			return($arrRespose);
		}		
		
		//Get slides of the current slider
		public function getSlides() {
			$this->validateInited();			
			$arrSlides = array();
			$arrSlideRecords = $this->db->fetch(GlobalsBannerRotator::$table_slides,"slider_id=".$this->id,"slide_order");			
			foreach ($arrSlideRecords as $record) {
				$slide = new BannerSlide();
				$slide->initByData($record);
				$arrSlides[] = $slide;
			}			
			$this->arrSlides = $arrSlides;			
			return($arrSlides);
		}
		
		//Get array of slide names
		public function getArrSlideNames() {
			if(empty($this->arrSlides)) $this->getSlides();			
			$arrSlideNames = array();			
			foreach($this->arrSlides as $number=>$slide) {
				$slideID = $slide->getID();
				$filename = $slide->getImageFilename();
				$arrSlideNames[$slideID] = "Slide ".($number+1)." ($filename)";				
			}
			return($arrSlideNames);
		}		
		
		//Get array of slides numbers by id's
		public function getSlidesNumbersByIDs() {			
			if(empty($this->arrSlides)) $this->getSlides();				
			$arrSlideNumbers = array();			
			foreach($this->arrSlides as $number=>$slide) {
				$slideID = $slide->getID();
				$arrSlideNumbers[$slideID] = ($number+1);				
			}
			return($arrSlideNumbers);
		}		
		
		//Get slider params for export slider
		private function getParamsForExport() {
			$exportParams = $this->arrParams;
			unset($exportParams["title"]);
			unset($exportParams["alias"]);
			unset($exportParams["shortcode"]);
			
			//Modify background image
			$urlImage = UniteFunctionsBanner::getVal($exportParams, "background_image");
			if(!empty($urlImage)) {
				$exportParams["background_image"] = $urlImage;
			}
			return($exportParams);
		}
		
		//Get slides for export
		private function getSlidesForExport() {
			$arrSlides = $this->getSlides();
			$arrSlidesExport = array();
			foreach($arrSlides as $slide){
				$slideNew = array();
				$slideNew["params"] = $slide->getParamsForExport();
				$slideNew["slide_order"] = $slide->getOrder();
				$slideNew["layers"] = $slide->getLayersForExport();
				$arrSlidesExport[] = $slideNew;
			}			
			return($arrSlidesExport);
		}		
		
		//Get slides number
		public function getNumSlides(){
			if($this->arrSlides == null) $this->getSlides();			
			$numSlides = count($this->arrSlides);
			return($numSlides);
		}		
		
		//Get sliders array - function don't belong to the object!
		public function getArrSliders() {
			$where = "";			
			$response = $this->db->fetch(GlobalsBannerRotator::$table_sliders,$where,"id");			
			$arrSliders = array();
			foreach($response as $arrData) {
				$slider = new BannerRotator();
				$slider->initByDBData($arrData);
				$arrSliders[] = $slider;
			}			
			return($arrSliders);
		}
		
		//Get aliasees array
		public function getAllSliderAliases() {
			$where = "";			
			$response = $this->db->fetch(GlobalsBannerRotator::$table_sliders,$where,"id");			
			$arrAliases = array();
			foreach($response as $arrSlider) {
				$arrAliases[] = $arrSlider["alias"];
			}			
			return($arrAliases);
		}		
		
		//Get array of slider id -> title
		public function getArrSlidersShort() {
			$arrSliders = $this->getArrSliders();
			$arrShort = array();
			foreach($arrSliders as $slider) {
				$id = $slider->getID();
				$title = $slider->getTitle();
				$arrShort[$id] = $title;
			}
			return($arrShort);
		}
		
		//Get max order
		public function getMaxOrder() {
			$this->validateInited();
			$maxOrder = 0;
			$arrSlideRecords = $this->db->fetch(GlobalsBannerRotator::$table_slides,"slider_id=".$this->id,"slide_order desc","","limit 1");
			if(empty($arrSlideRecords)) return($maxOrder);
			$maxOrder = $arrSlideRecords[0]["slide_order"];			
			return($maxOrder);
		}				
		
	}
?>