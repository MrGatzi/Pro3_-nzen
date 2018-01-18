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
            if ($(this).find(".amount").val()!=0) {
                sendarrNew.push({symbol: $(this).find(".portfolio_values").find("option:selected").text(), value: $(this).find(".amount").val()});
            }
        });
        $.ajax({
            async: false,
            type: "POST",
            url: "lib/dataBaseCon.php",
            data: {'data':sendarrNew,'safe': true},
            success: function(data) {
                updateChart(sendarrNew);
            }
        });
    });

});
$(window).load(function() {
    getUSD();
    updateAllFiatsVallue();
});