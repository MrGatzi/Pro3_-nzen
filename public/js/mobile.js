$(document).ready(function(){

    checkSize();

    window.onresize = function(event) {
        checkSize();
    };


});

function checkSize() {

    if ($(window).width() < 576) {
        $('#logo').addClass('hidden');
    }

    if ($(window).width() >= 576) {
        $('#logo').removeClass('hidden');
    }

    if ($(window).width() < 768) {
        $('#split').addClass('hidden');
        $('#show').removeClass('hidden');
        $('#form').addClass('only');
        $("#cover").css('background-image', 'none');
    }

    if ($(window).width() >= 768) {
        $('#split').removeClass('hidden');
        $('#show').addClass('hidden');
        $('#form').removeClass('only');
        $("#cover").css('background-image', 'repeating-radial-gradient(circle at 0 80%, rgba(20, 20, 23, 0.1), rgba(64, 116, 128, 0.15) 1px, rgba(216, 219, 226, 0.2) 2px, rgba(88, 164, 176, 0.15) 3px, rgba(27, 27, 30, 0.1) 4px), radial-gradient(circle at 0 100%, #1a1a1a, #0e0e1e, #0c0c0f)');
    }
}