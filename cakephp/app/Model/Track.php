<?php
class Track extends AppModel {
	var $name = 'Track';
	
	var $useTable = 'Tracks';
	var $primaryKey = 't_TrackID';
	var $displayField = 't_Title';
	
	var $belongsTo = array(
		'Album' => array(
			'foreignKey' => 't_AlbumID'
		)
	);
	
	var $validate = array(
		't_Title' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'Name is required'
		),
		't_Artist' => array(
			'rule' => array('_hasRequiredArtist'),
			'message' => 'Artist is required because the album is a compilation'
		),
		't_TrackNumber' => array(
			'rule' => 'numeric',
			'required' => true,
			'message' => 'Track number is required'
		),
		't_DiskNumber' => array(
			// array(
			// 	'rule' => '_hasRequiredDiscNumber',
			// 	'message' => 'Disc number is required because the album has multiple discs'
			// ),
			// array(
			// 	'rule' => '_hasValidDiscNumber',
			// 	'message' => 'Invalid disc number'
			// ),
			array(
				'rule' => 'numeric',
				'allowEmpty' => true,
				'message' => 'Invalid disc number'
			)
		),
		't_Duration' => array(
			array(
				'rule' => '_hasRequiredDuration',
				'message' => 'Duration is required because we\'re in a reporting period'
			), array(
				'rule' => 'numeric',
				'message' => 'Invalid duration'
				// 'rule' => '/^([0-9]+):([0-5][0-9])$/',
				// 'message' => 'Duration should be formatted in m:ss (ex: 2:34)'
			)
		),
	// 	't_ITunesPreviewUrl' => 'url'
	);
	
	function _hasRequiredArtist() {
		$track = array_values($this->data);
		$track = $track[0];
		
		if (isset($track['t_AlbumID'])) {
			$albumData = $this->Album->find('first', array('conditions' => array('a_AlbumID' => $track['t_AlbumID'])));
		} elseif (isset($this->data['Track']['t_TrackID'])) {
			$albumData = $this->find('first', array('conditions' => array('t_TrackID' => $track['t_TrackID'])));
		} else {
			return false;
		}
		
		if (!$albumData) return false;
		
		if ($albumData['Album']['a_Compilation']) return (!empty($track['t_Artist']));
		
		return true;
	}
	
	// function _hasRequiredDiscNumber() {
	// 	debug($this->data);
	// 	if (isset($this->data['Track']['t_AlbumID'])) {
	// 		$albumData = $this->Album->find('first', array('conditions' => array('a_AlbumID' => $this->data['Track']['t_AlbumID'])));
	// 	} elseif (isset($this->data['Track']['t_TrackID'])) {
	// 		$albumData = $this->find('first', array('conditions' => array('t_TrackID' => $this->data['Track']['t_TrackID'])));
	// 	}
	// 	
	// 	return ($albumData['Album']['a_DiscCount'] == 1 || !empty($this->data['Track']['t_DiskNumber']));
	// }
	// 
	// function _hasValidDiscNumber() {
	// 	if (isset($this->data['Track']['t_AlbumID'])) {
	// 		$albumData = $this->Album->find('first', array('conditions' => array('a_AlbumID' => $this->data['Track']['t_AlbumID'])));
	// 	} elseif (isset($this->data['Track']['t_TrackID'])) {
	// 		$albumData = $this->find('first', array('conditions' => array('t_TrackID' => $this->data['Track']['t_TrackID'])));
	// 	}
	// 	
	// 	if (!empty($this->data['Track']['t_DiskNumber'])) {
	// 		return ($this->data['Track']['t_DiskNumber'] > 0 && $this->data['Track']['t_DiskNumber'] <= $albumData['Album']['a_DiscCount']);
	// 	}
	// 	return true;
	// }
	
	function _hasRequiredDuration() {
		$track = array_values($this->data);
		$track = $track[0];
		
		if (Configure::read('Options.ReportingPeriod')) {
			return !empty($track['t_Duration']);
		} else {
			return true;
		}
		return !(Configure::read('Options.ReportingPeriod') && empty($track['t_Duration']));
	}
	
	function beforeSave() {
		// Convert duration string into integer number of seconds
		// if (is_string($this->data['Track']['t_Duration']) && preg_match('/^([0-9]+):([0-5][0-9])$/', $this->data['Track']['t_Duration'], $matches)) {
		// 	$this->data['Track']['t_Duration'] = $matches[1] * 60 + $matches[2];
		// } elseif (!is_int($this->data['Track']['t_Duration'])) {
		// 	return false;
		// }
		
		// Set disc number to 1 if it's empty
		if (empty($this->data['Track']['t_DiskNumber'])) {
			$this->data['Track']['t_DiskNumber'] = 1;
		}
		
		return true;
	}
	
	function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		
		// $this->validate = array(
		// 	't_Title' => array(
		// 		'rule' => 'alphaNumeric',
		// 		'required' => true,
		// 		'allowEmpty' => false
		// 	),
		// 	't_Artist' => array(
		// 		'rule' => array('_validateArtist'),
		// 		'required' => false
		// 	),
		// 	't_TrackNumber' => array(
		// 		'rule' => 'numeric',
		// 		'required' => true,
		// 		'allowEmpty' => false
		// 	),
		// 	't_DiskNumber' => array(
		// 		'rule' => 'numeric'
		// 	),
		// 	't_ITunesPreviewUrl' => 'url'
		// );
		// 
		// if (Configure::read('Options.ReportingPeriod')) {
		// 	$this->validate['t_Duration'] = array(
		// 		'rule' => 'numeric',
		// 		'required' => true
		// 	);
		// }
	}
}
?>
