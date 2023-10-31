<?php

include '../includes/database.php';
global $db;
$type =$_GET['boisson'];
$boisson = filter_input(INPUT_GET, 'boisson', FILTER_SANITIZE_STRING);
$BoissonsTotalReq = $db->prepare("SELECT * FROM boissons WHERE id_boisson=:boisson");
$BoissonsTotalReq->bindParam(':boisson', $boisson);
$BoissonsTotalReq->execute();
$result = $BoissonsTotalReq->fetch();
$id=$result['id_boisson'];
$nom = $result['nom'];
$description = $result['description'];
$volume_cl = $result['volume_cl'];
$prix = $result['prix'];
$alcool = $result['alcool'];   
$image = $result['image']; 
?>

<div class="presentation">
<div class="contenu_plat">
    <form method="post" action="../includes/update_boisson.php" enctype="multipart/form-data">
        <input type="hidden" name="id_boisson" value="<?=$id?>">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" value="<?=$nom?>"><br>
        <label for="description">Description :</label>
        <textarea name="description"><?=$description?></textarea><br>
        <label for="prix">Prix :</label>
        <input type="number" name="prix" value="<?=$prix?>"><br>
        <label for="volume_cl">Volume (en cl) :</label>
        <input type="number" name="volume_cl" value="<?=$volume_cl?>"><br>
        <label for="alcool">alcool :</label>
        <input type="checkbox" name="alcool" value="1" <?php if ($alcool == 1){?>checked<?php }?>><br>
        <label for="image">Image :</label>
        <input type="file" name="image"><br>
        <input type="submit" value="Modifier">
    </form>
</div>
</div>
