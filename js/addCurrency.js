/**
 * Created by Martin on 14.11.2017.
 */
$(document).ready(function(){

    $.get("tests/api_que.php", function(data, status){
        data1=JSON.parse(data);
        console.log(data1);
        for (index = 0; index < data1.length; ++index) {
            $('[name="currency"]').append($('<option>', {
                value: data1[index].price_usd,
                text: data1[index].symbol
            }));
        }
    });
    $.get("tests/fiat_api.php", function(data, status){
        data1=JSON.parse(data);
        $.each(data1.rates, function( key, value ) {
            //alert( key + " is glei : " + value );
            $('[name="money"]').append($('<option>', {
                value: value,
                text: key
            }));
        });
    });
});