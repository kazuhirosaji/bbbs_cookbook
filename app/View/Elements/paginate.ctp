<p>
<?php 
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
?>
</p>
<div class="pagination">
	<ul>
	<li><?php echo $this->Paginator->prev('Prev', array(), null, array()); ?></li>
	<li><?php echo $this->Paginator->numbers(array('separator' => '')); ?></li>
	<li><?php echo $this->Paginator->next('Next', array(), null, array()); ?></li>
	</ul>
</div>
