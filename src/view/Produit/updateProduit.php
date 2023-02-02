<div id="connection">
    <form method="POST" action="frontController.php?action=updated&controller=modele"  enctype="multipart/form-data">
        <fieldset>
            <legend>Modifier un produit</legend>
            <hr>
                <!--input caché pour récupérer l'id du modele-->
                <input type="hidden" name="id" value="<?php echo $modele->getIdModele(); ?>" />
                <input type="hidden" name="imageUrl" value="<?php echo $modele->getImageUrl(); ?>" />
                <input type="text" placeholder="Nom de votre paire" name="nom" id="paire_id" value="<?php echo $modele->getNom(); ?>" required/>
                <input type="number" name="prix" id="prix_id"  placeholder="Prix de votre paire" value="<?php echo $modele->getPrix(); ?>" required/>
            <?php
                echo "
                                <label for=\"createur_id\">Votre nom de createur :</label> 
                                <input type=\"text\" name=\"createur\" id=\"createur_id\" value=\"{$modele->getCreator()}\" readonly/>
                            ";
            ?>
                 <label for="genre">Genre de votre paire :</label>
                <select id="genre" name="genre" required>
                <option disabled selected value> -- Choissisez un genre -- </option>                    <option value="H" >Homme</option>
                    <option value="F" >Femme</option>
                    <option value="H/F">Unisexe</option>
                </select>
              

                <label for="quantity">Quantities : </label>
                <input type="number" value="<?php echo $modele->getQuantity(); ?>" name="quantity" required />

                <label for="maxsize">Max size : </label>
                <input type="number" value="<?php echo $modele->getMaxSize(); ?>" name="maxsize" required />

                <label for="minsize">Min size : </label>
                <input type="number" value="<?php echo $modele->getMinSize(); ?>" name="minsize" required />

                <input type="submit" value="Envoyer"/>
        </fieldset>
    </form>
    
</div>
