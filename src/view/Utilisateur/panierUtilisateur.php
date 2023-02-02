<div>
    <h2>
        Votre Panier
    </h2>
</div>
<div id="feed">
    <?php

    use App\Fakex\model\Repository\UtilisateurRepository;

    $modeles = UtilisateurRepository::getProdPanier();


    foreach ($modeles as $modele) {
        echo '<div>
    <a href="frontController.php?action=readSingleProduct&controller=modele&id=' . $modele->getIDModele() . '"/><img src="' . $modele->getImageUrl() . '"/></a>
    <div class="legend">
        <p>' . $modele->getNom() . ' BY ' . $modele->getCreator() . '</p>
        <p>$' . $modele->getPrix() . ' / ' . $modele->getMinSize() . ' - ' . $modele->getMaxSize() . '</p>
</div>
</div>
';
    }


    ?>
</div>
<div id="summary" class="contain">
    <a href="frontController.php?action=paiement&controller=utilisateur">PAIEMENT</a>
</div>