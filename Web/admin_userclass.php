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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="width:500px"> 
            <div class="form-group">
                <label>Megnevezés</label>
                <input type="text" name="id" value="<?php echo $coursecatinfo['id']; ?>" hidden>
                <input type="text" name="name" class="form-control" value="<?php echo $coursecatinfo['name']; ?>">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="action_<?php echo $_GET['a']; ?>" value="<?php echo ($_GET['a']=='edit'?'Mentés':'Létrehozás'); ?>">
                <a class="btn btn-link" href="?">Mégse</a>
            </div>
        </form>
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