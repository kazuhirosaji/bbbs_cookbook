<div class="nations form">
<?php echo $this->Form->create('Nation'); ?>
	<fieldset>
		<legend><?php echo __('Edit Nation'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label' => 'Nation name'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<p><?php echo __('Actions'); ?></p>
	<?php echo $this->Form->postLink(
			__('Delete this nation'), 
			array('action' => 'delete', $this->Form->value('Nation.id')),
			array('class' => 'btn btn-danger btn-mini'),
			__('Are you sure you want to delete this nation?')
	);?>
</div>
