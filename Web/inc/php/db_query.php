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

	function db_query ($sql, $retArray=true) {
		global $link;

		if ($result = $link->query($sql)) {

		    if (preg_match('/^SELECT/msi', $sql)) {

				while ($row = $result->fetch_assoc()) {
					if ($retArray) {
						$res[] = $row;
					} else {
						$singl = preg_replace('/^.*?SELECT[\s]{1,}([a-zA-Z0-9_-]{1,})(?:,|[\s]{1,}).*?$/m',
							'$1', $sql); // az első oszlop neve
						$res = $row[$singl];
					}
				}

				$result->free();

			}

		}

		return $res;
	}

?>