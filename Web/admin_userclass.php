<?php require 'config.php'; user_perm(5); 

	// HTML fejléc
	echo html_header('Osztályok kezelése'.action_title($_GET['a']));

	/**
	* Akciók
	*
	* @author	Albach Zsolt
	*/

	# kód


	/**
	* Szerkesztés oldal
	*
	* @author	Veres Tamás
	*/

	else if ($_GET['a']=='edit' || $_GET['a']=='new') {

		if (isset($_GET['id'])) {
			$coursecatinfo = db_query(db_sql('user:classInfo', array('id'=>$_GET['id'])))[0];
		}
		
		?>

		<center>

    	</center>

		<?php
		
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