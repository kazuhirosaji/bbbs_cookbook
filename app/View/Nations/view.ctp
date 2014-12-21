<div class="nations view">
<h2><?php echo __('Nation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($nation['Nation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($nation['Nation']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<?php echo $this->Html->link(
			__('Edit this nation'),
			array('action' => 'edit', $nation['Nation']['id']),
			array('class' => 'btn btn-primary btn-mini')
	);?>
	<?php echo $this->Form->postLink(
			__('Delete this nation'),
			array('action' => 'delete', $nation['Nation']['id']),
			array('class' => 'btn btn-danger btn-mini'),
			__('Are you sure you want to delete this nation?')
	);?>
</div>

