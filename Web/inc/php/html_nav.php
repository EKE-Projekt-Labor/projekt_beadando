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
	HTML;

}


?>