<?php
$options = array(


		array(
		"name" => __("Default Logo <small><i>(In layouts generator this will be set as default if no options are selected.)</i></small>",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Title as Logo",THEME_ADMIN_LANG_DOMAIN),
			"desc" => sprintf(__('If this option is on, the "Site Title" you defined in <a href="%s/wp-admin/options-general.php">Settings->General</a> will be used as logo
image.',THEME_ADMIN_LANG_DOMAIN),get_option('siteurl')),
			"id" => "text_logo",
			"default" => true,
			"type" => "toggle"
		),
		
		array(
			"name" => __("Image Logo",THEME_ADMIN_LANG_DOMAIN),
			"desc" =>__( "Paste the full URL (include <code>http://</code>) of your custom logo here or you can insert the image through the button.",THEME_ADMIN_LANG_DOMAIN),
			"id" => "logo",
			"default" => "",
			"type" => "upload"
		),
		array(
			"name" => __("Display Site Description <small><i>(tag line)</i></small>",THEME_ADMIN_LANG_DOMAIN),
			"desc" => sprintf(__('If you set logo to be text, you can choose whether to display <a href="%s/wp-admin/options-general.php">Tagline</a> after Site Title.',THEME_ADMIN_LANG_DOMAIN),get_option('siteurl')),
			"id" => "display_site_desc",
			"default" => true,
			"type" => "toggle"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Ultimatum Extra Tools",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Ultimatum SEO",THEME_ADMIN_LANG_DOMAIN),
			"desc" => __('If this option is on, Ultimatum will enable your SEO options for each single page or post or post types. Turn this off if you are using another SEO tool such as All in one SEO ',THEME_ADMIN_LANG_DOMAIN),
			"id" => "ultimatum_seo",
			"default" => true,
			"type" => "toggle"
		),
		array(
				"name" => __("Ultimatum Forms",THEME_ADMIN_LANG_DOMAIN),
				"id" => "ultimatum_forms",
				"default" => true,
				"type" => "toggle"
		),
		array(
				"name" => __("Ultimatum Slideshows",THEME_ADMIN_LANG_DOMAIN),
				"id" => "ultimatum_slideshows",
				"default" => true,
				"type" => "toggle"
		),
		
		array(
		"type" => "end"
	),
	array(
		"name" => __("Favicon / Apple Touch icons / No Image Image",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Favorite Icon",THEME_ADMIN_LANG_DOMAIN),
			"desc" =>__( "Paste the full URL (include <code>http://</code>) of your favicon here or you can insert the image through the button.",THEME_ADMIN_LANG_DOMAIN),
			"id" => "favicon",
			"default" => "",
			"type" => "upload"
		),
		array(
				"name" => __("App Icon",THEME_ADMIN_LANG_DOMAIN),
				"desc" =>__( "Paste the full URL (include <code>http://</code>) of your App Icon here or you can insert the image through the button.",THEME_ADMIN_LANG_DOMAIN),
				"id" => "touchicon",
				"default" => "",
				"type" => "upload"
		),
		array(
				"name" => __("App startup Image",THEME_ADMIN_LANG_DOMAIN),
				"desc" =>__( "Paste the full URL (include <code>http://</code>) of your App Launch Image here or you can insert the image through the button.",THEME_ADMIN_LANG_DOMAIN),
				"id" => "startimage",
				"default" => "",
				"type" => "upload"
		),
		array(
				"name" => __("No Image Image",THEME_ADMIN_LANG_DOMAIN),
				"desc" =>__( "Paste the full URL (include <code>http://</code>) of your No Image Image here or you can insert the image through the button.",THEME_ADMIN_LANG_DOMAIN),
				"id" => "noimage",
				"default" => "",
				"type" => "upload"
		),
	array(
		"type" => "end"
	),

	array(
		"name" => __("Header and Footer Scripts",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Header Scripts",THEME_ADMIN_LANG_DOMAIN),
			"desc" => 'Paste any code you want to be included between &lt;head&gt;&lt;/head&gt; tags i.e Google Webmaster Tools',
			"id" => "head_scripts",
			"default" => "",
			'rows' => '5',
			"type" => "textarea"
		),
	array(
			"name" => __("Footer Scripts",THEME_ADMIN_LANG_DOMAIN),
			"desc" => 'Paste any code you want to be included right before &lt;/body&gt; tag i.e Google Analytics',
			"id" => "footer_scripts",
			"default" => "",
			'rows' => '5',
			"type" => "textarea"
		),
	array(
		"type" => "end"
	),
		array(
				"name" => __("WooCommerce Integration",THEME_ADMIN_LANG_DOMAIN),
				"type" => "start"
		),
		array(
				"name" => __("WooCoomerce",THEME_ADMIN_LANG_DOMAIN),
				"desc" =>'',
				"id" => "woocommerce",
				"default" => false,
				"type" => "toggle"
		),
		array(
				"name" => __("Product column count",THEME_ADMIN_LANG_DOMAIN),
				"desc" => '',
				"id" => "woocols",
				"default" => "4",
				"size" => 5,
				"type" => "text"
		),
		array(
				"name" => __("Product count per page",THEME_ADMIN_LANG_DOMAIN),
				"desc" => '',
				"id" => "woocount",
				"default" => "12",
				"size" => 5,
				"type" => "text"
		),
		array(
				"type" => "end"
		),
	
		array(
				"name" => __("Use Fitvids?",THEME_ADMIN_LANG_DOMAIN),
				"type" => "start"
		),
		array(
				"name" => __("Use fitvids for responsive sizing of videos",THEME_ADMIN_LANG_DOMAIN),
				"id" => "fitvids",
				"default" => false,
				"type" => "toggle"
		),
		array(
				"type" => "end"
		),
		array(
				"name" => __("Pretty Photo",THEME_ADMIN_LANG_DOMAIN),
				"type" => "start"
		),
		array(
				"name" => __("Theme",THEME_ADMIN_LANG_DOMAIN),
				"desc" => "",
				"id" => "pptheme",
				"default" => "facebook",
				"options" => array("default"=>__('Default',THEME_ADMIN_LANG_DOMAIN),
						"dark_rounded"=>__('Dark Rounded',THEME_ADMIN_LANG_DOMAIN),
						"dark_square"=>__('Dark Square',THEME_ADMIN_LANG_DOMAIN),
						"facebook"=>__('Facebook',THEME_ADMIN_LANG_DOMAIN),
						"ligt_rounded"=>__('Light Rounded',THEME_ADMIN_LANG_DOMAIN),
						"light_square"=>__('Light Square',THEME_ADMIN_LANG_DOMAIN),
				),
				"type" => "select"
		),
		array(
				"type" => "end"
		),
		array(
				"name" => __("Sidebars",THEME_ADMIN_LANG_DOMAIN),
				"type" => "start"
		),
		array(
				"name" => __("Sidebar Names",THEME_ADMIN_LANG_DOMAIN),
				"desc" => __('Type in names of sidebars you need with using <code>;</code> as seperator',THEME_ADMIN_LANG_DOMAIN),
				"id" => "sidebars",
				"default" => "",
				'rows' => '5',
				"type" => "textarea"
		),
		array(
				"type" => "end"
		),
		array(
				"name" => __("Google Web Fonts Char Set",THEME_ADMIN_LANG_DOMAIN),
				"type" => "start"
		),
		array (
				"name" => __("Charsets",THEME_ADMIN_LANG_DOMAIN),
				"desc" => __('Google by default sends out Latin Charset you can add more charsets however tehy will only work if they are existing in google libraries',THEME_ADMIN_LANG_DOMAIN),
				"id" => "google_charset",
				"default" => "",
				"options" => array("latin"=>__('Latin',THEME_ADMIN_LANG_DOMAIN),
						"latin-ext"=>__('Latin Extended',THEME_ADMIN_LANG_DOMAIN),
						"cyrillic"=>__('Cyrillic',THEME_ADMIN_LANG_DOMAIN),
						"cyrillic-ext"=>__('Cyrillic Extended',THEME_ADMIN_LANG_DOMAIN),
						"greek"=>__('Greek',THEME_ADMIN_LANG_DOMAIN),
						"greek-ext"=>__('Greek Extended',THEME_ADMIN_LANG_DOMAIN),
				),
				"type" => "multiselect"),
				array(
						"type" => "end"
				),
		array(
				"name" => __("Twitter OAUTH",THEME_ADMIN_LANG_DOMAIN),
				"type" => "start"
		),
		array(
				"name" => __("Consumer key",THEME_ADMIN_LANG_DOMAIN),
				"desc" => '',
				"id" => "tw_consumer_key",
				"default" => "",
				"size" => 20,
				"type" => "text"
		),
		array(
				"name" => __("Consumer Secret",THEME_ADMIN_LANG_DOMAIN),
				"desc" => '',
				"id" => "tw_consumer_secret",
				"default" => "",
				"size" => 20,
				"type" => "text"
		),
		array(
				"name" => __("Access Token",THEME_ADMIN_LANG_DOMAIN),
				"desc" => '',
				"id" => "tw_access_token",
				"default" => "",
				"size" => 20,
				"type" => "text"
		),
		array(
				"name" => __("Access Token Secret",THEME_ADMIN_LANG_DOMAIN),
				"desc" => '',
				"id" => "tw_access_secret",
				"default" => "",
				"size" => 20,
				"type" => "text"
		),
				array(
						"type" => "end"
				),
	
);
return array(
	'auto' => true,
	'name' => 'general',
	'options' => $options
);