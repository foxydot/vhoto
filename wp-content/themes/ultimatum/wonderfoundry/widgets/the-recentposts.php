<?php
class UltimatumRecent extends WP_Widget {

	function UltimatumRecent() {
        parent::WP_Widget(false, $name = 'Ultimatum Recent Posts');
    }

	function widget($args, $instance) {
		extract( $args );
		//$grid_width;
		$source = $instance['source'];
		$count = $instance['count'];
		if($instance['slide']!="false"){
				wp_enqueue_script('jquery-easing',THEME_JS.'/jquery.easing.min.js');
				wp_enqueue_script('jquery-bxslider',THEME_JS.'/jquery.bxSlider.min.js');
		}
		
		if($instance['layout']==5 || $instance['layout']==6 || $instance['layout']==7 || $instance['layout']==8){
			if($instance['slide']!="false"){
				$itemwidth = ($grid_width-(($instance['sitems']-1)*$instance['margin']))/$instance['sitems'];
			} else {
				$itemwidth = ($grid_width-(($count-1)*$instance['margin']))/$count;
			}
				
		} else {
			$itemwidth = $grid_width;
		}
		
		
		global $wp_filter;
		$the_content_filter_backup = $wp_filter['the_content'];
		if(eregi('ptype-',$source)){
			$post_type= str_replace('ptype-', '', $source);
		} elseif(eregi('cat-',$source)){
			$post_type ='post';
			$cat = str_replace('cat-', '',$source);
		}elseif(eregi('taxonomy-',$source)){
	      	$prop = explode('|',str_replace('taxonomy-', '', $source));
	      	$post_type =$prop[0];
	      	global $wp_version;
			if(version_compare($wp_version, "3.1", '>=')){
				$query['tax_query'] = array(
					array(
								'taxonomy' => $prop[1],
								'field' => 'slug',
								'terms' => explode(',', $prop[2])
							)
						);
					}else{
						$query['taxonomy'] = $prop[1];
						$query['term'] = $prop[2];
					}
		}
		
		$query = array(
			'posts_per_page' => (int)$count,
			'post_type'=>$post_type,
			'orderby'=>'date', 
			'order'=>'DESC',
		);
		if($cat){
			$query['cat'] = $cat;
		}
		$query['showposts'] = $count;
		$r = new WP_Query($query);
		$j = 1;
		echo $before_widget;
		if($instance['slide']!='false') { ?>
		<div class="<?php echo $instance[AnyColor]; ?>" style="float:left">
		<?php } 
			if ( $instance['title']) {
				if($instance['slide']!='false') {
				?>
				<h3 class="bxtitle element-title"><?php echo $instance[title]?></h3>
				
				<?php 	
				} else {
				echo $before_title . $instance['title'] . $after_title;
				
				}
			}
		?>
		
		<div id="<?php echo $this->id.'-recent'; ?>">
		<?php 
		if ($r->have_posts()):
			while ($r->have_posts()) : $r->the_post();
			global $post;
			$link = get_permalink();
				?>
				<?php if($instance[slide]!="false") { ?>
				<?php if($instance[layout]==1 || $instance[layout]==2 || $instance[layout]==3 || $instance[layout]==4 ) {?>
				<div class="recenposts" style="width:<?php echo $grid_width;?>px;height:<?php echo $instance['sitemh']; ?>px;float:left;margin-bottom:<?php echo $instance[margin]; ?>px"">
				<div class="recentinner" style="<?php echo 'margin: 0 auto;'; ?>">
				<?php } else { ?>
				<div class="recenposts" style="width:<?php echo $grid_width/$instance['sitems']; ?>px;float:left;">
				<div class="recentinner" style="width: <?php echo $itemwidth; ?>px;<?php echo 'margin: 0 auto;'; ?>">
				<?php } ?>
				<?php }else { ?>
				<div class="recenposts" style="width:<?php echo $itemwidth; ?>px;float:left;<?php if($j==$count){}else{if($instance[layout]==1 || $instance[layout]==2 || $instance[layout]==3 || $instance[layout]==4){ echo "margin-bottom:".$instance[margin]."px"; } else { echo "margin-right:".$instance[margin]."px"; } }?>">
				<div class="recentinner" style="width: <?php echo $itemwidth; ?>px;">
				<?php } ?>
				<?php 
				if($instance['layout']==1 || $instance['layout']==5 ){
					$imgwidth = $itemwidth;
					$images = true;
					$imagealign = 'noalign';
				} elseif ($instance['layout']=='2' || $instance['layout']=='6' || $instance['layout']=='3' || $instance['layout']=='7') {
					$imgwidth = $instance[width];
					$images = true;	
					if($instance['layout']=='2' || $instance['layout']=='6'){
						$imagealign = 'alignleft';
						
					} else {
						$imagealign = 'alignright';
						
					}				
				}
				if($images){
				$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large') ;
				if ($img){
					$imgsrc = UltimatumImageResizer( get_post_thumbnail_id(), null,$imgwidth, $instance["height"], true );
				} else {
					$nimg = THEME_URI.'/images/no-image.jpg';
					$imgsrc = UltimatumImageResizer( null, $nimg,$imgwidth, $instance["height"], true );
				}
				if($instance[gallery]=='false'){
			    echo '<a href="'.$link.'"><img src="'.$imgsrc.'" alt="'.get_the_title($post->ID).'" '; 
			    if($imagealign) {
			    	echo 'class="'.$imagealign.'"';
			    }
			    echo ' alt="'.get_the_title().'" /></a>';
				} else {
					$video =get_post_meta($post->ID,'ultimatum_video',true);
					if($video){
						echo '<a href="'.$video.'" class="image_play prettyPhoto" style="position:relative;float:left;width:'.$imgwidth.'px;height:'.$instance[height].'px"><img src="'.$imgsrc.'" alt="'.get_the_title($post->ID).'" '; 
			    	if($imagealign) {
			    		echo 'class="'.$imagealign.'"';
			    	}
			    	echo ' alt="'.get_the_title().'" /></a>';
					} else {
						echo '<a href="'.$img[0].'" class="image_zoom prettyPhoto" style="position:relative;float:left;width:'.$imgwidth.'px;height:'.$instance[height].'px"><img src="'.$imgsrc.'" alt="'.get_the_title($post->ID).'" '; 
			    	if($imagealign) {
			    		echo 'class="'.$imagealign.'"';
			    	}
			    	echo ' alt="'.get_the_title().'" /></a>';
					}
					
				}
				}
				?>
					<?php if($instance['showtitle']=='true') { ?>
						<?php if($instance['tlength']!=0) { 
							$post_title = get_the_title();
						if (strlen($post_title)>$instance['tlength']) $post_title=substr($post_title,0,$instance['tlength']).'...'; ?>
						<h4 class="recentposth3"><a href="<?php echo $link; ?>" class="recentlink"><?php echo $post_title;?></a></h4>
						<?php } else { ?>
						<h4 class="recentposth3"><a href="<?php echo $link; ?>" class="recentlink"><?php the_title();?></a></h4>
						<?php } ?>
					<?php } ?>
					<?php if($instance['showex']=='true') { ?>
						<p><?php echo wp_html_excerpt(get_the_excerpt(),$instance[exlength]);?>...</p>
					<?php } ?>
					<?php if($instance['showrm']=='true') { ?>
						<a href="<?php echo $link; ?>" class="recentreadmorelink"><span><?php _e($instance[rmtext],THEME_LANG_DOMAIN) ?></span></a>
					<?php } ?>
				</div>
				</div>
				<?php
				$j++;
			endwhile;
		endif;
		?>
		</div>
		<?php if($instance['slide']!='false') { ?>
		</div>
		<script type="text/javascript">
							//<![CDATA[
							jQuery(document).ready(function(){
							jQuery('#<?php echo $this->id.'-recent'; ?>').bxSlider({
							    <?php if($instance['slide']=='ticker') { echo "\n"; ?>auto: true, <?php } ?>
							    <?php if($instance['layout']=='1' || $instance['layout']=='2' || $instance['layout']=='3'|| $instance['layout']=='4') { echo "\n";?>mode: 'vertical',<?php } ?>
							    autoHover: true,
							    easing : 'easeInOutBack',
							    speed:2000,
							    displaySlideQty: <?php echo $instance['sitems']; ?>,
							    moveSlideQty: 1
							  });
							});
							//]]>
							</script>
		<?php } ?>
		<?php 
		echo $after_widget;
		wp_reset_postdata();
		$wp_filter['the_content'] = $the_content_filter_backup;
		
		
    }

