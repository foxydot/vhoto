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
        	$entry_form_id = get_option('entry-form-id');
        	add_action('gform_after_submission_'.$entry_form_id, array(&$this,'update_user_meta'), 10, 2);
        	 
			//Filters
		}
		
		function import_contest_entry_form(){
			$filepath = WP_PLUGIN_DIR.'/'.plugin_dir_path('msd-vhotopic/msd-vhotopic.php').'lib/xml/contest_entry.xml';
			GFExport::import_file($filepath);
			
			$entry_form_id = RGFormsModel::get_form_id( 'Enter a Photo Contest' );
			update_option('entry-form-id', $entry_form_id);
		}
		
		function update_user_meta($entry, $form) {
			global $current_user;
			get_currentuserinfo();
			//getting post
			$user_id = $current_user->ID;
			update_user_meta($user_id, 'first_name', $entry['10.3']);
			update_user_meta($user_id, 'last_name', $entry['10.6']);
			update_user_meta($user_id, 'address_street_1', $entry['11.1']);
			update_user_meta($user_id, 'address_street_2', $entry['11.2']);
			update_user_meta($user_id, 'address_city', $entry['11.3']);
			update_user_meta($user_id, 'address_state', $entry['11.4']);
			update_user_meta($user_id, 'address_zip', $entry['11.5']);
			update_user_meta($user_id, 'address_country', $entry['11.6']);
			update_user_meta($user_id, 'birthdate', $entry['13']);
			update_user_meta($user_id, 'terms_agreement', $entry['12']);
			$user = new WP_User($user_id);
			$user->set_role('contest');
		}
  } //End Class
} //End if class exists statement