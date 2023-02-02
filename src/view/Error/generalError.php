
<?php
    require __DIR__."../navbar.php";

    if(empty($message)){
        echo "<p>Erreur 404</p>";
    }
    else{
        echo "<p>Erreur : $message</p>";
    }
?>
