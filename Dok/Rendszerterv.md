# Rendszerterv

## 1. Rendszer célja

A rendszer célja egy olyan tanulást elősegítő oldal létrehozása, ahol a tanuló az ismeretanyagot digitális formában sajátíthatja el, egy gyorsan és könynen használható felületen. 
A tananyagok feltöltése egy adminisztrációs felületen keresztül történik. A tesztek is ezen a felületen hozhatók létre, ami egy megfelelő tananyaggal összekapcsolható. 
Az érétékelés automatikus, a beküldést követően azonnal látható mind a diák, mind a tanár számára.

Az oldal használatához egy felhasználói fiók szükséges, ami regisztráció segítségével hozható létre és az itt megadott adatokkal lehet később bejelentkezni.

Négy féle felhasználói van: a (sima) felhasználó, a tanuló, a tanár és az adminisztrátor. 
- A (sima) felhasználónak kezdtben semmilyen jogosultsága nincsen. Egy tanár vagy adminisztrátor adhat neki tanulói, tanár vagy admin jogot. 
- A tanuló eléri az osztályába tartozó témakörök tananyagait és a hozzájuk tartozó teszteket.
- A tanár létrehozhat osztályokat, módosíthatja a tanulók osztályát, létrehozhat témaköröket és tananyagokat, illetve teszteket.
- Az adminisztárotrnak minden jogosultsága megvan + kezelheti a tanári fiókokat.

## 2. Projekt terv
A projekt egy webalkalmazás, ami PHP alapokon nyugszik. E mellett HTML-t, CSS-t és JavaScript-et használunk. Az adatbázis pedig MySQL.
A különböző részeken más-más emberek dolgoznak.
Ahhoz naprakészen rendelkezésre álljon mindenkinél az aktuális project GIT-et használunk.
Kommunikációra Discordot.
Az egyes feladatokat pedig Trello-ban követjük.

## 3. Üzleti folyamatok modellje
xx

## 4. Követelmények

Egy PHP-t futtatni képes webszerver, MySQL adatbázissal.
Egy modern böngésző.

## 5. Funkcionális terv
Menü architektúra:
- Tananyagok
- Tesztek
- Bejelentkezés
- Regisztráció

Bejelentkezés után további menüpontok érhetők el jogosultságtól függően:
- Beállítások
    - Új jelszó 
    - Felhasználók (tanári jogosultsági szinttől)
    - Osztályok (tanári jogosultsági szinttől)
    - Kategóriák (tanári jogosultsági szinttől)

## 6. Fizikai környezet

Szerver oldalon egy Apache-ot, PHP-t és MySQL adatbázist futtatni képes operációs rendszer és az ehhez megfelelő hardverrel ellátott eszköz.

Kliens oldalon egy modern böngészőt futtatni képes operációs rendszerre van szükség (és ettől függően egy megfelelő hardverrel ellátott eszközre).
Az oldal struktúrájáért a HTML, a megjelenítésért a CSS és az interakciókért a JavaScript felelős.
    

## 7. Absztrakt domain modell

