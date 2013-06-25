<?php
class UltimatumMenu extends WP_Widget {

	function UltimatumMenu() {
        parent::WP_Widget(false, $name = 'Ultimatum Menu');
       // add_action( 'wp_footer', array(&$this, 'footer'), 10, 1 );	
    }

    function widget($args, $instance) {
       	extract( $args );
       	?>
       	<div class="ultimatum-nav">
       	<div class="regular-nav">
       	<?php
    	$nav_menu = wp_get_nav_menu_object( $instance['nav_menu'] );
    	if($instance["menustyle"]=='hormega'){
      	wp_enqueue_script('jquery-hi',THEME_JS.'/jquery.hoverIntent.minified.js');
      	wp_enqueue_script('jquery-mmh',THEME_JS.'/jquery.dcmegamenu.1.3.3.js');
    		$effect = $instance['effect'];
						if($effect == ''){$effect = 'fade';}
						if(isset($instance['event'])) $event = $instance['event'];
						if(!isset($event)){$event = 'hover';}
						if(isset($instance['fullWidth']))$fullWidth = $instance['fullWidth'];
						if(!isset($fullWidth)){$fullWidth = ',fullWidth: true';}
						?>
						<script type="text/javascript">
						//<![CDATA[

						jQuery(document).ready(function() {
						  for (i=0;i<1;i++) {
						    setTimeout('addDot()',1000);
						  }
						});
						function addDot() {
						  
						
													
							jQuery(document).ready(function($) {
								jQuery('#<?php echo $this->id.'-item'; ?> .menu').wfMegaMenu({
									rowItems: <?php echo $instance['rowItems']; ?>,
									speed: <?php echo $instance['speed'] == '0' ? 0 : "'".$instance['speed']."'"; ?>,
									effect: '<?php echo $effect; ?>',
									subMenuWidth:200
								
								});
							});}
							//]]>
						</script>
		
		<?php if ($instance["subMenuWidth"]){?>
		<div class="wfm-mega-menu" id="<?php echo $this->id.'-item'; ?>" style="width:<?php echo $instance["subMenuWidth"];?>px;float:right">
		<?php } else { ?>
        <div class="wfm-mega-menu" id="<?php echo $this->id.'-item'; ?>" style="width:<?php echo $grid_width;?>px;">
        <?php } ?>
        <?php
			wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu, 'container' => false ) );
		?>
		</div>
		<?php 
    	} elseif($instance["menustyle"]=='vermega'){
      	wp_enqueue_script('jquery-hi',THEME_JS.'/jquery.hoverIntent.minified.js');
      	wp_enqueue_script('jquery-mmv',THEME_JS.'/jquery.dcverticalmegamenu.1.3.js');
    	$effect = $instance['effect'];
		if($effect == ''){$effect = 'fade';}
		$direction = $instance['direction'];
		if($direction == ''){$direction = 'right';}
		?>
						<script type="text/javascript">
						//<![CDATA[
							jQuery(document).ready(function($) {
								jQuery('#<?php echo $this->id.'-item'; ?> .menu').dcVerticalMegaMenu({
									rowItems: <?php echo $instance['rowItems']; ?>,
									speed: '<?php echo $instance['speed']; ?>',
									direction: '<?php echo $direction; ?>',
									effect: '<?php echo $effect; ?>'
								});
							});
							//]]>
						</script>
        <div class="wfm-vertical-mega-menu" id="<?php echo $this->id.'-item'; ?>">
        <?php wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu, 'container' => false ) ); ?>
		</div>
		<?php 
    	} elseif ($instance["menustyle"]=='hnd') {
    		?>
    		<div class="horizontal-menu" style="float:<?php echo $instance["float"]; ?>">
    		<?php wp_nav_menu( array( 'depth'=>1,'fallback_cb' => '', 'menu' => $nav_menu, 'container' => false ) ); ?>
    		</div>
    		<?php 	
    	} elseif ($instance["menustyle"]=='vnd') {
    		?>
    		<div class="vertical-menu">
    		<?php
    		$only_related = ( $instance['only_related'] == 2 || $instance['only_related'] == 3 )? new Related_Sub_Items_Walker : new Walker_Nav_Menu;
			$strict_sub = $instance['only_related'] == 3 ? 1 : 0;
			$depth = $instance['depth'] ? $instance['depth'] : 0;
			wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu, 'walker' => $only_related, 'depth' => $depth, 'strict_sub' => $strict_sub, 'container' => $container,'container_id' => $container_id,'menu_class' => $menu_class, 'before' => $before, 'after' => $after, 'link_before' => $link_before, 'link_after' => $link_after, ) ); 
    		 ?>
    		</div>
    		<?php
    	} else {
       	wp_enqueue_script('jquery-smooth',THEME_JS.'/ddsmoothmenu.js');
      			?>
				<script type="text/javascript">
				//<![CDATA[
							jQuery(document).ready(function($) {
								ddsmoothmenu.init({
									mainmenuid: "<?php echo $this->id.'-item'; ?>", 
									orientation: '<?php echo $instance['menustyle']; ?>',
									classname: 'ddsmoothmenu<?php echo $instance['menustyle']; ?>',
									contentsource: "markup" 
								})
							});
							//]]>
						</script>
				<style>
				.ddsmoothmenuh ul {
    float: <?php echo $instance["float"]; ?>;
   
}	
				</style>
        <div class="ddsmoothmenu<?php echo $instance['menustyle']; ?>" id="<?php echo $this->id.'-item'; ?>">
        <?php
			wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu, 'container' => false ) );
		?>
		</div>
		
		<?php 
    	}
    	
    	//if($instance['responsive']=='dropdown'){
 		?>
 		</div>
 		<div class="ultimatum-responsive-menu">
 		<form id="responsive-nav-<?php echo $this->id; ?>" action="" method="post" class="responsive-nav-form">
				<div><select class="responsive-nav-menu">
				<option value=""><?php _e('Navigation',THEME_LANG_DOMAIN);?></option>
				<?php 
				
				$menu = wp_nav_menu(array('fallback_cb' => '', 'menu' => $nav_menu, 'echo' => false));
				   if (preg_match_all('#(<a [^<]+</a>)#',$menu,$matches)) {
				      $hrefpat = '/(href *= *([\"\']?)([^\"\' ]+)\2)/';
				      foreach ($matches[0] as $link) {
				         // Do something with the link
				         if (preg_match($hrefpat,$link,$hrefs)) {
				            $href = $hrefs[3];
				         }
				         if (preg_match('#>([^<]+)<#',$link,$names)) {
				            $name = $names[1];
				         }
				         echo "<option value=\"$href\">$name</option>";
				      }
				   }				
				
				?>
				</select></div>
				</form>
 		<?php //} ?>
 		</div>
 		</div>
 		<div class="clearboth"></div><?php 
    }

 function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['menustyle'] = strip_tags( stripslashes($new_instance['menustyle']) );
		$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		$instance['rowItems'] = $new_instance['rowItems'];
		$instance['subMenuWidth'] = $new_instance['subMenuWidth'];
		$instance['direction'] =$new_instance['direction'];
		$instance['skin'] = $new_instance['skin'];
		$instance['speed'] = $new_instance['speed'];
		$instance['effect'] = $new_instance['effect'];
		$instance['depth'] = (int) $new_instance['depth'];
		$instance['only_related'] = (int) $new_instance['only_related'];
		$instance['float'] = $new_instance['float'];
		
		return $instance;
	}
