<?php 
	$operations = new BannerOperations();

	//Set Layer settings	
	$contentCSS = $operations->getCaptionsContent();
	$arrAnimations = $operations->getArrAnimations();
	$arrEndAnimations = $operations->getArrEndAnimations();	
	$htmlButtonDown = '<div id="layer_captions_down" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-arrowthick-1-s"></span></div>';
	$buttonEditStyles = UniteFunctionsBanner::getHtmlLink("javascript:void(0)", "Edit CSS File","button_edit_css","button-secondary");
	$arrEasing = $operations->getArrEasing();
	$arrEndEasing = $operations->getArrEndEasing();	
	$captionsAddonHtml = $htmlButtonDown.$buttonEditStyles;
	
	//Set Layer settings
	$layerSettings = new UniteSettingsAdvancedBanner();
	$layerSettings->addSection("Layer Params","layer_params");
	$layerSettings->addSap("Layer Params","layer_params");
	$layerSettings->addTextBox("layer_caption", "caption_green", "Style",array(UniteSettingsBanner::PARAM_ADDTEXT=>$captionsAddonHtml,"class"=>"textbox-caption"));	
	$addHtmlTextarea = UniteFunctionsBanner::getHtmlLink("javascript:void(0)", "insert button","linkInsertButton","disabled");	
	$layerSettings->addTextArea("layer_text", "","Text / Html",array("class"=>"area-layer-params",UniteSettingsBanner::PARAM_ADDTEXT_BEFORE_ELEMENT=>$addHtmlTextarea));
	$layerSettings->addTextBox("layer_image_link", "","Image Link",array("class"=>"text-sidebar-link","hidden"=>true));
	$layerSettings->addSelect("layer_link_open_in",array("same"=>"Same Window","new"=>"New Window"),"Link Open In","same",array("hidden"=>true));		
	$layerSettings->addSelect("layer_animation",$arrAnimations,"Animation","fade");	
	$layerSettings->addSelect("layer_easing", $arrEasing, "Easing","easeOutQuint");
	$params = array("unit"=>"ms");
	$layerSettings->addTextBox("layer_speed", "","Speed",$params);
	$layerSettings->addCheckbox("layer_hidden", false,"Hide Under Width");	
	$layerSettings->addTextBox("layer_left", "","X");
	$layerSettings->addTextBox("layer_top", "","Y");
	$layerSettings->addCheckbox("layer_video_autoplay", false,"Video Autoplay");
	$layerSettings->addSelect("layer_slide_link", $arrSlideLink, "Link To Slide","nothing");
	$layerSettings->addButton("button_edit_video", "Edit Video",array("hidden"=>true));	
	$params = array("unit"=>"ms");
	$layerSettings->addTextBox("layer_endtime", "","End Time",$params);
	$layerSettings->addTextBox("layer_endspeed", "","End Speed",$params);
	$layerSettings->addSelect("layer_endanimation",$arrEndAnimations,"Animation","auto");
	$layerSettings->addSelect("layer_endeasing", $arrEndEasing, "Easing","nothing");
	$params = array("unit"=>"ms");	
	self::storeSettings("layer_settings",$layerSettings);
	
	//Store settings of content css for editing on the client
	self::storeSettings("css_captions_content",$contentCSS);	
?>