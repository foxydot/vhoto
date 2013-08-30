<?php $api = "bannerapi".$sliderID;?>	
<div id="api_wrapper" class="api_wrapper" style="display:none;">	
	<div class="api-caption">API Methods:</div>
	<div class="api-desc">Please copy / paste those functions into your functions js file.</div>	
	<table class="api-table">
		<tr>
			<td class="api-cell1">Pause Slider:</td>
			<td class="api-cell2"><input type="text" readonly  class="api-input" value="<?php echo $api?>.brPause();"></td>
		</tr>
		<tr>
			<td class="api-cell1">Resume Slider:</td>
			<td class="api-cell2"><input type="text" readonly class="api-input" value="<?php echo $api?>.brResume();"></td>
		</tr>
		<tr>
			<td class="api-cell1">Previous Slide:</td>
			<td class="api-cell2"><input type="text" readonly class="api-input" value="<?php echo $api?>.brPrev();"></td>
		</tr>
		<tr>
			<td class="api-cell1">Next Slide:</td>
			<td class="api-cell2"><input type="text" readonly class="api-input" value="<?php echo $api?>.brNext();"></td>
		</tr>
		<tr>
			<td class="api-cell1">Get Total Slides:</td>
			<td class="api-cell2"><input type="text" readonly class="api-input" value="<?php echo $api?>.brMaxSlide();"></td>
		</tr>
		<tr>
			<td class="api-cell1">Go To Slide:</td>
			<td class="api-cell2"><input type="text" readonly class="api-input" value="<?php echo $api?>.brShowSlide(2);"></td>
		</tr>		
	</table>
	<br>
	<div class="api-caption">API Events:</div>
	<div class="api-desc">Copy / Paste all the textarea content into functions js file, then use what you want.</div>
	<textarea id="api_area" readonly>
<?php echo $api?>.bind("banner_rotator.onloaded", function (e,data) {
	//alert("rotator loaded");
});

<?php echo $api?>.bind("banner_rotator.onchange", function (e,data) {
	//alert("slide changed to: "+data.currentItem);
});

<?php echo $api?>.bind("banner_rotator.onpause", function(e,data) {
	//alert("timer paused");
});

<?php echo $api?>.bind("banner_rotator.onresume", function(e,data) {
	//alert("timer resume");
});

<?php echo $api?>.bind("banner_rotator.onvideoplay", function(e,data) {
	//alert("video play");
});

<?php echo $api?>.bind("banner_rotator.onvideostop", function(e,data) {
	//alert("video stopped");
});

<?php echo $api?>.bind("banner_rotator.onstop", function(e,data) {
	//alert("rotator stopped");
});

<?php echo $api?>.bind("banner_rotator.onbeforeswap", function(e,data) {
	//alert("swap slide started");
});

<?php echo $api?>.bind("banner_rotator.onafterswap", function(e,data) {
	//alert("swap slide complete");
});
		</textarea>
	</div>
