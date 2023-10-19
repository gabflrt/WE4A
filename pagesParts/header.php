<?php session_start(); ?>
<link rel="stylesheet" href="styles/header.css">
    <header>
        <nav>
            <ul>
                <a href="./index.php"><img src="images/logo.jpg" alt="Logo"></a>
                <li><a href="./index.php">Accueil</a></li>
                <li><a href="./catalogue.php">La Carte</a></li>
                <li><a href="#">Réserver une table</a></li>
            </ul>
        </nav>
        <div class ="login">
             <!--Formulaire de connexion-->
        <?php 
        include './includes/database.php';
        global $db;
         if($_SESSION == true){
            echo' <form method="post"> <br />
                <input class="submit" type="submit" name="deco" id="deco" value="Se déconnecter">
            </form>';
         }else{
            echo '
            <button id="loginButton" class="submit">Connexion</button>
            <form id="loginForm" method="post" class="connection" style="display: none;"> 
                <input type="text" name="mail" id="mail" placeholder="E-Mail" required>
                <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required>
                <input type="submit" name="formlogin" id="formlogin" value="Connexion">
            </form>';
         }?>
        
        <br />
        <?php
            if(isset($_POST['deco'])){
                session_destroy();
            }
            include './includes/log.php';
        ?>
        
        <!--Sinon autoriser possibilité de s'inscrire ou si connecté, de modifier son profil -->
        <?php
        
         if($_SESSION == true){
            echo '<a href="creation_compte.php">
                <button type="submit" class="submit">Profil</button>
                </a>';
        }else{
            echo '<a href="./creation_compte.php"> 
                <button type="submit" id="inscription" class="submit">Inscription</button>
                </a>';
        }
        
        ?>

<script>
document.getElementById('loginButton').addEventListener('click', function() {
    var form = document.getElementById('loginForm');
    var button = document.getElementById('loginButton');
    var inscription = document.getElementById('inscription');


    form.style.display = 'block';
    form.style.animation = 'slidein 0.5s';
inscription.style.animation = 'slidein 0.5s';
    button.style.display = 'none';
});
</script>

        <!--    <a href="./index.php"><img src="images/panier.png" alt="Panier"></a>-->
        </div>
    </header>