<?php
class AlbumsController extends AppController {
	var $name = 'Albums';
	var $uses = array('Album', 'Genre');
	var $helpers = array('Time');
	var $components = array('ITunes');
	
	function index() {
		$albums = $this->Album->find('all');
		$this->set('albums', $albums);
	}
	
	function view($id) {
		debug($this->params['ext']);
		$album = $this->Album->find('first', array('conditions' => array('a_AlbumID' => $id)));
		if (!$album) throw new NotFoundException('Album does not exist');
		$this->set('album', $album);
	}
	
	function add() {
		if ($this->request->is('post') && !empty($this->request->data)) {
			if ($this->Album->saveAssociated($this->request->data)) {
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
	
	function addWithTracks() {
		if ($this->request->is('post') && !empty($this->request->data)) {
			if ($this->Album->saveAssociated($this->request->data)) {
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
