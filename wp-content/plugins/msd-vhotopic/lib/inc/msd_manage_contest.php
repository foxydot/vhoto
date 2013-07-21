<?php

if (!class_exists('MSDContestManager')) {
	class MSDContestManager {
		//Properties
		var $my_settings_page = 'toplevel_page_msd-contest-management';
		//Methods
		/**
		 * PHP 4 Compatible Constructor
		 */
		 public function MSDContestManager(){$this->__construct();}
		
		 /**
		 * PHP 5 Constructor
		 */
		 function __construct(){
		 //"Constants" setup
		 	$this->plugin_url = plugin_dir_url('msd-vhotopic/msd-vhotopic.php');
		 	$this->plugin_path = plugin_dir_path('msd-vhotopic/msd-vhotopic.php');
			//Actions
		 	add_action('admin_menu', array(&$this,'msd_manage_contest_page'));
		 	add_action( 'admin_enqueue_scripts', array(&$this,'msd_manage_contest_scripts' ));
		 	add_action( 'wp_before_admin_bar_render', array(&$this,'clean_admin_bar' ));
		 	add_action('admin_head', array(&$this,'plugin_header'));
		 	
		 	//Filters
		 }
		 /**
		  * Need to be able to: 
		  * set up contests (taxonomy)
		  * see contest entries/votes of a given taxonomy tag
		  * open/close contests
		  */
		 /**
		  * Set up page
		  */
		 function msd_manage_contest_page ()
		 {
		 	global $wpdb,$table_prefix;
		 
		 	if ( count($_POST) > 0 && isset($_POST['msd_manage_contest']) )
		 	{
		 		$this->msd_manage_contest_submission($_POST);
		 	}
		 	add_menu_page(__('Contest Management'), __('Contests'), 'administrator', 'msd-contest-management', array(&$this,'msd_contest_management'),'',3);
		 }
		 
		 /**
		  * Manage submissions
		  */
		 function msd_manage_contest_submission($data){
		 	if(isset($data['contest_name'])){ //editing or adding a contest
		 		if(isset($data['contest_id'])){
		 			$term_id = $data['contest_id'];
		 			wp_update_term($term_id, 'contest', array('name'=>$data['contest_name'],'description'=>$data['contest_desc']));
		 		} else {
		 			$term_info = wp_insert_term($data['contest_name'],'contest',array('description'=>$data['contest_desc']));
		 			$term_id = $term_info['term_id'];
		 		}
		 		update_option('contest_'.$term_id.'_meta',$data);
		 	}
		 }
		 
		 /**
		  * This page is the actual form for managing the contest
		  */
		 function msd_contest_management()
		 {
		 	global $wpdb,$network_table_prefix;
		 	$all_contests = get_terms('contest',array('hide_empty'=>FALSE));
		 	foreach($all_contests AS $k => $v){
		 		$meta = get_option('contest_'.$v->term_id.'_meta');
		 		$all_contests[$k]->start_date = $meta['contest_start_date']; 
		 		$all_contests[$k]->end_date = $meta['contest_end_date'];
		 		$all_contests[$k]->winner = $this->get_contest_winner($v->term_id);
		 		$start = strtotime($meta['contest_start_date']);
		 		$end = strtotime($meta['contest_end_date']);
		 		$today = time();
		 		if($today > $start && $today < $end){
		 			$current[] = $all_contests[$k];
		 		} elseif ($today < $start){
		 			$upcoming[] = $all_contests[$k];
		 		} else {
		 			$closed[] = $all_contests[$k];
		 		}
		 	}
		 	?>
		 	<style>
		 	.one-third {float: left; width: 30%;}
		 	.conditional {display: none;}
		 	.table-row {display: table-row;}
		 	.table-header {font-weight: bold; background:#72A9D3;}
		 	.table-column {display: table-cell;width: 24%;padding: 0.5em;}
		 	.column-term_id {width: 4%;}
		 	.info_panel {border-bottom: 1px solid #efefef;}
		 	.info_panel.even,.edit_panel.even {background: #EFEFEF;}
		 	.info_panel:hover {background: #EAF4FD;}
		 	.edit_panel {display: none;}
		 	
		 </style>
		 <div class="wrap contest_management">
		 	<h2>Contest Management</h2>
		 	
		 <div class="tabs">
		 <ul>
		 	<li><a href="#current"><span>Current Contests</span></a></li>
		 	<li><a href="#new"><span>New Contest</span></a></li>
		 	<li><a href="#upcoming"><span>Upcoming Contests</span></a></li>
		 	<li><a href="#closed"><span>Closed Contests</span></a></li>
		 </ul>
		 <div id="current">
		 <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
		 <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Current Contests</strong></legend>
		 		<?php print $this->make_table($current); ?>
		 </fieldset>
		 </div>
		 <div id="new">
		 
		 <form method="post" action="">
		 	<fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
		 			 <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Create a New Contest</strong></legend>
	<table class="form-table">
	<tbody>
	<tr class="form-field form-required">
		<th scope="row"><label for="contest_name">Contest Name <span class="description">(required)</span></label></th>
		<td><input name="contest_name" id="contest_name" value="" aria-required="true" type="text"></td>
	</tr>
	<tr class="form-field form-required">
		<th scope="row"><label for="contest_desc">Contest Description</label></th>
		<td><textarea name="contest_desc" id="contest_desc"></textarea></td>
	</tr>
	<tr class="form-field form-required">
		<th scope="row"><label for="contest_start_date">Contest Starts <span class="description">(required)</span></label></th>
		<td><input name="contest_start_date" id="contest_start_date" class="date" value="" aria-required="true" type="text"></td>
	</tr>
	<tr class="form-field form-required">
		<th scope="row"><label for="contest_end_date">Contest Ends <span class="description">(required)</span></label></th>
		<td><input name="contest_end_date" id="contest_end_date" class="date" value="" aria-required="true" type="text"></td>
	</tr>
	</tbody>
	</table>
		<p class="submit">
			<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
			<input type="hidden" name="msd_manage_contest" value="save" style="display:none;" />
		</p>
	</form>
		 	</fieldset>
		 </div>
		 <div id="upcoming"> 
		 <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
		 <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Upcoming</strong></legend>
		 <?php print $this->make_table($upcoming); ?>
		         </fieldset>   
		  </div>
		 <div id="closed"> <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
		 <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Closed</strong></legend>
		 <?php print $this->make_table($closed); ?>
		         </fieldset>   </div> 
		 </div>
		 <?php }
		 
		 /**
		  * Add scripts
		  */
		 function msd_manage_contest_scripts( $hook_suffix ) {
		 	if ( $this->my_settings_page == $hook_suffix ){
		 		wp_enqueue_script('media-upload');
		 		wp_enqueue_script('thickbox');
		 		wp_enqueue_style('thickbox');
		 		wp_enqueue_style('jquery-ui-redmond','http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/redmond/jquery-ui.min.css');
		 		wp_enqueue_script('jquery');
		 		wp_enqueue_script('jquery-ui-core');
		 		wp_enqueue_script('jquery-ui-tabs');
		 		wp_enqueue_script('jquery-ui-datepicker');
		 		wp_enqueue_script('msd-manage-contest-js',$this->plugin_url.'/lib/js/msd-manage-contest.js',array('jquery-ui-core','jquery-ui-tabs'));
		 	}
		 }
		 /**
		  * Neaten up the toolbar and add a handy switch
		  */
		 function clean_admin_bar() {
		 	global $wp_admin_bar;
		 
		 	$wp_admin_bar->add_node(array(
		 			'id' => 'management',
		 			'title' => 'Contest Management',
		 			'href' => get_option('siteurl').'/wp-admin/admin.php?page=msd-contest-management',
		 	));
		 
		 	if (is_super_admin() ) return;
		 	 
		 	$wp_admin_bar->remove_menu( 'my-sites' );
		 	$wp_admin_bar->remove_menu( 'updates' );
		 	$wp_admin_bar->remove_menu( 'comments' );
		 }
		 /**
		  * Add a pretty icon
		  */
		 function plugin_header() {
		 	global $post_type;
		 	?>
 			<style>
 			#adminmenu #toplevel_page_msd-contest-management div.wp-menu-image{background:transparent url("<?php print $this->plugin_url; ?>lib/img/trophy.png") no-repeat center -18px;}
 			#adminmenu #toplevel_page_msd-contest-management:hover div.wp-menu-image,#adminmenu #toplevel_page_msd-contest-management.wp-has-current-submenu div.wp-menu-image{background-position: center 6px;}	
 		    </style>
 		    <?php
 		}
 		/**
 		 * Crate a table?
 		 */
 		function make_table($data){
			$table = '<div class="table-row table-header">
				<div class="table-column column-term_id">ID</div>
				<div class="table-column column-name">Name</div>
				<div class="table-column column-start_date">Start</div>
				<div class="table-column column-end_date">End</div>
				<div class="table-column column-winner">Winner</div>
				</div>';
			$i = 0;
			foreach($data AS $k=>$v){
				$stripe = $i%2==1?'odd':'even';
				$table .= '<div class="table-row info_panel info_panel_'.$v->term_id.' '.$stripe.'" onclick="edit_contest('.$v->term_id.')">';
				$table .= '<div class="table-column column-term_id">'.$v->term_id.'</div>
		 			<div class="table-column column-name"><a href="'.site_url('contests/'.$v->slug).'">'.$v->name.'</a></div>
		 			<div class="table-column column-start_date">'.$v->start_date.'</div>
		 			<div class="table-column column-end_date">'.$v->end_date.'</div>
		 			<div class="table-column column-winner">'.$v->winner.'</div>';
				$table .= '</div>';
				$table .= '<div class="edit_panel edit_panel_'.$v->term_id.' '.$stripe.'">
		 		<form method="post" action="">
	<table class="form-table">
	<tbody>
	<input type="hidden" id="contest_id_'.$v->term_id.'" name="contest_id" value="'.$v->term_id.'" />
	<tr class="form-field form-required">
		<th scope="row"><label for="contest_name">Contest Name <span class="description">(required)</span></label></th>
		<td><input name="contest_name" id="contest_name_'.$v->term_id.'" value="'.$v->name.'" aria-required="true" type="text"></td>
	</tr>
	<tr class="form-field form-required">
		<th scope="row"><label for="contest_desc">Contest Description</label></th>
		<td><textarea name="contest_desc" id="contest_desc_'.$v->term_id.'">'.$v->description.'</textarea></td>
	</tr>
	<tr class="form-field form-required">
		<th scope="row"><label for="contest_start_date">Contest Starts <span class="description">(required)</span></label></th>
		<td><input name="contest_start_date" id="contest_start_date_'.$v->term_id.'" class="date" value="'.$v->start_date.'" aria-required="true" type="text"></td>
	</tr>
	<tr class="form-field form-required">
		<th scope="row"><label for="contest_end_date">Contest Ends <span class="description">(required)</span></label></th>
		<td><input name="contest_end_date" id="contest_end_date_'.$v->term_id.'" class="date" value="'.$v->end_date.'" aria-required="true" type="text"></td>
	</tr>
	</tbody>
	</table>
		<p class="submit">
			<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
			<input type="hidden" name="msd_manage_contest" value="save" style="display:none;" />
		</p>
	</form>
	</div>';
	$i++;
			}
			return $table;
		}
		
		function get_contest_winner($contest_id){
			$args = array( 'post_type' => 'contest_entry', 'numberposts' => 1 );
			$args['order_by'] = 'meta_value';
			$args['order'] = 'DESC';
			$args['meta_key'] = 'contest_entry_votes';
			$args['tax_query'][0]['taxonomy'] = 'contest';
			$args['tax_query'][0]['field'] = 'id';
			$args['tax_query'][0]['terms'] = $contest_id;
	
			$winner = array_shift(get_posts($args));
			$ret = '<a href="'.get_post_permalink($winner->ID).'">'.$winner->post_title.'</a> Votes:'.get_post_meta($winner->ID,'contest_entry_votes',TRUE);
			return $ret;
		}
	} //End Class	 
} //End if class exists statement
new MSDContestManager();

