<?php session_start(); 
// Vérifie si l'utilisateur est un admin
if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
    // Redirige vers la page d'accueil du back end si l'utilisateur est un admin
    header('Location: ./back_end/accueil.php');
    exit;
}

?>
<link rel="stylesheet" href="styles/header.css">
    <header>
        <nav>
            <ul>
                <a href="./index.php"><img src="images/logo.png" alt="Logo"></a>
                <li><a href="./index.php">Accueil</a></li>
                <li><a href="./catalogue.php">La Carte</a></li>
                <li><a href="./commandes_precedentes.php">Commandes précédentes</a></li>
            </ul>
        </nav>
        <div class="welcome-message">
        <?php
        if(isset($_SESSION['prenom'])) {
            echo "<p>Bonjour ".$_SESSION['prenom']." !</p>";
            if ($_SESSION['admin'] == 0){
                echo  "<p> Compte : client</p>";
            }else if ($_SESSION["admin"] == 1){
                echo  "<p> Compte : admin</p>";
            }
        }
        ?>
        </div>
        <div class ="login">
             <!--Formulaire de connexion-->
        <?php 
        include './includes/database.php';
        global $db;
         if($_SESSION == true){
            echo' <form method="post">
                <input class="submit" type="submit" name="deco" id="deco" value="Se déconnecter">
            </form>
            <a href="creation_compte.php">
                <button type="submit" class="submit">Profil</button>
                </a>';
         }else{
            echo '
            <button id="loginButton" class="submit">Connexion</button>
            <form id="loginForm" method="post" class="connection" style="display: none;"> 
                <input type="text" name="mail" id="mail" placeholder="E-Mail" required>
                <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required>
                <input type="submit" name="formlogin" id="formlogin" value="Connexion">
            </form>
            <a href="./creation_compte.php"> 
                <button type="submit" id="inscription" class="submit">Inscription</button>
                </a>';
         }?>
        
        <br />
        <?php
            if(isset($_POST['deco'])){
                session_destroy();
            }
            include './includes/log.php';
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