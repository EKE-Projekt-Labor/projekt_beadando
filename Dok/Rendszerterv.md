# Rendszerterv

## 1. Rendszer célja

A rendszer célja egy olyan tanulást elősegítő oldlal létrehozása, ahol a tanuló az ismeretanyagot játékos formában sajátítja el. 
A tananyagok feltöltése egy adminisztrációs felületen keresztül történik. A játékos gyakorlatok is ezen a felületen hozhatók létre. 
A tesztekhez való feladatok (és válaszok) felhvihetők egy listára, ahonanan a számonkéréskor ezeket válogatja össze a rendszer. 
Az érétékelés automatikus, a beküldést követeően azonnal látható mind a diák, mind a tanár számára.

Az oldal használatához egy felhasználói fiók szükséges, ami regisztráció segítségével hozható létre és az itt megadott adatokkal lehet később bejelentkezni.
Két féle felhasználói van: az adminisztrátor és a diák. Az előbbi mindenhez hozzáfér, kezelheti a tananyagokat és teszteket is. Az utóbbi pedig aktívan használhatja őket.

## 2. Projekt terv
A projekt egy webalkalmazás, ami PHP alapokon nyugszik. E mellett HTML-t, CSS-t és JavaScript-et használunk. Az adatbázis pedig MySQL.
A különböző részeken más-más emberek dolgoznak.
Ahoz naprakészen rendelkezésre álljon mindenkinél az aktuális project GIT-et használunk.
Kommunikációra Discordot.
Az egyes feldatokat pedig Trello-ban követjük.

## 3. Üzleti folyamatok modellje
xx

## 4. Követelmények

Egy PHP-t futtatni képes webszerver, MySQL adatbázissal.
Egy modern böngésző.

## 5. Funkcionális terv
Menü architektura:
    - Tananyagok
    - Tesztek
    - Bejelentkezés
    - Regisztráció

## 6. Fizikai környezet

Szerver oldalon egy Apache-ot, PHP-t és MySQL adatbázist futtatni képes operációs rendszer és az ehhez megfelelő hardverrel elátott eszköz.

Kliens oldalon egy modern böngészőt futtatni képes operációs rendszerre van szükség (és ettől függően egy megfelelő hardverrel elátott eszközre).
Az oldal struktúrájáért a HTML, a megjelenítésért a CSS és az interakciókért a JavaScript felelős.
    
## 7. Absztrakt domain modell

A projekt absztrakció szempontjából két részre osztható fel:
- Felhasználó
- Szerver

## 8. Architekturális terv
xx

## 9. Adatbázis terv
xx

## 10. Implementációs terv

Backend részen a kiszolgáló egy PHP-ban készült szolgáltatás lesz.

Metódusai:

 - Regisztráció
 - Login
 - Logout
 - Jelszóváltoztatás
 - Tananyagok létrehozása,
   - olvasás
   - új/szerkesztése
   - törlése
 - Tesztek létrehozása, módosítása
   - eredmények megjelenítése (felhasználókra bontva)
   - teszt és eredmények törlése
 - Jogosultságok kiosztása a tananyag és teszt hozzáférésekhez (tanári és admin fiók)

Web

A Webes felület főként PHP, CSS - BootStrap, és JS alappal készül.
Ezeket a technológiákat amennyire csak lehet külön fájlokba írva készítjük, és így csatoljuk egymáshoz őket a jobb átláthatóság, 
könnyebb változtathatóság, és könnyebb bővítés érdekében. Backenden megírt funkciók segítségével képes felvinni és lekérdezni adatokat az adatbázisból.

## 11. Tesztterv
A fejlesztés során folyamatos tesztelésre van szükség, hogy az estleges hibákat még idejében felismerjük és javítsuk, lekezeljük.

Szükség van az interkaciókért felelős elemek (gombok, linkek, űrlapok, stb.) folyamatos és több szempontból megközelített tesztelésére.
Nem elég egyszer, egyfajta adattal kipróbálni. Gondolni kell a hibásan megadaott adatok lehetőségére is.
Ellenőrizni kell, hogy ahol hibák jöhetnek elő ott azok megfelelően levannak-e kezelve.
A felhasználóhoz nem juthat vissza működési hiba.

Tesztesetek:

| Azonosító | Teszt leírása | Elvárt viselkedés |
|-----------|---------------|-------------------|
| TEST_001  | A weboldal megnyitása | A weboldal sikeresen jelenjen meg |
| TEST_002  | A regisztrációs felület elérése | A felület legyen elérhető |
| TEST_004  | A regisztrációs felület kipróbálása helyes adatokkal | Sikeres regisztráció |
| TEST_005  | A regisztrációs felület kipróbálása helytelen adatokkal | Sikertelen regisztráció, hiba jelzése |
| TEST_006  | A regisztrációs felület kipróbálása létező felhasználói adatokkal | Sikertelen regisztáció, hiba jelzése |
| TEST_007  | A bejelentkező felület elérése | A felület legyen elérhető |
| TEST_008  | A bejelentkező felület kipróbálása helyes adatokkal | Sikeres bejelentkezés |
| TEST_009  | A bejelentkező felület kipróbálása helytelen adatokkal | Sikertelen bejelentkezés, hiba jelzése |
| TEST_010  | A bejelentkező felület kipróbálása nem létező felhasználói adatokkal | Sikertelen bejelntkezés, nem létező felhasználó jelzése |
| TEST_011  | A tananyagok oldal elérése |  A felület legyen elérhető |
| TEST_012  | A tananyag kipróbálása |  |
| TEST_014  | A tesztek oldal elérése |  A felület legyen elérhető |
| TEST_015  | A tesztek kipróbálása |  |
| TEST_016  |  |  |
| TEST_017  |  |  |


## 12. Telepítési terv

Helyi gépre való telepítés esetén a következőkre lesz szükség:
- Egy webszerver környezetre, ami tudja az Apache/PHP/MySQL hármast.
- Egy modern böngészőt futtatni képes operációs rendszer (és az ehhez megfelelő hardverrel elátott eszköz).
- Egy modern böngésző.

Webtárhelyre való telepítés esetén a következőkre lesz szükség:
- Egy a Apache/PHP/MySQL hármast támogató tárhely.
- Egy program, amivel FTP kapcsolaton keresztül feltölthetők a webalkalmazás fájljai.
- Egy modern böngésző.

## 13. Karbantartási terv
A platform nem igényel jelentős karbantartást. Főként az adatok és az adatbázis szerver felügyeletével kapcsolatos teendők kapcsolódhatnak a karbantatárshoz. 
Ügyenlni kell a terheltség folyamatos monitorozására. Bejövő adatbázis requesteket monitorozni kell, és esetenként optimalizálni amennyiben nagy a terheltség.
Elavult, valamint már nem releváns tanyangok vagy tesztek esetében a megfelelő jogosultsággal
rendelkező felhasználók bármikor módosíthatják vagy törölhetik, így ez nem igényel külsős segítségét. 

