<?php

	/**
	* AKCIÓ
	*
	* Művelet végrehjatása (új, módosítás, törlés).
	*
	* @author	Albach Zsolt
	*
	* @param	string	$action		Akció neve
	* @param	array	$sql		SQL utasítés és adatok
	*/

	function action ($action, $sql) {

		db_query(db_sql($sql[0], $sql[1]));

		switch ($action) {
			case 'edit':   echo 'Módosítás megtörtént.'; break;
			case 'new':    echo 'Létrehozva.'; break;
			case 'send':   echo 'Elküldve.'; break;
			default: break;
		}

		echo '<br><br> <a href="?" class="btn btn-info">Vissza a listához</a>'; 
		exit();

	}

?>