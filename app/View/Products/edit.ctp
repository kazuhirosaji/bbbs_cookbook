<div class="products form">
<?php echo $this->Form->create('Product', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Edit Product'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('nation_id');
		echo $this->Form->input('description');
		echo $this->Form->input('link');
		echo $this->Form->input('file', array('type' => 'file', 'label' => '画像'));
		$imagename = h($this->Form->value('Product.imagename'));
		if (strlen($imagename) > 0 && file_exists("./img/products/". $imagename )){
			echo $this->Html->image(h("products/". $imagename),  array('alt' => 'Image file'));
		}
	?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<p><?php echo __('Actions'); ?></p>
	<?php echo $this->Form->postLink(
			__('Delete this product'), 
			array('action' => 'delete', $this->Form->value('Product.id')),
			array('class' => 'btn btn-danger btn-mini'),
			__('Are you sure you want to delete this product?')
	);?>
</div>
