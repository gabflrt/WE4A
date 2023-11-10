<?php
    // Récupére les données POST
    $id = $_POST['id'];
    $newName = $_POST['name'];    

    // Inclure le fichier de configuration de la base de données
    include("./database.php");

    // Prépare la requête SQL
    $q = $db->prepare("UPDATE boissons SET nom=:newName WHERE id_boisson=:id");
    $q->execute(['newName' => $newName, 'id' => $id]);

    // Exécute la requête
    if ($q->execute()) {
        http_response_code(200);
        echo "Erreur de préparation : " . htmlspecialchars($db->error);

    } else {
        http_response_code(400);
        echo "Erreur : " . $q->error;
    }

    // Ferme la connexion
    $q->close();
    $db->close();
?>
