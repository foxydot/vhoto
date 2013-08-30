<?php
$options = array(
	array(
		"name" => sprintf(__('Fonts located in "%s"',THEME_ADMIN_LANG_DOMAIN),'<code>'.THEME_FONTFACE_URI.'</code>'),
		"type" => "start"
	),
		array(
			"id" => "fontface",
			"layout" => false,
			"function" => "theme_fontface_fonts_option",
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