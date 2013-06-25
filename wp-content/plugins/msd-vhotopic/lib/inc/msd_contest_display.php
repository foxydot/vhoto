<?php
if (!class_exists('MSDContestDisplay')) {
	class MSDContestDisplay {
		//Properites
		//Methods
		/**
		 * PHP 4 Compatible Constructor
		 */
		function MSDContestDisplay(){$this->__construct();}

		/**
		 * PHP 5 Constructor
		 */
		function __construct(){
			//Actions
			add_action('login_head', array(&$this,'custom_login_logo'));
			//Filters
			//Shortcode
			add_shortcode('print_photos', array(&$this,'print_photos_by'));
		}  
		function display_grid($images){
			foreach($images AS $image){
				$thumb = get_the_post_thumbnail($image->ID);
				$url_array = wp_get_attachment_image_src( get_post_thumbnail_id($image->ID), 'large' );
				$url = $url_array['0'];
				$excerpt = $image->post_excerpt?$image->post_excerpt:msd_trim_headline($image->post_content);
				$grid .= '
<div id="contest-entry-'.$image->ID.'" class="post post-'.$image->ID.'">
	<div class="post-inner">
		<div class="aligner">
			<div class="featured-image">
				<a style="position:relative;float:left;padding:0;margin:0;line-height:0px;" class="preload image_zoom" rel="prettyPhoto[]" href="'.$url.'">
					'.$thumb.'<span class="image_overlay" style="opacity: 0; visibility: visible;"></span>
				</a>
			</div>
		<div class="post-meta"><span class="date"><a href="'.get_post_permalink($image->ID).'">'.$image->post_date.'</a></span> | <span class="comments"><a title="Comment on '.$image->post_title.'" href="http://photocontest.msdlab2.com/V-Pictures/yacht2/#respond">No Comments</a></span></div>
		</div>
		<div><p class="post-excerpt">'.$excerpt.'</p></div>
		'.$this->msd_get_vote_button($image).'
	</div>
</div>';
			}
			return $grid;
		}
		
		
		function get_photos_by($key = 'all',$value = NULL){			
			$args = array( 'post_type' => 'contest_entry', 'numberposts' => 0, );
			switch($key){
				case 'contest':
				$args['tax_query'][0]['taxonomy'] = 'contest';
				$args['tax_query'][0]['field'] = 'slug';
				$args['tax_query'][0]['terms'] = $value;
					break;
				case 'category':
					break;
				case 'vote':
					break;
				case 'all':
				default:
					break;
			}
			
			$images = get_posts($args);
			return $images;
		}
		
		function print_photos_by($attr){
			extract( shortcode_atts( array(
			'display' => 'grid',
			'key' => 'all',
			'value' => NULL
			), $atts ) );
			$images = $this->get_photos_by($key,$value);
			switch($display){
				case 'grid':
					print $this->display_grid($images);
					break;
			}
		}
		
		function msd_get_vote_button($image){
			global $current_user;
	        if(is_user_logged_in()){
				if($current_user->ID != $image->post_author){
					$vote_button = '<a class="vote-button contest-button">ADD A VOTE</a>';
				} else {
					$vote_button = 'Sorry, you cannot vote on your own entries.';
				}
			} else {
				$vote_button = '<a class="login contest-button" href="'.get_site_url().'/log-in">LOGIN TO VOTE</a>';
			}
			return $vote_button;
        }
        
        //Logo for login page
        function custom_login_logo() {
        	echo '<style type="text/css">
		#login h1 a { background-image: url('.get_template_directory_uri().'/) !important; }
			</style>';
        }
		
  } //End Class
} //End if class exists statement