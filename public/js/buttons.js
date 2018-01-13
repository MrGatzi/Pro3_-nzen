var storedValues;
var stordUSDValues;
$(document).ready(function () {
    getcrypto();
    getUSD();
    updateSingleMoney();
    var code = '\n <div class="newCurrency row">\n<input class="amount" type="text" name="amount" value="0">\n <select class="portfolio_values" name="currency"></select>\n <p name="CurrencyRowValue" class="change button">0</p>\n <button class="button remove" type="button" name="remove">x</button>\n </div>';
  //  var code = '\n <div class="newCurrency row">\n <select class="portfolio_values" name="currency">\n </select>\n <input class="amount" type="text" name="amount" value="0">\n <button class="button remove" type="button" name="remove">x</button>\n </div>\n';
   /* $.ajax({
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
                    .attr("value",storedValues[index2].value)
                    .text(storedValues[index2].symbol)
                );
            };
            parent.append(html);
        }
    });*/
    $('#add').click(function () {
        getcrypto();
        var parent = $( "#portfolio" ),
            html = $.parseHTML(code);
        for (var index2 = 0; index2 < storedValues.length; ++index2) {
            $(html[1]).find('.portfolio_values').append($("<option></option>")
                .attr("value",storedValues[index2].value)
                .text(storedValues[index2].symbol)
            );
        };
        parent.append(html);

        remove();
    });
    remove();
    $('#portfolio').on("change", '.amount', function(){
        calcUSD();
        updateSingleMoney();
    });
   $('#portfolio').on("change", '[name="currency"]', function(){
        calcUSD();
       updateSingleMoney();
    });
    $('#calculator').on("change", '[name="money"]', function(){
        updateMoney();
        updateSingleMoney();
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
    $('.portfolio_values').each(function( index ) {
         all = all +($( this ).val()*$( this ).prev().val());
    });
    all=Math.round(all*100)/100;
    $('.output').text(all);
    $('#user_worth').text(all)
}
function getUSD(){
    //eventuell Ajax anfrage wie bei get Crypto machen ?
    $.get("lib/fiat_api.php", function(data, status){
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
        all = all +($( this ).val()*$( this ).prev().val());
    });
    all=all*$('[name="money"]').val();
    all=Math.round(all*100)/100;
    $('#user_worth').text(all);
    $('.output').text(all);
}
function updateSingleMoney(){
    $('[name="CurrencyRowValue"]').each(function( index ) {
        $( this ).text(Math.round($( this ).prev().val()*$( this ).prev().prev().val()*100)/100);
    });
}
