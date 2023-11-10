<?php

include './database.php';

if(isset($_POST['id_boisson'])) {
    $id_boisson = $_POST['id_boisson'];
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $volume_cl = filter_input(INPUT_POST, 'volume_cl', FILTER_SANITIZE_STRING);
    $prix = filter_input(INPUT_POST, 'prix', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $chaud = isset($_POST['alcool']) ? 1 : 0;

    // Vérifie si une image a été téléchargée
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['tmp_name'];
        $imageData = file_get_contents($image);
    } else {
        // Recherche l'image actuelle dans la base de données
        $selectImageReq = $db->prepare("SELECT image FROM boissons WHERE id_boisson=:id_boisson");
        $selectImageReq->bindParam(':id_boisson', $id_boisson);
        $selectImageReq->execute();
        $currentImage = $selectImageReq->fetch(PDO::FETCH_ASSOC)['image'];
        $image = $currentImage;
    }

    // Met à jour les informations du plat dans la base de données
    $updatePlatReq = $db->prepare("UPDATE boissons SET nom=:nom, volume_cl=:volume_cl, prix=:prix, description=:description, alcool=:alcool, image=:image WHERE id_boisson=:id_boisson");
    $updatePlatReq->bindParam(':nom', $nom);
    $updatePlatReq->bindParam(':volume_cl', $volume_cl);
    $updatePlatReq->bindParam(':prix', $prix);
    $updatePlatReq->bindParam(':description', $description);
    $updatePlatReq->bindParam(':alcool', $alcool);
    $updatePlatReq->bindParam(':image', $image);
    $updatePlatReq->bindParam(':id_boisson', $id_boisson);
    $updatePlatReq->execute();

    // Redirige l'utilisateur vers la page de détails du plat modifié
    header("Location: ../back_end/produits.php");
    exit();
}
?>