	function update($new_instance, $old_instance) {
		$instance['title']			= $new_instance['title'];
		$instance['layout']			= $new_instance['layout'];
		$instance['source']			= $new_instance['source'];
		$instance['count']			= $new_instance['count'];
		$instance['width']			= $new_instance['width'];
		$instance['height']			= $new_instance['height'];
		$instance['showtitle']		= $new_instance['showtitle'];
		$instance['tlength']		= $new_instance['tlength'];
		$instance['showex']			= $new_instance['showex'];
		$instance['exlength']		= $new_instance['exlength'];
		$instance['showrm']			= $new_instance['showrm'];
		$instance['rmtext']			= $new_instance['rmtext'];
		$instance['slide']			= $new_instance['slide'];
		$instance['sitems']			= $new_instance['sitems'];
		$instance['sitemh']			= $new_instance['sitemh'];
		$instance['gallery']		= $new_instance['gallery'];		
		$instance['margin']			= $new_instance['margin'];
		$instance['AnyColor']			= $new_instance['AnyColor'];
				
	    return $instance;
    }
    
	function form($instance) {
        $title 		= esc_attr($instance['title']);
       	$source 	= isset( $instance['source'] ) ? $instance['source'] : 'post';
       	$layout	 	= isset( $instance['layout'] ) ? $instance['layout'] : '2';
        $count	 	= isset( $instance['count'] ) ? $instance['count'] : '5';
        $width 		= isset( $instance['width'] ) ? $instance['width'] : '100';
        $height 	= isset( $instance['height'] ) ? $instance['height'] : '100';
        $showtitle	= isset( $instance['showtitle'] ) ? $instance['showtitle'] : 'true';
        $tlength	= isset( $instance['tlength'] ) ? $instance['tlength'] : '0';
        $showex		= isset( $instance['showex'] ) ? $instance['showex'] : 'true';
        $exlength	= isset( $instance['exlength'] ) ? $instance['exlength'] : '100';
        $showrm 	= isset( $instance['showrm'] ) ? $instance['showrm'] : 'true';
        $rmtext		= isset( $instance['rmtext'] ) ? $instance['rmtext'] : 'Read More';
        $slide		= isset( $instance['slide'] ) ? $instance['slide'] : 'false';
        $gallery	= isset( $instance['gallery'] ) ? $instance['gallery'] : 'false';
        $sitems		= isset( $instance['sitems'] ) ? $instance['sitems'] : '3';
        $sitemh		= isset( $instance['sitemh'] ) ? $instance['sitemh'] : '200';
        
        $margin		= isset( $instance['margin'] ) ? $instance['margin'] : '20';
        $AnyColor		= isset( $instance['AnyColor'] ) ? $instance['AnyColor'] : 'gray';//
        
        global $wpdb;
		$termstable = $wpdb->prefix.'ultimatum_tax';
        ?>
        <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', THEME_ADMIN_LANG_DOMAIN); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
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
		$termresult = mysql_query($termsql);
		while ($term = mysql_fetch_array($termresult) ){
			$properties = unserialize($term[properties]);
			echo '<optgroup label="'.$properties[label].'('.$term[pname].')">';
			$entries = get_terms($term[tname],'orderby=name&hide_empty=0');
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
		<label for="<?php echo $this->get_field_id('layout'); ?>"><?php _e('Layout:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<select name="<?php echo $this->get_field_name('layout'); ?>" id="<?php echo $this->get_field_id('layout'); ?>">
			<option value="1" <?php selected($layout,'1');?>><?php _e('Vertical with Full Image',THEME_ADMIN_LANG_DOMAIN); ?></option>
			<option value="2" <?php selected($layout,'2');?>><?php _e('Vertical with Image on Left',THEME_ADMIN_LANG_DOMAIN); ?></option>
			<option value="3" <?php selected($layout,'3');?>><?php _e('Vertical with Image on Right',THEME_ADMIN_LANG_DOMAIN); ?></option>
			<option value="4" <?php selected($layout,'4');?>><?php _e('Vertical with no Image',THEME_ADMIN_LANG_DOMAIN); ?></option>
			<option value="5" <?php selected($layout,'5');?>><?php _e('Horizontal with Full Image',THEME_ADMIN_LANG_DOMAIN); ?></option>
			<option value="6" <?php selected($layout,'6');?>><?php _e('Horizontal with Image on Left',THEME_ADMIN_LANG_DOMAIN); ?></option>
			<option value="7" <?php selected($layout,'7');?>><?php _e('Horizontal with Image on Right',THEME_ADMIN_LANG_DOMAIN); ?></option>
			<option value="8" <?php selected($layout,'8');?>><?php _e('Horizontal with no Image',THEME_ADMIN_LANG_DOMAIN); ?></option>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('gallery'); ?>"><?php _e('Act As Gallery?:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<select name="<?php echo $this->get_field_name('gallery'); ?>" id="<?php echo $this->get_field_id('gallery'); ?>">
		<option value="true" <?php selected($gallery,'true');?>>ON</option>
		<option value="false" <?php selected($gallery,'false');?>>OFF</option>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Item Count:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<input name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo $count;?>"/>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('margin'); ?>"><?php _e('Margin Between Items:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<input name="<?php echo $this->get_field_name('margin'); ?>" id="<?php echo $this->get_field_id('margin'); ?>"  value="<?php echo $margin;?>"/>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Image Width:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<input name="<?php echo $this->get_field_name('width'); ?>" id="<?php echo $this->get_field_id('width'); ?>"  value="<?php echo $width;?>"/><i>Used only on Image Left/Right Layouts</i>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Image Height:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<input name="<?php echo $this->get_field_name('height'); ?>" id="<?php echo $this->get_field_id('height'); ?>" value="<?php echo $height;?>"/>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('showtitle'); ?>"><?php _e('Show Title:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<select name="<?php echo $this->get_field_name('showtitle'); ?>" id="<?php echo $this->get_field_id('showtitle'); ?>">
		<option value="true" <?php selected($showtitle,'true');?>>ON</option>
		<option value="false" <?php selected($showtitle,'false');?>>OFF</option>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('tlength'); ?>"><?php _e('Title Length(Chars):',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<input name="<?php echo $this->get_field_name('tlength'); ?>" id="<?php echo $this->get_field_id('tlength'); ?>" value="<?php echo $tlength;?>"/><i>0 for no limit</i>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('showex'); ?>"><?php _e('Show Excerpt:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<select name="<?php echo $this->get_field_name('showex'); ?>" id="<?php echo $this->get_field_id('showex'); ?>">
		<option value="true" <?php selected($showex,'true');?>>ON</option>
		<option value="false" <?php selected($showex,'false');?>>OFF</option>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('exlength'); ?>"><?php _e('Excerpt Length(Chars):',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<input name="<?php echo $this->get_field_name('exlength'); ?>" id="<?php echo $this->get_field_id('exlength'); ?>" value="<?php echo $exlength;?>"/>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('showrm'); ?>"><?php _e('Show Read More:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<select name="<?php echo $this->get_field_name('showrm'); ?>" id="<?php echo $this->get_field_id('showrm'); ?>">
		<option value="true" <?php selected($showrm,'true');?>>ON</option>
		<option value="false" <?php selected($showrm,'false');?>>OFF</option>
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
		<p>
		<label for="<?php echo $this->get_field_id('slide'); ?>"><?php _e('Sliding Effect:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<select name="<?php echo $this->get_field_name('slide'); ?>" id="<?php echo $this->get_field_id('slide'); ?>">
		<option value="false" <?php selected($slide,'false');?>>OFF</option>
		<option value="slide" <?php selected($slide,'slide');?>><?php _e('Slide',THEME_ADMIN_LANG_DOMAIN) ?></option>
		<option value="ticker" <?php selected($slide,'ticker');?>><?php _e('Ticker',THEME_ADMIN_LANG_DOMAIN) ?></option>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('sitems'); ?>"><?php _e('Visible Items:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<input name="<?php echo $this->get_field_name('sitems'); ?>" id="<?php echo $this->get_field_id('sitems'); ?>" value="<?php echo $sitems;?>"/><i>How many of items to be shown in sliding box. Must be lower than Item count</i>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('sitemh'); ?>"><?php _e('Slide Item height:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<input name="<?php echo $this->get_field_name('sitemh'); ?>" id="<?php echo $this->get_field_id('sitemh'); ?>" value="<?php echo $sitemh;?>"/><i>used for vertical slides</i>
		</p>
		<p>
					<label for="<?php echo $this->get_field_id('AnyColor'); ?>"><?php _e( 'Slide Theme :' ,THEME_ADMIN_LANG ); ?></label>
					<select id="<?php echo $this->get_field_id('AnyColor'); ?>" name="<?php echo $this->get_field_name('AnyColor'); ?>" >
						<option value="gray" <?php selected($AnyColor,'gray'); ?> >Gray</option>
						<option value="blue" <?php selected($AnyColor,'blue'); ?> >Blue</option>
						<option value="green" <?php selected($AnyColor,'green'); ?> >Green</option>
						<option value="orange" <?php selected($AnyColor,'orange'); ?> >Orange</option>
						<option value="purple" <?php selected($AnyColor,'purple'); ?> >Purple</option>
						<option value="red" <?php selected($AnyColor,'red'); ?> >Red</option>
						<option value="yellow" <?php selected($AnyColor,'yellow'); ?> >Yellow</option>
					</select>
					</p>
		<?php 
    }

}
add_action('widgets_init', create_function('', 'return register_widget("UltimatumRecent");'));
?>