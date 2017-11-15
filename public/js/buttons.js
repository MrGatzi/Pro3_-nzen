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

});

function crypto() {
    var data1;

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
}

function remove() {
    $('.remove').click(function () {
        var parent = $(this).parent();
        parent.remove();
    });
}
