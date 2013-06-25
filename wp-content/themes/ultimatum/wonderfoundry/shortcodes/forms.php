<?php
function shortcode_form($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'id'=>'',
	), $atts));
	wp_enqueue_script( 'jquery-forms',THEME_ADMIN_JS_URI.'/jqueryforms.js' );
	wp_enqueue_script('jquery-validate', THEME_JS .'/jquery.validate.min.js', array('jquery-forms'));
	require_once (THEME_ADMIN.'/interfaces/wonder-forms/formbuilder-front.php');
		$fb = new Formbuilder;
	global $wpdb;
	$table = $wpdb->prefix.'ultimatum_forms';
	$query = "SELECT * FROM $table WHERE `id`='$id'";
	$form = $wpdb->get_row($query,ARRAY_A);
	if($form){
	$fields = unserialize($form['fields']);
	foreach($fields['properties'] as $field=>$data){
		foreach ($data as $key=>$value){
		
					if($key =='label'){
						$fields['properties'][$field][$key]=wpml_t('Ultimatum Forms', 'Form-'.$form['name'].'- Label ('.$value.')', $value);
					}
					if($key =='values'){
						$fields['properties'][$field][$key]=wpml_t('Ultimatum Forms', 'Form-'.$form['name'].'- Values ('.$data['label'].')', $value);
					}
				}
		
	}
	$items = $fb->build($fields);
	 $html = '';
	if(stripos($form['thank'],'http')){
	 	$html .= '<div class="uforms"><form id="uform_' . $form['id'] . '" method="post" action="'.THEME_AJAX.'/sendmail.php">';
	 } else {
	  $html .= '<div class="uforms"><form id="uform_' . $form['id'] . '" method="post" action="'.THEME_AJAX.'/sendmail.php" class="ultimate_form">';
	 }
	  if ($items) {
	    foreach ($items as $id => $item) {
	      if ($item['type'] != 'text')
	        $html .= '<div class="' . $id . ' ' . $item['type'] . '"><label for="' . wpml_t('Ultimatum Forms', 'Form-'.$form["name"].'- Label ('.$item['label'].')', $item['label']) . '">' .wpml_t('Ultimatum Forms', 'Form-'.$form["name"].'- Label ('.$item['label'].')', $item['label']).'</label><br />';
	
	      $html .= str_replace($id,$item["label"],$item['html']);
	     
				
	      if ($item['type'] != 'text')
	        $html .= '</div>';
	    }
	  }
	  $html .= '<div class="form-submit"><input type="hidden" name="uformid" value="'.$form["id"].'" />';	
	  $html .= '<input type="submit" class="button hover" value="'.$form["button"].'" /></div>';
	  $html .= '</form>';
	  $html .= '</div>';
	
	  $html = str_replace('"', "'", $html);
	  $html = str_replace('\n', "", $html);
	  return $html;
	}

}
add_shortcode('form', 'shortcode_form');
