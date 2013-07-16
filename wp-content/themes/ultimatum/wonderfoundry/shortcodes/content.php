<?php
function shortcode_content($atts, $content = null, $code) {
	global $wp_filter;
	$the_content_filter_backup = $wp_filter['the_content'];
	extract(shortcode_atts(array(
		'count' => 3,
		'source' => '',
		'layout' => '',
		'author' => '',
		'nopaging' => 'false',
		'width' => '',
		'height' => '',
		'meta' => 'true',
		'mdate' => 'true',
		'mauthor' => 'true',
		'mcomments' => 'true',
		'mtags' => 'true',
		'mcats'=>'true',
	), $atts));
	$instance = array('meta' => $meta,
		'mdate' => $mdate,
		'mauthor' => $mauthor,
		'mcomments' => $mcomments,
		'mtags' => $mtags,
		'mcats'=>$mcats,);
	
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
	);
	if($paged){
		$query['paged'] = $paged;
	}
	if($cat){
		$query['cat'] = $cat;
	}
	if($author){
		$query['author'] = $author;
	}
	
	if ($nopaging == 'false') {
		global $wp_version;
		if(is_front_page() && version_compare($wp_version, "3.1", '>=')){//fix wordpress 3.1 paged query
			$paged = (get_query_var('paged')) ?get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
		}else{
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		}
		$query['paged'] = $paged;
	} else {
		$query['showposts'] = $count;
	}
	$colprops = explode('-', $layout);
        $colcount = $colprops[0];
        
        $gr = GW;
        switch (str_replace(' ', '', $gr)){
         	case '940':
         		switch ($colcount){
         			case '1':
         				$grid = 'grid_12';
         				$cols = 1;
         				$colw= 940;
         			break;
         			case '2':
         				$grid = 'grid_6';
         				$cols = 2;
         				$colw= 460;
         			break;
         			case '3':
         				$grid = 'grid_4';
         				$cols = 3;
         				$colw= 300;
         			break;
         			case '4':
         				$grid = 'grid_3';
         				$cols = 4;
         				$colw= 220;
         			break;
         		}
         	break;
         	case '700':
         		$maxcols = 3;
         		switch ($colcount){
         			case '1':
         				$grid = 'grid_9';
         				$cols = 1;
         				$colw= 700;
         			break;
         			case '2':
         				$grid = 'grid_3';
         				$cols = 3;
         				$colw= 220;
         			break;
         			case '3':
         				$grid = 'grid_3';
         				$cols = 3;
         				$colw= 220;
         			break;
         			case '4':
         				$grid = 'grid_3';
         				$cols = 3;
         				$colw= 220;
         			break;
         		}
         	break;
         	case '620':
         		$maxcols =2;
         		switch ($colcount){
         			case '1':
         				$grid = 'grid_8';
         				$colw= 620;
         			break;
         			case '2':
         				$grid = 'grid_4';
         				$cols = 2;
         				$colw= 300;
         			break;
         			case '3':
         				$grid = 'grid_4';
         				$cols = 2;
         				$colw= 300;
         			break;
         			case '4':
         				$grid = 'grid_4';
         				$cols = 2;
         				$colw= 300;
         			break;
         		}
         	break;
         	case '460':
         		$maxcols =2;
        		 switch ($colcount){
         			case '1':
         				$grid = 'grid_6';
         				$cols = 1;
         			break;
         			case '2':
         				$grid = 'grid_3';
         				$cols = 2;
         				$colw= 220;
         			break;
         			case '3':
         				$grid = 'grid_3';
         				$cols = 2;
         				$colw= 220;
         			break;
         			case '4':
         				$grid = 'grid_3';
         				$cols = 2;
         				$colw= 220;
         			break;
         		}
         	break;
         	case '300':
         		$maxcols =1;
         		$cols = 1;
        		 switch ($colcount){
         			case '1':
         				$grid = 'grid_4';
         				$colw= 300;
         			break;
         			case '2':
         				$grid = 'grid_4';
         				$colw= 300;
         			break;
         			case '3':
         				$grid = 'grid_4';
         				$colw= 300;
         			break;
         			case '4':
         				$grid = 'grid_4';
         				$colw= 300;
         			break;
         		}
         	break;
         	case '220':
         		$cols = 1;
         		$colw= 220;
         		$maxcols =1;
        		 switch ($colcount){
         			case '1':
         				$grid = 'grid_3';
         			break;
         			case '2':
         				$grid = 'grid_3';
         			break;
         			case '3':
         				$grid = 'grid_3';
         			break;
         			case '4':
         				$grid = 'grid_3';
         			break;
         		}
         	break;
         }  
	$i=1;
	$r = new WP_Query($query);
	if ($r->have_posts()):
		while ($r->have_posts()) : $r->the_post();
		global $post;
			   		if($colcount==1 && ($colprops[2]=='ri' || $colprops[2]=='li' || $colprops[2]=='gl' || $colprops[2]=='gr') ){ $imgw=$width; } else {$imgw=$colw;}
	        		switch($colprops[2]){
	        			case 'ri':
	        				$align = 'float:right;margin-left:10px;';
			        	break;
	    		    	case 'li':
	        				$align = 'float:left;margin-right:10px;';
	        			break;
	        			case 'gl':
	        				$align = 'float:left;margin-right:10px;';
	        				$rel = 'rel="prettyPhoto[]"';
	        				$gallery =true;
	        			break;
	        			case 'gr':
	        				$align = 'float:right;margin-left:10px;';
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
	        		if($colcount!=1)://gridd
				        if($i==1){
				        	$gps = ' alpha';
				        	$i++;
				        } elseif($i==$colcount){
				        	$gps= ' omega';
				        	$i=1;
				        } else{
				        	$i++;
				        	$gps='';
				        }
	       			 else :
				        $grid='';
				        $gps='';
		    		endif;//gridd
			      $output.= '<div class="'.$grid.$gps.' post-'.$post->ID.'">';
			        	$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large') ;
			        	$imgsrc = THEME_HELPERS.'/timthumb.php?src='.get_image_path($img[0]).'&amp;h='.$height.'&amp;w='.$imgw.'&amp;zc=1';
			        	$shadow = THEME_URI.'/images/image_shadow.png';
			        	$imgshrc = THEME_HELPERS.'/timthumb.php?src='.get_image_path($shadow).'&amp;w='.$imgw.'&amp;zc=1';
			        	if(!$noimage){
        				$output.= '<div style="width:'.$imgw.'px;'.$align.'">';
	        				if($gallery){
	        					$video =get_post_meta($post->ID,'videos',true);
		        				if($video){
		        					$link = $video.'&width=900&height=500';
		        				} else {
		        					$link = $img[0];
		        				}
	        				}
       					$output.= '<a href="';
       					if($gallery){
       						$output.= $link; 
       					} else { 
       						$output.=get_permalink($post->ID);
       					} 
       					$output.= '" '.$rel.' class="preload"><img src="'.$imgsrc.'" style="padding:0;margin:0;line-height:0px;height:'.$height.'px" alt="'.get_the_title($post->ID).'" /></a>';
        				$output.= '<img src="'.$imgshrc.'" style="padding:0;margin:0;line-height:0px" alt="shadow"/>';
        				if($meta=='aimage') $output.=  blog_multimeta($instance);
        				$output.= '</div>';
        		   		}
        		   		$output.= '<h2><a href="';
        		   		if($gallery){ $output.=  $link; } else { $output.= get_permalink($post->ID);} 
        		   		$output.= '" '.$rel.'>'.get_the_title($post->ID).'</a></h2>';
	        		    if($meta=='atitle') $output.= blog_multimeta($instance);
	        		  	$output.= get_the_excerpt();
	        		  	if($meta=='atext') $output.=  blog_multimeta($instance);
        		  		$output.= '</div>';
        		  		if($i==1){
        				$output.= '<div style="clear:both"></div>';
        				}
       endwhile; endif;// Loop Finito
       $output.= '<div style="clear:both"></div>';
	if ($nopaging == 'false') {
		ob_start();
		theme_blog_pagenavi('', '', $r, $paged);
		$output .= ob_get_clean();
	}

	wp_reset_postdata();
	$wp_filter['the_content'] = $the_content_filter_backup;
	return $output;
	
}
add_shortcode('content','shortcode_content');

