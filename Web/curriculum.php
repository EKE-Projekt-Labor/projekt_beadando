<?php require 'config.php'; user_perm(1); 

	// HTML fejléc
	echo html_header('Tananyagok'.action_title($_GET['a']));

	/**
	* Akciók
	*
	* @author	Albach Zsolt
	*/

// Akció: frissítés
if (isset($_POST['action_edit']) && user_perm()>=5) {
    action('edit', ['curriculum:edit', [
        'id'=>$_POST['id'],
        'name'=>$_POST['name'],
        'content'=>$_POST['content'],
        'categoryid'=>$_POST['categoryid'],
        'creatorid'=>$_POST['creatorid'],
        'classid'=>$_POST['classid']
    ]]);
}


/**
	* Tananyag olvasása oldal
	*
	* @author	Albach Zsolt
	*/

	else if ($_GET['a']=='read' && isset($_GET['id'])) {

		#kód

	}

	/**
	* Szerkesztés oldal
	*
	* @author	Veres Tamás
	*/

	else if (($_GET['a']=='edit' || $_GET['a']=='new') && user_perm()>=5) {

		#kód

	}

	/**
	* Lista oldal
	*
	* @author	Kormány Milán
	*/

	else {

		#kód

	}


	// HTML lábléc
    echo html_footer();

?>