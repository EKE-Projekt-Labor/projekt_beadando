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
// Akció: létrehozás
else if (isset($_POST['action_new']) && user_perm()>=5) {
    action('new', ['curriculum:new', [
        'name'=>$_POST['name'],
        'content'=>$_POST['content'],
        'categoryid'=>$_POST['categoryid'],
        'creatorid'=>(user_perm()==9?$_POST['creatorid']:$_SESSION["id"]),
        'classid'=>$_POST['classid']
    ]]);
}
// Oldal: olvasás
else if ($_GET['a']=='read' && isset($_GET['id'])) {

    $curriculuminfo = db_query(db_sql('curriculum:info', array('id' => $_GET['id'])))[0]; // tananyag
    $classid = db_query(db_sql('user:classid'), false); // osztály
    $curriculumread = db_query(db_sql('curriculum:readInfo', array('curriculumid' => $_GET['id'])))[0]; // olvasta már?
    $maxpage = substr_count($curriculuminfo['content'], '<hr>') + 1; // maximum oldal

// nem jogosult elolvasni --> átirányít a listára
    if ($curriculuminfo['classid'] != $classid && $_SESSION["id"] != $curriculuminfo['creatorid']) {
        header("location: " . basename(__FILE__));
        exit();
        // még nem töltheti ki --> kiírás, hogy még nem olvasta el a leckét
    } else if ($curriculumread['last'] > 0 && !isset($_GET['page'])) {
        header("location: " . basename(__FILE__) . '?a=read&id=' . $curriculuminfo['id'] . '&page=' . $curriculumread['last']);
        exit();
    } else {
        $page = explode('<hr>', $curriculuminfo['content'])[$_GET['page'] - 1];
        $pagenum = $_GET['page'];

// haladás mentése
        if (isset($curriculumread['id'])) {
            db_query(db_sql('curriculum:readEdit', array('id' => $curriculumread['id'], 'last' => $pagenum, 'max' => ($pagenum > $curriculumread['max'] ? $pagenum : $curriculumread['max'])))); // mod
        } else {
            db_query(db_sql('curriculum:readNew', array('curriculumid' => $curriculuminfo['id'], 'userid' => $_SESSION["id"], 'last' => $pagenum, 'max' => $pagenum))); // új
        }

// megjelenítés
        echo '<center><div style="width:500px; margin:20px 0 40px 0;text-align:left;">' . $page . '</div></center>';
// Lapozás
        $lapozas_url = '?a=read&id=' . $curriculuminfo['id'] . '&page=';
        $prev = $_GET['page'] - 1;
        $next = $_GET['page'] + 1;
        $lapozasVissza = $_GET['page'] > 1;
        $lapozasElore = $_GET['page'] < $maxpage;
        echo '<a href="' . ($lapozasVissza ? $lapozas_url . $prev : '#') . '" class="btn btn-' . ($lapozasVissza ? 'success' : 'secondary') . '">' .
            '<img src="inc/img/icons/chevron-compact-left.svg" alt="" width="24" height="24">  Előző</a> ';
        echo '<a href="' . ($lapozasElore ? $lapozas_url . $next : '#') . '" class="btn btn-' . ($lapozasElore ? 'success' : 'secondary') . '">' .
            'Következő <img src="inc/img/icons/chevron-compact-right.svg" alt="" width="24" height="24"> </a>';
    }
}



