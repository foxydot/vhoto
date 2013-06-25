<?php
$options = array(


	array(
		"name" => __("Access Rights",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Ultimatum Panels",THEME_ADMIN_LANG_DOMAIN),
			"desc" => __('Select the users with access to Core Ultimatum Functions',THEME_ADMIN_LANG_DOMAIN),
			"id" => "ultimatum_pane",
		
			"type" => "userselect"
		),
		
		array(
			"name" => __("Forms Panes",THEME_ADMIN_LANG_DOMAIN),
			"desc" => __('Select the users with access to Form Editor',THEME_ADMIN_LANG_DOMAIN),
			"id" => "forms_pane",
		
			"type" => "userselect"
		),
		array(
			"name" => __("SlideShow Panes",THEME_ADMIN_LANG_DOMAIN),
			"desc" => __('Select the users with access to SlideShow Editor',THEME_ADMIN_LANG_DOMAIN),
			"id" => "slides_pane",
	
			"type" => "userselect"
		),
	array(
		"type" => "end"
	),
		array(
				"name" => __("Beta Versions",THEME_ADMIN_LANG_DOMAIN),
				"type" => "start"
		),
		array(
				"name" => __("Apply Beta Updates",THEME_ADMIN_LANG_DOMAIN),
				"desc" => __('If this option is set ON you will be notified about beta versions in dashboard and update will gather latest beta version. Do not use this on any production sites.',THEME_ADMIN_LANG_DOMAIN),
				"id" => "beta",
				"default" => false,
				"type" => "toggle"
		),
		array(
				"type" => "end"
		),
	
);
return array(
	'auto' => true,
	'name' => 'ultimatum_access',
	'options' => $options
);