var data1;
$(document).ready(function () {
    var code = $('#portfolio').html();

    $.get("login/getCoins.php", function(data, status){
        var port=JSON.parse(data);
        for (index = 0; index < port.length; ++index) {
            var parent = $( "#portfolio" )
            var html = $.parseHTML(code);
            $(html[1]).find('.crypto_coin').val(port[index].currency);
            $(html[1]).find('.amount').val(port[index].amount);

            console.log(html[1]);
            parent.append(html);
            // console.log(html[1]);
            crypto();
            remove();
        }
    });



    $('#add').click(function () {
        var parent = $( "#portfolio" ),
            html = $.parseHTML(code);

        parent.append(html);
        crypto();
        remove();
    });

    remove();
    $('#calculator').on("change", '.amount', function(){
        calcUSD();
    });
   $('#calculator').on("change", '[name="currency"]', function(){
        calcUSD();
    });
});


function crypto() {


    $.get("tests/api_que.php", function(data, status){
        data1=JSON.parse(data);
       // console.log(data1);
        for (index = 0; index < data1.length; ++index) {
            $('[name="currency"]').append($('<option>', {
                value: data1[index].price_usd,
                text: data1[index].symbol
            }));
        }
    });
}

function remove() {

    $('.remove').click(function () {
        var parent = $(this).parent();
        parent.remove();
        calcUSD();
    });
    calcUSD();

}
function calcUSD() {
    var all=0;
    $('[name="currency"]').each(function( index ) {
     all = all +($( this ).val()*$( this ).next().val());
    });
    $('.output').text(all);
}
