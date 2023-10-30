<?php


// $CommandsPerPage = 5; // nombre de commandes par page

$CommandsQuery = $db->prepare("SELECT * FROM commandes ORDER BY date_heure DESC");
$CommandsQuery->execute();
$Commands = $CommandsQuery->fetchAll();

foreach ($Commands as &$command) {
    $commandId = $command['id_commande'];
    $clientId = $command['id_client'];

    // récupère les commandes
    $CommandInfoQuery = $db->prepare("SELECT * FROM commandes_plat WHERE id_commande = :commandId");
    $CommandInfoQuery->bindParam(':commandId', $commandId);
    $CommandInfoQuery->execute();
    $commandInfo = $CommandInfoQuery->fetchAll();
    $command['commandInfo'] = $commandInfo;

    // récupère les clients
    $ClientInfoQuery = $db->prepare("SELECT * FROM clients WHERE id_client = :clientId");
    $ClientInfoQuery->bindParam(':clientId', $clientId);
    $ClientInfoQuery->execute();
    $clientInfo = $ClientInfoQuery->fetch();
    $command['clientInfo'] = $clientInfo;
}
?>
