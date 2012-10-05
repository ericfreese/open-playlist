<?php
class EventsBetweenController extends AppController {
	var $name = 'EventsBetween';
	var $uses = array('ScheduledEvent', 'ScheduledEventInstance');
	var $helpers = array('Time');
	
	protected function _getEventInstances($start, $end) {
		// Get scheduled events
		$scheduledEvents = $this->ScheduledEvent->findBetween($start, $end);
		
		// Generate instances from scheduled events
		$scheduledEventInstancesFromScheduledEvents = $this->ScheduledEvent->getInstancesBetween($scheduledEvents, $start, $end);
		
		return $scheduledEventInstancesFromScheduledEvents;
	}
	
	function index() {
		$start = isset($this->request->query['start']) ? $this->request->query['start'] : time();
		$end = isset($this->request->query['end']) ? $this->request->query['end'] : $start + 7 * 24 * 60 * 60;
		
		// Get events
		$instances = $this->_getEventInstances($start, $end);
		
		// Sort the instances
		$startDateTimes = array();
		foreach ($instances as $key => $value) {
			$startDateTimes[$key] = $value['ScheduledEventInstance']['sei_StartDateTime'];
		}
		array_multisort($startDateTimes, SORT_ASC, $instances);
		
		$this->set('start', $start);
		$this->set('end', $end);
		$this->set('instances', $instances);
		
	}
	
	function api_index() {
		$start = isset($this->request->query['start']) ? $this->request->query['start'] : time();
		$end = isset($this->request->query['end']) ? $this->request->query['end'] : $start + 7 * 24 * 60 * 60;
		
		// Get scheduled events
		$instances = $this->_getEventInstances($start, $end);
		
		$this->set('data', array(
			'response' => $instances
		));
		$this->set('_serialize', 'data');
	}
}
?>
