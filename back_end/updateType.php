<?php
include '../includes/database.php';
global $db;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldName = $_POST['oldName'];
    $newName = $_POST['newName'];

    // Update the type in the plats table
    $updateTypeReq = $db->prepare("UPDATE plats SET type = :newName WHERE type = :oldName");
    $updateTypeReq->bindParam(':oldName', $oldName);
    $updateTypeReq->bindParam(':newName', $newName);

    try {
        $updateTypeReq->execute();
        echo "Type updated successfully\n";
    } catch (PDOException $e) {
        echo "Error updating type: " . $e->getMessage();
    }
} else {
    echo "Invalid request method";
}
?>
