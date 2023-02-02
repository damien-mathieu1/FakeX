<?php
namespace App\Fakex\controller;
use App\Fakex\lib\MotDePasse;
use App\Fakex\lib\VerificationEmail;
use App\Fakex\model\DataObject\Utilisateur;
use App\Fakex\model\Repository\ModeleRepository;
use App\Fakex\model\Repository\UtilisateurRepository;
DEFINE ('SALT_SUFFIX', 'wsh6759n' );
DEFINE ('SALT_PREFIX', 'hsgt49U2');
class ControllerUtilisateur{
    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require __DIR__ . "/../view/$cheminVue"; // Charge la vue
    }

    /**
     * Affiche la page de connexion d'un créateur
     * @return void
     */
    public static function connexionCreateur(){
        self::afficheVue('view.php',["pagetitle"=>"Connectez-vous"
        ,"cheminVueBody"=>"Utilisateur/connexionCreateur.php"]);
    }

    /**
     * Affiche la page de connexion d'un utilisateur
     * @return void
     */
    public static function connexionUtilisateur(){
        self::afficheVue('view.php',["pagetitle"=>"Connectez-vous"
        ,"cheminVueBody"=>"Utilisateur/connexionUtilisateur.php"]);
    }

    /**
     * Connecte le créateur et renvoie un message d'erreur si la connexion échoue ou de succès si elle réussit
     * @return void
     */
    public static function connectedUtilisateurCreateur(){
        $login = $_GET['login'];

        $pwd = hash("sha256",SALT_SUFFIX . $_GET['password'] . SALT_PREFIX);
        $result = (new UtilisateurRepository())->checkCreateur($login,$pwd);
        if($result){
            session_start();
            $_SESSION['login'] = $login;
            $_SESSION['logged_in']= true;
            $createur = (new UtilisateurRepository())->getCreateur($login);
            self::afficheVue('view.php',["pagetitle"=>"Ajoutez votre produit"
            ,"cheminVueBody"=>"Produit/creationProduit.php","nomCreateur"=> $createur]);
        }
        else{
            self::afficheVue('view.php',["pagetitle"=>"Connectez-vous [Createur]"
            ,"cheminVueBody"=>"Utilisateur/connexionCreateur.php","message"=>"Login ou mot de passe incorrect/Vous n'êtes peut être pas créateur"]);
        }
    }

    /**
     * Connecte l'utilisateur et renvoie un message d'erreur si la connexion échoue ou de succès si elle réussit
     * @return void
     */
    public static function connectedUtilisateurLambda(){
        $login = $_GET['login'];
        $pwd = hash("sha256",SALT_SUFFIX . $_GET['password'] . SALT_PREFIX);
        $result = (new UtilisateurRepository())->checkGlobal($login,$pwd);
        if($result){
            session_start();
            $_SESSION['login'] = $login;
            $_SESSION['logged_in']= true;
            ControllerModele::readAll();
        }
        else{
            self::afficheVue('view.php',["pagetitle"=>"Connectez-vous"
            ,"cheminVueBody"=>"Utilisateur/connexionUtilisateur.php","message"=>"Login ou mot de passe incorrect"]);
        }
    }

    /**
     * Affiche la page d'inscription d'un créateur
     * @return void
     */
    public static function inscriptionCreateur(){
        self::afficheVue('view.php',["pagetitle"=>"Inscrivez-vous"
        ,"cheminVueBody"=>"Utilisateur/inscriptionCreateur.php"]);
    }

    /**
     * Affiche la page d'inscription d'un utilisateur
     * @return void
     */
    public static function inscriptionUtilisateurLambda(){
        self::afficheVue('view.php',["pagetitle"=>"Inscrivez-vous"
        ,"cheminVueBody"=>"Utilisateur/inscriptionUtilisateurLambda.php"]);
    }

    /**
     * affiche le panier de l'utilisateur
     * @return void
     */
    public static function affichagePanier(){
        self::afficheVue('view.php', ["pagetitle"=>"Panier",
            "cheminVueBody"=>"Utilisateur/panierUtilisateur.php"]);
    }

    /**
     * Affiche la page de paiement du panier
     * @return void
     */
    public static function paiement(){
        self::afficheVue("view.php", ["pagetitle"=>"Paiement",
            "cheminVueBody"=>"Utilisateur/paiementUtilisateur.php"]);
    }

    /**
     * Affiche le compte de l'utilisateur et de toutes ses paires
     * @return void
     */
    public static function viewUtilisateur(){
        if(!isset($_GET['login'])){
            self::afficheVue('view.php',["pagetitle"=>"Connectez-vous"
            ,"cheminVueBody"=>"Utilisateur/connexionUtilisateur.php","message"=>"Vous devez être connecté pour accéder à votre compte"]);
        }
        else{
            self::afficheVue('view.php',["pagetitle"=>"Votre Compte","cheminVueBody"=>"Utilisateur/viewUtilisateur.php","user"=>(new UtilisateurRepository())->getUser($_GET['login'])]);
        }

    }

    /**
     * Crée un créateur et renvoie un message d'erreur si la création échoue ou de succès si elle réussit
     * @return void
     */
    public static function createdCreateur(){
        $hash = hash("sha256",SALT_SUFFIX . $_GET['password'] . SALT_PREFIX);

        if ((new UtilisateurRepository)->getUser($_GET['login']) != null) {
            self::afficheVue('view.php',["pagetitle"=>"Inscrivez-vous"
            ,"cheminVueBody"=>"Utilisateur/inscriptionCreateur.php","message"=>"Login déjà utilisé"]);
        }
        else{
            $user = new Utilisateur(1,$_GET['nom'],$_GET['prenom'],$_GET['login'],$hash,"",$_GET['email'],MotDePasse::generateString(32));
            VerificationEmail::envoiEmailValidation($user);
        }
    }

    /**
     * Crée un utilisateur et renvoie un message d'erreur si la création échoue ou de succès si elle réussit
     * @return void
     */
    public static function createdUtilisateurLambda(){
        $hash = hash("sha256",SALT_SUFFIX . $_GET['password'] . SALT_PREFIX);
        if((new UtilisateurRepository)->getUser($_GET['login'])!=null){
            self::afficheVue('view.php',["pagetitle"=>"Inscrivez-vous"
            ,"cheminVueBody"=>"Utilisateur/inscriptionUtilisateurLambda.php","message"=>"Login déjà utilisé"]);
        }
        else{
            $user = new Utilisateur(0,$_GET['nom'],$_GET['prenom'],$_GET['login'],$hash,"",$_GET['email'],MotDePasse::generateString(32));
            VerificationEmail::envoiEmailValidation($user);
        }
        
    }

    /**
     * valide le mail
     * @return void
     */
    public static function validerEmail(){
        
        $result = VerificationEmail::traiterEmailValidation();
        if($result){
            self::afficheVue('view.php',["pagetitle"=>"Connectez-vous"
            ,"cheminVueBody"=>"Utilisateur/connexionUtilisateur.php","message"=>"Votre email a bien été validé"]);
        }
        else{
            (new UtilisateurRepository())->delete($_GET['login']);
            self::afficheVue('view.php',["pagetitle"=>"Connectez-vous"
            ,"cheminVueBody"=>"Utilisateur/connexionUtilisateur.php","message"=>"Votre email n'a pas pu être validé"]);
        }
    }

    /**
     * déconnecte l'utilisateur et détruit la session
     * @return void
     */
    public static function deconnexion(){
        session_start();
        session_destroy();
        session_unset();
        ControllerModele::readAll();
    }

}
?>