<?php
namespace App\Fakex\controller;


use App\Fakex\model\Repository\ModeleRepository;
use App\Fakex\model\DataObject\Modele;
use App\Fakex\model\DataObject\Utilisateur;
use App\Fakex\model\Repository\UtilisateurRepository;

if(!isset($_SESSION)){
    session_start();
}


/**
 * Cette méthode est la classe intermédiaire entre les repository's et les vues
 *
 * <p>
 *  Elle connecte la classe {@link ModeleRepository} avec les vues qui affichent toute l'information récolté
 *
 * </p>
 */
class ControllerModele
{
    /**
     * affiche une vue selon un chemin et des paramètres qui seront transfomés en variables
     */
    private static function afficheVue(string $cheminVue, array $parametres = []): void
    {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require __DIR__ . "/../view/$cheminVue"; // Charge la vue
    }

    /**
     * affiche la page d'accueil
     */
    public static function readAll()
    {
        $modeles = (new ModeleRepository())->selectAll();
        self::afficheVue('view.php', ['modeles' => $modeles, "pagetitle" => "Accueil"
            , "cheminVueBody" => "Accueil/readAll.php"]);
    }

    /**
     * affiche une page avec les chaussures pour les hommes
     */
    public static function readMen()
    {
        $modeles = (new ModeleRepository())->selectMen();
        self::afficheVue('view.php', ['modeles' => $modeles, "pagetitle" => "Men Shoes"
            , "cheminVueBody" => "Accueil/readAll.php"]);
    }

    /**
     * affiche une page avec les chaussures pour les femmes
     */
    public static function readWomen()
    {
        $modeles = (new ModeleRepository())->selectWomen();
        self::afficheVue('view.php', ['modeles' => $modeles, "pagetitle" => "Men Shoes"
            , "cheminVueBody" => "Accueil/readAll.php"]);
    }

