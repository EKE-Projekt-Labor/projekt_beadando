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