# Rendszerterv

## 1. Rendszer célja

A rendszer célja egy olyan tanulást elősegítő oldal létrehozása, ahol a tanuló az ismeretanyagot digitális formában sajátíthatja el, egy gyorsan és könnyen használható felületen. 
A tananyagok feltöltése egy adminisztrációs felületen keresztül történik. A tesztek is ezen a felületen hozhatók létre, ami egy megfelelő tananyaggal összekapcsolható. 
Az érétékelés automatikus, a beküldést követően azonnal látható mind a diák, mind a tanár számára.

Az oldal használatához egy felhasználói fiók szükséges, ami regisztráció segítségével hozható létre és az itt megadott adatokkal lehet később bejelentkezni.

Négy féle felhasználói van: a (sima) felhasználó, a tanuló, a tanár és az adminisztrátor. 
- A (sima) felhasználónak kezdetben semmilyen jogosultsága nincsen. Egy tanár vagy adminisztrátor adhat neki tanulói, tanár vagy admin jogot. 
- A tanuló eléri az osztályába tartozó témakörök tananyagait és a hozzájuk tartozó teszteket.
- A tanár létrehozhat osztályokat, módosíthatja a tanulók osztályát, létrehozhat témaköröket és tananyagokat, illetve teszteket.
- Az adminisztrátornak minden jogosultsága megvan + kezelheti a tanári fiókokat.

## 2. Projekt terv
A projekt egy webalkalmazás, ami PHP alapokon nyugszik. E mellett HTML-t, CSS-t és JavaScript-et használunk. Az adatbázis pedig MySQL.
A különböző részeken más-más emberek dolgoznak.
Ahhoz naprakészen rendelkezésre álljon mindenkinél az aktuális project GIT-et használunk.
Kommunikációra Discordot.
Az egyes feladatokat pedig Trello-ban követjük.

## 3. Üzleti folyamatok modellje
- Üzleti Szereplők:
  - Felhasználók: A szerepkör a webes felületen való regisztrációval jön létre. Sikeres regisztrációt követően minden felhasználó jogosultságot kap. Ez a jogosultsági szint határozza meg, hogy milyen funkciókat ér el a weboldalon.
    - Oktatók: Azok a felhasználók akik olyan jogosultsággal rendelkeznek, amellyel képesek új tananyagot és teszteket feltölteni. 
    - Diákok: Azok a felhasználók akik olyan jogosultsággal rendelkeznek, amellyel a teszteket tölthetnek ki és annak eredményeit nézhetik meg.
    - Adminisztrátor: Teljes hozzáférés az összes funkcióhoz. Tananyagok és tesztek teljes körű menedzselése. Felhasználói fiókok kezelése.
