<div class="row-fluid">
	<div class="span12">
		<div class="page-header">
			<h1>Events Between <?php echo $this->Time->format('n/j/y h:i a', $start); ?> and <?php echo $this->Time->format('n/j/y h:i a', $end); ?></h1>
		</div>
		<?php foreach ($instances as $instance): ?>
		<div>
			<h2><?php echo $this->Html->link($instance['ScheduledEvent']['Event']['e_Title'], array('controller' => 'scheduled_events', 'action' => 'view', $instance['ScheduledEvent']['se_Id'])) ?></h2>
			<p><?php echo date('D, d M Y h:i a', $instance['ScheduledEventInstance']['sei_StartDateTime']) ?></p>
		</div>
		<?php endforeach; ?>
	</div>
</div>