<?php
class Genre extends AppModel {
	var $name = 'Genre';
	
	var $useTable = 'Genres';
	var $primaryKey = 'g_GenreID';
	var $displayField = 'g_Name';
	
	var $hasMany = array(
		'Albums' => array(
			'foreignKey' => 'a_GenreID',
			'order' => 'Albums.a_Title ASC'
		)
	);
}
?>
