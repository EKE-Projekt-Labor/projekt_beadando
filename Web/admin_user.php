<?php require 'config.php'; user_perm(5); 

	// HTML fejléc
	echo html_header('Felhasználók kezelése'.action_title($_GET['a']));

	/**
	* Akciók
	* @author	Albach Zsolt
	*/

	if (isset($_POST['action_edit'])) {
		action('edit', ['user:edit', [
			'id'=>$_POST['id'],
			'username'=>$_POST['username'],
			'password'=>$_POST['password'],
			'permission'=>$_POST['permission'],
			'classid'=>$_POST['classid']
		]]);
	} 
	// Akció: létrehozás
	
	else if (isset($_POST['action_new'])) {
		action('new', ['user:new', [
			'username'=>$_POST['username'],
			'password'=>$_POST['password'],
			'permission'=>$_POST['permission'],
			'classid'=>$_POST['classid']
		]]);
	}

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