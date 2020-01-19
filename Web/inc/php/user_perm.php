<?php

	/**
	* FELHASZNÁLÓ JOGOSULTSÁGI SZINTJE
	*
	* Két dologra alkalmas a függvény:
	*  - Lekérdezni a felhasználó jogosultségi szintjét.
	*  - Ellenőrizni, hogy a felhasználó jogosultsági szintje megfelel-e
	*    a megadott szinthez. Ha nem, akkor átirányít.
	*
	* @author	Kormány Milán
	*
	* @param	int		$perm	jogosultság
	* @return	bool	Ha a $perm értéke szám, akkor egy ellenőrzést
	*					követően visszaadja, hogy a felhasznló jogosult-e
	*					az adott oldal megtekintésére. Ha nem, akkor a
	*					kezdőlapra irányít.
	* @return	int		Ha a $perm értéke null, akkor a felhasználó 
	* 					jogosultsági szintjét adja vissza.
    */
    
?>