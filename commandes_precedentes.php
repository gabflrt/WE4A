<?php
session_start();

// Vérifier si l'utilisateur est connecté
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
</head>



<body>
    <?php include("./pagesParts/header.php"); ?>
    <div class="content">

        <?php
            //si connecté en tant que client
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 0){
                echo "<h1>Vos commandes précédentes</h1>";
                echo "<p>Voici les commandes que vous avez passées sur notre site.</p>";
                echo "<br>";

                include "get_commande_client.php";
                foreach ($Commands as $command) {
                    
                    echo '<div class="command-container">';

                    // Pour écrire les informations d'un client et le commandId
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

                    foreach ($command['commandBoissonInfo'] as $commandInfo) {
                        $boissonId = $commandInfo['id_boisson'];

                        $BoissonInfoQuery = $db->prepare("SELECT nom, prix FROM boissons WHERE id_boisson = :boissonId");
                        $BoissonInfoQuery->bindParam(':boissonId', $boissonId);
                        $BoissonInfoQuery->execute();
                        $BoissonInfo = $BoissonInfoQuery->fetch();
                        $prixTotal+= $BoissonInfo['prix'];
                        echo '<p class="info-row">' . $BoissonInfo['nom'] . ' - ' . $BoissonInfo['prix']. '€</p>';
                    }

                    echo '<p class="info-row">Prix total : '. $prixTotal . '€</p>';
                    
                    echo '</div>'; 
                    }
                }
            
        ?>
    <?php include("./pagesParts/footer.php"); ?>
    </div>
</body>