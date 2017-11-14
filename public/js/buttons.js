$(document).ready(function () {

    var parent = document.getElementById('portfolio');

    $('.add').click(function () {
        $('#portfolio').add($("<div class='row'>{% include 'currency.twig' %}</div>"));
    });

    $('.remove').click(function () {
        var parent = $(this).parent();
        parent.remove();
    });

});
