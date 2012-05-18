<?php
class MusicLibraryController extends AppController {
	var $name = 'MusicLibrary';
	var $uses = array('Album', 'Track', 'Genre');
	var $helpers = array('Time', 'Html', 'Paginator');
	var $components = array('ITunes');
	var $paginate = array(
		'limit' => 20,
		'order' => array(
			'Album.a_AddDate' => 'desc'
		)
	);
	
	function catalog() {
		$this->set('albums', $this->paginate('Album'));
	}
	
	function add($from) {
		if ($from === 'manually') {
			if (!empty($this->data)) {
				$this->set('data', $this->data);
				$this->Album->set($this->data['Album']);
				if ($this->Album->save()) {
					$this->Session->setFlash(
						'The album was SAVED.',
						'flash_album_add_success',
						array(
							'link_text' => 'A link',
							'link_url' => array('controller' => 'albums', 'action' => 'view', $this->Album->id)
						), 'success'
					);
					$this->redirect(array('controller' => 'musiclibrary', 'action' => 'add', 'manually'));
				}
			}
		}
		
		$this->set('genres', $this->Genre->find('list', array('conditions' => array('g_TopLevel' => 1), 'order' => 'Genre.g_Name')));
		$this->set('from', $from);
	}
	
	function itunes_search() {
		if (isset($this->data['term'])) {
			$this->set('result', $this->ITunes->searchAlbums($this->data['term']));
		}
	}
	
	function itunes_view($itAlbumId) {
		if (!isset($itAlbumId)) $this->cakeError('error404');
		$itAlbumData = $this->ITunes->getAlbumById($itAlbumId);
		
		if (count($itAlbumData['results']) === 0) $this->cakeError('error404');
		
		$album = null;
		$tracks = array();
		foreach ($itAlbumData['results'] as $result) {
			if ($album === null && $result['wrapperType'] === 'collection') {
				$album = array(
					'id' => $result['collectionId'],
					'title' => $result['collectionName'],
					'artist' => $result['artistName'],
					'compilation' => $result['artistName'] === 'Various Artists',
					'albumArt' => $result['artworkUrl100'],
					'genre' => $result['primaryGenreName'],
					'trackCount' => $result['trackCount'],
					'copyright' => $result['copyright']
				);
			} elseif ($result['wrapperType'] === 'track') {
				// Get the album's disc count from the tracks
				if ($album !== null && !isset($album['discCount']) && isset($result['discCount'])) $album['discCount'] = $result['discCount'];
				
				$track = array(
					'name' => $result['trackName'],
					'previewUrl' => $result['previewUrl'],
					'discNumber' => $result['discNumber'],
					'trackNumber' => $result['trackNumber'],
					'duration' => round($result['trackTimeMillis'] / 1000)
				);
				
				if ($album['compilation']) $track['artist'] = $result['artistName'];
				
				array_push($tracks, $track);
			}
		}
		
		if ($album === null) $this->cakeError('error404');
		
		// Check if the album has already been imported
		$importedAlbum = $this->Album->find('first', array('conditions' => array('a_ITunesId' => $album['id'])));
		if ($importedAlbum) $this->set('importedAlbum', $importedAlbum);
		
		$this->set('iTunesData', $itAlbumData);
		$this->set('album', $album);
		$this->set('tracks', $tracks);
	}
	
	function itunes_import($itAlbumId) {
		App::import('Helper', 'Html'); // Import Html helper so that we can embed links in the Session Flash message.
		$html = new HtmlHelper();
		
		if (!isset($itAlbumId)) $this->cakeError('error404');
		$itAlbumData = $this->ITunes->getAlbumById($itAlbumId);
		
		if (count($itAlbumData['results']) === 0) $this->cakeError('error404');
		
		
		$data = array(
			'Tracks' => array()
		);
		foreach ($itAlbumData['results'] as $result) {
			if (!isset($data['Album']) && $result['wrapperType'] === 'collection') {
				// Try and find the genre
				$genre = $this->Genre->find('first', array('conditions' => array('Genre.g_Name' => $result['primaryGenreName'])));
				if (!$genre) $data['Genre'] = array('g_Name' => $result['primaryGenreName'], 'g_TopLevel' => 1);
				
				$data['Album'] = array(
					'a_Title' => $result['collectionName'],
					'a_Artist' => $result['artistName'],
					'a_Compilation' => $result['artistName'] === 'Various Artists',
					'a_GenreID' => $genre ? $genre['Genre']['g_GenreID'] : 0,
					'a_AlbumArt' => $result['artworkUrl100'],
					'a_ITunesId' => $result['collectionId']
				);
			} elseif ($result['wrapperType'] === 'track') {
				// Get the album's disc count from the tracks
				if (isset($data['Album']) && !isset($data['Album']['a_DiscCount']) && isset($result['discCount'])) $data['Album']['a_DiscCount'] = $result['discCount'];
				
				$track = array(
					't_Title' => $result['trackName'],
					't_DiskNumber' => $result['discNumber'],
					't_TrackNumber' => $result['trackNumber'],
					't_Duration' => round($result['trackTimeMillis'] / 1000)
				);
				
				if ($data['Album']['a_Compilation']) $track['t_Artist'] = $result['artistName'];
				
				array_push($data['Tracks'], $track);
			}
		}
		
		if (!isset($data['Album'])) $this->cakeError('error404');
		
		if (!$this->Album->saveAll($data)) {
			$this->Session->setFlash('Error inserting album.');
			$this->redirect(array('action' => 'album', $data['Album']['a_ITunes_Id']));
		} else {
			$this->Session->setFlash('The album "' . $data['Album']['a_Title'] . '" has been imported. ' . $html->link('Check it out', array('controller' => 'albums', 'action' => 'view', $this->Album->id)));
			$this->redirect(array('controller' => 'albums', 'action' => 'itunes_search'));
		}
		
		$this->Album->saveAll($data);
		
		$this->set('data', $data);
	}
}
?>
