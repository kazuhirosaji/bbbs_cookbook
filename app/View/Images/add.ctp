<div class="nations form">
<?php echo $this->Form->create('Image', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Image'); ?></legend>
	<?php
		echo $this->Form->input('file', array('type' => 'file', 'label' => '画像'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Nations'), array('controller' => 'nations', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
	</ul>
</div>
