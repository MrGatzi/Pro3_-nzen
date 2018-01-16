$(document).ready(function () {
    "use strict";
    $("#submit").click(function () {

        var email = $("#myemail").val(), password = $("#mypassword").val();
        console.log(u)

        if ((email === "") || (password === "")) {
            $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Please enter email and a password</div>");
        } else {
            $.ajax({
                type: "POST",
                url: "login/checklogin.php",
                data: "myemail=" + email + "&mypassword=" + password,
                dataType: 'JSON',
                success: function (html) {
                    //console.log(html.response + ' ' + html.username);
                    if (html.response === 'true') {
                        //location.assign("../index.php");
                       location.reload();
                        return html.email;
                    } else {
                        $("#message").html(html.response);
                    }
                },
                error: function (textStatus, errorThrown) {
                    console.log(textStatus);
                    console.log(errorThrown);
                },
                beforeSend: function () {
                    $("#message").html("<p class='text-center'><img src='images/ajax-loader.gif'></p>");
                }
            });
        }
        return false;
    });
});
