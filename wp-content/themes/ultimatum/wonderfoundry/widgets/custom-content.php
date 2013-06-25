<?php
/*
 * Tricky Loops v5 Thanks to Richard
 */
class UltimatumCustomContent extends WP_Widget {

function UltimatumCustomContent() {
        parent::WP_Widget(false, $name = 'WordPress Custom Loop');
}


function blog_multimeta($instance)
	{
		
 		global $post;
		
		if ($instance["mdate"]=='true'){

   		$mshowtime		= isset( $instance['mshowtime'] ) ? $instance['mshowtime'] : '';

         if($mshowtime){ $mtime = the_time() ;}

			$out[] = '<span class="date"><a href="'.get_month_link(get_the_time('Y'), get_the_time('m')).'">'.get_the_date(). ' ' . $mtime . '</a></span>';

		}
		if ($instance["mauthor"]=='true'){
			$out[] = '<span class="author">'.__('By: ', THEME_LANG_DOMAIN).'<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'">'. get_the_author().'</a></span>';
		}
		if($instance["mcomments"]=="true" && ($post->comment_count > 0 || comments_open())){
			ob_start();
			comments_popup_link(__('No Comments',THEME_LANG_DOMAIN), __('1 Comment',THEME_LANG_DOMAIN), __('% Comments',THEME_LANG_DOMAIN),'');
			$out[] = '<span class="comments">'.ob_get_clean().'</span>';
		}
		if(count($out)!=0){
			$output = '<div class="post-meta">';
		$output .= join( ' '.$instance["mmseperator"].' ', $out ).'</div>';
		}
		unset($out);

      $tax = '';

		if ($instance["mcats"]=='ameta'){
			$_tax = get_the_taxonomies();
			if ( empty($_tax) ){
			} else {
				foreach ( $_tax as $key => $value ) {
					preg_match( '/(.+?): /i', $value, $matches );
					$tax[] = '<span class="entry-tax-'. $key .'">' . str_replace( $matches[0], '<span class="entry-tax-meta">'. $matches[1] .':</span> ', $value ) . '</span>';
				}
			}
			if(count($tax)!=0){
				$output.= '<div class="post-taxonomy">'.join( '<br />', $tax ).'</div>';
			}
			
			unset($_tax);			
		}
		return $output;
	}

function post_gallery($type,$width,$height,$cols,$instance){
	global $post;
	if($type=='nivo'){
		$imgwidth	=$width;
		$imgheight	=$height;
		wp_enqueue_script('jquery-nivo',THEME_JS.'/jquery.nivo.slider.pack.js');
		echo '<div class="slider-wrapper nivo'.$instance[nivo_color].'">';
	} else {
		$margins = ($cols-1)*10;
		$imgwidth = ($width-$margins)/$cols;
		$imgheight	=$imgwidth;
	}
	static $cleaner_gallery_instance = 0;
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}
	
	/* Default gallery settings. */
	$defaults = array(
		'order' => 'ASC',
		'orderby' => 'menu_order ID',
		'id' => $post->ID,
		'lightboxtitle' => 'caption',//title,caption,none
		'size' => 'thumbnail',
		'numberposts' => -1,
		'offset' => ''
	);
	extract( $defaults );
	$id = intval( $id );
	/* Arguments for get_children(). */
	$children = array(
		'post_parent' => $id,
		'post_status' => 'inherit',
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'order' => $order,
		'orderby' => $orderby,
		'numberposts' => $numberposts,
		'offset' => $offset,
	);

	$attachments = get_children( $children );
	
	if ( empty( $attachments ) )
		return '';
	$attachment_count = count( $attachments );
	
	$output = "\n\t\t\t<div id='gallery-{$id}-{$cleaner_gallery_instance}' class='gallery gallery-{$id}'>";
	if($type=='nivo'){
		$output = '<div id="gallery-'.$id.'-'.$cleaner_gallery_instance.'" style="width:'.$imgwidth.'px;height:'.$imgheight.'px" >'; 
	}
	$divd = 'gallery-'.$id.'-'.$cleaner_gallery_instance;
	$z=1;
	/* Loop through each attachment. */
	foreach ( $attachments as $id => $attachment ) {
		if($z!=$cols){
			$margin_right=10;
			$z++;
		} else {
			$margin_right=0;
			$z=1;
		}
			
		$img_lnk = wp_get_attachment_image_src($id, 'full');
		$img_lnk = $img_lnk[0];
		$img_src = THEME_HELPERS.'/timthumb.php?src='.get_image_path($img_lnk).'&amp;h='.$imgheight.'&amp;w='.$imgwidth.'&amp;zc=1';
		$img_alt = wptexturize( esc_html($attachment->post_excerpt) );
		
		if ( $img_alt == null )
			$img_alt = $attachment->post_title;
			$lightbox_title = $attachment->post_title;
			
		$img_rel = 'group-' . $post->ID.'[]';
		$image  =  '<img src="' . $img_src . '" alt="' . $img_alt . '" title="'.$img_alt.'" />';
		
		
			$image = '<div class="gallery-image"><a href="' . $img_lnk . '" class="prettyPhoto image_zoom" title="' . $lightbox_title . '" rel="' . $img_rel . '" style="position:relative;float:left;margin-bottom:5px;margin-right:'.$margin_right.'px;">'.$image.'</a></div>';
		
		$output .= $image;
		
	}
	$output .= "\n\t\t\t</div><!-- .gallery -->\n";
	
