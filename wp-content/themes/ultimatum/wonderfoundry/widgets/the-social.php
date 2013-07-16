<?php
class UltimatumSocial extends WP_Widget {

	var $sites = array(
		'AIM','Apple','Bebo','Blogger','Brightkite','Cargo','Delicious','Designfloat',
		'Designmoo','Deviantart','Digg','Dopplr','Dribbble','Email','Ember','Evernote',
		'Facebook','Flickr','Forrst','Friendfeed','Gamespot','Google','GoogleVoice','GoogleWave',
		'GoogleTalk','Gowalla','Grooveshark','iLike','lastFm','LinkedIn','Mixx','MobileMe',
		'Mynameise','MySpace','Netvibes','Newsvine','Openid','Orkut','Pandora','Paypal','Picasa',
		'Playstation','Plurk','Posterous','qik','Readernaut','Reddit','Roboto','RSS','Sharethis',
		'Skype','StumbleUpon','Technorati','Tumblr','Twitter','Viddler','Vimeo','Virb','Wordpress',
		'Xing','Yahoo','YahooBuzz','Yelp','YouTube','Zootool'
	);
	var $packages = array(
		'16px' => array(
			'name'=>'Social Network Icon Pack 16px',
			'path'=>'16/{:name}.png',
		),
		'24px' => array(
			'name'=>'Social Network Icon Pack 24px',
			'path'=>'24/{:name}.png',
		),
		'32px' => array(
			'name'=>'Social Network Icon Pack 32px',
			'path'=>'32/{:name}.png',
		),
	);
	
	
	function UltimatumSocial() {
        parent::WP_Widget(false, $name = 'Ultimatum Social');
    }
	
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$package = $instance['package'];
		$output = '';
		if( !empty($instance['enable_sites']) ){
			foreach($instance['enable_sites'] as $site){
				$path = str_replace('{:name}',strtolower($site),$this->packages[$package]['path']);
				$link = isset($instance[$site])?$instance[$site]:'#';
				if(file_exists(THEME_DIR . '/images/social_icons/'.$path)){
					$output .= '<a href="'.$link.'" target="_blank"><img src="'.THEME_IMAGES.'/social_icons/'.$path.'" alt="'.$site.'" title="'.$site.'"/></a>';
				}
			}
		}
		if ( !empty( $output ) ) {
			echo $before_widget;
			if ( $title)
				echo $before_title . $title . $after_title;
		?>
		<div class="social">
			<?php echo $output; ?>
		</div>
		<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['package'] = strip_tags($new_instance['package']);
		$instance['enable_sites'] = $new_instance['enable_sites'];

		if(!empty($instance['enable_sites'])){
			foreach($instance['enable_sites'] as $site){
				$instance[$site] = isset($new_instance[$site])?strip_tags($new_instance[$site]):'';
			}
		}
		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$package = isset($instance['package']) ? $instance['package'] : '';
		$enable_sites = isset($instance['enable_sites']) ? $instance['enable_sites'] : array();
		foreach($this->sites as $site){
			$$site = isset($instance[$site]) ? esc_attr($instance[$site]) : '';
		}
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', THEME_ADMIN_LANG_DOMAIN); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p>
			<label for="<?php echo $this->get_field_id('package'); ?>"><?php _e( 'Icon Package:' , THEME_ADMIN_LANG_DOMAIN); ?></label>
			<select name="<?php echo $this->get_field_name('package'); ?>" id="<?php echo $this->get_field_id('package'); ?>" class="widefat">
				<?php foreach($this->packages as $name => $value):?>
				<option value="<?php echo $name;?>"<?php selected($package,$name);?>><?php echo $value['name'];?></option>
				<?php endforeach;?>
			</select>
		</p>
		<em><?php _e("The social icon linkage will be shown after you select the social networks and then click save)", THEME_ADMIN_LANG_DOMAIN);?></em>
		<p>
			<label for="<?php echo $this->get_field_id('enable_sites'); ?>"><?php _e( 'Enable Social Icon (use CTRL+Click to multi Select):', THEME_ADMIN_LANG_DOMAIN ); ?></label>
			<select name="<?php echo $this->get_field_name('enable_sites'); ?>[]" style="height:10em" id="<?php echo $this->get_field_id('enable_sites'); ?>" class="social_icon_select_sites widefat" multiple="multiple">
				<?php foreach($this->sites as $site):?>
				<option value="<?php echo $site;?>"<?php echo in_array($site, $enable_sites)? 'selected="selected"':'';?>><?php echo $site;?></option>
				<?php endforeach;?>
			</select>
		</p>
		
		<p>
			<em><?php _e("Please input FULL URL <br/>(e.g. http://twitter.com/wonderfoundry)", THEME_ADMIN_LANG_DOMAIN);?></em>
		</p>
		<div class="social_icon_wrap">
		<?php foreach($this->sites as $site):?>
		<p class="social_icon_<?php echo $site;?>" <?php if(!in_array($site, $enable_sites)):?>style="display:none"<?php endif;?>>
			<label for="<?php echo $this->get_field_id( $site ); ?>"><?php echo $site.' '.__('URL:', THEME_ADMIN_LANG_DOMAIN)?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( $site ); ?>" name="<?php echo $this->get_field_name( $site ); ?>" type="text" value="<?php echo $$site; ?>" />
		</p>
		<?php endforeach;?>
		</div>

		
<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("UltimatumSocial");'));
