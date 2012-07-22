<?php
class ScheduledEventsController extends AppController {
	var $name = 'ScheduledEvents';
	var $uses = array('ScheduledEvent', 'Event');
	
	function index() {
		$this->set('scheduledEvents', $this->ScheduledEvent->find('all'));
	}
	
	function api_index() {
		parent::api_index($this->ScheduledEvent);
	}
	
	function api_view($id) {
		parent::api_view($this->ScheduledEvent, $id);
	}
}
?>
