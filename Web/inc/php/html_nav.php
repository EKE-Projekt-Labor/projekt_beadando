<?php

	/**
	* HTML: NAVIGÁCIÓ
	*
	* @author	Kormány Milán
	*
	* @param	string	$activePage		aktív oldal neve
	* @return	string	Navigáció.
    */
    function html_nav ($activePage) {

		$userPerm = user_perm();
	
			return 
	<<<HTML
	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">E-LEARNING</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
	  <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active"><a class="nav-link" href="index.php">Kezdőlap</a></li>
          <li class="nav-item"><a class="nav-link" href="curriculum.php">Tananyagok</a></li>
          <li class="nav-item"><a class="nav-link" href="test.php">Tesztek</a></li>
        </ul>
		<div class="form-inline my-2 my-md-0">
          <ul class="navbar-nav mr-auto">

            ${!${''}=($_SESSION["loggedin"]?'
              <li class="nav-item dropdown mr-2">
                <a class="btn btn-secondary dropdown-toggle" href="#" data-toggle="dropdown"><img src="inc/img/icons/gear.svg" alt="" width="24" height="24"> Beállítások</a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="reset-password.php">Új jelszó</a>

                  '.(user_perm()>=5?'
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header">Adminisztráció</h6>
                    <a class="dropdown-item" href="admin_user.php">Felhasználók</a>
                    <a class="dropdown-item" href="admin_userclass.php">Osztályok</a>
                    <a class="dropdown-item" href="admin_category.php">Kategóriák</a>
                  ':'').'

                </div>
              </li>
            ':'
              <li class="nav-item mr-2"><a class="btn btn-warning" href="register.php">Regisztráció</a></li>
            ')}

            ${!${''}=($_SESSION["loggedin"]?'
              <li class="nav-item"><a class="btn btn-danger" href="logout.php">Kijelentkezés</a></li>
            ':'
              <li class="nav-item"><a class="btn btn-success" href="login.php">Bejelentkezés</a></li>
            ')}
          </ul>
        </div>
      </div>
    </div>
  </nav>
HTML;

}


?>