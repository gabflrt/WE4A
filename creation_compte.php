<!DOCTYPE html>
<html>
    <head>
        <title>Inscription</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./styles/style.css">
        <link rel="stylesheet" href="./styles/creation_compte.css">
    </head>
    <body>
        <?php
        include './pagesParts/header.php';
        include './includes/signin.php';
        global $db;
        
        if(isset($_SESSION['mail'])) {
            $requser = $db->prepare("SELECT * FROM clients WHERE mail = ?");
    $requser->execute(array($_SESSION['mail']));
    $user = $requser->fetch();

    ?>
    <h1>Vous pouvez modifier vos informations</h1>
    <form method="post">
        <input class="register" name="prenom" type="text" placeholder="Votre Prénom" value="<?php echo $user['prenom']; ?>" required><br/>
        <input class="register" name="nom" type="text" placeholder="Votre Nom" value="<?php echo $user['nom']; ?>" required><br/>
        <input class="register" name="adresse" type="text" placeholder="Votre Adresse" value="<?php echo $user['adresse']; ?>" required><br/>
        <p class="register" id="mail_register" name="mail"><?php echo $user['mail']; ?></p><br/>
        <input class="register" name="num" type="text" placeholder="Votre Numéro" value="<?php echo $user['num']; ?>" required><br/>
        <input class="register" name="date_naissance" type="date" value="<?php echo $user['naissance']; ?>" min="1910-01-01" max="<?php echo date('Y-m-d'); ?>"  ><br/>
        <input class="register" name="mdp" type="password" placeholder="Votre nouveau Mot de passe" required><br/>
        <input class="register" name="mdp2" type="password" placeholder="Votre Mot de passe actuel" required><br/>
        <input type="submit" name="modify" id="modify">
    </form>
        <?php
        }else{?>
            <h1>Vous pouvez vous créer un compte</h1>
            <form method="post">
            <input class="register" name="prenom" type="text" placeholder="Votre Prénom" required><br/>
            <input class="register" name="nom" type="text" placeholder="Votre Nom" required><br/>
            <input class="register" name="adresse" type="text" placeholder="Votre Adresse" required><br/>
            <input class="register" id="mail_register" name="mail" type="text" placeholder="Votre Email" required><br/>
            <input class="register" name="num" type="text" placeholder="Votre Numéro" required><br/>
            <input class="register" name="date_naissance" type="date" min="1910-01-01" max="2022-05-01"  ><br/>
            <input class="register" name="mdp" type="password" placeholder="Votre Mot de passe" required><br/>
            <input class="register" name="mdp2" type="password" placeholder="Confirmer votre Mot de passe" required><br/>
            <input type="submit" name="signin" id="signin" value="OK">
        </form>

  <?php      }

         include './pagesParts/footer.php'; ?>
        

        
    </body>
</html>