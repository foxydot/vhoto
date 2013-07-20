<?php
if (!class_exists('MSDContestEntryCPT')) {
	class MSDContestEntryCPT {
		//Properties
		var $cpt = 'contest_entry';
		//Methods
	    /**
	    * PHP 4 Compatible Constructor
	    */
		public function MSDContestEntryCPT(){$this->__construct();}
	
		/**
		 * PHP 5 Constructor
		 */
		function __construct(){
			global $current_screen;
        	//"Constants" setup
        	$this->plugin_url = plugin_dir_url('msd-vhotopic/msd-vhotopic.php');
        	$this->plugin_path = plugin_dir_path('msd-vhotopic/msd-vhotopic.php');
			//Actions
			add_action( 'init', array(&$this,'register_tax_contest') );
			add_action( 'init', array(&$this,'register_cpt_entry') );
			add_action('admin_head', array(&$this,'plugin_header'));
				
			if($current_screen->post_type == 'contest_entry'){
				add_action('admin_print_scripts', array(&$this,'add_admin_scripts') );
				add_action('admin_print_styles', array(&$this,'add_admin_styles') );
				add_action('admin_footer',array(&$this,'info_footer_hook') );
				// important: note the priority of 99, the js needs to be placed after tinymce loads
				add_action('admin_print_footer_scripts',array(&$this,'print_footer_scripts'),99);
			}
			//Filters
			add_filter( 'pre_get_posts', array(&$this,'archive_query') );
			add_filter( 'enter_title_here', array(&$this,'change_default_title') );
		}
		
		public function register_tax_contest() {
		
		    $labels = array( 
		        'name' => _x( 'Contests', 'contest' ),
		        'singular_name' => _x( 'Contest', 'contest' ),
		        'search_items' => _x( 'Search contests', 'contest' ),
		        'popular_items' => _x( 'Popular contests', 'contest' ),
		        'all_items' => _x( 'All contests', 'contest' ),
		        'parent_item' => _x( 'Parent contest', 'contest' ),
		        'parent_item_colon' => _x( 'Parent contest:', 'contest' ),
		        'edit_item' => _x( 'Edit contest', 'contest' ),
		        'update_item' => _x( 'Update contest', 'contest' ),
		        'add_new_item' => _x( 'Add new contest', 'contest' ),
		        'new_item_name' => _x( 'New contest name', 'contest' ),
		        'separate_items_with_commas' => _x( 'Separate contests with commas', 'contest' ),
		        'add_or_remove_items' => _x( 'Add or remove contests', 'contest' ),
		        'choose_from_most_used' => _x( 'Choose from the most used contests', 'contest' ),
		        'menu_name' => _x( 'Contests', 'contest' ),
		    );
		
		    $args = array( 
		        'labels' => $labels,
		        'public' => true,
		        'show_in_nav_menus' => true,
		        'show_ui' => true,
		        'show_tagcloud' => false,
		        'hierarchical' => true, //we want a "category" style taxonomy, but may have to restrict selection via a dropdown or something.
		
		        'rewrite' => array('slug'=>'contests','with_front'=>false),
			    'query_var' => true
		    );
		
		    register_taxonomy( 'contest', array($this->cpt), $args );
		}
		
		function register_cpt_entry() {
		
		    $labels = array( 
		        'name' => _x( 'Contest Entries', 'entry' ),
		        'singular_name' => _x( 'Contest Entry', 'entry' ),
		        'add_new' => _x( 'Add New', 'entry' ),
		        'add_new_item' => _x( 'Add New Contest Entry', 'entry' ),
		        'edit_item' => _x( 'Edit Contest Entry', 'entry' ),
		        'new_item' => _x( 'New Contest Entry', 'entry' ),
		        'view_item' => _x( 'View Contest Entry', 'entry' ),
		        'search_items' => _x( 'Search Contest Entry', 'entry' ),
		        'not_found' => _x( 'No contest entries found', 'entry' ),
		        'not_found_in_trash' => _x( 'No contest entries found in Trash', 'entry' ),
		        'parent_item_colon' => _x( 'Parent Contest Entry:', 'entry' ),
		        'menu_name' => _x( 'Contest Entries', 'entry' ),
		    );
		
		    $args = array( 
		        'labels' => $labels,
		        'hierarchical' => false,
		        'description' => 'Vhotopic Contest Entries',
		        'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail'),
		        'taxonomies' => array( 'contest' ),
		        'public' => true,
		        'show_ui' => true,
		        'show_in_menu' => true,
		        'menu_position' => 20,
		        
		        'show_in_nav_menus' => true,
		        'publicly_queryable' => true,
		        'exclude_from_search' => true,
		        'has_archive' => true,
		        'query_var' => true,
		        'can_export' => true,
		        'rewrite' => array('slug'=>'contest-entries','with_front'=>false),
		        'capability_type' => 'post'
		    );
		
		    register_post_type( $this->cpt, $args );
		}
		
		function plugin_header() {
			global $post_type;
			?>
			<style>
			#adminmenu #menu-posts-<?php print $this->cpt; ?> div.wp-menu-image{background:transparent url("<?php print $this->plugin_url; ?>lib/img/trophy.png") no-repeat center -18px;}
			#adminmenu #menu-posts-<?php print $this->cpt; ?>:hover div.wp-menu-image,#adminmenu #menu-posts-<?php print $this->cpt; ?>.wp-has-current-submenu div.wp-menu-image{background-position: center 6px;}	
		    </style>
		    <?php
		}
		 
		function add_admin_scripts() {
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
			wp_register_script('my-upload', plugin_dir_url(dirname(__FILE__)).'/js/msd-upload-file.js', array('jquery','media-upload','thickbox'),FALSE,TRUE);
			wp_enqueue_script('my-upload');
		}
		
		function add_admin_styles() {
			wp_enqueue_style('thickbox');
			wp_enqueue_style('custom_meta_css',plugin_dir_url(dirname(__FILE__)).'/template/meta.css');
		}	
			
		function print_footer_scripts()
		{
			print '<script type="text/javascript">/* <![CDATA[ */
				jQuery(function($)
				{
					var i=1;
					$(\'.customEditor textarea\').each(function(e)
					{
						var id = $(this).attr(\'id\');
		 
						if (!id)
						{
							id = \'customEditor-\' + i++;
							$(this).attr(\'id\',id);
						}
		 
						tinyMCE.execCommand(\'mceAddControl\', false, id);
		 
					});
				});
			/* ]]> */</script>';
		}
		function change_default_title( $title ){
			global $current_screen;
			if  ( $current_screen->post_type == $cpt ) {
				return __('Give Your Entry A Name','contest_entry');
			} else {
				return $title;
			}
		}
		function info_footer_hook()
		{
		?><script type="text/javascript">
				jQuery('#titlediv').after(jQuery('#_portfolio_metabox'));
				jQuery('#postdivrich').hide();
			</script><?php
		}
		

		function archive_query( $query ) {
			$is_contest = ($query->query_vars['contest'])?TRUE:FALSE;
			if( $query->is_main_query() && $query->is_archive && $is_contest ) {
				$query->set( 'orderby', 'date');
				$query->set( 'order', 'ASC');
				$query->set( 'posts_per_page', 100 );
				$query->set( 'post_type', $this->cpt );
			}
		}
  } //End Class
} //End if class exists statement