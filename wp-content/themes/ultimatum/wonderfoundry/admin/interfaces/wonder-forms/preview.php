<?php
	include('formbuilder.php');
	$items = $fb->build($_POST);
	if ($items):
?>
<form class="fancy">
	<fieldset>
		<legend>Form Preview</legend>
		<ol>
			<?php foreach($items as $k => $item): ?>
			<li>
				<?php if ($item['type'] != 'text'): ?>
					<label for='<?=$k?>'><?=((isset($item['label']))?$item['label']:'No Label')?></label>
					<div class='block <?=$k?>'>
				<?php endif; ?>
						<?=((isset($item['html']))?$item['html']:NULL)?>
						<?php if (isset($item['description'])): ?>
							<span class='note'><?=$item['description']?></span>
						<?php endif; ?>
				<?php if ($item['type'] != 'text'): ?>
					</div>
				<?php endif; ?>
			</li>
			<?php endforeach; ?>
		</ol>
	</fieldset>
</form>
	
<?php else: ?>
	<div class='warning'>No elements in form!</div>
<?php endif;?>