<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['mail'])) {
    // Redirige vers la page d'accueil du back end si l'utilisateur n'est pas connecté
    header('Location: ./index.php');
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
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="../styles/inventaire.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <?php include("./back_header.php"); ?>
    <div class="content">

        <?php
            //si connecté en tant que client
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 0){
                echo "<h1>Vos commandes précédentes</h1>";
                echo "<p>Voici les commandes que vous avez passées sur notre site.</p>";
                echo "<br>";
            }
        ?>

        <?php
            //si connecté en tant que admin
            if (isset($_SESSION['admin']) && $_SESSION["admin"] == 1){
                
                echo "<h1>Inventaire des commandes</h1>";
                echo "<p>L'ensemble des commandes du site</p>";
                echo "<br>";
                $chiffreAffaire=0;
 
                $targetDate = date('Y-m-d', strtotime('-1 month'));

                echo "<p id=chiffreAffaireDiv>Chiffre d'affaire depuis le ".$targetDate.": ".$chiffreAffaire." </p>";
                
                $date = date('2020-01-01');
                include '../get_commandes.php'; 
            }
            
        ?>

    </div>
    <?php include("./back_footer.php"); ?>

    <script>
        function confirmDelete(commandId) {
            if (confirm("Voulez-vous vraiment supprimer cette commande ?")) {
                $.ajax({
            type: 'POST',
            url: '../delete_commande.php',
            data: { commandId: commandId },
            success: function (response) {
               $('#command_' + commandId).remove();
               window.location.reload()
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        })
            }

        }
    </script>

</body>
</html>
