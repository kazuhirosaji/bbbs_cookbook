<div class="products form">
<?php echo $this->Form->create('Product'); ?>
	<fieldset>
		<legend><?php echo __('Add Product'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('nation_id');
		echo $this->Form->input('description');
		echo $this->Form->input('link');
		echo $this->Form->input('image');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Products'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Nations'), array('controller' => 'nations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Nation'), array('controller' => 'nations', 'action' => 'add')); ?> </li>
	</ul>
</div>
