<?php
App::import('Model', 'Event');
class AnnouncementEvent extends Event {
	var $name = 'AnnouncementEvent';
	
	var $actsAs = array('Inheritable' => array(
		'inheritanceField' => 'e_DISCRIMINATOR',
		'method' => 'STI'
	));
}
?>
