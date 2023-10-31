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
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/accueil.css">

    <style>
        .command-container {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            background-color: #f9f9f9;
        }

        .info-row {
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc; 

        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>dentes</title>
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
                $currentYear = date('Y'); 
                $currentMonth = date('m'); 
                $targetDate = $currentYear . '-' . $currentMonth . '-01';

                echo "<p id=chiffreAffaireDiv>Chiffre d'affaire depuis le ".$targetDate.": ".$chiffreAffaire." </p>";

                include '../get_commandes.php'; 

                foreach ($Commands as $command) {
                    // Wrap each command in a styled container
                    echo '<div class="command-container">';

                    // Écrit les informations d'un client et le commandId
                    echo '<button class="delete-button" onclick="confirmDelete(' . $command['id_commande'] . ')">Supprimer</button>';
                    echo '<p class="info-row"><strong>Numéro commande :</strong> '. $command['id_commande'] .'</p>';
                    echo '<p class="info-row"><strong>Client :</strong> ' . $command['clientInfo']['nom'] . ' ' . $command['clientInfo']['prenom'] . '</p>';
                    echo '<p class="info-row"><strong>Date commande : </strong>'. $command['date_heure'] .'</p>';

                    $prixTotal=0;
                    echo '<p class="info-row"><strong>Détails commande</strong></p>';
                    foreach ($command['commandInfo'] as $commandInfo) {
                        $platId = $commandInfo['id_plat'];

                        $PlatInfoQuery = $db->prepare("SELECT nom, prix FROM plats WHERE id_plat = :platId");
                        $PlatInfoQuery->bindParam(':platId', $platId);
                        $PlatInfoQuery->execute();
                        $platInfo = $PlatInfoQuery->fetch();
                        $prixTotal+= $platInfo['prix'];
                        echo '<p class="info-row">' . $platInfo['nom'] . ' - ' . $platInfo['prix']. '€</p>';
                    }

                    echo '<p class="info-row">Prix total : '. $prixTotal . '€</p>';
                    
                    $dateCommand= date("Y-m-d", strtotime($command['date_heure']));
                    $dateCommandStamp = strtotime($dateCommand);
                    $targetDateStamp = strtotime($targetDate);
                    if ($dateCommandStamp>$targetDateStamp){
                        $chiffreAffaire+=$prixTotal;
                        echo '<script>
                        var chiffreAffaireDiv = document.getElementById("chiffreAffaireDiv");
                        chiffreAffaireDiv.innerHTML = "Chiffre d\'affaire depuis le ' . $targetDate . ': ' . $chiffreAffaire . '€";
                    </script>';
                    }
                    echo '</div>'; 
                }
            }
            
        ?>

    </div>
    <?php include("./back_footer.php"); ?>

    <script>
        function confirmDelete(commandId) {
            if (confirm("Are you sure you want to delete this command?")) {
                // User confirmed, perform the deletion here
                // You can make an AJAX request or navigate to a delete endpoint
                // You may want to update the UI to reflect the deletion
            }
            // If the user cancels, no action is taken
        }
    </script>

</body>
</html>
