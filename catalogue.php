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
      <a href="#" onclick="loadPlatsType('boisson'); return false;">
        <h3>Boissons</h3>
      </a>
    </td>
  </tr>
</table>

<div id="div1"></div>



<?php
    include 'pagesParts/footer.php'
?>

</body>
</html>