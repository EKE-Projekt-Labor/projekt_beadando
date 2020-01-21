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
// haladás mentése
if (isset($curriculumread['id'])) {
    db_query(db_sql('curriculum:readEdit', array('id'=>$curriculumread['id'],'last'=>$pagenum,'max'=> ($pagenum>$curriculumread['max']?$pagenum:$curriculumread['max']) ))); // mod
} else {
    db_query(db_sql('curriculum:readNew', array('curriculumid'=>$curriculuminfo['id'],'userid'=>$_SESSION["id"],'last'=>$pagenum,'max'=>$pagenum))); // új
}

// megjelenítés
echo '<center><div style="width:500px; margin:20px 0 40px 0;text-align:left;">'.$page.'</div></center>';
// Lapozás
$lapozas_url = '?a=read&id='.$curriculuminfo['id'].'&page='; $prev = $_GET['page']-1; $next = $_GET['page']+1;
$lapozasVissza = $_GET['page'] > 1;
$lapozasElore  = $_GET['page'] < $maxpage;
echo '<a href="'.($lapozasVissza?$lapozas_url.$prev:'#').'" class="btn btn-'.($lapozasVissza?'success':'secondary').'">'.
    '<img src="inc/img/icons/chevron-compact-left.svg" alt="" width="24" height="24">  Előző</a> ';
echo '<a href="'.($lapozasElore?$lapozas_url.$next:'#').'" class="btn btn-'.($lapozasElore?'success':'secondary').'">'.
    'Következő <img src="inc/img/icons/chevron-compact-right.svg" alt="" width="24" height="24"> </a>';


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