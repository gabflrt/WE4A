$(document).ready(function() { //Regarde si le document est bien chargé complètement
    // Fonction pour changer la couleur du fond en fonction de l'heure
    function changerCouleurFond() {
        var span = document.getElementById("cercle"); // Obtention de l'élément <span> par son ID
        var maintenant = new Date(); // Obtention de la date

        var heure = maintenant.getHours(); // Obtention de l'heure 

        if (heure >=12 && heure < 23) {
        // Pendant les horaires d'ouverture
        span.style.backgroundColor = "green";
        } else {
        // Pendant les horaires de fermeture
        span.style.backgroundColor = "red"; 
        }
    }

    
    changerCouleurFond();

    setInterval(changerCouleurFond, 60000); // Met à jour la couleur toutes les minutes
});
