$(document).ready(function () {

    $('.addSection').click(function () {
        $('#change').removeClass('hidden');
        $('.addSection').addClass('hidden');
    });

    $('.closeSection').click(function () {
        $('#change').addClass('hidden');
        $('.addSection').removeClass('hidden');
    });

    $('#change').addClass('hidden');

    $('#safe_button').click(function () {
        sendarrNew=[];
        $( ".newCurrency" ).each(function( index ) {
            // console.log( $( this ).find(".portfolio_values").find("option:selected").text());
            //  console.log( $( this ).find(".amount").val());
            if ($(this).find(".amount").val()!=0) {
                sendarrNew.push({symbol: $(this).find(".portfolio_values").find("option:selected").text(), value: $(this).find(".amount").val()});
            }
        });
        $.ajax({
            type: "POST",
            url: "lib/safeDataBaseCon.php",
            data: {'data':sendarrNew},
            success: function(data) {
                console.log(data);
            }
        });
    });
});