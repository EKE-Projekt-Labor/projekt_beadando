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

		if (isset($_GET['id'])) {
			$userinfo = db_query(db_sql('user:info', array('id'=>$_GET['id'])))[0];
		}

		$userclasss = db_query(db_sql('user:classAll'));
		
		?>

		<center>
		<form class="c" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="width:500px"> 
			<div class="form-group">
                <label>Felhasználónév</label>
                <input type="text" name="id" value="<?php echo $userinfo['id']; ?>" hidden>
                <input type="text" name="username" class="form-control" value="<?php echo $userinfo['username']; ?>">
            </div>
			<div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>Jelszó<?php echo ($_GET['a']=='edit'?' módosítás':''); ?></label>
                <?php echo ($_GET['a']=='edit'?'<p>Csak akkor töltsd ki, ha módosítai szeretnéd!</p>':''); ?>
                <input type="password" name="password" class="form-control" value="">
            </div>
		
		
		
		</form>
	    </center>

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