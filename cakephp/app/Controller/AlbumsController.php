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
		if ($this->request->is('put') && !empty($this->request->data)) {
			// Importing from iTunes
			if (isset($this->request->data['iTunesAlbumId'])) {
				// Fetch the data from iTunes
				$itAlbumData = $this->ITunes->getAlbumById($this->request->data['iTunesAlbumId']);
				if (count($itAlbumData['results']) === 0) throw new NotFoundException();
				
				$data = array(
					'Tracks' => array()
				);
				
				foreach ($itAlbumData['results'] as $result) {
					if (!isset($data['Album']) && $result['wrapperType'] === 'collection') {
						// Try and find the genre
						$genre = $this->Genre->find('first', array(
							'conditions' => array('Genre.g_Name' => $result['primaryGenreName'], 'g_TopLevel' => 1)
						));
						
						$data['Album'] = array(
							'a_Title' => $result['collectionName'],
							'a_Compilation' => $result['collectionType'] == 'Compilation' || $result['artistName'] === 'Various Artists',
							'a_Artist' => $result['artistName'],
							'a_Label' => '',
							'a_GenreID' => $genre ? $genre['Genre']['g_GenreID'] : '',
							'a_AlbumArt' => $result['artworkUrl100'],
							'a_ITunesId' => $result['collectionId'],
							'a_Location' => 'Gnu Bin'
						);
					} elseif ($result['wrapperType'] === 'track') {
						// Get the album's disc count from the tracks
						if (isset($data['Album']) && !isset($data['Album']['a_DiscCount']) && isset($result['discCount'])) {
							$data['Album']['a_DiscCount'] = $result['discCount'];
						}
						
						$track = array(
							't_Title' => $result['trackName'],
							't_Artist' => $result['artistName'],
							't_DiskNumber' => $result['discNumber'],
							't_TrackNumber' => $result['trackNumber'],
							't_Duration' => round($result['trackTimeMillis'] / 1000),
							't_ITunesPreviewUrl' => $result['previewUrl']
						);
						
						array_push($data['Tracks'], $track);
					}
				}
				
				if (!$data['Album']['a_Compilation']) {
					foreach ($data['Tracks'] as $key => $value) {
						unset($data['Tracks'][$key]['t_Artist']);
					}
				}
				
				$this->request->data = $data;
			}
			
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
				$this->redirect($this->referer());
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
			$this->redirect(array('controller' => 'musiclibrary', 'action' => 'catalog'));
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
