$(document).ready(function() { //Regarde si le document est bien chargé complètement
    // Fonction pour changer la couleur du fond en fonction de l'heure
    function changerCouleurFond() {
        var span = document.getElementById("cercle"); // Obtenez l'élément <span> par son ID
        var maintenant = new Date(); // Obtenez l'heure actuelle

        var heure = maintenant.getHours(); // Obtenez l'heure (0-23)

        // Vous pouvez ajuster les plages horaires ici pour changer la couleur en fonction de l'heure
        if (heure >=12 && heure < 22) {
        // Pendant les horaires d'ouverture
        span.style.backgroundColor = "green";
        } else {
        // Pendant les horaires de fermeture
        span.style.backgroundColor = "red"; 
        }
    }

    // Appelez la fonction pour la première fois
    changerCouleurFond();

    // Vous pouvez également appeler la fonction périodiquement avec setInterval
    setInterval(changerCouleurFond, 60000); // Met à jour la couleur toutes les minutes
});
