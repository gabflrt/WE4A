<?php
    // Récupérer les données POST
    $id = $_POST['id']; 

    // Inclure le fichier de configuration de la base de données
    include("./database.php");

    // Préparer la requête SQL
    $q = $db->prepare("DELETE FROM boissons WHERE id_boisson=:id");
    $q->execute(['id' => $id]);

    // Exécuter la requête
    if ($q->execute()) {
        http_response_code(200);
        echo "Erreur de préparation : " . htmlspecialchars($db->error);

    } else {
        http_response_code(400);
        echo "Erreur : " . $q->error;
    }

    // Fermer la connexion
    $q->close();
    $db->close();
?>
