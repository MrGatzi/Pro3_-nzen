$(document).ready(function(){

    $('.user').click(function(){
        $('#upForm').removeAttr('class').addClass('log');
        $('body').addClass('up-active');
    });

    $('#close').click(function(){
        $('#upForm').addClass('out');
        $('#upForm').removeClass('log');
        $('body').removeClass('up-active');
    });

    $('#name').click(function () {
        $('#usernameChange').removeClass('hidden');
        $('#passwortChange').addClass('hidden');
        $('#name').addClass('clicked');
        $('#changePassword').removeClass('clicked');
    });

    $('#changePassword').click(function () {
        $('#usernameChange').addClass('hidden');
        $('#passwortChange').removeClass('hidden');
        $('#changePassword').addClass('clicked');
        $('#name').removeClass('clicked');
    });

    $('#usernameChange').addClass('hidden');
    //$('#passwortChange').addClass('hidden');

});