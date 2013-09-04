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
			add_action('wp_print_styles', array(&$this,'msd_add_styles'));
			add_action('wp_print_scripts', array(&$this,'msd_add_scripts'));
			//Filter
			//Shortcode
			add_shortcode('print_photos', array(&$this,'print_photos_by'));
			add_shortcode('print-photos', array(&$this,'print_photos_by'));
			add_shortcode('list_contests', array(&$this,'list_contests_by'));
			add_shortcode('list-contests', array(&$this,'list_contests_by'));
		}  
        
        public function in_contest_window($contest_id){
            $meta = get_option('contest_'.$contest_id.'_meta');
            $start_date = $meta['contest_start_date'];
            $end_date = $meta['contest_end_date'];
            $start = strtotime($meta['contest_start_date']);
            $end = strtotime($meta['contest_end_date']);
            $today = time();
            if($today > $start && $today < $end){
               return TRUE;
            } else {
               return FALSE;
            }
        }
		function display_grid($images,$cols = 4){
			foreach($images AS $image){
				$thumb = get_the_post_thumbnail($image->ID, 'thumbnail');
				$url_array = wp_get_attachment_image_src( get_post_thumbnail_id($image->ID), 'large' );
				$url = $url_array['0'];
                if(class_exists('MR_Social_Sharing_Toolkit')){
    				$social_sharing_toolkit = new MR_Social_Sharing_Toolkit();
    				$share = $social_sharing_toolkit->create_bookmarks(get_permalink($image->ID), $image->post_title.' on '.get_option('blogname'));
                } elseif (function_exists('st_makeEntries')){
                    $share = '';
                    $share .= '<span class="st_facebook" st_title="'.$image->post_title.'" st_url="'.get_permalink($image->ID).'" st_image="'.$url.'" displayText="Facebook"></span>';
                    $share .= '<span class="st_twitter" st_title="'.$image->post_title.'" st_url="'.get_permalink($image->ID).'" st_image="'.$url.'" displayText="Twitter"></span>';
                    $share .= '<span class="st_pinterest" st_title="'.$image->post_title.'" st_url="'.get_permalink($image->ID).'" st_image="'.$url.'" displayText="Pinterest"></span>';
                }
				$votes = !empty($image->votes)?$image->votes:get_post_meta($image->ID,'contest_entry_votes',TRUE);
				$grid .= '
<div id="contest-entry-'.$image->ID.'" class="entry-item post post-'.$image->ID.'">
	<div class="post-inner">
		<div class="aligner">
			<div class="featured-image">
				<a class="preload image_zoom" rel="prettyPhoto[]" href="'.$url.'">
					'.$thumb.'
				</a>
			</div>
		 </div>
        <div class="post-title">'.$image->post_title.'</div>
		<div class="post-meta"><span class="comments"><a title="Comment on '.$image->post_title.'" href="'.get_permalink($image->ID).'#respond">'.get_comments_number($image->ID).' Comments</a></span></div>				
		<div class="post-excerpt">'.msd_post_excerpt($image).'</div>
		<div class="votes">Votes: <span class="total_votes">'.$votes.'</span></div>
		'.$this->msd_get_vote_button($image).'
		<div class="sharing">'.$share.'</div>
	</div>
</div>';
			}
			$grid = '<div class="contest-grid contest-grid-'.$cols.'">'.$grid.'</div>';
			return $grid;
		}
		
		
		function get_photos_by($key = 'all',$value = NULL,$include_closed = FALSE){			
			$args = array( 'post_type' => 'contest_entry', 'numberposts' => -1 );
			if(!empty($value)){
				$args['order_by'] = 'meta_value';
				$args['order'] = 'ASC';
				$args['meta_key'] = 'contest_entry_votes';
				switch($key){
					case 'contest':
					$args['tax_query'][0]['taxonomy'] = 'contest';
					$args['tax_query'][0]['field'] = 'slug';
					$args['tax_query'][0]['terms'] = $value;
						break;
					case 'category':
					$args['tax_query'][0]['taxonomy'] = 'category';
					$args['tax_query'][0]['field'] = 'slug';
					$args['tax_query'][0]['terms'] = $value;
						break;
				}
			}
			
			$images = get_posts($args);
            $filtered_images = array();
			$i = 0;
			foreach($images AS $image){
				$images[$i]->votes = get_post_meta($image->ID,'contest_entry_votes',TRUE);
                $images[$i]->contests = wp_get_post_terms($image->ID,'contest');
                $images[$i]->open = $this->in_contest_window($images[$i]->contests[0]->term_id);
                if($images[$i]->open){
                    $filtered_images[]=$images[$i];
                }
				$i++;
			}
            usort($filtered_images,array(&$this,'sort_by_votes'));
            usort($images,array(&$this,'sort_by_votes'));
            if($include_closed){
                return $images;
            } else {
                return $filtered_images;
            }
			
		}
		
		function print_photos_by($atts){
			extract( shortcode_atts( array(
			'display' => 'grid',
			'key' => 'all',
			'value' => NULL,
			'cols' => 4
			), $atts ) );
			if(!empty($value)){
				$images = $this->get_photos_by($key,$value);
				switch($display){
					case 'grid':
						return $this->display_grid($images,$cols);
						break;
				}
			} else {
                $cargs = array(
                        'child_of'      => 0,
                        'orderby'       => 'name',
                        'order'         => 'ASC',
                        'hide_empty'    => 0,
                        'taxonomy'      => $key, //change this to any taxonomy
                );
                $taxterms = (array) get_terms($key,$cargs);
				switch($key){
					case 'contest':
					case 'category':
						foreach ( $taxterms AS $tax) :
							if($key=='contest'){
								$meta = get_option('contest_'.$tax->term_id.'_meta');
								$start_date = $meta['contest_start_date'];
								$end_date = $meta['contest_end_date'];
								$start = strtotime($meta['contest_start_date']);
								$end = strtotime($meta['contest_end_date']);
								$today = time();
								if($today > $start && $today < $end){
									$dates = '<h4 class="'.$key.'-date date">'.$start_date.'-'.$end_date.'</h4>';
								} else {
									continue;
								}
							}
							$images = $this->get_photos_by($key,$tax->slug);
							$i = 0;
							if($images){
								$i++;
								$ret .= '<h2 class="'.$key.'-title title">'.$tax->name.'</h2>';
								$ret .= $dates;
								$ret .= $this->display_grid($images,$cols);
							}
						endforeach;
						if($i==0){
							//$ret .= '<h2 class="'.$key.'-title title">Sorry, no '.$key.' images found.</h2>';
						}
						break;
					case 'votes':
					default:
						$images = $this->get_photos_by($key,$value);
						$ret .= $this->display_grid($images,$cols);
						break;
				}
			}
			return $ret;
		}
		
		function list_contests_by($atts){
			extract( shortcode_atts( array(
			'key' => 'date',
			'order' => 'ASC'
			), $atts ) );
			$cargs = array(
					'child_of'      => 0,
					'orderby'       => $key,
					'order'         => $order,
					'hide_empty'    => 0,
					'taxonomy'      => 'contest', //change this to any taxonomy
			);
			$taxterms = (array) get_terms('contest',$cargs);
			foreach ( $taxterms AS $tax) :
				$meta = get_option('contest_'.$tax->term_id.'_meta');
				$start_date = $meta['contest_start_date'];
				$end_date = $meta['contest_end_date'];
				$start = strtotime($meta['contest_start_date']);
				$end = strtotime($meta['contest_end_date']);
				$today = time();
				if($today > $start && $today < $end){
					$dates = '<h4 class="'.$key.'-date date">'.$start_date.'-'.$end_date.'</h4>';
				} else {
					continue;
				}
			$list .= '<li><a href="/contests/'.$tax->slug.'"><h2 class="title">'.$tax->name.'</h2>'.$dates.'</a></li>';
			endforeach;
			return '<ul class="contest-list">'.$list.'</ul>';
		}
		
		
		function msd_get_vote_button($image){
			global $current_user;
	        if(is_user_logged_in()){
				if($current_user->ID != $image->post_author){
					if($this->msd_user_can_vote($current_user->ID,$image->ID)){
						$vote_button = '<a href="javascript:void(0)" id="'.$image->ID.'" class="vote-button contest-button">ADD A VOTE</a>';
					} else {
						$vote_button = 'You have already voted in this contest. You can vote again on '.$this->msd_user_can_vote($current_user->ID,$image->ID,'date');
					}
				} else {
					$vote_button = 'Sorry, you cannot vote on your own entries.';
				}
			} else {
				if(function_exists('add_modal_login_button')){
					ob_start();
					add_modal_login_button( $login_text = 'LOGIN TO VOTE', $logout_text = 'Logout', $logout_url = '', $show_admin = FALSE );
					$vote_button = ob_get_contents();
					ob_clean();
				} else {
					$vote_button = '<a class="login contest-button" href="'.wp_login_url( get_permalink($image->ID) ).'">LOGIN TO VOTE</a>';
				}
			}
			return $vote_button;
        }
        
        //figure out if a user can vote in a given contest
        function msd_user_can_vote($user_id,$post_id,$return = 'boolean'){
        	$terms = get_the_terms($post_id,'contest');
        	if(!$terms){return FALSE;}
        	$contest = array_shift($terms);
        	$contest = $contest->term_id;
        	$votedate = get_user_meta($user_id,'voted_contest_'.$contest,TRUE);

        	$daysthismonth = cal_days_in_month(CAL_GREGORIAN, date('m'), date("Y"));
        	$onemonthago = mktime() - $daysthismonth*3600*24;
        	$onemonthfromvote = empty($votedate)?'':mktime(date("h",$votedate),date("i",$votedate),date("s",$votedate),date("m",$votedate),date("d",$votedate),date("Y",$votedate)) + $daysthismonth*3600*24;
        	
        	if(!$votedate){
        		switch($return){
        			case 'date':
        				return date("m/d/Y");
        				break;
        			case 'boolean':
        			default:
        				return TRUE;
        				break;
        		}
        	} else {
        		if($votedate > $onemonthago){
        			switch($return){
        				case 'date':
        					return date("m/d/Y",$onemonthfromvote);
        					break;
        				case 'boolean':
        				default:
        					return FALSE;
        					break;
        			}
        		} else {
        			switch($return){
        				case 'date':
        					return date("m/d/Y",$onemonthfromvote);
        					break;
        				case 'boolean':
        				default:
        					return FALSE;
        					break;
        			}
        		}
        	}
        }
        
        function sort_by_votes( $a, $b ) {
        	return $a->votes == $b->votes ? 0 : ( $a->votes < $b->votes ) ? 1 : -1;
        }
        
        //Logo for login page
        function custom_login_logo() {
        	echo '<style type="text/css">
		#login h1 a { background-image: url('.get_template_directory_uri().'/) !important; }
			</style>';
        }
        function msd_add_styles() {
        	if(!is_admin()){
        		wp_enqueue_style('contest-style',plugins_url( '/css/style.css' , dirname(__FILE__) ));
        	}
        }
        function msd_add_scripts() {
        	wp_enqueue_script('jquery-voting', plugins_url( '/js/msd-contest-vote.php' , dirname(__FILE__)), array('jquery'), date("mY"), true);
        }
		
  } //End Class
} //End if class exists statement