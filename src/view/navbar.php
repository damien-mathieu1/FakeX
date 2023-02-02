<nav>
    <div>
        <a href="frontController.php?action=readAll&controller=modele" style="color: inherit; text-decoration: none;"><img src="./img/logo.png" alt="dennis ritchie" ></a>
        <div id="logo" >
            <a href="frontController.php?action=readAll&controller=modele" style="color: inherit; text-decoration: none;">
                <p>FA<sup>TM</sup></p>
                <p>KEX</p>
            </a>
        </div>
    </div>
    <div>
        <ul>
            <li><a href="<?php
            if(isset($_SESSION['login'])){
                echo "frontController.php?action=createShoe&controller=modele";
            }else{
                echo "frontController.php?action=connexionCreateur&controller=utilisateur";
            }
            ?>"><?php
                    if(isset($_SESSION['login'])){
                        echo "Add Shoe";
                    }else{
                        echo "Creators";
                    }
            ?>
            </a></li>
            <li><a href="frontController.php?action=readMen&controller=modele">Men</a></li>
            <li><a href="frontController.php?action=readWomen&controller=modele">Women</a></li>

        </ul>

    </div>
    <div id="icons">
        <li id="showCart"><p>
                <?php
                require __DIR__."/../../web/img/cart.svg";
                ?>
            </p>
        </li>
        <li id="searchbar" class="deactivated">
            <form>
                <input type="text" placeholder="Rechercher..." id="searchbar-input">
            </form>
            <div id="suggestions">
                <ol>

                </ol>
            </div>

            <a id="trigger">
                <?php
                require __DIR__."/../../web/img/magnify.svg";
                ?>
            </a></li>
        <li><a href="frontController.php?action=viewUtilisateur&controller=utilisateur<?php if(isset($_SESSION["login"])){echo "&login=". $_SESSION["login"];}?>">
                <?php
                require __DIR__."/../../web/img/user.svg";
                ?>
            </a></li>
    </div>
</nav>