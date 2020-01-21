<?php

require_once "config.php";
 
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    /**
    * Validálás
    *
    * @author   Veres Tamás
    */

    if(empty(trim($_POST["username"]))){
        $username_err = "Felhasználónév megadása szükséges.";
    } else{

        $sql = db_sql('user:nameCheck');
        
		if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "s", $param_username);
            

            $param_username = trim($_POST["username"]);
            
            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "A felhasználónév már használatban van.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Hiba! Próbáld meg később.";
            }
        }
         
        mysqli_stmt_close($stmt);
    }
	
    if(empty(trim($_POST["password"]))){
        $password_err = "Add meg a jelszavad.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "A jelszónak minimum 6 karakternek kell lennie.";
    } else{
        $password = trim($_POST["password"]);
    }
	
	if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Írd be újra a jelszavad.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "A jelszók nem egyeznek.";
        }
    }

    /**
    * Hiba kezelés, adatbázisba feltöltés
    *
    * @author   Kormány Milán
    */
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        $sql = db_sql('user:newReg');
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            
            if(mysqli_stmt_execute($stmt)){
                header("location: login.php");
            } else{
                echo "Hiba! Próbáld meg később.";
            }
        }
        mysqli_stmt_close($stmt);
    } 
    mysqli_close($link);
}

/**
* Regisztrációs űrlap
*
* @author   Veres Tamás
*/

echo html_header('Regisztráció');

?>

        <p>Fiók regisztrálásához töltsd ki az alábbi űrlapot.</p>
        <form class="c" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Felhasználónév</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
			<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Jelszó</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
			<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Jelszó mégegyszer</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>

<?php
    echo html_footer();
?>