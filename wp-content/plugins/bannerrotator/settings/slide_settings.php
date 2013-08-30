<?php	
	//Set Slide settings
	$arrTransitions = $operations->getArrTransition();	
	$arrSlideNames = $slider->getArrSlideNames();	
	$slideSettings = new UniteSettingsAdvancedBanner();
	 
	//Transition
	$params = array("description"=>"The appearance transition of this slide.");
	$slideSettings->addSelect("slide_transition",$arrTransitions,"Transition","random",$params);
		
	//Delay	
	$params = array("description"=>"A new delay value for the Slide. If no delay defined per slide, the delay defined via Options ( $sliderDelay ms) will be used"
		,"class"=>"small"
	);
	$slideSettings->addTextBox("delay","","Delay", $params);
		
	//Enable link
	$slideSettings->addSelect_boolean("enable_link", "Enable Link", false, "Enable","Disable");	
	$slideSettings->startBulkControl("enable_link", UniteSettingsBanner::CONTROL_TYPE_SHOW, "true");
	
	//Link type
	$slideSettings->addRadio("link_type", array("regular"=>"Regular","slide"=>"To Slide"), "Link Type","regular");
	
	//Link	
	$params = array("description"=>"A link on the whole slide pic");
	$slideSettings->addTextBox("link","","Slide Link", $params);
	
	//Link target
	$params = array("description"=>"The target of the slide link");
	$slideSettings->addSelect("link_open_in",array("same"=>"Same Window","new"=>"New Window"),"Link Open In","same",$params);
	
	//Link to slide
	$arrSlideLink = array("nothing"=>"-- Not Chosen --","next"=>"-- Next Slide --","prev"=>"-- Previous Slide --");		
	foreach($arrSlideNames as $slideNameID=>$slideName) {
		$arrSlideLink[$slideNameID] = $slideName;
	}
	$slideSettings->addSelect("slide_link", $arrSlideLink, "Link To Slide","nothing");	
	$params = array("description"=>"The position of the link related to layers");
	$slideSettings->addRadio("link_pos", array("front"=>"Front","back"=>"Back"), "Link Position","front",$params);	
	$slideSettings->addHr("link_sap");		
	$slideSettings->endBulkControl();		
	$slideSettings->addControl("link_type", "slide_link", UniteSettingsBanner::CONTROL_TYPE_ENABLE, "slide");
	$slideSettings->addControl("link_type", "link", UniteSettingsBanner::CONTROL_TYPE_DISABLE, "slide");
	$slideSettings->addControl("link_type", "link_open_in", UniteSettingsBanner::CONTROL_TYPE_DISABLE, "slide");
		
	//Enable video
	$params = array("description"=>"Put a full width video on the slide");
	$slideSettings->addSelect_boolean("enable_video", "Enable Full Width Video", false, "Enable","Disable");
	
	//Video ID	
	$params = array("description"=>"The field can take Youtube ID (example: yXIipcqq0w8) or Vimeo ID (example: 41178425)", "class"=>"medium-text");
	$slideSettings->addTextBox("video_id","","Video ID", $params);

	//Video autoplay
	$params = array("description"=>"Enable video autoplay on enter slide", "class"=>"medium-text");
	$slideSettings->addCheckbox("video_play_button", true,"Video Play Button");
	$slideSettings->addCheckbox("video_autoplay", false,"Video Autoplay");
	$slideSettings->addControl("enable_video", "video_id", UniteSettingsBanner::CONTROL_TYPE_SHOW, "true");
	$slideSettings->addControl("enable_video", "video_play_button", UniteSettingsBanner::CONTROL_TYPE_SHOW, "true");	
	$slideSettings->addControl("enable_video", "video_autoplay", UniteSettingsBanner::CONTROL_TYPE_SHOW, "true");	
	$params = array("description"=>"Slide Thumbnail. If not set - it will be taken from the slide image.");
	$slideSettings->addImage("slide_thumb", "","Thumbnail" , $params);
	
	//Store settings
	self::storeSettings("slide_settings",$slideSettings);
?>
