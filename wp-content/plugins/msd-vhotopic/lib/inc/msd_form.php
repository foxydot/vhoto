<?php
if (!class_exists('MSDContestForm')) {
	class MSDContestForm {
		//Properties
		var $cpt = 'contest_entry';
		var $plugin_url;
		var $plugin_path;
		//Methods
		/**
		* PHP 4 Compatible Constructor
		*/
		public function MSDContestFormCPT(){$this->__construct();}

		/**
		* PHP 5 Constructor
		 */
		 function __construct(){
			//"Constants" setup
			$this->plugin_url = plugin_dir_url('msd-vhotopic/msd-vhotopic.php');
        	$this->plugin_path = plugin_dir_path('msd-vhotopic/msd-vhotopic.php');
			//Actions
			//Filters
		}
		
		function import_contest_entry_form(){
			$filepath = WP_PLUGIN_DIR.'/'.plugin_dir_path('msd-vhotopic/msd-vhotopic.php').'lib/xml/contest_entry.xml';
			GFExport::import_file($filepath);
		}
  } //End Class
} //End if class exists statement