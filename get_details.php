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
<div class="presentation">
<div class="contenu_plat">
    <h1><?=$nom?></h1>
    <div class="image">
    <img src = "data:image/png;base64,<?=base64_encode($image)?>"/>
</div>
    <div class="behind2">
    <h2 class="contenu">Description</h2>
    <p class="contenu"><?=$description?></p>
    <p class="contenu">Prix : <?=$prix?>€</p>
    <p class="contenu">Chaud : 
    <?php if ($chaud == 1){?>
        oui
    <?php }else{?>
        non
    <?php }?></p>
    </div>  
    <input type="number" class="choix" value="1" min="1">
 
    <a href="#"> 
<button type="submit" id="ajouterAuPanier" class="choix">Ajouter au panier</button>
</a>
</div>
<div id="panier" class="panier">
<h2>Panier</h2>
<div id="panierContenu">
    <p>Le panier est vide.</p>
</div>
<button type="button" id="fermerPanier" class="fermerPanier">Fermer</button>
<button type="button" id="viderPanier" class="viderPanier">Vider le panier</button>
<button type="button" id="commander" class="commander">Commander</button>
</div>

<script>
var listpanier = [];
var cookies = document.cookie.split(';');
for (var i = 0; i < cookies.length; i++) {
    var cookie = cookies[i].trim();
    if (cookie.indexOf('panier=') === 0) {
        var productIdsString = cookie.substring('panier='.length, cookie.length);
        var productIds = JSON.parse(productIdsString);
        for (var j = 0; j < productIds.length; j++) {
            var element = {id: productIds[j]};
            listpanier.push(element);
        }
    }
}

document.getElementById('fermerPanier').addEventListener('click', function() {
    var panier = document.getElementById('panier');
    panier.classList.remove('ouvert');
});

document.getElementById('ajouterAuPanier').addEventListener('click', function() {
    var idproduit = <?php echo json_encode($id) ?>;

    // Créer une liste d'identifiants de produits
    var productIds = [idproduit];

    // Convertir la liste en chaîne pour le stockage dans un cookie
    var productIdsString = JSON.stringify(productIds);

    // Créer le cookie "panier"
    document.cookie = "panier=" + productIdsString + "; expires=Thu, 18 Dec 2023 12:00:00 UTC; path=/";
    
    var element = {id: idproduit};
    
    listpanier.push(element);

    // Mettez à jour l'affichage du panier.
    var panierDiv = document.getElementById('panierContenu');

    var panier = document.getElementById('panier');
    if (!panier.classList.contains('ouvert')) {
       
        panier.classList.add('ouvert');
        panierDiv.innerHTML = '';
        for (var i = 0; i < listpanier.length; i++) {
            // Utilisez AJAX pour obtenir le nom et le prix du produit à partir de l'ID
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "get_produit.php?id=" + listpanier[i].id, true);
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var product = JSON.parse(this.responseText);
                    panierDiv.innerHTML += '<p>' + product.nom + ': ' + product.prix + '€</p>';
                }
            };
            xhr.send();
        }
    }
});


document.getElementById('viderPanier').addEventListener('click', function() {
    listpanier = [];
    var panierDiv = document.getElementById('panierContenu');
    panierDiv.innerHTML = '<p>Le panier est vide.</p>';
});

document.getElementById('commander').addEventListener('click', function() {
    var panierDiv = document.getElementById('panierContenu');
    panierDiv.innerHTML = '<p>Commande effectuée.</p>';
    listpanier = [];
    window.location.href = "./panier.php";
    
});
</script>
  
</div>
