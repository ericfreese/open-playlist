<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	var $helpers = array(
		// 'Auth',
		'Html',
		'Form',
		'Session',
		'TB' => array(
			'className' => 'TwitterBootstrap.TwitterBootstrap'
		)
	);
	
	var $components = array(
		'RequestHandler',
		'Session',
		//'DebugKit.Toolbar',
		'Crumb'
	);
	
	protected function api_index($model) {
		$params = array_merge(array(
			'limit' => 50,
			'offset' => 0,
			'recursive' => -1
		), $this->request->query);
		
		$this->set('data', array(
			'total' => $model->find('count', array_merge($params, array('limit' => null))),
			'limit' => $params['limit'],
			'offset' => $params['offset'],
			'response' => $model->find('all', $params)
		));
		
		$this->set('_serialize', 'data');
	}
	
	protected function api_view($model, $id) {
		$params = array_merge(array(
			'recursive' => -1
		), $this->request->query);
		
		$response = $model->find('first', array_merge($params, array('conditions' => array($model->primaryKey => $id))));
		if (!$response) throw new NotFoundException('Resource not found');
		
		$this->set('response', $response);
		$this->set('_serialize', 'response');
	}
	
	// function beforeFilter() {
	// 	$this->Auth->allow('*');
	// }
}
