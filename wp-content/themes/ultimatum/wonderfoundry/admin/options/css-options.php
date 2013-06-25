<?php
$aitself='';
$tagline='';
$opt = get_option(THEME_SLUG.'_general');
if($opt[text_logo]==1){
$aitself=array (
		"name"	=> __("Site Logo",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar108",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '36',
						"line-height" => '42',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
		);
$tagline= array (
		"name"	=> __("Tag Line",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar109",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
		)
		;	
}
$options = array(
	array(
		"name" => __("General",THEME_ADMIN_LANG_DOMAIN).'',
		"type" => "title"
	),
	array(
		"name" => __("Background Color and Image",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Body Background Color",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "Select your desired backround color for the body delete the text box content for transparent.",
			"id" => "cssvar1",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
		array(
			"name" => __("Background Image",THEME_ADMIN_LANG_DOMAIN),
			"desc" =>__( "Paste the full URL (include http://) of image here or you can insert the image through the button. To remove image just delete the text in field.",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar1",
			"property" => "background-image",
			"default" => "",
			"type" => "uploadCSS"
		),
		array(
			"name" => __("Image Location",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar1",
			"property" => "background-position",
			"default" => "top left",
			"options" => array("top left"=>__('Top Left',THEME_ADMIN_LANG_DOMAIN),
								"top right"=>__('Top Right',THEME_ADMIN_LANG_DOMAIN),
								"top center"=>__('Top Center',THEME_ADMIN_LANG_DOMAIN),
								"bottom left"=>__('Bottom Left',THEME_ADMIN_LANG_DOMAIN),
								"bottom right"=>__('Bottom Right',THEME_ADMIN_LANG_DOMAIN),
								"bottom center"=>__('Bottom Center',THEME_ADMIN_LANG_DOMAIN),
			),
			"type" => "selectCSS"
		),
		array(
			"name" => __("Image Repeat",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar1",
			"property" => "background-repeat",
			"default" => "repeat",
			"options" => array("repeat"=>__('Repeat',THEME_ADMIN_LANG_DOMAIN),
								"repeat-x"=>__('Repeat Horizontal',THEME_ADMIN_LANG_DOMAIN),
								"repeat-y"=>__('Repeat Vertical',THEME_ADMIN_LANG_DOMAIN),
								"no-repeat"=>__('Do not Repeat',THEME_ADMIN_LANG_DOMAIN),
			),
			"type" => "selectCSS"
		),
		
	array(
		"type" => "end"
	),
	array(
		"name" => __("Logo",THEME_ADMIN_LANG_DOMAIN),
		"type" => "title"
	),
	array(
		"name" => __("Margins",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Margin-Top ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar2",
			"property" =>"margin-top",
			"default" => "0",
			"type" => "textCSS",
		),
	array(
			"name" => __("Margin-Bottom ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar2",
			"property" =>"margin-bottom",
			"default" => "0",
			"type" => "textCSS",
		),
	array(
		"type" => "endnosave"
	),
	array(
		"name" => __("This part is enabled only if you selected Logo as Text in general Settings",THEME_ADMIN_LANG_DOMAIN),
		"type" => "explain"
	),
	array (
		"type" => "txtElementHead",
	),
	$aitself,
	$tagline,
	array(
		"type" => "end"
	),
	array(
		"name" => __("Basic Fonts and Colors",THEME_ADMIN_LANG_DOMAIN),
		"type" => "title"
	),
	array(
		"name" => __("The fonts available below (and throughout the system) are standard web fonts and the fonts enabled from Font Library",THEME_ADMIN_LANG_DOMAIN),
		"type" => "explain"
	),
	array (
		"type" => "txtElementHead",
	),
	array (
		"name"	=> "General",
		"type"	=> "txtElement",
		"id"	=> "cssvar1",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
				
	),
	array (
		"name"	=> "H1",
		"type"	=> "txtElement",
		"id"	=> "cssvar3",
		"default" => array(
						"font-family" => 'google-Yanone Kaffeesatz-css-Yanone Kaffeesatz:400,700',
						"font-size" => '36',
						"line-height" => '42',
						"color" => "000000",
						"font-weight" => "bold",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> "H2",
		"type"	=> "txtElement",
		"id"	=> "cssvar4",
		"default" => array(
						"font-family" => 'google-Yanone Kaffeesatz-css-Yanone Kaffeesatz:400,700',
						"font-size" => '30',
						"line-height" => '36',
						"color" => "000000",
						"font-weight" => "bold",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> "H3",
		"type"	=> "txtElement",
		"id"	=> "cssvar5",
		"default" => array(
						"font-family" => 'google-Yanone Kaffeesatz-css-Yanone Kaffeesatz:400,700',
						"font-size" => '24',
						"line-height" => '30',
						"color" => "000000",
						"font-weight" => "bold",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> "H4",
		"type"	=> "txtElement",
		"id"	=> "cssvar6",
		"default" => array(
						"font-family" => 'google-Yanone Kaffeesatz-css-Yanone Kaffeesatz:400,700',
						"font-size" => '18',
						"line-height" => '24',
						"color" => "000000",
						"font-weight" => "bold",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> "H5",
		"type"	=> "txtElement",
		"id"	=> "cssvar7",
		"default" => array(
						"font-family" => 'google-Yanone Kaffeesatz-css-Yanone Kaffeesatz:400,700',
						"font-size" => '14',
						"line-height" => '18',
						"color" => "000000",
						"font-weight" => "bold",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> "H6",
		"type"	=> "txtElement",
		"id"	=> "cssvar8",
		"default" => array(
						"font-family" => 'google-Yanone Kaffeesatz-css-Yanone Kaffeesatz:400,700',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "bold",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> "Quotes",
		"type"	=> "txtElement",
		"id"	=> "cssvar110",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '16',
						"line-height" => '24',
						"color" => "000000",
						"font-weight" => "bold",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> "links",
		"type"	=> "txtElement",
		"id"	=> "cssvar9",
		"default" => array(
						"color" => "000000",
						"font-weight" => "bold",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
	),
	array (
		"name"	=> "links hover",
		"type"	=> "txtElement",
		"id"	=> "cssvar10",
		"default" => array(
						"color" => "000000",
						"font-weight" => "bold",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
	),
	
	array(
		"type" => "end"
	),
	array(
		"name" => __("Post Elements <a name=\"postel\"></a>",THEME_ADMIN_LANG_DOMAIN).'',
		"type" => "title"
	),
	array(
		"name" => __("Backgrounds,Borders and Padding",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Archive Page Title Padding Left",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar11",
			"property" =>"padding-left",
			"default" => "0",
			"type" => "textCSS"
		),
	array(
			"name" => __("Archive Page Title Background Color",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar11",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
	array(
			"name" => __("Archive Page Title Background Image",THEME_ADMIN_LANG_DOMAIN),
			"desc" =>__( "Paste the full URL (include http://) of image here or you can insert the image through the button. To remove image just delete the text in field.",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar11",
			"property" => "background-image",
			"default" => "",
			"type" => "uploadCSS"
		),
	array(
			"name" => __("Archive Page Title Background Image Location",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar11",
			"property" => "background-position",
			"default" => "top left",
			"options" => array("top left"=>__('Top Left',THEME_ADMIN_LANG_DOMAIN),
								"top right"=>__('Top Right',THEME_ADMIN_LANG_DOMAIN),
								"top center"=>__('Top Center',THEME_ADMIN_LANG_DOMAIN),
								"bottom left"=>__('Bottom Left',THEME_ADMIN_LANG_DOMAIN),
								"bottom right"=>__('Bottom Right',THEME_ADMIN_LANG_DOMAIN),
								"bottom center"=>__('Bottom Center',THEME_ADMIN_LANG_DOMAIN),
			),
			"type" => "selectCSS"
		),
		array(
			"name" => __("Archive Page Title Background Image Repeat",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar11",
			"property" => "background-repeat",
			"default" => "repeat",
			"options" => array("repeat"=>__('Repeat',THEME_ADMIN_LANG_DOMAIN),
								"repeat-x"=>__('Repeat Horizontal',THEME_ADMIN_LANG_DOMAIN),
								"repeat-y"=>__('Repeat Vertical',THEME_ADMIN_LANG_DOMAIN),
								"no-repeat"=>__('Do not Repeat',THEME_ADMIN_LANG_DOMAIN),
			),
			"type" => "selectCSS"
		),
	array(
			"name" => __("Archive Page Title Border ",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar12",
			"property" =>"border-width",
			"default" => "none",
			"options" => array("0"=>__('None',THEME_ADMIN_LANG_DOMAIN),
								"1px 0 1px 0"=>__('Top and Bottom',THEME_ADMIN_LANG_DOMAIN),
								"1px 0 0 0"=>__('Only Top',THEME_ADMIN_LANG_DOMAIN),
								"0 0 1px 0"=>__('Only Bottom',THEME_ADMIN_LANG_DOMAIN),
								
			),
			"type" => "selectCSS"
		),
	array(
			"name" => __("Archive Page Title Border Style",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar12",
			"property" =>"border-style",
			"default" => "none",
			"options" => array("none"=>__('None',THEME_ADMIN_LANG_DOMAIN),
								"solid"=>__('Solid',THEME_ADMIN_LANG_DOMAIN),
								"dotted"=>__('Dotted',THEME_ADMIN_LANG_DOMAIN),
								"dashed"=>__('Dashed',THEME_ADMIN_LANG_DOMAIN),
								
			),
			"type" => "selectCSS"
		),
	array(
			"name" => __("Archive Page Title Border Color",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar12",
			"property" =>"border-color",
			"default" => "",
			"type" => "color"
		),
	array(
			"name" => __("Post Container Padding Top",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar13",
			"property" =>"padding-top",
			"default" => "0",
			"type" => "textCSS"
		),
	array(
			"name" => __("Post Container Padding Bottom",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar13",
			"property" =>"padding-bottom",
			"default" => "0",
			"type" => "textCSS"
		),
	array(
			"name" => __("Post Container Background Color",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar13",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
	array(
			"name" => __("Post Container Background Image",THEME_ADMIN_LANG_DOMAIN),
			"desc" =>__( "Paste the full URL (include http://) of image here or you can insert the image through the button. To remove image just delete the text in field.",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar13",
			"property" => "background-image",
			"default" => "",
			"type" => "uploadCSS"
		),
	array(
			"name" => __("Post Container Background Image Location",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar13",
			"property" => "background-position",
			"default" => "top left",
			"options" => array("top left"=>__('Top Left',THEME_ADMIN_LANG_DOMAIN),
								"top right"=>__('Top Right',THEME_ADMIN_LANG_DOMAIN),
								"top center"=>__('Top Center',THEME_ADMIN_LANG_DOMAIN),
								"bottom left"=>__('Bottom Left',THEME_ADMIN_LANG_DOMAIN),
								"bottom right"=>__('Bottom Right',THEME_ADMIN_LANG_DOMAIN),
								"bottom center"=>__('Bottom Center',THEME_ADMIN_LANG_DOMAIN),
			),
			"type" => "selectCSS"
		),
		array(
			"name" => __("Post Container Background Image Repeat",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar13",
			"property" => "background-repeat",
			"default" => "repeat",
			"options" => array("repeat"=>__('Repeat',THEME_ADMIN_LANG_DOMAIN),
								"repeat-x"=>__('Repeat Horizontal',THEME_ADMIN_LANG_DOMAIN),
								"repeat-y"=>__('Repeat Vertical',THEME_ADMIN_LANG_DOMAIN),
								"no-repeat"=>__('Do not Repeat',THEME_ADMIN_LANG_DOMAIN),
			),
			"type" => "selectCSS"
		),
	array(
			"name" => __("Post Container Border ",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar13",
			"property" =>"border-width",
			"default" => "none",
			"options" => array("0"=>__('None',THEME_ADMIN_LANG_DOMAIN),
								"1px 0 1px 0"=>__('Top and Bottom',THEME_ADMIN_LANG_DOMAIN),
								"1px 0 0 0"=>__('Only Top',THEME_ADMIN_LANG_DOMAIN),
								"0 0 1px 0"=>__('Only Bottom',THEME_ADMIN_LANG_DOMAIN),
								
			),
			"type" => "selectCSS"
		),
	array(
			"name" => __("Post Container Border Style",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar13",
			"property" =>"border-style",
			"default" => "none",
			"options" => array("none"=>__('None',THEME_ADMIN_LANG_DOMAIN),
								"solid"=>__('Solid',THEME_ADMIN_LANG_DOMAIN),
								"dotted"=>__('Dotted',THEME_ADMIN_LANG_DOMAIN),
								"dashed"=>__('Dashed',THEME_ADMIN_LANG_DOMAIN),
								
			),
			"type" => "selectCSS"
		),
	array(
			"name" => __("Post Container Border Color",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar14",
			"property" =>"border-color",
			"default" => "",
			"type" => "color"
		),
	array(
			"name" => __("Post Title Padding Left",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar15",
			"property" =>"padding-left",
			"default" => "0",
			"type" => "textCSS"
		),
	array(
			"name" => __("Post Title Background Color",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar15",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
	array(
			"name" => __("Post Title Background Image",THEME_ADMIN_LANG_DOMAIN),
			"desc" =>__( "Paste the full URL (include http://) of image here or you can insert the image through the button. To remove image just delete the text in field.",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar15",
			"property" => "background-image",
			"default" => "",
			"type" => "uploadCSS"
		),
	array(
			"name" => __("Post Title Background Image Location",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar15",
			"property" => "background-position",
			"default" => "top left",
			"options" => array("top left"=>__('Top Left',THEME_ADMIN_LANG_DOMAIN),
								"top right"=>__('Top Right',THEME_ADMIN_LANG_DOMAIN),
								"top center"=>__('Top Center',THEME_ADMIN_LANG_DOMAIN),
								"bottom left"=>__('Bottom Left',THEME_ADMIN_LANG_DOMAIN),
								"bottom right"=>__('Bottom Right',THEME_ADMIN_LANG_DOMAIN),
								"bottom center"=>__('Bottom Center',THEME_ADMIN_LANG_DOMAIN),
			),
			"type" => "selectCSS"
		),
		array(
			"name" => __("Post Title Background Image Repeat",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar15",
			"property" => "background-repeat",
			"default" => "repeat",
			"options" => array("repeat"=>__('Repeat',THEME_ADMIN_LANG_DOMAIN),
								"repeat-x"=>__('Repeat Horizontal',THEME_ADMIN_LANG_DOMAIN),
								"repeat-y"=>__('Repeat Vertical',THEME_ADMIN_LANG_DOMAIN),
								"no-repeat"=>__('Do not Repeat',THEME_ADMIN_LANG_DOMAIN),
			),
			"type" => "selectCSS"
		),
	array(
			"name" => __("Post Title Border ",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar15",
			"property" =>"border-width",
			"default" => "none",
			"options" => array("0"=>__('None',THEME_ADMIN_LANG_DOMAIN),
								"1px 0 1px 0"=>__('Top and Bottom',THEME_ADMIN_LANG_DOMAIN),
								"1px 0 0 0"=>__('Only Top',THEME_ADMIN_LANG_DOMAIN),
								"0 0 1px 0"=>__('Only Bottom',THEME_ADMIN_LANG_DOMAIN),
								
			),
			"type" => "selectCSS"
		),
	array(
			"name" => __("Post Title Border Style",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar15",
			"property" =>"border-style",
			"default" => "none",
			"options" => array("none"=>__('None',THEME_ADMIN_LANG_DOMAIN),
								"solid"=>__('Solid',THEME_ADMIN_LANG_DOMAIN),
								"dotted"=>__('Dotted',THEME_ADMIN_LANG_DOMAIN),
								"dashed"=>__('Dashed',THEME_ADMIN_LANG_DOMAIN),
								
			),
			"type" => "selectCSS"
		),
	array(
			"name" => __("Post Title Border Color",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar15",
			"property" =>"border-color",
			"default" => "",
			"type" => "color"
		),
		array(
			"name" => __("Meta Background Color",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar16",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
	array(
			"name" => __("Meta Background Image",THEME_ADMIN_LANG_DOMAIN),
			"desc" =>__( "Paste the full URL (include http://) of image here or you can insert the image through the button. To remove image just delete the text in field.",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar16",
			"property" => "background-image",
			"default" => "",
			"type" => "uploadCSS"
		),
	array(
			"name" => __("Meta Background Image Location",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar16",
			"property" => "background-position",
			"default" => "top left",
			"options" => array("top left"=>__('Top Left',THEME_ADMIN_LANG_DOMAIN),
								"top right"=>__('Top Right',THEME_ADMIN_LANG_DOMAIN),
								"top center"=>__('Top Center',THEME_ADMIN_LANG_DOMAIN),
								"bottom left"=>__('Bottom Left',THEME_ADMIN_LANG_DOMAIN),
								"bottom right"=>__('Bottom Right',THEME_ADMIN_LANG_DOMAIN),
								"bottom center"=>__('Bottom Center',THEME_ADMIN_LANG_DOMAIN),
			),
			"type" => "selectCSS"
		),
		array(
			"name" => __("Meta Background Image Repeat",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar16",
			"property" => "background-repeat",
			"default" => "repeat",
			"options" => array("repeat"=>__('Repeat',THEME_ADMIN_LANG_DOMAIN),
								"repeat-x"=>__('Repeat Horizontal',THEME_ADMIN_LANG_DOMAIN),
								"repeat-y"=>__('Repeat Vertical',THEME_ADMIN_LANG_DOMAIN),
								"no-repeat"=>__('Do not Repeat',THEME_ADMIN_LANG_DOMAIN),
			),
			"type" => "selectCSS"
		),
	array(
			"name" => __("Meta Border ",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar17",
			"property" =>"border-width",
			"default" => "none",
			"options" => array("0"=>__('None',THEME_ADMIN_LANG_DOMAIN),
								"1px 0 1px 0"=>__('Top and Bottom',THEME_ADMIN_LANG_DOMAIN),
								"1px 0 0 0"=>__('Only Top',THEME_ADMIN_LANG_DOMAIN),
								"0 0 1px 0"=>__('Only Bottom',THEME_ADMIN_LANG_DOMAIN),
								
			),
			"type" => "selectCSS"
		),
	array(
			"name" => __("Meta Border Style",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar17",
			"property" =>"border-style",
			"default" => "none",
			"options" => array("none"=>__('None',THEME_ADMIN_LANG_DOMAIN),
								"solid"=>__('Solid',THEME_ADMIN_LANG_DOMAIN),
								"dotted"=>__('Dotted',THEME_ADMIN_LANG_DOMAIN),
								"dashed"=>__('Dashed',THEME_ADMIN_LANG_DOMAIN),
								
			),
			"type" => "selectCSS"
		),
	array(
			"name" => __("Meta Border Color",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar17",
			"property" =>"border-color",
			"default" => "",
			"type" => "color"
		),
	array(
			"name" => __("Meta Padding Top",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar17",
			"property" =>"padding-top",
			"default" => "0",
			"type" => "textCSS"
		),
	array(
			"name" => __("Meta Padding Bottom",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar17",
			"property" =>"padding-bottom",
			"default" => "0",
			"type" => "textCSS"
		),
	array(
		"type" => "endnosave",
		),
	array (
		"type" => "txtElementHead",
	),
	array (
		"name"	=> __("Archive Title",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar11",
		"default" => array(
						"font-size" => '24',
						"line-height" => '30',
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> __("Entry Title",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar18",
		"default" => array(
						"font-size" => '24',
						"line-height" => '30',
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> __("Post Meta",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar19",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> __("Post Taxonomy Titles",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar20",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> __("Post Taxonomy Links",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar21",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> __("Read More Link",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar22",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),

	
	array(
		"type" => "end"
	),
	array(
		"name" => __("Comments <a name=\"comments\"></a>",THEME_ADMIN_LANG_DOMAIN).'',
		"type" => "title"
	),
	array (
		"type" => "txtElementHead",
	),
	array (
		"name"	=> __("Comments Title ",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar23",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '20',
						"line-height" => '25',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> __("Comment Author",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar24",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> __("Comment Time",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar25",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> __("Comment Text",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar26",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
	),
	array (
		"name"	=> __("Reply, Cancel Reply Link",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar27",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> __("Comment Form Title",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar28",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> __("Comment Form Labels",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar29",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array(
		"type" => "end"
	),
	array(
		"name" => __("BreadCrumbs <a name=\"bcumb\"></a>",THEME_ADMIN_LANG_DOMAIN).'',
		"type" => "title"
	),
	array (
		"type" => "txtElementHead",
	),
	
	array (
		"name"	=> __("General",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar30",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> __("Title (You are here)",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar31",
		"default" => array(
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
	),
	array (
		"name"	=> __("Current",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar32",
		"default" => array(
						"color" => "000000",
						"font-style" => "normal",
						"font-weight" => "normal",
						"text-decoration" => "none",
					),
	),

	array(
		"type" => "end"
	),
	array(
		"name" => __("Page Navigation <a name=\"navi\"></a>",THEME_ADMIN_LANG_DOMAIN).'',
		"type" => "title"
	),
	array (
		"type" => "txtElementHead",
	),
	array (
		"name"	=> __("General",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar33",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
	),
	array (
		"name"	=> __("Current",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar34",
		"default" => array(
						"color" => "000000",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
	),
	array(
		"type" => "endnosave"
	),
	array(
		"name" => __("Background and Border Colors",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Background Color",THEME_ADMIN_LANG_DOMAIN),
			"id"	=> "cssvar33",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
	array(
			"name" => __("Border Color",THEME_ADMIN_LANG_DOMAIN),
			"id"	=> "cssvar35",
			"property" =>"border-color",
			"default" => "",
			"type" => "color"
		),
	array(
			"name" => __("Current Background Color",THEME_ADMIN_LANG_DOMAIN),
			"id"	=> "cssvar34",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
	array(
			"name" => __("Border Color",THEME_ADMIN_LANG_DOMAIN),
			"id"	=> "cssvar36",
			"property" =>"border-color",
			"default" => "",
			"type" => "color"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Horizontal Mega Menu <a name=\"hmm\"></a>",THEME_ADMIN_LANG_DOMAIN).'',
		"type" => "title"
	),
	array(
		"name" => __("Background Colors And Margins",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Margin-Top ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar37",
			"property" =>"margin-top",
			"default" => "0",
			"type" => "textCSS",
		),
	array(
			"name" => __("Margin-Bottom ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar37",
			"property" =>"margin-bottom",
			"default" => "0",
			"type" => "textCSS",
		),
	array(
			"name" => __("Top Level Active background ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar111",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
	array(
			"name" => __("Top Level Hover and sub items background ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar38",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
	array(
			"name" => __("Second Level Title Background ",THEME_ADMIN_LANG_DOMAIN),
			"id"	=> "cssvar39",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),	
	array(
			"name" => __("Second Level and Third Level Hover Background ",THEME_ADMIN_LANG_DOMAIN),
			"id"	=> "cssvar40",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),	
	array(
		"type" => "endnosave"
	),
	array (
		"type" => "txtElementHead",
	),
	array (
		"name"	=> __("Top Level Links",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar41",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> __("Top Level Links Active",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar112",
		"default" => array(
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),

	),
	array (
		"name"	=> __("Top Level Links Hover",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar42",
		"default" => array(
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),

	),
	array ( 
		"name"	=> __("Second Level Title Links",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar39",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array ( 
		"name"	=> __("Second Level Title Links Hover",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar43",
		"default" => array(
						"color" => "000000",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> __("Third Level Links",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar44",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array ( 
		"name"	=> __("Third Level Links Hover",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar45",
		"default" => array(
						"color" => "000000",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> __("Second Level Links",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar46",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array ( 
		"name"	=> __("Second Level Links Hover",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar47",
		"default" => array(
						"color" => "000000",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	
	array(
		"type" => "end"
	),
	array(
		"name" => __("Horizontal Dropdown Menu <a name=\"hm\"></a>",THEME_ADMIN_LANG_DOMAIN).'',
		"type" => "title"
	),
	array(
		"name" => __("Background Colors And Margins",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Margin-Top ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar48",
			"property" =>"margin-top",
			"default" => "0",
			"type" => "textCSS",
		),
	array(
			"name" => __("Margin-Bottom ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar48",
			"property" =>"margin-bottom",
			"default" => "0",
			"type" => "textCSS",
		),
	array(
			"name" => __("Sub Item Width ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar49",
			"property" =>"width",
			"default" => "200",
			"type" => "textCSS",
		),
	array(
			"name" => __("Top Level Items Background ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar50",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
	array(
			"name" => __("Top Level Hover and sub items background ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar51",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
	array(
				"name" => __("Top Level Active Item background ",THEME_ADMIN_LANG_DOMAIN),
				"id" => "cssvar115",
				"property" =>"background-color",
				"default" => "",
				"type" => "color"
		),
	array(
			"name" => __("Sub Levels Hover background ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar52",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
		
	array(
		"type" => "endnosave"
	),
	array (
		"type" => "txtElementHead",
	),
	array (
		"name"	=> __("Top Level Links",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar53",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array ( 
		"name"	=> __("Top Level Links Hover",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar54",
		"default" => array(
						"color" => "000000",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
		array (
				"name"	=> __("Top Level Links Active",THEME_ADMIN_LANG_DOMAIN),
				"type"	=> "txtElement",
				"id"	=> "cssvar116",
				"default" => array(
						
						"color" => "000000",
						
						"font-style" => "normal",
						"text-decoration" => "none",
				),
				"cufon" => 'on',
		),
	array ( 
		"name"	=> __("Second Level Links",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar55",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array ( 
		"name"	=> __("Second Level Links Hover",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar56",
		"default" => array(
						"color" => "000000",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Horizontal Menu <a name=\"hndm\"></a>",THEME_ADMIN_LANG_DOMAIN).'',
		"type" => "title"
	),
	array(
		"name" => __("Background Colors And Margins",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Margin-Top ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar57",
			"property" =>"margin-top",
			"default" => "0",
			"type" => "textCSS",
		),
	array(
			"name" => __("Margin-Bottom ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar57",
			"property" =>"margin-bottom",
			"default" => "0",
			"type" => "textCSS",
		),
	
	array(
			"name" => __("Item Background ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar58",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
		array(
				"name" => __("Active Item Background ",THEME_ADMIN_LANG_DOMAIN),
				"id" => "cssvar119",
				"property" =>"background-color",
				"default" => "",
				"type" => "color"
		),
	array(
			"name" => __("Hover Background ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar59",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
	array(
			"name" => __("Seperator Color",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar60",
			"property" =>"border-color",
			"default" => "",
			"type" => "color"
		),
	array(
		"type" => "endnosave"
	),
	array (
		"type" => "txtElementHead",
	),
	array (
		"name"	=> __("Item Text",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar61",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
		array (
				"name"	=> __("Active Item",THEME_ADMIN_LANG_DOMAIN),
				"type"	=> "txtElement",
				"id"	=> "cssvar120",
				"default" => array(
						"color" => "000000",
						"font-style" => "normal",
						"text-decoration" => "none",
				),
		),
	array ( 
		"name"	=> __("Item Hover",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar62",
		"default" => array(
						"color" => "000000",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
	),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Vertical Mega Menu <a name=\"vmm\"></a>",THEME_ADMIN_LANG_DOMAIN).'',
		"type" => "title"
	),
	array(
		"name" => __("Background Colors And Margins",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Margin-Top ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar63",
			"property" =>"margin-top",
			"default" => "0",
			"type" => "textCSS",
		),
	array(
			"name" => __("Margin-Bottom ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar63",
			"property" =>"margin-bottom",
			"default" => "0",
			"type" => "textCSS",
		),
	array(
				"name" => __("Top Level Active background ",THEME_ADMIN_LANG_DOMAIN),
				"id" => "cssvar113",
				"property" =>"background-color",
				"default" => "",
				"type" => "color"
		),
	array(
			"name" => __("Top Level Hover and sub items background ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar64",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
	array(
			"name" => __("Second Level Title Background ",THEME_ADMIN_LANG_DOMAIN),
			"id"	=> "cssvar65",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),	
	array(
			"name" => __("Second Level and Third Level Hover Background ",THEME_ADMIN_LANG_DOMAIN),
			"id"	=> "cssvar66",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),	
	array(
		"type" => "endnosave"
	),
	array (
		"type" => "txtElementHead",
	),
	array (
		"name"	=> __("Top Level Links",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar67",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
		array (
				"name"	=> __("Top Level Links Active",THEME_ADMIN_LANG_DOMAIN),
				"type"	=> "txtElement",
				"id"	=> "cssvar114",
				"default" => array(
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
				),
		
		),
	array (
		"name"	=> __("Top Level Links Hover",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar68",
		"default" => array(
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array ( 
		"name"	=> __("Second Level Title Links",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar65",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array ( 
		"name"	=> __("Second Level Title Links Hover",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar69",
		"default" => array(
						"color" => "000000",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> __("Third Level Links",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar70",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array ( 
		"name"	=> __("Third Level Links Hover",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar71",
		"default" => array(
						"color" => "000000",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array (
		"name"	=> __("Second Level Links",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar72",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array ( 
		"name"	=> __("Second Level Links Hover",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar73",
		"default" => array(
						"color" => "000000",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	
	array(
		"type" => "end"
	),
	array(
		"name" => __("Vertical Dropdown Menu <a name=\"vm\"></a>",THEME_ADMIN_LANG_DOMAIN).'',
		"type" => "title"
	),
	array(
		"name" => __("Background Colors And Margins",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Margin-Top ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar74",
			"property" =>"margin-top",
			"default" => "0",
			"type" => "textCSS",
		),
	array(
			"name" => __("Margin-Bottom ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar74",
			"property" =>"margin-bottom",
			"default" => "0",
			"type" => "textCSS",
		),
	array(
			"name" => __("Top Level Items Background ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar75",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
	array(
			"name" => __("Top Level Hover and sub items background ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar76",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
		array(
				"name" => __("Top Level Active items background ",THEME_ADMIN_LANG_DOMAIN),
				"id" => "cssvar117",
				"property" =>"background-color",
				"default" => "",
				"type" => "color"
		),
	array(
			"name" => __("Sub Levels Hover background ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar77",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
	array(
		"type" => "endnosave"
	),
	array (
		"type" => "txtElementHead",
	),
	array (
		"name"	=> __("Top Level Links",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar78",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array ( 
		"name"	=> __("Top Level Links Hover",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar79",
		"default" => array(
						"color" => "000000",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
		array (
				"name"	=> __("Top Level Links Active",THEME_ADMIN_LANG_DOMAIN),
				"type"	=> "txtElement",
				"id"	=> "cssvar118",
				"default" => array(
		
						"color" => "000000",
		
						"font-style" => "normal",
						"text-decoration" => "none",
				),
				"cufon" => 'on',
		),
	array ( 
		"name"	=> __("Second Level Links",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar80",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array ( 
		"name"	=> __("Second Level Links Hover",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar81",
		"default" => array(
						"color" => "000000",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Vertical Menu <a name=\"vndm\"></a>",THEME_ADMIN_LANG_DOMAIN).'',
		"type" => "title"
	),
	array(
		"name" => __("Background Colors And Margins",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Item Background ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar82",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
		array(
				"name" => __("Active Item Background ",THEME_ADMIN_LANG_DOMAIN),
				"id" => "cssvar121",
				"property" =>"background-color",
				"default" => "",
				"type" => "color"
		),
	array(
			"name" => __("Hover Background ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar83",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
	array(
		"type" => "endnosave"
	),
	array (
		"type" => "txtElementHead",
	),
	array (
		"name"	=> __("Item Text",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar84",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => 'on',
	),
		array (
				"name"	=> __("Item Active",THEME_ADMIN_LANG_DOMAIN),
				"type"	=> "txtElement",
				"id"	=> "cssvar122",
				"default" => array(
						"color" => "000000",
						"font-style" => "normal",
						"text-decoration" => "none",
				),
		),
	array ( 
		"name"	=> __("Item Hover",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar85",
		"default" => array(
						"color" => "000000",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
	),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Tabs <a name=\"tab\"></a>",THEME_ADMIN_LANG_DOMAIN).'',
		"type" => "title"
	),
	array(
		"name" => __("Background Colors",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Inactive Tab ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar86",
			"property" =>"background-color",
			"default" => "0",
			"type" => "color",
		),
	array(
			"name" => __("Hover Tab ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar87",
			"property" =>"background-color",
			"default" => "0",
			"type" => "color",
		),
	array(
			"name" => __("Active Tab",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar88",
			"property" =>"background-color",
			"default" => "0",
			"type" => "color",
		),
	array(
			"name" => __("Content Background ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar89",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
	array(
		"type" => "endnosave"
	),
	array (
		"type" => "txtElementHead",
	),
	array (
		"name"	=> __("Default Tab Title",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar86",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		
	),
	array (
		"name"	=> __("Active Tab Title",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar88",
		"default" => array(
						"color" => "000000",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
	),
	array ( 
		"name"	=> __("Tab Title Hover",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar87",
		"default" => array(
						"color" => "000000",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
	),
	array ( 
		"name"	=> __("Tab Content",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar89",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
	),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Accordions <a name=\"accord\"></a>",THEME_ADMIN_LANG_DOMAIN).'',
		"type" => "title"
	),
	array(
		"name" => __("Background Colors",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Inactive Title ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar90",
			"property" =>"background-color",
			"default" => "0",
			"type" => "color",
		),
	array(
			"name" => __("Active Title",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar91",
			"property" =>"background-color",
			"default" => "0",
			"type" => "color",
		),
	array(
			"name" => __("Content Background ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar92",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
	array(
		"type" => "endnosave"
	),
	array (
		"type" => "txtElementHead",
	),
	array (
		"name"	=> __("Accordion Title ",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar93",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
	),
	array ( 
		"name"	=> __("Accordion Content",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar92",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
	),
	array(
		"type" => "end"
	),	
	array(
		"name" => __("Togglers <a name=\"toggle\"></a>",THEME_ADMIN_LANG_DOMAIN).'',
		"type" => "title"
	),
	array(
		"name" => __("Background Colors",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Title ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar94",
			"property" =>"background-color",
			"default" => "0",
			"type" => "color",
		),
	array(
			"name" => __("Active Title",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar95",
			"property" =>"background-color",
			"default" => "0",
			"type" => "color",
		),
	array(
			"name" => __("Content Background ",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar96",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
	array(
		"type" => "endnosave"
	),
	array (
		"type" => "txtElementHead",
	),
	array (
		"name"	=> __("Title ",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar97",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => "on",
	),
	array ( 
		"name"	=> __("Content",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar98",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
	),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Slide Show Elements <a name=\"slider\"></a>",THEME_ADMIN_LANG_DOMAIN).'',
		"type" => "title"
	),
	array (
		"type" => "txtElementHead",
	),
	array (
		"name"	=> __("Titles -Anything - SlideDeck",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar105",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => "on",
	),
	array ( 
		"name"	=> __("Content -Anything - SlideDeck",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar100",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
	),
	array (
		"name"	=> __("Caption Titles -Anything - S3",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar106",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => "on",
	),
	array ( 
		"name"	=> __("Caption Content -Anything - S3",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar107",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
	),
	//anyCaption
	array(
		"type" => "end"
	),
	array(
		"name" => __("Widget Specific <a name=\"widget\"></a>",THEME_ADMIN_LANG_DOMAIN).'',
		"type" => "title"
	),
	array (
		"type" => "txtElementHead",
	),
	array (
		"name"	=> __("Super Title",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar102",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"color" => "000000",
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => "on",
	),
	array (
		"name"	=> __("Widget Titles(color won't work)",THEME_ADMIN_LANG_DOMAIN),
		"type"	=> "txtElement",
		"id"	=> "cssvar103",
		"default" => array(
						"font-family" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"font-size" => '12',
						"line-height" => '15',
						"font-weight" => "normal",
						"font-style" => "normal",
						"text-decoration" => "none",
					),
		"cufon" => "on",
	),
	array(
		"type" => "endnosave",
	),
	array(
		"name" => __("Widget Titles Decoration",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Title Background Color",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar104",
			"property" =>"background-color",
			"default" => "",
			"type" => "color"
		),
	array(
			"name" => __("Title Background Image",THEME_ADMIN_LANG_DOMAIN),
			"desc" =>__( "Paste the full URL (include http://) of image here or you can insert the image through the button. To remove image just delete the text in field.",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cssvar104",
			"property" => "background-image",
			"default" => "",
			"type" => "uploadCSS"
		),
	array(
			"name" => __("Title Background Image Location",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar104",
			"property" => "background-position",
			"default" => "top left",
			"options" => array("top left"=>__('Top Left',THEME_ADMIN_LANG_DOMAIN),
								"top right"=>__('Top Right',THEME_ADMIN_LANG_DOMAIN),
								"top center"=>__('Top Center',THEME_ADMIN_LANG_DOMAIN),
								"bottom left"=>__('Bottom Left',THEME_ADMIN_LANG_DOMAIN),
								"bottom right"=>__('Bottom Right',THEME_ADMIN_LANG_DOMAIN),
								"bottom center"=>__('Bottom Center',THEME_ADMIN_LANG_DOMAIN),
			),
			"type" => "selectCSS"
		),
		array(
			"name" => __("Title Background Image Repeat",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar104",
			"property" => "background-repeat",
			"default" => "repeat",
			"options" => array("repeat"=>__('Repeat',THEME_ADMIN_LANG_DOMAIN),
								"repeat-x"=>__('Repeat Horizontal',THEME_ADMIN_LANG_DOMAIN),
								"repeat-y"=>__('Repeat Vertical',THEME_ADMIN_LANG_DOMAIN),
								"no-repeat"=>__('Do not Repeat',THEME_ADMIN_LANG_DOMAIN),
			),
			"type" => "selectCSS"
		),
	array(
			"name" => __("Title Border ",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar104",
			"property" =>"border-width",
			"default" => "none",
			"options" => array("0"=>__('None',THEME_ADMIN_LANG_DOMAIN),
								"1px 0 1px 0"=>__('Top and Bottom',THEME_ADMIN_LANG_DOMAIN),
								"1px 0 0 0"=>__('Only Top',THEME_ADMIN_LANG_DOMAIN),
								"0 0 1px 0"=>__('Only Bottom',THEME_ADMIN_LANG_DOMAIN),
								
			),
			"type" => "selectCSS"
		),
	array(
			"name" => __("Title Border Style",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar104",
			"property" =>"border-style",
			"default" => "none",
			"options" => array("none"=>__('None',THEME_ADMIN_LANG_DOMAIN),
								"solid"=>__('Solid',THEME_ADMIN_LANG_DOMAIN),
								"dotted"=>__('Dotted',THEME_ADMIN_LANG_DOMAIN),
								"dashed"=>__('Dashed',THEME_ADMIN_LANG_DOMAIN),
								
			),
			"type" => "selectCSS"
		),
	array(
			"name" => __("Title Border Color",THEME_ADMIN_LANG_DOMAIN),
			"desc" => "",
			"id" => "cssvar104",
			"property" =>"border-color",
			"default" => "",
			"type" => "color"
		),
	array(
		"type" => "end"
	),	
		
);
return array(
	'auto' => true,
	'name' => 'css',
	'options' => $options
);