<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/catalogue.css">


    <title>Liste des plats</title>
</head>

<body>

    <?php
    include 'pagesParts/header.php'
?>


    <?php 
    include 'includes/database.php';
    global $db;
?>



<table class="menu">
  <tr>
    <td>
      <a href="./catalogue.php">
        <h3>Entrées</h3>
      </a>
    </td>
    <td>
      <a href="./catalogue.php">
        <h3>Plats</h3>
      </a>
    </td>
    <td>
      <a href="./catalogue.php">
        <h3>Desserts</h3>
      </a>
    </td>
    <td>
      <a href="./catalogue.php">
        <h3>Boissons</h3>
      </a>
    </td>
  </tr>
</table>


  <!-- Pagination -->

  <?php

$PlatsParPages = 6;
$CalculNombrePlats = $db->prepare("SELECT * FROM plats WHERE type='plat'");
$CalculNombrePlats->execute();
$NombreMaxPages = ($CalculNombrePlats->RowCount())/$PlatsParPages;

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
$RecettesTotalesReq = $db->prepare("SELECT * FROM plats WHERE type='plat' ORDER BY id_plat DESC LIMIT $depart,$PlatsParPages");
$RecettesTotalesReq->execute();
$RecettesTotales = $RecettesTotalesReq->RowCount();
$boucle = 0;

?>

<!-- Pagination -->




<div class="plats">
<?php
while ($boucle < $RecettesTotales):
  $result = $RecettesTotalesReq->fetch();
  $boucle = $boucle + 1;

    $nom = $result['nom'];
    $description = $result['description'];
    $prix = $result['prix'];
    $chaud = $result['chaud'];   
    $image = $result['image']; 
    $image = $result['image'];

    if($boucle==$RecettesTotales/2+1){
      ?></div>
      <div class="plats">
      <?php
    }
    ?>
    

  <div class="plat">
<<<<<<< HEAD
    <h2>Description</h2>
    <p><?=$description?></p>
    <p>Prix : <?=$prix?></p>
    <p>chaud : <?=$chaud?></p>  
    <img src = "data:image/png;base64,<?=base64_encode($image)?>" width = "210px" height = "210px"/>
    <h1><?=$nom?></h1>
=======
    <h1><?=$nom?></h1>
    <h2 class="contenu">Description</h2>
    <p class="contenu"><?=$description?></p>
    <p class="contenu">Prix : <?=$prix?></p>
    <p class="contenu">chaud : <?=$chaud?></p>  
    <img src = "data:image/png;base64,<?=base64_encode($image)?>"/>
>>>>>>> eed7d242f02d1ce95855c0b785f74be9dde4f3bd
  </div>
<?php        

endwhile;


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


<?php
    include 'pagesParts/footer.php'
?>

</body>
</html>