<?php
if(get_theme_option('general','ultimatum_forms')) {
class UltimatumForm extends WP_Widget {

	function UltimatumForm() {
        parent::WP_Widget(false, $name = 'Ultimatum Forms');
    }

    function widget($args, $instance) {
    	extract($args);
    	 wp_enqueue_script( 'jquery-forms',THEME_ADMIN_JS_URI.'/jqueryforms.js' );
		wp_enqueue_script('jquery-validate', THEME_JS .'/jquery.validate.min.js', array('jquery-forms'));
		
		require_once (THEME_ADMIN.'/interfaces/wonder-forms/formbuilder-front.php');
		$fb = new Formbuilder;
	global $wpdb;
	$table = $wpdb->prefix.'ultimatum_forms';
	$query = "SELECT * FROM $table WHERE `id`='$instance[form]'";
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
	  // Start the form and put in hidden fields for referral tracking
	 if(stripos($form['thank'],'http')){
	 	$html .= '<div class="uforms"><form id="uform_' . $form['id'] . '" method="post" action="'.THEME_AJAX.'/sendmail.php">';
	 } else {
	  $html .= '<div class="uforms"><form id="uform_' . $form['id'] . '" method="post" action="'.THEME_AJAX.'/sendmail.php" class="ultimate_form">';
	 }
	  if ($items) {
	    foreach ($items as $id => $item) {
	      if ($item['type'] != 'text')
	    //	$item['label']=wpml_t('Ultimatum Forms', 'Form-'.$form[name].'- Label ('.$item['label'].')', $item['label']);
	        $html .= '<div class="' . $id . ' ' . $item['type'] . '"><label for="' . $item['label'] . '">' .$item['label'].'</label><br />';
	
	      $html .= str_replace($id,$item['label'],$item['html']);
	     
				
	      if ($item['type'] != 'text')
	        $html .= '</div>';
	    }
	  }
	  $html .= '<div class="form-submit"><input type="hidden" name="uformid" value="'.$form["id"].'" />';	
	  $html .= '<input type="submit" class="button hover" value="'.$form["button"].'" /></div>';
	  $html .= '</form></div>';
	
	  $html = str_replace('"', "'", $html);
	  $html = str_replace('\n', "", $html);
	  echo $before_widget;
			if ( $instance["title"])
				echo $before_title . $instance["title"] . $after_title;
	  echo $html;
	  echo $after_widget;
	}
    }

function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['form'] = strip_tags( stripslashes($new_instance['form']) );
        return $instance;
    }
function form($instance) {
        $title = esc_attr($instance['title']);
        $form  =  $instance['form'];
        global $wpdb;
        $formstable = $wpdb->prefix.'ultimatum_forms';
        $query = "SELECT * FROM $formstable";
        $result = $wpdb->get_results($query,ARRAY_A);
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', THEME_ADMIN_LANG_DOMAIN); ?></label>
		<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" class="widefat" />
		</p>
        <p>
		<label for="<?php echo $this->get_field_id('form'); ?>"><?php _e('Select Form:',THEME_ADMIN_LANG_DOMAIN) ?></label>
		<select name="<?php echo $this->get_field_name('form'); ?>" id="<?php echo $this->get_field_id('form'); ?>">
		<?php 
			foreach($result as $fetch){
				echo '<option value="'.$fetch["id"].'"';
				selected( $form, $fetch["id"]);
				echo ' >'.$fetch["name"].'</option>';
			}
		?>
		</select>
		</p>
		<?php 
    }

}
add_action('widgets_init', create_function('', 'return register_widget("UltimatumForm");'));
}
?>