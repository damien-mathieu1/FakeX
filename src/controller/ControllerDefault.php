<?php
namespace App\Fakex\controller;
use App\Fakex\model\Repository\ModeleRepository;
use App\Fakex\model\Repository\UtilisateurRepository;
class ControllerDefault {

    //affiche une vue selon un chemin et des paramètres qui seront transfomés en variables
    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require __DIR__ . "/../view/$cheminVue"; // Charge la vue
    }

    //affiche la page d'accueil
    public static function accueil(){
        $modeles = (new ModeleRepository())->selectAll();
        self::afficheVue('view.php',['modeles'=>$modeles,"pagetitle"=>"Accueil"
        ,"cheminVueBody"=>"Accueil/readAll.php"]);
    }
    //affiche une page d'erreur
    public static function error() : void {
        self::afficheVue('Error/generalError.php');
    }
}
?>