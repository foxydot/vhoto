<?php
$options = array(
	array(
		"name" => __('Google Fonts In Library',THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
		array(
			"id" => "google",
			"layout" => false,
			"function" => "google_fonts_option",
			"default" => '',
			"type" => "custom"
		),
	array(
		"type" => "end"
	),
);
return array(
	'auto' => true,
	'name' => 'fonts',
	'options' => $options
);