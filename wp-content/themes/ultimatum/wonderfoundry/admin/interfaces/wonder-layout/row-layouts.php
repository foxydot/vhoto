<?php include( '../../../../../../../wp-load.php' );
global $wp_version;
?>
<html>
<head>
<script type='text/javascript' src='<?php bloginfo('wpurl');?>/wp-includes/js/jquery/jquery.js?ver=1.6.1'></script>
<?php if($wp_version>3.2){ ?> 
<script type='text/javascript' src='<?php bloginfo('wpurl');?>/wp-includes/js/jquery/ui/jquery.ui.core.min.js?ver=1.8.12'></script>
<script type='text/javascript' src='<?php bloginfo('wpurl');?>/wp-includes/js/jquery/ui/jquery.ui.widget.min.js?ver=1.8.12'></script>
<script type='text/javascript' src='<?php bloginfo('wpurl');?>/wp-includes/js/jquery/ui/jquery.ui.mouse.min.js?ver=1.8.12'></script>
<script type='text/javascript' src='<?php bloginfo('wpurl');?>/wp-includes/js/jquery/ui/jquery.ui.selectable.min.js?ver=1.8.12'></script>
<?php } else { ?>
<script type='text/javascript' src='<?php bloginfo('wpurl');?>/wp-includes/js/jquery/ui.core.js?ver=1.8.12'></script>
<script type='text/javascript' src='<?php bloginfo('wpurl');?>/wp-includes/js/jquery/ui.widget.js?ver=1.8.12'></script>
<script type='text/javascript' src='<?php bloginfo('wpurl');?>/wp-includes/js/jquery/ui.mouse.js?ver=1.8.12'></script>
<script type='text/javascript' src='<?php bloginfo('wpurl');?>/wp-includes/js/jquery/ui.selectable.js?ver=1.8.12'></script>
<?php } ?>
<style>
body{
	margin:0;
	font-family:Arial,sans-serif;
}
#feedback { font-size: 1.4em; }
#selectable .ui-selecting { background: #FECA40; }
#selectable .ui-selected { background: #777777; color: white; }
table.preview {width:180px;height:50px;}
table.preview td {background:#E0e0e0;text-align:center;border-radius:3px;font-family:Arial}
ol {
	margin:0;
	padding:0;
	list-style:none;
}
ol li {float:left;margin-left:5px;margin-bottom:5px;padding:3px;}
#wpadminbar { display:none; }
</style>
</head>
<body>

<ol id="selectable">
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="100%">100%</td>
	</tr>
</table>

</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="25%">25%</td>
		<td width="25%">25%</td>
		<td width="25%">25%</td>
		<td width="25%">25%</td>
	</tr>
</table>

</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="33%">33%</td>
		<td width="33%">33%</td>
		<td width="33%">33%</td>
	</tr>
</table>

</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="50%">50%</td>
		<td width="50%">50%</td>
	</tr>
</table>

</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="25%">25%</td>
		<td width="25%">25%</td>
		<td width="50%">50%</td>
	</tr>
</table>

</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="50%">50%</td>
		<td width="25%">25%</td>
		<td width="25%">25%</td>
	</tr>
</table>

</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="25%">25%</td>
		<td width="50%">50%</td>
		<td width="25%">25%</td>
	</tr>
</table>

</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="25%">25%</td>
		<td width="75%">75%</td>
	</tr>
</table>

</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="75%">75%</td>
		<td width="25%">25%</td>
	</tr>
</table>

</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="33%">33%</td>
		<td width="66%">66%</td>
	</tr>
</table>

</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="66%">66%</td>
		<td width="33%">33%</td>
	</tr>
</table>

</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="25%" rowspan="2">25%</td>
		<td width="25%">25%</td>
		<td width="25%">25%</td>
		<td width="25%">25%</td>
	</tr>
	<tr>
		<td width="75%" colspan="3">75%</td>
	</tr>
</table>

</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="25%">25%</td>
		<td width="25%">25%</td>
		<td width="25%">25%</td>
		<td width="25%" rowspan="2">25%</td>
	</tr>
	<tr>
		<td width="75%" colspan="3">75%</td>
	</tr>
</table>
</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="25%" rowspan="2">25%</td>
		<td width="25%" rowspan="2">25%</td>
		<td width="25%">25%</td>
		<td width="25%">25%</td>
	</tr>
	<tr>
		<td width="50%" colspan="2">50%</td>
	</tr>
</table>

</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="25%">25%</td>
		<td width="25%">25%</td>
		<td width="25%" rowspan="2">25%</td>
		<td width="25%" rowspan="2">25%</td>
	</tr>
	<tr>
		<td width="50%" colspan="2">50%</td>
	</tr>
</table>

</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="25%" rowspan="2">25%</td>
		<td width="25%">25%</td>
		<td width="25%">25%</td>
		<td width="25%" rowspan="2">25%</td>
	</tr>
	<tr>
		<td width="50%" colspan="2">50%</td>
	</tr>
</table>

</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="25%" rowspan="2">25%</td>
		<td width="50%">50%</td>
		<td width="25%">25%</td>
	</tr>
	<tr>
		<td width="75%" colspan="2">75%</td>
	</tr>
</table>
</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="25%" rowspan="2">25%</td>
		<td width="25%">25%</td>
		<td width="50%">50%</td>
	</tr>
	<tr>
		<td width="75%" colspan="2">75%</td>
	</tr>
</table>
</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="25%">25%</td>
		<td width="50%">50%</td>
		<td width="25%" rowspan="2">25%</td>
	</tr>
	<tr>
		<td width="75%" colspan="2">75%</td>
	</tr>
</table>
</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="50%">50%</td>
		<td width="25%">25%</td>
		<td width="25%" rowspan="2">25%</td>
	</tr>
	<tr>
		<td width="75%" colspan="2">75%</td>
	</tr>
</table>
</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="50%" rowspan="2">50%</td>
		<td width="25%">25%</td>
		<td width="25%">25%</td>
	</tr>
	<tr>
		<td width="75%" colspan="2">50%</td>
	</tr>
</table>
</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="25%">25%</td>
		<td width="25%">25%</td>
		<td width="50%" rowspan="2">50%</td>
	</tr>
	<tr>
		<td width="75%" colspan="2">50%</td>
	</tr>
</table>
</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="33%" rowspan="2">33%</td>
		<td width="33%">33%</td>
		<td width="33%">33%</td>
	</tr>
	<tr>
		<td width="66%" colspan="2">66%</td>
	</tr>
</table>
</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="33%">33%</td>
		<td width="33%">33%</td>
		<td width="33%" rowspan="2">33%</td>
	</tr>
	<tr>
		<td width="66%" colspan="2">66%</td>
	</tr>
</table>
</li>

<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="50%" rowspan="2">50%</td>
		<td width="75%" colspan="2">50%</td>
	</tr>
	<tr>
		<td width="25%">25%</td>
		<td width="25%">25%</td>
		
	</tr>
</table>
</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="75%" colspan="2">50%</td>
		<td width="50%" rowspan="2">50%</td>
	</tr>
	<tr>
		<td width="25%">25%</td>
		<td width="25%">25%</td>
		
	</tr>
</table>
</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		<td width="33%" rowspan="2">33%</td>
		<td width="66%" colspan="2">66%</td>
	</tr>
	<tr>
		<td width="33%">33%</td>
		<td width="33%">33%</td>
		
	</tr>
</table>
</li>
<li class="ui-widget-content">
<table class="preview">
	<tr>
		
		<td width="66%" colspan="2">66%</td>
		<td width="33%" rowspan="2">33%</td>
	</tr>
	<tr>
		<td width="33%">33%</td>
		<td width="33%">33%</td>
	</tr>
</table>
</li>

</ol>
<center><form>
<input id="select-result" name="row_style" type="hidden" />
<input name="layout_id" value="<?php echo $_GET["layout_id"]; ?>" type="hidden" />
<input style="width:500px;text-align:center;font-size:13px;font-weight:bold" type='button' class='button' onclick='InsertRowtoLayout()' value='Insert' />
</form>
</center>
<script>
	jQuery(function() {
		jQuery( "#selectable" ).selectable({
			stop: function() {
				var result = jQuery( "#select-result" ).empty();
				jQuery( ".ui-selected", this ).each(function() {
					var index = jQuery( "#selectable li" ).index( this );
					result.val(( index + 1 ) );
				});
			}
		});
		jQuery( "#selectable" ).selectable( "option", "filter", 'li' );
	});
	jQuery( "#selectable" ).disableSelection();
	function InsertRowtoLayout(){
		var id= "<?php echo $_GET["layout_id"]; ?>";
		var style = jQuery( "#select-result" ).val();
		var win = window.dialogArguments || opener || parent || top;
		win.LayoutGetRow(id,style);
		win.tb_remove();
	}
	</script>
</body>
</html>