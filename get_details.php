<?php

include 'includes/database.php';
global $db;
$type =$_GET['plat'];
$plat = filter_input(INPUT_GET, 'plat', FILTER_SANITIZE_STRING);
$PlatsTotalReq = $db->prepare("SELECT * FROM plats WHERE id_plat=:plat");
$PlatsTotalReq->bindParam(':plat', $plat);
$PlatsTotalReq->execute();
$result = $PlatsTotalReq->fetch();
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
    <a href="#"> 
<button type="submit" id="panier" class="submit">Ajouter au panier</button>
  </a>
  
  </div>

</div>