	/* Return out very nice, valid HTML gallery. */
	echo $output;
	if($type=='nivo'){
		$shadow = THEME_URI.'/images/image_shadow.png';
		?>
		</div>
		<img src="<?php echo$shadow;?>" style="vertical-align:top;padding:0;margin:0;line-height:0px;margin-top:1px;width:<?php echo $imgwidth; ?>px;" alt="shadow"/>
		<script type="text/javascript">
						//<![CDATA[
							jQuery(document).ready(function($) {
								$('#<?php echo $divd;?>').nivoSlider({
									effect:'<?php echo $instance['nivo_effect'];?>',
								     slices:<?php echo $instance['nivo_segments'];?>,
								     animSpeed:<?php echo $instance['nivo_animspeed'];?>,
								     pauseTime:<?php echo $instance['nivo_pausetime'];?>,
								     directionNav:<?php echo $instance['nivo_nav'];?>,
								     directionNavHide:<?php echo $instance['nivo_navhover'];?>,
								     controlNav:<?php echo $instance['nivo_controls'];?>, 
								     pauseOnHover:<?php echo $instance['nivo_pausehover'];?>,
								     captionOpacity:<?php echo $instance['nivo_captionsopacity'];?>
									});
								
							});
							//]]>
						</script>
		<?php 
	}
	
}

function widget($args, $instance) {
        extract( $args );

        $i=1;
        $title = apply_filters('widget_title', $instance['title']);
        $colprops = explode('-', $instance["multiple"]);
        $count = $instance["perpage"];
        $colcount = $colprops[0];
        $gallery=false;
        $noimage=false;
        $rel='';
        switch ($colcount){
        	case '1':
        		$grid = $grid_width;
        		$cols = 1;
        		$colw= $grid_width;
        	break;
        	case '2':
        		$grid = ($grid_width-($instance["mmargin"]))/2;
        		$cols = 2;
        		$colw= $grid;
        	break;
        	case '3':
        		$grid = ($grid_width-($instance["mmargin"]*2))/3;
        		$cols = 3;
        		$colw= $grid;
        	break;
        	case '4':
        		$grid = ($grid_width-($instance["mmargin"]*3))/4;
        		$cols = 4;
         		$colw= $grid;
         	break;
         }
      
        		$colcount=$cols;
        		if($colcount==1 && ($colprops[2]=='ri' || $colprops[2]=='li' || $colprops[2]=='gl' || $colprops[2]=='gr') ){
        			$imgw=$instance[multiplew];
        		} else {
        			$imgw=$colw;
        		}
        		switch($colprops[2]){
        			case 'ri':
        				$align = 'float:right;margin-top:4px;margin-left:15px;';
        				break;
        			case 'li':
        				$align = 'float:left;margin-top:4px;margin-right:15px;';
        				break;
        			case 'gl':
        				$align = 'float:left;margin-top:4px;margin-right:15px;';
        				$rel = 'rel="prettyPhoto[]"';
        				$gallery =true;
        				break;
        			case 'gr':
        				$align = 'float:right;margin-left:15px;margin-top:4px;';
        				$rel = 'rel="prettyPhoto[]"';
        				$gallery =true;
        				break;
        			case 'g':
        				$rel = 'rel="prettyPhoto[]"';
        				$gallery =true;
        				break;
        			case 'i':
        				break;
        			default:
        				$noimage=true;
        			break;
        		}
        		
        		//Print the Style
        		
        		?>
        		
<style type="text/css">
#<?php echo  $widget_id;?> {
	float:left;
	width:<?php echo $grid;?>px;
	margin-right:<?php echo $instance["mmargin"];?>px;
}
#<?php echo  $widget_id;?> .aligner {
	<?php echo $align;?>
}
</style>
<?php if($responsivetheme):?>
<style type="text/css">
	@media screen and (min-width:720px) and (max-width: 979px) {
		#<?php echo  $widget_id;?>{
	    	float:left;
	        width:100%;	
	        margin-right:0;
		}
#<?php echo  $widget_id;?> .aligner {
			<?php if(isset($align)){
				echo $align;
			} else {
				echo 'width:100%;';
			}
				?>
		}
		#<?php echo  $widget_id;?> .aligner img {
			max-width:100%;
			}
	}
	@media screen and (min-width:320px) and (max-width: 719px) {
		#<?php echo  $widget_id;?>{
	    	float:left;
	        width:100%;	
		}
		#<?php echo  $widget_id;?> .aligner {
			width:100%;
		}
		#<?php echo  $widget_id;?> .aligner img {
			max-width:100%;
		}
	}
