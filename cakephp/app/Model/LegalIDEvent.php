<?php
App::import('Model', 'Event');
class LegalIDEvent extends Event {
	var $name = 'LegalIDEvent';
	
	var $actsAs = array('Inheritable' => array(
		'inheritanceField' => 'e_DISCRIMINATOR',
		'method' => 'STI'
	));
}
?>
