<?php

namespace App\Fakex\controller;

class ControllerImage
{
    //affiche une image selon une url passée en get
    public static function afficheImage(){
        //affiche une image sans utiliser d'ImageRepository en sachant que l'image est stockée dans /backend/web/img/uploads
        //et que l'id du modèle est dans l'url

        header("Content-type: image/jpeg");
        echo file_get_contents(__DIR__ . '/../../web/img/uploads/'.$_GET['idImage']);
    }
}