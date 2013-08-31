var UniteSettingsBanner = new function(){
	
	var arrControls = {};
	var colorPicker;
	
	var t=this;
	
	this.getSettingsObject = function(formID){		
		var obj = new Object();
		var form = document.getElementById(formID);
		var name,value,type,flagUpdate;
		
		//Enabling all form items connected to mx
		for(var i=0; i<form.elements.length; i++){
			name = form.elements[i].name;		
			value = form.elements[i].value;
			type = form.elements[i].type;
			
			flagUpdate = true;
			switch(type){
				case "checkbox":
					value = form.elements[i].checked;
				break;
				case "radio":
					if(form.elements[i].checked == false) 
						flagUpdate = false;				
				break;
			}
			if(flagUpdate == true && name != undefined) obj[name] = value;
		}
		return(obj);
	}
	
	//On selects change - impiment the hide/show, enabled/disables functionality
	var onSettingChange = function(){

		var controlValue = this.value.toLowerCase();
		var controlName = this.name;		
		if(this.type=="checkbox") {
			controlValue = this.checked ? "true" : "false";
		}
		
		if(!arrControls[this.name]) return(false);
		
		jQuery(arrControls[this.name]).each(function(){						
			var childInput = document.getElementById(this.name);
			var childRow = document.getElementById(this.name + "_row");
			var value = this.value.toLowerCase();
			var isChildRadio = (childInput && childInput.tagName == "SPAN" && jQuery(childInput).hasClass("radio_wrapper"));				
			switch(this.type){
				case "enable":
				case "disable":	
					if(childInput){		//disable	
						if((this.type == "enable" && controlValue != this.value) || (this.type == "disable" && controlValue == this.value)){
							childRow.className = "disabled";
							if(childInput) {
								childInput.disabled = true;
								childInput.style.color = "";
							}														
							if(isChildRadio) {
								jQuery(childInput).children("input").prop("disabled","disabled").addClass("disabled");
							}
						} else {		   //enable
							childRow.className = "";						
							if(childInput) {
								childInput.disabled = false;
							}							
							if(isChildRadio) {
								jQuery(childInput).children("input").prop("disabled","").removeClass("disabled");
							}
							//Color the input again
							if(jQuery(childInput).hasClass("inputColorPicker")) g_picker.linkTo(childInput);							
		 				}
					}
				break;
				case "show":
					if(controlValue == this.value) jQuery(childRow).show();									
					else jQuery(childRow).hide();					
				break;
				case "hide":
					if(controlValue == this.value) jQuery(childRow).hide();									
					else jQuery(childRow).show();
				break;
			}
		});
	}
	
	
	//Combine controls to one object, and init control events.
	var initControls = function(){				
		//Combine controls
		for(key in g_settingsObj){
			var obj = g_settingsObj[key];			
			for(controlKey in obj.controls){
				arrControls[controlKey] = obj.controls[controlKey];				
			}
		}
		
		//Init events
		jQuery(".settings_wrapper select").change(onSettingChange);
		jQuery(".settings_wrapper input[type='radio']").change(onSettingChange);
		jQuery(".settings_wrapper input[type='checkbox']").change(onSettingChange);		
	}
	
	
	//Init color picker
	var initColorPicker = function(){
		var colorPickerWrapper = jQuery('#divColorPicker');
		
		colorPicker = jQuery.farbtastic('#divColorPicker');
		jQuery(".inputColorPicker").focus(function(){
			colorPicker.linkTo(this);
			colorPickerWrapper.show();
			var input = jQuery(this);
			var offset = input.offset();
			
			var offsetView = jQuery("#viewWrapper").offset();
			
			colorPickerWrapper.css({
				"left":offset.left + input.width()+20-offsetView.left,
				"top":offset.top - colorPickerWrapper.height() + 100-offsetView.top
			});

			
		}).click(function(){			
			return(false);	//Prevent body click
		});
		
		colorPickerWrapper.click(function(){
			return(false);	//Prevent body click
		});
		
		jQuery("body").click(function(){
			colorPickerWrapper.hide();
		});
	}
	
	//iPhone style checkbox
	var initIPhoneStyleCheckBox = function(){
		jQuery('.iphone_checkboxes').iphoneStyle({
			checkedLabel:'YES',
			uncheckedLabel:'NO'
		});
	}
	
	//Close all accordion items
	var closeAllAccordionItems = function(formID){
		jQuery("#"+formID+" .unite-postbox .inside").slideUp("fast");
		jQuery("#"+formID+" .unite-postbox h3").addClass("box_closed");
	}
	
	//Init side settings accordion - started from php
	t.initAccordion = function(formID){
		var classClosed = "box_closed";
		
		//Close all
		jQuery(".unite-postbox .inside").hide();
		jQuery(".unite-postbox h3").addClass(classClosed);
		
		//Open current
		jQuery(".unite-postbox:first-child .inside").show();
		jQuery(".unite-postbox:first-child h3").removeClass(classClosed);
			
		jQuery("#"+formID+" .unite-postbox h3").click(function(){
			var handle = jQuery(this);
			
			//Open
			if(handle.hasClass(classClosed)){
				closeAllAccordionItems(formID);
				handle.removeClass(classClosed).siblings(".inside").slideDown("fast");
			}else{	//Close
				handle.addClass(classClosed).siblings(".inside").slideUp("fast");
			}
			
		});
	}
	
	//Image search
	var initImageSearch = function(){
		
		jQuery(".button-image-select").click(function(){
			var settingID = this.id.replace("_button","");
			UniteAdminBanner.openAddImageDialog("Choose Image",function(urlImage){
				
				//Update input
				jQuery("#"+settingID).val(urlImage);
				
				//Update preview image
				var urlShowImage = UniteAdminBanner.getUrlShowImage(urlImage,100,70,true);
				jQuery("#" + settingID + "_button_preview").html("<img width='100' height='70' src='"+urlShowImage+"'></img>");
				
			});
		})
		
	}
	
	//Init the settings function, set the tootips on sidebars.
	var init = function(){		
		//Init tipsy
		jQuery(".list_settings li .setting_text").tipsy({
			gravity:"e",
	        delayIn: 70
		});		
		//Init controls
		initControls();		
		initColorPicker();
		initIPhoneStyleCheckBox();
		initImageSearch();
	}	
	
	
	//Call "constructor"
	jQuery(document).ready(function(){
		init();
	});
	
}


