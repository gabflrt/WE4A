<!DOCTYPE html>
<html>
    <head>
        <title>Inscription</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" href="styles/creation_compte.css">
    </head>
    <body>
        <?php
        include './pagesParts/header.php';
        include './includes/signin.php';
        global $db;
        ?>
        
        <p>Inscription <br></p>
        <form method="post">
            <input class="register" name="prenom" type="text" placeholder="Votre Prénom" required><br/>
            <input class="register" name="nom" type="text" placeholder="Votre Nom" required><br/>
            <input class="register" name="adresse" type="text" placeholder="Votre Adresse" required><br/>
            <input id="mail_register" name="mail" type="text" placeholder="Votre Email" required><br/>
            <input class="register" name="num" type="text" placeholder="Votre Numéro" required><br/>
            <input class="register" name="date_naissance" type="date" value="2003-06-29" min="1910-01-01" max="2022-05-01"  ><br/>
            <input class="register" name="mdp" type="password" placeholder="Votre Mot de passe" required><br/>
            <input class="register" name="mdp2" type="password" placeholder="Confirmer votre Mot de passe" required><br/>
            <input type="submit" name="formsend" id="formsend" value="OK">
        </form>
    </body>
</html>