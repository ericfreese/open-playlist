<?php
class ScheduledEventsController extends AppController {
	var $name = 'ScheduledEvents';
	var $uses = array('ScheduledEvent', 'Event');
	
	function index() {
		$this->set('scheduledEvents', $this->ScheduledEvent->find('all'));
	}
}
?>
