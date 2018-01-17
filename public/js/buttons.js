var storedCoinValues;
var stordUSDValues;
var code = '\n <div class="newCurrency row">\n<input class="amount" type="text" name="amount" value="0">\n <select class="portfolio_values" name="currency"></select>\n <p name="CurrencyRowValue" class="change button">0</p>\n <button class="button remove" type="button" name="remove">x</button>\n </div>';
//  var code = '\n <div class="newCurrency row">\n <select class="portfolio_values" name="currency">\n </select>\n <input class="amount" type="text" name="amount" value="0">\n <button class="button remove" type="button" name="remove">x</button>\n </div>\n';

$(document).ready(function () {


    getcrypto();
    getUSD();
    updateRowValueFiat(); // brauch i daS=?

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
                for (var index2 = 0; index2 < storedCoinValues.length; ++index2) {
                    $(html[1]).find('.portfolio_values').append($("<option></option>")
                        .attr("value",storedCoinValues[index2].price_usd)
                        .text(storedCoinValues[index2].symbol)
                        .prop('selected', function(){
                            if(storedCoinValues[index2].symbol==port[index].currency){
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
            for (var index2 = 0; index2 < storedCoinValues.length; ++index2) {
                $(html[1]).find('.portfolio_values').append($("<option></option>")
                    .attr("value",storedCoinValues[index2].value)
                    .text(storedCoinValues[index2].symbol)
                );
            };
            parent.append(html);
        }
    });*/
    $('#add').click(function () {
        getcrypto();
        var parent = $( "#portfolio" ),
            html = $.parseHTML(code);
        for (var index2 = 0; index2 < storedCoinValues.length; ++index2) {
            $(html[1]).find('.portfolio_values').append($("<option></option>")
                .attr("value",storedCoinValues[index2].value)
                .text(storedCoinValues[index2].symbol)
            );
        };
        parent.append(html);

        remove();
    });
    $('.remove').click(function () {
        $('.remove').click(function () {
            var parent = $(this).parent();
            parent.remove();
            updateAllFiatsVallue();
        });
    });
    $('#portfolio').on("change", '.amount', function(){
        updateAllFiatsVallue();
    });
   $('#portfolio').on("change", '[name="currency"]', function(){
       updateAllFiatsVallue();
    });
    $('#calculator').on("change", '[name="money"]', function(){
        updateAllFiatsVallue();
    });
    checkCookie();
});

function getcrypto() {
    $.ajax({
        async: false,
        type: 'GET',
        url: 'lib/crypto_api.php',
        success: function(data) {
            storedCoinValues=JSON.parse(data);
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
        updateAllFiatsVallue();
    });
    updateAllFiatsVallue();

}
function getUSD() {
    $.ajax({
        async: false,
        type: 'GET',
        url: 'lib/fiat_api.php',
        success: function (data) {
            stordUSDValues = JSON.parse(data);
            $.each(stordUSDValues, function (key, value) {
                $('[name="money"]').append($('<option>', {
                    value: value,
                    text: key
                }));
            });
        },
        fail: function (data) {
            return false;
        }
    });
    return true;
}
function updateTotalValueFiat(){
    var all=0;
    $('[name="currency"]').each(function( index ) {
        all = all +($( this ).val()*$( this ).prev().val());
    });
    all=all*$('[name="money"]').val();
    all=Math.round(all*100)/100;
    $('#user_worth').text(all);
    $('.output').text(all);
    return all;
}
function updateRowValueFiat(){
    $('[name="CurrencyRowValue"]').each(function( index ) {
        $( this ).text(Math.round($( this ).prev().val()*$( this ).prev().prev().val()*100*$('[name="money"]').val())/100);
    });
}
function updateAllFiatsVallue(){
    setCookies();
    updateRowValueFiat();
    updateTotalValueFiat();
}
function setCookies(){
    var exdays=1; // safes cookies 5 days long !
    var cookieString="";
    $('[name="CurrencyRowValue"]').each(function( index ) {
        if($( this ).prev().prev().val()>0){
            cookieString=cookieString+[$( this ).prev().find("option:selected").text()]+"->"+$( this ).prev().prev().val()+"|";
        }
    });

    cname="Coins"
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cookieString + ";" + expires + ";path=/";

    var exchange;
    exchange=$('[name="money"]').find("option:selected").text();
    cname="Exchange"
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + exchange + ";" + expires + ";path=/";

}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function checkCookie() {
    var coins = getCookie("Coins");
    var exchange = getCookie("Exchange");
    if (coins != ""&&exchange!="") {
        singlecoin=coins.split("|");
        for(var i = 0; i < singlecoin.length; i++) {
            split=singlecoin[i].split("->");
            value=split[1];
            coin=split[0];
            if(value>0){
                var parent = $( "#portfolio" ),
                    html = $.parseHTML(code);
                console.log(value);
                $(html[1]).find('.amount').val(value);
                for (var index2 = 0; index2 < storedCoinValues.length; ++index2) {
                    $(html[1]).find('.portfolio_values').append($("<option></option>")
                        .attr("value",storedCoinValues[index2].value)
                        .text(storedCoinValues[index2].symbol)
                        .prop('selected', function(){
                            if(storedCoinValues[index2].symbol==coin){
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
        }
        if(!isNaN(stordUSDValues[exchange])){
            $("#fiatoption option:contains("+exchange+")").prop('selected', true);
            updateTotalValueFiat();
        }
    }else{
       console.log("no Cookies found.");
    }
}
