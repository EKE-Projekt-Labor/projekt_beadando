<?php require 'config.php'; user_perm(1); 

	// HTML fejléc
	echo html_header ('Tesztek'.action_title($_GET['a']));

    /**
    * Akciók
    *
    * @author   Albach Zsolt
    */

	#kód
	

    /**
    * Szerkesztés oldal
    *
    * @author   Albach Zsolt
    */

	else if(($_GET['a']=='edit' || $_GET['a']=='new') && user_perm()>=5) {

		#kód

	}

    /**
    * Kitöltés oldal
    *
    * @author   Kormány Milán
    */

	else if ($_GET['a']=='fill') {

        $testinfo = db_query(db_sql('test:info', array('id'=>$_GET['id'])))[0];
		$curriculuminfo = db_query(db_sql('curriculum:info', array('id'=>$testinfo['curriculumid'])))[0]; // tananyag
		$classid = db_query(db_sql('user:classid'),false); // osztály
		$curriculumread = db_query(db_sql('curriculum:readInfo', array('curriculumid'=>$testinfo['curriculumid'])))[0]; // hanyadik oldalnál jár?
        $testfillinfo = db_query(db_sql('test:fillInfo',array('testid'=>$_GET['id'])))[0]; // hanyadik oldalnál jár?
        
        // nem jogosult elolvasni --> átirányít a listára
		if ($curriculuminfo['classid'] != $classid && user_perm()<5) {
			header("location: ".basename(__FILE__)); exit();

	}

    /**
    * Lista oldal
    *
    * @author   Albach Zsolt
    */

	else {

		#kód

	}


	// HTML lábléc
    echo html_footer();

?>