<div class="nations">
	<h2><?php echo __('Nations'); ?></h2>
	<table class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($nations as $nation): ?>
	<tr>
		<td><?php echo h($nation['Nation']['id']); ?>&nbsp;</td>
		<td><?php echo h($nation['Nation']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $nation['Nation']['id']), array('class' => 'btn btn-mini')); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $nation['Nation']['id']), array('class' => 'btn btn-mini')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $nation['Nation']['id']), array('class' => 'btn btn-mini'), __('Are you sure you want to delete # %s?', $nation['Nation']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>

<h3><?php echo __('Pagenate'); ?></h3>
<?php echo $this->element('paginate'); ?>
