<?php
session_start();

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
<a href="#"> 
<button type="submit" id="afficherPanier" class="choix">Afficher le panier</button>
</a>
</div>
<div id="panier" class="panier">
<h2>Panier</h2>

<div id="panierContenu">
    <p>Le panier est vide.</p>
</div>
<br>
<div id="prixTotalDiv">Prix total : </div>
<button type="button" id="commander" class="commander">Commander</button>
<button type="button" id="viderPanier" class="viderPanier">Vider le panier</button>
<button type="button" id="fermerPanier" class="fermerPanier">Fermer</button>
</div>

<script>
var listpanier_plats = [];
var cookies = document.cookie.split(';');
for (var i = 0; i < cookies.length; i++) {
    var cookie = cookies[i].trim();
    if (cookie.indexOf('panier_plats=') === 0) {
        var productIdsString = cookie.substring('panier_plats='.length, cookie.length);
        var productIds = JSON.parse(productIdsString);
        for (var j = 0; j < productIds.length; j++) {
            var element = productIds[j];
            listpanier_plats.push(element);
        }
    }
}

var listpanier_boissons = [];
var cookies = document.cookie.split(';');
for (var i = 0; i < cookies.length; i++) {
    var cookie = cookies[i].trim();
    if (cookie.indexOf('panier_boissons=') === 0) {
        var productIdsString = cookie.substring('panier_boissons='.length, cookie.length);
        var productIds = JSON.parse(productIdsString);
        for (var j = 0; j < productIds.length; j++) {
            var element = productIds[j];
            listpanier_boissons.push(element);
        }
    }
}



document.getElementById('afficherPanier').addEventListener('click',function() {
    if (displayPanier()){
        updatePanier();
    }else{
        closePanier();
    }
})

document.getElementById('fermerPanier').addEventListener('click', function() {
    closePanier();
});

document.getElementById('ajouterAuPanier').addEventListener('click', function() {
    var idproduit = <?php echo json_encode($id) ?>;

    // Créer une liste d'identifiants de produits
    listpanier_plats.push(idproduit);

    // Convertir la liste en chaîne pour le stockage dans un cookie
    var productIdsString = JSON.stringify(listpanier_plats);

    // Créer le cookie "panier"
    document.cookie = "panier_plats=" + productIdsString + "; expires=Thu, 18 Dec 2023 12:00:00 UTC; path=/";

    // Mettez à jour l'affichage du panier.
    displayPanier();
    updatePanier();
});

function displayPanier(){
    var panierDiv = document.getElementById('panierContenu');
    var panier = document.getElementById('panier');
    if (!panier.classList.contains('ouvert')) {
        panier.classList.add('ouvert');
        return true;
    }else{
        return false;
    }
}

function closePanier(){ 
    var panier = document.getElementById('panier');
    if(panier.classList.contains('ouvert')){
        panier.classList.remove('ouvert');
    }
}

function updatePanier(){
    var panierDiv = document.getElementById('panierContenu');
    var panier = document.getElementById('panier');
    var prixTotal = 0;
        panierDiv.innerHTML = '';
        
        for (var i = 0; i < listpanier_plats.length; i++) {
            // Utilisez AJAX pour obtenir le nom et le prix du produit à partir de l'ID
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "get_produit.php?id=" + listpanier_plats[i], true);
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var product = JSON.parse(this.responseText);
                    prixTotal = parseInt(prixTotal) + parseInt(product.prix);
                    panierDiv.innerHTML += '<p>' + product.nom + ': ' + product.prix + '€</p>';
                }
                updatePrixTotal(prixTotal)
            };
            xhr.send();
        }
        for (var i = 0; i < listpanier_boissons.length; i++) {
            // Utilisez AJAX pour obtenir le nom et le prix du produit à partir de l'ID
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "get_produit_boisson.php?id=" + listpanier_boissons[i], true);
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var product = JSON.parse(this.responseText);
                    prixTotal = parseInt(prixTotal) + parseInt(product.prix);
                    panierDiv.innerHTML += '<p>' + product.nom + ': ' + product.prix + '€</p>';
                }
                updatePrixTotal(prixTotal)
            };
            xhr.send();
        }
        
    }

function updatePrixTotal(prixTotal){
    var prixTotalDiv = document.getElementById("prixTotalDiv");
    prixTotalDiv.innerHTML = "Prix Total : " + prixTotal +  " €";

}


document.getElementById('viderPanier').addEventListener('click', function() {
    updatePrixTotal(0);
    listpanier_plats = [];
    listpanier_boissons = [];
    var panierDiv = document.getElementById('panierContenu');
    panierDiv.innerHTML = '<p>Le panier est vide.</p>';
    document.cookie = "panier_plats=; expires=Thu, 18 Dec 2013 12:00:00 UTC; path=/";
    document.cookie = "panier_boissons=; expires=Thu, 18 Dec 2013 12:00:00 UTC; path=/";

});

document.getElementById('commander').addEventListener('click', function() {
    if ((listpanier_plats.length + listpanier_boissons.length) >0){
        // Vérifier si l'utilisateur est connecté
        var isLoggedIn = <?php echo json_encode(isset($_SESSION['mail'])); ?>;
        console.log('login : '+ isLoggedIn);
        if (isLoggedIn) {
            if (confirm("Voulez-vous commander ces produits ?")) {
                createCommande().then(function(response) {
                    var panierDiv = document.getElementById('panierContenu');
                    panierDiv.innerHTML = '<p>Commande effectuée.</p>';
                    listpanier_plats = [];

                    window.location.href = "./commandes_precedentes.php";
                }).catch(function(error) {
                    alert("Erreur lors de la création de la commande ");
                });
            }
        } else {
            alert("Vous devez être connecté pour passer une commande !");
        }
    }else{
        alert("Vous n'avez aucun produit dans votre panier !")
    }
});


function createCommande(){
    return new Promise(function(resolve, reject) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "create_commande.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var listpanier_platsJSON = JSON.stringify(listpanier_plats);
    var listpanier_boissonsJSON = JSON.stringify(listpanier_boissons);
    var params = "listpanier_plats=" + listpanier_platsJSON+"&listpanier_boissons=" + listpanier_boissonsJSON;
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                resolve(response);
            } else {
                reject("Error: " + xhr.status);
            }
        }
    };

    xhr.send(params);


});

}
</script>
  
</div>