![Absztrakt domain modell](https://raw.githubusercontent.com/EKE-Projekt-Labor/projekt_beadando/master/Dok/Absztrakt_domain_model.png) 

A projekt absztrakció szempontjából két részre osztható fel:
- Felhasználó
- Szerver

## 8. Architekturális terv
xx

## 9. Adatbázis terv
Az oldal MySQL adatbázis fog használni, ide kerülnek fel majd a felhasználói adatok, a tanagyagokkal és a tesztekkel kapcsolatos adatok.
Első körben 3 táblára van szükségünk. Egy kell a felhasználók adatainak tárolásához, egy a tananyagoknak, egy pedig a teszteknek.
Utóbbihoz további táblák szükségesek: egy a kérdés/válaszok pároshoz és egy tábla, ahol a diákok által kitöltött válaszokat tároljuk.
A végső állapotában az alábbi 7 táblát alakítottuk ki.

**User** **Tábla** (A felhasználók adatait leíró tábla):

- **id**: A felhasználó azonosítója *int* típusú mező.
- **username**: A felhasználó felhasználónevét tároló ***varchar*** típusú mező.
- **password**: A felhasználó hashelt jelszavát tároló ***varchar*** típusú mező.
- **created_at**: A felhasználó fiókjának készítésének idejét tároló ***timestamp*** típusú mező.
- **permission**: A felhasználó jogosultságát tároló ***tinyiint*** típusú mező.
- **ClassID**: A felhasználó osztályának azonosítóját tároló ***int*** típusú mező.

**User_class** Tábla (A felhasználóhoz tartozó osztályokat leíró tábla):

- **ID**: Az osztály azonosítóját tároló ***int*** típusú mező.
- **Name**: A osztály nevét tároló ***varchar*** típusú mező.

**Curriculum** **Tábla** (A tantervet leíró tábla):

- **ID**: A tanterv azonosítóját tároló int típusú mező.
- **CategoryID**: A tanterv kategóriájának azonosítóját tároló ***int*** típusú mező.
- **CreatorID**: A tanterv készítőjének azonosítóját tároló ***int*** típusú mező.
- **Name**: A tanterv megnevezését tároló ***varchar*** típusú mező.
- **Content**: A tanterv leírását tároló ***varchar*** típusú mező.
- **ClassID**: A tanterv osztályspecifikus azonosítójához tartozó ***int*** típusú mező.

**Curriculum_category** **Tábla** (A tantervhez tartozó kategóriákat leíró tábla):

- **ID**: A tanterv kategóriájának azonosítóját tároló ***int*** típusú mező.
- **Name**: A tanterv kategóriájának nevét tároló ***varchar*** típusú mező.

**Curriculum_read** **Tábla** (A felhasználó által olvasott tananyaggal kapcsolatos adatokat leíró tábla):

- **ID:** A tananyag olvasásához tartozó adatok azonosítóját tároló ***int*** típusú mező.
- **CurriculumID:** A tananyag azonosítóját tároló ***int*** típusú mező.
- **UserID:** A felhasználó azonosítóját tároló ***int*** típusú mező.
- **Last:** A felhasználó által olvasott tananyag utolsó oldalnak az oldalszámát tároló ***int*** típusú mező.
- **Max:** A felhasználó által olvasott tananyag legnagyobb által megnézett oldalszámot tároló ***int*** típusú mező.

**Test Tábla** (A teszteket leíró tábla):

- **ID:** A teszt azonosítóját tároló ***int*** típusú mező.
- **CurriculumID:** A teszthez tartozó tanterv azonosítóját tároló ***int*** típusú mező.
- **Name:** A teszt megnevezését tároló ***varchar*** típusú mező.
- **Content:** A teszt tartalmi anyagát tároló ***varchar*** típusú mező.

**Test_solver Tábla** (A tesztek megoldásával kapcsolatos adatokat leíró tábla):

- **ID:** A teszt megoldások azonosítóját tároló ***int*** típusú mező.
- **TestID:** A teszt azonosítóját tároló ***int*** típusú mező.
- **UserID:** A felhasználó azonosítóját tároló ***int*** típusú mező.
- **Answers:** A megoldásokat tároló ***varchar*** típusú mező.
- **Date:** A teszt megoldásának beküldési idejét tároló ***timestamp*** típusú mező. 



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

Szükség van az interakciókért felelős elemek (gombok, linkek, űrlapok, stb.) folyamatos és több szempontból megközelített tesztelésére.
Nem elég egyszer, egyfajta adattal kipróbálni. Gondolni kell a hibásan megadott adatok lehetőségére is.
Ellenőrizni kell, hogy ahol hibák jöhetnek elő ott azok megfelelően levannak-e kezelve.
A felhasználóhoz nem juthat vissza működési hiba.

Tesztesetek:

| Azonosító | Teszt leírása | Elvárt viselkedés |
|-----------|---------------|-------------------|
| TEST_001  | A weboldal megnyitása | A weboldal sikeresen jelenjen meg |
| TEST_002  | A regisztrációs felület elérése | A felület legyen elérhető |
| TEST_004  | A regisztrációs felület kipróbálása helyes adatokkal | Sikeres regisztráció |
| TEST_005  | A regisztrációs felület kipróbálása helytelen adatokkal | Sikertelen regisztráció, hiba jelzése |
| TEST_006  | A regisztrációs felület kipróbálása létező felhasználói adatokkal | Sikertelen regisztráció, hiba jelzése |
| TEST_007  | A bejelentkező felület elérése | A felület legyen elérhető |
| TEST_008  | A bejelentkező felület kipróbálása helyes adatokkal | Sikeres bejelentkezés |
| TEST_009  | A bejelentkező felület kipróbálása helytelen adatokkal | Sikertelen bejelentkezés, hiba jelzése |
| TEST_010  | A bejelentkező felület kipróbálása nem létező felhasználói adatokkal | Sikertelen bejelentkezés, nem létező felhasználó jelzése |
| TEST_011  | A tananyagok oldal elérése |  A felület legyen elérhető |
| TEST_012  | A tananyag kipróbálása |  |
| TEST_014  | A tesztek oldal elérése |  A felület legyen elérhető |
| TEST_015  | A tesztek kipróbálása |  |
| TEST_016  |  |  |
| TEST_017  |  |  |


## 12. Telepítési terv

Helyi gépre való telepítés esetén a következőkre lesz szükség:
- Egy webszerver környezetre, ami tudja az Apache/PHP/MySQL hármast.
- Egy modern böngészőt futtatni képes operációs rendszer (és az ehhez megfelelő hardverrel ellátott eszköz).
- Egy modern böngésző.

Webtárhelyre való telepítés esetén a következőkre lesz szükség:
- Egy a Apache/PHP/MySQL hármast támogató tárhely.
- Egy program, amivel FTP kapcsolaton keresztül feltölthetők a webalkalmazás fájljai.
- Egy modern böngésző.

## 13. Karbantartási terv
A platform nem igényel jelentős karbantartást. Főként az adatok és az adatbázis szerver felügyeletével kapcsolatos teendők kapcsolódhatnak a karbantartáshoz. 
Ügyelni kell a terheltség folyamatos monitorozására. Bejövő adatbázis requesteket monitorozni kell, és esetenként optimalizálni amennyiben nagy a terheltség.
Elavult, valamint már nem releváns tananyagok vagy tesztek esetében a megfelelő jogosultsággal
rendelkező felhasználók bármikor módosíthatják vagy törölhetik, így ez nem igényel külsös segítségét. Funkcionalitás bővítése esetén merülhetnek fel problémák, ezen problémák elkerülésének érdekében bővítés esetén precízen kell megtervezni az új verziókat.

