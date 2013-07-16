<?php
	
	define('BASEPATH','WHATEVER'); //used so dont have to edit CI libraries.
	
	include("lib/form_helper.php");
	
	
	
	$action = (isset($_GET['action'])) ? $_GET['action'] : null;
	
	switch ($action) {
		case 'properties':
			$fb->properties($_GET);
			break;
		case 'element':
			$fb->element($_GET);
			break;
		default:
			break;
	}
	
	/**
	* Filemanager
	*/
	class Formbuilder
	{
		/*
		Build is used to output the forms data as a html form
		$data is an array generated on post from the builder.
		*/
		function build($data)
		{
			if (!isset($data['properties'])) return false;
			$elements = $data['properties'];
			
			foreach ($elements as $k => $val)
			{
				if (!isset($data[$k])) $data[$k] = NULL;
				if (!isset($val['values'])) $val['values'] = NULL;
				
				$elements[$k]['content'] = $data[$k];
				
				$name = $k;
				
				switch ($val['type'])
				{
					case 'text': $elements[$k]['html'] = $data[$k]; break;
					case 'textarea':
						$elements[$k]['html'] = form_textarea(array(
							'id' => $name,
							'name' => $name,
							'rows' => 5,
							'cols' => 50,
							'value' => $data[$k],
							'class' => ((isset($val['required']))?'required'.((isset($val['required_vars']))?' '.$val['required_vars']:null):null)
						)); 
						break;
					case 'textbox': 
						$elements[$k]['html'] = form_input(array(
							'id' => $name,
							'name'=>$name,
							'value'=>$data[$k],
							'class' => ((isset($val['required']))?'required'.((isset($val['required_vars']))?' '.$val['required_vars']:null):null)
						));
						break;
					case 'dropdown': 
						if (!$val['values']) { unset($elements[$k]); break; }
						$options = explode(';',$val['values']);
						$options = array_combine($options, $options);
						if (empty($options)) { unset($elements[$k]); break; }
						
						$elements[$k]['html'] = form_dropdown($name,$options); 
						break;
					case 'checkbox':
						$input = null;
						
						if (!$val['values']) { unset($elements[$k]); break; }
						$options = explode(';',$val['values']);
						if (empty($options)) { unset($elements[$k]); break; }
						
						// For checkbox and radio, replaced foreach loop with for loop 
						// to allow $i to iterate and become key value for each div class 
						// while also iterating through $options
						// Best to extend each div check_x and rad_x classes from parent class
						// if more than one allottment of checkboxes or radios throughout website

						for ($i=0; $i<count($options); $i++) {
							$input .= '<div class="checkbox_'.$i.' checkboxes">'.form_checkbox( $name.'[]', $options[$i], FALSE, '', isset($val['required']) ).'<span>'.$options[$i].'</span></div>';
						}
						$elements[$k]['html'] = $input; 
						break;
					case 'radio':
						$input = null;
						
						if (!$val['values']) { unset($elements[$k]); break; }
						$options = explode(';',$val['values']);
						if (empty($options)) { unset($elements[$k]); break; }
						
						for ($i=0; $i<count($options); $i++) {
							$input .= '<div class="radio_'.$i.' radios">'.form_radio($name.'[]', $options[$i]).'<span>'.$options[$i].'</span></div>';
						}
						$elements[$k]['html'] = $input; 
						break;
					case 'datetime':
						$elements[$k]['html'] = form_input(array(
							'name'=>$name,
							'value'=>$data[$k],
							'class' => 'datepicker '.((isset($val['required']))?'required'.((isset($val['required_vars']))?'{'.$val['required_vars'].'}':null):null)
						));
						break;
					case 'fileupload':
						$elements[$k]['html'] = form_upload(array(
							'name'=>$name,
							'class' => ((isset($val['required']))?'required'.((isset($val['required_vars']))?'{'.$val['required_vars'].'}':null):null)
						));
						break;
					case 'button':
						$elements[$k]['html'] = form_input(array(
							'name'=>$name,
							'value'=>((isset($val['value']))?$val['value']:'Button'),
							'type'=>'button'
						));
						break;
				}
			}
			
			return $elements;
		}
		
		/*
		Element is generated and spat onscreen
		*/
		function element($attr)
		{
			$id = 'element_'.uniqid();
			switch($attr['type'])
			{
				case 'text': 
					$element = form_textarea(array(
						'class' => 'wysiwyg',
						'id' => $id,
						'name' => $id,
						'rows' => 5,
						'cols' => 50
					)); 
					break;
				case 'textarea':
					$element = form_textarea(array(
						'name' => $id,
						'rows' => 5,
						'cols' => 50
					)); 
					break;
				case 'textbox': $element = form_input($id); break;
				case 'dropdown': $element = form_dropdown($id,array(''=>'No Content')); break;
				case 'checkbox': $element = '<span class="values '.$id.'"><input type="checkbox"></span>'; break;
				case 'radio': $element = '<span class="values '.$id.'"><input type="radio"></span>'; break;
				case 'datetime': $element = form_input(array('name'=>$id,'class'=>'datepicker')); break;
				case 'fileupload': $element = form_upload($id); break;
				case 'button': $element = form_input(array('name'=>$id,'value'=>'No Content','type'=>'button')); break;
				default: $element = null; break;
			}
			
			//basic output list element.
			$editorlabel = (@trim($label) == "") ? 'No Label' : $label;
			$output = "
				<li>
				<label for='".$id."'><a href='#' rel='".$attr['type']."' class='properties tooltip' title='Edit'>".$editorlabel."</a></label>
					<div class='block'>
						<div class='handle'><span class='icon move'>Move</span></div>
						".$element."
						<span class='note ".$id."'></span>
					</div>
					<div class='clear'></div>
					<div class='attrs clear ".$id."'>
						<input type='hidden' name='properties[".$id."][type]' value='".$attr['type']."'/>
					</div>
				</li>
			";
			
			if ($element) {
				//set output to AJAX
				echo $output;
			}
		}
	function elements($attr,$ids)
		{
			$id = $ids;
			switch($attr['type'])
			{
				case 'text': 
					$element = form_textarea(array(
						'class' => 'wysiwyg',
						'id' => $id,
						'name' => $id,
						'rows' => 5,
						'cols' => 50
					)); 
					break;
				case 'textarea':
					$element = form_textarea(array(
						'name' => $id,
						'rows' => 5,
						'cols' => 50
					)); 
					break;
				case 'textbox': $element = form_input($id); break;
				case 'dropdown':  $values=explode(';',$attr[values]);$element =form_dropdown($id,$values); break;
				case 'checkbox': $element = '<span class="values '.$id.'">';$values=explode(';',$attr[values]); foreach($values as $value){ $element.='<input type="checkbox" name="temp[values][]">'.$value.'<br>';}$element.='</span>'; break;
				case 'radio': $element = '<span class="values '.$id.'">';$values=explode(';',$attr[values]); foreach($values as $value){ $element.='<input type="radio" name="temp[values][]">'.$value.'<br>';}$element.='</span>'; break;
				case 'datetime': $element = form_input(array('name'=>$id,'class'=>'datepicker')); break;
				case 'fileupload': $element = form_upload($id); break;
				case 'button': $element = form_input(array('name'=>$id,'value'=>'No Content','type'=>'button')); break;
				default: $element = null; break;
			}
			
			$editorlabel = (trim($attr['label']) == "") ? 'No Label' : $attr['label'];
			$output = "
				<li>
				<label for='".$id."'><a href='#' id='".$id."' rel='".$attr['type']."' class='properties tooltip' title='Edit'";
				$output.= ' onclick="Admin.formbuilder.property(\''.$id.'\',\''.$attr[type].'\');">';
				$output.= $editorlabel."</a></label>";
				$output.= "<div class='block'>
						<div class='handle'><span class='icon move'>Move</span></div>
						".$element."
						<span class='note ".$id."'></span>
					</div>
					<div class='clear'></div>
					<div class='attrs clear ".$id."'>
						<input type='hidden' name='properties[".$id."][type]' value='".$attr['type']."'/>
						<input value=\"".htmlentities($attr['label'])."\" class='label' name='properties[".$id."][label]' type='hidden'>";
						if($attr['values']){
						$output.="<input value=\"".htmlentities($attr['values'])."\" class='values' name='properties[".$id."][values]' type='hidden'>";	
						}
						if($attr['required']){
						$output.='<input value="1" class="required" name="properties['.$id.'][required]" type="hidden">';
						}
						if($attr['required_vars']){					
						$output.='<input value="'.$attr['required_vars'].'" class="required_vars" name="properties['.$id.'][required_vars]" type="hidden">';
						}
					$output.="</div>
				</li>
			";
			
			if ($element) {
				//set output to AJAX
				echo $output;
			}
		}
		/*
		Builds a list of properties for the builder to display.
		*/
		function properties($attr)
		{
			$output = null;
			
			$type = $attr['type'];
			$id = $attr['id'];
			
			//basic options
			$options = array(
				'Label' => form_input(array('rel'=>'label[for='.$id.'] a','name'=>'label')),
				'Required' => array(
					'Yes' => form_checkbox('required','1'),
					'Type' => form_dropdown('required_vars',array(''=>'Text','email'=>'Email','number'=>'Number'))
				),
				//'Description' => form_input(array('name'=>'description','rel'=>'.note[class~='.$id.']')),
			);
			
			$seperate_help = '<br/>Seperate multiple values with a semicolon;<br/>Eg: test;something;here';
			
			//specific options
			switch($type)
			{
				case 'dropdown':
					$options['Options'] = form_input(array('name'=>'values','class'=>'dropdown','rel'=>'select[name='.$id.']')).$seperate_help;
					break;
				case 'radio':
					$options['Options'] = form_input(array('name'=>'values','class'=>'radio','rel'=>'span.values[class~='.$id.']')).$seperate_help;
					break;
				case 'checkbox':
					$options['Options'] = form_input(array('name'=>'values','class'=>'checkbox','rel'=>'span.values[class~='.$id.']')).$seperate_help;
					break;
				case 'button':
					$options['Value'] = form_input(array('name'=>'value','class'=>'button','rel'=>'input[name='.$id.']'));
					($options['Required']); //useless
					break;
				case 'text':
					unset($options['Label']); //useless
					unset($options['Description']); //useless
					break;
				default: break;
			}
			
			//throw a delete on the bottom for good measure!
			$options['Delete'] = form_input(array('rel'=>$id,'name'=>'remove','value'=>'Delete Element','type'=>'button','onclick'=>'Admin.formbuilder.remove(this);'));
			
			//spit out the options for ajax
			foreach ($options as $k => $option) {
				$output .= '<li class="'.$id.'">';
				$output .= '<b>'.$k.'</b>: ';
				$output .= '<ul>';
						if (is_array($option)) {
							foreach ($option as $sk => $sub) {
								$output .= '<li class="sub"><b>'.$sk.'</b>: '.$sub.'</li>';
							}
						} else {
							$output .= '<li class="sub">'.$option.'</li>';
						}
				$output .= '</ul>';
				$output .= '</li>';
			}
			
			echo $output;
		}
	}
	
