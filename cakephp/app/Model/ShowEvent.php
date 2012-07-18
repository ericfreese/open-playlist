<?php
App::import('Model', 'Event');
class ShowEvent extends Event {
	var $name = 'ShowEvent';
	
	var $actsAs = array('Inheritable' => array(
		'inheritanceField' => 'e_DISCRIMINATOR',
		'method' => 'STI'
	));
	
	var $belongsTo = array(
		'Host' => array(
			'foreignKey' => 'e_HostId'
		)
	);
}
?>
