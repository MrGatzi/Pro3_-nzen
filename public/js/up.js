$(document).ready(function(){

    $('.login').click(function(){
        $('#upForm').removeAttr('class').addClass('log');
        $('body').addClass('up-active');
        $('main').addClass('up-active');
    });

    $('#close').click(function(){
        $('#upForm').addClass('out');
        $('#upForm').removeClass('log');
        $('body').removeClass('up-active');
        $('main').removeClass('up-active');
    });
});