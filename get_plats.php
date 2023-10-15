<?php

include 'includes/database.php';
global $db;
$PlatsParPages = 6;
$type =$_GET['type'];
$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
$CalculNombrePlats = $db->prepare("SELECT * FROM plats WHERE type=:type");
$CalculNombrePlats->bindParam(':type', $type);
$CalculNombrePlats->execute();
$NombreMaxPages = ceil(($CalculNombrePlats->RowCount())/$PlatsParPages);

if(isset($_GET['page']) AND !empty($_GET['page']) AND ($_GET['page'] <= $NombreMaxPages)){
  $_GET['page'] = intval($_GET['page']);
  $pageCourante = $_GET['page'];
} else {
  $pageCourante = 1;
}

if(!empty($_POST['pagesuivante'])) {
  $result =false;
}

$depart = ($pageCourante - 1) * $PlatsParPages;
$result =false;
$searchid = 1;

$PlatsTotalReq = $db->prepare("SELECT * FROM plats WHERE type=:type ORDER BY id_plat DESC LIMIT $depart,$PlatsParPages");
$PlatsTotalReq->bindParam(':type', $type);
$PlatsTotalReq->execute();
$NombrePlatsPage = $PlatsTotalReq->RowCount();
$boucle = 0;

?>




<div class="plats">
<?php
while ($boucle < $NombrePlatsPage):
    if($boucle==$PlatsParPages/2){
      ?></div>
      <div class="plats">
      <?php
    }
    $result = $PlatsTotalReq->fetch();
    $boucle = $boucle + 1;
    $nom = $result['nom'];
    $description = $result['description'];
    $prix = $result['prix'];
    $chaud = $result['chaud'];   
    $image = $result['image']; 
    ?>
    

  <div class="plat">
    <h1><?=$nom?></h1>
    <h2 class="contenu">Description</h2>
    <p class="contenu"><?=$description?></p>
    <p class="contenu">Prix : <?=$prix?></p>
    <p class="contenu">chaud : <?=$chaud?></p>  
    <img src = "data:image/png;base64,<?=base64_encode($image)?>"/>
  </div>
<?php   

  endwhile;

if($pageCourante==$NombreMaxPages){
  for($i=0; $i<(abs($PlatsParPages/2-$NombrePlatsPage%($PlatsParPages/2)));$i++){
    ?> <div class="plat"></div><?php  
  }
}
  


$pageprec = $pageCourante-1;
if($pageCourante==1){
  $pageprec = 1;
}
$pagesuiv = $pageCourante+1;
if($pageCourante==$NombreMaxPages){
  $pagesuiv = $NombreMaxPages;
}

?>
</div>

<?php $siteweb = './catalogue.php?page='; ?>

<nav class="navigation" role="navigation">
  <ul>
    <li><a href="#" onclick="loadPlatsPage('<?=$type?>',1)" aria-label="Goto page 1"><h3>1</h3></a></li>
    <li><span>&hellip;</span></li>
    <li><a href="#" onclick="loadPlatsPage('<?=$type?>',<?=$pageprec?>)" aria-label="Goto page 45"><h3><?=$pageprec?></h3></a></li>
    <li><a aria-label="Page 46" aria-current="page"><h3><?=$pageCourante?></h3></a></li>
    <form method="post">
    <li><a href="#" onclick="loadPlatsPage('<?=$type?>',<?=$pagesuiv?>)" id="pagesuivante" name="pagesuivante"><h3><?=$pagesuiv?></h3></a></li>
  </form>
    <li><span>&hellip;</span></li>
    <li><a href="#" onclick="loadPlatsPage('<?=$type?>',<?=$NombreMaxPages?>)"><h3><?=$NombreMaxPages?></h3></a></li>
  </ul>
</nav>