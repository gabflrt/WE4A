<link rel="stylesheet" href="styles/carrousel.css">
    <div class="carrousel">
        <a href="catalogue.php">

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
        <img src="data:image/jpg;base64,<?=base64_encode($result['image'])?>"/>

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
            }   
        ?>
        <img src="data:image/jpg;base64,<?=base64_encode($result['image'])?>"/>

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
        <img src="data:image/jpg;base64,<?=base64_encode($result['image'])?>"/>   

    </div>
    <script src="scripts/carrousel.js"></script>