<?php
class TracksController extends AppController {
	var $name = 'Tracks';
	var $uses = array('Track', 'Album');
	
	function index() {
		$this->set('tracks', $this->Track->find('all'));
	}
	
	function view($id) {
		$track = $this->Track->find('first', array('conditions' => array('t_TrackID' => $id), 'recursive' => 2));
		if (!$track) throw new NotFoundException('Track does not exist');
		$this->set('track', $track);
	}
	
	function add($albumId) {
		// Make sure the album exists
		$album = $this->Album->find('first', array('conditions' => array('Album.a_AlbumID' => $albumId)));
		if (!$album) throw new NotFoundException();
		
		$this->set('album', $album);
		
		if ($this->request->is('post')) {
			$this->set('data', $this->data);
			$this->Track->set($this->data['Track']);
			if ($this->Track->save()) {
				$this->Session->setFlash(
					'The track was saved.',
					'flash_success',
					array(
						'link_text' => 'View now',
						'link_url' => array('controller' => 'tracks', 'action' => 'view', $this->Track->id)
					), 'success'
				);
				// $this->redirect(array('controller' => 'tracks', 'action' => 'add', $albumId));
			}
		}
	}
	
	function edit($id) {
		$this->Track->id = $id;
		
		if ($this->request->is('put')) {
			$this->set('data', $this->data);
			$this->Track->set($this->data['Track']);
			if ($this->Track->save()) {
				$this->Session->setFlash(
					'The track was saved.',
					'flash_success',
					array(
						'link_text' => 'View now',
						'link_url' => array('controller' => 'tracks', 'action' => 'view', $this->Track->id)
					), 'success'
				);
				$this->redirect(array('controller' => 'tracks', 'action' => 'edit', $id));
			}
		} else {
			$this->data = $this->Track->read();
		}
		
		$track = $this->Track->find('first', array('conditions' => array('Track.t_TrackID' => $id)));
		$album = $this->Album->find('first', array('conditions' => array('Album.a_AlbumID' => $track['Track']['t_AlbumID'])));
	
		$this->set('track', $track);
		$this->set('album', $album);
	}
	
	function delete($id) {
		$track = $this->Track->find('first', array('conditions' => array('Track.t_TrackID' => $id)));
		if (!$track) $this->cakeError('error404');
		if ($this->Track->delete($id)) {
			$this->Session->setFlash('The track was successfully deleted.');
			$this->redirect(array('controller' => 'albums', 'action' => 'view', $track['Track']['t_AlbumID']));
		}
	}
	
	function save() {
		if (!empty($this->data)) {
			if ($this->Track->save($this->data)) {
				$this->Session->setFlash('The Track was successfully saved.');
				$this->redirect(array('controller' => 'Albums', 'action' => 'view', $this->data['Track']['t_AlbumID']));
			}
		}
	}
}
?>
