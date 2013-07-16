<?php

global $wpdb;
$table2 = $wpdb->prefix.'ultimatum_tax';
$query = "SELECT * FROM $table2";
$result = $wpdb->get_results($query,ARRAY_A);
foreach($result as $fetch){
	$properties = unserialize($fetch["properties"]);
		//set custom taxonomy values
			$label = esc_html($properties["label"]);
			$singular_label = esc_html($properties["singular_label"]);
			$rewrite_slug =  esc_html(slug_single($fetch["pname"])).'/'.esc_html($properties["slug"]);
			$post_types = $fetch["pname"];

			//set custom label values
			$labels['name'] = $label;
			$labels['singular_name'] = $properties["singular_label"];
			$labels['search_items'] = 'Search ' .$label;
			$labels['popular_items'] ='Popular ' .$label;
			
			$labels['parent_item'] = 'Parent ' .$singular_label;
			$labels['parent_item_colon'] ='Parent ' .$singular_label. ':';
			$labels['edit_item'] ='Edit ' .$singular_label;
			$labels['update_item'] = 'Update ' .$singular_label;
			$labels['add_new_item'] ='Add New ' .$singular_label;
			$labels['new_item_name'] = 'New ' .$singular_label. ' Name';
			$labels['separate_items_with_commas'] = 'Separate ' .$label. ' with commas';
			$labels['add_or_remove_items'] ='Add or remove ' .$label;
			$labels['choose_from_most_used'] = 'Choose from the most used ' .$label;

			//register our custom taxonomies
			register_taxonomy( esc_html($properties["name"]),
				array($post_types),
				array( 
					'hierarchical' => true,
					'label' => $label,
					'show_ui' => true,
					'show_in_nav_menus' => true,
					'query_var' => true,
					'rewrite' => array( 'slug' => $rewrite_slug, 'with_front' => false ),
					'singular_label' => $singular_label,
					'labels' => $labels,
					) 
				);
			unset($properties);
			unset($labels);

}


global $wpdb;
$table = $wpdb->prefix.'ultimatum_ptypes';
$query = "SELECT * FROM $table";
$result = $wpdb->get_results($query,ARRAY_A);
foreach($result as $fetch){
	$properties = unserialize($fetch["properties"]);
		//set post type values
			$label = esc_html($properties["label"]);
			$singular = esc_html($properties["singular_label"]);
			$rewrite_slug = esc_html($properties["slug"]);
			$menu_position =  null ;
			$taxonomies = array();
			$supports = ( !$properties["supports"] ) ? array() : $properties["supports"];
			//set custom label values
			$labels['name'] = $label;
			$labels['singular_name'] = $properties["singular_label"];
			$labels['add_new'] =  'Add ' .$singular;
			$labels['add_new_item'] = 'Add New ' .$singular;
			$labels['edit'] =  'Edit';
			$labels['edit_item'] =  'Edit ' .$singular;
			$labels['all_items'] = 'All ' .$label;
			$labels['new_item'] = 'New ' .$singular;
			$labels['view'] = 'View ' .$singular;
			$labels['view_item'] =  'View ' .$singular;
			$labels['search_items'] =  'Search ' .$label;
			$labels['not_found'] =  'No ' .$label. ' Found';
			$labels['not_found_in_trash'] = 'No ' .$label. ' Found in Trash';
			$labels['parent'] = 'Parent ' .$singular;
			register_post_type(esc_html($properties["name"]), array(
					'labels' =>$labels,
					'singular_label' => $singular,
					'public' => true,
					'publicly_queryable' => true,
					'exclude_from_search' => false,
					'show_ui' => true,
					'show_in_menu' => true,
					//'menu_position' => 20,
					'capability_type' => 'post',
					'hierarchical' => false,
					'supports' => $supports,
					'show_in_nav_menus' => true,
					'has_archive' => true,
					'rewrite' => array( 'slug' => $rewrite_slug, 'with_front' => false ),
					'query_var' => false,
					'can_export' => true,
					
		));
			
			unset($properties);
			unset($labels);
}
function slug_single($name){
	global $wpdb;
	$table = $wpdb->prefix.'ultimatum_ptypes';
	$query = "SELECT * FROM $table WHERE `name` = '$name'";
	$fetch = $wpdb->get_row($query,ARRAY_A);
	$properties = unserialize($fetch['properties']);
	$slug = $properties["slug"];
	return $slug;
}