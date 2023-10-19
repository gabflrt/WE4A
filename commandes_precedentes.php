<?php
session_start();

if (!isset($_SESSION['mail'])) {
    // Redirige vers la page d'accueil si l'utilisateur n'est pas connecté
    header('Location: ./index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/accueil.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Commandes précédentes</title>
</head>

<body>

    <?php include("./pagesParts/header.php"); ?>
<div class="content">
    <h1>Vos commandes précédentes</h1>
    <p>Voici toutes les commandes que vous avez passé sur notre site.</p>
</div>
    <?php include("./pagesParts/footer.php"); ?>

</body>
</html>
