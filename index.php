<?php session_start();

// Vérifie si l'utilisateur est un client
if (isset($_SESSION['mail'])&&$_SESSION['admin'] == 1) {
    // Redirige vers la page d'accueil du front end si l'utilisateur est un client
    header('Location: ./back_end/index.php');
    exit;
} ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/index.css">
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

    <?php include("carroussel.php"); ?>
    
    <section class="presentation">
        <a href="./catalogue.php" class="bouton">Découvrir nos produits</a>
        <p>Que vous veniez pour un dîner romantique, une sortie en famille ou un repas entre amis, 
        <strong>Nom de votre restaurant</strong> est l'endroit idéal pour découvrir la richesse de la cuisine française 
        tout en savourant des produits locaux frais et de qualité. Rejoignez-nous et laissez-nous vous faire voyager 
        à travers les délices de la France, le tout à un prix qui ne pèsera pas sur votre portefeuille. 
        Nous avons hâte de vous accueillir et de vous faire vivre une expérience gastronomique exceptionnelle.</p>
    </section>       

    <div class="infos">
        <div class="horaires-ouverture">            
            <h2>Horaires d'ouverture <span id="cercle" style="background-color: red;"></span></h2>  
            <p>Lundi - Vendredi : 12h00 - 23h00 </p>
            <p>Samedi : 12h00 - 23h00 </p>
            <p>Dimanche : 12h00 - 23h00 </p>
                   
        </div>
        <script src="scripts/ouverture.js"></script>
        
        <div class="carte">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d787.1128419427807!2d6.843922484615831!3d47.64250745027049!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47923bcbe48d9815%3A0x236ca5f1738937d5!2sUTBM%20Campus%20de%20Belfort!5e0!3m2!1sfr!2sfr!4v1697029067621!5m2!1sfr!2sfr" width="400" height="260" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <div class ="contact">
        <div class="formulaire">
        <h1>Contactez-nous</h1><br>
        <p>Par téléphone : +33123456789</p><br>
        <p>Ou par mail :</p><br>
        <form method="post">
            <label>Votre email :</label><br>
            <input type="email" name="email" required><br>
            <label>Message :</label><br>
            <textarea name="message" required></textarea><br><br>
            <input type="submit" class="bouton">
        </form>
    <?php
    if (isset($_POST['message'])) {
        $retour = mail('quentin.macullo@gmail.com', 'Envoi depuis la page Contact', $_POST['message'], 'From: webmaster@monsite.fr' . "\r\n" . 'Reply-to: ' . $_POST['email']);
        if($retour)
            echo '<p>Votre message a bien été envoyé.</p>';
    }
    ?>
        </div>
    </div>

    <?php include("./pagesParts/footer.php"); ?>

    </body>
</html>
