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
    <title>Gestion Produits</title>
</head>

<body>

    <?php include("./back_header.php"); ?>
    
    <?php

// Obtenez le numéro de page à partir de la requête GET, ou utilisez 1 par défaut
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Définissez combien de produits vous voulez afficher par page
$productsPerPage = 20;

// Calculez l'offset pour la requête SQL
$offset = ($page - 1) * $productsPerPage;

// Préparez et exécutez la requête SQL pour obtenir les produits
$stmt = $db->prepare("SELECT * FROM plats ORDER BY nom LIMIT :offset, :limit");
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':limit', $productsPerPage, PDO::PARAM_INT);
$stmt->execute();

// Récupérez les produits
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($products as $product) {
    // Affichez chaque produit avec les boutons Renommer, Modifier et Effacer
    echo '<div class="product">';
    echo '<h2>' . htmlspecialchars($product['nom']) . '</h2>';
    echo '<p>Prix: ' . htmlspecialchars($product['prix']) . '€</p>';
    echo '<button onclick="renameProduct(' . $product['id_plat'] . ')">Renommer</button>';
    echo '<button onclick="editProduct(' . $product['id_plat'] . ')">Modifier</button>';
    echo '<button onclick="deleteProduct(' . $product['id_plat'] . ')">Effacer</button>';
    echo '</div>';
}
?>
<script>
    function renameProduct(id) {
    var newName = prompt("Entrez le nouveau nom du produit :");
    if (newName) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../includes/rename_product.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    alert("Le produit a été renommé avec succès !");
                    location.reload(); // Rechargez la page pour voir les changements
                } else {
                    alert("Erreur lors du renommage du produit : " + this.responseText);
                }
            }
        };
        xhr.send("id=" + id + "&name=" + newName);
        console.log("id=" + id + "&name=" + newName);
    }
}


function editProduct(id) {
    // Ici, vous pouvez demander à l'utilisateur les nouvelles valeurs pour les autres champs du produit
    // Pour cet exemple, je vais juste changer le nom
    var newName = prompt("Entrez le nouveau nom du produit :");
    if (newName) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "edit_product.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert("Le produit a été modifié avec succès !");
                location.reload(); // Rechargez la page pour voir les changements
            }
        };
        xhr.send("id=" + id + "&name=" + newName);
    }
}

function deleteProduct(id) {
    var confirmation = confirm("Êtes-vous sûr de vouloir supprimer ce produit ?");
    if (confirmation) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../includes/delete_product.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert("Le produit a été supprimé avec succès !");
                location.reload(); // Rechargez la page pour voir les changements
            }
        };
        xhr.send("id=" + id);
    }
}



</script>

    <?php include("./back_footer.php"); ?>

    </body>
</html>
