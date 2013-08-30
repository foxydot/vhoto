<?php 
	/*
	Plugin Name: Banner Rotator
	Plugin URI: http://www.codegrape.com/item/circular-countdown-jquery-plugin/2038
	Description: jQuery banner rotator plugin featuring multiple transitions that supports text effects for captions. 
	Author: flashblue
	Version: 1.0.0
	Author URI: http://www.codegrape.com/user/flashblue
	*/
	
	$bannerRotatorVersion = "1.0.0";
	$currentFile = __FILE__;
	$currentFolder = dirname($currentFile);
	
	//Include framework files
	require_once $currentFolder.'/includes/framework.php';
	
	//Include bases
	require_once $folderIncludes.'base.class.php';
	require_once $folderIncludes.'elements_base.class.php';
	require_once $folderIncludes.'base_admin.class.php';
	require_once $folderIncludes.'base_front.class.php';
	
	//Include product files
	require_once $currentFolder.'/includes/bannerrotator_settings_product.class.php';
	require_once $currentFolder.'/includes/bannerrotator_globals.class.php';
	require_once $currentFolder.'/includes/bannerrotator_operations.class.php';
	require_once $currentFolder.'/includes/bannerrotator_slider.class.php';
	require_once $currentFolder.'/includes/bannerrotator_output.class.php';
	require_once $currentFolder.'/includes/bannerrotator_slide.class.php';
	require_once $currentFolder.'/includes/bannerrotator_widget.class.php';	
	
	try {		
		//Register banner rotator widget	
		UniteFunctionsWPBanner::registerWidget("BannerRotator_Widget");
		
		//Add shortcode
		function banner_rotator_shortcode($args){					
			$sliderAlias = UniteFunctionsBanner::getVal($args,0);
			ob_start();
			$slider = BannerRotatorOutput::putSlider($sliderAlias);
			$content = ob_get_contents();
			ob_clean();
			ob_end_clean();			
			//Handle slider output types
			if(!empty($slider)) {
				$outputType = $slider->getParam("outputType","");
				switch($outputType){
					case "compress":
						$content = str_replace("\n", "", $content);
						$content = str_replace("\r", "", $content);
						return($content);
					break;
					case "echo":
						echo $content;		//Bypass the filters
					break;
					default:
						return($content);
					break;
				}
			} else {
				return($content);		//Normal output
			}				
		}
		
		add_shortcode('banner_rotator', 'banner_rotator_shortcode');		
		
		if(is_admin()) {		
			//Load admin part
			require_once $currentFolder."/bannerrotator_admin.php";			
			$productAdmin = new BannerRotatorAdmin($currentFile);			
		} else {		
			//Load front part			
			/*
			 * Put banner rotator on the page.
			 * The data can be slider ID or slider alias.
			 */
			function putBannerRotator($data, $putIn ="") {
				BannerRotatorOutput::putSlider($data,$putIn);
			}			
			require_once $currentFolder."/bannerrotator_front.php";
			$productFront = new BannerRotatorFront($currentFile);
		}		
	} catch(Exception $e) {
		$message = $e->getMessage();
		$trace = $e->getTraceAsString();
		echo "Banner Rotator Error: <b>".$message."</b>";
	}
	
