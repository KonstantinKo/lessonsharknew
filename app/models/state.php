<?php

class State extends AppModel {

	public $name	= 'State';

	public $hasOne = array(
		'Profile'
	);
	
}

?>