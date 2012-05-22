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
		$this->Crumb->saveCrumb('iTunes Search', $this->request);
		
		if (isset($this->params->query['q']) && $this->params->query['q'] !== '') {
			$albums = $this->ITunes->searchAlbums($this->params->query['q']);
			
			$iTunesIds = array();
			foreach ($albums['results'] as $album) {
				array_push($iTunesIds, $album['collectionId']);
			}
			
			$localAlbums = $this->Album->find('list', array(
				'conditions' => array('Album.a_ITunesId' => $iTunesIds),
				'fields' => array('Album.a_AlbumID', 'Album.a_AddDate', 'Album.a_ITunesId')
			));
			
			foreach ($albums['results'] as $key => $album) {
				if (isset($localAlbums[$album['collectionId']])) {
					$id = array_keys($localAlbums[$album['collectionId']]);
					$addDate = array_values($localAlbums[$album['collectionId']]);
					
					$albums['results'][$key]['localId'] = $id[0];
					$albums['results'][$key]['localAddDate'] = $addDate[0];
				}
			}
			
			$this->set('response', $albums);
		}
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
					'copyright' => $result['copyright'],
					'compilation' => $result['collectionType'] == 'Compilation' || $result['artistName'] === 'Various Artists'
				);
			} elseif ($result['wrapperType'] === 'track') {
				array_push($tracks, array(
					'name' => $result['trackName'],
					'artistName' => $result['artistName'],
					'previewUrl' => $result['previewUrl'],
					'discNumber' => $result['discNumber'],
					'trackNumber' => $result['trackNumber'],
					'duration' => round($result['trackTimeMillis'] / 1000)
				));
			}
		}
		
		if ($album === null) throw new NotFoundException();
		
		// Check if the album has already been imported
		if ($localAlbum = $this->Album->find('first', array(
			'conditions' => array('a_ITunesId' => $album['id']),
			'recursive' => -1
		))) $this->set('localAlbum', $localAlbum);
		
		$this->Crumb->saveCrumb(($localAlbum ? $localAlbum['Album']['a_Title'] : $album['title']), $this->request);
		
		$this->set('album', $album);
		$this->set('tracks', $tracks);
	}
	
	function doctor() {
		$albums = $this->Album->find('all', array(
			'conditions' => array( 
				'SUBSTRING(a_AlbumArt, 1, 7)=\'http://\'',
				'a_ITunesId' => null
			),
			'recursive' => -1,
			'limit' => 50,
			// 'fields' => array('a_Title', 'a_AlbumArt', 'a_AlbumID')
		));
		
		foreach ($albums as $key => $album) {
			$keywords = $album['Album']['a_Title'].(!empty($album['Album']['a_Artist']) ? ' '.$album['Album']['a_Artist'] : '');
			$keywords = preg_replace('/[\#]/', '', $keywords);
			$keywords = preg_replace('/[\&]/', 'and', $keywords);
			$itResults = $this->ITunes->searchAlbums($keywords);
			$albums[$key]['keywords'] = $keywords;
			foreach ($itResults['results'] as $itResult) {
				if ($itResult['artworkUrl60'] === $album['Album']['a_AlbumArt'] || $itResult['artworkUrl100'] === $album['Album']['a_AlbumArt']) {
					$albums[$key]['itAlbumID'] = $itResult['collectionId'];
					
					$albums[$key]['Album']['a_ITunesId'] = $itResult['collectionId'];
					
					$albums[$key]['success'] = $this->Album->save($albums[$key], array('validate' => false));
					break;
				} elseif (strtolower($album['Album']['a_Title']) === strtolower($itResult['collectionName']) && 
					(strtolower($album['Album']['a_Artist']) === strtolower($itResult['artistName']) ||
					($album['Album']['a_Compilation'] && ($itResult['artistName'] === 'Various Artists' || $itResult['collectionType'] === 'Compilation')))) {
					$albums[$key]['itAlbumID'] = $itResult['collectionId'];
					
					$albums[$key]['Album']['a_Title'] = $itResult['collectionName'];
					$albums[$key]['Album']['a_AlbumArt'] = $itResult['artworkUrl60'];
					$albums[$key]['Album']['a_ITunesId'] = $itResult['collectionId'];
					
					$albums[$key]['success'] = $this->Album->save($albums[$key], array('validate' => false));
					break;
				}
			}
			if (!isset($albums[$key]['success']) || !$albums[$key]['success']) {
				$albums[$key]['itResults'] = $itResults;
			}
		}
		
		$this->set('albums', $albums);
	}
}
?>
