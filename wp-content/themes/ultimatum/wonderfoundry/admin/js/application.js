/*
 * jQuery File Upload Plugin JS Example 4.6
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://creativecommons.org/licenses/MIT/
 */

/*jslint unparam: true */
/*global jQuery */
jQuery.noConflict();
jQuery(document).ready(function(){
	jQuery( "#sortable" ).sortable({
		placeholder: "ui-state-highlight"
	});
	//jQuery( "#sortable" ).disableSelection();
    // Initialize jQuery File Upload (Extended User Interface Version):
    jQuery('#file_upload').fileUploadUIX();
    

});