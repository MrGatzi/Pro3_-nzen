var storedValues;
var stordUSDValues;
$(document).ready(function () {
    getcrypto();
    getUSD();
    var code = '\n <div class="newCurrency row">\n <select class="portfolio_values" name="currency">\n </select>\n <input class="amount" type="text" name="amount" value="0">\n <button class="button remove" type="button" name="remove">x</button>\n </div>\n';
    $.ajax({
        async: false,
        type: 'GET',
        url: 'login/getCoins1.php',
        success: function(data) {
            var port=JSON.parse(data);
            for (var index = 0; index < port.length; ++index) {
                var parent = $( "#portfolio" );
                var html = $.parseHTML(code);
                $(html[1]).find('.crypto_coin').val(port[index].currency);
                $(html[1]).find('.amount').val(port[index].amount);
                $(html[1]).find('.amount').val(port[index].amount);
                for (var index2 = 0; index2 < storedValues.length; ++index2) {
                    $(html[1]).find('.portfolio_values').append($("<option></option>")
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
        },
        error: function(data) {
            var parent = $( "#portfolio" );
            var html = $.parseHTML(code);
            for (var index2 = 0; index2 < storedValues.length; ++index2) {
                $(html[1]).find('.portfolio_values').append($("<option></option>")
                    .attr("value",storedValues[index2].price_usd)
                    .text(storedValues[index2].symbol)
                );
            };
            parent.append(html);
        }
    });
    $('#add').click(function () {
        getcrypto();
        var parent = $( "#portfolio" ),
            html = $.parseHTML(code);
        for (var index2 = 0; index2 < storedValues.length; ++index2) {
            $(html[1]).find('.portfolio_values').append($("<option></option>")
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
    $('#calculator').on("change", '[name="money"]', function(){
        updateMoney();
    });
});

function getcrypto() {
    $.ajax({
        async: false,
        type: 'GET',
        url: 'lib/crypto_api.php',
        success: function(data) {
            storedValues=JSON.parse(data);
        },
        fail: function(data) {
            return false;
        }
    });
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
    $.get("lib/fiat_api.php", function(data, status){
        console.log();
        stordUSDValues=JSON.parse(data);
        $.each(stordUSDValues.rates, function( key, value ) {

            $('[name="money"]').append($('<option>', {
                value: value,
                text: key
            }));
        });
    });
}
function updateMoney(){
    var all=0;
    $('[name="currency"]').each(function( index ) {
        all = all +($( this ).val()*$( this ).next().val());
    });
    all=all*$('[name="money"]').val();
    console.log('hey hey '+$('[name="money"]').val());
    $('.output').text(all);
}
