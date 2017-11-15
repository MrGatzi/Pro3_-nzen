$(document).ready(function(){

    $('#login').click(function(){
        $('#form').removeAttr('class').addClass('log');
        $('body').addClass('login-active');
    });

    $('#close').click(function(){
        $('#form').addClass('out');
        $('#form').removeClass('log');
        $('body').removeClass('login-active');
    });
});