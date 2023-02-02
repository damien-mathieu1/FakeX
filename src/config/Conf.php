<?php
namespace App\Fakex\config;

use App\Fakex\model\Repository\DatabaseConnection;

/**
 * Cette Classe stocke les informations importantes a stocker pour la connexion avec une base de données
 *
 * <p>
 * Elle est directment connecté avec la classe {@link DatabaseConnection}
 * </p>
 *
 */
class Conf {

    static private array $databases = array(
        // Le nom d'hote est webinfo a l'IUT
        // ou localhost sur votre machine
        //
        // ou webinfo.iutmontp.univ-montp2.fr
        // pour accéder à webinfo depuis l'extérieur
        'hostname' => 'webinfo.iutmontp.univ-montp2.fr',
        // A l'IUT, vous avez une BDD nommee comme votre login
        // Sur votre machine, vous devrez creer une BDD
        'database' => 'mathieud',
        // A l'IUT, c'est votre login
        // Sur votre machine, vous avez surement un compte 'root'
        'login' => 'mathieud',
        // A l'IUT, c'est votre mdp (INE par defaut)
        // Sur votre machine personelle, vous avez creez ce mdp a l'installation
        'password' => '0vAT_@Hd..UjqWpp'
    );

    static public function getLogin() : string {
    // L'attribut statique $databases s'obtient avec la syntaxe static::$databases 
    // au lieu de $this->databases pour un attribut non statique
    return static::$databases['login'];
  }

    static public function getDatabase() : string {
      return static::$databases['database'];
    }

    static public function getHostname() : string {
      return static::$databases['hostname'];
    }

    static public function getPassword() : string {
      return static::$databases['password'];
    }

    //a changer pour le projet
    static public function getAbsoluteURL() : string {
        return "https://localhost/devWeb/backend/web/frontController.php";
    }

}
?>

