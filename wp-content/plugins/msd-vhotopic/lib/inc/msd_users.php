<?php
if (!class_exists('MSDContestUser')) {
    class MSDContestUser {
    	//Properites
        //Methods
        /**
        * PHP 4 Compatible Constructor
        */
        function MSDContestUser(){$this->__construct();}
        
        /**
        * PHP 5 Constructor
        */        
        function __construct(){
            //Actions        
            add_filter( 'show_admin_bar', array(&$this,'fb_show_admin_bar') );
            add_filter('gform_field_value_user_role', array(&$this,'gform_populate_user_role'));
            
            add_action('register_form',array(&$this,'show_extra_fields'));
            add_action('user_register', array(&$this,'register_role'));
        }

        /**
         * @desc Add role
         */
        function add_contest_roles(){
        	add_role('contest','Contest Entry',array(
        		'read' => TRUE,
        		'upload_files' => TRUE,
        		'edit_contest_entry' => TRUE,
        		'publish_contest_entry' => TRUE,
        		'place_vote' => TRUE
        	));
        	$role = get_role('subscriber');
        	$role->add_cap( 'place_vote' );
        }  

        function remove_contest_roles(){
        	remove_role('contest');  
        	$role = get_role('subscriber');
        	$role->remove_cap( 'place_vote' );
        }
        
        function gform_populate_user_role($value){
        	$user = wp_get_current_user();
        	$role = $user->roles;
        	if(empty($role)){$role = 'anonymous';}
        	return reset($role);
        }
        /*
         * TODO
         */
			function show_extra_fields(){ ?>
			<input id="role" type="hidden" tabindex="20" size="25" value= "<?php if (isset($_GET['role'])){echo $_GET['role'];} ?>"  name="role"/>
				<?php
			}
			
         function register_role($user_id, $password="", $meta=array()) {
        
        	$userdata = array();
        	$userdata['ID'] = $user_id;
        	$userdata['role'] = $_POST['role'];
        
        	//only allow if user role is my_role
        
        	if ($userdata['role'] == "my_role"){
        		wp_update_user($userdata);
        	}
        }
        
        function fb_show_admin_bar() {
			 if ( current_user_can( 'manage_options' ) )
			 return TRUE;
			 else
			 return FALSE;
		 }        
  } //End Class
} //End if class exists statement