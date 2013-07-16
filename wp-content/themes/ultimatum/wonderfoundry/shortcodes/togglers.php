<?php
function shortcode_toggle($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'title' => false
	), $atts));
	return '<div class="toggle"><h4 class="toggle_title"><a class="toggle-title">' . $title . '</a></h4><div class="toggle_content">' . do_shortcode(trim($content)) . '</div></div>';
}
add_shortcode('toggle', 'shortcode_toggle');


function tab_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title'      => '',
    ), $atts));
    global $tab_array;
    $tab_array[] = array('title' => $title, 'content' => trim(do_shortcode($content)));
    return $tab_array;
}
add_shortcode('tab', 'tab_func');


function shortcode_tabs( $atts, $content = null ) {
    global $tab_array;
    $tab_array = array(); // clear the array
    $tabs_nav = '';
    $tabs_nav .= '<div class="tabs-wrapper">';
    $tabs_nav .= '<ul class="tabs">';
    $tabs_content ='<div class="panes">';
    do_shortcode($content); 
    foreach ($tab_array as $tab => $tab_attr_array) {
	$tabs_nav .= '<li><a class="tab-title">'.$tab_attr_array['title'].'</a></li>';
	$tabs_content .= '<div class="tab-content" >'.$tab_attr_array['content'].'</div>';
    }
    $tabs_nav .= '</ul>';
    $tabs_output .= $tabs_nav . $tabs_content;
    $tabs_output .= '</div>';
    $tabs_output .= '</div>';
    $tabs_output .= '<div class="clear"></div>';
    return $tabs_output;
}
add_shortcode('tabs', 'shortcode_tabs');


function accordion_row( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title'      => '',
    ), $atts));
    global $accordion_toggle_array;
    $accordion_toggle_array[] = array('title' => $title, 'content' => trim(do_shortcode($content)));
    return $accordion_toggle_array;
}
add_shortcode('accrow', 'accordion_row');


function shortcode_accordion( $atts, $content = null ) {
    global $accordion_toggle_array;
    $accordion_toggle_array = array(); // clear the array

    $accordion_output = '<div class="clear"></div>';
    $accordion_output .= '<div class="accordion">';
    do_shortcode($content); // execute the '[accordion_toggle]' shortcode first to get the title and content
    foreach ($accordion_toggle_array as $tab => $accordion_toggle_attr_array) {
	$accordion_output .= '<h4 class="accordion-toggle"><a href="#" class="accordion-title">'.$accordion_toggle_attr_array['title'].'</a></h4>';
     $accordion_output .= '  <div class="pane">'.$accordion_toggle_attr_array['content'].'</div>';
           }
    $accordion_output .= '</div>';
    $accordion_output .= '<div class="clear"></div>';
    return $accordion_output;
}
add_shortcode('accordion', 'shortcode_accordion');