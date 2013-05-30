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
        }
        
    
        /**
         * @desc Add role
         */
        function add_contest_roles(){
        	add_role('contest','Contest Entry',array(
        		'read' => TRUE,
        		'upload_files' => TRUE,
        		'edit_contest_entry' => TRUE,
        		'publish_contest_entry' => TRUE
        	));
        }  

        function remove_contest_roles(){
        	remove_role('contest');    
        }
        
        function fb_show_admin_bar() {
			 if ( current_user_can( 'manage_options' ) )
			 return TRUE;
			 else
			 return FALSE;
		 }        
  } //End Class
} //End if class exists statement