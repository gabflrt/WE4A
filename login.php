<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Connexion</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles/style.css">
    </head>
    <body>
        <?php
            include './pagesParts/header.php'
        ?>
        
        <?php
            include './includes/database.php';
            global $db;
        ?>
        
        <!--Formulaire de connexion-->
        <?php 
         if($_SESSION == true){
            echo' <form method="post"> <br />
                <input class="submit" type="submit" name="deco" id="deco" value="Se déconnecter">
            </form>';
         }else{
            echo '<fieldset class="formulaire">
            <p>Connectez-vous avec votre adresse e-mail :</p>
            <form method="post"> <br />
                <input type="text" name="mail" id="mail" placeholder="E-Mail" required><br/> <br />
                <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required><br/> <br />
                <input type="submit" name="formlogin" id="formlogin" value="Se connecter">
            </form>
        </fieldset>';
         }?>
        
        <br />
        <?php
            if(isset($_POST['deco'])){
                session_destroy();
            }
            include './includes/log.php';
        ?>
        
        <!--Sinon on autorise la possibilité de s'inscrire ou si connecté, de modifier le profil -->
        <?php 
         if($_SESSION == true){
            echo '<a href="modifications.php">
                <button type="submit" class="submit">Modifier le profil</button>
                </a>';
        }else{
            echo 'Sinon, vous pouvez aussi vous inscrire ici <br /> <br /> <a href="./creation_compte.php"> 
                <button type="submit" class="submit">Inscription</button>
                </a>';
        }
        ?>

        
    </body>
</html>