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

        #kiírás

    ?>
    </p>

<?php
    echo html_footer();
?>