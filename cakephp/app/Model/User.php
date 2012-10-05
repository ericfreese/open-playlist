<?php
class User extends AppModel {
	public $name = 'User';
	
	var $useTable = 'Users';
	var $primaryKey = 'Id';
	var $displayField = 'Username';
	
	public $validate = array(
		'Username' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A username is required'
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'That username is already taken'
			)
		),
		'Password' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A password is required'
			)
		)
	);
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['Password'])) {
			$this->data[$this->alias]['Password'] = AuthComponent::password($this->data[$this->alias]['Password']);
		}
		return true;
	}
}