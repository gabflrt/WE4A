<?php
try {
    $id = $_GET['id'];

    
    include 'includes/database.php';

    
    $stmt = $db->prepare("SELECT nom, prix FROM boissons WHERE id_boisson=?");
    $stmt->execute([$id]);

  
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    
    error_log("Product: " . print_r($product, true));

    
    echo json_encode($product);
} catch (Exception $e) {
    echo json_encode('Caught exception: '.  $e->getMessage());
}
?>
