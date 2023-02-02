<?php
    // Initialise la session

// Détruit la session

use App\Fakex\controller\ControllerModele;

session_destroy();

// Supprime toutes les variables de session
session_unset();

ControllerModele::readAll();
?>