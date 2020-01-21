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
			case 'user:permission': 
				return "SELECT permission FROM user WHERE id = ".$_SESSION["id"]; break;

			case 'user:nameCheck': 
				return "SELECT id FROM user WHERE username = ?"; break; 
			
			case 'user:newReg': 
				return "INSERT INTO user (username, password) VALUES (?, ?)"; break; 
	
			case 'user:login': 
				return "SELECT id, username, password FROM user WHERE username = ?"; break; 
	
			case 'user:passNew': 
				return "UPDATE user SET password = ? WHERE id = ?"; break; 
	
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
			case 'curriculum:info': 
				return "SELECT id, name, content, (SELECT name FROM curriculum_category WHERE id = c.categoryid) as category, categoryid, creatorid, classid FROM curriculum as c WHERE id = ".$datas["id"]; break;
				
			case 'curriculum:new': 
				return "INSERT INTO curriculum (name, content, categoryid, creatorid) VALUES ('".$datas['name']."', '".$datas['content']."', ".$datas['categoryid'].", ".$datas['creatorid'].", ".$datas['classid'].")"; break;
				
			case 'curriculum:edit': 
				return "UPDATE curriculum SET name = '".$datas["name"]."', content = '".$datas["content"]."', categoryid = ".$datas["categoryid"].(user_perm()==9?", creatorid=".$datas["creatorid"]:'').", classid = ".$datas["classid"]." WHERE id = ".$datas["id"]; break;
				
			case 'curriculum:delete': 
				return ""; break;
				
			case 'curriculum:all': 
				return "SELECT id, (SELECT name FROM curriculum_category WHERE id = c.categoryid) as category, categoryid, name, SUBSTRING(content,1, 32) as content, (SELECT name FROM user_class WHERE id = c.classid) as class, classid, creatorid FROM curriculum as c".(user_perm()==5?" WHERE creatorid = ".$_SESSION["id"]:'').(user_perm()==1?" WHERE classid = ".$datas["classid"]:''); break;
				
			case 'curriculum:readInfo': 
				return "SELECT id, curriculumid, userid, last, max FROM curriculum_read WHERE curriculumid = ".$datas['curriculumid']." and userid = ".$_SESSION["id"]; break;
				
			case 'curriculum:readNew': 
				return "INSERT INTO curriculum_read (curriculumid, userid, last, max) VALUES (".$datas['curriculumid'].", ".$datas['userid'].", ".$datas['last'].", ".$datas['max'].")"; break;
			
			
			/**
			* Ha egyik se, akkor üreset adunk vissza.
			*/

			default: 
				return ''; break;

		}

	}

?>