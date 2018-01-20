$(document).ready(function () {
    // cookies -> cache
    setTimeout(function() {
        sendarrNew=[];
        $( ".newCurrency" ).each(function( index ) {
            if ($(this).find(".amount").val()!=0) {
                sendarrNew.push({symbol: $(this).find(".portfolio_values").find("option:selected").text(), value: $(this).find(".amount").val()});
            }
        });
        console.log(sendarrNew);
        $.ajax({
            async: false,
            type: "POST",
            url: "lib/dataBaseCon.php",
            data: {'data':sendarrNew,'safe': true},
            success: function(data) {
            }
        });
        window.location.href = 'index.php';
    }, 2000);



});