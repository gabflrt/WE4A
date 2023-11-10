<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/catalogue.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <title>Liste des plats</title>

    <script>
    function loadPlatsType(type) {
    $.get({
      url: "get_plats.php", 
      data:{
        "type":type
      },
      success: function(result){
      $("#div1").html(result);
    }
});
}
function loadPlatsPage(type,page) {
    $.get({
      url: "get_plats.php", 
      data:{
        "type":type,
        "page":page
      },
      success: function(result){
      $("#div1").html(result);
    }
  });
}

function loadDetails(plat) {
    $.get({
      url: "get_details.php",
      data:{
        "plat":plat
      },
      success: function(result){
      $("#div1").html(result);
    }
  });
  var nouvelleURL = "catalogue.php?plat="+plat;
  window.history.pushState({}, "", nouvelleURL);
}

function loadBoissons() {
    $.get({
      url: "get_boissons.php", 
      data:{},
      success: function(result){
      $("#div1").html(result);
    }
});

    
}

function loadBoissonsPage(page) {
    $.get({
      url: "get_boissons.php", 
      data:{
        "page":page
      },
      success: function(result){
      $("#div1").html(result);
    }
  });
}

function loadDetails2(boisson) {
    $.get({
      url: "get_details2.php", 
      data:{
        "boisson":boisson
      },
      success: function(result){
      $("#div1").html(result);
    }
  });
  var nouvelleURL = "catalogue.php?boisson="+boisson;
  window.history.pushState({}, "", nouvelleURL);
}


</script>
</head>

<body>

    <?php
    include 'pagesParts/header.php';
    
?>



<table class="menu">
  <tr>
    <td>
      <a href="#" onclick="loadPlatsType('entree');">
        <h3>Entrées</h3>
      </a>
    </td>
    <td>
      <a href="#" onclick="loadPlatsType('plat');">
        <h3>Plats</h3>
      </a>
    </td>
    <td>
      <a href="#" onclick="loadPlatsType('dessert'); return false;">
        <h3>Desserts</h3>
      </a>
    </td>
    <td>
      <a href="#" onclick="loadBoissons(); return false;">
        <h3>Boissons</h3>
      </a>
    </td>
  </tr>
</table>

<div id="div1">
  <div class="plats categories">
  <div class="plat">
    <?php 
    $CalculNombrePlats = $db->prepare("SELECT id_plat FROM plats WHERE type='entree'");
    $CalculNombrePlats->execute();
    $plats = $CalculNombrePlats->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($plats) > 0) {
        $PlatAleatoire = $plats[array_rand($plats)]['id_plat'];
    
        $PlatReq = $db->prepare("SELECT * FROM plats WHERE id_plat=:plat");
        $PlatReq->bindParam(':plat', $PlatAleatoire);
        $PlatReq->execute();
        $result = $PlatReq->fetch();
    }     
    ?>
    <h1>Entrées</h1>
    <a href="#" onclick="loadPlatsType('entree');"><img src="data:image/jpg;base64,<?=base64_encode($result['image'])?>"/></a>
  </div>
    <div class="plat">
      <?php 
    $CalculNombrePlats = $db->prepare("SELECT id_plat FROM plats WHERE type='plat'");
    $CalculNombrePlats->execute();
    $plats = $CalculNombrePlats->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($plats) > 0) {
        $PlatAleatoire = $plats[array_rand($plats)]['id_plat'];
    
        $PlatReq = $db->prepare("SELECT * FROM plats WHERE id_plat=:plat");
        $PlatReq->bindParam(':plat', $PlatAleatoire);
        $PlatReq->execute();
        $result = $PlatReq->fetch();
    }         ?>  
      <h1>Plats</h1>
      <a href="#" onclick="loadPlatsType('plat');"><img src = "data:image/png;base64,<?=base64_encode($result['image'])?>"/></a>
    </div>
  </div>

    <div class="plats">
      <div class="plat">
          <?php 
    $CalculNombrePlats = $db->prepare("SELECT id_plat FROM plats WHERE type='dessert'");
    $CalculNombrePlats->execute();
    $plats = $CalculNombrePlats->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($plats) > 0) {
        $PlatAleatoire = $plats[array_rand($plats)]['id_plat'];
    
        $PlatReq = $db->prepare("SELECT * FROM plats WHERE id_plat=:plat");
        $PlatReq->bindParam(':plat', $PlatAleatoire);
        $PlatReq->execute();
        $result = $PlatReq->fetch();
    }     
    ?>
      <h1>Desserts</h1>
      <a href="#" onclick="loadPlatsType('dessert');"><img src = "data:image/png;base64,<?=base64_encode($result['image'])?>"/></a>
    </div>

    
    <div class="plat"> 
    <?php 
    $CalculNombrePlats = $db->prepare("SELECT id_boisson FROM boissons");
    $CalculNombrePlats->execute();
    $plats = $CalculNombrePlats->fetchAll(PDO::FETCH_ASSOC);
        
    if (count($plats) > 0) {
        $PlatAleatoire = $plats[array_rand($plats)]['id_boisson'];
    
        $PlatReq = $db->prepare("SELECT * FROM boissons WHERE id_boisson=:boisson");
        $PlatReq->bindParam(':boisson', $PlatAleatoire);
        $PlatReq->execute();
        $result = $PlatReq->fetch();
    }     
    ?>
      <h1>Boissons</h1>
      <a href="#" onclick="loadBoissons();"><img src = "data:image/png;base64,<?=base64_encode($result['image'])?>"/></a>
    </div>
  </div>
</div>

<?php
    include 'pagesParts/footer.php'
?>

</body>
</html>