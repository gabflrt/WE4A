<?php
$id = $_GET['id'];


// Préparez la requête SQL
$stmt = $db->prepare("SELECT nom, prix FROM plats WHERE id=?");
$stmt->execute([$id]);

// Récupérez le résultat de la requête
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Renvoyez le résultat en format JSON
echo json_encode($product);
?>
