<?php

include 'includes/database.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $commandId = $_POST['commandId'];

    
    $deleteCommandPlatsQuery = $db->prepare("DELETE FROM commandes_plat WHERE id_commande = :commandId");
    $deleteCommandPlatsQuery->bindParam(':commandId', $commandId);
    $deleteCommandPlatsQuery->execute();

    $deleteCommandQuery = $db->prepare("DELETE FROM commandes WHERE id_commande = :commandId");
    $deleteCommandQuery->bindParam(':commandId', $commandId);
    $deleteCommandQuery->execute();

    
    echo json_encode(['message' => 'Command deleted successfully']);
} else {
   
    http_response_code(400); // Bad request
    echo json_encode(['error' => 'Invalid request']);
}
?>
