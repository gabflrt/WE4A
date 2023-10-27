<?php
try {
    $id = $_GET['id'];

    // Connectez-vous à votre base de données
include 'includes/database.php';
    // Préparez la requête SQL
    $stmt = $db->prepare("SELECT nom, prix FROM plats WHERE id=?");
    $stmt->execute([$id]);

    // Récupérez le résultat de la requête
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Renvoyez le résultat en format JSON
    echo json_encode($product);
} catch (Exception $e) {
    echo json_encode('Caught exception: '.  $e->getMessage());
}

?>
