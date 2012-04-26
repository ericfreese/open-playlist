<?php
class Album extends AppModel {
	var $name = 'Album';
	
	var $useTable = 'Albums';
	var $primaryKey = 'a_AlbumID';
	var $displayField = 'a_Title';
	
	var $belongsTo = array(
		'Genre' => array(
			'foreignKey' => 'a_GenreID'
		)
	);
	
	var $hasMany = array(
		'Tracks' => array(
			'className' => 'Track',
			'foreignKey' => 't_AlbumID',
			'order' => 'Tracks.t_DiskNumber ASC, Tracks.t_TrackNumber ASC',
			'dependent' => true
		)
	);
	
	var $validate = array(
		'a_Title' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'Title is required'
		),
		'a_Artist' => array(
			'rule' => array('_hasArtistOrIsCompilation'),
			'message' => 'Artist is required because the album is not a compilation'
		),
		'a_Label' => array(
			array(
				'rule' => '_hasRequiredLabel',
				'message' => 'Label is required because we\'re in a reporting period'
			)
		),
		'a_GenreID' => array(
			'rule' => 'numeric',
			'required' => true,
			'message' => 'Genre is required'
		),
		'a_Compilation' => array(
			'rule' => 'boolean',
			'required' => true
		),
		'a_DiscCount' => array(
			array(
				'rule' => 'numeric',
				'allowEmpty' => true,
				'message' => 'Invalid disc count'
			)
		),
		'a_AlbumArt' => array(
			'rule' => 'url',
			'required' => false,
			'allowEmpty' => true,
			'message' => 'This should be a URL (ex: http://example.com/album-cover.jpg)'
		)
	);
	
	function beforeSave() {
		// If the album is a compilation, clear the Artist field
		if ($this->data['Album']['a_Compilation']) {
			$this->data['Album']['a_Artist'] = '';
		}
		
		// If disc count isn't provided, default to 1
		if (empty($this->data['Album']['a_DiscCount']) || $this->data['Album']['a_DiscCount'] <= 0) {
			$this->data['Album']['a_DiscCount'] = '1';
		}
		
		return true;
	}
	
	// Require artist unless the album is a compilation
	function _hasArtistOrIsCompilation() {
		return ($this->data['Album']['a_Compilation'] || !empty($this->data['Album']['a_Artist']));
	}
	
	// Only require label when in a reporting period
	function _hasRequiredLabel() {
		return !(Configure::read('Options.ReportingPeriod') && empty($this->data['Album']['a_Label']));
	}
	
	function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
	}
	
	public function findByKeyword($keyword, $params = array()) {
		$conditions = array(
			'OR' => array(
				'Album.a_Title LIKE' => '%'.$keyword.'%',
				'Album.a_Artist LIKE' => '%'.$keyword.'%'
			)
		);
		
		if (isset($params['conditions'])) $conditions = array_merge_recursive($params['conditions'], $conditions);
		
		return $this->find('all', array_merge($params, array('conditions' => $conditions)));
	}
	
	public function addAlbumWithTracks($data) {
		$ds = $this->getDataSource();
		$ds->begin();
		
		$success = false;
		
		if ($this->save($data)) {
			if (isset($data['Tracks'])) {
				foreach ($data['Tracks'] as $key => $value) {
					$data['Tracks'][$key]['t_AlbumID'] = $this->id;
				}
				
				if ($this->Tracks->saveMany($data['Tracks'])) $success = true;
			} else {
				$success = true;
			}
		}
		
		if ($success) {
			$ds->commit();
		} else {
			$ds->rollback();
		}
		
		return $success;
	}
}
?>