$(document).ready(function(){

    $('.login').click(function(){
        $('#loginForm').removeAttr('class').addClass('log');
        $('body').addClass('login-active');
        $('main').addClass('login-active');
    });

    $('#close').click(function(){
        $('#loginForm').addClass('out');
        $('#loginForm').removeClass('log');
        $('body').removeClass('login-active');
        $('main').removeClass('login-active');
    });
});