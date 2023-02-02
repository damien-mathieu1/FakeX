<?php
use App\Fakex\model\Repository\UtilisateurRepository;

        $utilisateur = $user;
        $products = (new UtilisateurRepository())->getProductCreated($utilisateur->getLogin());
        ?>
<div id="pay">
    <h2>
        Profil de <?php echo $utilisateur->getPrenom() . " " . $utilisateur->getNom(); ?>
    </h2>

    <?php
        // L'utilisateur est connecté
        echo '<li><a href="frontController.php?action=deconnexion&controller=utilisateur">Log out</a></li><h2>Login:</h2>';
    
    ?>

    <table>
        <tr>
            <th>Nom</th>
            <th>Taille max</th>
            <th>Taille min</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Genre</th>
            <th>Delete</th>
        </tr>
        <?php
        foreach ($products as $product) {
            echo '<tr>
            <td><a href="frontController.php?action=update&controller=modele&id='.$product->getIdModele().'">' . $product->getNom() . '</a></td>
            <td>' . $product->getMaxSize() . '</td>
            <td>' . $product->getMinSize() . '</td>
            <td>' . $product->getPrix() . '</td>
            <td>' . $product->getQuantity() . '</td>
            <td>' . $product->getGenre() . '</td>
            <td><a href="frontController.php?action=delete&controller=modele&id=' . $product->getIdModele() . '">x</a></td>
        </tr>';
        }
        ?>
    </table>

</div>
