<?php
header("Content-type: application/x-javascript");
include('../../../../../../wp-load.php');
?>
	jQuery(document).ready(function(){
		
		Admin.formbuilder.init();
		
	});

	var Admin = {}; //Stripped from Admin System
	var tinyMCE = false; //Placeholder until tinyMCE is loaded at end of DOM.
	Admin.formbuilder = {
		BASEURL: '<?php echo THEME_ADMIN_URI.'/interfaces/wonder-forms/'?>formbuilder.php',
		PREVIEWURL: '<?php echo THEME_ADMIN_URI.'/interfaces/wonder-forms/'?>preview.php',
		init: function()
		{
			Admin.formbuilder.layout('body');
			
		},
		layout: function(e)
		{
			var active_layout = jQuery(e);
			
			active_layout.find('form[id=""]').each(function(){
				jQuery(this).attr('id','f'+randomString(50)); //an ID for every form.
			});
			
			active_layout.find('.last-child').removeClass('last-child'); //meh, safety dance
			
			active_layout.find('ul,ol').each(function(){
				jQuery(this).children('li:last').addClass('last-child');
			});
			
			active_layout.children('li:last').addClass('last-child'); //incase the element itself is a ul or ol
			

			
			active_layout.find("#form_builder_toolbox li").click(function(){
					var into = jQuery("#form_builder_panel ol");
					var type = jQuery(this).attr('id');
					var e = this;
					jQuery(this).addClass('loading');
					jQuery.get(Admin.formbuilder.BASEURL+'?action=element&type='+type,function(result){
						jQuery(e).removeClass('loading');
						jQuery(into).append(result);
						var jQuerynewrow = jQuery(into).find('li:last');
						//style
						Admin.formbuilder.editors();
						Admin.formbuilder.properties(jQuerynewrow);
						Admin.formbuilder.layout(jQuerynewrow);
						//show
						jQuerynewrow.hide().slideDown('slow');
						jQuery(into).sortable("refresh");
						delete result;
					});
			});
			
			active_layout.find("#form_builder_panel ol").sortable({
				cursor: 'ns-resize',
				axis: 'y',
				handle: '.handle',
				start: function(e,ui) {
					jQuery('.wysiwyg').each(function(){
						var name = jQuery(this).attr('name');
						if (name) {
							if (tinyMCE.get(name)) {
								tinyMCE.execCommand('mceRemoveControl', false, name);
							}
						}
					});
				},
				stop: function(e,ui) {
					Admin.formbuilder.editors();
				}
			});
			
			active_layout.find('div.dialog').each(function(){
				
				jQuery.metadata.setType("class");
				var w = jQuery(this).metadata().w;
				var h = jQuery(this).metadata().h;
				
				jQuery(this).dialog({
					modal: true,
					zIndex: 400000, /* TinyMCE grief. Their default is literally 300000... Fail*/
					autoOpen: false,
					shadow: false,
					width: (w?parseInt(w, 10):400),
					height: (h?parseInt(h, 10):'auto'),
					title: jQuery(this).attr('title'),
					dragStart: function(event, ui) {
						jQuery(this).find('iframe').hide();
					},
					dragStop: function(event, ui) {
						jQuery(this).find('iframe').show();
					},
					resizeStart: function(event, ui) {
						jQuery(this).find('iframe').hide();
					},
					resizeStop: function(event, ui) {
						jQuery(this).find('iframe').show();
					}
				});
			});
			
			active_layout = null; //destroy
		},

		remove: function(e)
		{
			Admin.formbuilder.confirm("Really remove this element?",function(options){
				jQuery('label[for='+options.rel+']').parents('li').slideUp('slow',function(){
					jQuery(this).remove();
				});
			},{rel: jQuery(e).attr('rel')});
		},
		editors: function()
		{
			jQuery('.wysiwyg').each(function(){
				var name = jQuery(this).attr('name');
				if (name) {
					if (!tinyMCE.get(name)) tinyMCE.execCommand('mceAddControl', false, name);
				}
			});
		},
		// Loaded items need special attention
		property: function(id,title){
				jQuery('#form_builder_panel li.on').removeClass('on');
				jQuery('#'+id).parents('li:first').addClass('on');
				jQuery.get(Admin.formbuilder.BASEURL+'?action=properties&type='+title+'&id='+id,function(result){
					jQuery('#form_builder_properties').html(result);
					Admin.formbuilder.attr.get(id);
					Admin.formbuilder.layout('#form_builder_properties');
					jQuery('#form_builder_properties li *:input').keyup(function(){
						Admin.formbuilder.attr.update(this);
					});
					jQuery('#form_builder_properties li *:input').change(function(){
						Admin.formbuilder.attr.update(this);
						});
					jQuery('#form_builder_properties input:first').focus();
					delete result;
				});
				
				return false;
		},
		properties: function(e)
		{
		
			jQuery(e).find('a.properties').click(function(){
				jQuery('#form_builder_properties').html('<span class="icon loading">Loading...</span>');
				var id = jQuery(this).parents('label:first').attr('for');
				var title = jQuery(this).attr('rel');
				
				jQuery('#form_builder_panel li.on').removeClass('on');
				jQuery(this).parents('li:first').addClass('on');
				
				jQuery.get(Admin.formbuilder.BASEURL+'?action=properties&type='+title+'&id='+id,function(result){
					jQuery('#form_builder_properties').html(result);
					Admin.formbuilder.attr.get(id);
					Admin.formbuilder.layout('#form_builder_properties');
					jQuery('#form_builder_properties li *:input').keyup(function(){
						Admin.formbuilder.attr.update(this);
					});
					jQuery('#form_builder_properties li *:input').change(function(){
						Admin.formbuilder.attr.update(this);
						});
					jQuery('#form_builder_properties input:first').focus();
					delete result;
				});
				
				return false;
			});
		},
		attr: {
			get: function(id)
			{
				jQuery('.attrs.'+id+' input').each(function(){
					var val = jQuery(this).val();
					var klass = jQuery(this).attr('class');
					if (val) {
						switch (jQuery('#form_builder_properties input[name='+klass+']').attr('type'))
						{
						case 'text':
						jQuery('#form_builder_properties input[name='+klass+']').val(val);
						break;
						case 'checkbox':
						if (val) {
						jQuery('#form_builder_properties input[name=required]').attr('checked',true);
						jQuery('#form_builder_properties select[name=required_vars]').val(jQuery('div.'+id+' input.required_vars').val());
						}
						break;
						default:
						break;
						}
					}
				});
			},
			update: function(e)
			{
				var jQueryelement = jQuery(e);
				
				var name = jQueryelement.attr('name');
				var id = jQueryelement.parents('li:not(.sub):first').attr('class');
				var rel = jQueryelement.attr('rel');
				var value = jQueryelement.val();
				var type = jQueryelement.attr('class');
				
				var found = false;
				
				jQuery('div.attrs.'+id+' input').each(function(){
					if (jQuery(this).attr('name') == "properties["+id+"]["+name+"]")
					{
						jQuery(this).val(value);
						found = true;
						if (name=='required' && !jQuery('li.'+id+' input[name=required]:checked').length) {
							jQuery('div.attrs.'+id+' input.required').remove();
							jQuery('div.attrs.'+id+' input.required_vars').remove();
							jQuery('label[for='+id+'] a').removeClass('required_field');
							}
					}
				});
				
				if (!found) {
					jQuery('div.attrs.'+id).append("<input type='hidden' class='new_property "+name+"' name='properties["+id+"]["+name+"]'/>");
					jQuery('.new_property').removeClass('new_property').val(value);
					if (name=='required' && !jQuery('div.attrs.'+id+' input.required_vars').length) {
						jQuery('div.attrs.'+id).append("");
						}
					if (name=='required' && jQuery('li.'+id+' input[name=required]:checked').length) {
						jQuery('label[for='+id+'] a').addClass('required_field');
						}
				}
				
				switch (type)
				{
					case 'dropdown':
						value = value.split(';');
					break;
					case 'checkbox':
						value = value.split(';');
					break;
					case 'radio':
						value = value.split(';');
					break;
					default: break;
				}
				
				if (rel && value) {
					if (!jQuery.isArray(value)) {
						var block = jQuery(rel).not(':input').length;
						
						if (block == 0) jQuery(rel).val(value);
						else jQuery(rel).html(value);
					} else {
						//its an array, oh dear!
						switch (type)
						{
							case 'dropdown':
								var newc = '';
								for (i in value) newc += '<option>'+value[i]+'</option>';
								jQuery(rel).html(newc);
								break;
							case 'radio':
								var newc = '';
								for (i in value) newc += '<input type="radio" name="temp['+name+'][]"> '+value[i]+'<br/>';
								jQuery(rel).html(newc);
								break;
							case 'checkbox':
								var newc = '';
								for (i in value) newc += '<input type="checkbox" name="temp['+name+'][]"> '+value[i]+'<br/>';
								jQuery(rel).html(newc);
								break;
							default: break;
						}
					}
				}
			}
		},
		preview: function()
		{
			jQuery('textarea.wysiwyg').each(function(){
				var name = jQuery(this).attr('name');
				if (name) {
					var contents = tinyMCE.get(name).getContent();
				}
				jQuery(this).val(contents);
			});
			
			var data = jQuery('#form_builder_panel form').serialize();
			
			jQuery.post(Admin.formbuilder.PREVIEWURL,data,function(result){
				jQuery('#form_builder_preview').html(result);
				Admin.formbuilder.dialog('form_builder_preview');
			});
		},
		dialog: function(rel,link)
		{
			var external = jQuery("#"+rel).hasClass('external');
			if (external) {
				
				jQuery("#"+rel).show().html("<iframe src='"+link+"' name='"+rel+"' width='100%' height='100%' frameborder='0' border='0'></iframe>").dialog('open');
				return;
			}
			if (link) {
				if (link.indexOf('http') >= 0) {
					jQuery("#"+rel).html("");
					jQuery.get(link,function(result){
						jQuery("#"+rel).html(result).show().dialog('open');
						Admin.formbuilder.layout("#"+rel);
						delete result;
					});
					return;
				}
			}
			jQuery("#"+rel).show().dialog('open');
		},
		confirm: function(msg,callback,options)
		{
			var id = 'confirm_'+Math.ceil(100*Math.random());
			jQuery('body').append('<div id="'+id+'"><p></p></div>');
			jQuery('#'+id+' p').html(msg).dialog({
				modal: true,
				overlay: { 
					opacity: 0.5, 
					background: "black" 
				},
				title: 'Confirm',
				buttons: { 
					"Confirm": function() { 
						if (callback) callback(options);
						jQuery(this).dialog("close");
						jQuery(this).parents('div:first').remove();
					}, 
					"Cancel": function() {
						jQuery(this).dialog("close");
						jQuery(this).parents('div:first').remove();
					} 
				} 
			});
		}
	};
	function randomString(lengt)
	{
		var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
		var string_length = lengt;
		var randomstring = '';
		for (var i=0; i<string_length; i++) {
			var rnum = Math.floor(Math.random() * chars.length);
			randomstring += chars.substring(rnum,rnum+1);
		}
		return randomstring;
	}
