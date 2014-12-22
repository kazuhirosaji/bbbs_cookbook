<?php echo $this->Form->create('Product', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Product'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('nation_id');
		echo $this->Form->input('description');
		echo $this->Form->input('link');
		echo $this->Form->input('file', array('type' => 'file', 'label' => '画像'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>