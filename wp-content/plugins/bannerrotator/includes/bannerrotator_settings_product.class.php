<?php
	class BannerRotatorSettingsProduct extends UniteSettingsBannerProductBanner {
		
		//Set custom values to settings
		public static function setSettingsCustomValues(UniteSettingsBanner $settings,$arrValues) {
			$arrSettings = $settings->getArrSettings();			
			foreach($arrSettings as $key=>$setting) {
				$type = UniteFunctionsBanner::getVal($setting, "type");
				if($type != UniteSettingsBanner::TYPE_CUSTOM)
					continue;
				$customType = UniteFunctionsBanner::getVal($setting, "custom_type");
				
				switch($customType){
					case "slider_size":
						$setting["width"] = UniteFunctionsBanner::getVal($arrValues, "width",UniteFunctionsBanner::getVal($setting,"width"));
						$setting["height"] = UniteFunctionsBanner::getVal($arrValues, "height",UniteFunctionsBanner::getVal($setting,"height"));
						$arrSettings[$key] = $setting;
					break;
					case "responsitive_settings":						
						$id = $setting["id"];
						$setting["w1"] = UniteFunctionsBanner::getVal($arrValues, $id."_w1",UniteFunctionsBanner::getVal($setting,"w1"));
						$setting["w2"] = UniteFunctionsBanner::getVal($arrValues, $id."_w2",UniteFunctionsBanner::getVal($setting,"w2"));
						$setting["w3"] = UniteFunctionsBanner::getVal($arrValues, $id."_w3",UniteFunctionsBanner::getVal($setting,"w3"));
						$setting["w4"] = UniteFunctionsBanner::getVal($arrValues, $id."_w4",UniteFunctionsBanner::getVal($setting,"w4"));
						$setting["w5"] = UniteFunctionsBanner::getVal($arrValues, $id."_w5",UniteFunctionsBanner::getVal($setting,"w5"));
						$setting["w6"] = UniteFunctionsBanner::getVal($arrValues, $id."_w6",UniteFunctionsBanner::getVal($setting,"w6"));
						
						$setting["sw1"] = UniteFunctionsBanner::getVal($arrValues, $id."_sw1",UniteFunctionsBanner::getVal($setting,"sw1"));
						$setting["sw2"] = UniteFunctionsBanner::getVal($arrValues, $id."_sw2",UniteFunctionsBanner::getVal($setting,"sw2"));
						$setting["sw3"] = UniteFunctionsBanner::getVal($arrValues, $id."_sw3",UniteFunctionsBanner::getVal($setting,"sw3"));
						$setting["sw4"] = UniteFunctionsBanner::getVal($arrValues, $id."_sw4",UniteFunctionsBanner::getVal($setting,"sw4"));
						$setting["sw5"] = UniteFunctionsBanner::getVal($arrValues, $id."_sw5",UniteFunctionsBanner::getVal($setting,"sw5"));
						$setting["sw6"] = UniteFunctionsBanner::getVal($arrValues, $id."_sw6",UniteFunctionsBanner::getVal($setting,"sw6"));
						$arrSettings[$key] = $setting;				
					break;
				}
			}
			
			$settings->setArrSettings($arrSettings);
			
			//Disable settings by slider type:
			$sliderType = $settings->getSettingValue("slider_type");
			
			switch($sliderType) {
				case "fixed":
				case "fullwidth":
					//Hide responsitive
					$settingRes = $settings->getSettingByName("responsitive");
					$settingRes["disabled"] = true;
					$settings->updateArrSettingByName("responsitive", $settingRes);
				break;
			}
			
			//Change height to max height
			if($sliderType == "fullwidth"){
				$settingSize = $settings->getSettingByName("slider_size");
				$settingSize["fullwidth_mode"] = true;
				$settings->updateArrSettingByName("slider_size", $settingSize);
			}
			
			return($settings);
		}
		
		//Draw responsitive settings value
		protected function drawResponsitiveSettings($setting){
			$id = $setting["id"];
			
			$w1 = UniteFunctionsBanner::getVal($setting, "w1");
			$w2 = UniteFunctionsBanner::getVal($setting, "w2");
			$w3 = UniteFunctionsBanner::getVal($setting, "w3");
			$w4 = UniteFunctionsBanner::getVal($setting, "w4");
			$w5 = UniteFunctionsBanner::getVal($setting, "w5");
			$w6 = UniteFunctionsBanner::getVal($setting, "w6");
			
			$sw1 = UniteFunctionsBanner::getVal($setting, "sw1");
			$sw2 = UniteFunctionsBanner::getVal($setting, "sw2");
			$sw3 = UniteFunctionsBanner::getVal($setting, "sw3");
			$sw4 = UniteFunctionsBanner::getVal($setting, "sw4");
			$sw5 = UniteFunctionsBanner::getVal($setting, "sw5");
			$sw6 = UniteFunctionsBanner::getVal($setting, "sw6");
			
			$disabled = (UniteFunctionsBanner::getVal($setting, "disabled") == true);
			
			$strDisabled = "";
			if($disabled == true)
				$strDisabled = "disabled='disabled'";			
			?>
			<table>
				<tr>
					<td>Screen Width1:</td>
					<td>
						<input id="<?php echo $id?>_w1" name="<?php echo $id?>_w1" type="text" class="small-text" <?php echo $strDisabled?> value="<?php echo $w1?>">
					</td>
					<td>Slider Width1:</td>
					<td>
						<input id="<?php echo $id?>_sw1" name="<?php echo $id?>_sw1" type="text" class="small-text" <?php echo $strDisabled?> value="<?php echo $sw1?>">
					</td>					
				</tr>
				<tr>
					<td>Screen Width2:</td>
					<td>
						<input id="<?php echo $id?>_w2" name="<?php echo $id?>_w2" type="text" class="small-text" <?php echo $strDisabled?> value="<?php echo $w2?>">
					</td>
					<td>Slider Width2:</td>
					<td>
						<input id="<?php echo $id?>_sw2" name="<?php echo $id?>_sw2" type="text" class="small-text" <?php echo $strDisabled?> value="<?php echo $sw2?>">
					</td>
				</tr>
				<tr>
					<td>Screen Width3:</td>
					<td>
						<input id="<?php echo $id?>_w3" name="<?php echo $id?>_w3" type="text" class="small-text" <?php echo $strDisabled?> value="<?php echo $w3?>">
					</td>
					<td>Slider Width3:</td>
					<td>
						<input id="<?php echo $id?>_sw3" name="<?php echo $id?>_sw3" type="text" class="small-text" <?php echo $strDisabled?> value="<?php echo $sw3?>">
					</td>
				</tr>
				<tr>
					<td>Screen Width4:</td>
					<td>
						<input type="text" id="<?php echo $id?>_w4" name="<?php echo $id?>_w4" class="small-text" <?php echo $strDisabled?> value="<?php echo $w4?>">
					</td>
					<td>Slider Width4:</td>
					<td>
						<input type="text" id="<?php echo $id?>_sw4" name="<?php echo $id?>_sw4" class="small-text" <?php echo $strDisabled?> value="<?php echo $sw4?>">
					</td>
				</tr>
				<tr>
					<td>Screen Width5:</td>
					<td>
						<input type="text" id="<?php echo $id?>_w5" name="<?php echo $id?>_w5" class="small-text" <?php echo $strDisabled?> value="<?php echo $w5?>">
					</td>
					<td>Slider Width5:</td>
					<td>
						<input type="text" id="<?php echo $id?>_sw5" name="<?php echo $id?>_sw5" class="small-text" <?php echo $strDisabled?> value="<?php echo $sw5?>">
					</td>
				</tr>
				<tr>
					<td>Screen Width6:</td>
					<td>
						<input type="text" id="<?php echo $id?>_w6" name="<?php echo $id?>_w6" class="small-text" <?php echo $strDisabled?> value="<?php echo $w6?>">
					</td>
					<td>Slider Width6:</td>
					<td>
						<input type="text" id="<?php echo $id?>_sw6" name="<?php echo $id?>_sw6" class="small-text" <?php echo $strDisabled?> value="<?php echo $sw6?>">
					</td>
				</tr>
			</table>
			<?php
		}		
		
		//Draw slider size
		protected function drawSliderSize($setting) {			
			$width = UniteFunctionsBanner::getVal($setting, "width");
			$height = UniteFunctionsBanner::getVal($setting, "height");
			
			$fullWidthMode = UniteFunctionsBanner::getVal($setting, "fullwidth_mode");
			?>			
			<table>
				<tr>
					<?php if($fullWidthMode):?>
					<td id="cellWidth">
						Grid Width:
					</td>
					<td id="cellWidthInput">
						<input id="width" name="width" type="text" class="small-text" value="<?php echo $width?>">
					</td>
					<td id="cellHeight">
						Slider Max Height: 
					</td>
					<td>
						<input id="height" name="height" type="text" class="small-text" value="<?php echo $height?>">
					</td>
					<?php else:?>
					<td id="cellWidth">
						Slider Width:
					</td>
					<td id="cellWidthInput">
						<input id="width" name="width" type="text" class="small-text" value="<?php echo $width?>">
					</td>
					<td id="cellHeight">
						Slider Height: 
					</td>
					<td>
						<input id="height" name="height" type="text" class="small-text" value="<?php echo $height?>">
					</td>					
					<?php endif?>					
				</tr>
			</table>
			
			<?php 
		}		
		
		//Draw custom inputs for banner rotator
		protected function drawCustomInputs($setting) {
			$disabled = (UniteFunctionsBanner::getVal($setting, "disabled") == true);
			$customType = UniteFunctionsBanner::getVal($setting, "custom_type");
			switch($customType){
				case "slider_size":
					$this->drawSliderSize($setting);
				break;
				case "responsitive_settings":
					$this->drawResponsitiveSettings($setting);
				break;
				default:
					UniteFunctionsBanner::throwError("No handler function for type: $customType");
				break;
			}			
		}
		
	}
?>