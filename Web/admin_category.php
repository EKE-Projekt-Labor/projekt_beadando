<?php require 'config.php'; user_perm(5); 

	// HTML fejléc
	echo html_header('Tananyag kategóriáinak kezelése'.action_title($_GET['a']));

	/**
	* Akciók
	*
	* @author	Albach Zsolt
	*/

	#kód


	/**
	* Szerkesztés oldal
	*
	* @author	Eszényi Tamás
	*/

	else if ($_GET['a']=='edit' || $_GET['a']=='new') {

		#kód

	}

	/**
	* Lista oldal
	*
	* @author	Eszényi Tamás
	*/

	else {

		#kód

	}

?>