
$(function() {
    setTimeout(function() {
        if (cookieData != null) {

            // split data into string array
            cookieArray = cookieData.split('&');

            //split each set of data
            $.each(cookieArray, function (k, v) {
                field = v.split('=');

                // insert data into fields
               // $("input[name='amount']").val(field[1]);
                console.log( field[0] + " " + field[1]);
                $('#calculator [name="'+field[0]+'"]').val(field[1]);
            });
        }
    }, 30);
    cookieData = Cookies.get('formCookie');

    return false;
});

$('#calculator').on('input', function() {

    // save input into String
    dataString = $(this).serialize();

    // new Cookie
    Cookies.set('formCookie', dataString);
    return false;
});

