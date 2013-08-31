<?php
/* Plugin Name: Wp Register Password
Plugin URI: http://www.adminblog.com 
Description: Add extra password fields to register form 
Version: 1.0 
Author: Tan Tran 
Author URI: http://www.adminblog.com 
License: GPLv2 
     You can optionally add additional copyright info here or
     just delete these lines. (Note: you must use GPLv2 if you
     want to get your plugin in the central plugin repository).

You can also optionally add whatever information you want at
the bottom of this header comment, like this.
*/ 

// Add Password, Repeat Password fields to WordPress registration form

add_action( 'register_form', 'ab_add_password_fields' );
function ab_add_password_fields(){
?>
<p>
<label for="password">Password<br/>
<input id="password" class="input" type="password" tabindex="30" size="25" value="" name="password" />
</label>
</p>
<p>
<label for="repeat_password">Repeat password<br/>
<input id="repeat_password" class="input" type="password" tabindex="40" size="25" value="" name="repeat_password" />
</label>
</p>
<?php
}

// Check the form for errors
add_action( 'register_post', 'ab_check_password_fields', 10, 3);
function ab_check_password_fields($login, $email, $errors) {
if ( $_POST['password'] !== $_POST['repeat_password'] ) {
$errors->add( 'passwords_not_matched', "<strong>ERROR</strong>: Passwords do not match" );
}
if ( strlen( $_POST['password'] ) < 8 ) {
$errors->add( 'password_too_short', "<strong>ERROR</strong>: Passwords must be at least eight characters long" );
}
}
?>
<?php
// Storing WordPress user password into database on registration

add_action( 'user_register', 'ab_store_password_fields', 100 );
function ab_store_password_fields( $user_id ){
$userdata = array();

$userdata['ID'] = $user_id;
if ( $_POST['password'] !== '' ) {
$userdata['user_pass'] = $_POST['password'];
}
$new_user_id = wp_update_user( $userdata );
}
?>