</style>
<?php endif; ?>
				
        		<?php 
        		global $wp_filter;
        		$source = $instance['source'];
        		$the_content_filter_backup = $wp_filter['the_content'];

      		$looporder1		= isset( $instance['looporder1'] ) ? $instance['looporder1'] : '';
      		$looporder2		= isset( $instance['looporder2'] ) ? $instance['looporder2'] : '';
      		$skip          = isset( $instance['skip'] ) ? $instance['skip'] : 0;

            // set order defaults
            $orderby = 'date';
            $order = 'DESC';

	  	      $order		= isset( $instance['orderdir'] ) ? $instance['orderdir'] : 'DESC';

            if ($looporder1){
               $orderby = $looporder1;

               $setby1 =true;
            }

            if ($looporder2){
               if($setby1) {
                   $orderby .= ' ' . $looporder2;
               }
               else
               {
                  $orderby = $looporder2;
               }

            }

        		if(eregi('ptype-',$source)){
        			$post_type= str_replace('ptype-', '', $source);
        		} elseif(eregi('cat-',$source)){
        			$post_type ='post';
        			$cat = str_replace('cat-', '',$source);
        		}elseif(eregi('taxonomy-',$source)){
        			$prop = explode('|',str_replace('taxonomy-', '', $source));
        			
        			$post_type =$prop[0];
    
        				$taxonmy['taxonomy'] = $prop[1];
        				$taxonmy['term'] = $prop[2];
        			
        		}
        		
        		$query = array(
        				'posts_per_page' => (int)$count,
        				'post_type'=>$post_type,
        				'orderby'=>$orderby,
        				'order'=>$order,
        		);

            if ( $skip > 0 ){
               $query['offset'] = $skip;
            }

        		if($cat){
        			$query['cat'] = $cat;
        		}
        		if(isset($taxonmy)){
        			$query['taxonomy'] = $taxonmy['taxonomy'];
        			$query['term'] = $taxonmy['term'];
        		}
        		$query['showposts'] = $count;
        		
        		$r = new WP_Query($query);
	        	if ($r->have_posts()):
				while ($r->have_posts()) : $r->the_post();
				global $post;
	        		
	        		 
		            		if($colcount!=1)://gridd
			        		if($i==1){
			        			$i++;
			        			$gps= false;
			        		} elseif($i==$colcount){
			        			$gps= true;
			        			$i=1;
			        		} else{
			        			$i++;
			        			$gps= false;
			        		}
			        		else :
			        		$grid='';
			        		$gps='';
			        		endif;//gridd
					     ?>
					     	<div class="post post-<?php echo $post->ID;?> ultimatepost-custom <?php if($gps) echo "last";?>" id="<?php echo $widget_id;?>">
					        	<div class="post-inner">
					        		<?php 
					        		$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large') ;
					        		if(!$img && $instance["mnoimage"]=='true'){
					        		if(get_theme_option('general', 'noimage')){
										$img[0]=	get_theme_option('general', 'noimage');
										} else {
	        							$img[0] = THEME_URI.'/images/no-image.jpg';
										}
										$imgsrc = UltimatumImageResizer( null, $img[0],$imgw, $instance["multipleh"], true );
	        						} else {
	        							$imgsrc = UltimatumImageResizer( get_post_thumbnail_id(), null,$imgw, $instance["multipleh"], true );
	        						}
					        	   	if(!$noimage){
					        			$video =get_post_meta($post->ID,'ultimatum_video',true);
					        			$sc ='[video width="100%" height="'.$instance["multipleh"].'"]'.$video.'[/video]';
										if($imgw!=$colw || $instance["mimgpos"]=='btitle'){
					        		?>
		        							<div class="aligner">
		        								<div class="featured-image">
		       										<?php 
			        								if($gallery){
			        									if($video){
				        									$link = $video.'';
				        								} else {
				        									$link = $img[0];
				        								}
			        								}
		        									if ($img) {
		        										if($video && $instance["mvideo"]=='replace') { 
		        											echo do_shortcode($sc); 
		        										} else { 
		        										?>
		        											<a href="<?php if($gallery){ echo $link; } else { the_permalink();} ?>" <?php echo $rel?> class="preload <?php if($gallery){ if($video){ echo 'image_play'; } else { echo 'image_zoom';} } ?>" style="position:relative;float:left;padding:0;margin:0;line-height:0px;" >
		        												<img src="<?php echo $imgsrc;?>" style="padding:0;margin:0;line-height:0px;" alt="<?php the_title();?>" />
		        											</a>
		        										<?php
														} 
														if($video && $instance["mvideo"]=='aimage') {
															echo do_shortcode($sc); 
														}
													} ?>
		        								</div>
		        								<?php if($instance["mmeta"]=='aimage') echo $this->blog_multimeta($instance); ?>
		        							</div>
		        					<?php 
										} 
									}
		        		 		if(!$grid){
		        		 			$wi = $grid_width-($imgw+15);
		        		 			echo '<div>';
		        		 		} else{
		        		 			echo '<div>';
		        		 		}
		        		 		?>
		        		 	<?php if($instance["mtitle"]=='true'){ ?>
			        		  <h2 class="post-header">
			        		  <?php if($rel){ ?>
			        		  <?php the_title(); ?>
			        		  <?php } else { ?>
			        		  <a class="post-title" href="<?php the_permalink(); ?>"><?php the_title()?></a>
			        		  <?php } ?>
			        		  </h2>
			        		  <?php  } ?>
			        		 <?php if($imgw==$colw && $instance["mimgpos"]=='atitle'){ ?>
		        				<div class="aligner">
		        				<div class="featured-image">
		       					<?php 
			        				if($gallery){
			        					if($video){
				        					$link = $video.'';
				        				} else {
				        					$link = $img[0];
				        				}
			        				}
		        				?><?php if ($img) {?>
		        					<?php if($video && $instance["mvideo"]=='replace') { ?>
		        						<?php echo do_shortcode($sc); ?>
		        					<?php } else { ?>
		        					<a href="<?php if($gallery){echo $link; } else { the_permalink();} ?>" <?php echo $rel?> class="preload"><img src="<?php echo $imgsrc;?>"  alt="<?php the_title();?>" /></a>
		        					<?php } ?>
		        					<?php if($video && $instance["mvideo"]=='aimage') { ?>
		        						<?php echo do_shortcode($sc); ?>
		        					<?php } ?>
		        					<?php } ?>
		        					</div>
		        					<?php if($instance["mmeta"]=='aimage') echo $this->blog_multimeta($instance);?>
		        				</div>
		        		   <?php } ?>
			        		  <?php if($video && $instance["mvideo"]=='atitle') { ?>
		        						<?php echo do_shortcode($sc); ?>
		        				 <?php } ?>
			        		  <?php if($instance["mmeta"]=='atitle') echo $this->blog_multimeta($instance);?>
			        		  <?php if($instance["excerpt"]=='true') { ?>
				        		 <p class="post-excerpt"><?php echo wp_html_excerpt(get_the_excerpt(),$instance["excerptlength"]);?>...</p>
			        		  <?php } elseif($instance['excerpt']=='content') {?>
			        		  	<p class="post-excerpt"><?php the_content();?></p>
			        		  <?php } ?>
			        		  <?php if($instance["mmeta"]=='atext') echo $this->blog_multimeta($instance);

                       $tax = '';

			        		  if ($instance["mcats"]=='acontent'){
			        		  	$tax=array();
			        		  	$_tax=array();
										$_tax = get_the_taxonomies();
										if ( empty($_tax) ){
										} else {
											foreach ( $_tax as $key => $value ) {
												preg_match( '/(.+?): /i', $value, $matches );
												$tax[] = '<span class="entry-tax-'. $key .'">' . str_replace( $matches[0], '<span class="entry-tax-meta">'. $matches[1] .':</span> ', $value ) . '</span>';
											}
										}
										echo '<div class="post-meta taxonomy">'.join( '<br />', $tax ).'</div>';
													
									}
			        		  if($instance["mreadmore"]!='false') { 
			        		  ?>
			        		  		<p style="text-align:<?php echo $instance["mreadmore"];?>">
			        		  		<a href="<?php the_permalink(); ?>" class="readmorecontent" >
			        		  			<?php _e($instance["rmtext"],THEME_LANG_DOMAIN) ;?>
			        		  		</a>
			        		  		</p>
			        		  <?php } ?>
			        		  </div>
			        		  </div>
			        		</div>
		        		 
		        		  
		        		  <?php 
		        			if($i==1){
		        				echo '<div style="clear:both"></div>';
		        			}
		        	
		        	endwhile;
		        	endif;
	        	
	        	
        	?>
        <?php 
        echo '<div style="clear:both"></div>';
        ?>

        <?php
        wp_reset_postdata();
        $wp_filter['the_content'] = $the_content_filter_backup;
    }