function form($instance) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$menustyle = isset( $instance['menustyle'] ) ? $instance['menustyle'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
		$rowItems = isset( $instance['rowItems'] ) ? $instance['rowItems'] : '';
		$subMenuWidth = isset( $instance['subMenuWidth'] ) ? $instance['subMenuWidth'] : '';
		$skin = isset( $instance['skin'] ) ? $instance['skin'] : '';
		$speed = isset( $instance['speed'] ) ? $instance['speed'] : 'normal';
		$direction = isset( $instance['direction'] ) ? $instance['direction'] : '';
		$effect = isset( $instance['effect'] ) ? $instance['effect'] : 'slide';
		$only_related = isset( $instance['only_related'] ) ? (int) $instance['only_related'] : 1;
		$depth = isset( $instance['depth'] ) ? (int) $instance['depth'] : 0;
		$float = isset( $instance['float'] ) ?  $instance['float'] : 'left';
		
		$widget_options = wp_parse_args( $instance, $this->defaults );
		extract( $widget_options, EXTR_SKIP );

		// Get menus
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.',THEME_ADMIN_LANG_DOMAIN), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
	<p>
		<label for="<?php echo $this->get_field_id('menustyle'); ?>"><?php _e('Menu Style:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<select name="<?php echo $this->get_field_name('menustyle'); ?>" id="<?php echo $this->get_field_id('menustyle'); ?>">
			<option value="hormega" <?php if($menustyle=='hormega') echo ' selected="selected"';?>><?php _e('Horizontal Mega Menu',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="h" <?php if($menustyle=='h') echo ' selected="selected"';?>><?php _e('Horizontal DropDown Menu',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="hnd" <?php if($menustyle=='hnd') echo ' selected="selected"';?>><?php _e('Horizontal Menu',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="vermega" <?php if($menustyle=='vermega') echo ' selected="selected"';?>><?php _e('Vertical Mega Menu',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="v" <?php if($menustyle=='v') echo ' selected="selected"';?>><?php _e('Vertical DropDown Menu',THEME_ADMIN_LANG_DOMAIN) ?></option>
			<option value="vnd" <?php if($menustyle=='vnd') echo ' selected="selected"';?>><?php _e('Vertical Menu',THEME_ADMIN_LANG_DOMAIN) ?></option>
		</select>
		
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:',THEME_ADMIN_LANG_DOMAIN); ?></label>
		<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
		<?php
			foreach ( $menus as $menu ) {
				$selected = $nav_menu == $menu->term_id ? ' selected="selected"' : '';
				echo '<option'. $selected .' value="'. $menu->term_id .'">'. $menu->name .'</option>';
			}
		?>
		</select>
	</p>
	<i><?php _e('Only For Mega Menus',THEME_ADMIN_LANG_DOMAIN);?></i>
	<p>
	  <label for="<?php echo $this->get_field_id('rowItems'); ?>"><?php _e( 'Number Items Per Row' ,THEME_ADMIN_LANG_DOMAIN ); ?></label>
		<select name="<?php echo $this->get_field_name('rowItems'); ?>" id="<?php echo $this->get_field_id('rowItems'); ?>" >
			<option value='1' <?php selected( $rowItems, '1'); ?> >1</option>
			<option value='2' <?php selected( $rowItems, '2'); ?> >2</option>
			<option value='3' <?php selected( $rowItems, '3'); ?> >3</option>
			<option value='4' <?php selected( $rowItems, '4'); ?> >4</option>
			<option value='5' <?php selected( $rowItems, '5'); ?> >5</option>
			<option value='6' <?php selected( $rowItems, '6'); ?> >6</option>
			<option value='7' <?php selected( $rowItems, '7'); ?> >7</option>
			<option value='8' <?php selected( $rowItems, '8'); ?> >8</option>
			<option value='9' <?php selected( $rowItems, '9'); ?> >9</option>
			<option value='10' <?php selected( $rowItems, '10'); ?> >10</option>
		</select>
		</p>
	<i><?php _e('To align Horizontal Mega menu to right you need to set a width otherwise leave empty',THEME_ADMIN_LANG_DOMAIN);?></i>
	<p>
	<label for="<?php echo $this->get_field_id('subMenuWidth'); ?>"><?php _e( 'Hor. Mega Width' ,THEME_ADMIN_LANG_DOMAIN ); ?></label>
	<input type="text" value="<?php echo $subMenuWidth; ?>" size="3" id="<?php echo $this->get_field_id('subMenuWidth'); ?>" name="<?php echo $this->get_field_name('subMenuWidth'); ?>" />
	</p>
	<p><label for="<?php echo $this->get_field_id('effect'); ?>"><?php _e('Animation Effect',THEME_ADMIN_LANG_DOMAIN); ?>:</label>
		<select name="<?php echo $this->get_field_name('effect'); ?>" id="<?php echo $this->get_field_id('effect'); ?>" >
			<option value='fade' <?php selected( $effect, 'fade'); ?> ><?php _e('Fade In',THEME_ADMIN_LANG_DOMAIN); ?></option>
			<option value='slide' <?php selected( $effect, 'slide'); ?> ><?php _e('Slide Down',THEME_ADMIN_LANG_DOMAIN); ?></option>
		</select>
		
	</p>
	<p><label for="<?php echo $this->get_field_id('direction'); ?>"><?php _e('Animation Direction',THEME_ADMIN_LANG_DOMAIN); ?>:</label>
		<select name="<?php echo $this->get_field_name('direction'); ?>" id="<?php echo $this->get_field_id('direction'); ?>" >
			<option value='right' <?php selected( $direction, 'right'); ?> ><?php _e('Right',THEME_ADMIN_LANG_DOMAIN); ?></option>
			<option value='left' <?php selected( $direction, 'left'); ?> ><?php _e('Left',THEME_ADMIN_LANG_DOMAIN); ?></option>
		</select>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('speed'); ?>"><?php _e('Animation Speed',THEME_ADMIN_LANG_DOMAIN); ?>:</label>
		<select name="<?php echo $this->get_field_name('speed'); ?>" id="<?php echo $this->get_field_id('speed'); ?>" >
			<option value='fast' <?php selected( $speed, 'fast'); ?> ><?php _e('Fast',THEME_ADMIN_LANG_DOMAIN); ?></option>
			<option value='normal' <?php selected( $speed, 'normal'); ?> ><?php _e('Normal',THEME_ADMIN_LANG_DOMAIN); ?></option>
			<option value='slow' <?php selected( $speed, 'slow'); ?> ><?php _e('Slow',THEME_ADMIN_LANG_DOMAIN); ?></option>
		</select>
	</p>
	<i><?php _e('Only For Horizontal Menu',THEME_ADMIN_LANG_DOMAIN);?></i>
	<p>
		<label for="<?php echo $this->get_field_id('float'); ?>"><?php _e('Alignment:'); ?></label>
		<select name="<?php echo $this->get_field_name('float'); ?>" id="<?php echo $this->get_field_id('float'); ?>" class="widefat">
			<option value="left" <?php selected( $float, 'left' ); ?>><?php _e('Left'); ?></option>
			<option value="right" <?php selected( $float, 'right' ); ?>><?php _e('Right'); ?></option>
			
		</select>
	</p>
	<i><?php _e('Only For Vertical Menu',THEME_ADMIN_LANG_DOMAIN);?></i>
	<p>
		<label for="<?php echo $this->get_field_id('only_related'); ?>"><?php _e('Show hierarchy:'); ?></label>
		<select name="<?php echo $this->get_field_name('only_related'); ?>" id="<?php echo $this->get_field_id('only_related'); ?>" class="widefat">
			<option value="1" <?php selected( $only_related, 1 ); ?>><?php _e('Display all'); ?></option>
			<option value="2" <?php selected( $only_related, 2 ); ?>><?php _e('Only related sub-items'); ?></option>
			<option value="3" <?php selected( $only_related, 3 ); ?>><?php _e( 'Only strictly related sub-items' ); ?></option>
		</select>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('depth'); ?>"><?php _e('How many levels to display:'); ?></label>
		<select name="<?php echo $this->get_field_name('depth'); ?>" id="<?php echo $this->get_field_id('depth'); ?>" class="widefat">
			<option value="0"<?php selected( $depth, 0 ); ?>><?php _e('Unlimited depth'); ?></option>
			<option value="1"<?php selected( $depth, 1 ); ?>><?php _e( '1 level deep' ); ?></option>
			<option value="2"<?php selected( $depth, 2 ); ?>><?php _e( '2 levels deep' ); ?></option>
			<option value="3"<?php selected( $depth, 3 ); ?>><?php _e( '3 levels deep' ); ?></option>
			<option value="4"<?php selected( $depth, 4 ); ?>><?php _e( '4 levels deep' ); ?></option>
			<option value="5"<?php selected( $depth, 5 ); ?>><?php _e( '5 levels deep' ); ?></option>
			<option value="-1"<?php selected( $depth, -1 ); ?>><?php _e( 'Flat display' ); ?></option>
		</select>
	<p>

	
	
	<?php 
	}
   
}
add_action('widgets_init', create_function('', 'return register_widget("UltimatumMenu");'));

class Related_Sub_Items_Walker extends Walker_Nav_Menu
{
	
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		if ( !$element )
			return;

		$id_field = $this->db_fields['id'];

		//display this element
		if ( is_array( $args[0] ) )
			$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'start_el'), $cb_args);

		$id = $element->$id_field;

		// descend only when the depth is right and there are childrens for this element
		if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

			$current_element_markers = array( 'current-menu-item', 'current-menu-parent', 'current-menu-ancestor', 'current_page_item' );
			
			foreach( $children_elements[ $id ] as $child ){
				
				if ($args[0]->strict_sub) {
				
					$temp_children_elements = $children_elements;
							
					$descend_test = array_intersect( $current_element_markers, $child->classes );
					if ( empty( $descend_test ) )  
						unset ( $children_elements );
				}
									
				if ( !isset($newlevel) ) {
					$newlevel = true;
					//start the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
				
				if ($args[0]->strict_sub)
					$children_elements = $temp_children_elements;				
			}
			unset( $children_elements[ $id ] );
		}

		if ( isset($newlevel) && $newlevel ){
			//end the child delimiter
			$cb_args = array_merge( array(&$output, $depth), $args);
			call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
		}

		//end this element
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'end_el'), $cb_args);
	}
	
	function walk( $elements, $max_depth) {

		$args = array_slice(func_get_args(), 2);
		$output = '';

		if ($max_depth < -1) //invalid parameter
			return $output;

		if (empty($elements)) //nothing to walk
			return $output;

		$id_field = $this->db_fields['id'];
		$parent_field = $this->db_fields['parent'];

		// flat display
		if ( -1 == $max_depth ) {
			$empty_array = array();
			foreach ( $elements as $e )
				$this->display_element( $e, $empty_array, 1, 0, $args, $output );
			return $output;
		}

		/*
		 * need to display in hierarchical order
		 * separate elements into two buckets: top level and children elements
		 * children_elements is two dimensional array, eg.
		 * children_elements[10][] contains all sub-elements whose parent is 10.
		 */
		$top_level_elements = array();
		$children_elements  = array();
		foreach ( $elements as $e) {
			if ( 0 == $e->$parent_field )
				$top_level_elements[] = $e;
			else
				$children_elements[ $e->$parent_field ][] = $e;
		}

		/*
		 * when none of the elements is top level
		 * assume the first one must be root of the sub elements
		 */
		if ( empty($top_level_elements) ) {

			$first = array_slice( $elements, 0, 1 );
			$root = $first[0];

			$top_level_elements = array();
			$children_elements  = array();
			foreach ( $elements as $e) {
				if ( $root->$parent_field == $e->$parent_field )
					$top_level_elements[] = $e;
				else
					$children_elements[ $e->$parent_field ][] = $e;
			}
		}
		
		$current_element_markers = array( 'current-menu-item', 'current-menu-parent', 'current-menu-ancestor', 'current_page_item' );
        
		foreach ( $top_level_elements as $e ) {
			
			$temp_children_elements = $children_elements;
			
			// descend only on current tree
			$descend_test = array_intersect( $current_element_markers, $e->classes );
			if ( empty( $descend_test ) )  
				unset ( $children_elements );

			$this->display_element( $e, $children_elements, $max_depth, 0, $args, $output );
			
			$children_elements = $temp_children_elements;
		}

		 return $output;
	}

}
