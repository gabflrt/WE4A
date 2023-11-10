<?php
include '../includes/database.php';
global $db;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $typeToDelete = $_POST['typeToDelete'];

    // Supprimer les plats associés au type
    $deletePlatsReq = $db->prepare("DELETE FROM plats WHERE type = :typeToDelete");
    $deletePlatsReq->bindParam(':typeToDelete', $typeToDelete);

    try {
        $deletePlatsReq->execute();
        echo "Type and associated plats deleted successfully";
        echo "$typeToDelete";
    } catch (PDOException $e) {
        echo "Error deleting type and associated plats: " . $e->getMessage();
    }
} else {
    echo "Invalid request method";
}
?>
