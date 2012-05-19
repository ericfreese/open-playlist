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
		$this->Crumb->saveCrumb('Music Library', $this->request, true);
		
		$this->set('albums', $this->paginate('Album'));
		// $this->set('genres', $this->Genre->find('list', array('conditions' => array('g_TopLevel' => 1), 'order' => 'Genre.g_Name')));
	}
}
?>
