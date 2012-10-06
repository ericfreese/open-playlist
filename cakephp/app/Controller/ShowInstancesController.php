<?php
class ShowInstancesController extends AppController {
	var $name = 'ShowInstances';
	var $uses = array('ScheduledShowInstance', 'ScheduledEvent', 'Host');
	
	function index() {
		$this->set('showInstances', $this->ScheduledShowInstance->find('all', array('order' => 'sei_StartDateTime DESC')));
	}
	
	// function view($id) {
	// 	$show = $this->ShowEvent->find('first', array('conditions' => array('e_Id' => $id)));
	// 	if (!$show) throw new NotFoundException('Show does not exist');
	// 	$this->set('show', $show);
	// }
	
	function add($scheduledEventId, $startDateTime) {
		$scheduledEvent = $this->ScheduledEvent->find('first', array('se_Id' => $scheduledEventId));
		if (!$scheduledEvent) throw new NotFoundException('Scheduled Event does not exist');
		
		if ($this->request->is('post')) {
			if ($this->ScheduledShowInstance->save($this->request->data)) {
				$this->Session->setFlash(
					'The show instance was saved.',
					'flash_success',
					array(
						'link_text' => 'View now',
						'link_url' => array('controller' => 'shows', 'action' => 'view', $this->ScheduledShowInstance->id)
					), 'success'
				);
				$this->redirect(array('controller' => 'show_instances', 'action' => 'index'));
			}
		}
		
		$this->data = array(
			'ScheduledShowInstance' => array(
				'sei_ScheduledEventId' => $scheduledEvent['ScheduledEvent']['se_Id'],
				'sei_StartDateTime' => $startDateTime,
				'sei_Duration' => $scheduledEvent['TimeInfo']['ti_Duration'],
				'sei_ShortDescription' => $scheduledEvent['Event']['e_ShortDescription'],
				'sei_LongDescription' => $scheduledEvent['Event']['e_LongDescription']
			)
		);
	}
	
	// function edit($id) {
	// 	if ($this->request->is('put')) {
	// 		if ($this->ShowEvent->save($this->request->data)) {
	// 			$this->Session->setFlash(
	// 				'The show was saved.',
	// 				'flash_success',
	// 				array(
	// 					'link_text' => 'View now',
	// 					'link_url' => array('controller' => 'shows', 'action' => 'view', $this->ShowEvent->id)
	// 				), 'success'
	// 			);
	// 		}
	// 	} else {
	// 		$this->ShowEvent->id = $id;
	// 		$this->data = $this->ShowEvent->read();
	// 	}
	// 	$this->set('hosts', $this->Host->find('list', array('conditions' => array('Active' => true))));
	// }
	
	function api_index() {
		parent::api_index($this->ShowEvent);
	}
	
	function api_view($id) {
		parent::api_view($this->ShowEvent, $id);
	}
}
?>
