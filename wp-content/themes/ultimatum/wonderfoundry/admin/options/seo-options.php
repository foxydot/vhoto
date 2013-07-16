<?php
$options = array(

	array(
		"name" => __("Document Title Settings",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Append Tagline to Doctitle on homepage?",THEME_ADMIN_LANG_DOMAIN),
			"desc" => sprintf(__('If this option is on, the <a href="%s/wp-admin/options-general.php">Tagline</a> will be appended to document title on home page.',THEME_ADMIN_LANG_DOMAIN),get_option('siteurl')),
			"id" => "doctitle_home_desc",
			"default" => true,
			"type" => "toggle"
		),
	array(
			"name" => __("Append Site Title to Doctitle on inner pages?",THEME_ADMIN_LANG_DOMAIN),
			"desc" => sprintf(__('If this option is on, the "Site Title" you defined in <a href="%s/wp-admin/options-general.php">Settings->General</a> will be appendes to all your page titles.',THEME_ADMIN_LANG_DOMAIN),get_option('siteurl')),
			"id" => "doctitle_sitename",
			"default" => true,
			"type" => "toggle"
		),
	array(
			"name" => __("Title Seperator",THEME_ADMIN_LANG_DOMAIN),
			"desc" => 'If your title consists of two parts (Title & Appended Text), then the Separator will go between them.',
			"id" => "title_seperator",
			"default" => "|",
			"size" => 10,
			"type" => "text"
		),
	
	array(
		"type" => "end"
	),
	array (
			"type"=>"explain",
			"name" => __('WP adds several tags in site <code>head</code>. They have no SEO value and negative affects to the site load speed.',THEME_ADMIN_LANG_DOMAIN),
	),
	array(
		"name" => __("Document Head Settings",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Index <code>rel</code> link tag",THEME_ADMIN_LANG_DOMAIN),
			"id" => "index_rel_tag",
			"default" => false,
			"type" => "toggle"
		),
	array(
			"name" => __("Parent Posts <code>rel</code> link tag",THEME_ADMIN_LANG_DOMAIN),
			"id" => "parent_post_rel_tag",
			"default" => false,
			"type" => "toggle"
		),
	array(
			"name" => __("Start Post <code>rel</code> link tag",THEME_ADMIN_LANG_DOMAIN),
			"id" => "start_post_rel_tag",
			"default" => false,
			"type" => "toggle"
		),
	array(
			"name" => __("Adjacent Posts <code>rel</code> link tag",THEME_ADMIN_LANG_DOMAIN),
			"id" => "adj_post_rel_tag",
			"default" => false,
			"type" => "toggle"
		),
	array(
			"name" => __("Include Windows Live Writer Support Tag?",THEME_ADMIN_LANG_DOMAIN),
			"id" => "live_writer",
			"default" => false,
			"type" => "toggle"
		),
	array(
			"name" => __("Include Shortlink tag?",THEME_ADMIN_LANG_DOMAIN),
			"id" => "slink_tag",
			"default" => false,
			"type" => "toggle"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Robots Meta Settings",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Apply <code>noindex</code> to Category Archives?",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cat_arch_no_index",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Apply <code>noindex</code> to Tag Archives?",THEME_ADMIN_LANG_DOMAIN),
			"id" => "tag_arch_no_index",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Apply <code>noindex</code> to Author Archives?",THEME_ADMIN_LANG_DOMAIN),
			"id" => "auth_arch_no_index",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Apply <code>noindex</code> to Date Archives?",THEME_ADMIN_LANG_DOMAIN),
			"id" => "date_arch_no_index",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Apply <code>noindex</code> to Search Archives?",THEME_ADMIN_LANG_DOMAIN),
			"id" => "search_arch_no_index",
			"default" => true,
			"type" => "toggle"
		),
		
		array(
			"name" => __("Apply <code>noarchive</code> to Entire Site?",THEME_ADMIN_LANG_DOMAIN),
			"id" => "site_no_archive",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Apply <code>noarchive</code> to Category Archives?",THEME_ADMIN_LANG_DOMAIN),
			"id" => "cat_arch_no_archive",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Apply <code>noarchive</code> to Tag Archives?",THEME_ADMIN_LANG_DOMAIN),
			"id" => "tag_arch_no_archive",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Apply <code>noarchive</code> to Author Archives?",THEME_ADMIN_LANG_DOMAIN),
			"id" => "auth_arch_no_archive",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Apply <code>noarchive</code> to Date Archives?",THEME_ADMIN_LANG_DOMAIN),
			"id" => "date_arch_no_archive",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Apply <code>noarchive</code> to Search Archives?",THEME_ADMIN_LANG_DOMAIN),
			"id" => "search_arch_no_archive",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Apply <code>noodp</code> to Entire Site?",THEME_ADMIN_LANG_DOMAIN),
			"id" => "noodp",
			"default" => true,
			"desc" => __('Prevent Open Directory to copy your site title and description',THEME_ADMIN_LANG_DOMAIN),
			"type" => "toggle"
		),
		array(
			"name" => __("Apply <code>noydir</code> to Entire Site?",THEME_ADMIN_LANG_DOMAIN),
			"id" => "noydir",
			"desc" => __('',THEME_ADMIN_LANG_DOMAIN),
			"desc" => __('Prevent Yahoo Directory to copy your site title and description',THEME_ADMIN_LANG_DOMAIN),
			"default" => true,
			"type" => "toggle"
		),
	array(
		"type" => "end"
	),	
	array(
		"name" => __("Archives Settings",THEME_ADMIN_LANG_DOMAIN),
		"type" => "start"
	),
	array(
			"name" => __("Canonical Paginated Archives",THEME_ADMIN_LANG_DOMAIN),
			"desc" => __('This option points search engines to the first page of an archive.',THEME_ADMIN_LANG_DOMAIN),
			"id" => "canno_pagi_arch",
			"default" => true,
			"type" => "toggle"
		),
	array(
		"type" => "end"
	),	
);
return array(
	'auto' => true,
	'name' => 'seo',
	'options' => $options
);