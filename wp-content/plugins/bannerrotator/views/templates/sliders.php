<?php
	$exampleID = '"slider1"';
	if(!empty($arrSliders)) {
		$exampleID = '"'.$arrSliders[0]->getAlias().'"';
	}
?>
<div class="wrap">
	<h2>Banner Rotators</h2>
	<br />
	<?php if(empty($arrSliders)) {?>
		No Sliders Found
		<br>
	<?php 
		} else {
			require self::getPathTemplate("sliders_list");	 		
		}
	?>	
	<br />
	<p>			
		<a class='button-primary' href='<?php echo $addNewLink?>'>Create New Slider</a>
	</p>	 
	<br />
	<h3>How To Use:</h3>		
	<ul>
		<li>
			* From the <b>theme html</b> use: <code>&lt?php putBannerRotator( "alias" ) ?&gt</code> example: <code>&lt?php putBannerRotator(<?echo $exampleID?>) ?&gt</code>
			<br>
			&nbsp;&nbsp; For show only on homepage use: <code>&lt?php putBannerRotator(<?echo $exampleID?>,"homepage") ?&gt</code>
			<br>&nbsp;&nbsp; For show on certain pages use: <code>&lt?php putBannerRotator(<?echo $exampleID?>,"2,10") ?&gt</code> 
		</li>
		<li>* From the <b>widgets panel</b> drag the "Banner Rotator" widget to the desired sidebar</li>
		<li>* From the <b>post editor</b> insert the shortcode from the sliders table</li>
	</ul>	
</div>
