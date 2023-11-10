<?php

include './database.php';

if(isset($_POST['id_plat'])) {
    $id_plat = $_POST['id_plat'];
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $prix = filter_input(INPUT_POST, 'prix', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $chaud = isset($_POST['chaud']) ? 1 : 0;

    // Vérifie si une image a été téléchargée
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['tmp_name'];
        $imageData = file_get_contents($image);
    } else {
        $getPlatReq = $db->prepare("SELECT image FROM plats WHERE id_plat=:id_plat");
        $getPlatReq->bindParam(':id_plat', $id_plat);
        $getPlatReq->execute();
        $result = $getPlatReq->fetch(PDO::FETCH_ASSOC);
        $image = $result['image'];
   }

    // Met à jour les informations du plat dans la base de données
    $updatePlatReq = $db->prepare("UPDATE plats SET nom=:nom, description=:description, prix=:prix, chaud=:chaud, image=:image WHERE id_plat=:id_plat");
    $updatePlatReq->bindParam(':nom', $nom);
    $updatePlatReq->bindParam(':description', $description);
    $updatePlatReq->bindParam(':prix', $prix);
    $updatePlatReq->bindParam(':chaud', $chaud);
    $updatePlatReq->bindParam(':image', $image);
    $updatePlatReq->bindParam(':id_plat', $id_plat);
    $updatePlatReq->execute();

    // Redirige l'utilisateur vers la page de détails du plat modifié
    header("Location: ../back_end/produits.php");
    exit();
}
?>