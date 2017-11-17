var storedValues;
var stordUSDValues;
$(document).ready(function () {
    getcrypto();
    getUSD();
    var code = '\n <div class="newCurrency row">\n <select class="coin" name="currency">\n </select>\n <input class="amount" type="text" name="amount" value="0">\n <button class="button remove" type="button" name="remove">x</button>\n </div>\n';
    $.get("login/getCoins.php", function(data, status){
        var port=JSON.parse(data);
        for (var index = 0; index < port.length; ++index) {
            var parent = $( "#portfolio" )
            var html = $.parseHTML(code);
            $(html[1]).find('.crypto_coin').val(port[index].currency);
            $(html[1]).find('.amount').val(port[index].amount);
            $(html[1]).find('.amount').val(port[index].amount);
            for (var index2 = 0; index2 < storedValues.length; ++index2) {
                $(html[1]).find('.coin').append($("<option></option>")
                    .attr("value",storedValues[index2].price_usd)
                    .text(storedValues[index2].symbol)
                    .prop('selected', function(){
                        if(storedValues[index2].symbol==port[index].currency){
                            return true;
                        }else{
                            return false;
                        }
                    })
                );
            };
            parent.append(html);

            remove();
        }
    });
    $('#add').click(function () {
        var parent = $( "#portfolio" ),
            html = $.parseHTML(code);
        for (var index2 = 0; index2 < storedValues.length; ++index2) {
            $(html[1]).find('.coin').append($("<option></option>")
                .attr("value",storedValues[index2].price_usd)
                .text(storedValues[index2].symbol)
            );
        };
        parent.append(html);

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

function getcrypto() {
    $.ajax({
        async: false,
        type: 'GET',
        url: 'tests/api_que.php',
        success: function(data) {
            storedValues=JSON.parse(data);
        },
        fail: function(data) {
            return false;
        }
    });
    /*$.get("tests/api_que.php", function(data, status){
     storedValues=JSON.parse(data);
     });*/
    return true;
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
function getUSD(){
    //eventuell Ajax anfrage wie bei get Crypto machen ?
    $.get("tests/fiat_api.php", function(data, status){
        stordUSDValues=JSON.parse(data);
        $.each(stordUSDValues.rates, function( key, value ) {

            $('[name="money"]').append($('<option>', {
                value: value,
                text: key
            }));
        });
    });
}
