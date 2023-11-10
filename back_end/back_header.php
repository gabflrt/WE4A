<link rel="stylesheet" href="../styles/header.css">
    <header>
        <nav>
            <ul>
                <a href="./index.php"><img src="../images/logo.jpg" alt="Logo"></a>
                <li><a href="./index.php">Accueil</a></li>
                <li><a href="./catalogues.php">Catalogues</a></li>
                <li><a href="./produits.php">Produits</a></li>
                <li><a href="./inventaire.php">Inventaire</a></li>
            </ul>
        </nav>
        <div class ="login">
             <!--Formulaire de connexion-->
        <?php 
        include '../includes/database.php';
        global $db;
         if($_SESSION == true){
            echo' <form method="post"> <br />
                <input class="submit" type="submit" name="deco" id="deco" value="Se déconnecter">
            </form>';
         }else{
            echo '
            <form method="post" class="connection"> 
                <input type="text" name="mail" id="mail" placeholder="E-Mail" required>
                <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required>
                <input type="submit" name="formlogin" id="formlogin" value="Connexion">
            </form>';
         }?>
        
        <br />
        <?php
            if(isset($_POST['deco'])){
                session_destroy();
                header("refresh:0");

            }
            include '../includes/log.php';
        ?>
        
        <!--Sinon autoriser possibilité de s'inscrire ou si connecté, de modifier son profil -->
        <?php
        
         if($_SESSION == true){
            echo '<a href="../creation_compte.php">
                <button type="submit" class="submit">Profil</button>
                </a>';
        }else{
            echo '<a href="../creation_compte.php"> 
                <button type="submit" id="inscription" class="submit">Inscription</button>
                </a>';
        }
        
        ?>

        <!--    <a href="./index.php"><img src="images/panier.png" alt="Panier"></a>-->
        </div>
    </header>