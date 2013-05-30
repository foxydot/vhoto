<?php
if (!class_exists('MSDContestFormCPT')) {
	class MSDContestFormCPT {
		//Properties
		var $cpt = 'contest_entry';
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
  } //End Class
} //End if class exists statement