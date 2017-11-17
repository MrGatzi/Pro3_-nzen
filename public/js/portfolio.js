$(document).ready(function () {

    $('.addSection').click(function () {
        $('#change').removeClass('hidden');
        $('.addSection').addClass('hidden');
    });

    $('.closeSection').click(function () {
        $('#change').addClass('hidden');
        $('.addSection').removeClass('hidden');
    });

    $('#change').addClass('hidden');

});