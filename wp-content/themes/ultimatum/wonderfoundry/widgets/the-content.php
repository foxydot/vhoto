<?php
class UltimatumContent extends WP_Widget {
	/*
	 * Tricky Loops v5 Thanks to Richard
	*/
function UltimatumContent() {
        parent::WP_Widget(false, $name = 'WordPress Default Loop');
}

function blog_multimeta($instance)
   {

      global $post;
      $tax =array();
      $out= array();
      $output = '';
      if ($instance["mdate"]=='true'){

         $mshowtime     = isset( $instance['mshowtime'] ) ? $instance['mshowtime'] : '';

         if($mshowtime){ 
         	$mtime = the_time() ;
         	$out[] = '<span class="date"><a href="'.get_month_link(get_the_time('Y'), get_the_time('m')).'">'.get_the_date(). ' ' . $mtime . '</a></span>';
         } else {
         	$out[] = '<span class="date"><a href="'.get_month_link(get_the_time('Y'), get_the_time('m')).'">'.get_the_date(). '</a></span>';
         }

         

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

      }
      return $output;
   }

function post_gallery($type,$width,$height,$cols,$instance){
   global $post;
   if($type=='nivo'){
      $imgwidth   =$width;
      $imgheight  =$height;
      wp_enqueue_script('jquery-nivo',THEME_JS.'/jquery.nivo.slider.pack.js');
      echo '<div class="slider-wrapper nivo'.$instance[nivo_color].'">';
   } else {
      $margins = ($cols-1)*10;
      $imgwidth = ($width-$margins)/$cols;
      $imgheight  =$imgwidth;
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
		$img_src= UltimatumImageResizer( $id, null,$imgwidth, $imgheight, true );
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
      ?>
      </div>
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
function blog_meta($instance)
   {

      global $post;
      $tax =array();
      $out= array();
      $output = '';
      if ($instance["date"]=='true'){

         $showtime      = isset( $instance['showtime'] ) ? $instance['showtime'] : '';

         if($showtime){ $time = the_time() ;
         
         } else {
         	$time='';
         }

         $out[] = '<span class="date"><a href="'.get_month_link(get_the_time('Y'), get_the_time('m')).'">'.get_the_date(). ' ' . $time . '</a></span>';

      }
      if ($instance["author"]=='true'){
         $out[] = '<span class="author">'.__('By: ', THEME_LANG_DOMAIN).'<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'">'. get_the_author().'</a></span>';
      }
      if($instance["comments"]=="true" && ($post->comment_count > 0 || comments_open())){
         ob_start();
         comments_popup_link(__('No Comments',THEME_LANG_DOMAIN), __('1 Comment',THEME_LANG_DOMAIN), __('% Comments',THEME_LANG_DOMAIN),'');
         $out[] = '<span class="comments">'.ob_get_clean().'</span>';
      }
      if(count($out)!=0){
      $output = '<div class="post-meta">';
      $output .= join( ' '.$instance["mseperator"].' ', $out ).'</div>';
      }
      if ($instance["cats"]=='ameta' && !is_page()){
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
      }
      return $output;
   }
function widget($args, $instance) {

        extract( $args );
        $per_page = $instance["perpage"];
        if(ULTIMATUM_LOOP!='wp'){
         include("loops/".ULTIMATUM_LOOP.".php");
        } else {
        	if(is_single()||is_page()){
        		if(preg_match('/.php/i', $instance["single"])) {
        			$loopfile = $instance["single"];
        		}
        	}else{
        		global $wp_query;
        		$paged = (get_query_var('paged') && get_query_var('paged') > 1) ? get_query_var('paged') : 1;
        		$args = array_merge(
        				$wp_query->query,
        				array(
        						'posts_per_page' =>$per_page,
        						"paged"=>$paged,
        		
        				)
        		);
        		query_posts( $args );
        		if(preg_match('/.php/i', $instance["multiple"])) {
        			$loopfile = $instance["multiple"];
        		}
        	}
        if($loopfile){
        	include(THEME_LOOPS_DIR.'/'.$loopfile);
        } else {
        	
        $title = apply_filters('widget_title', $instance['title']);
        $colprops = explode('-', $instance["multiple"]);
       
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



        ?>
        <div id="content">

        <?php
         $i=1;
            if(is_single() || is_page() ) :
            if ( have_posts() ) : while ( have_posts() ) : the_post();
               global $post;

                  switch ($instance["single"]){
                     case 'rimage':
                        $image = true;
                        $align = "float:right;margin-left:20px;";
                        $imgw=$instance["singlew"];
                     break;
                     case 'limage':
                        $image = true;
                        $align = "float:left;margin-right:20px;";
                        $imgw=$instance["singlew"];
                     break;
                     case 'fimage':
                        $image = true;
                        $imgw = $grid_width;
                        $imgw=$instance["singlew"];
                        $align='';
                     break;
                     default:
                        $image= false;
                     	$align='';
                     break;
                  }

                  $styler='
                  <style type="text/css">
                  #'.$widget_id.'{
                  float:left;
                  width:100%;

                  }
                  #'.$widget_id.' .aligner{
                  '.$align.'
                  }
                  ';
                  if($responsivetheme):
                  $styler.='
                  @media screen and (min-width:720px) and (max-width: 979px) {
                  #'.$widget_id.'{
                  float:left;
                  width:100%;
                  margin-right:0;
                  }
                  #'.$widget_id.' .aligner {';
                  if(isset($align)){
                     $styler.=$align;
                  } else {
                     $styler.= 'width:100%;';
                  }
                  $styler.='
                  }
                  #'.$widget_id.' .aligner img{
                  max-width:100%;
                  }
                  }
                  @media screen and (min-width:240px) and (max-width: 719px) {
                  #'.$widget_id.'{
                  float:left;
                  width:100%;
                  }
                  #'.$widget_id.' .aligner {
                  width:100%;
                  }
                  #'.$widget_id.' .aligner img{
                  max-width:100%;
                  }
                  }';
                  endif;
                  $styler.='</style>';
                  echo $styler;
                  ?>



                  <div class="post-<?php echo $post->ID;?> ultimatepost" id="<?php echo $widget_id;?>">
                   <div class="post-inner-single">
                     <?php
                     if($image){
	                     $img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large') ;
	                     if(!isset($img) && $instance["noimage"]=='true'){
	                     	if(get_theme_option('general', 'noimage')){
	                     		$img[0]=	get_theme_option('general', 'noimage');
	                     	} else {
	                     		$img[0] = THEME_URI.'/images/no-image.jpg';
	                     	}
	                     	$imgsrc = UltimatumImageResizer( null, $img[0],$imgw, $instance["singleh"], true );
	                     } else {
	                     	$imgsrc = UltimatumImageResizer( get_post_thumbnail_id(), null,$imgw, $instance["singleh"], true );
	                     }
                     }
                     if($image && $img){
                     ?>
                     <div class="aligner" >
                     <?php if($instance["gallery"]=='nivo') {
                        $this->post_gallery('nivo', $imgw, $instance["singleh"], $instance["thumbs"],$instance);
                        } else { ?>
                        <?php if($instance["meta"]=='bimage') echo $this->blog_meta($instance);?>
                        <?php if($img){ ?>
                        <a href="<?php if($gallery){echo $link; } else { the_permalink();} ?>" <?php echo$rel?>>
                        <img src="<?php echo $imgsrc;?>" alt="<?php the_title();?>" /></a>
                        <?php } ?>
                        <?php if($instance["gallery"]=='aimage') {
                           $this->post_gallery('thumbs', $imgw, $instance["singleh"], $instance["thumbs"],$instance);
                        } ?>
                     <?php }?>
                        <?php if($instance["meta"]=='aimage') echo $this->blog_meta($instance);?>
                     </div>

                        <?php }?>
                        <div>
                       <?php if($instance["title"]=='true'){?>
                    <h2 class="post-header"><a class="post-title" href="<?php the_permalink();?>" ><?php the_title()?></a></h2>
                    <?php } ?>
                    <?php if($instance["meta"]=='atitle') echo $this->blog_meta($instance);?>
                    <div class="the-post-content">
                    <?php
                          $retainformat = false;
                          if ($retainformat){
                            $content=get_the_content_with_formatting();
                            $content = apply_filters('the_content', $content);

                            echo $content;
                          }
                          else
                          {
                             the_content();
                          }


                         ?>
                    <?php wp_link_pages(); ?>
                    </div>

                    <?php if($instance["meta"]=='atext') echo $this->blog_meta($instance);
                     if ($instance["cats"]=='acontent' && !is_page()){
                              $_tax = get_the_taxonomies();
                              if ( empty($_tax) ){
                              } else {
                                 foreach ( $_tax as $key => $value ) {
                                    preg_match( '/(.+?): /i', $value, $matches );
                                    $tax[] = '<span class="entry-tax-'. $key .'">' . str_replace( $matches[0], '<span class="entry-tax-meta">'. $matches[1] .':</span> ', $value ) . '</span>';
                                 }
                              }
                              echo '<div class="post-taxonomy">'.join( '<br />', $tax ).'</div>';

                           }
                    ?>
                    </div>

                    </div>
                    <?php
                    //echo get_post_meta($post->ID, 'ultimatum_author', true);
                    if( get_post_meta($post->ID, 'ultimatum_author', true)=='true' ){
                     if ( get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries ?>
                     <div id="author-info">
                        <div id="author-avatar">
                           <?php echo get_avatar( get_the_author_meta( 'user_email' ), 68 ); ?>
                        </div><!-- #author-avatar -->
                        <div id="author-description">
                           <h2><?php printf( esc_attr__( 'About %s', THEME_LANG_DOMAIN ), get_the_author() ); ?></h2>
                           <?php the_author_meta( 'description' ); ?>
                           <div id="author-link">
                              <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                                 <?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', THEME_LANG_DOMAIN ), get_the_author() ); ?>
                              </a>
                           </div><!-- #author-link -->
                        </div><!-- #author-description -->
                     </div><!-- #entry-author-info -->
                     <?php endif; } ?>


                  </div>
                  <div class="clearboth"></div>
                  <?php
                  if($instance['show_comments_form']=='true')  comments_template( '', true );

               endwhile;
               endif;
            // end of single or page Main IF for Loop
            else : //multi post

            $colcount=$cols;
            if($colcount==1 && ($colprops[2]=='ri' || $colprops[2]=='li' || $colprops[2]=='gl' || $colprops[2]=='gr') ){
               $imgw=$instance[multiplew];
            } else {$imgw=$colw;
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
                  $align='';
                  break;
               case 'i':
                  $align='';
               break;
               default:
                  $noimage=true;
                  $align='';
               break;
            }

            //Print the Style

$styler='
<style type="text/css">
.ultimatepost{
   float:left;
   width:'.$grid.'px;';
   if(isset($instance['mmargin'])) $styler.='margin-right:'.$instance["mmargin"].'px;';
$styler.='}
.ultimatepost .aligner{
   '.$align.'
}
';
if($responsivetheme):
$styler.='
   @media screen and (min-width:720px) and (max-width: 979px) {
      .ultimatepost{
         float:left;
           width:100%;
           margin-right:0;
      }
.ultimatepost .aligner {';
         if(isset($align)){
            $styler.=$align;
         } else {
            $styler.= 'width:100%;';
         }
         $styler.='
      }
      .ultimatepost .aligner img{
         max-width:100%;
         }
   }
   @media screen and (min-width:240px) and (max-width: 719px) {
      .ultimatepost{
         float:left;
           width:100%;
      }
      .ultimatepost .aligner {
         width:100%;
      }
      .ultimatepost .aligner img{
         max-width:100%;
      }
   }';
         endif;
         $styler.='</style>';
echo $styler;

               if (!have_posts()){

                  $shownopostsmsg = isset( $instance['shownopostsmsg'] ) ? $instance['shownopostsmsg'] : '';
                  $nopostsmsg     = isset( $instance['nopostsmsg'] ) ? $instance['nopostsmsg'] : '';

                  if ($shownopostsmsg){

               ?>
               <div id=" <?php echo $widget_id . '-noposts';?> class="tricky-dflt-noposts" >
                    <?php echo $nopostsmsg; ?>
               </div>
               <?php
                    }



               }
               if (have_posts()) :
               if($instance["mtitle"]=='true'){
                   ?>
                   <h1 class="multi-post-title">
					<?php if ( is_day() ) : ?>
							<?php printf( __( 'Daily Archives: %s', 'ultimatum' ), '<span>' . get_the_date() . '</span>' ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf( __( 'Monthly Archives: %s', 'ultimatum' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'ultimatum' ) ) . '</span>' ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( __( 'Yearly Archives: %s', 'ultimatum' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'ultimatum' ) ) . '</span>' ); ?>
						<?php elseif(is_search()) : ?>
							<?php printf( __( 'Search Results for: %s', 'ultimatum' ), '<span>' . get_search_query() . '</span>' ); ?>
						<?php elseif(is_author()) : ?>
							<?php printf( __( 'Author Archives: %s', 'twentyeleven' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?>
						<?php else :?>
							<?php remove_all_filters('wp_title'); echo strip_tags(wp_title('',false,'left'));?>
						<?php endif; ?>
                  </h1>
                   <?php
               }
                  global $wp_query;
                  $paged = (get_query_var('paged') && get_query_var('paged') > 1) ? get_query_var('paged') : 1;
                  $args = array_merge(
                              $wp_query->query,
                              array(
                                 'posts_per_page' =>$per_page,
                                 "paged"=>$paged,

                              )
                              );
                  query_posts( $args );

                  while (have_posts()) : the_post();
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
                     <div class="post post-<?php echo $post->ID;?> ultimatepost <?php if($gps) echo "last";?>">
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
                       <h2 class="post-header">
                       <?php if($rel){ ?>
                       <?php the_title(); ?>
                       <?php } else { ?>
                       <a class="post-title" href="<?php the_permalink(); ?>"><?php the_title()?></a>
                       <?php } ?>
                       </h2>
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
                         <p class="post-excerpt">
                           <?php echo wp_html_excerpt(get_the_excerpt(),$instance["excerptlength"]);?>...
                           <?php if($instance["mreadmore"]=='after') { ?>
                              <a href="<?php the_permalink(); ?>" class="readmorecontent" >
                                 <span><?php _e($instance["rmtext"],THEME_LANG_DOMAIN) ;?></span>
                              </a>
                           <?php  } ?>
                        </p>
                       <?php } elseif($instance['excerpt']=='content') {?>
                        <p class="post-excerpt">
                           <?php the_content();?>
                           <?php if($instance["mreadmore"]=='after') { ?>
                           <a href="<?php the_permalink(); ?>" class="readmorecontent" >
                              <span><?php _e($instance["rmtext"],THEME_LANG_DOMAIN) ;?></span>
                           </a>
                           <?php  } ?>
                        </p>
                       <?php } ?>
                       <?php if($instance["mmeta"]=='atext') echo $this->blog_multimeta($instance);
                       if ($instance["mcats"]=='acontent'){
                       			$_tax=array();
                       			$tax=array();
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
                       if($instance["mreadmore"]!='false' && $instance["mreadmore"]!='after') {
                       ?>
                           <p style="text-align:<?php echo $instance["mreadmore"];?>">
                           <a href="<?php the_permalink(); ?>" class="readmorecontent" >
                              <span><?php _e($instance["rmtext"],THEME_LANG_DOMAIN) ;?></span>
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


         endif;// MainIF Finish end multi post

        echo '<div style="clear:both"></div>';
        ?>
        <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
        </div>
        <?php
        }
        }
    }

function update($new_instance, $old_instance) {
   $instance['single']        = $new_instance['single'];
   $instance['singlew']    = $new_instance['singlew'];
   $instance['singleh']    = $new_instance['singleh'];
   $instance['title']         = $new_instance['title'];
   $instance['meta']       = $new_instance['meta'];
   $instance['date']       = $new_instance['date'];
   $instance['author']        = $new_instance['author'];
   $instance['comments']      = $new_instance['comments'];
   $instance['show_comments_form']     = $new_instance['show_comments_form'];
   $instance['cats']       = $new_instance['cats'];
   $instance['gallery']    = $new_instance['gallery'];
   $instance['thumbs']        = $new_instance['thumbs'];

   $instance['nivo_effect']         = $new_instance['nivo_effect'];
   $instance['nivo_segments']       = $new_instance['nivo_segments'];
   $instance['nivo_animspeed']         = $new_instance['nivo_animspeed'];
   $instance['nivo_pausetime']         = $new_instance['nivo_pausetime'];
   $instance['nivo_nav']            = $new_instance['nivo_nav'];
   $instance['nivo_navhover']       = $new_instance['nivo_navhover'];
   $instance['nivo_controls']       = $new_instance['nivo_controls'];
   $instance['nivo_pausehover']     = $new_instance['nivo_pausehover'];
   $instance['nivo_captions']       = $new_instance['nivo_captions'];
   $instance['nivo_captionsopacity']   = $new_instance['nivo_captionsopacity'];
   $instance['nivo_color']          = $new_instance['nivo_color'];

   $instance['perpage']    = $new_instance['perpage'];
   $instance['mseperator']    = $new_instance['mseperator'];
   $instance['multiple']      = $new_instance['multiple'];
   $instance['multipleh']     = $new_instance['multipleh'];
   $instance['multiplew']     = $new_instance['multiplew'];
   $instance['mtitle']        = $new_instance['mtitle'];
   $instance['mvideo']        = $new_instance['mvideo'];
   $instance['mmeta']         = $new_instance['mmeta'];
   $instance['mdate']         = $new_instance['mdate'];
   $instance['mauthor']    = $new_instance['mauthor'];
   $instance['mimgpos']    = $new_instance['mimgpos'];
   $instance['mcomments']     = $new_instance['mcomments'];
   $instance['mcats']         = $new_instance['mcats'];
   $instance['excerpt']    = $new_instance['excerpt'];
   $instance['excerptlength'] = $new_instance['excerptlength'];
   $instance['mreadmore']     = $new_instance['mreadmore'];
   $instance['rmtext']        = $new_instance['rmtext'];
   $instance['mmargin']    = $new_instance['mmargin'];
   $instance['mmseperator']   = $new_instance['mmseperator'];
   $instance['noimage']    = $new_instance['noimage'];
   $instance['mnoimage']      = $new_instance['mnoimage'];

   $instance['showtime']      = $new_instance['showtime'];
   $instance['mshowtime']     = $new_instance['mshowtime'];

   $instance['shownopostsmsg']   = $new_instance['shownopostsmsg'];
   $instance['nopostsmsg']       = $new_instance['nopostsmsg'];



     return $instance;
    }

function form($instance) {

        $single         = isset( $instance['single'] ) ? $instance['single'] : 'fimage';
        $title       = isset( $instance['title'] ) ? $instance['title'] : 'true';
        $excerpt     = isset( $instance['excerpt'] ) ? $instance['excerpt'] : 'true';
      $singlew    = isset( $instance['singlew'] ) ? $instance['singlew'] : '220';
      $singleh    = isset( $instance['singleh'] ) ? $instance['singleh'] : '220';
      $meta       = isset( $instance['meta'] ) ? $instance['meta'] : 'aimage';
      $mseperator    = isset( $instance['mseperator'] ) ? $instance['mseperator'] : '|';
      $date       = isset( $instance['date'] ) ? $instance['date'] : 'true';
      $author        = isset( $instance['author'] ) ? $instance['author'] : 'false';
      $comments      = isset( $instance['comments'] ) ? $instance['comments'] : 'true';
      $show_comments_form     = isset( $instance['show_comments_form'] ) ? $instance['show_comments_form'] : 'true';
      $cats       = isset( $instance['cats'] ) ? $instance['cats'] : 'false';
      $gallery    = isset( $instance['gallery'] ) ? $instance['gallery'] : 'false';
      $thumbs        = isset( $instance['thumbs'] ) ? $instance['thumbs'] : '3';

      $nivo_effect         = isset( $instance['nivo_effect'] ) ? $instance['nivo_effect'] : 'random';
      $nivo_segments       = isset( $instance['nivo_segments'] ) ? $instance['nivo_segments'] : '10';
      $nivo_animspeed      = isset( $instance['nivo_animspeed'] ) ? $instance['nivo_animspeed'] : '700';
      $nivo_pausetime         = isset( $instance['nivo_pausetime'] ) ? $instance['nivo_pausetime'] : '4000';
      $nivo_nav            = isset( $instance['nivo_nav'] ) ? $instance['nivo_nav'] : '';
      $nivo_navhover       = isset( $instance['nivo_navhover'] ) ? $instance['nivo_navhover'] : '';
      $nivo_controls       = isset( $instance['nivo_controls'] ) ? $instance['nivo_controls'] : '';
      $nivo_pausehover     = isset( $instance['nivo_pausehover'] ) ? $instance['nivo_pausehover'] : '';
      $nivo_captions          = isset( $instance['nivo_captions'] ) ? $instance['nivo_captions'] : '';
      $nivo_captionsopacity   = isset( $instance['nivo_captionsopacity'] ) ? $instance['nivo_captionsopacity'] : '0.5';
      $nivo_color          = isset( $instance['nivo_color'] ) ? $instance['nivo_color'] : 'grey';

      $mtitle        = isset( $instance['mtitle'] ) ? $instance['mtitle'] : 'true';
      $mimgpos       = isset( $instance['mimgpos'] ) ? $instance['mimgpos'] : 'btitle';
      $mvideo        = isset( $instance['mvideo'] ) ? $instance['mvideo'] : 'false';
      $perpage    = isset( $instance['perpage'] ) ? $instance['perpage'] : '10';
      $multiple      = isset( $instance['multiple'] ) ? $instance['multiple'] : '1coli';
      $multiplew     = isset( $instance['multiplew'] ) ? $instance['multiplew'] : '220';
      $multipleh     = isset( $instance['multipleh'] ) ? $instance['multipleh'] : '220';
      $excerptlength    = isset( $instance['excerptlength'] ) ? $instance['excerptlength'] : '100';
      $mmeta         = isset( $instance['mmeta'] ) ? $instance['mmeta'] : 'aimage';
      $mmargin    = isset( $instance['mmargin'] ) ? $instance['mmargin'] : '30';
      $mdate         = isset( $instance['mdate'] ) ? $instance['mdate'] : 'true';
      $mauthor    = isset( $instance['mauthor'] ) ? $instance['mauthor'] : 'false';
      $mcomments     = isset( $instance['mcomments'] ) ? $instance['mcomments'] : 'true';
      $mcats         = isset( $instance['mcats'] ) ? $instance['mcats'] : 'false';
      $mreadmore     = isset( $instance['mreadmore'] ) ? $instance['mreadmore'] : 'right';
      $mmseperator   = isset( $instance['mmseperator'] ) ? $instance['mmseperator'] : '|';
      $rmtext        = isset( $instance['rmtext'] ) ? $instance['rmtext'] : 'Read More';
      $noimage    = isset( $instance['noimage'] ) ? $instance['noimage'] : 'true';
      $mnoimage      = isset( $instance['mnoimage'] ) ? $instance['mnoimage'] : 'true';


      $showtime      = isset( $instance['showtime'] ) ? $instance['showtime'] : '';
      $mshowtime     = isset( $instance['mshowtime'] ) ? $instance['mshowtime'] : '';

      $shownopostsmsg      = isset( $instance['shownopostsmsg'] ) ? $instance['shownopostsmsg'] : '';
      $nopostsmsg    = isset( $instance['nopostsmsg'] ) ? $instance['nopostsmsg'] : '';


      $widget_id = $this->id;

      $tabdiv = "tabs-" . $widget_id;

      $tabsing = $tabdiv . "-single";
      $tabmulti = $tabdiv . "-multi";


      ?>
      <script>
      jQuery(function() {
         jQuery( "#<?php echo $tabdiv;?>" ).tabs();
      });
      </script>
      <div id="<?php echo $tabdiv;?>" >
      <ul>
         <li><a href="#<?php echo $tabsing;?>"><?php _e('Single Post Layout',THEME_ADMIN_LANG_DOMAIN) ?></a></li>
         <li><a href="#<?php echo $tabmulti;?>"><?php _e('Multi Post Layout',THEME_ADMIN_LANG_DOMAIN) ?></a></li>
      </ul>
      <div id="<?php echo $tabsing;?>">

      <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
      <select name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>">
      <option value="true" <?php selected($title,'true');?>>ON</option>
      <option value="false" <?php selected($title,'false');?>>OFF</option>
      </select>
      </p>
      <p>
      <label for="<?php echo $this->get_field_id('single'); ?>"><?php _e('Layout',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
      <select name="<?php echo $this->get_field_name('single'); ?>" id="<?php echo $this->get_field_id('single'); ?>">
      <?php 
      		if(file_exists(THEME_LOOPS_DIR.'/extraloops.php')){
      			include(THEME_LOOPS_DIR.'/extraloops.php');
      			foreach($extraloops as $loops){
      				
      				?>
      				<option value="<?php echo $loops["file"];?>" <?php selected($single,$loops["file"]);?>><?php _e($loops["name"],THEME_ADMIN_LANG_DOMAIN) ?></option>
      				<?php 
      			}
      		}
      	?>
         <option value="fimage" <?php selected($single,'fimage');?>><?php _e('Full image on Top',THEME_ADMIN_LANG_DOMAIN) ?></option>
         <option value="nimage" <?php selected($single,'nimage');?>><?php _e('No image',THEME_ADMIN_LANG_DOMAIN) ?></option>
         <option value="limage" <?php selected($single,'limage');?>><?php _e('Image On Left',THEME_ADMIN_LANG_DOMAIN) ?></option>
         <option value="rimage" <?php selected($single,'rimage');?>><?php _e('Image On Right',THEME_ADMIN_LANG_DOMAIN) ?></option>
      </select>
      </p>
      <p>
      <label for="<?php echo $this->get_field_id('noimage'); ?>"><?php _e('No Image',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
      <select name="<?php echo $this->get_field_name('noimage'); ?>" id="<?php echo $this->get_field_id('noimage'); ?>">
      <option value="true" <?php selected($noimage,'true');?>>Show Placeholder</option>
      <option value="false" <?php selected($noimage,'false');?>>OFF</option>
      </select>
      </p>
      <p>
      <label for="<?php echo $this->get_field_id('singlew'); ?>"><?php _e('Image Width on Single Post',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
      <input type="text" value="<?php echo $singlew;?>" name="<?php echo $this->get_field_name('singlew'); ?>" id="<?php echo $this->get_field_id('singlew'); ?>" /><i>Applied on Image on Left/Right Aligned pages</i>
      </p>
      <p>
      <label for="<?php echo $this->get_field_id('singleh'); ?>"><?php _e('Image Height on Single Post',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
      <input type="text" value="<?php echo $singleh;?>"  name="<?php echo $this->get_field_name('singleh'); ?>" id="<?php echo $this->get_field_id('singleh'); ?>" />
      </p>
      <p>
         <label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Taxonomy',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
         <select name="<?php echo $this->get_field_name('cats'); ?>" id="<?php echo $this->get_field_id('cats'); ?>">
         <option value="ameta" <?php selected($cats,'ameta');?>><?php _e('After Meta',THEME_ADMIN_LANG_DOMAIN) ?></option>
         <option value="acontent" <?php selected($cats,'acontent');?>><?php _e('After Content',THEME_ADMIN_LANG_DOMAIN) ?></option>
         <option value="false" <?php selected($cats,'false');?>>OFF</option>
         </select>
      </p>
      <p>
      <label for="<?php echo $this->get_field_id('show_comments_form'); ?>"><?php _e('Show Comments Form',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
      <select name="<?php echo $this->get_field_name('show_comments_form'); ?>" id="<?php echo $this->get_field_id('show_comments_form'); ?>">
      <option value="true" <?php selected($show_comments_form,'true');?>>ON</option>
      <option value="false" <?php selected($show_comments_form,'false');?>>OFF</option>
      </select>
      </p>
      <p>
      <label for="<?php echo $this->get_field_id('meta'); ?>"><?php _e('Meta',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
      <select name="<?php echo $this->get_field_name('meta'); ?>" id="<?php echo $this->get_field_id('meta'); ?>">
         <option value="atitle" <?php selected($meta,'atitle');?>><?php _e('After Title',THEME_ADMIN_LANG_DOMAIN) ?></option>
         <option value="bimage" <?php selected($meta,'bimage');?>><?php _e('Before Image',THEME_ADMIN_LANG_DOMAIN) ?></option>
         <option value="aimage" <?php selected($meta,'aimage');?>><?php _e('After Image',THEME_ADMIN_LANG_DOMAIN) ?></option>
         <option value="atext" <?php selected($meta,'atext');?>><?php _e('After Content',THEME_ADMIN_LANG_DOMAIN) ?></option>
         <option value="false" <?php selected($meta,'false');?>>OFF</option>
      </select>
      </p>
      <fieldset><legend><?php _e('Single Post Meta Properties',THEME_ADMIN_LANG_DOMAIN) ?></legend>
      <p>
         <label for="<?php echo $this->get_field_id('mseperator'); ?>"><?php _e('Meta Seperator',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
         <input name="<?php echo $this->get_field_name('mseperator'); ?>" id="<?php echo $this->get_field_id('mseperator'); ?>" value="<?php echo $mseperator; ?>" />
      </p>
      <p>
      <label for="<?php echo $this->get_field_id('date'); ?>"><?php _e('Date',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
      <select name="<?php echo $this->get_field_name('date'); ?>" id="<?php echo $this->get_field_id('date'); ?>">
      <option value="true" <?php selected($date,'true');?>>ON</option>
      <option value="false" <?php selected($date,'false');?>>OFF</option>
      </select>

      <?php  ultimatum_content_inpcheckbox( 'showtime', $showtime, 'Show time', $this); ?>

      <label for="<?php echo $this->get_field_id('author'); ?>"><?php _e('Author',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
      <select name="<?php echo $this->get_field_name('author'); ?>" id="<?php echo $this->get_field_id('author'); ?>">
      <option value="true" <?php selected($author,'true');?>>ON</option>
      <option value="false" <?php selected($author,'false');?>>OFF</option>
      </select>

      <label for="<?php echo $this->get_field_id('comments'); ?>"><?php _e('Comments',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
      <select name="<?php echo $this->get_field_name('comments'); ?>" id="<?php echo $this->get_field_id('comments'); ?>">
      <option value="true" <?php selected($comments,'true');?>>ON</option>
      <option value="false" <?php selected($comments,'false');?>>OFF</option>
      </select>
      </p>
      </fieldset>
      <br />
      <div class="slider-select-wrapper">

      <label for="<?php echo $this->get_field_id('gallery'); ?>"><?php _e('Post Image Gallery',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
      <select name="<?php echo $this->get_field_name('gallery'); ?>" id="<?php echo $this->get_field_id('gallery'); ?>" onchange="slideOpts(this);">
         <option value="false" <?php selected($gallery,'false');?>>OFF</option>
         <option value="aimage" <?php selected($gallery,'aimage');?>><?php _e('As thumbnails after Image',THEME_ADMIN_LANG_DOMAIN) ?></option>
         <option value="nivo" <?php selected($gallery,'nivo');?>><?php _e('As nivo instead of image',THEME_ADMIN_LANG_DOMAIN) ?></option>
      </select>
      <br /><br />
      <div class="slider_options">
      <div class="aimage options" style="<?php if($gallery!='aimage'){ echo 'display:none'; }?>">
      <p>
         <label for="<?php echo $this->get_field_id('thumbs'); ?>"><?php _e('Gallery Thumbs per row',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
         <input name="<?php echo $this->get_field_name('thumbs'); ?>" id="<?php echo $this->get_field_id('thumbs'); ?>" value="<?php echo $thumbs; ?>" />
      </p>
      </div>
      <div class="nivo options" style="<?php if($gallery!='nivo'){ echo 'display:none'; }?>">
      <p><label for="<?php echo $this->get_field_id('nivo_effect'); ?>"><?php _e( 'Slide Effect :' ,THEME_ADMIN_LANG ); ?></label>
                  <select name="<?php echo $this->get_field_name('nivo_effect'); ?>" id="<?php echo $this->get_field_id('nivo_effect'); ?>">
                     <option value="random" <?php selected($nivo_effect,'random'); ?>>random</option>
                     <option value="sliceDown" <?php selected($nivo_effect,'sliceDown'); ?>>sliceDown</option>
                     <option value="sliceDownLeft" <?php selected($nivo_effect,'sliceDownLeft'); ?>>sliceDownLeft</option>
                     <option value="sliceUp" <?php selected($nivo_effect,'sliceUp'); ?>>sliceUp</option>
                     <option value="sliceUpLeft" <?php selected($nivo_effect,'sliceUpLeft'); ?>>sliceUpLeft</option>
                     <option value="sliceUpDown" <?php selected($nivo_effect,'sliceUpDown'); ?>>sliceUpDown</option>
                     <option value="sliceUpDownLeft" <?php selected($nivo_effect,'sliceUpDownLeft'); ?>>sliceUpDownLeft</option>
                     <option value="fold" <?php selected($nivo_effect,'fold'); ?>>fold</option>
                     <option value="fade" <?php selected($nivo_effect,'fade'); ?>>fade</option>
                     <option value="slideInRight" <?php selected($nivo_effect,'slideInRight'); ?>>slideInRight</option>
                     <option value="slideInLeft" <?php selected($nivo_effect,'slideInLeft'); ?>>slideInLeft</option>
                     <option value="boxRandom" <?php selected($nivo_effect,'boxRandom'); ?>>boxRandom</option>
                     <option value="boxRain" <?php selected($nivo_effect,'boxRain'); ?>>boxRain</option>
                     <option value="boxRainReverse" <?php selected($nivo_effect,'boxRainReverse'); ?>>boxRainReverse</option>
                     <option value="boxRainGrow" <?php selected($nivo_effect,'boxRainGrow'); ?>>boxRainGrow</option>
                     <option value="boxRainGrowReverse" <?php selected($nivo_effect,'boxRainGrowReverse'); ?>>boxRainGrowReverse</option>
                  </select></p>
               <p>
               <label for="<?php echo $this->get_field_id('nivo_segments'); ?>"><?php _e( 'Segments :' ,THEME_ADMIN_LANG ); ?></label>
               <select id="<?php echo $this->get_field_id('nivo_segments'); ?>" name="<?php echo $this->get_field_name('nivo_segments'); ?>">
               <?php
                  for ($i=1;$i<=30;$i++){
                     echo '<option value="'.$i.'" '.selected($nivo_segments,$i,false).'>'.$i.'</option>';
                  }
               ?>
               </select>
               </p>
               <p>
               <label for="<?php echo $this->get_field_id('nivo_animspeed'); ?>"><?php _e( 'Animation Speed :' ,THEME_ADMIN_LANG ); ?></label>
               <select id="<?php echo $this->get_field_id('nivo_animspeed'); ?>" name="<?php echo $this->get_field_name('nivo_animspeed'); ?>">
               <?php
                  for ($i=200;$i<=3000;$i=$i+100){
                     echo '<option value="'.$i.'" '.selected($nivo_animspeed,$i,false).'>'.$i.'</option>';
                  }
               ?>
               </select>
               </p>
               <p>
               <label for="<?php echo $this->get_field_id('nivo_pausetime'); ?>"><?php _e( 'Pause Time :' ,THEME_ADMIN_LANG ); ?></label>
               <select id="<?php echo $this->get_field_id('nivo_pausetime'); ?>" name="<?php echo $this->get_field_name('nivo_pausetime'); ?>">
               <?php
                  for ($i=1000;$i<=30000;$i=$i+500){
                     echo '<option value="'.$i.'" '.selected($nivo_pausetime,$i,false).'>'.$i.'</option>';
                  }
               ?>
               </select>
               </p>
               <p>
               <label for="<?php echo $this->get_field_id('nivo_nav'); ?>"><?php _e( 'Show Next & Prev :' ,THEME_ADMIN_LANG ); ?></label>
               <select id="<?php echo $this->get_field_id('nivo_nav'); ?>" name="<?php echo $this->get_field_name('nivo_nav'); ?>" >
                  <option value="true" <?php selected($nivo_nav,'true'); ?> >ON</option>
                  <option value="false" <?php selected($nivo_nav,'false'); ?> >OFF</option>
               </select>
               </p>
               <p>
               <label for="<?php echo $this->get_field_id('nivo_navhover'); ?>"><?php _e( 'Next & Prev on Hover :' ,THEME_ADMIN_LANG ); ?></label>
               <select id="<?php echo $this->get_field_id('nivo_navhover'); ?>" name="<?php echo $this->get_field_name('nivo_navhover'); ?>" >
                  <option value="true" <?php selected($nivo_navhover,'true'); ?> >ON</option>
                  <option value="false" <?php selected($nivo_navhover,'false'); ?> >OFF</option>
               </select>
               </p>
               <p>
               <label for="<?php echo $this->get_field_id('nivo_controls'); ?>"><?php _e( 'Control Navigation :' ,THEME_ADMIN_LANG ); ?></label>
               <select id="<?php echo $this->get_field_id('nivo_controls'); ?>" name="<?php echo $this->get_field_name('nivo_controls'); ?>" >
                  <option value="true" <?php selected($nivo_controls,'true'); ?> >ON</option>
                  <option value="false" <?php selected($nivo_controls,'false'); ?> >OFF</option>
               </select>
               </p>
               <p>
               <label for="<?php echo $this->get_field_id('nivo_pausehover'); ?>"><?php _e( 'Pause on Hover :' ,THEME_ADMIN_LANG ); ?></label>
               <select id="<?php echo $this->get_field_id('nivo_pausehover'); ?>" name="<?php echo $this->get_field_name('nivo_pausehover'); ?>" >
                  <option value="true" <?php selected($nivo_pausehover,'true'); ?> >ON</option>
                  <option value="false" <?php selected($nivo_pausehover,'false'); ?> >OFF</option>
               </select>
               </p>
               <p>
               <label for="<?php echo $this->get_field_id('nivo_captions'); ?>"><?php _e( 'Captions :' ,THEME_ADMIN_LANG ); ?></label>
               <select id="<?php echo $this->get_field_id('nivo_captions'); ?>" name="<?php echo $this->get_field_name('nivo_captions'); ?>" >
                  <option value="true" <?php selected($nivo_captions,'true'); ?> >ON</option>
                  <option value="false" <?php selected($nivo_captions,'false'); ?> >OFF</option>
               </select>
               </p>
               <p>
               <label for="<?php echo $this->get_field_id('nivo_captionsopacity'); ?>"><?php _e( 'Caption Opacity :' ,THEME_ADMIN_LANG ); ?></label>
               <select id="<?php echo $this->get_field_id('nivo_captionsopacity'); ?>" name="<?php echo $this->get_field_name('nivo_captionsopacity'); ?>">
               <?php
                  for ($i=0;$i<=1;$i=$i+0.1){
                     echo '<option value="'.$i.'" '.selected($nivo_captionsopacity,$i,false).'>'.$i.'</option>';
                  }
               ?>
               </select>
               </p>
               <p>
               <label for="<?php echo $this->get_field_id('nivo_color'); ?>"><?php _e( 'Theme :' ,THEME_ADMIN_LANG ); ?></label>
               <select id="<?php echo $this->get_field_id('nivo_color'); ?>" name="<?php echo $this->get_field_name('nivo_color'); ?>" >
                  <option value="grey" <?php selected($nivo_color,'grey'); ?> >Grey</option>
                  <option value="blue" <?php selected($nivo_color,'blue'); ?> >Blue</option>
                  <option value="green" <?php selected($nivo_color,'green'); ?> >Green</option>
                  <option value="orange" <?php selected($nivo_color,'orange'); ?> >Orange</option>
                  <option value="purple" <?php selected($nivo_color,'purple'); ?> >Purple</option>
                  <option value="red" <?php selected($nivo_color,'red'); ?> >Red</option>
                  <option value="yellow" <?php selected($nivo_color,'yellow'); ?> >Yellow</option>
               </select>
               </p>
      </div>
      </div></div>
      </div>
      <div id="<?php echo $tabmulti;?>">
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
      <label for="<?php echo $this->get_field_id('multiple'); ?>"><?php _e('Layout When Page has Multiple Posts',THEME_ADMIN_LANG_DOMAIN) ?>:</label>
      <select name="<?php echo $this->get_field_name('multiple'); ?>" id="<?php echo $this->get_field_id('multiple'); ?>">
       <?php 
      		if(file_exists(THEME_LOOPS_DIR.'/extraloops.php')){
      			include(THEME_LOOPS_DIR.'/extraloops.php');
      			foreach($extraloops as $loops){
      				
      				?>
      				<option value="<?php echo $loops["file"];?>" <?php selected($multiple,$loops["file"]);?>><?php _e($loops["name"],THEME_ADMIN_LANG_DOMAIN) ?></option>
      				<?php 
      			}
      		}
      	?>
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
          <?php  ultimatum_content_inpcheckbox( 'shownopostsmsg', $shownopostsmsg, 'Show Message when no posts', $this); ?>
      <p>
      </p>
      <p>
          <?php  ultimatum_content_inptextarea( 'nopostsmsg', $nopostsmsg, 'Enter your no posts message here', $this, $rows = '5', $cols ='50'); ?>

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
      <?php  ultimatum_content_inpcheckbox( 'mshowtime', $mshowtime, 'Show time', $this); ?>

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
      <option value="after" <?php selected($mreadmore,'after');?>><?php _e('Right after ecxerpt',THEME_ADMIN_LANG_DOMAIN) ?></option>
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
      </div>
      </div>
      <?php
}

}
add_action('widgets_init', create_function('', 'return register_widget("UltimatumContent");'));


function ultimatum_content_inpcheckbox( $fieldid, &$currval, $title, &$that){
// ech( $fieldid, $currval);
?>

      <label for="<?php echo $that->get_field_id($fieldid); ?>"><?php _e($title); ?></label>
      <input id="<?php echo $that->get_field_id($fieldid); ?>" name="<?php echo $that->get_field_name($fieldid); ?>" type="checkbox" value="1"  <?php checked($currval, 1, true); ?> />

<?php
} // end ultimatum_inpcheckbox


function ultimatum_content_inptextarea( $fieldid, &$currval, $title, &$that, $rows = '', $cols =''){

   $format ='';

   if ($rows !== '' ){  $format = ' rows="' .$rows. '" ';  }
   if ($cols !== '' ){  $format .= ' cols="' .$cols. '" ';  }
?>

      <label for="<?php echo $that->get_field_id($fieldid); ?>"><?php _e($title,THEME_ADMIN_LANG_DOMAIN) ?>:</label>

      <textarea name="<?php echo $that->get_field_name($fieldid); ?>" id="<?php echo $that->get_field_id($fieldid); ?>" <?php echo $format; ?> ><?php echo $currval; ?></textarea>

<?php

}
?>