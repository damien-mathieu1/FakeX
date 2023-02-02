<div id="pay">
    <h2>
        Recapitulatif de votre commande
    </h2>
    <!--table containing as colums : name, price, size, quantity, total price-->
    <table>
        <tr>
            <th>Produit</th>
            <th>Prix</th>
            <th>Taille</th>
            <th>Quantité</th>
            <th>Total</th>
        </tr>
        <?php

        use App\Fakex\model\Repository\ModeleRepository;
        use App\Fakex\model\Repository\UtilisateurRepository;

        if (isset($_SESSION['login'])) {
            $panier = UtilisateurRepository::getProdPanier();
            $total = 0;
            foreach ($panier as $produit) {
                $total += $produit["prix"] * $produit["quantity"];
                echo '<tr>
            <td>' . $produit["nom"] . '</td>
            <td>' . $produit["prix"]. '</td>
            <td>' . $produit["taille"] . '</td>
            <td>' . $produit["quantity"] . '</td>
            <td>' . $produit["prix"] * $produit["quantity"] . '</td>
        </tr>';
            }
        } else {
            $modeles = unserialize($_COOKIE['panier']);
            foreach ($modeles as $elt) {
                if ($elt != "") {
                    $elt = explode(";", $elt);
                    if (count($elt) < 2) {
                        $elt[1] = "40";
                    }
                    if (count($elt) < 3) {
                        $elt[2] = "1";
                    }
                    $panier[] = ["modele" => (new ModeleRepository())->selectOne(intval($elt[0])),
                        "size" => $elt[1],
                        "quantity" => $elt[2]
                    ];
                }
            }
            $total = 0;
            foreach ($panier as $produit) {
                $total += $produit["modele"]->getPrix() * $produit["modele"]->getQuantity();
                echo '<tr>
            <td>' . $produit["modele"]->getNom() . '</td>
            <td>' . $produit["modele"]->getPrix() . '</td>
            <td>' . $produit["size"] . '</td>
            <td>' . $produit["quantity"] . '</td>
            <td>' . $produit["modele"]->getPrix() * $produit["quantity"] . '</td>
        </tr>';
            }
        }

        ?>
    </table>

    <div class="btnpages">
        <a href="frontController.php?action=pay&controller=utilisateur">Payer</a>
    </div>
</div>
