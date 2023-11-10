<?php

if (isset($_SESSION['mail'])){

$userEmail = $_SESSION['mail'];
$clientQuery = $db->prepare("SELECT id_client FROM clients WHERE mail = :mail");
 $clientQuery->bindParam(':mail', $userEmail);
 $clientQuery->execute();
 $clientResult = $clientQuery->fetch(PDO::FETCH_ASSOC);
 if ($clientResult) {
     $clientId = $clientResult['id_client'];
 }

$CommandsQuery = $db->prepare("SELECT * FROM commandes WHERE id_client= :clientId ORDER BY date_heure DESC");
$CommandsQuery->bindParam(':clientId', $clientId);
$CommandsQuery->execute();
$Commands = $CommandsQuery->fetchAll();

foreach ($Commands as &$command) {
    $commandId = $command['id_commande'];

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

}
?>


