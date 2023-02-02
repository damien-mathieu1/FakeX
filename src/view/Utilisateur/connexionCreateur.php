<div id="connection">
    <form method="get" action="frontController.php">
        <fieldset>
            <legend>Connexion en tant que créateur</legend>
            <hr>

            <input type='hidden' name='action' value='connectedUtilisateurCreateur'>
            <input type='hidden' name='controller' value='utilisateur'>
            <input type="text" placeholder="Nom d'utilisateur" name="login" id="login_id" required/>


            <input type="password" name="password" id="password_id" placeholder="Mot de passe" required/>

            <p>Vous n'avez pas de compte ? <a
                href="frontController.php?action=inscriptionCreateur&controller=utilisateur">Inscrivez vous</a>
            </p>

            <input type="submit" value="Se connecter"/>


        </fieldset>
    </form>
    <?php
    if (!empty($message)) {
        echo "<p class='flash'>$message</p>";
    }
    ?>
</div>
