<?php
App::import('Model', 'Event');
class PSAEvent extends Event {
	var $name = 'PSAEvent';
	
	var $actsAs = array('Inheritable' => array(
		'inheritanceField' => 'e_DISCRIMINATOR',
		'method' => 'STI'
	));
	
	var $belongsTo = array(
		'PSACategory' => array(
			'foreignKey' => 'e_PSACategoryId'
		)
	);
}
?>
