<?php

/**
* Config.PHP
*
* @author	Eszényi Tamás
*/

session_start();

// Adatbázis adatok
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'usbw');
define('DB_NAME', 'rft_elearning');
 
// Csatlakozás a MySQL adatbázishoz
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
mysqli_set_charset($link, "utf8");
 
// Csatlakozás ellenőrzése
if($link === false){
    die("HIBA! A csatlakozás nem sikerült. ".mysqli_connect_error());
}

// Függvények beolvasása
foreach (glob('inc/php/*.php') as $inc) {
	
	include_once $inc;
}

?>