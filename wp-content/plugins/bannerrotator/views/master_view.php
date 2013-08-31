<?php global $bannerRotatorVersion;?>
<script type="text/javascript">
	var g_uniteDirPlagin = "<?php echo self::$dir_plugin?>";
	var g_urlContent = "<?php echo UniteFunctionsWPBanner::getUrlContent()?>";
	var g_urlAjaxShowImage = "<?php echo UniteBaseClassBanner::$url_ajax_showimage?>";
	var g_urlAjaxActions = "<?php echo UniteBaseClassBanner::$url_ajax_actions?>";
	var g_settingsObj = {};	
</script>
<div id="div_debug"></div>
<div class='unite_error_message' id="error_message" style="display:none;"></div>
<div class='unite_success_message' id="success_message" style="display:none;"></div>
<div id="viewWrapper" class="view_wrapper">
	<?php self::requireView($view);?>
</div>
<div id="divColorPicker" style="display:none;"></div>
<?php self::requireView("system/video_dialog")?>
<p>&nbsp;</p>
<div class="plugin-version">
	Copyright &copy; <a href="http://www.codegrape.com/user/flashblue" target="_blank">flashblue</a> Version <?php echo $bannerRotatorVersion?>
</div>


