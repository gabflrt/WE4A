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

<?php
    //si connecté en tant que client
    if (isset($_SESSION['admin']) && $_SESSION['admin'] == 0){
        echo "<h1>Vos commandes précédentes</h1>";
        echo "<p>Voici les commandes que vous avez passées sur notre site.</p>";
    }
?>

<?php
    //si connecté en tant que admin
    if (isset($_SESSION['admin']) && $_SESSION["admin"] == 1){
        echo "<h1>Inventaire des commandes</h1>";
        echo "<p>L'ensemble des commandes du site</p>";
    }
                         
?>

</div>
    <?php include("./pagesParts/footer.php"); ?>

</body>
</html>
