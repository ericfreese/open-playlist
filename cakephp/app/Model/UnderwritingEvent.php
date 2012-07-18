<?php
App::import('Model', 'Event');
class UnderwritingEvent extends Event {
	var $name = 'UnderwritingEvent';
	
	var $actsAs = array('Inheritable' => array(
		'inheritanceField' => 'e_DISCRIMINATOR',
		'method' => 'STI'
	));
}
?>
