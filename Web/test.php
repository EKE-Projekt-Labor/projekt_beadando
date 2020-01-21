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
        action('send', ['test:fillNew', [
            'testid'=>$_POST['testid'],
            'answers'=>$_POST['answers']
        ]]);
    }
	

    /**
    * Szerkesztés oldal
    *
    * @author   Albach Zsolt
    */

	else if(($_GET['a']=='edit' || $_GET['a']=='new') && user_perm()>=5) {


            $curriculums = db_query(db_sql('curriculum:all'));

            // szerk|új
            if (isset($_GET['id'])) {
                $testinfo = db_query(db_sql('test:info', array('id'=>$_GET['id'])))[0];
                $qaas = json_decode_($testinfo['content'], JSON_OBJECT_AS_ARRAY);
            }
            ?>
            <center>
                <form class="c" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="width:500px">
                    <div class="form-group">
                        <label>Megnevezés</label>
                        <input type="text" name="id" value="<?php echo $testinfo['id']; ?>" hidden>
                        <input type="text" name="name" class="form-control" value="<?php echo $testinfo['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Tananyag</label>
                        <select class="form-control" name="curriculumid">
                            <?php
                            foreach ($curriculums as $curriculum) {
                                echo '<option value="'.$curriculum['id'].'" '.($testinfo['curriculumid']==$curriculum['id']?' selected':'').'>'.$curriculum['name'].' ['.$curriculum['id'].']</option>'."\n";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                        <label>Kérdések és válaszok</label>
                        <?php
                        $qaas = (isset($qaas)?$qaas:[1=>null,2,3,4,5,6,7,8,9,10]); // JAVÍTANDÓ!!!!
                        foreach ($qaas as $key => $qaa) {
                            $i = $key;

                            echo '<div class="qb" style="text-align: center;">';
                            echo $i.'. <input type="text" name="content['.$i.'][q]" class="form-control" value="'.$qaa['q'].'"><br>';
                            echo '<input type="radio" name="content['.$i.'][a]" value="1"'.($qaa['a']=='1'?' checked':'').'>';
                            echo '<input type="text" name="content['.$i.'][a1]" class="form-control" value="'.$qaa['a1'].'">';
                            echo '<input type="radio" name="content['.$i.'][a]" value="2"'.($qaa['a']=='2'?' checked':'').'>';
                            echo '<input type="text" name="content['.$i.'][a2]" class="form-control" value="'.$qaa['a2'].'"><br>';
                            echo '<input type="radio" name="content['.$i.'][a]" value="3"'.($qaa['a']=='3'?' checked':'').'>';
                            echo '<input type="text" name="content['.$i.'][a3]" class="form-control" value="'.$qaa['a3'].'">';
                            echo '<input type="radio" name="content['.$i.'][a]" value="4"'.($qaa['a']=='4'?' checked':'').'>';
                            echo '<input type="text" name="content['.$i.'][a4]" class="form-control" value="'.$qaa['a4'].'">';
                            echo '</div>';

                        }

                        ?>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="action_<?php echo $_GET['a']; ?>" value="<?php echo ($_GET['a']=='edit'?'Mentés':'Létrehozás'); ?>">
                        <a class="btn btn-link" href="?">Mégse</a>
                    </div>
                </form>
            </center>




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
        // még nem töltheti ki --> kiírás, hogy még nem olvasta el a leckét
		} else if ($curriculumread['max'] != substr_count($curriculuminfo['content'],'<hr>')+1 && user_perm()<5) {
			echo "Még nem olvastad végig a teszthez tartozó tananyagot!";
        //
        } else {

			$marKitoltve = isset($testfillinfo['id']) || user_perm()>=5;

			if (isset($_GET['id'])) {
				$testinfo = db_query(db_sql('test:info', array('id'=>$_GET['id'])))[0];
				$answers = json_decode_($testfillinfo['answers'], JSON_OBJECT_AS_ARRAY); // felelt válaszok
				$qaas = json_decode_($testinfo['content'], JSON_OBJECT_AS_ARRAY); // kérdés és helyes válasz
				$usersfilled = db_query(db_sql('test:filledInfo', array('testid'=>$_GET['id'])));
			}

			$qmax = 0; $good = 0;
			foreach ($qaas as $i => $qaa) {
				if (trim($qaa['q'])=='') { break; }
				$qmax++; $good += ($answers[$i]['a']==$qaas[$i]['a']?1:0);
			}

			echo '<h3>'.$testinfo['name'].'</h3><i>Tananyag: '.$testinfo['curriculumname'].'</i><br><br><br>';
			echo ($marKitoltve&&user_perm()<5?'<b style="color:blue;">Már kitöltötted a tesztet. Eredményed:</b><br><br><span class="eredmeny">'.evaluation($good, $qmax, 'grade').' ('.evaluation($good, $qmax, 'percent').')</span><br><br><br>':'');

        	if ($marKitoltve) {
        		echo '<center><form style="width:500px">';
        	} else {
        		echo '<center><form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post" style="width:500px">';
				echo '<input name="testid" value="'.$testinfo['id'].'" hidden>';
        	}

        	if (user_perm()>=5) {

				echo '<style>td:last-of-type,th:last-of-type{text-align:center; width: 100px !important;}</style>';
        		echo '<table style="width:100%"><tr><th>Felhasználónév</th><th>Jegy</th><th>%</th><th>Pont</th><th>Műveletek</th></tr>';
        		foreach ($usersfilled as $key => $user) {

					// Számok...
					$_userAnsw = json_decode_($user['answers'], JSON_OBJECT_AS_ARRAY);
					$_qmax = 0; $_good = 0;
					foreach ($qaas as $i => $qaa) {
						if (trim($qaa['q'])=='') { break; }
						$_qmax++; $_good += ($_userAnsw[$i]['a']==$qaas[$i]['a']?1:0);
					}

					$_userAnswJSON = str_replace('"','',$user['answers']);

        			echo '<tr>';
        			echo '<td>'.$user['username'].'</td>';
        			echo '<td>'.evaluation($_good, $_qmax, 'grade').'</td>';
        			echo '<td>'.evaluation($_good, $_qmax, 'percent').'</td>';
        			echo '<td>'.evaluation($_good, $_qmax, 'points').'</td>';
        			echo '<td><a data-id="'.$user['id'].'" href="#" class="btn btn-info" data-answ="'.$_userAnswJSON.'"><img src="inc/img/icons/eye-fill.svg" alt="" width="24" height="24"></a></td>';
        			echo '</tr>';
        		}
        		echo '</table><br><br>';
        	}

        	foreach ($qaas as $key => $qaa) {
        		$i = $key;

        		if (trim($qaa['q'])=='') { break; }

        		$correct = $answers[$i]['a']==$qaas[$i]['a'];
        		$class = ($correct?'correct':'gooda');

        		echo '<center><div class="qb">';
        		echo '<span class="q">'.$i.'. '.$qaa['q'].'</span><br>';

        		for ($j=1; $j < 5; $j++) { 
	        		echo '<input id="q'.$i.'a'.$j.'" type="radio" name="answers['.$i.'][a]" value="'.$j.'"'.
	        			($marKitoltve?' class="'.
	        			  	($qaas[$i]['a']==$j?$class:
	        			  		($answers[$i]['a']==$j?' wrong':'')
	        			  	).'" disabled'.
	        			 	($answers[$i]['a']==$j?' checked':'')
	        			 	:''
	        			).'>';
	        		echo '<label class="a" for="q'.$i.'a'.$j.'">'.$qaa['a'.$j].'</label>'.($j==2?'<br>':'');
        		}

        		echo '</div></center>';

        	}

        	if ($marKitoltve&&user_perm()<5) {
        		echo '<br><br><br><b style="color:blue;">Beküldve: '.$testfillinfo['date'].'</b><br><br><br>';
        	} else if (user_perm()<5) {
        		echo '<br><br><br><input type="submit" class="btn btn-success" name="action_'.$_GET['a'].'" value="Teszt beküldése">';
        	}
        	
        	echo '</form></center>';

		}

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