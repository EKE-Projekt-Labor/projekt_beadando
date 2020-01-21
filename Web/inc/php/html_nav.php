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
	HTML;

}


?>