function blog_multimeta($instance)
	{
		
 		global $post;
		$output = '';
		if ($instance[mcats]=='true'){
			$output .= '<span class="categories">'.__('Posted in: ', THEME_LANG_DOMAIN).  get_the_category_list(', ').'</span>';
			$output .= '<span class="seperator">|</span>';
		}
		if ($instance[mtags]=='true'){
			$output .= get_the_tag_list('<span class="tags">'.__('Tags: ', THEME_LANG_DOMAIN),', ','</span> <span class="seperator">|</span>'); 
		}
		if ($instance[mauthor]=='true'){
			$output .= '<span class="author">'.__('By: ', THEME_LANG_DOMAIN).  get_the_author_link().'</span>';
			$output .= '<span class="seperator">|</span>';
		}
		if ($instance[mdate]=='true'){
			$output .= '<span class="date"><a href="'.get_month_link(get_the_time('Y'), get_the_time('m')).'">'.get_the_date().'</a></span>';
			$output .= '<span class="seperator">|</span>';
		}
			$output .= get_edit_post_link( __( 'Edit', THEME_LANG_DOMAIN ), '<span class="seperator">|</span> <span class="edit-link">', '</span>' );
		if($instance[mcomments]=="true" && ($post->comment_count > 0 || comments_open())){
			ob_start();
			comments_popup_link(__('No Comments',THEME_LANG_DOMAIN), __('1 Comment',THEME_LANG_DOMAIN), __('% Comments',THEME_LANG_DOMAIN),'');
			$output .= '<span class="comments">'.ob_get_clean().'</span>';
		}
		return $output.'<br />';
	}
