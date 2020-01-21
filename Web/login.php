	<?php
 /**
* Login.PHP
*
* @author   __Albach Zsolt__
*/
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
  exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Felhasználónév megadása szükséges.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Jelszó megadása szükséges.";
    } else{
        $password = trim($_POST["password"]);
    }
?>
<p></p>
        <form class="c" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Felhasználónév</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Jelszó</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Bejelentkezés">
            </div>
            <p>Nincs még fiókod? <a href="register.php">Regisztráció</a>.</p>
        </form>

        <pre>
       Felhasználók:
        - felh      (jelszó: 123456)
        - diak     (jelszó: titok123)
        - diak2     (jelszó: 123456)
        - tanar     (jelszó: 123456)
        - tanar2    (jelszó: 123456)
        - admin     (jelszó: 123456)
        - admin2    (jelszó: 123456)
        </pre>