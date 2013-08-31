<?php
/**
 * Wordpress theme framework by WonderFoundry and Graphix2Html
 * @package WonderWorks
 * @author Onur Demir (WonderFoundry) http://www.wonderoundry.com
 * @version 1.0.0
 */
class WonderWorks {
	
	/**
	 * Starts the Framework
	 * @param array $theme
	 */
	function init($theme) {
		// Define the constants eg. directories and urls
		$this->DefineConstants($theme);
		// Load the Database
		$this->LoadDatabase();
		// Add language support.
		add_action('init',array(&$this, 'language'));
		// Add theme support.
		add_action('after_setup_theme', array(&$this, 'supports'));
		// Load Functions
		$this->functions();
		// Load Post Types
		//$this->requireFromFolder(THEME_POSTTYPES);
		// Load Plugins
		$this->requireFromFolder(THEME_PLUGINS);
		// Load ShortCodes
		$this->requireFromFolder(THEME_SHORTCODES);
		// Load Widgets
		global $pagenow;
		if($pagenow != "widgets.php" ) {
		$this->requireFromFolder(THEME_WIDGETS);
		}
		// Do Admin thingies :) 
		if (is_admin()) {
			$this->admin_functions();
			
		}
		
	}
	function functions(){
		if(file_exists(THEME_FUNCTIONS.'/devfuncs.php')){
			require_once (THEME_FUNCTIONS . '/devfuncs.php');
		}
		require_once (THEME_FUNCTIONS . '/image.php');
		require_once (THEME_FUNCTIONS . '/head.php');
		require_once (THEME_FUNCTIONS . '/layout-helper.php');
		require_once (THEME_FUNCTIONS . '/types.php');
		require_once (THEME_FUNCTIONS . '/wpml.php');
	}
	
	function admin_functions(){
		if(file_exists(THEME_ADMIN_FUNCTIONS.'/devfuncs.php')){
			require_once (THEME_ADMIN_FUNCTIONS . '/devfuncs.php');
		}
		require_once (THEME_ADMIN_FUNCTIONS . '/init.php');
		require_once (THEME_ADMIN_FUNCTIONS . '/menus.php');
		require_once (THEME_ADMIN_FUNCTIONS . '/option-media-upload.php');
		require_once (THEME_ADMIN_FUNCTIONS . '/tinymce.php');
		
		
	}
	
	
	function supports() {
		if (function_exists('add_theme_support')) {
			
		   $args=array(
            	'public'   => true
                 );
           $output = 'objects'; // or objects
           $post_types=get_post_types($args,$output);
     		foreach ($post_types  as $post_type ) {
			if ( $post_type->name != 'attachment' ) {
			        $arr[] =$post_type->name;
				}
			}
			
			add_theme_support('post-thumbnails');
			 
			add_theme_support('menus');
			register_nav_menus(array(
				'primary-menu' => __(THEME_NAME . ' Default Menu', THEME_ADMIN_LANG_DOMAIN )				
			));
						
			add_theme_support('automatic-feed-links');
						
			add_theme_support('editor-style');
		}
	}

	/**
	 * Make theme available for translation
	 */
	function language(){
		$locale = get_locale();
		load_theme_textdomain( THEME_LANG_DOMAIN, THEME_DIR . '/languages' );
		$locale_file = THEME_DIR . "/languages/$locale.php";
		if ( is_readable( $locale_file ) ){
			require_once( $locale_file );
		}
	}
	
