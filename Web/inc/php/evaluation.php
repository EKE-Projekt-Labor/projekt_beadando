<?php

	/**
	* ÉRTÉKELÉS
	*
	* Kitöltött teszt értékelését adja vissza (százalék/pont/jegy).
	*
	* @author	Eszényi Tamás
	*
	* @param	int		$point	elért pont
	* @param	int		$max	maximum pont
	* @param	string	$mode	visszatérési érték módja
	* @return	string	Teszt érétékelése százalékkal, ponttal vagy jeggyel.
	*/

	function evaluation ($point, $max, $mode, $pretext=false) { // $grade=false, $percent=false, $points=true

		// százalék
		$percent = 100 * $point / $max;

		// érdemjegy
		     if ( $percent <=  39 ) { $grade = 1; }
		else if ( $percent <=  54 ) { $grade = 2; }
		else if ( $percent <=  74 ) { $grade = 3; }
		else if ( $percent <=  89 ) { $grade = 4; }
		else if ( $percent <= 100 ) { $grade = 5; }

		// mód
		switch ($mode) {
			case 'grade':		$text = 'Érdemjegy'; $value = $grade;          break;
			case 'percent':		$text = 'Százalék';  $value = $percent.'%';    break;
			case 'points':		$text = 'Pont';      $value = $point.'/'.$max; break;
			default: return ''; break;
		}

		// visszatérési érték
		return ( $pretext ? $text : '' ) . $value;

	}

?>