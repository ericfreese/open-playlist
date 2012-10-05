<div class="row-fluid">
	<div class="span4">
		<h2>Show Builder</h2>
		<p>DJ and show hosts</p>
		<?php echo $this->Html->link('Open Show Builder', array('controller' => 'show_builder', 'action' => 'index'), array('class' => 'btn btn-large')) ?>
	</div>
	<div class="span4">
		<h2>Schedule</h2>
		<p>Manage the schedule and enter show descriptions</p>
		<?php echo $this->Html->link('Open Schedule', array('controller' => 'schedule', 'action' => 'index'), array('class' => 'btn btn-large')) ?>
	</div>
	<div class="span4">
		<h2>Music Library</h2>
		<p>Manage KGNU's music library</p>
		<?php echo $this->Html->link('Open Music Library', array('controller' => 'music_library', 'action' => 'index'), array('class' => 'btn btn-large')) ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span4">
		<h2>Events</h2>
		<p>Add, modify, and activate/deactivate events (e.g. PSAs, Announcements, etc.)</p>
		<?php echo $this->Html->link('Open Events', array('controller' => 'events', 'action' => 'index'), array('class' => 'btn btn-large')) ?>
	</div>
	<div class="span4">
		<h2>Help</h2>
		<p>Get help with system features</p>
		<?php echo $this->Html->link('Open Help', array('controller' => 'help', 'action' => 'index'), array('class' => 'btn btn-large')) ?>
	</div>
</div>