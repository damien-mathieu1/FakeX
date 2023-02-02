
<div id="product">
    <div>
        <?php echo '<img src="' . $modele->getImageUrl() . '"/>'; ?>
    </div>
    <div id="details">
        <div id="header-details">
            <div id="title">
                <h2><?php echo '<p>' . $modele->getNom();?></h2>
                <p>BY <?php echo $modele->getCreator()?></p>
            </div>
            <p>$<?php echo $modele->getPrix()?></p>
        </div>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cursus interdum eleifend odio nulla. A donec
            lobortis donec nibh turpis nulla eget quis. Tortor lorem duis neque vitae nunc. Suspendisse magna commodo in
            semper nunc.
        </p>
        <p><b>Sizes : </b></p>
        <div id="grid-size">
            <?php
            for($i = $modele->getMinSize(); $i <= $modele->getMaxSize(); $i++){
                echo '<div class="size-btn"><p>'.$i.'</p></div>';
            }
            ?>
        </div>

        <form method="get" action="frontController.php">
            <div id="quantities">
                <p><b>Quantities : </b></p>
                <input required type="number" name="quantity" min="1" max="<?php echo $modele->getQuantity(); ?>">
            </div>
            <input type="hidden" name="action" value="addProduitPanier">
            <input type="hidden" name="controller" value="modele">
            <input type="hidden" required name="idmodele" value="<?php echo $modele->getIdModele();?>">
            <input type="hidden" required name="size" value="" id="sizeselector">
            <input disabled="true" type="submit" value="ADD TO CART" id="submitprod">

        </form>
    </div>
</div>
