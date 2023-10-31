<?php
include 'includes/database.php';
session_start();

if (isset($_SESSION['mail']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
   
   $userEmail = $_SESSION['mail'];
   $clientQuery = $db->prepare("SELECT id_client FROM clients WHERE mail = :mail");
    $clientQuery->bindParam(':mail', $userEmail);
    $clientQuery->execute();
    $clientResult = $clientQuery->fetch(PDO::FETCH_ASSOC);
    if ($clientResult) {
        $clientId = $clientResult['id_client'];
    }
   
    $listPanier = json_decode($_POST['listPanier']);
    $currentDateTime = date('Y-m-d H:i:s');

    $insertCommandeQuery = $db->prepare("INSERT INTO commandes (id_client, date_heure) VALUES (:clientId, :currentDateTime)");
    $insertCommandeQuery->bindParam(':clientId', $clientId);
    $insertCommandeQuery->bindParam(':currentDateTime', $currentDateTime);
    $insertCommandeQuery->execute();

    $idCommande = $db->lastInsertId();

    foreach ($listPanier as $platId) {
        $insertCommandePlatQuery = $db->prepare("INSERT INTO commandes_plat (id_commande, id_plat) VALUES (:idCommande, :platId)");
        $insertCommandePlatQuery->bindParam(':idCommande', $idCommande);
        $insertCommandePlatQuery->bindParam(':platId', $platId);
        $insertCommandePlatQuery->execute();
    }

} else {
    echo "Erreur: Veuillez vous connecter pour commander.";
}
?>
