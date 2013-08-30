<?php
	class BannerRotatorOutput {
		
		private static $sliderSerial = 0;		
		private $sliderHtmlID;
		private $sliderHtmlID_wrapper;
		private $slider;
		private $oneSlideMode = false;
		private $oneSlideData;
		private $previewMode = false;	//Admin preview mode
		private $slidesNumIndex;		
		
		//Put the kb slider slider on the html page
		//@param $data - mixed, can be ID ot Alias
		public static function putSlider($sliderID,$putIn="") {
			$putIn = strtolower($putIn);
			
			if($putIn == "homepage") {		//Filter by homepage
				if(is_front_page() == false)
					return(false);	
			} 
			else		//Case filter by pages	
			if(!empty($putIn)) {
				$arrPutInPages = array();
				$arrPagesTemp = explode(",", $putIn);
				foreach($arrPagesTemp as $page) {
					if(is_numeric($page) || $page == "homepage")
						$arrPutInPages[] = $page;
				}
				if(!empty($arrPutInPages)) {					
					//Get current page id
					$currentPageID = "";
					if(is_front_page() == true) {
						$currentPageID = "homepage";
					} else {
						global $post;
						if(isset($post->ID))
							$currentPageID = $post->ID;
					}						
					//Do the filter by pages
					if(array_search($currentPageID, $arrPutInPages) === false) 
						return(false);
				}
			}			
			$output = new BannerRotatorOutput();
			$output->putSliderBase($sliderID);			
			$slider = $output->getSlider();
			return($slider);
		}		
		
		//Set one slide mode for preview
		public function setOneSlideMode($data) {
			$this->oneSlideMode = true;
			$this->oneSlideData = $data;
		}
		
		//Set preview mode
		public function setPreviewMode() {
			$this->previewMode = true;
		}
		
		//Get the last slider after the output
		public function getSlider() {
			return($this->slider);
		}
		
		//Get slide full width video data
		private function getSlideFullWidthVideoData(BannerSlide $slide) {			
			$response = array("found"=>false);
			
			//Deal full width video
			$enableVideo = $slide->getParam("enable_video","false");
			if($enableVideo != "true") return($response);				
			$videoID = $slide->getParam("video_id","");
			$videoID = trim($videoID);			
			if(empty($videoID)) return($response);				
			$response["found"] = true;			
			$videoType = is_numeric($videoID)?"vimeo":"youtube";
			$videoPlayButton = $slide->getParam("video_play_button");
			$videoAutoplay = $slide->getParam("video_autoplay");			
			$response["type"] = $videoType;
			$response["videoID"] = $videoID;
			$response["playButton"] = UniteFunctionsBanner::strToBool($videoPlayButton);	
			$response["autoplay"] = UniteFunctionsBanner::strToBool($videoAutoplay);			
			return($response);
		}
		
		//Put full width video layer
		private function putFullWidthVideoLayer($videoData) {
			if($videoData["found"] == false) return(false);			
			$autoplay = UniteFunctionsBanner::boolToStr($videoData["autoplay"]);			
			$htmlParams = 'data-x="0" data-y="0" data-speed="500" data-start="10" data-easing="easeOutBack"';			
			$videoID = $videoData["videoID"];	
			if ($videoData["playButton"]) {
				if($videoData["type"] == "youtube") {
					?>
					<div class="caption fade"
						<?php echo $htmlParams?>
						data-video="http://www.youtube.com/embed/<?php echo $videoID?>?hd=1&amp;wmode=opaque&amp;controls=1&amp;autoplay=1&amp;showinfo=0">
					</div>
					<?php
				} else {
					?>
					<div class="caption fade"
						<?php echo $htmlParams?>
						data-video="http://player.vimeo.com/video/<?php echo $videoID?>?title=0&amp;byline=0&amp;portrait=0;api=1">
					</div>
					<?php
				}
			} else {
				if($videoData["type"] == "youtube"):	//youtube
					?>	
					<div class="caption fade fullscreenvideo" data-autoplay="<?php echo $autoplay?>" <?php echo $htmlParams?>><iframe src="http://www.youtube.com/embed/<?php echo $videoID?>?hd=1&amp;wmode=opaque&amp;controls=1&amp;showinfo=0;rel=0;" width="100%" height="100%"></iframe></div>				
					<?php 
				else:									//vimeo
					?>
					<div class="caption fade fullscreenvideo" data-autoplay="<?php echo $autoplay?>" <?php echo $htmlParams?>><iframe src="http://player.vimeo.com/video/<?php echo $videoID?>?title=0&amp;byline=0&amp;portrait=0;api=1" width="100%" height="100%"></iframe></div>
					<?php
				endif;
			}
		}
		
		//Filter the slides for one slide preview
		private function filterOneSlide($slides) {			
			$oneSlideID = $this->oneSlideData["slideid"];
			$oneSlideParams = (array)$this->oneSlideData["params"];
			$oneSlideLayers = (array)$this->oneSlideData["layers"];
			$oneSlideLayers = UniteFunctionsBanner::convertStdClassToArray($oneSlideLayers);			
			$newSlides = array();
			foreach($slides as $slide) {				
				$slideID = $slide->getID();				
				if($slideID == $oneSlideID){
					$slide->setParams($oneSlideParams);	
					$slide->setLayers($oneSlideLayers);										
					$newSlides[] = $slide;	//add 2 slides
					$newSlides[] = $slide;
				}			
			}			
			return($newSlides);
		}
		
		//Put the slider slides
		private function putSlides() {			
			$sliderType = $this->slider->getParam("slider_type");			
			$slides = $this->slider->getSlides();
			$this->slidesNumIndex = $this->slider->getSlidesNumbersByIDs();			
			if(empty($slides)) {
				?>
				<div class="no-slides-text">
					No slides found, please add some slides
				</div>
				<?php 
			}			
			$thumbWidth = $this->slider->getParam("thumbWidth",72);
			$thumbHeight = $this->slider->getParam("thumbHeight",54);			
			$slideWidth = $this->slider->getParam("width",960);
			$slideHeight = $this->slider->getParam("height",400);			
			$isThumbsActive = $this->slider->getParam("showThumb",false);
						
			//For one slide preview
			if($this->oneSlideMode == true) {			
				$slides = $this->filterOneSlide($slides);
			}
			?>
				<ul>
			<?php						
			foreach($slides as $slide) {				
				$params = $slide->getParams();				
				$transition = $slide->getParam("slide_transition","random");					
				$urlSlideImage = $slide->getImageUrl();
				
				//Get image alt
				$imageFilename = $slide->getImageFilename();
				$info = pathinfo($imageFilename);
				$alt = $info["filename"];				
				
				//Get thumb url
				$htmlThumb = "";
				if($isThumbsActive == true) {
					$urlThumb = $slide->getParam("slide_thumb","");					
					if(empty($urlThumb)){	//Try to get resized thumb
						$pathThumb = $slide->getImageFilepath();
						if(!empty($pathThumb))
							$urlThumb = UniteBaseClassBanner::getImageUrl($pathThumb,$thumbWidth,$thumbHeight,true);
					}
					
					//If not - put regular image
					if(empty($urlThumb)) $urlThumb = $slide->getImageUrl();
					
					$htmlThumb = 'data-thumb="'.$urlThumb.'" ';
				}
				
				//Get link
				$htmlLink = "";
				$enableLink = $slide->getParam("enable_link","false");
				if($enableLink == "true") {
					$linkType = $slide->getParam("link_type","regular");
					switch($linkType) {						
						//---- Normal link						
						default:		
						case "regular":
							$link = $slide->getParam("link","");
							$linkOpenIn = $slide->getParam("link_open_in","same");
							$htmlTarget = "";
							if($linkOpenIn == "new")
								$htmlTarget = ' data-target="_blank"';
							$htmlLink = "data-link=\"$link\" $htmlTarget ";	
							break;		
						
						//---- Link to slide						
						case "slide":
							$slideLink = UniteFunctionsBanner::getVal($params, "slide_link");
							if(!empty($slideLink) && $slideLink != "nothing"){
								//Get slide index from id
								if(is_numeric($slideLink))
									$slideLink = UniteFunctionsBanner::getVal($this->slidesNumIndex, $slideLink);
								
								if(!empty($slideLink))
									$htmlLink = "data-link=\"slide\" data-linktoslide=\"$slideLink\" ";
							}
							break;
					}
					
					//Set link position:
					$linkPos = UniteFunctionsBanner::getVal($params, "link_pos","front");
					if($linkPos == "back") $htmlLink .= ' data-slideindex="back"';	
				}
				
				//Set delay
				$htmlDelay = "";
				$delay = $slide->getParam("delay","");
				if(!empty($delay) && is_numeric($delay))
					$htmlDelay = "data-delay=\"$delay\" ";
				
				//Get video		
				$videoData = $this->getSlideFullWidthVideoData($slide);
				
				//All parameters
				$htmlParams = $htmlLink.$htmlThumb.$htmlDelay;	
							
				//Html
				?>
					<li data-transition="<?php echo $transition?>" <?php echo $htmlParams?>>
						<img src="<?php echo $urlSlideImage?>" alt="<?php echo $alt?>">
						<?php	//put video:
							if($videoData["found"] == true)
								$this->putFullWidthVideoLayer($videoData);
								
							$this->putCreativeLayer($slide)
						?>
					</li>
				<?php 
			}
			
			?>
				</ul>
			<?php
		}		
		
		//Put creative layer
		private function putCreativeLayer(BannerSlide $slide) {
			$layers = $slide->getLayers();						
			if(empty($layers)) return(false);
				foreach($layers as $layer) {
					$type = UniteFunctionsBanner::getVal($layer, "type","text");										
					$class = UniteFunctionsBanner::getVal($layer, "style");
					$animation = UniteFunctionsBanner::getVal($layer, "animation","fade");										
					
					//Set output class
					$outputClass = "caption ". trim($class);
					$outputClass = trim($outputClass) . " ";						
					$outputClass .= trim($animation);					
					$left = UniteFunctionsBanner::getVal($layer, "left",0);
					$top = UniteFunctionsBanner::getVal($layer, "top",0);
					$speed = UniteFunctionsBanner::getVal($layer, "speed",300);
					$time = UniteFunctionsBanner::getVal($layer, "time",0);
					$easing = UniteFunctionsBanner::getVal($layer, "easing","easeOutExpo");
					$randomRotate = UniteFunctionsBanner::getVal($layer, "random_rotation","false");
					$randomRotate = UniteFunctionsBanner::boolToStr($randomRotate);					
					$text = UniteFunctionsBanner::getVal($layer, "text");					
					$htmlVideoAutoplay = "";
										
					//Set html
					$html = "";
					switch($type){
						default:
						case "text":						
							$html = $text;
							$html = do_shortcode($html);
							break;
						case "image":
							$urlImage = UniteFunctionsBanner::getVal($layer, "image_url");
							$html = '<img src="'.$urlImage.'" alt="'.$text.'">';
							$imageLink = UniteFunctionsBanner::getVal($layer, "link","");
							if(!empty($imageLink)) {
								$openIn = UniteFunctionsBanner::getVal($layer, "link_open_in","same");

								$target = "";
								if($openIn == "new")
									$target = ' target="_blank"';
									
								$html = '<a href="'.$imageLink.'"'.$target.'>'.$html.'</a>';
							}								
							break;
						case "video":
							$videoType = trim(UniteFunctionsBanner::getVal($layer, "video_type"));
							$videoID = trim(UniteFunctionsBanner::getVal($layer, "video_id"));
							$videoWidth = trim(UniteFunctionsBanner::getVal($layer, "video_width"));
							$videoHeight = trim(UniteFunctionsBanner::getVal($layer, "video_height"));							
							switch($videoType){
								case "youtube":
									$html = "<iframe src='http://www.youtube.com/embed/{$videoID}?hd=1&amp;wmode=opaque&amp;controls=1&amp;showinfo=0;rel=0' width='{$videoWidth}' height='{$videoHeight}' style='width:{$videoWidth}px;height:{$videoHeight}px;'></iframe>";
									break;
								case "vimeo":
									$html = "<iframe src='http://player.vimeo.com/video/{$videoID}?title=0&amp;byline=0&amp;portrait=0' width='{$videoWidth}' height='{$videoHeight}' style='width:{$videoWidth}px;height:{$videoHeight}px;'></iframe>";
									break;
								default:
									UniteFunctionsBanner::throwError("wrong video type: $videoType");
									break;
							}							
							$videoAutoplay = UniteFunctionsBanner::getVal($layer, "video_autoplay");
							if($videoAutoplay == "true") {
								$htmlVideoAutoplay = ' data-autoplay="true"';								
							}
							break;
					}
					
					//Handle end transitions
					$endTime = trim(UniteFunctionsBanner::getVal($layer, "endtime"));
					$htmlEnd = "";
					if(!empty($endTime)) {
						$htmlEnd = "data-end=\"$endTime\"";
						$endSpeed = trim(UniteFunctionsBanner::getVal($layer, "endspeed"));
						if(!empty($endSpeed))
							 $htmlEnd .= " data-endspeed=\"$endSpeed\"";
							 
						$endEasing = trim(UniteFunctionsBanner::getVal($layer, "endeasing"));
						if(!empty($endSpeed) && $endEasing != "nothing")
							 $htmlEnd .= " data-endeasing=\"$endEasing\"";
						
						//Add animation to class
						$endAnimation = trim(UniteFunctionsBanner::getVal($layer, "endanimation"));
						if(!empty($endAnimation) && $endAnimation != "auto")
							$outputClass .= " ".$endAnimation;	
					}
					
					//Slide link
					$htmlLink = "";
					$slideLink = UniteFunctionsBanner::getVal($layer, "link_slide");
					if(!empty($slideLink) && $slideLink != "nothing"){
						//Get slide index from id
						if(is_numeric($slideLink))
							$slideLink = UniteFunctionsBanner::getVal($this->slidesNumIndex, $slideLink);
						
						if(!empty($slideLink))
							$htmlLink = " data-linktoslide=\"$slideLink\"";
					}
					
					//Hidden under resolution
					$htmlHidden = "";
					$layerHidden = UniteFunctionsBanner::getVal($layer, "hiddenunder");
					if($layerHidden == "true")
						$htmlHidden = ' data-captionhidden="on"';
					
					$htmlParams = $htmlEnd.$htmlLink.$htmlVideoAutoplay.$htmlHidden;
				?>				
				<div class="<?php echo $outputClass?>"  
					 data-x="<?php echo $left?>" 
					 data-y="<?php echo $top?>" 
					 data-speed="<?php echo $speed?>" 
					 data-start="<?php echo $time?>" 
					 data-easing="<?php echo $easing?>" <?php echo $htmlParams?> ><?php echo $html?></div>
				<?php }?>
			<?php 
		}
		
		//Put slider javascript
		private function putJS() {			
			$params = $this->slider->getParams();
			$sliderType = $this->slider->getParam("slider_type");
			$noConflict = $this->slider->getParam("jqueryNoconflict","on");
			
			//Set thumb amount
			$numSlides = $this->slider->getNumSlides();
			$thumbAmount = (int)$this->slider->getParam("thumbAmount","5");
			if($thumbAmount > $numSlides)
				$thumbAmount = $numSlides;				
			
			//Get stop slider options
			$stopSlider = $this->slider->getParam("stopLoop","false");
			$stopAfterLoops = $this->slider->getParam("stopAfterLoops","0");
			$stopAtSlide = $this->slider->getParam("stopAtSlide","3");
			 
			if($stopSlider == "false") {
				$stopAfterLoops = "-1";
				$stopAtSlide = "-1";
			}
			
			//Slider ID
			$sliderID = $this->slider->getID();			
			?>			
			<script type="text/javascript">
				<?php if($noConflict == "on"):?>
					jQuery.noConflict();
				<?php endif;?>
				
				var bannerapi<?php echo $sliderID?>;
				
				jQuery(document).ready(function() {				
					if (jQuery.fn.cssOriginal != undefined) {
						jQuery.fn.css = jQuery.fn.cssOriginal;
					}
					if(jQuery('#<?php echo $this->sliderHtmlID?>').bannerRotator == undefined) {
						bannerrotator_showDoubleJqueryError('#<?php echo $this->sliderHtmlID?>');
					} else {
						bannerapi<?php echo $sliderID?> = jQuery('#<?php echo $this->sliderHtmlID?>').show().bannerRotator({
							startWidth:<?php echo $this->slider->getParam("width","960")?>,
							startHeight:<?php echo $this->slider->getParam("height","400")?>,
							autoPlay:<?php echo $this->slider->getParam("autoPlay","true") ?>,
							playOnce:<?php echo $this->slider->getParam("playOnce","false") ?>,
							selectOnHover:<?php echo $this->slider->getParam("selectOnHover","false") ?>,
							randomize:<?php echo $this->slider->getParam("randomize","false") ?>,
							delay:<?php echo $this->slider->getParam("delay","5000")?>,	
							showButton:<?php echo $this->slider->getParam("showButton","true")?>,
							showNumber:<?php echo $this->slider->getParam("showNumber","true")?>,
							showPlayPauseButton:<?php echo $this->slider->getParam("showPlayPauseButton","true")?>,
							showPreviousNextArrow:<?php echo $this->slider->getParam("showPreviousNextArrow","false")?>,
							showCenterPreviousNextArrow:<?php echo $this->slider->getParam("showCenterPreviousNextArrow","true")?>,
							showButtonOnHover:<?php echo $this->slider->getParam("showButtonOnHover","false")?>,
							buttonAlign:"<?php echo $this->slider->getParam("buttonAlign","BR")?>",
							buttonWidth:<?php echo $this->slider->getParam("buttonWidth","20")?>,
							buttonHeight:<?php echo $this->slider->getParam("buttonHeight","20")?>,
							buttonBorderRadius:<?php echo $this->slider->getParam("buttonBorderRadius","2")?>,
							buttonMargin:<?php echo $this->slider->getParam("buttonMargin","1")?>,
							buttonOffsetHorizontal:<?php echo $this->slider->getParam("buttonOffsetHorizontal","10")?>,
							buttonOffsetVertical:<?php echo $this->slider->getParam("buttonOffsetVertical","10")?>,
							touchEnabled:<?php echo $this->slider->getParam("touchEnabled","true")?>,
							showThumb:<?php echo $this->slider->getParam("showThumb","false")?>,
							thumbWidth:<?php echo $this->slider->getParam("thumbWidth","72")?>,
							thumbHeight:<?php echo $this->slider->getParam("thumbHeight","54")?>,
							showTimer:<?php echo $this->slider->getParam("showTimer","true")?>,
							timerType:"<?php echo $this->slider->getParam("timerType","clock")?>",
							timerArcSize:<?php echo $this->slider->getParam("timerArcSize","2")?>,
							timerAlign:"<?php echo $this->slider->getParam("timerAlign","top")?>",
							pauseOnHover:<?php echo $this->slider->getParam("pauseOnHover","false")?>,
							shadow:<?php echo $this->slider->getParam("shadow","2")?>,
							showTooltip:<?php echo $this->slider->getParam("showTooltip","true")?>,
							tooltipType:"<?php echo $this->slider->getParam("tooltipType","image")?>",
							hideCaptionAtResolution:<?php echo $this->slider->getParam("hideCaptionAtResolution","0")?>,	
							captionEasing:"<?php echo $this->slider->getParam("captionEasing","easeOutQuint")?>",
							currentItem:<?php echo $this->slider->getParam("currentItem","0")?>,
							scrollMouseWheel:<?php echo $this->slider->getParam("scrollMouseWheel","true")?>,
							fullWidth:<?php echo $this->slider->getParam("fullWidth","false")?>
						});
					}				
				});			
			</script>
			
			<?php			
		}
		
		
		//Put inline error message in a box.
		private function putErrorMessage($message) {
			?>
			<div style="width:800px;height:300px;margin-bottom:10px;border:1px solid black;">
				<div style="padding-top:40px;color:red;font-size:16px;text-align:center;">
					Banner Rotator Error: <?php echo $message?> 
				</div>
			</div>
			<?php 
		}
		
		//Fill the responsitive slider values for further output
		private function getResponsitiveValues() {
			$sliderWidth = (int)$this->slider->getParam("width");
			$sliderHeight = (int)$this->slider->getParam("height");	
					
			$percent = $sliderHeight / $sliderWidth;
			
			$w1 = (int) $this->slider->getParam("responsitive_w1",0);
			$w2 = (int) $this->slider->getParam("responsitive_w2",0);
			$w3 = (int) $this->slider->getParam("responsitive_w3",0);
			$w4 = (int) $this->slider->getParam("responsitive_w4",0);
			$w5 = (int) $this->slider->getParam("responsitive_w5",0);
			$w6 = (int) $this->slider->getParam("responsitive_w6",0);
			
			$sw1 = (int) $this->slider->getParam("responsitive_sw1",0);
			$sw2 = (int) $this->slider->getParam("responsitive_sw2",0);
			$sw3 = (int) $this->slider->getParam("responsitive_sw3",0);
			$sw4 = (int) $this->slider->getParam("responsitive_sw4",0);
			$sw5 = (int) $this->slider->getParam("responsitive_sw5",0);
			$sw6 = (int) $this->slider->getParam("responsitive_sw6",0);
			
			$arrItems = array();
			
			//Add main item
			$arr = array();				
			$arr["maxWidth"] = -1;
			$arr["minWidth"] = $w1;
			$arr["sliderWidth"] = $sliderWidth;
			$arr["sliderHeight"] = $sliderHeight;
			$arrItems[] = $arr;
			
			//Add item 1
			if(empty($w1)) return($arrItems);
				
			$arr = array();				
			$arr["maxWidth"] = $w1-1;
			$arr["minWidth"] = $w2;
			$arr["sliderWidth"] = $sw1;
			$arr["sliderHeight"] = floor($sw1 * $percent);
			$arrItems[] = $arr;
			
			//Add item 2
			if(empty($w2)) return($arrItems);
			
			$arr["maxWidth"] = $w2-1;
			$arr["minWidth"] = $w3;
			$arr["sliderWidth"] = $sw2;
			$arr["sliderHeight"] = floor($sw2 * $percent);
			$arrItems[] = $arr;
			
			//Add item 3
			if(empty($w3)) return($arrItems);
			
			$arr["maxWidth"] = $w3-1;
			$arr["minWidth"] = $w4;
			$arr["sliderWidth"] = $sw3;
			$arr["sliderHeight"] = floor($sw3 * $percent);
			$arrItems[] = $arr;
			
			//Add item 4
			if(empty($w4)) return($arrItems);
			
			$arr["maxWidth"] = $w4-1;
			$arr["minWidth"] = $w5;
			$arr["sliderWidth"] = $sw4;
			$arr["sliderHeight"] = floor($sw4 * $percent);
			$arrItems[] = $arr;

			//Add item 5
			if(empty($w5)) return($arrItems);
			
			$arr["maxWidth"] = $w5-1;
			$arr["minWidth"] = $w6;
			$arr["sliderWidth"] = $sw5;
			$arr["sliderHeight"] = floor($sw5 * $percent);
			$arrItems[] = $arr;
			
			//Add item 6
			if(empty($w6)) return($arrItems);
			
			$arr["maxWidth"] = $w6-1;
			$arr["minWidth"] = 0;
			$arr["sliderWidth"] = $sw6;
			$arr["sliderHeight"] = floor($sw6 * $percent);
			$arrItems[] = $arr;
			
			return($arrItems);
		}		
		
		//Put responsitive inline styles
		private function putResponsitiveStyles() {
			$bannerWidth = $this->slider->getParam("width");
			$bannerHeight = $this->slider->getParam("height");			
			$arrItems = $this->getResponsitiveValues();			
			?>
			<style type='text/css'>
				#<?php echo $this->sliderHtmlID?>, #<?php echo $this->sliderHtmlID_wrapper?> { width:<?php echo $bannerWidth?>px; height:<?php echo $bannerHeight?>px;}
			<?php
			foreach($arrItems as $item) {			
				$strMaxWidth = "";				
				if($item["maxWidth"] >= 0) {
					$strMaxWidth = "and (max-width: {$item["maxWidth"]}px)";
				}
			?>			
			   @media only screen and (min-width: <?php echo $item["minWidth"]?>px) <?php echo $strMaxWidth?> {
			 		  #<?php echo $this->sliderHtmlID?>, #<?php echo $this->sliderHtmlID_wrapper?> { width:<?php echo $item["sliderWidth"]?>px; height:<?php echo $item["sliderHeight"]?>px;}	
			   }
			
			<?php 
			}
			echo "</style>";
		}
		
		//Modify slider settings for preview mode
		private function modifyPreviewModeSettings() {
			$params = $this->slider->getParams();
			$params["jsToBody"] = "false";			
			$this->slider->setParams($params);
		}		
		
		//Put html slider on the html page
		//@param $data - mixed, can be ID or Alias		
		public function putSliderBase($sliderID) {			
			try {
				self::$sliderSerial++;				
				$this->slider = new BannerRotator();
				$this->slider->initByMixed($sliderID);
				
				//Modify settings for admin preview mode
				if($this->previewMode == true) {
					$this->modifyPreviewModeSettings();
				}
				
				//Edit html before slider
				$htmlBeforeSlider = "";
				if($this->slider->getParam("loadGoogleFont","false") == "true") {
					$googleFont = $this->slider->getParam("googleFont");
					$htmlBeforeSlider = "<link rel='stylesheet' id='banner-google-font' href='http://fonts.googleapis.com/css?family={$googleFont}' type='text/css' media='all' />";
				}
				
				//pub js to body handle
				if($this->slider->getParam("jsToBody","false") == "true") {
					$urlIncludeJS1 = UniteBaseClassBanner::$url_plugin."js/jquery.flashblue-plugins.js";
					$urlIncludeJS2 = UniteBaseClassBanner::$url_plugin."js/jquery.banner-rotator.js";
					$htmlBeforeSlider .= "<script type='text/javascript' src='$urlIncludeJS1'></script>";
					$htmlBeforeSlider .= "<script type='text/javascript' src='$urlIncludeJS2'></script>";
				}
				
				//The initial id can be alias
				$sliderID = $this->slider->getID();				
				$bannerWidth = $this->slider->getParam("width",null,BannerRotator::VALIDATE_NUMERIC,"Slider Width");
				$bannerHeight = $this->slider->getParam("height",null,BannerRotator::VALIDATE_NUMERIC,"Slider Height");				
				$sliderType = $this->slider->getParam("slider_type");
				
				//Set wrapper height
				$wrapperHeight = 0;
				$wrapperHeight += $this->slider->getParam("height");
				
				$this->sliderHtmlID = "banner_rotator_".$sliderID."_".self::$sliderSerial;
				$this->sliderHtmlID_wrapper = $this->sliderHtmlID."_wrapper";				
				$containerStyle = "";
				
				//Set position
				$sliderPosition = $this->slider->getParam("position","center");
				switch($sliderPosition){
					case "center":
					default:
						$containerStyle .= "margin:0px auto;";
						break;
					case "left":
						$containerStyle .= "float:left;";
						break;
					case "right":
						$containerStyle .= "float:right;";
						break;
				}
				
				//Add background color
				$backgroundColor = trim($this->slider->getParam("backgroundColor"));
				if(!empty($backgroundColor))
					$containerStyle .= "background-color:$backgroundColor;";
								
				//Set padding			
				$containerStyle .= "padding:".$this->slider->getParam("padding","0")."px;";
					
				//Set margin
				if($sliderPosition != "center"){
					$containerStyle .= "margin-left:".$this->slider->getParam("marginLeft","0")."px;";
					$containerStyle .= "margin-right:".$this->slider->getParam("marginRight","0")."px;";
				}				
				$containerStyle .= "margin-top:".$this->slider->getParam("marginTop","0")."px;";
				$containerStyle .= "margin-bottom:".$this->slider->getParam("marginBottom","0")."px;";
									
				//Set height and width
				$bannerStyle = "display:none;";	
				
				//Add background image (to banner style)
				$showBackgroundImage = $this->slider->getParam("showBackgroundImage","false");
				if($showBackgroundImage == "true"){					
					$backgroundImage = $this->slider->getParam("background_image");					
					if(!empty($backgroundImage))
						$bannerStyle .= "background-image:url($backgroundImage);background-repeat:no-repeat;";
				}
				
				//Set wrapper and slider class:
				$sliderWrapperClass = "banner-rotator-wrapper";
				$sliderClass = "banner-rotator";				
				$putResponsiveStyles = false;				
				switch($sliderType){
					default:
					case "responsitive":
						$sliderWrapperClass .= " responsive";	
						$putResponsiveStyles = true;				
						break;
					case "fullwidth":
						$sliderWrapperClass .= " fullwidthbanner-container";
						$sliderClass .= " fullwidthbanner";
						$bannerStyle .= "max-height:{$bannerHeight}px;height:{$bannerHeight};";
						$containerStyle .= "max-height:{$bannerHeight}px;";						
						break;
					case "fixed":
						$sliderWrapperClass .= " bannercontainer-fixed";
						$sliderClass .= " banner-fixed";
						$bannerStyle .= "height:{$bannerHeight}px;width:{$bannerWidth}px;";
						$containerStyle .= "height:{$bannerHeight}px;width:{$bannerWidth}px;";
						break;
				}				
				
				//Check inner / outer border
				$paddingType = $this->slider->getParam("padding_type","outter");
				if($paddingType == "inner") {
					$sliderWrapperClass .= " tp_inner_padding"; 
				}
				global $bannerRotatorVersion;				
				?>
				
				<!-- START BANNER ROTATOR <?php echo $bannerRotatorVersion?> -->				
				<?php if($putResponsiveStyles == true) $this->putResponsitiveStyles(); ?>				
				<?php echo $htmlBeforeSlider?>
				<div id="<?php echo $this->sliderHtmlID_wrapper?>" class="<?php echo $sliderWrapperClass?>" style="<?php echo $containerStyle?>">
					<div id="<?php echo $this->sliderHtmlID ?>" class="<?php echo $sliderClass?>" style="<?php echo $bannerStyle?>">						
						<?php $this->putSlides()?>
						<?php echo $htmlTimerBar?>
					</div>
				</div>				
				<?php $this->putJS();?>
				<!-- END BANNER ROTATOR -->
				<?php 				
			} catch(Exception $e) {
				$message = $e->getMessage();
				$this->putErrorMessage($message);
			}
			
		}		
		
	}
?>