	/**
	 * Requires the files from the specified folder
	 * @param string $folder
	 */
	function requireFromFolder($folder){
	if ($handle = opendir($folder)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != ".." && eregi(".php", $entry)) {
          include $folder."/".$entry;
        }
    }
    closedir($handle);
}
	/*	foreach (glob($folder."/*.php") as $filename)
		{
			
		    include $filename;
		}*/
	}
	
	/**
	 * Defines the Constants
	 * @param array $theme
	 */
	function DefineConstants($theme){
		$ultimatumversion = get_option('ultimatum_version');
		define('THEME_NAME', $theme['theme_name']);
		define('THEME_SLUG', 'ultimatum');
		if(isset($theme['theme_slug'])){
			define('THEME_CODE', $theme['theme_slug']);
		} else {
			define('THEME_CODE', 'ultimatum');
		}
		define('THEME_VERSION',2);
		define('THEME_LANG_DOMAIN', 'ultimatum');
		define('THEME_ADMIN_LANG_DOMAIN', 'ultimatum');
		
		define('THEME_DIR', get_template_directory());
		define('THEME_URI', get_template_directory_uri());
		define('THEME_ADMIN_URI', get_template_directory_uri().'/wonderfoundry/admin');
		
		define('THEME_FRAMEWORK', THEME_DIR . '/wonderfoundry');
		
		define('THEME_PLUGINS', THEME_FRAMEWORK . '/plugins');
		define('THEME_FUNCTIONS', THEME_FRAMEWORK . '/functions');
		define('THEME_POSTTYPES', THEME_FRAMEWORK . '/posttypes');
		define('THEME_WIDGETS', THEME_FRAMEWORK . '/widgets');
		define('THEME_SHORTCODES', THEME_FRAMEWORK . '/shortcodes');
		
		define('THEME_AJAX', THEME_URI . '/wonderfoundry/ajax');
		define('THEME_HELPERS', THEME_URI . '/helpers');
		
	
		
		
		
		define('THEME_LOOPS_DIR', get_stylesheet_directory().'/loops');
		define('THEME_IMAGES', THEME_URI . '/images');
		define('THEME_CSS', THEME_URI . '/css');
		define('THEME_JS', THEME_URI . '/js');
		
		define('THEME_ADMIN', THEME_FRAMEWORK . '/admin');
		
		define('THEME_ADMIN_AJAX', THEME_ADMIN . '/ajax');
		define('THEME_ADMIN_TYPES', THEME_ADMIN . '/types');
		define('THEME_ADMIN_TMCE', THEME_ADMIN . '/tinymce');
		define('THEME_ADMIN_TMCE_URI', THEME_ADMIN_URI . '/tinymce');
		define('THEME_ADMIN_HELPERS', THEME_ADMIN . '/helpers');
		define('THEME_ADMIN_JS_URI', THEME_ADMIN_URI . '/js');
		define('THEME_ADMIN_FUNCTIONS', THEME_ADMIN . '/functions');
		define('THEME_ADMIN_OPTIONS', THEME_ADMIN . '/options');
		
		
		/*slideshow*/
		$upload_dir = wp_upload_dir();
		$uploaduri = $upload_dir["baseurl"];
		$slideshowuri=$uploaduri.'/slideShow';
		define('THEME_SLIDESHOW', $slideshowuri);
		/*
		 * Slideshow Path fix
		 */
		$uploaddir = $upload_dir["basedir"];
		$slideshowdir = $uploaddir.'/slideShow';
		define('THEME_SLIDESHOW_DIR', $slideshowdir);
		if(THEME_CODE!='ultimatum'){
			define('THEME_CACHE_DIR', $uploaddir.'/'.THEME_CODE);
			if(!is_dir(THEME_CACHE_DIR)) mkdir(THEME_CACHE_DIR);
			define('THEME_CACHE_URI', $uploaduri.'/'.THEME_CODE);
		} else {
				if($ultimatumversion<2.37038){
				define('THEME_CACHE_DIR', THEME_DIR. '/cache');
				define('THEME_CACHE_URI', THEME_URI . '/cache');
			} else {
				define('THEME_CACHE_DIR', $uploaddir.'/'.THEME_CODE);
				if(!is_dir(THEME_CACHE_DIR)) mkdir(THEME_CACHE_DIR);
				define('THEME_CACHE_URI', $uploaduri.'/'.THEME_CODE);
			}
		}
		if($ultimatumversion<2.37038){
			define('THEME_CUFON_URI', THEME_URI . '/fonts/cufon');
			define('THEME_CUFON_DIR', THEME_DIR . '/fonts/cufon');
			define('THEME_FONTFACE_DIR', THEME_URI . '/fonts/fontface');
			define('THEME_FONTFACE_URI', THEME_DIR . '/fonts/fontface');
		} else {
			$dir = WP_PLUGIN_DIR.'/ultimatum-library';
			$url = WP_PLUGIN_URL.'/ultimatum-library';
			define('THEME_CUFON_DIR', $dir. '/fonts/cufon');
			define('THEME_CUFON_URI', $url . '/fonts/cufon');
			define('THEME_IMGLIB_URI', $url . '/images');
			define('THEME_IMGLIB_DIR', $dir . '/images');
			define('THEME_FONTFACE_DIR', $dir . '/fonts/fontface');
			define('THEME_FONTFACE_URI', $url . '/fonts/fontface');
		}
	}
	
	function LoadDatabase(){
		global $wpdb;
		// Check if Ultimatum is enabled and show the activation page
		$table = $wpdb->prefix.'ultimatum_layout';
		$prefix = $wpdb->prefix;
		$ultimatumversion = get_option('ultimatum_version');
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		if (!$ultimatumversion){ // We do not have the table so Ultimatum is not enabled for this blog
			//
			$tables = array("CREATE TABLE IF NOT EXISTS `".$prefix."ultimatum_css` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`container` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					`layout_id` int(11) NOT NULL,
					`element` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					`properties` text COLLATE utf8_unicode_ci NOT NULL,
					PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci",
		
					"CREATE TABLE IF NOT EXISTS `".$prefix."ultimatum_forms` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					`notify` text COLLATE utf8_unicode_ci NOT NULL,
					`thank` text COLLATE utf8_unicode_ci NOT NULL,
					`fields` text COLLATE utf8_unicode_ci NOT NULL,
					`button` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci",
		
		
					"CREATE TABLE IF NOT EXISTS `".$prefix."ultimatum_layout` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					`type` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
					`before` text COLLATE utf8_unicode_ci,
					`after` text COLLATE utf8_unicode_ci,
					`default` int(1) NOT NULL DEFAULT '0',
					`rows` text COLLATE utf8_unicode_ci,
					PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci",
		
					"CREATE TABLE IF NOT EXISTS `".$prefix."ultimatum_layout_assign` (
					`post_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					`layout_id` int(11) NOT NULL,
					UNIQUE KEY `post_type` (`post_type`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci",
		
		
					"CREATE TABLE IF NOT EXISTS `".$prefix."ultimatum_ptypes` (
					`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					`properties` text COLLATE utf8_unicode_ci NOT NULL,
					UNIQUE KEY `name` (`name`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci",
		
		
					"CREATE TABLE IF NOT EXISTS `".$prefix."ultimatum_rows` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`layout_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					`type_id` int(11) NOT NULL,
					PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci",
		
		
					"CREATE TABLE IF NOT EXISTS `".$prefix."ultimatum_sc` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					`properties` text COLLATE utf8_unicode_ci NOT NULL,
					PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci",
		
		
					"CREATE TABLE IF NOT EXISTS `".$prefix."ultimatum_slides` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					`images` text COLLATE utf8_unicode_ci NOT NULL,
					PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci",
		
		
					"CREATE TABLE IF NOT EXISTS `".$prefix."ultimatum_tax` (
					`tname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					`pname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					`properties` text COLLATE utf8_unicode_ci NOT NULL,
					UNIQUE KEY `tname` (`tname`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci",
					"INSERT INTO `".$prefix."ultimatum_layout` (`id`, `title`, `type`, `before`, `after`, `default`, `rows`) VALUES (1, 'Ultimatum Default', 'full', '', '', 1, '2,3,1,4');",
					"INSERT INTO `".$prefix."ultimatum_rows` (`id`, `layout_id`, `type_id`) VALUES
					(1, '1', 1),
					(2, '1', 10),
					(3, '1', 1),
					(4, '1', 2);",
		
		
		
			); //array finishes
		
			foreach($tables as $sql){
				dbDelta($sql);
			}
			// WordPRess Posts per page posts_per_page
			update_option('posts_per_page', 1);
			//Ultimatum options for fonts general and skin1
			$ultimatum_general = unserialize('a:7:{s:9:"text_logo";b:1;s:4:"logo";s:0:"";s:17:"display_site_desc";b:1;s:7:"favicon";s:0:"";s:12:"head_scripts";s:0:"";s:14:"footer_scripts";s:0:"";s:12:"maps_api_key";s:0:"";}');
			update_option('ultimatum_general', $ultimatum_general);
			$ultimatum_fonts = unserialize('a:3:{s:8:"fontface";b:0;s:6:"google";a:1:{s:17:"Yanone Kaffeesatz";s:25:"Yanone Kaffeesatz:400,700";}s:5:"cufon";b:0;}');
			update_option('ultimatum_fonts', $ultimatum_fonts);
			$ultimatum_1_css = unserialize('a:109:{s:4:"body";a:11:{s:16:"background-color";s:0:"";s:16:"background-image";s:0:"";s:19:"background-position";s:8:"top left";s:17:"background-repeat";s:6:"repeat";s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"18";s:5:"color";s:6:"6e6e6e";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:16:"idlogo-container";a:2:{s:10:"margin-top";s:1:"0";s:13:"margin-bottom";s:1:"0";}s:2:"h1";a:7:{s:11:"font-family";s:54:"google-Yanone Kaffeesatz-css-Yanone Kaffeesatz:400,700";s:9:"font-size";s:2:"36";s:11:"line-height";s:2:"42";s:5:"color";s:6:"333333";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:2:"h2";a:7:{s:11:"font-family";s:54:"google-Yanone Kaffeesatz-css-Yanone Kaffeesatz:400,700";s:9:"font-size";s:2:"30";s:11:"line-height";s:2:"36";s:5:"color";s:6:"333333";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:2:"h3";a:7:{s:11:"font-family";s:54:"google-Yanone Kaffeesatz-css-Yanone Kaffeesatz:400,700";s:9:"font-size";s:2:"24";s:11:"line-height";s:2:"30";s:5:"color";s:6:"333333";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:2:"h4";a:7:{s:11:"font-family";s:54:"google-Yanone Kaffeesatz-css-Yanone Kaffeesatz:400,700";s:9:"font-size";s:2:"18";s:11:"line-height";s:2:"24";s:5:"color";s:6:"333333";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:2:"h5";a:7:{s:11:"font-family";s:54:"google-Yanone Kaffeesatz-css-Yanone Kaffeesatz:400,700";s:9:"font-size";s:2:"14";s:11:"line-height";s:2:"18";s:5:"color";s:6:"333333";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:2:"h6";a:7:{s:11:"font-family";s:54:"google-Yanone Kaffeesatz-css-Yanone Kaffeesatz:400,700";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"333333";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:1:"a";a:4:{s:5:"color";s:6:"6e6e6e";s:11:"font-weight";s:4:"bold";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:6:"ahover";a:4:{s:5:"color";s:6:"4162d1";s:11:"font-weight";s:4:"bold";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:23:"h1classmulti-post-title";a:12:{s:12:"padding-left";s:1:"0";s:16:"background-color";s:0:"";s:16:"background-image";s:0:"";s:19:"background-position";s:8:"top left";s:17:"background-repeat";s:6:"repeat";s:11:"font-family";s:59:"\"Lucida Sans Unicode\",\"Lucida Grande\",Garuda,sans-serif";s:9:"font-size";s:2:"36";s:11:"line-height";s:2:"42";s:5:"color";s:6:"484848";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:21:"classmulti-post-title";a:3:{s:12:"border-width";s:1:"0";s:12:"border-style";s:4:"none";s:12:"border-color";s:0:"";}s:18:"divclasspost-inner";a:8:{s:11:"padding-top";s:1:"0";s:14:"padding-bottom";s:1:"0";s:16:"background-color";s:0:"";s:16:"background-image";s:0:"";s:19:"background-position";s:8:"top left";s:17:"background-repeat";s:6:"repeat";s:12:"border-width";s:9:"0 0 1px 0";s:12:"border-style";s:6:"dotted";}s:15:"classpost-inner";a:1:{s:12:"border-color";s:6:"d3d3d3";}s:16:"classpost-header";a:8:{s:12:"padding-left";s:1:"0";s:16:"background-color";s:0:"";s:16:"background-image";s:0:"";s:19:"background-position";s:8:"top left";s:17:"background-repeat";s:6:"repeat";s:12:"border-width";s:1:"0";s:12:"border-style";s:4:"none";s:12:"border-color";s:0:"";}s:17:"divclasspost-meta";a:4:{s:16:"background-color";s:0:"";s:16:"background-image";s:0:"";s:19:"background-position";s:8:"top left";s:17:"background-repeat";s:6:"repeat";}s:14:"classpost-meta";a:5:{s:12:"border-width";s:1:"0";s:12:"border-style";s:4:"none";s:12:"border-color";s:0:"";s:11:"padding-top";s:1:"0";s:14:"padding-bottom";s:1:"0";}s:23:"h2spaceaclasspost-title";a:7:{s:11:"font-family";s:54:"google-Yanone Kaffeesatz-css-Yanone Kaffeesatz:400,700";s:9:"font-size";s:2:"30";s:11:"line-height";s:2:"36";s:5:"color";s:6:"484848";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:51:"divclasspost-metavirgulspacedivclasspost-metaspacea";a:7:{s:11:"font-family";s:36:"Georgia,\"Nimbus Roman No9 L\",serif";s:9:"font-size";s:2:"11";s:11:"line-height";s:2:"13";s:5:"color";s:6:"404ddb";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:30:"divclasspost-taxonomyspacespan";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:27:"divclasspost-taxonomyspacea";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:21:"aclassreadmorecontent";a:7:{s:11:"font-family";s:36:"Georgia,\"Nimbus Roman No9 L\",serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"12";s:5:"color";s:6:"404ddb";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"italic";s:15:"text-decoration";s:9:"underline";}s:18:"h3idcomments_title";a:7:{s:11:"font-family";s:54:"google-Yanone Kaffeesatz-css-Yanone Kaffeesatz:400,700";s:9:"font-size";s:2:"20";s:11:"line-height";s:2:"25";s:5:"color";s:6:"484848";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:23:"citeclasscomment_author";a:7:{s:11:"font-family";s:44:"\"Trebuchet MS\",Helvetica,Jamrul,sans-serif";s:9:"font-size";s:2:"14";s:11:"line-height";s:2:"18";s:5:"color";s:6:"484848";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:20:"divclasscomment_time";a:7:{s:11:"font-family";s:44:"\"Trebuchet MS\",Helvetica,Jamrul,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"484848";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:20:"divclasscomment_text";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"666666";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:66:"aclasscomment-reply-linkvirgulspaceaclasscancel-comment-reply-link";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"484848";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:14:"h3classrespond";a:7:{s:11:"font-family";s:54:"google-Yanone Kaffeesatz-css-Yanone Kaffeesatz:400,700";s:9:"font-size";s:2:"20";s:11:"line-height";s:2:"25";s:5:"color";s:6:"484848";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:27:"formidcommentformspacelabel";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:127:"divclassbreadcrumbs-plusspacepspacespanvirgulspacedivclassbreadcrumbs-plusspacepvirgulspacedivclassbreadcrumbs-plusspacepspacea";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"404ddb";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:61:"divclassbreadcrumbs-plusspacepspacespanclassbreadcrumbs-title";a:4:{s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:41:"divclassbreadcrumbs-plusspacepspacestrong";a:4:{s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:58:"classwp-pagenavispaceavirgulspaceclasswp-pagenavispacespan";a:8:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";s:16:"background-color";s:0:"";}s:37:"classwp-pagenavispacespanclasscurrent";a:5:{s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";s:16:"background-color";s:0:"";}s:64:"divclasswp-pagenavispaceavirgulspacedivclasswp-pagenavispacespan";a:1:{s:12:"border-color";s:0:"";}s:40:"divclasswp-pagenavispacespanclasscurrent";a:1:{s:12:"border-color";s:0:"";}s:18:"classwfm-mega-menu";a:2:{s:10:"margin-top";s:2:"10";s:13:"margin-bottom";s:1:"0";}s:105:"classwfm-mega-menuspaceulspaceli_-hovervirgulspaceclasswfm-mega-menuspaceulspacelispaceclasssub-container";a:1:{s:16:"background-color";s:6:"efefef";}s:86:"classwfm-mega-menuspaceulspacelispaceclasssubspaceliclassmega-hdrspaceaclassmega-hdr-a";a:8:{s:16:"background-color";s:6:"C2E3E1";s:11:"font-family";s:36:"Georgia,\"Nimbus Roman No9 L\",serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:184:"classwfm-mega-menuspaceulspacelispaceclasssub-containerclassnon-megaspacelispacea_-hovervirgulspaceclasswfm-mega-menuspaceulspacelispaceclasssubspaceulclasssub-menuspacelispacea_-hover";a:1:{s:16:"background-color";s:6:"ffffff";}s:47:"classwfm-mega-menuspaceulclassmenuspacelispacea";a:7:{s:11:"font-family";s:33:"Arial,Helvetica,Garuda,sans-serif";s:9:"font-size";s:2:"14";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:54:"classwfm-mega-menuspaceulclassmenuspaceli_-hoverspacea";a:4:{s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:93:"classwfm-mega-menuspaceulspacelispaceclasssubspaceliclassmega-hdrspaceaclassmega-hdr-a_-hover";a:4:{s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:78:"classwfm-mega-menuspaceulspacelispaceclasssubspaceulclasssub-menuspacelispacea";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:85:"classwfm-mega-menuspaceulspacelispaceclasssubspaceulclasssub-menuspacelispacea_-hover";a:4:{s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:81:"classwfm-mega-menuspaceulspacelispaceclasssub-containerclassnon-megaspacelispacea";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:88:"classwfm-mega-menuspaceulspacelispaceclasssub-containerclassnon-megaspacelispacea_-hover";a:4:{s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:18:"classddsmoothmenuh";a:2:{s:10:"margin-top";s:1:"0";s:13:"margin-bottom";s:2:"20";}s:39:"classddsmoothmenuhspaceulspacelispaceul";a:1:{s:5:"width";s:3:"200";}s:38:"classddsmoothmenuhspaceulspacelispacea";a:1:{s:16:"background-color";s:6:"ffffff";}s:288:"classddsmoothmenuhspaceulspaceli_-hovervirgulclassddsmoothmenuhspaceulspacelispaceaclassselectedvirgulclassddsmoothmenuhspaceulspacelispacea_-hovervirgulclassddsmoothmenuhspaceulspacelispaceulclasssub-menuspacelivirgulspaceclassddsmoothmenuhspaceulspacelispaceulclasssub-menuspacelispacea";a:1:{s:16:"background-color";s:6:"efefef";}s:123:"classddsmoothmenuhspaceulspacelispaceulspaceli_-hovervirgulspaceclassddsmoothmenuhspaceulspacelispaceulspacelispacea_-hover";a:1:{s:16:"background-color";s:6:"ffffff";}s:97:"classddsmoothmenuhspaceulspacelispacea_-linkvirgulclassddsmoothmenuhspaceulspacelispacea_-visited";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"18";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:45:"classddsmoothmenuhspaceulspacelispacea_-hover";a:4:{s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:135:"classddsmoothmenuhspaceulspacelispacespaceulspacelispacea_-linkvirgulclassddsmoothmenuhspaceulspacelispacespaceulspacelispacea_-visited";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:64:"classddsmoothmenuhspaceulspacelispacespaceulspacelispacea_-hover";a:4:{s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:23:"divclasshorizontal-menu";a:2:{s:10:"margin-top";s:1:"0";s:13:"margin-bottom";s:1:"0";}s:43:"divclasshorizontal-menuspaceulspacelispacea";a:1:{s:16:"background-color";s:0:"";}s:44:"divclasshorizontal-menuspaceulspaceli_-hover";a:1:{s:16:"background-color";s:0:"";}s:37:"divclasshorizontal-menuspaceulspaceli";a:1:{s:12:"border-color";s:6:"6e6e6e";}s:155:"divclasshorizontal-menuspaceulspacelivirgulspacedivclasshorizontal-menuspaceulspacelispacea_-linkvirguldivclasshorizontal-menuspaceulspacelispacea_-visited";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"12";s:5:"color";s:6:"6e6e6e";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:50:"divclasshorizontal-menuspaceulspacelispacea_-hover";a:4:{s:5:"color";s:6:"6e6e6e";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:27:"classwfm-vertical-mega-menu";a:2:{s:10:"margin-top";s:1:"0";s:13:"margin-bottom";s:1:"0";}s:123:"classwfm-vertical-mega-menuspaceulspaceli_-hovervirgulspaceclasswfm-vertical-mega-menuspaceulspacelispaceclasssub-container";a:1:{s:16:"background-color";s:6:"efefef";}s:95:"classwfm-vertical-mega-menuspaceulspacelispaceclasssubspaceliclassmega-hdrspaceaclassmega-hdr-a";a:8:{s:16:"background-color";s:6:"C2E3E1";s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:202:"classwfm-vertical-mega-menuspaceulspacelispaceclasssub-containerclassnon-megaspacelispacea_-hovervirgulspaceclasswfm-vertical-mega-menuspaceulspacelispaceclasssubspaceulclasssub-menuspacelispacea_-hover";a:1:{s:16:"background-color";s:6:"ffffff";}s:47:"classwfm-vertical-mega-menuspaceulspacelispacea";a:7:{s:11:"font-family";s:33:"Arial,Helvetica,Garuda,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:54:"classwfm-vertical-mega-menuspaceulspacelispacea_-hover";a:4:{s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:102:"classwfm-vertical-mega-menuspaceulspacelispaceclasssubspaceliclassmega-hdrspaceaclassmega-hdr-a_-hover";a:4:{s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:87:"classwfm-vertical-mega-menuspaceulspacelispaceclasssubspaceulclasssub-menuspacelispacea";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:94:"classwfm-vertical-mega-menuspaceulspacelispaceclasssubspaceulclasssub-menuspacelispacea_-hover";a:4:{s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:90:"classwfm-vertical-mega-menuspaceulspacelispaceclasssub-containerclassnon-megaspacelispacea";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:97:"classwfm-vertical-mega-menuspaceulspacelispaceclasssub-containerclassnon-megaspacelispacea_-hover";a:4:{s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:18:"classddsmoothmenuv";a:2:{s:10:"margin-top";s:1:"0";s:13:"margin-bottom";s:1:"0";}s:149:"classddsmoothmenuvspaceulspacelispacea_-linkvirgulclassddsmoothmenuvspaceulspacelispacea_-visitedvirgulclassddsmoothmenuvspaceulspacelispacea_-active";a:1:{s:16:"background-color";s:6:"ffffff";}s:288:"classddsmoothmenuvspaceulspaceli_-hovervirgulclassddsmoothmenuvspaceulspacelispaceaclassselectedvirgulclassddsmoothmenuvspaceulspacelispacea_-hovervirgulclassddsmoothmenuvspaceulspacelispaceulclasssub-menuspacelivirgulspaceclassddsmoothmenuvspaceulspacelispaceulclasssub-menuspacelispacea";a:1:{s:16:"background-color";s:6:"efefef";}s:123:"classddsmoothmenuvspaceulspacelispaceulspaceli_-hovervirgulspaceclassddsmoothmenuvspaceulspacelispaceulspacelispacea_-hover";a:1:{s:16:"background-color";s:6:"ffffff";}s:97:"classddsmoothmenuvspaceulspacelispacea_-linkvirgulclassddsmoothmenuvspaceulspacelispacea_-visited";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"18";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:45:"classddsmoothmenuvspaceulspacelispacea_-hover";a:4:{s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:135:"classddsmoothmenuvspaceulspacelispacespaceulspacelispacea_-linkvirgulclassddsmoothmenuvspaceulspacelispacespaceulspacelispacea_-visited";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"18";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:64:"classddsmoothmenuvspaceulspacelispacespaceulspacelispacea_-hover";a:4:{s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:24:"classvertical-menuspacea";a:1:{s:16:"background-color";s:6:"ffffff";}s:34:"divclassvertical-menuspacea_-hover";a:1:{s:16:"background-color";s:6:"efefef";}s:69:"classvertical-menuspacea_-linkvirgulclassvertical-menuspacea_-visited";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"18";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:31:"classvertical-menuspacea_-hover";a:4:{s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:24:"ulclasstabsspacelispacea";a:8:{s:16:"background-color";s:6:"ffffff";s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:31:"ulclasstabsspacelispacea_-hover";a:5:{s:16:"background-color";s:6:"d3d3d3";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:36:"ulclasstabsspacelispaceaclasscurrent";a:5:{s:16:"background-color";s:6:"efefef";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:38:"divclasstabs-wrapperspacedivclasspanes";a:8:{s:16:"background-color";s:6:"ffffff";s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:21:"classaccordion-toggle";a:1:{s:16:"background-color";s:6:"d3d3d3";}s:31:"classaccordionspaceclasscurrent";a:1:{s:16:"background-color";s:6:"efefef";}s:34:"divclassaccordionspacedivclasspane";a:8:{s:16:"background-color";s:6:"FFFFFF";s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:23:"h4classaccordion-toggle";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:17:"classtoggle_title";a:1:{s:16:"background-color";s:6:"efefef";}s:19:"classacctogg_active";a:1:{s:16:"background-color";s:6:"d3d3d3";}s:14:"divclasstoggle";a:1:{s:16:"background-color";s:6:"ffffff";}s:40:"classtoggle_titlespaceaclasstoggle-title";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:22:"divclasstoggle_content";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:18:"h2classslidertitle";a:7:{s:11:"font-family";s:33:"\"Arial Black\",Gadget,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:16:"pclassslidertext";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:27:"classslidedeckspace>spacedt";a:7:{s:11:"font-family";s:33:"\"Arial Black\",Gadget,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:18:"h1classsuper-title";a:7:{s:11:"font-family";s:54:"google-Yanone Kaffeesatz-css-Yanone Kaffeesatz:400,700";s:9:"font-size";s:2:"36";s:11:"line-height";s:2:"40";s:5:"color";s:6:"484848";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:20:"h3classelement-title";a:7:{s:11:"font-family";s:54:"google-Yanone Kaffeesatz-css-Yanone Kaffeesatz:400,700";s:9:"font-size";s:2:"24";s:11:"line-height";s:2:"30";s:5:"color";s:6:"484848";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:18:"classelement-title";a:7:{s:16:"background-color";s:0:"";s:16:"background-image";s:0:"";s:19:"background-position";s:8:"top left";s:17:"background-repeat";s:6:"repeat";s:12:"border-width";s:1:"0";s:12:"border-style";s:4:"none";s:12:"border-color";s:0:"";}s:18:"h3classslidertitle";a:7:{s:11:"font-family";s:54:"google-Yanone Kaffeesatz-css-Yanone Kaffeesatz:400,700";s:9:"font-size";s:2:"22";s:11:"line-height";s:2:"36";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:86:"classanyCaptionspaceh3classslidertitlevirgulspaceclasss3captionspaceh3classslidertitle";a:7:{s:11:"font-family";s:54:"google-Yanone Kaffeesatz-css-Yanone Kaffeesatz:400,700";s:9:"font-size";s:2:"16";s:11:"line-height";s:2:"20";s:5:"color";s:6:"d3d3d3";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:82:"classanyCaptionspacepclassslidertextvirgulspaceclasss3captionspacepclassslidertext";a:7:{s:11:"font-family";s:59:"\"Lucida Sans Unicode\",\"Lucida Grande\",Garuda,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"efefef";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:7:"aidlogo";a:7:{s:11:"font-family";s:54:"google-Yanone Kaffeesatz-css-Yanone Kaffeesatz:400,700";s:9:"font-size";s:2:"36";s:11:"line-height";s:2:"42";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}s:13:"spanidtagline";a:7:{s:11:"font-family";s:33:"Tahoma,Geneva,Kalimati,sans-serif";s:9:"font-size";s:2:"12";s:11:"line-height";s:2:"15";s:5:"color";s:6:"000000";s:11:"font-weight";s:6:"normal";s:10:"font-style";s:6:"normal";s:15:"text-decoration";s:4:"none";}}');
			update_option('ultimatum_1_css', $ultimatum_1_css);
			update_option('ultimatum_version', 1);
		}  	
		if($ultimatumversion<2){
			$sql1 = "ALTER TABLE `".$prefix."ultimatum_layout` ADD `theme` INT NOT NULL DEFAULT '1' AFTER `title`";
			$wpdb->query($sql1);
			$sql2 = "CREATE TABLE IF NOT EXISTS `".$prefix."ultimatum_themes` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
			`details` text COLLATE utf8_unicode_ci NOT NULL,
			`browsers` text COLLATE utf8_unicode_ci NOT NULL,
			`width` int(11) NOT NULL,
			`margin` int(11) NOT NULL,
			`published` int(11) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
			dbDelta($sql2);
			$sql3 = "INSERT INTO `".$prefix."ultimatum_themes` (`id`, `name`, `details`, `browsers`, `width`, `margin`, `published`) VALUES (1, '960 grid', '', '', 960, 30, 1)";
			$wpdb->query($sql3);
			update_option('ultimatum_version', 2);
		}			    	
		if($ultimatumversion<2.2){
			$sql1 = "CREATE TABLE `".$prefix."ultimatum_mobile` (
			`id` INT NOT NULL AUTO_INCREMENT ,
			`device` VARCHAR( 255 ) NOT NULL ,
			`theme` INT NOT NULL ,
			PRIMARY KEY ( `id` )
			) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci";
			dbDelta($sql1);
			$sql2 = "ALTER TABLE `".$prefix."ultimatum_themes` ADD `type` INT NOT NULL AFTER `margin`";
			$wpdb->query($sql2);
			$sql3 = "ALTER TABLE `".$prefix."ultimatum_slides` CHANGE `images` `images` LONGTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL";
			$wpdb->query($sql3);
			update_option('ultimatum_version', 2.2);
		}			    	
		if($ultimatumversion<2.3){
			$sql1 = "INSERT INTO `".$prefix."ultimatum_mobile` (`id`, `device`, `theme`) VALUES
			(1, 'iPhone', 0),
			(2, 'iPad', 0),
			(3, 'iPod', 0),
			(4, 'Android', 0),
			(5, 'AndroidTablet', 0),
			(6, 'BlackBerry', 0)";
			$wpdb->query($sql1);
			update_option('ultimatum_version', 2.3);
		}			   		
		if($ultimatumversion<2.31){
			$ccsconverter = array(
					"cssvar1" => "body",
					"cssvar2" => "idlogo-container",
					"cssvar3" => "h1",
					"cssvar4" => "h2",
					"cssvar5" => "h3",
					"cssvar6" => "h4",
					"cssvar7" => "h5",
					"cssvar8" => "h6",
					"cssvar9" => "a",
					"cssvar10" => "ahover",
					"cssvar11" => "h1classmulti-post-title",
					"cssvar12" => "classmulti-post-title",
					"cssvar13" => "divclasspost-inner",
					"cssvar14" => "classpost-inner",
					"cssvar15" => "classpost-header",
					"cssvar16" => "divclasspost-meta",
					"cssvar17" => "classpost-meta",
					"cssvar18" => "h2spaceaclasspost-title",
					"cssvar19" => "divclasspost-metavirgulspacedivclasspost-metaspacea",
					"cssvar20" => "divclasspost-taxonomyspacespan",
					"cssvar21" => "divclasspost-taxonomyspacea",
					"cssvar22" => "aclassreadmorecontent",
					"cssvar23" => "h3idcomments_title",
					"cssvar24" => "citeclasscomment_author",
					"cssvar25" => "divclasscomment_time",
					"cssvar26" => "divclasscomment_text",
					"cssvar27" => "aclasscomment-reply-linkvirgulspaceaclasscancel-comment-reply-link",
					"cssvar28" => "h3classrespond",
					"cssvar29" => "formidcommentformspacelabel",
					"cssvar30" => "divclassbreadcrumbs-plusspacepspacespanvirgulspacedivclassbreadcrumbs-plusspacepvirgulspacedivclassbreadcrumbs-plusspacepspacea",
					"cssvar31" => "divclassbreadcrumbs-plusspacepspacespanclassbreadcrumbs-title",
					"cssvar32" => "divclassbreadcrumbs-plusspacepspacestrong",
					"cssvar33" => "classwp-pagenavispaceavirgulspaceclasswp-pagenavispacespan",
					"cssvar34" => "classwp-pagenavispacespanclasscurrent",
					"cssvar35" => "divclasswp-pagenavispaceavirgulspacedivclasswp-pagenavispacespan",
					"cssvar36" => "divclasswp-pagenavispacespanclasscurrent",
					"cssvar37" => "classwfm-mega-menu",
					"cssvar38" => "classwfm-mega-menuspaceulspaceli_-hovervirgulspaceclasswfm-mega-menuspaceulspacelispaceclasssub-container",
					"cssvar39" => "classwfm-mega-menuspaceulspacelispaceclasssubspaceliclassmega-hdrspaceaclassmega-hdr-a",
					"cssvar40" => "classwfm-mega-menuspaceulspacelispaceclasssub-containerclassnon-megaspacelispacea_-hovervirgulspaceclasswfm-mega-menuspaceulspacelispaceclasssubspaceulclasssub-menuspacelispacea_-hover",
					"cssvar41" => "classwfm-mega-menuspaceulclassmenuspacelispacea",
					"cssvar42" => "classwfm-mega-menuspaceulclassmenuspaceli_-hoverspacea",
					"cssvar43" => "classwfm-mega-menuspaceulspacelispaceclasssubspaceliclassmega-hdrspaceaclassmega-hdr-a_-hover",
					"cssvar44" => "classwfm-mega-menuspaceulspacelispaceclasssubspaceulclasssub-menuspacelispacea",
					"cssvar45" => "classwfm-mega-menuspaceulspacelispaceclasssubspaceulclasssub-menuspacelispacea_-hover",
					"cssvar46" => "classwfm-mega-menuspaceulspacelispaceclasssub-containerclassnon-megaspacelispacea",
					"cssvar47" => "classwfm-mega-menuspaceulspacelispaceclasssub-containerclassnon-megaspacelispacea_-hover",
					"cssvar48" => "classddsmoothmenuh",
					"cssvar49" => "classddsmoothmenuhspaceulspacelispaceul",
					"cssvar50" => "classddsmoothmenuhspaceulspacelispacea",
					"cssvar51" => "classddsmoothmenuhspaceulspaceli_-hovervirgulclassddsmoothmenuhspaceulspacelispaceaclassselectedvirgulclassddsmoothmenuhspaceulspacelispacea_-hovervirgulclassddsmoothmenuhspaceulspacelispaceulclasssub-menuspacelivirgulspaceclassddsmoothmenuhspaceulspacelispaceulclasssub-menuspacelispacea",
					"cssvar52" => "classddsmoothmenuhspaceulspacelispaceulspaceli_-hovervirgulspaceclassddsmoothmenuhspaceulspacelispaceulspacelispacea_-hover",
					"cssvar53" => "classddsmoothmenuhspaceulspacelispacea_-linkvirgulclassddsmoothmenuhspaceulspacelispacea_-visited",
					"cssvar54" => "classddsmoothmenuhspaceulspacelispacea_-hover",
					"cssvar55" => "classddsmoothmenuhspaceulspacelispacespaceulspacelispacea_-linkvirgulclassddsmoothmenuhspaceulspacelispacespaceulspacelispacea_-visited",
					"cssvar56" => "classddsmoothmenuhspaceulspacelispacespaceulspacelispacea_-hover",
					"cssvar57" => "divclasshorizontal-menu",
					"cssvar58" => "divclasshorizontal-menuspaceulspacelispacea",
					"cssvar59" => "divclasshorizontal-menuspaceulspaceli_-hover",
					"cssvar60" => "divclasshorizontal-menuspaceulspaceli",
					"cssvar61" => "divclasshorizontal-menuspaceulspacelivirgulspacedivclasshorizontal-menuspaceulspacelispacea_-linkvirguldivclasshorizontal-menuspaceulspacelispacea_-visited",
					"cssvar62" => "divclasshorizontal-menuspaceulspacelispacea_-hover",
					"cssvar63" => "classwfm-vertical-mega-menu",
					"cssvar64" => "classwfm-vertical-mega-menuspaceulspaceli_-hovervirgulspaceclasswfm-vertical-mega-menuspaceulspacelispaceclasssub-container",
					"cssvar65" => "classwfm-vertical-mega-menuspaceulspacelispaceclasssubspaceliclassmega-hdrspaceaclassmega-hdr-a",
					"cssvar66" => "classwfm-vertical-mega-menuspaceulspacelispaceclasssub-containerclassnon-megaspacelispacea_-hovervirgulspaceclasswfm-vertical-mega-menuspaceulspacelispaceclasssubspaceulclasssub-menuspacelispacea_-hover",
					"cssvar67" => "classwfm-vertical-mega-menuspaceulspacelispacea",
					"cssvar68" => "classwfm-vertical-mega-menuspaceulspacelispacea_-hover",
					"cssvar69" => "classwfm-vertical-mega-menuspaceulspacelispaceclasssubspaceliclassmega-hdrspaceaclassmega-hdr-a_-hover",
					"cssvar70" => "classwfm-vertical-mega-menuspaceulspacelispaceclasssubspaceulclasssub-menuspacelispacea",
					"cssvar71" => "classwfm-vertical-mega-menuspaceulspacelispaceclasssubspaceulclasssub-menuspacelispacea_-hover",
					"cssvar72" => "classwfm-vertical-mega-menuspaceulspacelispaceclasssub-containerclassnon-megaspacelispacea",
					"cssvar73" => "classwfm-vertical-mega-menuspaceulspacelispaceclasssub-containerclassnon-megaspacelispacea_-hover",
					"cssvar74" => "classddsmoothmenuv",
					"cssvar75" => "classddsmoothmenuvspaceulspacelispacea_-linkvirgulclassddsmoothmenuvspaceulspacelispacea_-visitedvirgulclassddsmoothmenuvspaceulspacelispacea_-active",
					"cssvar76" => "classddsmoothmenuvspaceulspaceli_-hovervirgulclassddsmoothmenuvspaceulspacelispaceaclassselectedvirgulclassddsmoothmenuvspaceulspacelispacea_-hovervirgulclassddsmoothmenuvspaceulspacelispaceulclasssub-menuspacelivirgulspaceclassddsmoothmenuvspaceulspacelispaceulclasssub-menuspacelispacea",
					"cssvar77" => "classddsmoothmenuvspaceulspacelispaceulspaceli_-hovervirgulspaceclassddsmoothmenuvspaceulspacelispaceulspacelispacea_-hover",
					"cssvar78" => "classddsmoothmenuvspaceulspacelispacea_-linkvirgulclassddsmoothmenuvspaceulspacelispacea_-visited",
					"cssvar79" => "classddsmoothmenuvspaceulspacelispacea_-hover",
					"cssvar80" => "classddsmoothmenuvspaceulspacelispacespaceulspacelispacea_-linkvirgulclassddsmoothmenuvspaceulspacelispacespaceulspacelispacea_-visited",
					"cssvar81" => "classddsmoothmenuvspaceulspacelispacespaceulspacelispacea_-hover",
					"cssvar82" => "classvertical-menuspacea",
					"cssvar83" => "divclassvertical-menuspacea_-hover",
					"cssvar84" => "classvertical-menuspacea_-linkvirgulclassvertical-menuspacea_-visited",
					"cssvar85" => "classvertical-menuspacea_-hover",
					"cssvar86" => "ulclasstabsspacelispacea",
					"cssvar87" => "ulclasstabsspacelispacea_-hover",
					"cssvar88" => "ulclasstabsspacelispaceaclasscurrent",
					"cssvar89" => "divclasstabs-wrapperspacedivclasspanes",
					"cssvar90" => "classaccordion-toggle",
					"cssvar91" => "classaccordionspaceclasscurrent",
					"cssvar92" => "divclassaccordionspacedivclasspane",
					"cssvar93" => "h4classaccordion-toggle",
					"cssvar94" => "classtoggle_title",
					"cssvar95" => "classacctogg_active",
					"cssvar96" => "divclasstoggle",
					"cssvar97" => "classtoggle_titlespaceaclasstoggle-title",
					"cssvar98" => "divclasstoggle_content",
					"cssvar99" => "h2classslidertitle",
					"cssvar100" => "pclassslidertext",
					"cssvar101" => "classslidedeckspace>spacedt",
					"cssvar102" => "h1classsuper-title",
					"cssvar103" => "h3classelement-title",
					"cssvar104" => "classelement-title",
					"cssvar105" => "h3classslidertitle",
					"cssvar106" => "classanyCaptionspaceh3classslidertitlevirgulspaceclasss3captionspaceh3classslidertitle",
					"cssvar107" => "classanyCaptionspacepclassslidertextvirgulspaceclasss3captionspacepclassslidertext",
					"cssvar108" => "aidlogo",
					"cssvar109" => "spanidtagline",
					"cssvar110" => "blockquote",
					"cssvar111" => "classwfm-mega-menuspaceulspaceliclasscurrent-menu-ancestorvirgulspaceclasswfm-mega-menuspaceulspaceliclasscurrent-menu-item",
					"cssvar112" => "classwfm-mega-menuspaceulspaceliclasscurrent-menu-ancestorspaceavirgulspaceclasswfm-mega-menuspaceulspaceliclasscurrent-menu-itemspacea"
			);
			// Do widgets
			$sidebars = get_option('sidebars_widgets');
			update_option('ultimatum_sidebars_widgets', $sidebars);
			// Do CSS Vars
			$sql = "SELECT * FROM `".$prefix."ultimatum_layout` WHERE `type`='full'";
			$result = $wpdb->get_results($sql,ARRAY_A);
			foreach($result as $f){
				$option = 'ultimatum_'.$f["id"].'_css';
				$old = get_option($option);
				foreach($ccsconverter as $key=>$value){
					$new[$key] = $old[$value];
				}
				update_option($option, $new);
			}
			update_option('ultimatum_version', 2.31);
		}			   		
		if($ultimatumversion<2.364){
			$gensettings = get_option('ultimatum_general');
			$themesettings = get_option(THEME_SLUG.'_ultimatum_access');
			$gensettings['sidebars'] = $themesettings['sidebars'];
			update_option('ultimatum_general', $gensettings);
			update_option('ultimatum_version', 2.364);
		}			   		
		if($ultimatumversion<2.367){
			$sql_class = "CREATE TABLE IF NOT EXISTS `".$prefix."ultimatum_classes` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`container` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
			`user_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
			`hidephone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
			`hidetablet` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
			`hidedesktop` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
			`layout_id` int(11) NOT NULL,
			PRIMARY KEY (`id`),
			UNIQUE KEY `container` (`container`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
			dbDelta($sql_class);
			update_option('ultimatum_version', 2.367);
		}			   		
		
		if($ultimatumversion<2.37){
			$queries =array(
						"ALTER TABLE  `".$prefix."ultimatum_themes` ADD  `template` VARCHAR( 255 ) NOT NULL",
						"UPDATE  `".$prefix."ultimatum_themes` SET  `template` =  'ultimatum'",
						"ALTER TABLE  `".$prefix."ultimatum_layout_assign` DROP INDEX  `post_type`",
						"ALTER TABLE  `".$prefix."ultimatum_layout_assign` ADD  `template` VARCHAR( 50 ) NOT NULL FIRST",
						"UPDATE  `".$prefix."ultimatum_layout_assign` SET  `template` =  'ultimatum'",
						"ALTER TABLE  `".$prefix."ultimatum_layout_assign` ADD UNIQUE  `ultindex` (  `template` ,  `post_type` )",
					);
			foreach($queries as $query){
				$wpdb->query($query);
			}
			$ultimatum = get_option('ultimatum_general');
			$ultimatum['ultimatum_slideshows']=1;
			$ultimatum['ultimatum_forms']=1;
			update_option('ultimatum_general',$ultimatum);
			update_option('ultimatum_version', 2.37);
		}
		if($ultimatumversion<2.37037){
			update_option('ultimatum_version', 2.37037);
		}	   		
	}
}

$wonder = new WonderWorks();
$wonder->init($theme);
