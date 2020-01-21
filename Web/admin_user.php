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

	}

	/**
	* Lista oldal
	*
	* @author	Kormány Milán
	*/

	// Oldal: lista
	else {
		$users = db_query(db_sql('user:all'));

		echo '
		<br>
		<a href="?" class="btn btn-info">Összes</a>
		<a href="?a=new" class="btn btn-info">Új</a>
		<br><br>';


		echo '<table align="center"><tr>'.
			'<th>ID</th><th>Felhasználónév</th><th>Létrehozva</th><th>Osztály</th><th>Jogosultság</th><th>Műveletek</th></tr>';
		foreach ($users as $num => $user) {
			echo '<tr>'.
				'<td>'.$user['id'].'</td>'.
				'<td style="text-align:left;">'.$user['username'].'</td>'.
				'<td style="text-align:left;">'.$user['created_at'].'</td>'.
				'<td>'.($user['class']==0?'-':$user['class']).'</td>'.
				'<td style="text-align:left;">'; //.$user['permission'].' - ';
					switch ((int)$user['permission']) {
						case 1:  echo 'tanuló'; break;
						case 5:  echo 'tanár'; break;
						case 9:  echo 'adminisztrátor'; break;
						case 0:  echo 'felhasználó'; break;
						default: echo ''; break;
					}
			echo '</td>'.
				'<td>'.((int)$user['permission'] < user_perm() || $user['id']==$_SESSION["id"] || user_perm() == 9?
					'<a href="?a=edit&id='.$user['id'].'" class="btn btn-info"><img src="inc/img/icons/pencil.svg" alt="" width="24" height="24"></a>
					<a href="?a=del&id='.$user['id'].'" class="btn btn-info"><img src="inc/img/icons/trash.svg" alt="" width="24" height="24"></a>':'').
				'</td>'.
			'</tr>';
		}
		echo '</table>';

	}


	// HTML lábléc
    html_footer();

?>