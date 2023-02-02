<div id="connection">
    <form method="POST" action="frontController.php?action=created&controller=modele"  enctype="multipart/form-data">
        <fieldset>
            <legend>Ajouter un produit</legend>
            <hr>

                <input type="text" placeholder="Nom de votre paire" name="paire" id="paire_id" required/>
                <input type="number" name="prix" id="prix_id"  placeholder="Prix de votre paire" required/>
            <?php
                echo "
                                <label for=\"createur_id\">Votre nom de createur :</label> 
                                <input type=\"text\" name=\"createur\" id=\"createur_id\" value=\"{$nomCreateur}\" readonly/>
                            ";
            ?>
                 <label for="genre">Genre de votre paire :</label>
                <select id="genre" name="genre" required>
                <option disabled selected value> -- Choissisez un genre -- </option>                    <option value="H" >Homme</option>
                    <option value="F" >Femme</option>
                    <option value="H/F">Unisexe</option>
                </select>
                <label for="image">Image de votre paire</label>
                <input type="file" name="image"     accept="image/*" required/>

                <label for="quantity">Quantities : </label>
                <input type="number" name="quantity" required />

                <label for="maxsize">Max size : </label>
                <input type="number" name="maxsize" required />

                <label for="minsize">Min size : </label>
                <input type="number" name="minsize" required />

                <input type="submit" value="Envoyer"/>
        </fieldset>
    </form>
    
</div>
