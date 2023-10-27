<?php

include 'includes/database.php';
global $db;
$PlatsParPages = 6;
$type = filter_input(INPUT_GET, FILTER_SANITIZE_STRING);
$CalculNombrePlats = $db->prepare("SELECT * FROM boissons");
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

$PlatsTotalReq = $db->prepare("SELECT * FROM boissons ORDER BY id_boisson DESC LIMIT $depart,$PlatsParPages");
$PlatsTotalReq->execute();
$NombrePlatsPage = $PlatsTotalReq->RowCount();
$boucle = 0;

?>




<div class="platspetit">
<?php
while ($boucle < $NombrePlatsPage):
    if($boucle==$PlatsParPages/2){
      ?></div>
      <div class="plats">
      <?php
    }
    $result = $PlatsTotalReq->fetch();
    $boucle = $boucle + 1;
    $boisson=$result['id_boisson'];
    $nom = $result['nom'];
    $description = $result['description'];
    $prix = $result['prix'];
    $alcool = $result['alcool'];  
    $volume = $result['volume_cl'];    
    $image = $result['image']; 
    ?>
    

  <div class="plat">
    <h1><?=$nom?></h1>
    <a href="#" onclick="loadDetails2(<?=$boisson?>)"><img src = "data:image/png;base64,<?=base64_encode($image)?>"/></a>
    <div class="behind">
      <p class="contenu"><?=$description?></p>
      <p class="contenu">Volume : <?=$volume?> cl</p>
      <p class="contenu">Prix : <?=$prix?>€</p>
      <?php if ($alcool == 1){?>
        <img src="images/majeur.png" id ="chaud" alt="Alcool";>
        <?php } ?>
    </div> 
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
    <li><a href="#" onclick="loadBoissonsPage(1)" aria-label="Goto page 1"><h3>1</h3></a></li>
    <li><span>&hellip;</span></li>
    <li><a href="#" onclick="loadBoissonsPage(<?=$pageprec?>)" aria-label="Goto page 45"><h3><?=$pageprec?></h3></a></li>
    <li><a aria-label="Page 46" aria-current="page"><h3><?=$pageCourante?></h3></a></li>
    <form method="post">
    <li><a href="#" onclick="loadBoissonsPage(<?=$pagesuiv?>)" id="pagesuivante" name="pagesuivante"><h3><?=$pagesuiv?></h3></a></li>
  </form>
    <li><span>&hellip;</span></li>
    <li><a href="#" onclick="loadBoissonsPage(<?=$NombreMaxPages?>)"><h3><?=$NombreMaxPages?></h3></a></li>
  </ul>
</nav>