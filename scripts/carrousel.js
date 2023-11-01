$(document).ready(function() { //Regarde si le document est bien chargé complètement
    function scrollImages() {
        if (document.hasFocus()) {
            var imgWidth = $('.carrousel img:first').outerWidth(); //Calcul la taille de la première image
           
            $('.carrousel img:first').animate({marginLeft: -2.05*imgWidth, opacity: -0.5}, 2000, function() { // Déplace l'image et modifie son opacity pour la faire disparaite
            $(this).appendTo('.carrousel').css({marginLeft: 0, opacity: 1});
            });
        }
    }

    setInterval(scrollImages, 5000); // Défilement toutes les 5 secondes
});