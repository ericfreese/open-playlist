<?php
class ITunesController extends AppController {
	var $name = 'ITunes';
	var $uses = array('Album', 'Genre');
	var $helpers = array('Time');
	var $components = array('ITunes');
	
	function index() {
		$this->redirect(array('action' => 'search'));
	}
	
	function search() {
		if (isset($this->params->query['q'])) {
			$this->set('response', $this->ITunes->searchAlbums($this->params->query['q']));
		}
	}
	
	function import($itAlbumId) {
		$itAlbumData = $this->ITunes->getAlbumById($itAlbumId);
		if (count($itAlbumData['results']) === 0) throw new NotFoundException();
		
		$data = array(
			'Tracks' => array()
		);
		
		foreach ($itAlbumData['results'] as $result) {
			if (!isset($data['Album']) && $result['wrapperType'] === 'collection') {
				// Try and find the genre
				$genre = $this->Genre->find('first', array('conditions' => array('Genre.g_Name' => $result['primaryGenreName'])));
				
				$data['Album'] = array(
					'a_Title' => $result['collectionName'],
					'a_Compilation' => $result['collectionType'] == 'Compilation',
					'a_Artist' => $result['artistName'],
					'a_GenreID' => $genre ? $genre['Genre']['g_GenreID'] : 0,
					'a_AlbumArt' => $result['artworkUrl100'],
					'a_ITunesId' => $result['collectionId']
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
		
		if ($this->Album->addAlbumWithTracks($data)) {
			$this->Session->setFlash('Could not import album... ', 'flash_error', array('details' => print_r($data, true)."\n\n".print_r($this->Album->validationErrors, true)), 'error');
			$this->redirect(array('controller' => 'albums', 'action' => 'add'));
		} else {
			$this->Session->setFlash(
				'The album was imported.',
				'flash_success',
				array(
					'link_text' => 'Import another',
					'link_url' => array('controller' => 'itunes', 'action' => 'search')
				), 'success'
			);
			// $this->redirect(array('controller' => 'albums', 'action' => 'view', $this->Album->id));
		}
		
		// $this->Album->saveAll($data);
		// $this->set('data', $data);
	}
	
	function view($itAlbumId) {
		if (!isset($itAlbumId)) throw new NotFoundException();
		$itAlbumData = $this->ITunes->getAlbumById($itAlbumId);
		
		if (count($itAlbumData['results']) === 0) throw new NotFoundException();
		
		$album = null;
		$tracks = array();
		foreach ($itAlbumData['results'] as $result) {
			if ($album === null && $result['wrapperType'] === 'collection') {
				$album = array(
					'id' => $result['collectionId'],
					'title' => $result['collectionName'],
					'artist' => $result['artistName'],
					'albumArt' => $result['artworkUrl100'],
					'genre' => $result['primaryGenreName'],
					'trackCount' => $result['trackCount'],
					'copyright' => $result['copyright']
				);
			} elseif ($result['wrapperType'] === 'track') {
				// Get the album's disc count from the tracks
				if ($album !== null && !isset($album['discCount']) && isset($result['discCount'])) $album['discCount'] = $result['discCount'];
				
				array_push($tracks, array(
					'name' => $result['trackName'],
					'previewUrl' => $result['previewUrl'],
					'discNumber' => $result['discNumber'],
					'trackNumber' => $result['trackNumber'],
					'duration' => round($result['trackTimeMillis'] / 1000)
				));
			}
		}
		
		if ($album === null) throw new NotFoundException();
		
		// Check if the album has already been imported
		$importedAlbum = $this->Album->find('first', array('conditions' => array('a_ITunesId' => $album['id'])));
		if ($importedAlbum) $this->set('importedAlbum', $importedAlbum);
		
		$this->set('album', $album);
		$this->set('tracks', $tracks);
	}
}
?>
