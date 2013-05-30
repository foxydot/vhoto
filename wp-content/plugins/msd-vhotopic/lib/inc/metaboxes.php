<?php
	$documents = new WPAlchemy_MetaBox(array
	(
		'id' => '_custom_meta',
		'title' => 'Custom Meta',
		'template' => STYLESHEETPATH . '/custom/meta.php',
		'types' => array('post','page'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => TRUE,
		'mode' => WPALCHEMY_MODE_EXTRACT, // defaults to WPALCHEMY_MODE_ARRAY
		'prefix' => '_my_' // defaults to NULL
	));
	
	/*
'id' => '_custom_meta',
'title' => 'Custom Meta',
'template' => STYLESHEETPATH . '/custom/meta.php',
'types' => array('post','page'),
'context' => 'normal',
'priority' => 'high',
'autosave' => TRUE,
'mode' => WPALCHEMY_MODE_EXTRACT // defaults to WPALCHEMY_MODE_ARRAY,
'prefix' => '_my_' // defaults to NULL,

'init_action' => 'my_init_action_func' // defaults to NULL,
'output_filter' => 'my_output_filter_func' // defaults to NULL,
'save_filter' => 'my_save_filter_func' // defaults to NULL,
'save_action' => 'my_save_action_func' // defaults to NULL,
'head_filter' => 'my_head_filter_func' // defaults to NULL,
'head_action' => 'my_head_action_func' // defaults to NULL,
'foot_filter' => 'my_foot_filter_func' // defaults to NULL,
'foot_action' => 'my_foot_action_func' // defaults to NULL,

'hide_editor' => TRUE // defaults to NULL,
'hide_title' => TRUE // defaults to NULL,
'lock' => WPALCHEMY_LOCK_TOP // defaults to NULL,
'view' => WPALCHEMY_VIEW_ALWAYS_OPENED // defaults to NULL,
'hide_screen_option' => TRUE // defaults to NULL
*/