<?php

	/**
	* ADATBÁZIS: SQL UTASÍTÁSOK
	*
	* Minden az oldalon felhasznált SQL utasítás. Legyen az egy sima
	* lekérdezés, módosítás vagy törlés.
	*
	* @author	Eszényi Tamás, Kormány Milán, Veres Tamás
	*
	* @param	sring	$commName	utasítás neve
	* @param	array	$datas		adatok
	* @return	sring	Visszadja az összeállított lekérdezést.
	*/

	function db_sql ($commName, $datas = null) {

		switch ($commName) {

			/**
			* Felhasználó
			* user (id, username, password, created_at, permission)
			*
			* @author	Kormány Milán
			*/

			# Kód ilyesmi formában:
			#
			# case 'user:megnev': 
			#	return "sql-utasítás"; break;
			#


			/**
			* Teszt
			* test (id, curriculumid, name, content)
			* test_solved (id, testid, userid, answers)
			*
			* @author	Eszényi Tamás
			*/

			# Kód ilyesmi formában:
			#
			# case 'test:megnev': 
			#	return "sql-utasítás"; break;
			#


			/**
			* Tananyag
			* curriculum (id, categoryid, creatorid, name, content)
			* curriculum_category (id, name)
			* curriculum_read (id, curriculumid, userid, last, max)
			*
			* @author	Veres Tamás
			*/
			
			# Kód ilyesmi formában:
			#
			# case 'curriculum:megnev': 
			#	return "sql-utasítás"; break;
			#


			/**
			* Ha egyik se, akkor üreset adunk vissza.
			*/

			default: 
				return ''; break;

		}

	}

?>