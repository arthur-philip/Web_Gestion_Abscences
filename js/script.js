// Une fois que la page a étée chargée correctement.
$(document).ready(function () {
    // Lorsque l'on clique sur le titre d'un panel, son contenu disparait ou réapparait.
    $(".toggleNext").on("click", function () {
        $(this).next().toggle(500);
    });
});