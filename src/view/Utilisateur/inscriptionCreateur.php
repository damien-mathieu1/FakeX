<div id="connection">
    <form method="GET" action="frontController.php">
        <fieldset>
            <legend>Inscription créateur</legend>
            <hr>

            <input type='hidden' name='action' value='createdCreateur'>
            <input type='hidden' name='controller' value='utilisateur'>

            <?php
                if(isset($_GET['login'])){
                    echo "<input type='text' name='login' value='".$_GET['login']."' id='login_id' required>";
                }
                else{
                    echo "<input type='text' placeholder=\"Nom d'utilisateur\" name='login' id='login_id' required/>";
                }
            ?>
            <input type="password" name="password" id="password_id" placeholder="Mot de passe" required/>
            <?php
                if(isset($_GET['login'])){
                    echo "<input type='email' name='email' value='".$_GET['email']."' id='email' required>";
                }
                else{
                    echo "<input type='email' placeholder=\"email\" name='email' id='email' required/>";
                }
            ?>
            <?php
                if(isset($_GET['login'])){
                    echo "<input type='text' name='nom' value='".$_GET['nom']."' id='nom' placeholder=\"Nom\" required/>";
                }
                else{
                    echo "<input type='text' name='nom' id='nom' placeholder=\"Nom\" required/>";
                }            
            ?>
            <?php
                if(isset($_GET['login'])){
                    echo "<input type='text' name='prenom' value='".$_GET['prenom']."' id='prenom' placeholder=\"Prénom\" required/>";
                }
                else{
                    echo "<input type='text' name='prenom' id='prenom' placeholder=\"Prénom\" required/>";
                }
                ?>
            <input type="submit" value="Envoyer"/>

        </fieldset>
    </form>
    <?php
    if (!empty($message)) {
        echo "<p class='flash'>$message</p>";
    }
    ?>
</div>