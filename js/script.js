// Une fois que la page a étée chargée correctement.
$(document).ready(function () {
    // Lorsque l'on clique sur le titre d'un panel.
    $(".toggleNext").on("click", function () {
        // Son contenu disparait ou réapparait.
        $(this).next().toggle(500);
    });
});