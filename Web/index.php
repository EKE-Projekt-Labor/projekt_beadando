<?php

/**
* Index.PHP
*
* @author   Eszényi Tamás
*/

session_start();
require 'config.php';
 

echo html_header ('Üdvözlet <b>'.htmlspecialchars($_SESSION["username"]).'</b>!');

?>

    <p>
    <?php

        // Átlagos felhasználó
        if ($_SESSION["loggedin"] && user_perm() > 0) {
            echo "Használd a fenti menüpontot a Tananyagok, Tesztek és Játékok eléréshez.";
        }

        // Joggal rendelkező felhasználó
        else if ($_SESSION["loggedin"] && user_perm() === 0) {
            echo "Jelenleg csak sima felhasználó vagy, nem érhetők el számodra a szolgáltatások.<br>";
            echo "Kérj meg egy tanárt vagy admint, hogy adják meg neked a megfelelő jogosultságot!";
        } 

        // Látogató
        else {
            echo 'Az oldal használatához egy regisztrált fiókra van szükség.';
        }

    ?>
    </p>

<?php
    echo html_footer();
?>