<?php
session_start();

// Vérifie si l'utilisateur est un client
if (isset($_SESSION['admin']) && $_SESSION['admin'] == 0) {
    // Redirige vers la page d'accueil du front end si l'utilisateur est un client
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/accueil.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Espace Administrateur</title>
</head>

<body>

    <?php include("./back_header.php"); ?>
<div class="content">
    <h1>Bienvenue dans l'espace administrateur</h1>
    <p>Cette partie du site est réservée aux administrateurs pour gérer le contenu du site.</p>
</div>
    <?php include("./back_footer.php"); ?>

</body>
</html>