- Támogatandó üzleti folyamatok:
  - Felhasználó azonosítás: 
  
    - A felhasználó beviszi a nevét és jelszavát a webes felületre majd 
       a program megvizsgálja hogy létezik-e ilyen felhasználó az adatbázisban
       amennyiben igen a jelszóra használja a megfelelő titkosítási algoritmust
       és megvizsgálja hogy a felhasználóhoz tárolt jelszó megegyezik-e a 
       bevitel amennyiben igen sikeresen tovább jut a fájl lista felületre
       ellenkező esetben pedig a megfelelő hiba üzenetet kapja a felhasználó.
  
  - Felhasználó regisztráció:
  
    - A felhasználónak ki kell tölteni a regisztrációhoz szükséges űrlapot bizonyos megkötésökkel. Az űrlap kitöltéséhez az alábbi adatokat kell megadni:
  
      - Felhasználónév: Egyedinek kell lennie. (Két azonos felhasználónév nem létezhet.)
      - Jelszó: Minimum 6 karakternek kell lennie.
      - Jelszó megerősítésé: Megegyezik a Jelszóval.
  
      A jelszavak az adatbázisba való beillesztéskor hashelt változatban kerülnek be, ezzel is védve őket IT biztonsági szempontokat figyelembe véve.
  
  - Jelszó visszaállítás:
  
    - Lehetőséget biztosít, hogy ha a felhasználó elfelejtette a felhasználójához tartozó jelszót, párgombnyomással vissza tudja állitani. Az új jelszónak is meg kell felelni a regisztrációkor felsorolt tényezőknek. (Jelszó: Minimum 6 karakternek kell lennie / Jelszó megerősítésé: Megegyezik a Jelszóval.) Majd az új jelszó ismételten a bizonyságra ügyelve felül íródik az adott felhasználójában.
  
  - Tananyag feltöltése:
  
    - Letőség van a tanároknak új tananyagokat feltölteni. Ezeket az alábbi funkciókat lehet találni:
  
      - Létrehozás
      - Frissítés
      - Módosítás
  
      Ezeket a tananyagokat tudják elolvasni a diákok, és az ebből származó információt tudják használni a tesztek megírása során.
  
  - Tesztek feltöltése:
  
    - Lehetőséget biztosit ellenőrző kérdések "Tesztek" létrehozása. A teszek feltöltéséhez jogosultság szükséges. A tesztekhez kérdés-válasz-megoldás hármasokat használva alakíthatunk ki egy teljes kérdés sort.
  
  - Tesztek megírása:
  
    - Lehetséges, a oktató anyagok elolvasás után az előre definiált teszteket megírni. 
  
  - Tesztek eredménye:
  
    - A tesztek megírása után értékelés látható a tesz végéről. 

## 4. Követelmények

Egy PHP-t futtatni képes webszerver, MySQL adatbázissal.
Egy modern böngésző.

## 5. Funkcionális terv
Menü architektúra:
- Tananyagok
- Tesztek
- Bejelentkezés
- Regisztráció

Bejelentkezés után további menü pontok érhetők el jogosultságtól függően:
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

A rendszer folyamatosan bővíthető a tanárok által. Új tananyagot és tesztet hozhatnak létre vagy módosíthatják a már meglévőket.

Biztonsági funkciók közé tartozik, hogy van adminisztrátori fiók. Az adminisztrátor minden regisztrált felhasználó adatát láthatja és kezelheti, kivéve a jelszót, mivel az titkosítva van eltárolva. Minden felhasználó csak a saját adatait módosíthatja.

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

**Backend** részen a kiszolgáló egy PHP-ban készült szolgáltatás lesz.

Funkciók:
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

**Frontend**

A Webes felület főként PHP, CSS - BootStrap, és JS alappal készül.
Ezeket a technológiákat amennyire csak lehet külön fájlokba írva készítjük, és így csatoljuk egymáshoz őket a jobb átláthatóság, 
könnyebb változtathatóság, és könnyebb bővítés érdekében. Backenden megírt funkciók segítségével képes felvinni és lekérdezni adatokat az adatbázisból.

## 11. Tesztterv
A fejlesztés során folyamatos tesztelésre van szükség, hogy az estleges hibákat még idejében felismerjük és javítsuk, lekezeljük.

Szükség van az interakciókért felelős elemek (gombok, linkek, űrlapok, stb.) folyamatos és több szempontból megközelített tesztelésére.
Nem elég egyszer, egyfajta adattal kipróbálni. Gondolni kell a hibásan megadott adatok lehetőségére is.
Ellenőrizni kell, hogy ahol hibák jöhetnek elő ott azok megfelelően levannak-e kezelve.
A felhasználóhoz nem juthat vissza működési hiba.

### Tesztesetek:

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
| TEST_012  | A tananyag kipróbálása | A tananyag legyen olvasható/szerkeszthető (felhasználótól függően) |
| TEST_014  | A tesztek oldal elérése |  A felület legyen elérhető |
| TEST_015  | A tesztek kipróbálása | A tesztet lehessen kitölteni/szerkeszteni (felhasználótól függően) |


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

