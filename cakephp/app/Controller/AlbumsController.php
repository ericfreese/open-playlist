<?php
class AlbumsController extends AppController {
	var $name = 'Albums';
	var $uses = array('Album', 'Genre');
	var $helpers = array('Time');
	var $components = array('ITunes');
	
	function index() {
		$options = array_merge(array(
			'type' => 'all',
			'filter' => false,
			'recursive' => -1,
			'order' => false,
			'limit' => 20,
			'offset' => 0
			
		), $this->request->query);
		
		// Set params
		$params = array(
			'recursive' => $options['recursive'],
			'limit' => $options['limit'],
			'offset' => $options['offset']
		);
		if ($options['order'] !== false) $params['order'] = $options['order'];
		
		// Set conditions
		$conditions = array();
		$params['conditions'] = $conditions;
		
		// Make the request
		$albums = $this->Album->find($options['type'], $params);
		$this->set('albums', $albums);
	}
	
	function view($id) {
		$album = $this->Album->find('first', array('conditions' => array('a_AlbumID' => $id)));
		if (!$album) throw new NotFoundException('Album does not exist');
		$this->set('album', $album);
	}
	
	function add() {
		if ($this->request->is('post') && !empty($this->request->data)) {
			// Save album, set the foreign key on each track, then save the tracks
			if ($this->Album->addAlbumWithTracks($this->request->data)) {
				$this->Session->setFlash(
					'The album was saved.',
					'flash_success',
					array(
						'link_text' => 'View now',
						'link_url' => array('controller' => 'albums', 'action' => 'view', $this->Album->id)
					), 'success'
				);
				$this->redirect(array('controller' => 'albums', 'action' => 'add'));
			}
			
			$this->set('data', $this->request->data);
		}
		
		$this->set('genres', $this->Genre->find('list', array('conditions' => array('g_TopLevel' => 1), 'order' => 'Genre.g_Name')));
	}
	
	function edit($id) {
		$this->Album->id = $id;
		
		if ($this->request->is('put')) {
			$this->set('data', $this->data);
			$this->Album->set($this->data['Album']);
			if ($this->Album->save()) {
				$this->Session->setFlash(
					'The album was saved.',
					'flash_success',
					array(
						'link_text' => 'View now',
						'link_url' => array('controller' => 'albums', 'action' => 'view', $this->Album->id)
					), 'success'
				);
				$this->redirect(array('controller' => 'albums', 'action' => 'edit', $id));
			}
		} else {
			$this->data = $this->Album->read();
		}
		
		$this->set('album', $this->Album->find('first', array('conditions' => array('Album.a_AlbumID' => $id))));
		$this->set('genres', $this->Genre->find('list', array('conditions' => array('g_TopLevel' => 1), 'order' => 'Genre.g_Name')));
	}
	
	function delete($id) {
		if ($this->Album->delete($id)) {
			$this->Session->setFlash('The album was successfully deleted.');
			$this->redirect(array('controller' => 'musiclibrary', 'action' => 'show'));
		}
	}
	
	function save() {
		if ($this->request->is('post')) {
			if ($this->Album->save($this->data)) {
				$this->Session->setFlash('The album was successfully saved.');
				$this->redirect(array('action' => 'view', $this->Album->id));
				return;
			}
		}
	}
}
?>
