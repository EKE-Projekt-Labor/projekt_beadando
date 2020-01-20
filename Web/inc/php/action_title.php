<?php

	/**
	* AKCIÓ CÍME
	*
	* A megfelelő akció címét adja vissza.
	*
	* @author	Eszényi Tamás
	*
	* @param	string	$action		Akció neve
	* @param	bool	$hyphen 	Legyen kötőjel előtte?
	* @return	string	Akció címe.
	*/

	function action_title ($action, $hyphen=true) {

		$hyphen = ($hyphen?' - ':'');

		switch ($action) {
			case 'edit': return $hyphen.'Szerkesztés'; break;
			case 'new':  return $hyphen.'Új létrehozása'; break;
			default:     return ''; break;
		}

	}

?>