function blog_meta($instance)
	{
		
 		global $post;
		$output = '';
		if ($instance[cats]=='true'){
			$output .= '<span class="categories">'.__('Posted in: ', THEME_LANG_DOMAIN).  get_the_category_list(', ').'</span>';
			$output .= '<span class="seperator">|</span>';
		}
		if ($instance[tags]=='true'){
			$output .= get_the_tag_list('<span class="tags">'.__('Tags: ', THEME_LANG_DOMAIN),', ','</span> <span class="seperator">|</span>'); 
		}
		if ($instance[author]=='true'){
			$output .= '<span class="author">'.__('By: ', THEME_LANG_DOMAIN).  get_the_author_link().'</span>';
			$output .= '<span class="seperator">|</span>';
		}
		if ($instance[date]=='true'){
			$output .= '<span class="date"><a href="'.get_month_link(get_the_time('Y'), get_the_time('m')).'">'.get_the_date().'</a></span>';
			$output .= '<span class="seperator">|</span>';
		}
			$output .= get_edit_post_link( __( 'Edit', THEME_LANG_DOMAIN ), '<span class="seperator">|</span> <span class="edit-link">', '</span>' );
		if($instance[comments]=="true" && ($post->comment_count > 0 || comments_open())){
			ob_start();
			comments_popup_link(__('No Comments',THEME_LANG_DOMAIN), __('1 Comment',THEME_LANG_DOMAIN), __('% Comments',THEME_LANG_DOMAIN),'');
			$output .= '<span class="comments">'.ob_get_clean().'</span>';
		}
		return $output;
	}

