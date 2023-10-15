<?php

include 'includes/database.php';
global $db;
$PlatsParPages = 6;
$CalculNombrePlats = $db->prepare("SELECT * FROM plats WHERE type='plat'");
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
$type =$_GET['type'];
$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
$RecettesTotalesReq = $db->prepare("SELECT * FROM plats WHERE type=:type ORDER BY id_plat DESC LIMIT $depart,$PlatsParPages");
$RecettesTotalesReq->bindParam(':type', $type);
$RecettesTotalesReq->execute();
$RecettesTotales = $RecettesTotalesReq->RowCount();
$boucle = 0;

?>




<div class="plats">
<?php
while ($boucle < $RecettesTotales):
    if($boucle==$PlatsParPages/2){
      ?></div>
      <div class="plats">
      <?php
    }
    $result = $RecettesTotalesReq->fetch();
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

  for($i=0; $i<(abs($PlatsParPages/2-$RecettesTotales%($PlatsParPages/2)));$i++){
    ?> <div class="plat"></div><?php  
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
    <li><a href="<?=$siteweb. 1?>" aria-label="Goto page 1"><h3>1</h3></a></li>
    <li><span>&hellip;</span></li>
    <li><a href="<?=$siteweb.$pageprec?>" aria-label="Goto page 45"><h3><?=$pageprec?></h3></a></li>
    <li><a aria-label="Page 46" aria-current="page"><h3><?=$pageCourante?></h3></a></li>
    <form method="post">
    <li><a href="<?=$siteweb.$pagesuiv?>" id="pagesuivante" name="pagesuivante" aria-label="Goto page 47"><h3><?=$pagesuiv?></h3></a></li>
  </form>
    <li><span>&hellip;</span></li>
    <li><a href="<?=$siteweb.$NombreMaxPages?>" aria-label="Goto page 86"><h3><?=$NombreMaxPages?></h3></a></li>
  </ul>
</nav>