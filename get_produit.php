<?php
try {
    $id = $_GET['id'];

    
    include 'includes/database.php';

    // On prépare la requête SQL
    $stmt = $db->prepare("SELECT nom, prix FROM plats WHERE id_plat=?");
    $stmt->execute([$id]);

    // Ici on récupère le résultat de la requête
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Pour envoyer un message de débogage
    error_log("Product: " . print_r($product, true));

    // Et on renvoie le résultat en format JSON
    echo json_encode($product);
} catch (Exception $e) {
    echo json_encode('Caught exception: '.  $e->getMessage());
}
?>
