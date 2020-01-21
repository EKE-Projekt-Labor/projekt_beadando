<?php require 'config.php'; user_perm(0);

$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    /**
    * Validálás
    *
    * @author   Veres Tamás
    */

    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Add meg az új jelszót.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "A jelszónak minimum 6 karakter hosszúnak kell lennie.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
	
	if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    }  else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }	
    }

    /**
    * Hibakezelés, frissítés az adatbázisban
    *
    * @author   Kormány Milán
    */
    if(empty($new_password_err) && empty($confirm_password_err)){
        $sql = db_sql('user:passNew');
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            if(mysqli_stmt_execute($stmt)){
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Hiba történt, kérem próbálja meg később.";
            }
        }
        
        mysqli_stmt_close($stmt);
    }


}

/**
* Új jelszó űrlap
*
* @author   Veres Tamás
*/

echo html_header('Új jelszó');

?>

        <p>Töltsd ki a a lejjebb látható mezőket a jelszó megváltoztatásához.</p>
        <form class="c" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
			<div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>Az új jelszó</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
			<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Az új jelszó mégegyszer</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
		</form>
		