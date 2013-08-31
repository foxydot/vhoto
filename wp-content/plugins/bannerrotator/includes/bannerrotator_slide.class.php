<?php
	class BannerSlide extends UniteElementsBaseBanner {
		
		private $id;
		private $sliderID;
		private $slideOrder;		
		private $imageUrl;
		private $imageFilepath;
		private $imageFilename;		
		private $params;
		private $arrLayers;
		
		public function __construct() {
			parent::__construct();
		}
		
		//Init slide by db record
		public function initByData($record) {			
			$this->id = $record["id"];
			$this->sliderID = $record["slider_id"];
			$this->slideOrder = $record["slide_order"];			
			$params = $record["params"];
			$params = (array)json_decode($params);			
			$layers = $record["layers"];
			$layers = (array)json_decode($layers);
			$layers = UniteFunctionsBanner::convertStdClassToArray($layers);
			
			//Set image path, file and url
			$this->imageUrl = UniteFunctionsBanner::getVal($params, "image");
			UniteFunctionsBanner::validateNotEmpty($this->imageUrl,"Image");			
			$this->imageFilepath = UniteFunctionsWPBanner::getImagePathFromURL($this->imageUrl);
		    $realPath = UniteFunctionsWPBanner::getPathContent().$this->imageFilepath;		    
		    if(file_exists($realPath) == false || is_file($realPath) == false) {
		    	$this->imageFilepath = "";
			}
			$this->imageFilename = basename($this->imageUrl);			
			$this->params = $params;
			$this->arrLayers = $layers;	
		}		
		
		//Init the slider by id
		public function initByID($slideid) {
			UniteFunctionsBanner::validateNumeric($slideid,"Slide ID");
			$slideid = $this->db->escape($slideid);
			$record = $this->db->fetchSingle(GlobalsBannerRotator::$table_slides,"id=$slideid");			
			$this->initByData($record);
		}
		
		//Get slide ID
		public function getID() {
			return($this->id);
		}		
		
		//Get slide order
		public function getOrder() {
			$this->validateInited();
			return($this->slideOrder);
		}		
		
		//Get layers in json format
		public function getLayers() {
			$this->validateInited();
			return($this->arrLayers);
		}
		
		//Modify layer links for export
		public function getLayersForExport() {
			$this->validateInited();
			$arrLayersNew = array();
			foreach($this->arrLayers as $key=>$layer) {
				$imageUrl = UniteFunctionsBanner::getVal($layer, "image_url");
				if(!empty($imageUrl)) {
					$layer["image_url"] = UniteFunctionsWPBanner::getImagePathFromURL($layer["image_url"]);
				}
				$arrLayersNew[] = $layer;
			}			
			return($arrLayersNew);
		}
		
		//Get params for export
		public function getParamsForExport() {
			$arrParams = $this->getParams();
			$urlImage = UniteFunctionsBanner::getVal($arrParams, "image");
			if(!empty($urlImage)) {
				$arrParams["image"] = UniteFunctionsWPBanner::getImagePathFromURL($urlImage);
			}
			return($arrParams);
		}		
		
		//Normalize layers text, and get layers
		public function getLayersNormalizeText() {
			$arrLayersNew = array();
			foreach ($this->arrLayers as $key=>$layer) {
				$text = $layer["text"];
				$text = addslashes($text);
				$layer["text"] = $text;
				$arrLayersNew[] = $layer;
			}			
			return($arrLayersNew);
		}
		

		//Get slide params
		public function getParams() {
			$this->validateInited();
			return($this->params);
		}
		
		//Get parameter from params array. if no default, then the param is a must!
		function getParam($name,$default=null) {			
			if($default === null){
				if(!array_key_exists($name, $this->params)) {
					UniteFunctionsBanner::throwError("The param <b>$name</b> not found in slide params.");
				}
				$default = "";
			}				
			return UniteFunctionsBanner::getVal($this->params, $name,$default);
		}		
		
		//Get image filename
		public function getImageFilename() {
			return($this->imageFilename);
		}		
		
		//Get image filepath
		public function getImageFilepath() {
			return($this->imageFilepath);
		}
		
		//Get image url
		public function getImageUrl() {
			return($this->imageUrl);
		}
		
		
		//Get the slider id
		public function getSliderID() {
			return($this->sliderID);
		}
		
		//Validate if the slider exists
		private function validateSliderExists($sliderID) {
			$slider = new BannerRotator();
			$slider->initByID($sliderID);
		}
		
		//Validate if the slide is inited and the id exists.
		private function validateInited() {
			if(empty($this->id)) {
				UniteFunctionsBanner::throwError("The slide is not inited!!!");
			}
		}		
		
		//Create the slide (from image)
		public function createSlide($sliderID,$urlImage) {
			//Get max order
			$slider = new BannerRotator();
			$slider->initByID($sliderID);
			$maxOrder = $slider->getMaxOrder();
			$order = $maxOrder+1;			
			$params = array();
			$params["image"] = $urlImage;
			$jsonParams = json_encode($params);			
			$arrInsert = array("params"	 => $jsonParams,
			           		   "slider_id"  => $sliderID,
							   "slide_order"=> $order,
							   "layers"	 => ""
						);			
			$slideID = $this->db->insert(GlobalsBannerRotator::$table_slides, $arrInsert);			
			return($slideID);
		}
		
		//Update slide image from data
		public function updateSlideImageFromData($data) {			
			$slideID = UniteFunctionsBanner::getVal($data, "slide_id");			
			$this->initByID($slideID);			
			$urlImage = UniteFunctionsBanner::getVal($data, "url_image");
			UniteFunctionsBanner::validateNotEmpty($urlImage);			
			$arrUpdate = array();
			$arrUpdate["image"] = $urlImage;
			$this->updateParamsInDB($arrUpdate);			
			return($urlImage);
		}
		
		//Update slide parameters in db
		private function updateParamsInDB($arrUpdate) {			
			$this->params = array_merge($this->params,$arrUpdate);
			$jsonParams = json_encode($this->params);			
			$arrDBUpdate = array("params"=>$jsonParams);			
			$this->db->update(GlobalsBannerRotator::$table_slides,$arrDBUpdate,array("id"=>$this->id));
		}
		
		//Sort layers by order
		private function sortLayersByOrder($layer1,$layer2) {
			$layer1 = (array)$layer1;
			$layer2 = (array)$layer2;			
			$order1 = UniteFunctionsBanner::getVal($layer1, "order",1);
			$order2 = UniteFunctionsBanner::getVal($layer2, "order",2);
			if($order1 == $order2) return(0);			
			return($order1 > $order2);
		}		
		
		//Go through the layers and fix small bugs if exists
		private function normalizeLayers($arrLayers) {			
			usort($arrLayers,array($this,"sortLayersByOrder"));			
			$arrLayersNew = array();
			foreach ($arrLayers as $key=>$layer) {				
				$layer = (array)$layer;				
				//Set type
				$type = UniteFunctionsBanner::getVal($layer, "type","text");
				$layer["type"] = $type;
				
				//Normalize position:
				$layer["left"] = round($layer["left"]);
				$layer["top"] = round($layer["top"]);
				
				//Unset order
				unset($layer["order"]);
				
				//Modify text
				$layer["text"] = stripcslashes($layer["text"]);				
				$arrLayersNew[] = $layer;
			}			
			return($arrLayersNew);
		}  		
		
		//Normalize params
		private function normalizeParams($params) {			
			$urlImage = $params["image_url"];
			if(empty($urlImage)) {
				UniteFunctionsBanner::throwError("the image could not be empty in params");
			}
			$params["image"] = $urlImage;
			unset($params["image_url"]);			
			if(isset($params["video_description"])) {
				$params["video_description"] = UniteFunctionsBanner::normalizeTextareaContent($params["video_description"]);
			}
			return($params);
		}				
		
		//Update slide from data
		public function updateSlideFromData($data) {			
			$slideID = UniteFunctionsBanner::getVal($data, "slideid");
			$this->initByID($slideID);
			
			//Treat params
			$params = UniteFunctionsBanner::getVal($data, "params");
			$params = $this->normalizeParams($params);
			
			//Treat layers
			$layers = UniteFunctionsBanner::getVal($data, "layers");
			if(gettype($layers) == "string") {
				$layers = stripslashes($layers);
				$layers = json_decode($layers);
				$layers = UniteFunctionsBanner::convertStdClassToArray($layers);
			}			
			if(empty($layers) || gettype($layers) != "array") $layers = array();			
			$layers = $this->normalizeLayers($layers);			
			$arrUpdate = array();
			$arrUpdate["layers"] = json_encode($layers);
			$arrUpdate["params"] = json_encode($params);			
			$this->db->update(GlobalsBannerRotator::$table_slides,$arrUpdate,array("id"=>$this->id));
		}		
		
		//Delete slide from data
		public function deleteSlideFromData($data) {
			$slideID = UniteFunctionsBanner::getVal($data, "slideID");
			$this->initByID($slideID);
			$this->db->delete(GlobalsBannerRotator::$table_slides,"id='$slideID'");
		}
		
		//Set params from client
		public function setParams($params) {
			$params = $this->normalizeParams($params);
			$this->params = $params;
		}
		
		//Set layers from client
		public function setLayers($layers) {
			$layers = $this->normalizeLayers($layers);
			$this->arrLayers = $layers;
		}
		
	}	
?>