/**
	* Tananyag olvasása oldal
	*
	* @author	Albach Zsolt
	*/

	else if ($_GET['a']=='read' && isset($_GET['id'])) {

        $curriculumcats = db_query(db_sql('curriculum:catAll'));
        $userclasss = db_query(db_sql('user:classAll'));

        if (user_perm()==9) {
            $users = db_query(db_sql('user:all', array('WHERE'=>" WHERE permission=5")));
        }

        // szerk|új
        if (isset($_GET['id'])) {
            $curriculuminfo = db_query(db_sql('curriculum:info', array('id'=>$_GET['id'])))[0];
        }

	}

	/**
	* Szerkesztés oldal
	*
	* @author	Veres Tamás
	*/

	else if (($_GET['a']=='edit' || $_GET['a']=='new') && user_perm()>=5) {

		$curriculumcats = db_query(db_sql('curriculum:catAll'));
		$userclasss = db_query(db_sql('user:classAll'));

		if (user_perm()==9) {
			$users = db_query(db_sql('user:all', array('WHERE'=>" WHERE permission=5")));
		}
		
		if (isset($_GET['id'])) {
			$curriculuminfo = db_query(db_sql('curriculum:info', array('id'=>$_GET['id'])))[0];
		}
		?>
		
		<center>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="width:500px"> 
			<div class="form-group">
                <label>Megnevezés</label>
                <input type="text" name="id" value="<?php echo $curriculuminfo['id']; ?>" hidden>
                <input type="text" name="name" class="form-control" value="<?php echo $curriculuminfo['name']; ?>">
            </div>
			<div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>Tartalom</label>
                <textarea class="form-control" name="content" rows="5" maxlength="20000"><?php echo $curriculuminfo['content']; ?></textarea>
            </div>
			<div class="form-group">
                <label>Kategória</label>
                <select class="form-control" name="categoryid">
                  <?php
                  	foreach ($curriculumcats as $curriculumcat) {
                  		echo '<option value="'.$curriculumcat['id'].'" '.($curriculuminfo['categoryid']==$curriculumcat['id']?' selected':'').'>'.$curriculumcat['name'].'</option>'."\n";
                  	}
                  ?>
                </select>
            </div>
			<div class="form-group">
                <label>Osztály</label>
                <select class="form-control" name="classid">
                  <option value="0">-</option>
                  <?php
                  	foreach ($userclasss as $userclass) {
                  		echo '<option value="'.$userclass['id'].'"'.($userclass['id']==$curriculuminfo['classid']?' selected':'').'>'.$userclass['name'].'</option>'."\n";
                  	}
                  ?>
                </select>
            </div>
			 <?php if (user_perm()==9) { ?>
            <div class="form-group">
                <label>Tananyag tulajdonosa</label>
                <select class="form-control" name="creatorid">
                  <?php
                  	foreach ($users as $user) {
                  		echo '<option value="'.$user['id'].'"'.($curriculuminfo['creatorid']==$user['id']?' selected':'').'>'.$user['username'].'</option>'."\n";
                  	}
                  ?>
				</select>
			</div>
        	<?php } ?>
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
		$classid = db_query(db_sql('user:classid'),false);
		$curriculums = db_query(db_sql('curriculum:all',array('classid'=>$classid)));

		echo '
		<br>
		<a href="?" class="btn btn-info"><img src="inc/img/icons/chevron-compact-left.svg" alt="" width="24" height="24"> Tananyagok</a> ';
		if (user_perm()>=5) {
			echo '<a href="?a=new" class="btn btn-info">Új</a>'; 
		}
		echo '<br><br>';

		echo '<table align="center"><tr>'.
			'<th>ID</th><th>Megenvezés</th><th>Kategória</th>'.(user_perm()>=5?'<th>Osztály</th>':'').'<th>Tartalom (részlet)</th><th>Műveletek</th></tr>';
		foreach ($curriculums as $num => $curriculum) {
			echo '<tr>'.
				'<td>'.$curriculum['id'].'</td>'.
				'<td style="text-align:left;">'.$curriculum['name'].'</td>'.
				'<td style="text-align:left;">'.$curriculum['category'].'</td>'.
				(user_perm()>=5?'<td style="text-align:left;">'.$curriculum['class'].'</td>':'').
				'<td style="text-align:left;">'.strip_tags($curriculum['content']).'...</td>'.
				'<td><a href="?a=read&id='.$curriculum['id'].'" class="btn btn-info"><img src="inc/img/icons/play-fill.svg" alt="" width="24" height="24"></a> '
					.($curriculum['creatorid']==$_SESSION["id"] || user_perm() == 9?
					'<a href="?a=edit&id='.$curriculum['id'].'" class="btn btn-info"><img src="inc/img/icons/pencil.svg" alt="" width="24" height="24"></a>
					<a href="?a=del&id='.$curriculum['id'].'" class="btn btn-info"><img src="inc/img/icons/trash.svg" alt="" width="24" height="24"></a>':'').
				'</td>'.
			'</tr>';
		}
		echo '</table>';

	}


	// HTML lábléc
    echo html_footer();

?>