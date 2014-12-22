<div class="products view">
<h2><?php echo __('Product'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($product['Product']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($product['Product']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nation'); ?></dt>
		<dd>
			<?php echo $this->Html->link($product['Nation']['name'], array('controller' => 'nations', 'action' => 'view', $product['Nation']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($product['Product']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Link'); ?></dt>
		<dd>
			<?php echo h($product['Product']['link']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php
				$imagename = h($product['Product']['imagename']);
				if (strlen($imagename) > 0 && file_exists("./img/products/". $imagename )): 
			?>
				<td><?php echo $this->Html->image(h("products/". $product['Product']['imagename']), 
					array('alt' => 'Image file')); ?>&nbsp;</td>
			<?php else: ?>
				<td><?php echo $this->Html->image("NoImage.png", array('alt' => 'Image file')); ?>&nbsp;</td>
			<?php endif ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($product['Product']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($product['Product']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<p><?php echo __('Actions'); ?></p>
	<?php echo $this->Html->link(
			__('Edit this product'),
			array('action' => 'edit', $product['Product']['id']),
			array('class' => 'btn btn-primary btn-mini')
	);?>
	<?php echo $this->Form->postLink(
			__('Delete this product'),
			array('action' => 'delete', $product['Product']['id']),
			array('class' => 'btn btn-danger btn-mini'),
			__('Are you sure you want to delete this product?')
	);?>
</div>
