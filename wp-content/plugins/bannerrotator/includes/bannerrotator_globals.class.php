<?php
	class GlobalsBannerRotator {		
		const SHOW_SLIDER_TO = "admin";		//Options: admin, editor, author		
		const TABLE_SLIDERS_NAME = "bannerrotator_sliders";
		const TABLE_SLIDES_NAME = "bannerrotator_slides";
		const FIELDS_SLIDE = "slider_id,slide_order,params,layers";
		const FIELDS_SLIDER = "title,alias,params";		
		public static $table_sliders;
		public static $table_slides;						
		public static $filepath_captions;
		public static $filepath_captions_original;
		public static $urlCaptionsCSS;
	}
?>