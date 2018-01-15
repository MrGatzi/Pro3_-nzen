
$(function() {
    setTimeout(function() {
        if (cookieData != null) {

            //splits data into string array
            cookieArray = cookieData.split('&');

            //counts the amount of rows
            var count = (cookieData.match(/amount/g) || []).length;

            //adds the rows needed
            for (var i = 0; i < count -1; i++) {
                $("#add").click();
            }

            var index = 0;
            //split each set of data
            $.each(cookieArray, function (k, v) {
                field = v.split('=');

                // insert data into fields

                console.log( index + " " + field[0] + " " + field[1]);
                if(field[0] != "money"){
                    $('#calculator [name="'+field[0]+'"]:eq('+index+')').val(field[1]);
                }else{
                    $('#calculator [name="'+field[0]+'"]').val(field[1]);
                }
                if (field[0] == "amount"){
                    index++;
                }

            });
        }
        // calcUSD()
        var all=0;
        $('.portfolio_values').each(function( index ) {
            all = all +($( this ).val()*$( this ).next().val());
        });
        $('.output').text(all);
        $('#user_worth').text(all)

    }, 30);
    cookieData = Cookies.get('formCookie');

    return false;
});



$('#amount').on("input", function() {

    console.log("anything");

    // save input into String
    dataString = $(this).serialize();

    console.log(dataString);
    // new Cookie
    Cookies.set('formCookie', dataString);
    return false;
});

