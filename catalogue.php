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


<div class="block">
  <div class="recette">
    <!-- <img src="images/bg.jpg" alt="Un beau plat" class="recette-image">-->
    <div class="recette-content">
      <div class="tabs is-centered">
        <ul>
          <li>
            <a href="cuisine-recettes-entree.php">
              <span class="icon is-small"><i class="fas fa-music" aria-hidden="true"></i></span>
              <span>Entrées</span>
            </a>
          </li>
          <li class="is-active">
            <a href="cuisine-recettes.php">
              <span class="icon is-small"><i class="fas fa-film" aria-hidden="true"></i></span>
              <span>Plats</span>
            </a>
          </li>
          <li>
            <a href="cuisine-recettes-dessert.php">
              <span class="icon is-small"><i class="far fa-file-alt" aria-hidden="true"></i></span>
              <span>Desserts</span>
            </a>
            <a href="cuisine-recettes-dessert.php">
              <span class="icon is-small"><i class="far fa-file-alt" aria-hidden="true"></i></span>
              <span>Boissons</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>


  <!-- Pagination -->

  <?php

$PlatsParPages = 5;
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
    ?>

  <div class="plat">
    <h2>Description</h2>
    <p><?=$description?></p>
    <p>Prix : <?=$prix?></p>
    <p>chaud : <?=$chaud?></p>  
    <img src = "data:image/png;base64,<?=base64_encode($image)?>" width = "210px" height = "210px"/>
    <h1><?=$nom?></h1>
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
  <a href="<?=$siteweb.$pageprec?>">Page précédente</a>
  <a href="<?=$siteweb.$pagesuiv?>">Page suivante</a>
  <ul>
    <li><a href="<?=$siteweb. 1?>" aria-label="Goto page 1">1</a></li>
    <li><span>&hellip;</span></li>
    <li><a href="<?=$siteweb.$pageprec?>" aria-label="Goto page 45"><?=$pageprec?></a></li>
    <li><a aria-label="Page 46" aria-current="page"><?=$pageCourante?></a></li>
    <form method="post">
    <li><a href="<?=$siteweb.$pagesuiv?>" id="pagesuivante" name="pagesuivante" aria-label="Goto page 47"><?=$pagesuiv?></a></li>
  </form>
    <li><span>&hellip;</span></li>
    <li><a href="<?=$siteweb.$NombreMaxPages?>" aria-label="Goto page 86"><?=$NombreMaxPages?></a></li>
  </ul>
</nav>


<?php
    include 'pagesParts/footer.php'
?>

</body>
</html>