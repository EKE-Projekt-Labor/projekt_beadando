<?php

	/**
	* HTML: FEJLÉC
	*
	* Beleértve a <head> blokkot és a vizuálisan is megjelenő fejlécet,
	* ami már a <body> tag-en belül szerepel.
	*
	* @author	Veres Tamás
	*
	* @param	string	$title	cím
	* @param	array	$datas	adatok
	* @return	string	Fejléc.
	*/
	
	function html_header ($title, $datas=null) {

		return 
<<<HTML

<!DOCTYPE html>
<html>
<head>
  <title>${!${''}=strip_tags($title)}</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="inc/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="inc/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="inc/css/bootstrap.min.css">
  <link rel="stylesheet" href="inc/css/styles.css">
  <script type="text/javascript" src="inc/js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="inc/js/popper.min.js"></script>
  <script type="text/javascript" src="inc/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  ${!${''}=html_nav((isset($datas['navActive'])?$datas['navActive']:null))}
  <div class="container">
    <main role="main">
      <div class="jumbotron">
        <h1>{$title}</h1>

HTML;

	}

?>