function update($new_instance, $old_instance) {
	$instance['single']			= $new_instance['single'];
	$instance['singlew']		= $new_instance['singlew'];
	$instance['singleh']		= $new_instance['singleh'];
	$instance['title']			= $new_instance['title'];
	$instance['meta']			= $new_instance['meta'];
	$instance['date']			= $new_instance['date'];
	$instance['author']			= $new_instance['author'];
	$instance['comments']		= $new_instance['comments'];
	$instance['cats']			= $new_instance['cats'];
	$instance['gallery']		= $new_instance['gallery'];
	$instance['thumbs']			= $new_instance['thumbs'];
	
	$instance['nivo_effect']			= $new_instance['nivo_effect'];
	$instance['nivo_segments']			= $new_instance['nivo_segments'];
	$instance['nivo_animspeed']			= $new_instance['nivo_animspeed'];
	$instance['nivo_pausetime']			= $new_instance['nivo_pausetime'];
	$instance['nivo_nav']				= $new_instance['nivo_nav'];
	$instance['nivo_navhover']			= $new_instance['nivo_navhover'];
	$instance['nivo_controls']			= $new_instance['nivo_controls'];
	$instance['nivo_pausehover']		= $new_instance['nivo_pausehover'];
	$instance['nivo_captions']			= $new_instance['nivo_captions'];
	$instance['nivo_captionsopacity']	= $new_instance['nivo_captionsopacity'];
	$instance['nivo_color']				= $new_instance['nivo_color'];
	
	$instance['perpage']		= $new_instance['perpage'];
	$instance['mseperator']		= $new_instance['mseperator'];
	$instance['multiple']		= $new_instance['multiple'];
	$instance['multipleh']		= $new_instance['multipleh'];
	$instance['multiplew']		= $new_instance['multiplew'];
	$instance['mtitle']			= $new_instance['mtitle'];
	$instance['mvideo']			= $new_instance['mvideo'];
	$instance['mmeta']			= $new_instance['mmeta'];
	$instance['mdate']			= $new_instance['mdate'];
	$instance['mauthor']		= $new_instance['mauthor'];
	$instance['mimgpos']		= $new_instance['mimgpos'];
	$instance['mcomments']		= $new_instance['mcomments'];
	$instance['mcats']			= $new_instance['mcats'];
	$instance['excerpt']		= $new_instance['excerpt'];
	$instance['excerptlength']	= $new_instance['excerptlength'];
	$instance['mreadmore']		= $new_instance['mreadmore'];
	$instance['rmtext']			= $new_instance['rmtext'];
	$instance['mmargin']		= $new_instance['mmargin'];
	$instance['mmseperator']	= $new_instance['mmseperator'];
	$instance['source']			= $new_instance['source'];
	$instance['noimage']		= $new_instance['noimage'];
	$instance['mnoimage']		= $new_instance['mnoimage'];

	$instance['mshowtime']		= $new_instance['mshowtime'];

	$instance['looporder1']		= $new_instance['looporder1'];
 	$instance['looporder2']		= $new_instance['looporder2'];
 	$instance['skip']		      = $new_instance['skip'];
 	$instance['orderdir']		= $new_instance['orderdir'];

     return $instance;
    }
    
