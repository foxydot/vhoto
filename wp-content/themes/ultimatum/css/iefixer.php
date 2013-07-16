<?php 
header('Content-Type: text/css');
include('../../../../wp-load.php');
?> 
.button:active,
.button.active,
.button:hover,
.button.hover,
.button,
.button span
.roundbox,
input[type="submit"].submit,
.dropcap.round{
	behavior: url(<?php bloginfo('stylesheet_directory')?>/css/PIE.htc);
}
input[type="text"], textarea {
    background: url("../images/back.png") no-repeat scroll 0 0 transparent;
}
