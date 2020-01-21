<?php require 'config.php'; user_perm(5); 

	// HTML fejléc
	echo html_header('Felhasználók kezelése'.action_title($_GET['a']));

	/**
	* Akciók
	*
	* @author	Albach Zsolt
	*/

	#kód


	/**
	* Szerkesztés oldal
	*
	* @author	Veres Tamás
	*/

	// Oldal: új/szerkesztés
	else if ($_GET['a']=='edit' || $_GET['a']=='new') {

		#kód

	}

	/**
	* Lista oldal
	*
	* @author	Kormány Milán
	*/

	// Oldal: lista
	else {

		#kód

	}


	// HTML lábléc
    html_footer();

?>