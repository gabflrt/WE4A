<?php

include 'includes/database.php';
global $db;
$type =$_GET['plat'];
$plat = filter_input(INPUT_GET, 'plat', FILTER_SANITIZE_STRING);
$PlatsTotalReq = $db->prepare("SELECT * FROM plats WHERE id_plat=:plat");
$PlatsTotalReq->bindParam(':plat', $plat);
$PlatsTotalReq->execute();
$result = $PlatsTotalReq->fetch();
$id=$result['id_plat'];
$nom = $result['nom'];
$description = $result['description'];
$prix = $result['prix'];
$chaud = $result['chaud'];   
$image = $result['image']; 
?>
<div class="plats">
<div class="plat">
    <h1><?=$nom?></h1>
    <h2 class="contenu">Description</h2>
    <p class="contenu"><?=$description?></p>
    <p class="contenu">Prix : <?=$prix?></p>
    <p class="contenu">chaud : <?=$chaud?></p>  
    <img src = "data:image/png;base64,<?=base64_encode($image)?>"/>
    <input type="number" class="choix" value="1" min="1">
 
    <a href="#"> 
<button type="submit" id="ajouterAuPanier" class="choix">Ajouter au panier</button>
</a>
</div>
<div id="panier" class="panier">
<h2>Panier</h2>
<p>Le panier est vide.</p>
<button type="button" id="fermerPanier" class="fermerPanier">Fermer</button>
</div>

<script>
var listpanier = [];

document.getElementById('fermerPanier').addEventListener('click', function() {
    var panier = document.getElementById('panier');
    panier.classList.remove('ouvert');
});

document.getElementById('ajouterAuPanier').addEventListener('click', function() {
    var nomproduit = <?php echo json_encode($nom) ?>;
    var prixproduit = <?php echo json_encode($prix); ?>;
// Créer une liste d'identifiants de produits
var productIds = [<?php echo json_encode($id) ?>,<?php echo json_encode($id) ?>];

// Convertir la liste en chaîne pour le stockage dans un cookie
var productIdsString = JSON.stringify(productIds);

// Créer le cookie "panier"
document.cookie = "panier=" + productIdsString + "; expires=Thu, 18 Dec 2023 12:00:00 UTC; path=/";
    var element = {nom: nomproduit, prix: prixproduit};
    
    listpanier.push(element);

    // Mettez à jour l'affichage du panier.
    var panierDiv = document.getElementById('panier');

    var panier = document.getElementById('panier');
    if (panier.classList.contains('ouvert')) {
        // Si le panier est déjà ouvert, fermez-le.
        panier.classList.remove('ouvert');
    } else {
        // Sinon, ouvrez le panier.
       
        panier.classList.add('ouvert');
        panierDiv.innerHTML = '<h2>Panier</h2>';
    for (var i = 0; i < listpanier.length; i++) {
        panierDiv.innerHTML += '<p>' + listpanier[i].nom + ': ' + listpanier[i].prix + '€</p>';
    }
    }
});
</script>
  
  
  

</div>
