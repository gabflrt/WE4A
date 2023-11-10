<?php

include './database.php';

if(isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['type']) && isset($_POST['prix'])) {
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $prix = filter_input(INPUT_POST, 'prix', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
    $chaud = isset($_POST['chaud']) ? 1 : 0;

    // Vérifier si une image a été téléchargée
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['tmp_name'];
        $imageData = file_get_contents($image);
    } else {
        $image = "../images/defaut.jpg";
        $imageData = file_get_contents($image);
    }

    // Insérer un nouveau plat dans la base de données
    $insertPlatReq = $db->prepare("INSERT INTO plats (nom, description, prix, type, chaud, image) VALUES (:nom, :description, :prix, :type, :chaud, :image)");
    $insertPlatReq->bindParam(':nom', $nom);
    $insertPlatReq->bindParam(':description', $description);
    $insertPlatReq->bindParam(':prix', $prix);
    $insertPlatReq->bindParam(':type', $type);
    $insertPlatReq->bindParam(':chaud', $chaud);
    $insertPlatReq->bindParam(':image', $imageData, PDO::PARAM_LOB);
    $insertPlatReq->execute();

    // Rediriger l'utilisateur vers la page de détails du nouveau plat
    header("Location: ../back_end/produits.php");
    exit();
}
?>