function form($instance) {
		
		$source 	= isset( $instance['source'] ) ? $instance['source'] : 'post';
        $single			= isset( $instance['single'] ) ? $instance['single'] : 'fimage';
        $title			= isset( $instance['title'] ) ? $instance['title'] : 'true';
        $excerpt		= isset( $instance['excerpt'] ) ? $instance['excerpt'] : 'true';
		$singlew		= isset( $instance['singlew'] ) ? $instance['singlew'] : '220';
		$singleh		= isset( $instance['singleh'] ) ? $instance['singleh'] : '220';
		$meta			= isset( $instance['meta'] ) ? $instance['meta'] : 'aimage';
		$mseperator		= isset( $instance['mseperator'] ) ? $instance['mseperator'] : '|';
		$date			= isset( $instance['date'] ) ? $instance['date'] : 'true';
		$author			= isset( $instance['author'] ) ? $instance['author'] : 'false';
		$comments		= isset( $instance['comments'] ) ? $instance['comments'] : 'true';
		$cats			= isset( $instance['cats'] ) ? $instance['cats'] : 'false';
		$gallery		= isset( $instance['gallery'] ) ? $instance['gallery'] : 'false';
		$thumbs			= isset( $instance['thumbs'] ) ? $instance['thumbs'] : '3';
		
		$nivo_effect			= isset( $instance['nivo_effect'] ) ? $instance['nivo_effect'] : 'random';
		$nivo_segments			= isset( $instance['nivo_segments'] ) ? $instance['nivo_segments'] : '10';
		$nivo_animspeed 		= isset( $instance['nivo_animspeed'] ) ? $instance['nivo_animspeed'] : '700';
		$nivo_pausetime			= isset( $instance['nivo_pausetime'] ) ? $instance['nivo_pausetime'] : '4000';
		$nivo_nav				= isset( $instance['nivo_nav'] ) ? $instance['nivo_nav'] : '';
		$nivo_navhover			= isset( $instance['nivo_navhover'] ) ? $instance['nivo_navhover'] : '';
		$nivo_controls			= isset( $instance['nivo_controls'] ) ? $instance['nivo_controls'] : '';
		$nivo_pausehover		= isset( $instance['nivo_pausehover'] ) ? $instance['nivo_pausehover'] : '';
		$nivo_captions 			= isset( $instance['nivo_captions'] ) ? $instance['nivo_captions'] : '';
		$nivo_captionsopacity	= isset( $instance['nivo_captionsopacity'] ) ? $instance['nivo_captionsopacity'] : '0.5';
		$nivo_color				= isset( $instance['nivo_color'] ) ? $instance['nivo_color'] : 'grey';
		
		$mtitle			= isset( $instance['mtitle'] ) ? $instance['mtitle'] : 'true';
		$mimgpos			= isset( $instance['mimgpos'] ) ? $instance['mimgpos'] : 'btitle';
		$mvideo			= isset( $instance['mvideo'] ) ? $instance['mvideo'] : 'false';
		$perpage		= isset( $instance['perpage'] ) ? $instance['perpage'] : '10';
		$multiple		= isset( $instance['multiple'] ) ? $instance['multiple'] : '1coli';
		$multiplew		= isset( $instance['multiplew'] ) ? $instance['multiplew'] : '220';
		$multipleh		= isset( $instance['multipleh'] ) ? $instance['multipleh'] : '220';
		$excerptlength 	= isset( $instance['excerptlength'] ) ? $instance['excerptlength'] : '100';
		$mmeta			= isset( $instance['mmeta'] ) ? $instance['mmeta'] : 'aimage';
		$mmargin		= isset( $instance['mmargin'] ) ? $instance['mmargin'] : '30';
		$mdate			= isset( $instance['mdate'] ) ? $instance['mdate'] : 'true';
		$mauthor		= isset( $instance['mauthor'] ) ? $instance['mauthor'] : 'false';
		$mcomments		= isset( $instance['mcomments'] ) ? $instance['mcomments'] : 'true';
		$mcats			= isset( $instance['mcats'] ) ? $instance['mcats'] : 'false';
		$mreadmore		= isset( $instance['mreadmore'] ) ? $instance['mreadmore'] : 'right';
		$mmseperator	= isset( $instance['mmseperator'] ) ? $instance['mmseperator'] : '|';
		$rmtext			= isset( $instance['rmtext'] ) ? $instance['rmtext'] : 'Read More';
		$noimage		= isset( $instance['noimage'] ) ? $instance['noimage'] : 'true';
		$mnoimage		= isset( $instance['mnoimage'] ) ? $instance['mnoimage'] : 'true';

		$mshowtime		= isset( $instance['mshowtime'] ) ? $instance['mshowtime'] : '';

		$looporder1		= isset( $instance['looporder1'] ) ? $instance['looporder1'] : '';
		$looporder2		= isset( $instance['looporder2'] ) ? $instance['looporder2'] : '';
		$orderdir		= isset( $instance['orderdir'] ) ? $instance['orderdir'] : 'DESC';
		$skip		      = isset( $instance['skip'] ) ? $instance['skip'] : '';

		global $wpdb;
		$termstable = $wpdb->prefix.'ultimatum_tax';
		?>
		 <p>
		<label for="<?php echo $this->get_field_id('source'); ?>"><?php _e( 'Select Content Source' ,THEME_ADMIN_LANG ); ?></label>
		<select  name="<?php echo $this->get_field_name('source'); ?>" id="<?php echo $this->get_field_id('source'); ?>" >
		<optgroup label="Post Type">
		<?php 
			$args=array('public'   => true,'publicly_queryable' => true);
			$post_types=get_post_types($args,'names');
			foreach ($post_types as $post_type ) {
				if($post_type!='attachment')
				echo '<option value="ptype-'.$post_type.'" '.selected($source,'ptype-'.$post_type,false).'>'.$post_type.'</option>';
			}
		?>
		</optgroup>
		<?php 
		$entries = get_categories('title_li=&orderby=name&hide_empty=0');
		if(count($entries)>=1){
			echo '<optgroup label="Categories(Post)">';
			foreach ($entries as $key => $entry) {
				echo '<option value="cat-'.$entry->term_id.'" '.selected($source,'cat-'.$entry->term_id,false).'>'.$entry->name.'</option>';
			}
			echo '</optgroup>';
		}
			?>
		<?php 
		
		$termsql = "SELECT * FROM $termstable";
		$termresult = $wpdb->get_results($termsql,ARRAY_A);
		foreach ($termresult as $term){
			$properties = unserialize($term[properties]);
			echo '<optgroup label="'.$properties[label].'('.$term[pname].')">';
			$entries = get_terms($properties[name],'orderby=name&hide_empty=0');
			foreach($entries as $key => $entry) {
				$optiont='taxonomy-'.$term[pname].'|'.$properties[name].'|'.$entry->slug;
				echo '<option value="'.$optiont.'" '.selected($source,$optiont,false).'>'.$entry->name.'</option>';
				}
			echo '</optgroup>';
		}
		
		?>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('mtitle'); ?>"><?php _e('Title',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
		<select name="<?php echo $this->get_field_name('mtitle'); ?>" id="<?php echo $this->get_field_id('mtitle'); ?>">
		<option value="true" <?php selected($mtitle,'true');?>>ON</option>
		<option value="false" <?php selected($mtitle,'false');?>>OFF</option>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('perpage'); ?>"><?php _e('Items Per Page',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
		<input type="text" value="<?php echo $perpage;?>" name="<?php echo $this->get_field_name('perpage'); ?>" id="<?php echo $this->get_field_id('perpage'); ?>" />
		</p>

      <p>
      <label for="<?php echo $this->get_field_id('looporder1'); ?>"><?php _e('Loop Order first',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
      <select name="<?php echo $this->get_field_name('looporder1'); ?>" id="<?php echo $this->get_field_id('looporder1'); ?>">
      <option value=''            <?php selected($looporder1, ''           );?>><?php _e( 'None'           ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='ID'              <?php selected($looporder1, 'ID'             );?>><?php _e( 'ID'             ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='author'          <?php selected($looporder1, 'author'         );?>><?php _e( 'author'         ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='title'           <?php selected($looporder1, 'title'          );?>><?php _e( 'title'          ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='name'            <?php selected($looporder1, 'name'           );?>><?php _e( 'name'           ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='date'            <?php selected($looporder1, 'date'           );?>><?php _e( 'date {default}'           ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='modified'        <?php selected($looporder1, 'modified'       );?>><?php _e( 'modified'       ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='parent'          <?php selected($looporder1, 'parent'         );?>><?php _e( 'parent'         ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='rand'            <?php selected($looporder1, 'rand'           );?>><?php _e( 'rand'           ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='comment_count'   <?php selected($looporder1, 'comment_count'  );?>><?php _e( 'comment_count'  ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='menu_order'      <?php selected($looporder1, 'menu_order'     );?>><?php _e( 'menu_order'     ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      </select>
      </p>

      <p>
      <label for="<?php echo $this->get_field_id('looporder2'); ?>"><?php _e('Loop Order second',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
      <select name="<?php echo $this->get_field_name('looporder2'); ?>" id="<?php echo $this->get_field_id('looporder2'); ?>">
      <option value=''            <?php selected($looporder2, ''           );?>><?php _e( 'None'           ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='ID'              <?php selected($looporder2, 'ID'             );?>><?php _e( 'ID'             ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='author'          <?php selected($looporder2, 'author'         );?>><?php _e( 'author'         ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='title'           <?php selected($looporder2, 'title'          );?>><?php _e( 'title'          ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='name'            <?php selected($looporder2, 'name'           );?>><?php _e( 'name'           ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='date'            <?php selected($looporder2, 'date'           );?>><?php _e( 'date {default}'           ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='modified'        <?php selected($looporder2, 'modified'       );?>><?php _e( 'modified'       ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='parent'          <?php selected($looporder2, 'parent'         );?>><?php _e( 'parent'         ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='rand'            <?php selected($looporder2, 'rand'           );?>><?php _e( 'rand'           ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='comment_count'   <?php selected($looporder2, 'comment_count'  );?>><?php _e( 'comment_count'  ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='menu_order'      <?php selected($looporder2, 'menu_order'     );?>><?php _e( 'menu_order'     ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      </select>
      </p>

      <p>
      <label for="<?php echo $this->get_field_id('orderdir'); ?>"><?php _e('Order Direction',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
      <select name="<?php echo $this->get_field_name('orderdir'); ?>" id="<?php echo $this->get_field_id('orderdir'); ?>">
      <option value='DESC'            <?php selected($orderdir, 'DESC'           );?>><?php _e( 'Descending'           ,THEME_ADMIN_LANG_DOMAIN) ?></option>
      <option value='ASC'             <?php selected($orderdir, 'ASC'             );?>><?php _e( 'Ascending'             ,THEME_ADMIN_LANG_DOMAIN) ?></option>

      </select>
      </p>

            <?php   ultimatum_custcontent_inptext('skip', $skip, 'Skip first', $this, '3'); ?> Posts...

		<p>
		<label for="<?php echo $this->get_field_id('multiple'); ?>"><?php _e('Layout When Page has Multiple Posts',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
		<select name="<?php echo $this->get_field_name('multiple'); ?>" id="<?php echo $this->get_field_id('multiple'); ?>">
			<option value="1-col-i" <?php selected($multiple,'1-col-i');?>><?php _e('One Column With Full Image',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="1-col-li" <?php selected($multiple,'1-col-li');?>><?php _e('One Column With Image On Left',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="1-col-ri" <?php selected($multiple,'1-col-ri');?>><?php _e('One Column With Image On Right',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="1-col-gl" <?php selected($multiple,'1-col-gl');?>><?php _e('One Column Gallery With Image On Left',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="1-col-gr" <?php selected($multiple,'1-col-gr');?>><?php _e('One Column Gallery With Image On Right',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="1-col-n" <?php selected($multiple,'1-col-n');?>><?php _e('One Column With No Image',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="2-col-i" <?php selected($multiple,'2-col-i');?>><?php _e('Two Columns With Image',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="2-col-g" <?php selected($multiple,'2-col-g');?>><?php _e('Two Columns Gallery',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="2-col-n" <?php selected($multiple,'2-col-n');?>><?php _e('Two Columns With No Image',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="3-col-i" <?php selected($multiple,'3-col-i');?>><?php _e('Three Columns With Image',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="3-col-g" <?php selected($multiple,'3-col-g');?>><?php _e('Three Columns Gallery',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="3-col-n" <?php selected($multiple,'3-col-n');?>><?php _e('Three Columns With No Image',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="4-col-i" <?php selected($multiple,'4-col-i');?>><?php _e('Four Columns With Image',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="4-col-g" <?php selected($multiple,'4-col-g');?>><?php _e('Four Columns Gallery',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="4-col-n" <?php selected($multiple,'4-col-n');?>><?php _e('Four Columns With No Image',THEME_ADMIN_LANG_DOMAIN) ?></option>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('mnoimage'); ?>"><?php _e('No Image',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
		<select name="<?php echo $this->get_field_name('mnoimage'); ?>" id="<?php echo $this->get_field_id('mnoimage'); ?>">
		<option value="true" <?php selected($mnoimage,'true');?>>Show Placeholder</option>
		<option value="false" <?php selected($mnoimage,'false');?>>OFF</option>
		</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('mmargin'); ?>"><?php _e('Margin',THEME_ADMIN_LANG_DOMAIN) ?>:</label> <i>For columns 2 or 2+</i>
			<input type="text" name="<?php echo $this->get_field_name('mmargin'); ?>" id="<?php echo $this->get_field_id('mmargin'); ?>" value="<?php echo $mmargin; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('mimgpos'); ?>"><?php _e('Image Position',THEME_ADMIN_LANG_DOMAIN) ?>:</label> <i>For Full image and columns 2 or 2+</i>
			<select name="<?php echo $this->get_field_name('mimgpos'); ?>" id="<?php echo $this->get_field_id('mimgpos'); ?>">
			<option value="atitle" <?php selected($mimgpos,'atitle');?>><?php _e('After Title',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="btitle" <?php selected($mimgpos,'btitle');?>><?php _e('Before Title',THEME_ADMIN_LANG_DOMAIN) ?></option>
			
			
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('mvideo'); ?>"><?php _e('Video',THEME_ADMIN_LANG_DOMAIN) ?>:</label> <i>Works for non Gallery views only</i>
			<select name="<?php echo $this->get_field_name('mvideo'); ?>" id="<?php echo $this->get_field_id('mvideo'); ?>">
			<option value="atitle" <?php selected($mvideo,'atitle');?>><?php _e('After Title',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="aimage" <?php selected($mvideo,'aimage');?>><?php _e('After Image',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="replace" <?php selected($mvideo,'replace');?>><?php _e('Replace Image',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="false" <?php selected($mvideo,'false');?>>OFF</option>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('excerpt'); ?>"><?php _e('Show Content As',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
		<select name="<?php echo $this->get_field_name('excerpt'); ?>" id="<?php echo $this->get_field_id('excerpt'); ?>">
		<option value="true" <?php selected($excerpt,'true');?>>Excerpt</option>
		<option value="content" <?php selected($excerpt,'content');?>>Content</option>
		<option value="false" <?php selected($excerpt,'false');?>>OFF</option>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('excerptlength'); ?>"><?php _e('Excerpt Length(chars)',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
		<input type="text" value="<?php echo $excerptlength;?>" name="<?php echo $this->get_field_name('excerptlength'); ?>" id="<?php echo $this->get_field_id('excerptlength'); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('multiplew'); ?>"><?php _e('Image Width',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
		<input type="text" value="<?php echo $multiplew;?>" name="<?php echo $this->get_field_name('multiplew'); ?>" id="<?php echo $this->get_field_id('multiplew'); ?>" /><i>Applied on Image on Left/Right Aligned pages</i>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('multipleh'); ?>"><?php _e('Image Height',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
		<input type="text" value="<?php echo $multipleh;?>" name="<?php echo $this->get_field_name('multipleh'); ?>" id="<?php echo $this->get_field_id('multipleh'); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('mcats'); ?>"><?php _e('Taxonomy',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
			<select name="<?php echo $this->get_field_name('mcats'); ?>" id="<?php echo $this->get_field_id('mcats'); ?>">
			<option value="ameta" <?php selected($mcats,'ameta');?>><?php _e('After Meta',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="acontent" <?php selected($mcats,'acontent');?>><?php _e('After Content',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="false" <?php selected($mcats,'false');?>>OFF</option>
			</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('mmeta'); ?>"><?php _e('Meta',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
		<select name="<?php echo $this->get_field_name('mmeta'); ?>" id="<?php echo $this->get_field_id('mmeta'); ?>">
		<option value="atitle" <?php selected($mmeta,'atitle');?>><?php _e('After Title',THEME_ADMIN_LANG_DOMAIN) ?></option>
		<option value="aimage" <?php selected($mmeta,'aimage');?>><?php _e('After Image',THEME_ADMIN_LANG_DOMAIN) ?></option>
		<option value="atext" <?php selected($mmeta,'atext');?>><?php _e('After Content',THEME_ADMIN_LANG_DOMAIN) ?></option>
		<option value="false" <?php selected($mmeta,'false');?>>OFF</option>
		</select>
		</p>
		<fieldset><legend>Multi Post Meta Properties</legend>
		<p>
			<label for="<?php echo $this->get_field_id('mmseperator'); ?>"><?php _e('Meta Seperator',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
			<input name="<?php echo $this->get_field_name('mmseperator'); ?>" id="<?php echo $this->get_field_id('mmseperator'); ?>" value="<?php echo $mmseperator; ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('mdate'); ?>"><?php _e('Date',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
		<select name="<?php echo $this->get_field_name('mdate'); ?>" id="<?php echo $this->get_field_id('mdate'); ?>">
		<option value="true" <?php selected($mdate,'true');?>>ON</option>
		<option value="false" <?php selected($mdate,'false');?>>OFF</option>
		</select>
      <?php  ultimatum_custcontent_inpcheckbox( 'mshowtime', $mshowtime, 'Show time', $this); ?>
		<label for="<?php echo $this->get_field_id('mauthor'); ?>"><?php _e('Author',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
		<select name="<?php echo $this->get_field_name('mauthor'); ?>" id="<?php echo $this->get_field_id('mauthor'); ?>">
		<option value="true" <?php selected($mauthor,'true');?>>ON</option>
		<option value="false" <?php selected($mauthor,'false');?>>OFF</option>
		</select>
	
		<label for="<?php echo $this->get_field_id('mcomments'); ?>"><?php _e('Comments',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
		<select name="<?php echo $this->get_field_name('mcomments'); ?>" id="<?php echo $this->get_field_id('mcomments'); ?>">
		<option value="true" <?php selected($mcomments,'true');?>>ON</option>
		<option value="false" <?php selected($mcomments,'false');?>>OFF</option>
		</select>
		</p></fieldset>
		<p>
		<label for="<?php echo $this->get_field_id('mreadmore'); ?>"><?php _e('Read More Link',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
		<select name="<?php echo $this->get_field_name('mreadmore'); ?>" id="<?php echo $this->get_field_id('mreadmore'); ?>">
		<option value="right" <?php selected($mreadmore,'right');?>><?php _e('Right Aligned',THEME_ADMIN_LANG_DOMAIN) ?></option>
		<option value="left" <?php selected($mreadmore,'left');?>><?php _e('Left Aligned',THEME_ADMIN_LANG_DOMAIN) ?></option>
		<option value="false" <?php selected($mreadmore,'false');?>>OFF</option>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('rmtext'); ?>"><?php _e('Read More Text:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<select name="<?php echo $this->get_field_name('rmtext'); ?>" id="<?php echo $this->get_field_id('rmtext'); ?>">
		<option value="Read More" <?php selected($rmtext,'Read More');?>><?php _e('Read More',THEME_LANG_DOMAIN) ?></option>
		<option value="More" <?php selected($rmtext,'More');?>><?php _e('More',THEME_LANG_DOMAIN) ?></option>
		<option value="Continue Reading" <?php selected($rmtext,'Continue Reading');?>><?php _e('Continue Reading',THEME_LANG_DOMAIN) ?></option>
		<option value="Continue" <?php selected($rmtext,'Continue');?>><?php _e('Continue',THEME_LANG_DOMAIN) ?></option>
		<option value="Details" <?php selected($rmtext,'Details');?>><?php _e('Details',THEME_LANG_DOMAIN) ?></option>
		
		</select>
		</p>
		
		<?php 
}

}
add_action('widgets_init', create_function('', 'return register_widget("UltimatumCustomContent");'));

function ultimatum_custcontent_inpcheckbox( $fieldid, &$currval, $title, &$that){
// ech( $fieldid, $currval);
?>

      <label for="<?php echo $that->get_field_id($fieldid); ?>"><?php _e($title); ?></label>
      <input id="<?php echo $that->get_field_id($fieldid); ?>" name="<?php echo $that->get_field_name($fieldid); ?>" type="checkbox" value="1"  <?php checked($currval, 1, true); ?> />

<?php
} // end ultimatum_inpcheckbox

function ultimatum_custcontent_inptext( $fieldid, &$currval, $title, &$that, $size = ''){

   $format ='';

   if ($size !== '' ){  $format = ' size="' .$size. '" ';  }

?>

      <label for="<?php echo $that->get_field_id($fieldid); ?>"><?php _e($title,THEME_ADMIN_LANG_DOMAIN) ?>:</label>
      <input type="text" name="<?php echo $that->get_field_name($fieldid); ?>" id="<?php echo $that->get_field_id($fieldid); ?>"  value="<?php echo $currval; ?>" <?php echo $format; ?> />


<?php

}

