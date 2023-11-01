<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['mail'])) {
    // Redirige vers la page d'accueil du back end si l'utilisateur n'est pas connecté
    header('Location: ./accueil.php');
    exit;
}
// Vérifie si l'utilisateur est un client
if ($_SESSION['admin'] == 0) {
    // Redirige vers la page d'accueil du front end si l'utilisateur est un client
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/produits.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Gestion catalogues</title>
</head>

<body>

    <?php include("./back_header.php"); ?>

    <div id="ajouttype">
        <h1>Liste des types déjà existants</h1>
        <?php
        
            $recup_type = $db->prepare("SELECT DISTINCT type FROM plats");
            $recup_type->execute();
            $type = $recup_type->fetchAll(PDO::FETCH_ASSOC);
            foreach ($type as $type2) {
                echo $type2['type'], "\n";
            }
        ?>
    </div>
        

        <h1>Ajout d'un nouveau type</h1>
        <div class="presentation">
        <div class="contenu_plat">
        <form method="post" action="../includes/ajout_type.php" enctype="multipart/form-data">
            <label for="Type">Nouveau type :</label>
            <input type="text" name="type"><br>
            <p>Ajout d'un premier produit pour l'enregistrement :</p><br>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" value="nom"><br>
            <label for="description">Description :</label>
            <textarea name="description">description</textarea><br>
            <label for="prix">Prix :</label>
            <input type="number" name="prix" value="prix"><br>
            <label for="chaud">Chaud :</label>
            <input type="checkbox" name="chaud" value="1"><br>
            <label for="image">Image :</label>
            <input type="file" name="image"><br>
            <input type="submit" value="Ajouter">
        </form>
        </div>
        </div>
    

<?php include("./back_footer.php"); ?>

    </body>
</html>
