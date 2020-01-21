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

			case 'user:classid': 
				return "SELECT classid FROM user WHERE id = ".$_SESSION["id"]; break;
		
			case 'user:info': 
				return "SELECT id, username, permission, (SELECT name FROM user_class WHERE id = u.classid) as class, classid FROM user as u WHERE id = ".$datas["id"]; break;
			
			case 'user:new': 
				return "INSERT INTO user (username, password, permission, classid) VALUES ('".$datas["username"]."', '".password_hash($datas['password'], PASSWORD_DEFAULT)."', ".$datas["permission"].", ".((int)$datas["permission"]==1?$datas["classid"]:'0').")"; break;
	
			case 'user:edit': 
				return "UPDATE user SET username = '".$datas["username"]."'".($datas["id"]==$_SESSION["id"]?'':", permission = ".$datas["permission"]).(trim($datas["password"])==''?'':", password = '".password_hash($datas['password'], PASSWORD_DEFAULT)."'").", classid = ".((int)$datas["permission"]==1?$datas["classid"]:'0')." WHERE id = ".$datas["id"]; break;
	
			case 'user:delete': 
				return ""; break;

			case 'user:all': 
				return "SELECT id, username, created_at, permission, (SELECT name FROM user_class WHERE id = u.classid) as class, classid FROM user as u".$datas['WHERE']; break;

			case 'user:classInfo': 
				return "SELECT id, name FROM user_class WHERE id = ".$datas["id"]; break;

			case 'user:classNew': 
				return "INSERT INTO user_class (name) VALUES ('".$datas['name']."')"; break;

			case 'user:classEdit': 
				return "UPDATE user_class SET name = '".$datas["name"]."' WHERE id = ".$datas["id"]; break;
			
			case 'user:classDelete': 
				return ""; break;

			case 'user:classAll': 
				return "SELECT id, name FROM user_class"; break;

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

			case 'test:info':   
				return "SELECT id, curriculumid, name, content, (SELECT name FROM curriculum WHERE id = t.curriculumid) as curriculumname FROM test as t WHERE id = ".$datas["id"]; break;

			case 'test:new':    
				return "INSERT INTO test (name, content, curriculumid) VALUES ('".$datas['name']."', '".json_encode($datas['content'], JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES)."', ".$datas['curriculumid'].")"; break;

			case 'test:edit':   
				return "UPDATE test SET name = '".$datas["name"]."', content = '".json_encode($datas['content'], JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES)."', curriculumid = ".$datas['curriculumid']." WHERE id = ".$datas["id"]; break;
			
			case 'test:delete': 
				return ""; break;
			
			case 'test:all':    
				return "SELECT id, (SELECT name FROM curriculum WHERE id = t.curriculumid) as curriculum, curriculumid, (SELECT creatorid FROM curriculum WHERE id = t.curriculumid) as creatorid, name, (SELECT IF(id>0,'true','false') FROM test_solved WHERE testid = t.id and userid = ".$_SESSION["id"].") as filled FROM test as t".(user_perm()==5?" WHERE (SELECT creatorid FROM curriculum WHERE id = t.curriculumid) = ".$_SESSION["id"]:'').(user_perm()==1?" WHERE (SELECT classid FROM curriculum WHERE id = t.curriculumid) = ".$datas['classid']:''); break;

			case 'test:fillInfo':
				return "SELECT id, testid, userid, answers, date FROM test_solved WHERE testid = ".$datas['testid']." and userid = ".$_SESSION["id"]; break;

			case 'test:fillNew':
				return "INSERT INTO test_solved (testid, userid, answers) VALUES (".$datas['testid'].", ".$_SESSION["id"].", '".json_encode($datas['answers'], JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES)."')"; break;

			case 'test:filledInfo':
				return "SELECT id, username, (SELECT answers FROM test_solved WHERE userid = u.id and testid = ".$datas['testid'].") as answers FROM user as u WHERE (SELECT userid FROM test_solved WHERE userid = u.id and testid = ".$datas['testid'].") = id"; break;


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
			
			case 'curriculum:readEdit': 
				return "UPDATE curriculum_read SET last = ".$datas["last"].", max = ".$datas["max"]." WHERE id = ".$datas["id"]; break;

			/**
			* Ha egyik se, akkor üreset adunk vissza.
			*/

			default: 
				return ''; break;

		}

	}

?>