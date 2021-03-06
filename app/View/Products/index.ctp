<div class="row">
<div class="products index span12" >
	<h2><?php echo __('Products'); ?></h2>
	<table class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('nation_id'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('link'); ?></th>
			<th>image</th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($products as $product): ?>
	<tr>
		<td><?php echo h($product['Product']['id']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($product['Nation']['name'], array('controller' => 'nations', 'action' => 'view', $product['Nation']['id'])); ?>
		</td>
		<td><?php echo h($product['Product']['description']); ?>&nbsp;</td>
		<?php if (isset($product['Product']['link'])): ?>
			<td><?php echo $this->Html->link(__('page'), $product['Product']['link']) ?>&nbsp;</td>
		<?php else: ?>
			<td><?php echo "-" ?>&nbsp;</td>
		<?php endif ?>
		<?php
			$imagename = h($product['Product']['imagename']);
			if (strlen($imagename) > 0 && file_exists("./img/products/". $imagename )): 
		?>
			<td><?php echo $this->Html->image(h("products/". $product['Product']['imagename']), 
				array('alt' => 'Image file')); ?>&nbsp;</td>
		<?php else: ?>
			<td><?php echo $this->Html->image("NoImage.png", array('alt' => 'Image file')); ?>&nbsp;</td>
		<?php endif ?>

		<td><?php echo h($product['Product']['created']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['modified']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $product['Product']['id']), array('class' => 'btn btn-mini')); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $product['Product']['id']), array('class' => 'btn btn-mini')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $product['Product']['id']), array('class' => 'btn btn-mini'), __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<?php echo $this->element('paginate'); ?>
</div>