function theme_blog_pagenavi($before = '', $after = '', $blog_query, $paged) {
	global $wpdb, $wp_query;
	
	if (is_single())
		return;
	
	$pagenavi_options = array(
		//'pages_text' => __('Page %CURRENT_PAGE% of %TOTAL_PAGES%',THEME_LANG_DOMAIN),
		'pages_text' => '',
		'current_text' => '%PAGE_NUMBER%',
		'page_text' => '%PAGE_NUMBER%',
		'first_text' => __('&laquo; First',THEME_LANG_DOMAIN),
		'last_text' => __('Last &raquo;',THEME_LANG_DOMAIN),
		'next_text' => __('&raquo;',THEME_LANG_DOMAIN),
		'prev_text' => __('&laquo;',THEME_LANG_DOMAIN),
		'dotright_text' => __('...',THEME_LANG_DOMAIN),
		'dotleft_text' => __('...',THEME_LANG_DOMAIN),
		'style' => 1,
		'num_pages' => 4,
		'always_show' => 0,
		'num_larger_page_numbers' => 3,
		'larger_page_numbers_multiple' => 10,
		'use_pagenavi_css' => 0,
	);
	
	$request = $blog_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	global $wp_version;
	if(is_front_page() && version_compare($wp_version, "3.1", '>=')){//fix wordpress 3.1 paged query
		$paged = (get_query_var('paged')) ?intval(get_query_var('paged')) : intval(get_query_var('page'));
	}else{
		$paged = intval(get_query_var('paged'));
	}
	
	$numposts = $blog_query->found_posts;
	$max_page = intval($blog_query->max_num_pages);
	
	if (empty($paged) || $paged == 0)
		$paged = 1;
	$pages_to_show = intval($pagenavi_options['num_pages']);
	$larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
	$larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
	$pages_to_show_minus_1 = $pages_to_show - 1;
	$half_page_start = floor($pages_to_show_minus_1 / 2);
	$half_page_end = ceil($pages_to_show_minus_1 / 2);
	$start_page = $paged - $half_page_start;
	
	if ($start_page <= 0)
		$start_page = 1;
	
	$end_page = $paged + $half_page_end;
	if (($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	
	if ($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	
	if ($start_page <= 0)
		$start_page = 1;
	
	$larger_pages_array = array();
	if ($larger_page_multiple)
		for($i = $larger_page_multiple; $i <= $max_page; $i += $larger_page_multiple)
			$larger_pages_array[] = $i;
	
	if ($max_page > 1 || intval($pagenavi_options['always_show'])) {
		$pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
		$pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
		echo $before . '<div class="wp-pagenavi">' . "\n";
		switch(intval($pagenavi_options['style'])){
			// Normal
			case 1:
				if (! empty($pages_text)) {
					echo '<span class="pages">' . $pages_text . '</span>';
				}
				if ($start_page >= 2 && $pages_to_show < $max_page) {
					$first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
					echo '<a href="' . clean_url(get_pagenum_link()) . '" class="first" title="' . $first_page_text . '">' . $first_page_text . '</a>';
					if (! empty($pagenavi_options['dotleft_text'])) {
						echo '<span class="extend">' . $pagenavi_options['dotleft_text'] . '</span>';
					}
				}
				$larger_page_start = 0;
				foreach($larger_pages_array as $larger_page) {
					if ($larger_page < $start_page && $larger_page_start < $larger_page_to_show) {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($larger_page), $pagenavi_options['page_text']);
						echo '<a href="' . clean_url(get_pagenum_link($larger_page)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
						$larger_page_start++;
					}
				}
				previous_posts_link($pagenavi_options['prev_text']);
				for($i = $start_page; $i <= $end_page; $i++) {
					if ($i == $paged) {
						$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
						echo '<span class="current">' . $current_page_text . '</span>';
					} else {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
						echo '<a href="' . clean_url(get_pagenum_link($i)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
					}
				}
				next_posts_link($pagenavi_options['next_text'], $max_page);
				$larger_page_end = 0;
				foreach($larger_pages_array as $larger_page) {
					if ($larger_page > $end_page && $larger_page_end < $larger_page_to_show) {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($larger_page), $pagenavi_options['page_text']);
						echo '<a href="' . clean_url(get_pagenum_link($larger_page)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
						$larger_page_end++;
					}
				}
				if ($end_page < $max_page) {
					if (! empty($pagenavi_options['dotright_text'])) {
						echo '<span class="extend">' . $pagenavi_options['dotright_text'] . '</span>';
					}
					$last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
					echo '<a href="' . clean_url(get_pagenum_link($max_page)) . '" class="last" title="' . $last_page_text . '">' . $last_page_text . '</a>';
				}
				break;
			// Dropdown
			case 2:
				echo '<form action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="get">' . "\n";
				echo '<select size="1" onchange="document.location.href = this.options[this.selectedIndex].value;">' . "\n";
				for($i = 1; $i <= $max_page; $i++) {
					$page_num = $i;
					if ($page_num == 1) {
						$page_num = 0;
					}
					if ($i == $paged) {
						$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
						echo '<option value="' . clean_url(get_pagenum_link($page_num)) . '" selected="selected" class="current">' . $current_page_text . "</option>\n";
					} else {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
						echo '<option value="' . clean_url(get_pagenum_link($page_num)) . '">' . $page_text . "</option>\n";
					}
				}
				echo "</select>\n";
				echo "</form>\n";
				break;
		}
		echo '</div>' . $after . "\n";
	}
}
