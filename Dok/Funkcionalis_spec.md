# Funkcionális specifikáció

## Bevezetés
 Megrendlő részéről kaptunk egy olyan elképezlt weboldalt amely segíti a munkájukat, hogy a diákoknak könnyebben átadhassák a megfelelő tudusát és minnél több diákhoz elérjen a tananyag.

## Célok
A weboldal esetlőges célja az oktatás.
Mindezt kontrolált körülmények között. Bár a diákok szabadon választhassanak a tananyagok között, azonban a tanárok ezt tudják felügyeléni és ellenőrizni az elvégzett tananyagokat
milyen minőségben sikerült elsajátítani - tesztek formájában.
Az oldal hozzáféréséhez regisztrációra van szükség. - ez által a tanárok ellenőrizhetik ki mennyi időt töltött az oldalon és egy-egy tananyag elsajátításával.
A különböző tipusu felahsználók különböző jogosultságokkal bírjanak.
Diák: olvashat és tesztet tölthet ki
Tanár:Új tananyagot és tesztet adhat hozzá
Admin: A fentieken túl Ő álítja be a regisztrált user melyik csoportba milyen tulajdonságokkal rendelkezzenek.

## Jelenlegi helyzet

A program az oktatás jelenlegi problémáit kerülve egy sokkal inkább interaktívabb és rugalmasabb tanulást biztosít a tanulók számára akár az iskola keretein kívül is.

A felmerülő problémák megoldásai:

a diákok az igényeikhez mérten tudják használni
interaktív és játékos számonkérés a tananyagokat követően
modern, aktuális technológiákat használó igényes rendszer
Így egy modernebb gondolatú, a gyerekek számára interaktívabb, amit bárhol és bármikor tudnak használni a tanuláshoz.

## Követelménylista

Felhasználói szintek:
- látogatóként és firss regsiztrált felhasználóként csak a kezdőlap látható, illetve a regisztráció és a bejelentkezés
- tanuló jogosultságot a tanár és az adminisztrátor adhasson
- tanulóként elérhetők az osztályába tartozó tananyagok és ellenőrző kérdések
- tanárkén létrehozhatók a tananyagok és a tesztek, illetve kezelheti a tanulókat
- az adminisztrátornak mindenhez van jogosultsága
  
Tanárok által elérhető funkciók:
  - vihet fel a weben keresztül
      - témaköröket (matematika, fizika, informatika, stb)
      - tananyagokat
      - tesztanyagok, kérdések

Tanulók álatal elérhető funkciók
  - tananyagok
  - tesztek


## Használati esetek

Szereplők:

 Adminisztrátor
 Tanár
 Diák

Tevékenységek:

Tanár:
- Regisztráció
- Bejelentkezés tanárként
- Tananyagok létrehozása, szerkesztése és törlése
- Tananyag kategóriák szerkesztése
- Osztályok létrehozása
- Felhasználók jogainak menedzselése
- Jelszó változtatása

Adminisztrátor:


Minden fentebb említett 'Tanár' joggal rendelkezik.
 - Adminisztrátor oszthat ki Tanár státuszt.

Diák:
 - Regisztráció
 - Bejelentkezés diákként
 - Tananyag megtekintése
 - Tesztek megoldása
 - Statisztikák megtekintése
 - Jelszó változtatása

## Képernyőtervek

A weboldalbetöltése után a Tananyagok menüre kattintva egyből elérhetővé válnak tananyagok, amik melett olvashatók a témakörök.
A menü sorban helyet kap a bejelentkezés rész is. 

## Forgatókönyvek

Regisztráció: Az applikáció elindítása után, a kezdőképernyőn a Regisztráció gomb segítségével tudunk regisztrálni.
A gomb lenyomása után megadhatjuk adatainkat (Felhasználónév, Jelszó, Jelszó megerősítése), majd a Regisztráció gomb megnyomásával, amennyiben helyes adatokat adtunk meg,
a Bejelentkezés oldal fogad minket, melyet a kért adatok kitöltésével megvalósíthatunk,  belépünk a rendszerbe.

Bejelentkezés: Az oldal elindítás után, a navigációs sávon a Bejelentkezés gomb segítségével tudunk belépni a fiókunkba, amennyiben már előtte regisztráltunk egyet.
A gomb lenyomása után megadhatjuk a bejelentkezéshez szükséges adataink (Felhasználónév, Jelszó), és amennyiben helyes adatokat adtunk meg, úgy a Bejelentkezés gomb lenyomásával
 sikeresen beléphetünk a fiókunkba.
 
Tananyag kiválasztása:
 Sikeres bejelentkezést követően, a navigációs sáv  bal oldalán választhatunk a tananyagok és a tesztek között.
 Diák esetén csak olvasás és teszt kitöltési lehetőséggel.
 Tanár esetén ezek módsítására is van lehetőség. 
 Tananyagok alatt kategóriánként (Magyar irodalom, Történelem, Matek, stb.) láthatjuk felsorolva az adott anyagokat. A megnézéséhez, csupán rákell nyomni az általunk kiválasztott 
 tananyagra.

Tesztek kiválasztása
 Navigációs sávon a tesztek menü pont alatt választhatjuk ki a tesztek menüt ahol a tanárok által feltöltött kérdés sorokra adhatunk választ.
 Kitöltés után az eredményeket megtekinthetjük.
 
