<?php 
require_once( '../../../../../wp-load.php' );
$sitename = get_bloginfo('name');
global $wpdb;
$table = $wpdb->prefix.'ultimatum_forms';
$query = "SELECT * FROM $table WHERE `id`='$_POST[uformid]'";
$form = $wpdb->get_row($query,ARRAY_A);
$body='';
foreach($_POST as $key=>$value){
	if(stripos($key,'email') || stripos($key,'e-mail') ){
		$email = $value;
	}
	if($key!='uformid'){
		if(is_array($value)){
			$body.= '<strong>'.$key.' :</strong> '.implode(', ',$value).'<br/>';
		} else {
			if(eregi('<br',nl2br($value))){
			$body.= '<strong>'.$key.' :</strong><br/>'.nl2br($value).'<br/>';	
			}else {
			$body.= '<strong>'.$key.' :</strong> '.nl2br($value).'<br/>';
			}
		}
	}
}
	$subject = "Form $form[name] message from $sitename";
	$headers  = "From:$email\r\n";
	$headers .= "Reply-To: $email\r\n";
	$headers .="Content-Type: text/html\r\n";
	$to = $form["notify"];
	$stripos = stripos($form['thank'],'http');
	if(wp_mail($to, $subject, $body, $headers)){
		if($stripos!==false){
			wp_redirect( $form['thank'] );
			exit;
		} else {
			echo $form['thank'];
		}
	} 
?>