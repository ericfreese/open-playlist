<?php
App::import('Model', 'ScheduledEventInstance');
class ScheduledShowInstance extends ScheduledEventInstance {
	var $name = 'ScheduledShowInstance';
	
	var $actsAs = array('Inheritable' => array(
		'inheritanceField' => 'sei_DISCRIMINATOR',
		'method' => 'STI',
		'fields' => array(
			'sei_Id',
			'sei_ScheduledEventId',
			'sei_StartDateTime',
			'sei_Duration',
			'sei_HostId',
			'sei_ShortDescription',
			'sei_LongDescription',
			'sei_RecordedFileName'
		)
	));
	
	var $belongsTo = array(
		'ScheduledEvent' => array(
			'foreignKey' => 'sei_ScheduledEventId'
		)
	);
}
?>
