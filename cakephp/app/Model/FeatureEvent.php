<?php
App::import('Model', 'Event');
class FeatureEvent extends Event {
	var $name = 'FeatureEvent';
	
	var $actsAs = array('Inheritable' => array(
		'inheritanceField' => 'e_DISCRIMINATOR',
		'method' => 'STI'
	));
}
?>
