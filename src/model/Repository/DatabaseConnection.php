<?php 
namespace App\Fakex\model\Repository;
use App\Fakex\config\Conf;
use PDO;

/**
 * La classe <strong> Database Connection </strong> instantie et configure un {@link PDO}
 * <p>
 * Cette classe possède le SingleTon pattern
 * Ce qui permet l'utilisation d'une seule connexion a la base de données.
 * </p>
 */
class DatabaseConnection{
	private static ?DatabaseConnection $instance = null;

    private PDO $pdo;

    public static function getPdo():PDO {
        return static::getInstance()->pdo;
    }
	
    public function __construct(){
    	$hostname = Conf::getHostname();
		$login = Conf::getLogin();
		$database = Conf::getDatabase();
        $password = Conf::getPassword();
    	// Connexion à la base de données            
		// Le dernier argument sert à ce que toutes les chaines de caractères 
		// en entrée et sortie de MySql soit dans le codage UTF-8
		$this->pdo = new PDO("mysql:host=$hostname;dbname=$database", $login, $password,
		                     array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

		// On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    }

    // getInstance s'assure que le constructeur ne sera 
   // appelé qu'une seule fois.
   // L'unique instance crée est stockée dans l'attribut $instance
    private static function getInstance():DatabaseConnection {
        // L'attribut statique $pdo s'obtient avec la syntaxe static::$pdo 
        // au lieu de $this->pdo pour un attribut non statique
        if (is_null(static::$instance))
            // Appel du constructeur
            static::$instance = new DatabaseConnection();
        return static::$instance;
    }

}
?>