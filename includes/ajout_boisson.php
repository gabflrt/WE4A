<?php

include './database.php';

if(isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['volume_cl']) && isset($_POST['prix'])) {
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $volume_cl = filter_input(INPUT_POST, 'volume_cl', FILTER_SANITIZE_STRING);
    $prix = filter_input(INPUT_POST, 'prix', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $alcool = isset($_POST['alcool']) ? 1 : 0;

    // Vérifier si une image a été téléchargée
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['tmp_name'];
        $imageData = file_get_contents($image);
    } else {
        $image = "../images/defaut.jpg";
        $imageData = file_get_contents($image);
    }

        // Ajouter une nouvelle boisson dans la base de données
        $addBoissonReq = $db->prepare("INSERT INTO boissons (nom, volume_cl, prix, description, alcool, image) VALUES (:nom, :volume_cl, :prix, :description, :alcool, :image)");
        $addBoissonReq->bindParam(':nom', $nom);
        $addBoissonReq->bindParam(':volume_cl', $volume_cl);
        $addBoissonReq->bindParam(':prix', $prix);
        $addBoissonReq->bindParam(':description', $description);
        $addBoissonReq->bindParam(':alcool', $alcool);
        $addBoissonReq->bindParam(':image', $imageData, PDO::PARAM_LOB);
        $addBoissonReq->execute();

        // Rediriger l'utilisateur vers la page de produits
        header("Location: ../back_end/produits.php");
        exit();
    } else {
        echo "Tous les champs du formulaire doivent être remplis.";
    }    ?>

