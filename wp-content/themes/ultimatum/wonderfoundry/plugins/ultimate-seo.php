<?php
if(get_theme_option('general', 'ultimatum_seo')){
	
	// Doctitle action Removal from WP-HEAD
	remove_action( 'wp_head', 'wp_generator' );
	if (!get_theme_option('seo','index_rel_tag')){ remove_action( 'wp_head', 'index_rel_link'); }
	if (!get_theme_option('seo','parent_post_rel_tag')){ remove_action('wp_head', 'parent_post_rel_link', 10, 0); }
	if (!get_theme_option('seo','start_post_rel_tag')){ remove_action('wp_head', 'start_post_rel_link', 10, 0); }
	if (!get_theme_option('seo','adj_post_rel_tag')){ remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); }
	if (!get_theme_option('seo','live_writer')){ remove_action('wp_head', 'wlwmanifest_link'); }
	if (!get_theme_option('seo','slink_tag')){ remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); }
	
	add_filter( 'wp_title', 'ultimatum_doctitle_wrap', 20 );
	function ultimatum_doctitle_wrap( $title ) {
		return is_feed() || is_admin() ? $title : sprintf( "<title>%s</title>\n", $title );
	}

	add_action( 'ultimatum_title', 'wp_title' );
	add_filter( 'wp_title', 'ultimatum_default_title', 10, 3 );
	function ultimatum_default_title( $title, $sep, $seplocation ) {
		global $wp_query;
		if ( is_feed() )
			return trim( $title );
	
		$sep = get_theme_option('seo','title_seperator' ) ? get_theme_option('seo','title_seperator' ) : '–';

		if (is_front_page()) {
			$title = get_theme_option('seo','home_doctitle' ) ? get_theme_option('seo','home_doctitle' ) : get_bloginfo( 'name' );
			$title = get_theme_option('seo','doctitle_home_desc' ) ? $title . " $sep " . get_bloginfo( 'description' ) : $title;
		}

		if ( is_singular() ) {
			global $post;
			$seo_raw =  get_post_meta($post->ID, 'ultimatum_seo', true);
			$seo = unserialize($seo_raw);
			if ( $seo['title'] ) {
				$title =  $seo['title'];
			}
			
		}
	
		if ( is_category() ) {
			$term = $wp_query->get_queried_object();
			$title = ! empty( $term->meta['doctitle'] ) ? $term->meta['doctitle'] : $title;
		}
	
		if ( is_tag() ) {
			$term = $wp_query->get_queried_object();
			$title = ! empty( $term->meta['doctitle'] ) ? $term->meta['doctitle'] : $title;
		}
	
		if ( is_tax() ) {
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			$title = ! empty( $term->meta['doctitle'] ) ? wp_kses_stripslashes( wp_kses_decode_entities( $term->meta['doctitle'] ) ) : $title;
		}
	
		if ( is_author() ) {
			$user_title = get_the_author_meta( 'doctitle', (int) get_query_var( 'author' ) );
			$title = $user_title ? $user_title : $title;
		}

		if ( ! get_theme_option('seo','doctitle_sitename' ) || is_front_page() )
			return esc_html( trim( $title ) );

		$title = $title . " $sep " . get_bloginfo( 'name' );
		return esc_html( trim( $title ) );
	}
	
	add_action( 'ultimatum_meta', 'ultimatum_seo_meta_description' );

	function ultimatum_seo_meta_description() {
	
		global $wp_query, $post;
	
		$description = '';
		if ( is_front_page()) {
			$description = get_theme_option('seo', 'home_description' ) ? get_theme_option('seo', 'home_description' ) : get_bloginfo( 'description' );
		}

		if ( is_singular() ) {
			$seo_raw =  get_post_meta($post->ID, 'ultimatum_seo', true);
			$seo = unserialize($seo_raw);
			if ($seo['description']) {
				$description = $seo['description'];
			}
		}
	
		if ( is_category() ) {
			$term = $wp_query->get_queried_object();
			$description = ! empty( $term->meta['description'] ) ? $term->meta['description'] : '';
		}
	
		if ( is_tag() ) {
			$term = $wp_query->get_queried_object();
			$description = ! empty( $term->meta['description'] ) ? $term->meta['description'] : '';
		}

		if ( is_tax() ) {
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			$description = ! empty( $term->meta['description'] ) ? wp_kses_stripslashes( wp_kses_decode_entities( $term->meta['description'] ) ) : '';
		}
	
		if ( is_author() ) {
			$user_description = get_the_author_meta( 'meta_description', (int) get_query_var( 'author' ) );
			$description = $user_description ? $user_description : '';
		}
	
		if ( ! empty( $description ) ) {
			echo '<meta name="description" content="' . esc_attr( $description ) . '" />' . "\n";
		}
	
	}
	
	add_action( 'ultimatum_meta', 'ultimatum_seo_meta_keywords' );
	
	function ultimatum_seo_meta_keywords() {
		global $wp_query, $post;
		$keywords = '';
		// if we're on the homepage
		if (is_front_page()) {
			$keywords = get_theme_option('seo', 'home_keywords' );
		}
	
		if (is_singular() ) {
			$seo_raw =  get_post_meta($post->ID, 'ultimatum_seo', true);
			$seo = unserialize($seo_raw);
			if ($seo['keywords']) {
				$keywords = $seo['keywords'];
			}
		}

		if ( is_category() ) {
			$term = $wp_query->get_queried_object();
			$keywords = ! empty( $term->meta['keywords'] ) ? $term->meta['keywords'] : '';
		}
	
		if ( is_tag() ) {
			$term = $wp_query->get_queried_object();
			$keywords = ! empty( $term->meta['keywords'] ) ? $term->meta['keywords'] : '';
		}
	
		if ( is_tax() ) {
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			$keywords = ! empty( $term->meta['keywords'] ) ? wp_kses_stripslashes( wp_kses_decode_entities( $term->meta['keywords'] ) ) : '';
		}
	
		if ( is_author() ) {
			$user_keywords = get_the_author_meta( 'meta_keywords', (int) get_query_var( 'author' ) );
			$keywords = $user_keywords ? $user_keywords : '';
		}
	
		if ( empty( $keywords ) )
			return;
	
		echo '<meta name="keywords" content="' . esc_attr( $keywords ) . '" />' . "\n";
	}
	
	add_action( 'ultimatum_meta', 'ultimatum_robots_meta' );

	function ultimatum_robots_meta() {
	
		global $wp_query, $post;
		if ( 0 == get_option( 'blog_public' ) )
			return;
	
		// defaults
		$meta = array(
			'noindex'   => '',
			'nofollow'  => '',
			'noarchive' => get_theme_option('seo', 'site_no_archive' ) ? 'noarchive' : '',
			'noodp'     => get_theme_option('seo', 'noodp' ) ? 'noodp' : '',
			'noydir'    => get_theme_option('seo', 'noydir' ) ? 'noydir' : ''
		);
	
		if ( is_front_page()) {
			$meta['noindex'] = get_theme_option('seo', 'home_noindex' ) ? 'noindex' : $meta['noindex'];
			$meta['nofollow'] = get_theme_option('seo', 'home_nofollow' ) ? 'nofollow' : $meta['nofollow'];
			$meta['noarchive'] = get_theme_option('seo', 'home_noarchive' ) ? 'noarchive' : $meta['noarchive'];
		}
	
		if ( is_category() ) {
			$term = $wp_query->get_queried_object();
			$meta['noindex'] = $term->meta['noindex'] ? 'noindex' : $meta['noindex'];
			$meta['nofollow'] = $term->meta['nofollow'] ? 'nofollow' : $meta['nofollow'];
			$meta['noarchive'] = $term->meta['noarchive'] ? 'noarchive' : $meta['noarchive'];
			$meta['noindex'] = get_theme_option('seo', 'cat_arch_no_index' ) ? 'noindex' : $meta['noindex'];
			$meta['noarchive'] = get_theme_option('seo', 'cat_arch_no_archive' ) ? 'noarchive' : $meta['noarchive'];
			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
			$meta['noindex'] = $paged > 1 && ! get_theme_option('seo', 'canno_pagi_arch' ) ? 'noindex' : $meta['noindex'];
		}
	
		if ( is_tag() ) {
			$term = $wp_query->get_queried_object();
			$meta['noindex'] = $term->meta['noindex'] ? 'noindex' : $meta['noindex'];
			$meta['nofollow'] = $term->meta['nofollow'] ? 'nofollow' : $meta['nofollow'];
			$meta['noarchive'] = $term->meta['noarchive'] ? 'noarchive' : $meta['noarchive'];
			$meta['noindex'] = get_theme_option('seo', 'tag_arch_no_index' ) ? 'noindex' : $meta['noindex'];
			$meta['noarchive'] = get_theme_option('seo', 'tag_arch_no_archive' ) ? 'noarchive' : $meta['noarchive'];
			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
			$meta['noindex'] = $paged > 1 && ! get_theme_option('seo', 'canno_pagi_arch' ) ? 'noindex' : $meta['noindex'];
		}
	
		if ( is_tax() ) {
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			$meta['noindex'] = $term->meta['noindex'] ? 'noindex' : $meta['noindex'];
			$meta['nofollow'] = $term->meta['nofollow'] ? 'nofollow' : $meta['nofollow'];
			$meta['noarchive'] = $term->meta['noarchive'] ? 'noarchive' : $meta['noarchive'];
			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
			$meta['noindex'] = $paged > 1 && ! get_theme_option('seo', 'canno_pagi_arch' ) ? 'noindex' : $meta['noindex'];
		}
	
		if ( is_author() ) {
			$meta['noindex'] = get_the_author_meta( 'noindex', (int) get_query_var( 'author' ) ) ? 'noindex' : $meta['noindex'];
			$meta['nofollow'] = get_the_author_meta( 'nofollow', (int) get_query_var( 'author' ) ) ? 'nofollow' : $meta['nofollow'];
			$meta['noarchive'] = get_the_author_meta( 'noarchive', (int) get_query_var( 'author' ) ) ? 'noarchive' : $meta['noarchive'];
			$meta['noindex'] = get_theme_option('seo', 'auth_arch_no_index' ) ? 'noindex' : $meta['noindex'];
			$meta['noarchive'] = get_theme_option('seo', 'auth_arch_no_archive' ) ? 'noarchive' : $meta['noarchive'];
			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
			$meta['noindex'] = $paged > 1 && ! get_theme_option('seo', 'canno_pagi_arch' ) ? 'noindex' : $meta['noindex'];
		}
	
		if ( is_date() ) {
			$meta['noindex'] = get_theme_option('seo', 'date_arch_no_index' ) ? 'noindex' : $meta['noindex'];
			$meta['noarchive'] = get_theme_option('seo', 'date_arch_no_archive' ) ? 'noarchive' : $meta['noarchive'];
		}
		if ( is_search() ) {
			$meta['noindex'] = get_theme_option('seo', 'search_arch_no_index' ) ? 'noindex' : $meta['noindex'];
			$meta['noarchive'] = get_theme_option('seo', 'search_arch_no_archive' ) ? 'noarchive' : $meta['noarchive'];
		}
	
		if ( is_singular() ) {
			$seo_raw =  get_post_meta($post->ID, 'ultimatum_seo', true);
			$seo = unserialize($seo_raw);
			$meta['noindex'] = 	$seo['noindex'] ? 'noindex' : $meta['noindex'];
			$meta['nofollow'] = $seo['nofollow']? 'nofollow' : $meta['nofollow'];
			$meta['noarchive'] = $seo['noarchive'] ? 'noarchive' : $meta['noarchive'];
		}
		
		$meta = array_filter( $meta );
	
		if ( ! $meta )
			return;
	
		printf( '<meta name="robots" content="%s" />' . "\n", implode( ",", $meta ) );
	
	}
	
	remove_action( 'wp_head', 'rel_canonical' );
	add_action( 'wp_head', 'ultimatum_canonical' );

	function ultimatum_canonical() {
		global $wp_query, $post;
		$canonical = '';
		if ( is_front_page() ) {
			$canonical = trailingslashit( home_url() );
		}
	
		if ( is_singular() ) {
			if ( ! $id = $wp_query->get_queried_object_id() )
				return;
			$seo_raw =  get_post_meta($post->ID, 'ultimatum_seo', true);
			$seo = unserialize($seo_raw);
			$cf = $seo['canonical_uri'];
			$canonical = $cf ? $cf : get_permalink( $id );
		}
	
		if ( is_category() || is_tag() || is_tax() ) {
			if ( !$id = $wp_query->get_queried_object_id() )
				return;
			$taxonomy = $wp_query->queried_object->taxonomy;
			$canonical = get_theme_option('seo', 'canno_pagi_arch' ) ? get_term_link( (int) $id, $taxonomy ) : 0;
		}
	
		if ( is_author() ) {
			if ( ! $id = $wp_query->get_queried_object_id() )
				return;
			$canonical = get_theme_option('seo', 'canno_pagi_arch' ) ? get_author_posts_url( $id ) : 0;
		}
	
		if ( ! $canonical )
			return;
	
		printf( '<link rel="canonical" href="%s" />' . "\n", esc_url( apply_filters( 'ultimatum_canonical', $canonical ) ) );
	
	}
	
	if( ! function_exists( 'custom_field_redirect' ) ) {
		add_action( 'template_redirect', 'custom_field_redirect' );
	
		function custom_field_redirect() {
			global $post;
			$redirect = isset( $post->ID ) ? get_post_meta( $post->ID, 'ultimatum_redirect', true ) : '';
			if ( ! empty( $redirect ) && is_singular() ) {
				wp_redirect( esc_url_raw( $redirect ), 301 );
				exit();
			}
		}
	
	}
	/// Admin side actions
	function ultimatum_seo() {
		$args=array('public'   => true,'publicly_queryable' => true);
		$post_types=get_post_types($args,'names');
		foreach ($post_types as $post_type ) {
			if($post_type!='attachment'){
				add_meta_box('ultimatum_seo',__( 'Ultimatum SEO', THEME_ADMIN_LANG_DOMAIN),'ultimatum_seo_form',$post_type);
			}
		}
		add_meta_box('ultimatum_seo',__( 'SEO', THEME_ADMIN_LANG_DOMAIN),'ultimatum_seo_form','page');
	}

	function ultimatum_seo_form() {
		global $wpdb;
		$table=$wpdb->prefix.'ultimatum_layout';
		$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
		wp_nonce_field( plugin_basename( __FILE__ ), 'ulseo_noncename' );
		$curr= get_post_meta($post_id,'ultimatum_seo',true);
		$redirect = get_post_meta($post_id,'ultimatum_redirect',true);
		$current=unserialize($curr);
		?>
		
		<input type="hidden" name="ultimatum_seo_nonce" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />
	
		<p><label for="ultimatum_title"><b><?php _e('Document Title', THEME_ADMIN_LANG_DOMAIN); ?></b></label></p>
		<p><input class="large-text" type="text" name="ultimatum_seo[title]" id="ultimatum_title" value="<?php echo esc_attr( $current['title']); ?>" /></p>
	
		<p><label for="ultimatum_description"><b><?php _e('Meta Description', THEME_ADMIN_LANG_DOMAIN); ?></b></label></p>
		<p><textarea class="large-text" name="ultimatum_seo[description]" id="ultimatum_description" rows="4" cols="4"><?php echo esc_textarea( $current['description']); ?></textarea></p>
	
		<p><label for="ultimatum_keywords"><b><?php _e('Meta Keywords, comma separated', THEME_ADMIN_LANG_DOMAIN); ?></b></label></p>
		<p><input class="large-text" type="text" name="ultimatum_seo[keywords]" id="ultimatum_keywords" value="<?php echo esc_attr($current['keywords']); ?>" /></p>
	
		<p><label for="ultimatum_canonical"><b><?php _e('Custom Canonical URI', THEME_ADMIN_LANG_DOMAIN); ?></b></label></p>
		<p><input class="large-text" type="text" name="ultimatum_seo[canonical_uri]" id="ultimatum_canonical" value="<?php echo esc_url( $current['canonical_uri']); ?>" /></p>
	
		<p><label for="ultimatum_redirect"><b><?php _e('Custom Redirect URI', THEME_ADMIN_LANG_DOMAIN); ?></b></label></p>
		<p><input class="large-text" type="text" name="ultimatum_redirect" id="ultimatum_redirect" value="<?php echo esc_url( $redirect); ?>" /></p>
	
		
	
		<p><b><?php _e('Robots Meta Settings', THEME_ADMIN_LANG_DOMAIN); ?></b></p>
	
		<p>
			<input type="checkbox" name="ultimatum_seo[noindex]" id="ultimatum_noindex" value="1" <?php checked(1, $current['noindex']); ?> />
			<label for="ultimatum_noindex"><?php printf( __('Apply %s to this post/page', THEME_ADMIN_LANG_DOMAIN), '<code>noindex</code>' ); ?></label><br />
			<input type="checkbox" name="ultimatum_seo[nofollow]" id="ultimatum_nofollow" value="1" <?php checked(1, $current['nofollow']); ?> />
			<label for="ultimatum_nofollow"><?php printf( __('Apply %s to this post/page', THEME_ADMIN_LANG_DOMAIN), '<code>nofollow</code>' ); ?></label><br />
	
			<input type="checkbox" name="ultimatum_seo[noarchive]" id="ultimatum_noarchive" value="1" <?php checked(1, $current['noarchive']); ?> />
			<label for="ultimatum_nofollow"><?php printf( __('Apply %s to this post/page', THEME_ADMIN_LANG_DOMAIN), '<code>noarchive</code>' ); ?></label>
		</p>
	
		
		
		<?php 
		
	}

	function ultimatum_seo_save_postdata( $post_id ) {
	  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE || defined('DOING_AJAX') && DOING_AJAX ) 
	      return;
	
	  if ( 'page' == $_POST['post_type'] ) 
	  {
	    if ( !current_user_can( 'edit_page', $post_id ) )
	        return;
	  }
	  else
	  {
	    if ( !current_user_can( 'edit_post', $post_id ) )
	        return;
	  }
	  $mydata = serialize($_POST['ultimatum_seo']);
	  update_post_meta($post_id, 'ultimatum_seo', $mydata);
	  update_post_meta($post_id, 'ultimatum_redirect', $_POST['ultimatum_redirect']);
	}

	add_action( 'admin_init', 'ultimatum_seo', 1 );
	add_action( 'save_post', 'ultimatum_seo_save_postdata' );

	function ultimatum_taxonomy_seo_form( $tag, $taxonomy ) {
		$tax = get_taxonomy( $taxonomy );
		?>
		<table class="widefat">
		<thead>
		<tr><th colspan="2"><?php _e('SEO', THEME_ADMIN_LANG_DOMAIN); ?></th></tr>
		</thead>
			<tbody>
				<tr class="form-field">
					<th scope="row" valign="top"><label for="meta[doctitle]"><?php printf( __('%s', THEME_ADMIN_LANG_DOMAIN), '<code>&lt;title&gt;</code>' ); ?></label></th>
					<td><input name="meta[doctitle]" id="meta[doctitle]" type="text" value="<?php echo esc_attr( $tag->meta['doctitle'] ); ?>" size="40" />
				</td>
				</tr>
				<tr class="form-field">
					<th scope="row" valign="top"><label for="meta[description]"><?php printf( __('%s Description', THEME_ADMIN_LANG_DOMAIN), '<code>META</code>' ); ?></label></th>
					<td><textarea name="meta[description]" id="meta[description]" rows="3" cols="50"><?php echo esc_html( $tag->meta['description'] ); ?></textarea></td>
				</tr>
				<tr class="form-field">
					<th scope="row" valign="top"><label for="meta[keywords]"><?php printf( __('%s Keywords', THEME_ADMIN_LANG_DOMAIN), '<code>META</code>' ); ?></label></th>
					<td>	
						<input name="meta[keywords]" id="meta[keywords]" type="text" value="<?php echo esc_attr( $tag->meta['keywords'] ); ?>" size="40" />
						<p class="description"><?php _e('Comma separated list', THEME_ADMIN_LANG_DOMAIN); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top"><label><?php _e('Robots Meta', THEME_ADMIN_LANG_DOMAIN); ?></label></th>
				<td>
					<label><input name="meta[noindex]" id="meta[noindex]" type="checkbox" value="1" <?php checked(1, $tag->meta['noindex']); ?> /> <?php printf( __('Apply %s to this archive?', THEME_ADMIN_LANG_DOMAIN), '<code>noindex</code>' ); ?></label><br />
					<label><input name="meta[nofollow]" id="meta[nofollow]" type="checkbox" value="1" <?php checked(1, $tag->meta['nofollow']); ?> /> <?php printf( __('Apply %s to this archive?', THEME_ADMIN_LANG_DOMAIN), '<code>nofollow</code>' ); ?></label><br />
					<label><input name="meta[noarchive]" id="meta[noarchive]" type="checkbox" value="1" <?php checked(1, $tag->meta['noarchive']); ?> /> <?php printf( __('Apply %s to this archive?', THEME_ADMIN_LANG_DOMAIN), '<code>noarchive</code>' ); ?></label>
				</td>
				</tr>
			</tbody>
		</table>
		<?php
	}
	
	add_action( 'admin_init', 'ultimatum_add_taxonomy_seo_form' );
	
	function ultimatum_add_taxonomy_seo_form() {
		foreach ( get_taxonomies( array( 'show_ui' => true ) ) as $tax_name) {
			add_action( $tax_name . '_edit_form', 'ultimatum_taxonomy_seo_form', 10, 2 );
		}
	}
	
	add_action('edit_term', 'ultimatum_term_meta_save', 10, 2);
	
	function ultimatum_term_meta_save($term_id, $tt_id) {
		$term_meta = (array) get_option('ultimatum-term-meta');
		$term_meta[$term_id] = isset( $_POST['meta'] ) ? (array) $_POST['meta'] : array();
		update_option('ultimatum-term-meta', $term_meta);
	}
	
	add_action('delete_term', 'ultimatum_term_meta_delete', 10, 2);

	function ultimatum_term_meta_delete($term_id, $tt_id) {
		$term_meta = (array) get_option('ultimatum-term-meta');
		unset( $term_meta[$term_id] );
		update_option('ultimatum-term-meta', (array) $term_meta);
	}
	
	add_filter('get_term', 'ultimatum_get_term_data', 10, 2);
	
	function ultimatum_get_term_data($term, $taxonomy) {
		$db = get_option('ultimatum-term-meta');
		$term_meta = isset( $db[$term->term_id] ) ? $db[$term->term_id] : array();
		$term->meta = wp_parse_args( $term_meta, array(
				'display_title' => 0,
				'display_description' => 0,
				'doctitle' => '',
				'description' => '',
				'keywords' => '',
				'noindex' => 0,
				'nofollow' => 0,
				'noarchive' => 0,
				'layout' => ''
		) );
		// Sanitize term meta
		foreach ( $term->meta as $field => $value ) {
			$term->meta[$field] = stripslashes( wp_kses_decode_entities( $value ) );
		}
		return $term;
	}
}