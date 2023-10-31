<?php
// Include the database connection
include 'includes/database.php';

// Check if the request is a POST request (for added security)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the commandId from the POST request
    $commandId = $_POST['commandId'];

    // Here, you should first delete the corresponding entries in the 'commandes_plat' table based on the commandId.
    // Then, delete the command from the 'commandes' table.

    // Sample code (make sure to modify this as per your database schema):
    $deleteCommandPlatsQuery = $db->prepare("DELETE FROM commandes_plat WHERE id_commande = :commandId");
    $deleteCommandPlatsQuery->bindParam(':commandId', $commandId);
    $deleteCommandPlatsQuery->execute();

    $deleteCommandQuery = $db->prepare("DELETE FROM commandes WHERE id_commande = :commandId");
    $deleteCommandQuery->bindParam(':commandId', $commandId);
    $deleteCommandQuery->execute();

    // Respond with a success message (you can also handle errors)
    echo json_encode(['message' => 'Command deleted successfully']);
} else {
    // Handle non-POST requests or direct access
    http_response_code(400); // Bad request
    echo json_encode(['error' => 'Invalid request']);
}
?>
