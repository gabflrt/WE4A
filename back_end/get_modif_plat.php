<?php

include '../includes/database.php';
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
    <form method="post" action="../includes/update_plat.php" enctype="multipart/form-data">
        <input type="hidden" name="id_plat" value="<?=$id?>">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" value="<?=$nom?>"><br>
        <label for="description">Description :</label>
        <textarea name="description"><?=$description?></textarea><br>
        <label for="prix">Prix :</label>
        <input type="number" name="prix" value="<?=$prix?>"><br>
        <label for="chaud">Chaud :</label>
        <input type="checkbox" name="chaud" value="1" <?php if ($chaud == 1){?>checked<?php }?>><br>
        <label for="image">Image :</label>
        <input type="file" name="image"><br>
        <input type="submit" value="Modifier">
    </form>
</div>
</div>
