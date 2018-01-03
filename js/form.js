
$(function() {
    setTimeout(function() {
        if (cookieData != null) {

            // split data into string array
            cookieArray = cookieData.split('&');

            //split each set of data
            $.each(cookieArray, function (k, v) {
                field = v.split('=');

                // insert data into fields

                console.log( field[0] + " " + field[1]);
                $('#calculator [name="'+field[0]+'"]').val(field[1]);

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


function addRow(){
    var parent = $( "#portfolio" ),
        html = $.parseHTML(code);
    for (var index2 = 0; index2 < storedValues.length; ++index2) {
        $(html[1]).find('.portfolio_values').append($("<option></option>")
            .attr("value",storedValues[index2].value)
            .text(storedValues[index2].symbol)
        );
    };
    parent.append(html);

}

$('#calculator').on('input', function() {

    // save input into String
    dataString = $(this).serialize();

    // new Cookie
    Cookies.set('formCookie', dataString);
    return false;
});

