<?php require 'config.php'; user_perm(1); 

	// HTML fejléc
	echo html_header ('Tesztek'.action_title($_GET['a']));

    /**
    * Akciók
    *
    * @author   Albach Zsolt
    */

	if(isset($_POST['action_edit']) && user_perm()>=5){
        action('edit', ['test:edit', [
            'id'=>$_POST['id'],
            'name'=>$_POST['name'],
            'content'=>$_POST['content'],
            'curriculumid'=>$_POST['curriculumid']
        ]]);
    }
    else if (isset($_POST['action_new']) && user_perm()>=5) {
        action('new', ['test:new', [
            'name'=>$_POST['name'],
            'content'=>$_POST['content'],
            'curriculumid'=>$_POST['curriculumid']
        ]]);
    }

    // Akció: kitötés
    else if (isset($_POST['action_fill']) && user_perm()==1) {
        
    }
	

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

		#kód

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