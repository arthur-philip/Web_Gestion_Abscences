$(document).ready(function () {
    $(".toggleNext").on("click", function () {
        $(this).next().toggle(500);
    });
});