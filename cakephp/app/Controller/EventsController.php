<?php
class EventsController extends AppController {
	var $name = 'Events';
	var $uses = array('Event', 'Host');
	
	function index() {
	}
}
?>
