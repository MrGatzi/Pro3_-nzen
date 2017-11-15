$(document).ready(function () {

    var code = $('#portfolio').html();

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
    var data1;

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
    console.log(all)
    $('.output').text(all);
}
