<?php
	class BannerOperations extends UniteElementsBaseBanner {
		
		//Get button classes
		public function getButtonClasses() {			
			$arrButtons = array(
				"red"=>"Red Button",
				"green"=>"Green Button",
				"blue"=>"Blue Button",
				"orange"=>"Orange Button",
				"black"=>"Black Button",
			);			
			return($arrButtons);
		}
		
		
		//Get easing functions array
		public function getArrEasing($toAssoc = true) {			
			$arrEasing = array(
				"easeOutBack",
				"easeInQuad",
				"easeOutQuad",
				"easeInOutQuad",
				"easeInCubic",
				"easeOutCubic",
				"easeInOutCubic",
				"easeInQuart",
				"easeOutQuart",
				"easeInOutQuart",
				"easeInQuint",
				"easeOutQuint",
				"easeInOutQuint",
				"easeInSine",
				"easeOutSine",
				"easeInOutSine",
				"easeInExpo",
				"easeOutExpo",
				"easeInOutExpo",
				"easeInCirc",
				"easeOutCirc",
				"easeInOutCirc",
				"easeInElastic",
				"easeOutElastic",
				"easeInOutElastic",
				"easeInBack",
				"easeOutBack",
				"easeInOutBack",
				"easeInBounce",
				"easeOutBounce",
				"easeInOutBounce"
			);			
			if($toAssoc) {
				$arrEasing = UniteFunctionsBanner::arrayToAssoc($arrEasing);
			}
			return($arrEasing);
		}
		
		//Get arr end easing
		public function getArrEndEasing() {
			$arrEasing = $this->getArrEasing(false);
			$arrEasing = array_merge(array("nothing"),$arrEasing);
			$arrEasing = UniteFunctionsBanner::arrayToAssoc($arrEasing);
			$arrEasing["nothing"] = "No Change";			
			return($arrEasing);
		}
		
		//Get transition array
		public function getArrTransition() {			
			$arrTransition = array(
				"random"=>"Random",
				"block"=>"Block",
				"cube"=>"Cube",
				"cubeRandom"=>"Cube Random",
				"cubeShow"=>"Cube Show",
				"cubeStop"=>"Cube Stop",
				"cubeStopRandom"=>"Cube Stop Random",
				"cubeHide"=>"Cube Hide",
				"cubeSize"=>"Cube Size",
				"cubeSpread"=>"Cube Spread",
				"horizontal"=>"Horizontal",
				"showBars"=>"Show Bars",
				"showBarsRandom"=>"Show Bars Random",
				"tube"=>"Tube",
				"fade"=>"Fade",
				"fadeFour"=>"Fade Four",
				"parallel"=>"Parallel",
				"blind"=>"Blind",
				"blindHeight"=>"Blind Height",
				"blindWidth"=>"Blind Width",
				"directionTop"=>"Direction Top",
				"directionBottom"=>"Direction Bottom",
				"directionRight"=>"Direction Right",
				"directionLeft"=>"Direction Left",
				"glassCube"=>"Glass Cube",
				"glassBlock"=>"Glass Block",
				"circles"=>"Circles",
				"circlesInside"=>"Circles Inside",
				"circlesRotate"=>"Circles Rotate",
				"upBars"=>"Up Bars",
				"downBars"=>"Down Bars",
				"hideBars"=>"Hide Bars",
				"swapBars"=>"Swap Bars",
				"swapBarsBack"=>"Swap Bars Back",
				"swapBlocks"=>"Swap Blocks",
				"cut"=>"Cut"			
			);						
			return($arrTransition);
		}		
		
		//Get random transition
		public static function getRandomTransition() {
			$arrTrans = self::getArrTransition();
			unset($arrTrans["random"]);
			$trans = array_rand($arrTrans);			
			return($trans);
		}		
		
		//Get animations array
		public function getArrAnimations() {			
			$arrAnimations = array(
				"fade"=>"Fade",
				"sft"=>"Short from Top",
				"sfb"=>"Short from Bottom",
				"sfr"=>"Short from Right",
				"sfl"=>"Short from Left",
				"lft"=>"Long from Top",
				"lfb"=>"Long from Bottom",
				"lfr"=>"Long from Right",
				"lfl"=>"Long from Left",
				"randomrotate"=>"Random Rotate"
			);			
			return($arrAnimations);
		}
		
		//Get "end" animations array
		public function getArrEndAnimations() {
			$arrAnimations = array(
				"auto"=>"Choose Automatic",
				"fadeout"=>"Fade Out",
				"stt"=>"Short to Top",
				"stb"=>"Short to Bottom",
				"stl"=>"Short to Left",
				"str"=>"Short to Right",
				"ltt"=>"Long to Top",
				"ltb"=>"Long to Bottom",
				"ltl"=>"Long to Left",
				"ltr"=>"Long to Right",
				"randomrotateout"=>"Random Rotate Out"
			);			
			return($arrAnimations);
		}
		
		
		//Parse css file and get the classes from there.
		public function getArrCaptionClasses($contentCSS) {
			//Parse css captions file
			$parser = new UniteCssParserBanner();
			$parser->initContent($contentCSS);
			$arrCaptionClasses = $parser->getArrClasses();
			return($arrCaptionClasses);
		}
		
		//Get the select classes html for putting in the html by ajax 
		private function getHtmlSelectCaptionClasses($contentCSS) {
			$arrCaptions = $this->getArrCaptionClasses($contentCSS);
			$htmlSelect = UniteFunctionsBanner::getHTMLSelect($arrCaptions,"","id='layer_caption' name='layer_caption'",true);
			return($htmlSelect);
		}
		
		//Get contents of the css file
		public function getCaptionsContent() {
			$contentCSS = file_get_contents(GlobalsBannerRotator::$filepath_captions);
			return($contentCSS);
		}		
		
		//Update captions css file content
		//@return new captions html select 
		public function updateCaptionsContentData($content){
			$content = stripslashes($content);
			$content = trim($content);
			UniteFunctionsBanner::writeFile($content, GlobalsBannerRotator::$filepath_captions);			
			//Output captions array 
			$arrCaptions = $this->getArrCaptionClasses($content);
			return($arrCaptions);
		}
		
		//Copy from original css file to the captions css.
		public function restoreCaptionsCss() {			
			if(!file_exists(GlobalsBannerRotator::$filepath_captions_original)) {
				UniteFunctionsBanner::throwError("The original css file: captions_original.css doesn't exists.");
			}
			$success = @copy(GlobalsBannerRotator::$filepath_captions_original, GlobalsBannerRotator::$filepath_captions);
			if($success == false) {
				UniteFunctionsBanner::throwError("Failed to restore from the original captions file.");
			}
		}
		
		//Preview slider output
		//If output object is null - create object
		public function previewOutput($sliderID,$output = null) {			
			if($output == null) {
				$output = new BannerRotatorOutput();
			}
			$output->setPreviewMode();
			
			//Put the output html
			$urlPlugin = BannerRotatorAdmin::$url_plugin;			
			?>
				<html>
					<head>
						<link rel='stylesheet' href='<?php echo $urlPlugin?>css/banner-rotator.css' type='text/css' media='all' />
						<link rel='stylesheet' href='<?php echo $urlPlugin?>css/caption.css' type='text/css' media='all' />
						<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js'></script>
						<script type='text/javascript' src='<?php echo $urlPlugin?>js/jquery.flashblue-plugins.js'></script>
						<script type='text/javascript' src='<?php echo $urlPlugin?>js/jquery.banner-rotator.js'></script>
					</head>
					<body style="padding:0px;margin:0px;">
						<?php $output->putSliderBase($sliderID);?>
					</body>
				</html>
			<?php 
			exit();
		}
		
		//Put slide preview by data
		public function putSlidePreviewByData($data) {			
			$data = UniteFunctionsBanner::jsonDecodeFromClientSide($data);			
			$slideID = $data["slideid"];
			$slide = new BannerSlide();
			$slide->initByID($slideID);
			$sliderID = $slide->getSliderID();			
			$output = new BannerRotatorOutput();
			$output->setOneSlideMode($data);			
			$this->previewOutput($sliderID,$output);
		}		
		
	}
?>