<?php 
class AppSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $Albums = array(
		'a_AlbumID' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'a_Title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'a_Artist' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'a_Label' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'a_GenreID' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'a_AddDate' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'a_Local' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'a_Compilation' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'a_AlbumArt' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 500, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'a_AlbumID', 'unique' => 1), 'IX_GenreId' => array('column' => 'a_GenreID', 'unique' => 0), 'a_Title' => array('column' => array('a_Title', 'a_Artist'), 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $Genres = array(
		'g_GenreID' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'g_Name' => array('type' => 'text', 'null' => false, 'default' => NULL, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'g_TopLevel' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'g_GenreID', 'unique' => 1), 'g_Name' => array('column' => 'g_Name', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $Tracks = array(
		't_TrackID' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		't_AlbumID' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		't_Title' => array('type' => 'text', 'null' => false, 'default' => NULL, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		't_TrackNumber' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 6),
		't_Artist' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		't_DiskNumber' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 6),
		't_Duration' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 't_TrackID', 'unique' => 1), 'IX_AlbumId' => array('column' => 't_AlbumID', 'unique' => 0), 't_Title' => array('column' => array('t_Title', 't_Artist'), 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
}
