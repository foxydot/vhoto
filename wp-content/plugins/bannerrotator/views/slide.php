<?php
	//Get input
	$slideID = UniteFunctionsBanner::getGetVar("id");
	
	//Init slide object
	$slide = new BannerSlide();
	$slide->initByID($slideID);
	$slideParams = $slide->getParams();	
	$operations = new BannerOperations();
	
	//Init slider object
	$sliderID = $slide->getSliderID();
	$slider = new BannerRotator();
	$slider->initByID($sliderID);
	$sliderParams = $slider->getParams();
	
	//Set slide delay
	$sliderDelay = $slider->getParam("delay","9000");
	$slideDelay = $slide->getParam("delay","");
	if(empty($slideDelay)) {$slideDelay = $sliderDelay;}	
	require self::getSettingsFilePath("slide_settings");
	require self::getSettingsFilePath("layer_settings");	
	$settingsLayerOutput = new UniteSettingsProductSidebarBanner();
	$settingsSlideOutput = new UniteSettingsBannerProductBanner();		
	$arrLayers = $slide->getLayers();
	
	//Get settings objects
	$settingsLayer = self::getSettings("layer_settings");	
	$settingsSlide = self::getSettings("slide_settings");	
	$cssContent = self::getSettings("css_captions_content");
	$arrCaptionClasses = $operations->getArrCaptionClasses($cssContent);	
	$arrButtonClasses = $operations->getButtonClasses();
	
	//Set layer caption as first caption class
	$firstCaption = !empty($arrCaptionClasses)?$arrCaptionClasses[0]:"";
	$settingsLayer->updateSettingValue("layer_caption",$firstCaption);
	
	//Set stored values from "slide params"
	$settingsSlide->setStoredValues($slideParams);
		
	//Init the settings output object
	$settingsLayerOutput->init($settingsLayer);
	$settingsSlideOutput->init($settingsSlide);
	
	//Set various parameters needed for the page
	$width = $sliderParams["width"];
	$height = $sliderParams["height"];
	$imageUrl = $slide->getImageUrl();	
	$imageFilename = $slide->getImageFilename();
	$urlCaptionsCSS = GlobalsBannerRotator::$urlCaptionsCSS;	
	$style = "width:{$width}px;height:{$height}px;background-image:url('$imageUrl')";
	
	//Set iframe parameters
	$iframeWidth = $width+60;
	$iframeHeight = $height+80;	
	$iframeStyle = "width:{$iframeWidth}px;height:{$iframeHeight}px;";	
	$closeUrl = self::getViewUrl(BannerRotatorAdmin::VIEW_SLIDES,"id=".$sliderID);	
	$jsonLayers = UniteFunctionsBanner::jsonEncodeForClientSide($arrLayers);
	$jsonCaptions = UniteFunctionsBanner::jsonEncodeForClientSide($arrCaptionClasses);	
	$loadGoogleFont = $slider->getParam("load_googlefont","false");	
	require self::getPathTemplate("slide");
?>
	
