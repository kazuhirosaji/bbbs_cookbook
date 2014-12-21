<?php echo $this->Form->create('Nation'); ?>
	<fieldset>
		<legend><?php echo __('Add Nation'); ?></legend>
		<?php echo $this->Form->input('name', array('label' => 'Nation name')); ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>