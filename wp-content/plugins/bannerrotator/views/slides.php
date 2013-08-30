<?php	
	$sliderID = self::getGetVar("id");	
	if(empty($sliderID)) {
		UniteFunctionsBanner::throwError("Slider ID not found"); 
	}
	$slider = new BannerRotator();
	$slider->initByID($sliderID);	
	$arrSlides = $slider->getSlides();
	$numSlides = count($arrSlides);	
	$linksSliderSettings = self::getViewUrl(BannerRotatorAdmin::VIEW_SLIDER,"id=$sliderID");	
	require self::getPathTemplate("slides");	
?>

	