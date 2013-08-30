<?php
	class UniteSettingsBannerProductBanner extends UniteSettingsOutputBanner {		
		
		//Draw text as input
		protected function drawTextInput($setting) {
			$disabled = "";
			$style="";
			$readonly = "";			
			if(isset($setting["style"])) $style = "style='".$setting["style"]."'";
			if(isset($setting["disabled"])) $disabled = 'disabled="disabled"';				
			if(isset($setting["readonly"])) $readonly = "readonly='readonly'";			
			$class = "regular-text";						
			if(isset($setting["class"]) && !empty($setting["class"])) {
				$class = $setting["class"];
								
				//Convert short classes
				switch($class){
					case "small":
						$class = "small-text";
						break;
					case "code":
						$class = "regular-text code";
						break;
				}
			}				
			if(!empty($class)) $class = "class='$class'";			
			?>
				<input type="text" <?php echo $class?> <?php echo $style?> <?php echo $disabled?><?php echo $readonly?> id="<?php echo $setting["id"]?>" name="<?php echo $setting["name"]?>" value="<?php echo $setting["value"]?>" />
			<?php
		}		
		
		//Draw image input
		protected function drawImageInput($setting) {			
			$class = UniteFunctionsBanner::getVal($setting, "class");			
			if(!empty($class)) $class = "class='$class'";			
			$settingsID = $setting["id"];			
			$buttonID = $settingsID."_button";			
			$spanPreviewID = $buttonID."_preview";			
			$img = "";
			$value = UniteFunctionsBanner::getVal($setting, "value");			
			if(!empty($value)) {
				$urlImage = $value;
				$imagePath = UniteFunctionsWPBanner::getImageRealPathFromUrl($urlImage);
				if(file_exists($realPath)){
					$filepath = UniteFunctionsWPBanner::getImagePathFromURL($urlImage);
					$urlImage = UniteBaseClassBanner::getImageUrl($filepath,100,70,true);
				}				
				$img = "<img width='100' height='70' src='$urlImage'></img>";
			}			
			?>
				<span id='<?php echo $spanPreviewID?>' class='setting-image-preview'><?php echo $img?></span>
				
				<input type="hidden" id="<?php echo $setting["id"]?>" name="<?php echo $setting["name"]?>" value="<?php echo $setting["value"]?>" />
				
				<input type="button" id="<?php echo $buttonID?>" class='button-image-select <?php echo $class?>' value="Choose Image"></input>
			<?php
		}		
		
		//Draw a color picker
		protected function drawColorPickerInput($setting) {			
			$bgcolor = $setting["value"];
			$bgcolor = str_replace("0x","#",$bgcolor);			
			//Set the forent color (by black and white value)
			$rgb = UniteFunctionsBanner::html2rgb($bgcolor);
			$bw = UniteFunctionsBanner::yiq($rgb[0],$rgb[1],$rgb[2]);
			$color = "#000000";
			if($bw<128) $color = "#ffffff";		
			$disabled = "";
			if(isset($setting["disabled"])){
				$color = "";
				$disabled = 'disabled="disabled"';
			}			
			$style="style='background-color:$bgcolor;color:$color'";			
			?>
				<input type="text" class="inputColorPicker" id="<?php echo $setting["id"]?>" <?php echo $style?> name="<?php echo $setting["name"]?>" value="<?php echo $bgcolor?>" <?php echo $disabled?>></input>
			<?php
		}
		
		//Draw setting input by type
		protected function drawInputs($setting) {
			switch($setting["type"]){
				case UniteSettingsBanner::TYPE_TEXT:
					$this->drawTextInput($setting);
					break;
				case UniteSettingsBanner::TYPE_COLOR:
					$this->drawColorPickerInput($setting);
					break;
				case UniteSettingsBanner::TYPE_SELECT:
					$this->drawSelectInput($setting);
					break;
				case UniteSettingsBanner::TYPE_CHECKBOX:
					$this->drawCheckboxInput($setting);
					break;
				case UniteSettingsBanner::TYPE_RADIO:
					$this->drawRadioInput($setting);
					break;
				case UniteSettingsBanner::TYPE_TEXTAREA:
					$this->drawTextAreaInput($setting);
					break;
				case UniteSettingsBanner::TYPE_ORDERBOX:
					$this->drawOrderbox($setting);
					break;
				case UniteSettingsBanner::TYPE_ORDERBOX_ADVANCED:
					$this->drawOrderbox_advanced($setting);
					break;
				case UniteSettingsBanner::TYPE_IMAGE:
					$this->drawImageInput($setting);
					break;
				case UniteSettingsBanner::TYPE_CUSTOM:
					if(method_exists($this,"drawCustomInputs") == false){
						UniteFunctionsBanner::throwError("Method don't exists: drawCustomInputs, please override the class");
					}
					$this->drawCustomInputs($setting);
					break;
				default:
					throw new Exception("wrong setting type - ".$setting["type"]);
					break;
			}			
		}	
		
		//Draw text area input		
		protected function drawTextAreaInput($setting) {			
			$disabled = "";
			if (isset($setting["disabled"])) $disabled = 'disabled="disabled"';			
			$style = "";
			if(isset($setting["style"])) $style = "style='".$setting["style"]."'";
			$rows = UniteFunctionsBanner::getVal($setting, "rows");
			if(!empty($rows)) $rows = "rows='$rows'";				
			$cols = UniteFunctionsBanner::getVal($setting, "cols");
			if(!empty($cols)) $cols = "cols='$cols'";			
			?>
				<textarea id="<?php echo $setting["id"]?>" name="<?php echo $setting["name"]?>" <?php echo $style?> <?php echo $disabled?> <?php echo $rows?> <?php echo $cols?>  ><?php echo $setting["value"]?></textarea>
			<?php
			if(!empty($cols))
				echo "<br>";	//break line on big textareas.
		}		
		
		//Draw radio input
		protected function drawRadioInput($setting) {
			$items = $setting["items"];
			$counter = 0;
			foreach($items as $value=>$text) {
				$counter++;
				$radioID = $setting["id"]."_".$counter;
				$checked = "";
				if($value == $setting["value"]) $checked = " checked"; 
				?>
					<input class="rs-radio" type="radio" id="<?php echo $radioID?>" value="<?php echo $value?>" name="<?php echo $setting["name"]?>" <?php echo $checked?>/>
					<label class="rs-radiolabel" for="<?php echo $radioID?>"><?php echo $text?></label>
					&nbsp; &nbsp;
				<?php				
			}
		}		
		
		//Draw checkbox
		protected function drawCheckboxInput($setting) {
			$checked = "";
			if($setting["value"] == true) $checked = 'checked="checked"';
			?>
				<input type="checkbox" id="<?php echo $setting["id"]?>" class="rs-check" name="<?php echo $setting["name"]?>" <?php echo $checked?>/>
			<?php
		}		
		
		//Draw select input
		protected function drawSelectInput($setting) {			
			$className = "";
			if(isset($this->arrControls[$setting["name"]])) $className = "control";
			$class = "";
			if($className != "") $class = "class='".$className."'";			
			$disabled = "";
			if(isset($setting["disabled"])) $disabled = 'disabled="disabled"';			
			?>
			<select id="<?php echo $setting["id"]?>" name="<?php echo $setting["name"]?>" <?php echo $disabled?> <?php echo $class?>>
			<?php			
			foreach($setting["items"] as $value=>$text) {
				$selected = "";
				if($value == $setting["value"]) $selected = 'selected="selected"';
				?>
					<option value="<?php echo $value?>" <?php echo $selected?>><?php echo $text?></option>
				<?php
			}
			?>
			</select>
			<?php
		}		
		
		//Draw text row
		protected function drawTextRow($setting) {			
			//Set cell style
			$cellStyle = "";
			if(isset($setting["padding"])) $cellStyle .= "padding-left:".$setting["padding"].";";				
			if(!empty($cellStyle)) $cellStyle="style='$cellStyle'";
							
			//Set style
			$rowStyle = "";					
			if(isset($setting["hidden"])) $rowStyle .= "display:none;";				
			if(!empty($rowStyle)) $rowStyle = "style='$rowStyle'";			
			?>
				<tr id="<?php echo $setting["id_row"]?>" <?php echo $rowStyle ?> valign="top">
					<td colspan="4" align="right" <?php echo $cellStyle?>>
						<span class="spanSettingsStaticText"><?php echo $setting["text"]?></span>
					</td>
				</tr>
			<?php 
		}
		
		//Draw hr row
		protected function drawHrRow($setting){
			//Set hidden
			$rowStyle = "";
			if(isset($setting["hidden"])) $rowStyle = "style='display:none;'";			
			$class = UniteFunctionsBanner::getVal($setting, "class");
			if(!empty($class)) $class = "class='$class'";			
			?>
			<tr id="<?php echo $setting["id_row"]?>" <?php echo $rowStyle ?>>
				<td colspan="4" align="left" style="text-align:left;">
					 <hr <?php echo $class; ?> /> 
				</td>
			</tr>
			<?php 
		}		
		
		//Draw settings row
		protected function drawSettingRow($setting) {		
			//Set cell style
			$cellStyle = "";
			if(isset($setting[UniteSettingsBanner::PARAM_CELLSTYLE])){
				$cellStyle .= $setting[UniteSettingsBanner::PARAM_CELLSTYLE];
			}
			
			//Set text style
			$textStyle = $cellStyle;
			if(isset($setting[UniteSettingsBanner::PARAM_TEXTSTYLE])){
				$textStyle .= $setting[UniteSettingsBanner::PARAM_TEXTSTYLE];
			}			
			if($textStyle != "") $textStyle = "style='".$textStyle."'";
			if($cellStyle != "") $cellStyle = "style='".$cellStyle."'";
			
			//Set hidden
			$rowStyle = "";
			if(isset($setting["hidden"])) $rowStyle = "display:none;";
			if(!empty($rowStyle)) $rowStyle = "style='$rowStyle'";
			
			//Set text class
			$class = "";
			if(isset($setting["disabled"])) $class = "class='disabled'";
			
			//Modify text
			$text = UniteFunctionsBanner::getVal($setting,"text","");				
			
			//Prevent line break (convert spaces to nbsp)
			$text = str_replace(" ","&nbsp;",$text);
			switch($setting["type"]){					
				case UniteSettingsBanner::TYPE_CHECKBOX:
					$text = "<label for='".$setting["id"]."' style='cursor:pointer;'>$text</label>";
					break;
			}			
			
			//Set settings text width
			$textWidth = "";
			if(isset($setting["textWidth"])) $textWidth = 'width="'.$setting["textWidth"].'"';			
			$description = UniteFunctionsBanner::getVal($setting, "description");
			$required = UniteFunctionsBanner::getVal($setting, "required");			
			?>
				<tr id="<?php echo $setting["id_row"]?>" <?php echo $rowStyle ?> <?php echo $class?> valign="top">
					<th <?php echo $textStyle?> scope="row" <?php echo $textWidth ?>>
						<?php echo $text?>:
					</th>
					<td <?php echo $cellStyle?>>
						<?php $this->drawInputs($setting);?>
						<?php if(!empty($required)):?>
							<span class='setting_required'>*</span>
						<?php endif?>											
						<?php if(!empty($description)):?>
							<span class="description"><?php echo $description?></span>
						<?php endif?>						
					</td>
				</tr>								
			<?php 
		}
		
		//Draw all settings
		public function drawSettings() {
			$this->drawHeaderIncludes();
			$this->prepareToDraw();
			
			//Draw main div
			$lastSectionKey = -1;
			$visibleSectionKey = 0;
			$lastSapKey = -1;			
			$arrSections = $this->settings->getArrSections();
			$arrSettings = $this->settings->getArrSettings();
			
			//Draw settings - simple
			if(empty($arrSections)):
					?><table class='form-table'><?php
					foreach($arrSettings as $key=>$setting) {
						switch($setting["type"]){
							case UniteSettingsBanner::TYPE_HR:
								$this->drawHrRow($setting);
								break;
							case UniteSettingsBanner::TYPE_STATIC_TEXT:
								$this->drawTextRow($setting);
								break;
							default:
								$this->drawSettingRow($setting);
								break;
						}
					}
					?></table><?php					
			else:			
				//Draw settings - advanced - with sections
				foreach($arrSettings as $key=>$setting):
								
					//Operate sections
					if(!empty($arrSections) && isset($setting["section"])){										
						$sectionKey = $setting["section"];												
						if($sectionKey != $lastSectionKey):	
							//New section					
							$arrSaps = $arrSections[$sectionKey]["arrSaps"];							
							if(!empty($arrSaps)){
								//Close sap
								if($lastSapKey != -1):
								?>
									</table>
									</div>
								<?php						
								endif;							
								$lastSapKey = -1;
							}							
					 		$style = ($visibleSectionKey == $sectionKey)?"":"style='display:none'";					 		
					 		
							//Close section
					 		if($sectionKey != 0) {
					 			if(empty($arrSaps))
					 				echo "</table>";
					 			echo "</div>\n";	 
							}					 		
					 		
							//If no saps - add table
							if(empty($arrSaps)) {
							?><table class="form-table"><?php
							}								
						endif;
						$lastSectionKey = $sectionKey;
					}
					//End section manage
					
					//Operate saps
					if(!empty($arrSaps) && isset($setting["sap"])) {				
						$sapKey = $setting["sap"];
						if($sapKey != $lastSapKey) {
							$sap = $this->settings->getSap($sapKey,$sectionKey);
														
							//Draw sap end					
							if($sapKey != 0){ ?>
							</table>
							<?php }
							
							//Set opened/closed states
							//$style = "style='display:none;'";
							$style = "";							
							$class = "divSapControl";							
							if($sapKey == 0 || isset($sap["opened"]) && $sap["opened"] == true) {
								$style = "";
								$class = "divSapControl opened";						
							}							
							?>
								<div id="divSapControl_<?php echo $sectionKey."_".$sapKey?>" class="<?php echo $class?>">									
									<h3><?php echo $sap["text"]?></h3>
								</div>
								<div id="divSap_<?php echo $sectionKey."_".$sapKey?>" class="divSap" <?php echo $style ?>>				
								<table class="form-table">
							<?php 
							$lastSapKey = $sapKey;
						}
					}
					//Saps manage
					
					//Draw row
					switch($setting["type"]){
						case UniteSettingsBanner::TYPE_HR:
							$this->drawHrRow($setting);
							break;
						case UniteSettingsBanner::TYPE_STATIC_TEXT:
							$this->drawTextRow($setting);
							break;
						default:
							$this->drawSettingRow($setting);
							break;
					}					
				endforeach;
			endif;	
			 ?>
			</table>
			
			<?php
			if(!empty($arrSections)) {
				if(empty($arrSaps))	 //close table settings if no saps 
					echo "</table>";
				echo "</div>\n";	 //close last section div
			}			
		}		
		
		//Draw sections menu
		public function drawSections($activeSection=0) {
			if(!empty($this->arrSections)) {
				echo "<ul class='listSections' >";
				for($i=0;$i<count($this->arrSections);$i++):
					$class = "";
					if($activeSection == $i) $class="class='selected'";
					$text = $this->arrSections[$i]["text"];
					echo '<li '.$class.'><a onfocus="this.blur()" href="#'.($i+1).'"><div>'.$text.'</div></a></li>';
				endfor;
				echo "</ul>";
			}
				
			//Call custom draw function:
			if($this->customFunction_afterSections) call_user_func($this->customFunction_afterSections);
		}
		
		//Draw settings function
		//@param $drawForm draw the form yes / no
		public function draw($formID=null,$drawForm = false) {
			if(empty($formID))
				UniteFunctionsBanner::throwError("The form ID can't be empty. you must provide it");
				
				$this->formID = $formID;				
			?>
				<div class="settings_wrapper unite_settings_wide">
			<?php
			
			if($drawForm == true) {
				?>
				<form name="<?php echo $formID?>" id="<?php echo $formID?>">
					<?php $this->drawSettings() ?>
				</form>
				<?php 				
			} else {
				$this->drawSettings();
			}
			?>
			</div>
			<?php 
		}
		
	}
?>