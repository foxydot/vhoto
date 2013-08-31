var BannerRotatorAdmin = new function() {
	
		var t = this;
	
		//ınit "slider" view functionality
		var initSaveSliderButton = function(ajaxAction) {			
			jQuery("#button_save_slider").click(function() {					
					//Collect data
					var data = {
							params: UniteSettingsBanner.getSettingsObject("form_slider_params"),
							main: UniteSettingsBanner.getSettingsObject("form_slider_main")
						};
					
					//Add slider id to the data
					if(ajaxAction == "update_slider"){
						data.sliderid = jQuery("#sliderid").val();
						
						//Some ajax beautifyer
						UniteAdminBanner.setAjaxLoaderID("loader_update");
						UniteAdminBanner.setAjaxHideButtonID("button_save_slider");
						UniteAdminBanner.setSuccessMessageID("update_slider_success");
					}
					
					UniteAdminBanner.ajaxRequest(ajaxAction ,data);
			});		
		}
		
		//Skin radio input
		var skinRadioInput = function() {
			var arr = {};
			var ext = "rs-radiobtn-";
			
			var toggleChecked = function (radio, skin, checked) {
				radio.prop("checked", checked);
				skin.toggleClass(ext+"checked", checked);
			};
			
			var clearChecked = function(radio, skin) {
				var name = radio.attr("name");
				var obj = arr[name];
				var i = 0;	
				for (i=0; i<obj.length; i++) {
					if (obj[i]===skin) continue;
					obj[i].removeClass("rs-radiobtn-checked");
				}	
			};
			
			jQuery("input[type=radio].rs-radio").each(function() {
				var radio = jQuery(this);
				radio.hide();
				var checked = radio.is(":checked");
				var id = radio.attr("id");	
				var name = radio.attr("name");			
				var skin = jQuery("<span id='"+ext+id+"'>");
				skin.addClass("rs-radiobtn");
				var skin_inner = jQuery("<span class='inner' />");
				skin.append(skin_inner);
				skin.insertBefore(radio);
				arr.hasOwnProperty(name) || (arr[name] = []);
				arr[name].push(skin);			
				toggleChecked(radio, skin, checked);			
			});
			
			jQuery("input[type=radio].rs-radio").change(function(e) { 
				var radio = jQuery(this);
				var id = radio.attr("id");
				var skin = jQuery("span#"+ext+id);
				if (!skin) return;
				clearChecked(radio, skin);
				toggleChecked(radio, skin, radio.is(":checked"));
				if (cls = radio.data("class")) {
					jQuery("."+cls).removeClass("selected");
					jQuery("#"+radio.data("id")).addClass("selected");
				}
			});
			
			jQuery(".rs-radiobtn").click(function() {
				var skin = jQuery(this);
				var id = skin.attr("id").replace(ext, "");
				var radio = jQuery("#"+id);
				clearChecked(radio, skin);
				toggleChecked(radio, skin, true);
				radio.trigger("change");
			});
		};
		
		//Skin checkbox
		var skinCheckbox = function() {
			var ext = "rs-checkbox-";
			
			var toggleChecked = function (checkbox, skin, checked) {
				checkbox.prop("checked", checked);
				skin.toggleClass(ext+"checked", checked);
			};
			
			jQuery("input[type=checkbox].rs-check").each(function() {
				var checkbox = jQuery(this);
				if (checkbox.attr("id")) {
					checkbox.hide();
					var checked = checkbox.is(":checked");
					var id = checkbox.attr("id");	
					var name = checkbox.attr("name");	
					var skin = jQuery("<span id='"+ext+id+"'>");					
					skin.addClass("rs-checkbox");
					skin.insertBefore(checkbox);
					toggleChecked(checkbox, skin, checked);	
					var description = skin.parent().find(".description");
					description.addClass("rs-description");
				}
			});
			
			jQuery("input[type=checkbox].rs-check").change(function(e) { 
				var checkbox = $(this);
				var id = checkbox.attr("id");
				var skin = jQuery("span#"+ext+id);
				if (!skin) return;
				toggleChecked(checkbox, skin, checkbox.is(":checked"));
			});
			
			jQuery(".rs-checkbox").click(function() {			
				var skin = jQuery(this);
				var id = skin.attr("id").replace(ext, "");
				var checkbox = jQuery("#"+id);
				var checked = !checkbox.is(":checked");
				toggleChecked(checkbox, skin, checked);
				checkbox.trigger("change");
			});
		};
		
		//Update shortcode from alias value
		var updateShortcode = function() {
			var alias = jQuery("#alias").val();			
			var shortcode = "[banner_rotator "+alias+"]";
			if(alias == "")
				shortcode = "-- wrong alias -- ";
			jQuery("#shortcode").val(shortcode);
		}
		
		//Change fields of the slider view
		var enableSliderViewResponsitiveFields = function(enableRes,isMaxHeight) {			
			//Enable / disable responsitive fields
			if(enableRes){	
				jQuery("#responsitive_row").removeClass("disabled");
				jQuery("#responsitive_row input").prop("disabled","");
			} else {
				jQuery("#responsitive_row").addClass("disabled");
				jQuery("#responsitive_row input").prop("disabled","disabled");
			}
						
			if(isMaxHeight){
				jQuery("#cellWidth").html("Grid Width:");
				jQuery("#cellHeight").html("Slider Max Height:");
			} else {
				jQuery("#cellWidth").html("Slider Width:");
				jQuery("#cellHeight").html("Slider Height:");
			}			
		}		
		
		//Init slider view custom controls fields
		var initSliderViewCustomControls = function() {			
			//Responsitive
			jQuery("#slider_type_1").click(function() {
				enableSliderViewResponsitiveFields(true,false);
			});
			
			//Full width
			jQuery("#slider_type_2").click(function() {
				enableSliderViewResponsitiveFields(false,true);
			});
			
			//Fixed
			jQuery("#slider_type_3").click(function() {
				enableSliderViewResponsitiveFields(false,false);
			});
		}
		
		
		//Init "slider->add" view
		this.initAddSliderView = function() {
			jQuery("#title").focus();
			initSaveSliderButton("create_slider");
			initShortcode();
			initSliderViewCustomControls();
			skinRadioInput();
			skinCheckbox();
		}		
		
		//Init "slider->edit" view
		this.initEditSliderView = function() {			
			initShortcode();
			initSliderViewCustomControls();
			
			initSaveSliderButton("update_slider");		
			
			skinRadioInput();
			skinCheckbox();	
			
			//Delete slider action
			jQuery("#button_delete_slider").click(function() {
				
				if(confirm("Do you really want to delete '"+jQuery("#title").val()+"' ?") == false)
					return(true);
				
				var data = {sliderid: jQuery("#sliderid").val()}
				
				UniteAdminBanner.ajaxRequest("delete_slider" ,data);
			});			

			//API inputs functionality
			jQuery("#api_wrapper .api-input, #api_area").click(function() {
				jQuery(this).select().focus();
			});
			
			//API button functions
			jQuery("#link_show_api").click(function() {
				jQuery("#api_wrapper").show();
				jQuery("#link_show_api").addClass("button-selected");
				
				jQuery("#toolbox_wrapper").hide();
				jQuery("#link_show_toolbox").removeClass("button-selected");
			});
			
			jQuery("#link_show_toolbox").click(function() {
				jQuery("#toolbox_wrapper").show();
				jQuery("#link_show_toolbox").addClass("button-selected");
				
				jQuery("#api_wrapper").hide();
				jQuery("#link_show_api").removeClass("button-selected");
			});
						
			//Export slider action
			jQuery("#button_export_slider").click(function() {
				var sliderID = jQuery("#sliderid").val()
				var urlAjaxExport = ajaxurl+"?action="+g_uniteDirPlagin+"_ajax_action&client_action=export_slider";
				urlAjaxExport += "&sliderid=" + sliderID;
				location.href = urlAjaxExport;
			});
			
			//Preview slider actions
			jQuery("#button_preview_slider").click(function() {
				var sliderID = jQuery("#sliderid").val();
				openPreviewSliderDialog(sliderID);
			});
		}
		
		
		//Init shortcode functionality in the slider new and slider edit views
		var initShortcode = function() {			
			//Select shortcode text when click on it
			jQuery("#shortcode").focus(function() {				
				this.select();
			});
			jQuery("#shortcode").click(function() {				
				this.select();
			});
			
			//Update shortcode
			jQuery("#alias").change(function() {
				updateShortcode();
			});

			jQuery("#alias").keyup(function() {
				updateShortcode();
			});
		}
		
		
		//Update slides order
		var updateSlidesOrder = function(sliderID){
			var arrSlideHtmlIDs = jQuery( "#list_slides" ).sortable("toArray");
			
			//Get slide id's from html (li) id's
			var arrIDs = [];
			jQuery(arrSlideHtmlIDs).each(function(index,value){
				var slideID = value.replace("slidelist_item_","");
				arrIDs.push(slideID);
			});
			
			//Save order
			var data = {arrIDs:arrIDs,sliderID:sliderID};
			
			jQuery("#saving_indicator").show();
			UniteAdminBanner.ajaxRequest("update_slides_order" ,data,function() {
				jQuery("#saving_indicator").hide();
			});			
		}
		
		//Init "sliders list" view 
		this.initSlidersListView = function() {			
			jQuery(".button_delete_slider").click(function() {				
				var sliderID = this.id.replace("button_delete_","");
				var sliderTitle = jQuery("#slider_title_"+sliderID).text(); 
				if(confirm("Do you really want to delete '"+sliderTitle+"' ?") == false)
					return(false);
				
				UniteAdminBanner.ajaxRequest("delete_slider" ,{sliderid:sliderID});
			});
			
			//Duplicate slider action
			jQuery(".button_duplicate_slider").click(function() {
				var sliderID = this.id.replace("button_duplicate_","");
				UniteAdminBanner.ajaxRequest("duplicate_slider" ,{sliderid:sliderID});
			});
			
			//Preview slider action
			jQuery(".button_slider_preview").click(function() {					
				var sliderID = this.id.replace("button_preview_","");
				openPreviewSliderDialog(sliderID);
			});
			
		}
		
		//Open preview slider dialog
		var openPreviewSliderDialog = function(sliderID) {			
			jQuery("#dialog_preview_sliders").dialog({
				modal:true,
				resizable:false,
				minWidth:1100,
				minHeight:600,
				closeOnEscape:true,
				buttons:{
					"Close":function() {
						jQuery(this).dialog("close");
					}
				},
				open:function(event,ui){
					var form1 = jQuery("#form_preview")[0];
					jQuery("#preview_sliderid").val(sliderID);
					form1.action = g_urlAjaxActions;
					form1.submit();
				}
			});
			
		}
		
		//Init "slides list" view 
			this.initSlidesListView = function(sliderID) {			
			//Set the slides sortable, init save order
			jQuery("#list_slides").sortable({
					axis:"y",
					handle:'.col-handle',
					update:function() {updateSlidesOrder(sliderID)}
			});
			
			//New slide
			jQuery("#button_new_slide, #button_new_slide_top").click(function() {
				
				UniteAdminBanner.openAddImageDialog("Select Slide Image",function(urlImage){
					var data = {sliderid:sliderID,url_image:urlImage};
					UniteAdminBanner.ajaxRequest("add_slide" ,data);
				});	
			});
			
			//Duplicate slide
			jQuery(".button_duplicate_slide").click(function() {
				var slideID = this.id.replace("button_duplicate_slide_","");
				var data = {slideID:slideID,sliderID:sliderID};
				UniteAdminBanner.ajaxRequest("duplicate_slide" ,data);
			});
			
			//Delete single slide
			jQuery(".button_delete_slide").click(function() {
				var slideID = this.id.replace("button_delete_slide_","");
				var data = {slideID:slideID,sliderID:sliderID};
				if(confirm("Delete this slide?") == false)
					return(false);
				UniteAdminBanner.ajaxRequest("delete_slide" ,data);
			});
			
			//Change image
			jQuery(".col-image .slide_image").click(function() {
				var slideID = this.id.replace("slide_image_","");
				UniteAdminBanner.openAddImageDialog("Select Slide Image",function(urlImage){					
					var data = {slider_id:sliderID,slide_id:slideID,url_image:urlImage};
					UniteAdminBanner.ajaxRequest("change_slide_image" ,data);
				});
			});			
		}
		
		
		//Init "edit slide" view
		this.initEditSlideView = function(slideID) {
			skinRadioInput();
			skinCheckbox();
			
			//Save slide actions
			jQuery("#button_save_slide").click(function() {
				var layers = UniteLayersBanner.getLayers();
				
				if(JSON && JSON.stringify)
					layers = JSON.stringify(layers);
				
				var data = {
						slideid:slideID,
						params:UniteSettingsBanner.getSettingsObject("form_slide_params"),
						layers:layers
					};
				
				UniteAdminBanner.setAjaxHideButtonID("button_save_slide");
				UniteAdminBanner.setAjaxLoaderID("loader_update");
				UniteAdminBanner.setSuccessMessageID("update_slide_success");
				UniteAdminBanner.ajaxRequest("update_slide" ,data);
			});
			
			//Change image actions
			jQuery("#button_change_image").click(function() {
				
				UniteAdminBanner.openAddImageDialog("Select Slide Image",function(urlImage){
						//Set visual image 
						jQuery("#divLayers").css("background-image","url("+urlImage+")");
						
						//Update setting input
						jQuery("#image_url").val(urlImage);
					});
			});			
			
			//Slide options hide / show			
			jQuery("#link_hide_options").click(function() {				
				if(jQuery("#slide_params_holder").is(":visible") == true){
					jQuery("#slide_params_holder").hide("slow");
					jQuery(this).text("Show Slide Options").addClass("link-selected");
				}else{
					jQuery("#slide_params_holder").show("slow");
					jQuery(this).text("Hide Slide Options").removeClass("link-selected");
				}				
			});			
			
			//Preview slide actions - open preveiw dialog			
			jQuery("#button_preview_slide").click(function() {
				
				var iframePreview = jQuery("#frame_preview");
				var previewWidth = iframePreview.width() + 10;
				var previewHeight = iframePreview.height() + 10;
				var iframe = jQuery("#frame_preview");
				
				jQuery("#dialog_preview").dialog({
						modal:true,
						resizable:false,
						minWidth:previewWidth,
						minHeight:previewHeight,
						closeOnEscape:true,
						buttons:{
							"Close":function() {
								jQuery(this).dialog("close");
							}
						},
						open:function(event,ui){
							var form1 = jQuery("#form_preview")[0];
							
							var objData = {
									slideid:slideID,
									params:UniteSettingsBanner.getSettingsObject("form_slide_params"),
									layers:UniteLayersBanner.getLayers()
								};
							
							var jsonData = JSON.stringify(objData);
							
							jQuery("#preview_slide_data").val(jsonData);
							form1.action = g_urlAjaxActions;
							form1.client_action = "preview_slide";							
							form1.submit();													
						}
				});
				
			});
			
		}

}
