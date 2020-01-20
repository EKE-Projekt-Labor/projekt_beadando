<?php

	/**
	* JSON_DECODE +
	*
	* Kibőtve. Az idézőjelet helyesen jeleníti meg.
	* A függvény a későbbiekben akár bővíthető is,
	* további speciális karakterekkel.
	*
	* @author	Eszényi Tamás
	*
	* @param	string	$json		
	* @param	int 	$options
	* @return 	mixed	
	*/

	function json_decode_ ($json, $options) {
		return json_decode(preg_replace(
			['/(u0022)/msi'], 
			['&quot;'], 
		$json), $options);
	}

?>