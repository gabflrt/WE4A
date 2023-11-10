<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['mail'])) {
    // Redirige vers la page d'accueil du back end si l'utilisateur n'est pas connecté
    header('Location: ./index.php');
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
    <div id="main">
    <div id="content">
        <h1>Gestion des Plats</h1>
    <?php

// Prépare et exécute la requête SQL pour obtenir les plats
$q_plats = $db->prepare("SELECT * FROM plats ORDER BY nom");
$q_plats->execute();
$plats = $q_plats->fetchAll(PDO::FETCH_ASSOC);

foreach ($plats as $plat) {
    // Affiche chaque produit avec les boutons Renommer, Modifier et Effacer
    echo '<div id="product">';
    echo '<h2>' . htmlspecialchars($plat['nom']) . '</h2>';
    echo '<p>Prix: ' . htmlspecialchars($plat['prix']) . '€</p>';
    echo '<button class="renommer" onclick="renamePlat(' . $plat['id_plat'] . ')">Renommer</button>';
    echo '<button onclick="loadModifsPlat(' . $plat['id_plat'] . ')">Modifier</button>';
    echo '<button class="supprimer" onclick="deletePlat(' . $plat['id_plat'] . ')">Supprimer</button>';
    echo '</div>';
}
?>
</div>
<div id="center">
    <div id="add">
        <a><button onclick="loadAjoutPlat()">Ajouter un plat</button></a>
        <a><button onclick="loadAjoutBoisson()">Ajouter une boisson</button></a>
        </div> 
    <div id="modif">


    </div>
</div>
<div id="content">
        <h1>Gestion des boissons</h1>
    <?php

// Prépare et exécute la requête SQL pour obtenir les boissons
$q_boissons = $db->prepare("SELECT * FROM boissons ORDER BY nom");
$q_boissons->execute();
$boissons = $q_boissons->fetchAll(PDO::FETCH_ASSOC);

foreach ($boissons as $boisson) {
    // Affiche chaque produit avec les boutons Renommer, Modifier et Effacer
    echo '<div id="product">';
    echo '<h2>' . htmlspecialchars($boisson['nom']) . '</h2>';
    echo '<p>Prix: ' . htmlspecialchars($boisson['prix']) . '€</p>';
    echo '<button class="renommer" onclick="renameBoisson(' . $boisson['id_boisson'] . ')">Renommer</button>';
    echo '<button onclick="loadModifsBoisson(' . $boisson['id_boisson'] . ')">Modifier</button>';
    echo '<button class="supprimer" onclick="deleteBoisson(' . $boisson['id_boisson'] . ')">Supprimer</button>';
    echo '</div>';
}
?>
</div>
</div>
<script>
    function renamePlat(id) {
    var newName = prompt("Entrez le nouveau nom du produit :");
    if (newName) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../includes/rename_plat.php", true);
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

function renameBoisson(id) {
    var newName = prompt("Entrez le nouveau nom du produit :");
    if (newName) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../includes/rename_boisson.php", true);
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

function loadModifsPlat(plat) {
    $.get({
      url: "./get_modif_plat.php", 
      data:{
        "plat":plat
      },
      success: function(result){
      $("#modif").html(result);
    }
  });
}

function loadModifsBoisson(boisson) {
    $.get({
      url: "./get_modif_boisson.php", 
      data:{
        "boisson":boisson
      },
      success: function(result){
      $("#modif").html(result);
    }
  });
}

function loadAjoutPlat() {
    $.get({
      url: "./get_ajout_plat.php", 
      success: function(result){
      $("#modif").html(result);
    }
  });
}

function loadAjoutBoisson() {
    $.get({
      url: "./get_ajout_boisson.php", 
      success: function(result){
      $("#modif").html(result);
    }
  });
}

function deletePlat(id) {
    var confirmation = confirm("Êtes-vous sûr de vouloir supprimer ce produit ?");
    if (confirmation) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../includes/delete_plat.php", true);
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

function deleteBoisson(id) {
    var confirmation = confirm("Êtes-vous sûr de vouloir supprimer ce produit ?");
    if (confirmation) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../includes/delete_boisson.php", true);
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
