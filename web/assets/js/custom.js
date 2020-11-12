$(document).ready(function () {

    $('.alert').alert();

    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        $("#close").toggleClass("fa-angle-double-left fa-angle-double-right");
    });


})


