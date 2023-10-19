<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['mail'])) {
    // Redirige vers la page d'accueil du back end si l'utilisateur n'est pas connecté
    header('Location: ./accueil.php');
    exit;
}
// Vérifie si l'utilisateur est un client
if ($_SESSION['admin'] == 0) {
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Inventaire</title>
</head>

<body>

<?php include("./back_header.php"); ?>
    

    <?php include("./back_footer.php"); ?>

    </body>
</html>
