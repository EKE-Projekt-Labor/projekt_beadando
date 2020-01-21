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

# kód

?>