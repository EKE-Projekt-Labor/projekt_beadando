<?php require 'config.php'; user_perm(5); 

	// HTML fejléc
	echo html_header('Tananyag kategóriáinak kezelése'.action_title($_GET['a']));

	/**
	* Akciók
	*
	* @author	Albach Zsolt
	*/

	// Akció: frissítés
	if (isset($_POST['action_edit'])) {
	    action('edit', ['curriculum:catEdit', [
	        'id'=>$_POST['id'],
	        'name'=>$_POST['name']
	    ]]);
	}
	// Akció: létrehozás
	else if (isset($_POST['action_new'])) {
	    action('new', ['curriculum:catNew', [
	        'name'=>$_POST['name']
	    ]]);
	}


	/**
	* Szerkesztés oldal
	*
	* @author	Eszényi Tamás
	*/

	else if ($_GET['a']=='edit' || $_GET['a']=='new') {

		// szerk|új
		if (isset($_GET['id'])) {
			$curriculumcatinfo = db_query(db_sql('curriculum:catInfo', array('id'=>$_GET['id'])))[0];
		}

	}

	/**
	* Lista oldal
	*
	* @author	Eszényi Tamás
	*/

	else {

		#kód

	}

	// HTML lábléc
    echo html_footer();

?>