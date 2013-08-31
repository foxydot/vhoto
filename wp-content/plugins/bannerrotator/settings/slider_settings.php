<?php	
	//Set "slider_main" settings
	$sliderMainSettings = new UniteSettingsAdvancedBanner();
	$sliderMainSettings->addTextBox("title", "","Slider Title",array("description"=>"The title of the slider. Example: Slider1","required"=>"true"));	
	$sliderMainSettings->addTextBox("alias", "","Slider Alias",array("description"=>"The alias that will be used for embedding the slider. Example: slider1","required"=>"true"));
	$sliderMainSettings->addTextBox("shortcode", "","Slider Short Code",array("readonly"=>true,"class"=>"code"));
	$sliderMainSettings->addHr();
	
	$sliderMainSettings->addRadio("slider_type", array("responsitive"=>"Responsive","fullwidth"=>"Full Width","fixed"=>"Fixed"),"Slider Type","responsitive");
	
	$paramsSize = array("width"=>960,"height"=>400);	
	$sliderMainSettings->addCustom("slider_size", "slider_size","","Slider Size",$paramsSize);
	
	$paramsResponsitive = array("w1"=>959,"sw1"=>760,"w2"=>767,"sw2"=>480,"w3"=>479,"sw3"=>320);
	$sliderMainSettings->addCustom("responsitive_settings", "responsitive","","Responsive Sizes",$paramsResponsitive);
	$sliderMainSettings->addHr();
	
	self::storeSettings("slider_main",$sliderMainSettings);
	
	//Set "slider_params" settings
	$sliderParamsSettings = new UniteSettingsAdvancedBanner();	
	$sliderParamsSettings->loadXMLFile(self::$path_settings."/slider_settings.xml");
	self::storeSettings("slider_params",$sliderParamsSettings);	
?>