<?php
/*
Plugin Name: MSD Vhotopic Contest
Description: Custom contest plugin for Vhotopic.com
Author: Catherine Sandrick
Version: 0.0.1
Author URI: http://msdlab.com
*/

if(!class_exists('WPAlchemy_MetaBox')){
	include_once (plugin_dir_path(__FILE__).'/lib/wpalchemy/MetaBox.php');
}
if(!class_exists('WPAlchemy_MediaAccess')){
	include_once (plugin_dir_path(__FILE__).'/lib/wpalchemy/MediaAccess.php');
}
global $msd_contest;

/*
 * Pull in some stuff from other files
*/
if(!function_exists('requireDir')){
	function requireDir($dir){
		$dh = @opendir($dir);

		if (!$dh) {
			throw new Exception("Cannot open directory $dir");
		} else {
			while($file = readdir($dh)){
				$files[] = $file;
			}
			closedir($dh);
			sort($files); //ensure alpha order
			foreach($files AS $file){
				if ($file != '.' && $file != '..') {
					$requiredFile = $dir . DIRECTORY_SEPARATOR . $file;
					if ('.php' === substr($file, strlen($file) - 4)) {
						require_once $requiredFile;
					} elseif (is_dir($requiredFile)) {
						requireDir($requiredFile);
					}
				}
			}
		}
		unset($dh, $dir, $file, $requiredFile);
	}
}
if (!class_exists('MSDContestPackage')) {
    class MSDContestPackage {
    	//Properites
    	/**
    	 * @var string The plugin version
    	 */
    	var $version = '0.0.1';
    	
    	/**
    	 * @var string The options string name for this plugin
    	 */
    	var $optionsName = 'msd_contest_options';
    	
    	/**
    	 * @var string $nonce String used for nonce security
    	 */
    	var $nonce = 'msd_contest-update-options';
    	
    	/**
    	 * @var string $localizationDomain Domain used for localization
    	 */
    	var $localizationDomain = "msd_contest";
    	
    	/**
    	 * @var string $pluginurl The path to this plugin
    	 */
    	var $plugin_url = '';
    	/**
    	 * @var string $pluginurlpath The path to this plugin
    	 */
    	var $plugin_path = '';
    	
    	/**
    	 * @var array $options Stores the options for this plugin
    	 */
    	var $options = array();
        //Methods
        /**
        * PHP 4 Compatible Constructor
        */
        function MSDContestPackage(){$this->__construct();}
        
        /**
        * PHP 5 Constructor
        */        
        function __construct(){
        	//"Constants" setup
        	$this->plugin_url = plugin_dir_url(__FILE__).'/';
        	$this->plugin_path = plugin_dir_path(__FILE__).'/';
        	//Initialize the options
        	$this->get_options();
        	//check requirements
        	register_activation_hook(__FILE__, array(&$this,'check_requirements'));
        	//get sub-packages
        	requireDir(plugin_dir_path(__FILE__).'/lib/inc');
        	if(class_exists('MSDContestUser')){
        		$this->user_class = new MSDContestUser();
        		register_activation_hook( __FILE__, array( 'MSDContestUser', 'add_contest_roles' ) );
        		register_deactivation_hook( __FILE__, array( 'MSDContestUser', 'remove_contest_roles' ));
        	}
        	if(class_exists('MSDContestEntryCPT')){
        		$this->cpt_class = new MSDContestEntryCPT();
        		register_activation_hook( __FILE__, create_function('','flush_rewrite_rules( TRUE );') );
        		register_deactivation_hook( __FILE__, create_function('','flush_rewrite_rules( TRUE );') );
        	}
        	if(class_exists('MSDContestForm')){
        		$this->form_class = new MSDContestForm();
        		register_activation_hook( __FILE__, array( 'MSDContestForm', 'import_contest_entry_form' ) );
        	}
        	if(class_exists('MSDContestDisplay')){
        		$this->display_class = new MSDContestDisplay();
        	}
        }

        /**
         * @desc Loads the options. Responsible for handling upgrades and default option values.
         * @return array
         */
        function check_options() {
        	$options = null;
        	if (!$options = get_option($this->optionsName)) {
        		// default options for a clean install
        		$options = array(
        				'version' => $this->version,
        				'reset' => true
        		);
        		update_option($this->optionsName, $options);
        	}
        	else {
        		// check for upgrades
        		if (isset($options['version'])) {
        			if ($options['version'] < $this->version) {
        				// post v1.0 upgrade logic goes here
        			}
        		}
        		else {
        			// pre v1.0 updates
        			if (isset($options['admin'])) {
        				unset($options['admin']);
        				$options['version'] = $this->version;
        				$options['reset'] = true;
        				update_option($this->optionsName, $options);
        			}
        		}
        	}
        	return $options;
        }
        
        /**
         * @desc Retrieves the plugin options from the database.
         */
        function get_options() {
        	$options = $this->check_options();
        	$this->options = $options;
        }
        /**
         * @desc Check to see if requirements are met
         */
        function check_requirements(){
        	if( !is_plugin_active( 'gravityforms/gravityforms.php' ) ) {
        		die( '<strong>ERROR:</strong> <a href="http://www.gravityforms.com/" target="_blank">Gravity Forms</a> is required for this plugin to be installed.' );
        	}
        	if( !is_plugin_active( 'gravity-forms-custom-post-types/gfcptaddon.php' ) ) {
        		die( '<strong>ERROR:</strong> <a href="http://wordpress.org/plugins/gravity-forms-custom-post-types/" target="_blank">Gravity Forms + Custom Post Types</a> is required for this plugin to be installed.' );
        	}
        }
        /**
         * @desc Checks to see if the given plugin is active.
         * @return boolean
         */
        function is_plugin_active($plugin) {
        	return in_array($plugin, (array) get_option('active_plugins', array()));
        }
        /***************************/
  } //End Class
} //End if class exists statement

//instantiate
$msd_contest = new MSDContestPackage();