    /**
     * crée une chaussure et l'ajoute à la base de données en fonction des paramètres passés en get
     */
    public static function created()
    {
        $modeles = (new ModeleRepository())->selectAll();

        if (isset($_FILES['image'])) {
            $img_name = $_FILES['image']['name'];
            $img_size = $_FILES['image']['size'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $error = $_FILES['image']['error'];

            if ($error === 0) {
                if ($img_size > 12500000) {
                    self::afficheVue('view.php', ['modeles' => $modeles, "pagetitle" => "Accueil"
                        , "cheminVueBody" => "Accueil/readAll.php", "message" => "Image trop lourde"]);
                } else {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);

                    $allowed_exs = array("jpg", "jpeg", "png");

                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                        $img_path = __DIR__ . '/../../web/img/uploads/' . $new_img_name;
                        move_uploaded_file($tmp_name, $img_path);
                        if($_POST['minsize'] > $_POST['maxsize']){
                            self::afficheVue('view.php', ['modeles' => $modeles, "pagetitle" => "Accueil"
                                , "cheminVueBody" => "Accueil/readAll.php", "message" => "La taille minimum doit être inférieure à la taille maximum"]);
                        }
                        
                        $modele = new Modele(0, $_POST['paire'], $_POST['prix'], $_POST['createur'], 'frontController.php?action=afficheImage&controller=image&idImage=' . $new_img_name, $_POST['minsize'], $_POST['maxsize'], $_POST['genre'], $_POST["quantity"]);
                        (new ModeleRepository())->createShoe($modele);
                        $modeles = (new ModeleRepository())->selectAll();

                        self::afficheVue('view.php', ['modeles' => $modeles, "pagetitle" => "Accueil"
                            , "cheminVueBody" => "Accueil/readAll.php", "message" => "Produit ajouté avec succès"]);
                    } else {
                        self::afficheVue('view.php', ['modeles' => $modeles, "pagetitle" => "Accueil"
                            , "cheminVueBody" => "Accueil/readAll.php", "message" => "Erreur d'ajout du produit"]);
                    }
                }
            } else {
                self::afficheVue('view.php', ['modeles' => $modeles, "pagetitle" => "Accueil"
                    , "cheminVueBody" => "Accueil/readAll.php", "message" => "Erreur lors de la lecture de l'image"]);
            }
        } else {
            self::afficheVue('view.php', ['modeles' => $modeles, "pagetitle" => "Accueil"
            , "cheminVueBody" => "Accueil/readAll.php", "message" => "Erreur lors de l'ajout de l'ajout du produit (image)"]);
        }


    }

    /**
     * affiche un formulaire pour créer une chaussure
     */
    public static function createShoe()
    {
        $createur = (new UtilisateurRepository())->getCreateur($_SESSION['login']);

        self::afficheVue('view.php', ["pagetitle" => "Ajoutez votre produit"
            , "cheminVueBody" => "Produit/creationProduit.php", "nomCreateur" => $createur]);
    }

    /**
     * affiche une unique chaussure
     */
    public static function readSingleProduct()
    {
        $modele = (new ModeleRepository())->selectOne($_GET['id']);
        self::afficheVue('view.php', ['modele' => $modele,
            "pagetitle" => $modele->getNom() . " BY " . $modele->getCreator(),
            "cheminVueBody" => "Accueil/readSingleProduct.php"]);
    }

    /**
     * ajoute un produit au panier et affiche un message confirmant l'ajout
     */
    public static function addProduitPanier()
    {
        if (isset($_SESSION['login'])) {
            $idModele = $_GET['idmodele'];
            (new UtilisateurRepository())->ajoutProd($idModele);
            $modeles = (new ModeleRepository())->selectAll();

            self::afficheVue('view.php', ['modeles' => $modeles, "pagetitle" => "Accueil"
                , "cheminVueBody" => "Accueil/readAll.php", "message" => "Produit ajouté au panier avec succès !"]);
        }else{
            //add modele to $_COOKIE['panier']
            $idModele = $_GET['idmodele'];
            //add modele to $_COOKIE['panier']
            if (isset($_COOKIE['panier'])) {
                $panier = unserialize($_COOKIE['panier']);
                $panier[] = $idModele.";".$_GET['size'].";".$_GET['quantity'];
                setcookie('panier', serialize($panier), time() + 3600);
            } else {
                $panier = array();
                $panier[] = $idModele;
                setcookie('panier', serialize($panier), time() + 3600);
            }
            $modeles = (new ModeleRepository())->selectAll();

            self::afficheVue('view.php', ['modeles' => $modeles, "pagetitle" => "Accueil"
                , "cheminVueBody" => "Accueil/readAll.php", "message" => "Produit ajouté au panier avec succès !"]);
        }
    }
    /**
     * supprime un produit du panier et affiche un message confirmant la suppression
     */
    public static function suprProduitPanier()
    {
        if(isset($_SESSION['login'])) {
            $idModele = $_GET['idmodele'];
            (new UtilisateurRepository())->suprProd($idModele);
            $modeles = (new ModeleRepository())->selectAll();

            self::afficheVue('view.php', ['modeles' => $modeles, "pagetitle" => "Accueil"
                , "cheminVueBody" => "Accueil/readAll.php", "message" => "Produit supprimé du panier avec succès !"]);
        }else{
            $idModele = $_GET['idmodele'];
            $panier = unserialize($_COOKIE['panier']);
            
            $key = array_search($idModele, $panier);
            unset($panier[$key]);
            setcookie('panier', serialize($panier), time() + 3600);
            $modeles = (new ModeleRepository())->selectAll();

            self::afficheVue('view.php', ['modeles' => $modeles, "pagetitle" => "Accueil"
                , "cheminVueBody" => "Accueil/readAll.php", "message" => "Produit supprimé du panier avec succès !"]);
        }
    }


    /**
     * affiche le formulaire de modification d'un produit
     */
    public static function update(){
        $modele = (new ModeleRepository())->selectOne($_GET['id']);
        self::afficheVue('view.php', ['modele' => $modele,
            "pagetitle" => $modele->getNom() . " BY " . $modele->getCreator(),
            "cheminVueBody" => "Produit/updateProduit.php"]);
    }

    /**
     * modifie un produit et affiche un message confirmant la modification
     */
    public static function updated(){
        (new ModeleRepository())->updateShoe(new Modele($_POST["id"], $_POST["nom"], $_POST["prix"], $_POST["createur"], $_POST["imageUrl"],$_POST["minsize"], $_POST["maxsize"], $_POST["genre"], $_POST["quantity"] ));
        $modeles = (new ModeleRepository())->selectAll();
        self::afficheVue('view.php', ['modeles' => $modeles, "pagetitle" => "Accueil"
            , "cheminVueBody" => "Accueil/readAll.php", "message" => "Produit modifié avec succès !"]);
    }

    /**
     * supprime un produit et affiche un message confirmant la suppression
     */
    public static function delete(){
        // convert id from string to int
    
        (new ModeleRepository())->deleteShoe(intval($_GET['id']));
        $modeles = (new ModeleRepository())->selectAll();
        self::afficheVue('view.php', ['modeles' => $modeles, "pagetitle" => "Accueil"
            , "cheminVueBody" => "Accueil/readAll.php", "message" => "Produit supprimé avec succès !"]);
    }

    /**
     * recommande une chaussure et envoie un json de cette recommandation en fonction du paramètre search de l'url
     */
    public static function recommand()
    {
        $recommandations = (new ModeleRepository())->recommandShoe($_GET['search']);
        //print as a json array content of $recommandations
        echo json_encode($recommandations);
        header("Content-Type: application/json");
    }

    /**
     * recupere les informations concernant le best seller et retourne un json en fonction du paramètre rank de l'url
     */
    public static function bestSeller()
    {

        $bestSeller = (new ModeleRepository())->getBestSeller($_GET['rank']);
        //print as a json array content of $recommandations
        echo json_encode($bestSeller);
        header("Content-Type: application/json");
    }

}

?>


