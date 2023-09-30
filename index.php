<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Ma Boutique en Ligne</title>
</head>

<body>

    <?php include("./pagesParts/header.php"); ?>
    
    <section class="presentation">
        <h1>Bienvenue</h1>
        
        <p>Au <strong>Nom de votre restaurant</strong>, l'endroit où la cuisine française authentique 
        rencontre les saveurs locales, fraîches et de qualité à un prix abordable pour tous. 
        Notre établissement est un véritable joyau pour les amateurs de gastronomie française 
        et ceux qui recherchent une expérience culinaire mémorable.</p>

        <p>Que vous veniez pour un dîner romantique, une sortie en famille ou un repas entre amis, lorsque vous franchissez nos portes, 
          vous serez accueilli par une ambiance chaleureuse et conviviale qui invite à la détente. 
          Notre menu varié saura satisfaire tous les palais.</p>

    </section>

    <link rel="stylesheet" href="styles/carrousel.css">
    <div class="carrousel">
        <img src="images/plat1.jpg" alt="Image 1">
        <img src="images/plat2.jpg" alt="Image 2">
        <img src="images/plat3.jpg" alt="Image 3">
        
    </div>
    
    <section class="presentation">
        <a href="#" class="bouton">Découvrir nos produits</a>
        <p>Que vous veniez pour un dîner romantique, une sortie en famille ou un repas entre amis, 
        <strong>Nom de votre restaurant</strong> est l'endroit idéal pour découvrir la richesse de la cuisine française 
        tout en savourant des produits locaux frais et de qualité. Rejoignez-nous et laissez-nous vous faire voyager 
        à travers les délices de la France, le tout à un prix qui ne pèsera pas sur votre portefeuille. 
        Nous avons hâte de vous accueillir et de vous faire vivre une expérience gastronomique exceptionnelle.</p>
    </section>
    
    <?php include("./pagesParts/footer.php"); ?>
    <script src="scripts/carrousel.js"></script>

</body>
</html>
