<?php
$CommandsQuery = $db->prepare("SELECT * FROM commandes WHERE date_heure > :date ORDER BY date_heure DESC");
$CommandsQuery->bindParam(':date', $date);
$CommandsQuery->execute();
$Commands = $CommandsQuery->fetchAll();

foreach ($Commands as &$command) {
    $commandId = $command['id_commande'];
    $clientId = $command['id_client'];

    // récupère les plats
    $CommandInfoQuery = $db->prepare("SELECT * FROM commandes_plat WHERE id_commande = :commandId");
    $CommandInfoQuery->bindParam(':commandId', $commandId);
    $CommandInfoQuery->execute();
    $commandInfo = $CommandInfoQuery->fetchAll();
    $command['commandInfo'] = $commandInfo;

    // récupère les boissons
    $CommandInfoBoissonQuery = $db->prepare("SELECT * FROM commandes_boisson WHERE id_commande = :commandId");
    $CommandInfoBoissonQuery->bindParam(':commandId', $commandId);
    $CommandInfoBoissonQuery->execute();
    $commandBoissonInfo = $CommandInfoBoissonQuery->fetchAll();
    $command['commandBoissonInfo'] = $commandBoissonInfo;

    // récupère les clients
    $ClientInfoQuery = $db->prepare("SELECT * FROM clients WHERE id_client = :clientId");
    $ClientInfoQuery->bindParam(':clientId', $clientId);
    $ClientInfoQuery->execute();
    $clientInfo = $ClientInfoQuery->fetch();
    $command['clientInfo'] = $clientInfo;
}

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
    
    $dateCommand= date("Y-m-d", strtotime($command['date_heure']));
    $dateCommandStamp = strtotime($dateCommand);
    $targetDateStamp = strtotime($targetDate);
    if ($dateCommandStamp>=$targetDateStamp){
        $chiffreAffaire+=$prixTotal;
        echo '<script>
        var chiffreAffaireDiv = document.getElementById("chiffreAffaireDiv");
        chiffreAffaireDiv.innerHTML = "Chiffre d\'affaire depuis le ' . $targetDate . ': ' . $chiffreAffaire . '€";
    </script>';
    }
    echo '</div>'; 
}
?>
