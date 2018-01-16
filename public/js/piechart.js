/**
 * Created by Martin on 13.01.2018.
 */
$(document).ready(function () {
    var colors=[];
    var values=0;
    var vlabels=[];
    var vvalues=[];
    var user;
    var coins;
    $.ajax({
        async: false,
        type: 'GET',
        url: 'lib/getCoins.php',
        success: function(data) {
            user=JSON.parse(data);
        },
        error: function(data) {
        }
    });
    $.ajax({
        async: false,
        type: 'GET',
        url: 'lib/crypto_api.php',
        success: function(data) {
            coins=JSON.parse(data);
        },
        error: function(data) {
        }
    });
    for (var index = 0; index < user.length; ++index) {
        for(var index2 = 0;index2 < coins.length; ++index2){
            if(user[index][2]==coins[index2].symbol){
                values++;
                vlabels.push(user[index][2]);
                vvalues.push(Math.round(coins[index2].value*user[index][3]*100)/100);
            }
        }
    }
    $.ajax({
        async: false,
        type: 'POST',
        url: 'lib/getColor.php',
        data: {json: JSON.stringify(values)},
        success: function(data) {
            console.log(data);
            colors=JSON.parse(data);
        }
    });
    var ctx = document.getElementById('myChart').getContext('2d');
    ctx.width  = 400;
    ctx.height = 300;
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: vlabels,
            datasets: [{
                label: 'User',
                data: vvalues,
                backgroundColor: colors,
            }]
        }
    });
});