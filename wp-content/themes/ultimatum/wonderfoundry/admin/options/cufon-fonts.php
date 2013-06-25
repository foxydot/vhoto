<?php
$options = array(
	array(
		"name" => sprintf(__('Fonts located in "%s"',THEME_ADMIN_LANG_DOMAIN),'<code>'.str_replace( WP_CONTENT_DIR, '', THEME_CUFON_DIR ).'</code>'),
		"type" => "start"
	),
		array(
			"id" => "cufon",
			"layout" => false,
			"function" => "theme_cufon_fonts_option",
			"default" => "",
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