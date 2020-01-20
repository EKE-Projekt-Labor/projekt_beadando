<?php

	/**
	* ADATBÁZIS: LEKÉRDEZÉS
	*
	* Általános lekérdező függvény.
	*
	* @author	Eszényi Tamás
	*
	* @param	string	$sql		SQL lekérdezés
	* @param	bool	$retArray	tömbbel térjen vissza?
	*/

	function db_query ($sql, $retArray) {
		global $link;

		if ($result = $link->query($sql)) {

		    if (preg_match('/^SELECT/msi', $sql)) {

				//-- ha adatot kérdezünk le, akkor adjon vissza egy tömböt vagy stringet

			}

		}

	}

?>