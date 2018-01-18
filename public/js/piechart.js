/**
 * Created by Martin on 13.01.2018.
 */
var ctx;
var myChart;
$(document).ready(function () {
    ctx = document.getElementById('myChart').getContext('2d');
    ctx.width  = 400;
    ctx.height = 300;
    startChart();
});
function startChart(){
    var colors=[];
    var values=0;
    var vlabels=[];
    var vvalues=[];
    var user;
    var coins;
    $.ajax({
        async: false,
        type: 'POST',
        url: 'lib/dataBaseCon.php',
        data: {'take': true},
        success: function(data) {
            user=JSON.parse(data);
        },
        error: function(data) {
            console.log("Error creating Chart couldn'z get User Data");
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
            console.log("Error creating Chart couldn't get Cryptocurrency Data");
        }
    });
    for (var index = 0; index < user.length; ++index) {
        for(var index2 = 0;index2 < coins.length; ++index2){
            if(user[index].symbol==coins[index2].symbol){
                values++;
                vlabels.push(user[index].symbol);
                vvalues.push(Math.round(coins[index2].value*user[index].value*100)/100);
            }
        }
    }
    $.ajax({
        async: false,
        type: 'POST',
        url: 'lib/getColor.php',
        data: {json: JSON.stringify(values)},
        success: function(data) {
            colors=JSON.parse(data);
        },
        error: function(data) {
            console.log("Error creating Chart couldn't get Color Data");
        }
    });
    myChart = new Chart(ctx, {
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
}
function updateChart(sendarrNew){
    var colors=[];
    var values=0;
    var vlabels=[];
    var vvalues=[];
    var user=sendarrNew;
    var coins;
    $.ajax({
        async: false,
        type: 'GET',
        url: 'lib/crypto_api.php',
        success: function(data) {
            coins=JSON.parse(data);
        },
        error: function(data) {
            console.log("Error creating Chart couldn't get Cryptocurrency Data");
        }
    });
    for (var index = 0; index < user.length; ++index) {
        for(var index2 = 0;index2 < coins.length; ++index2){
            if(user[index].symbol==coins[index2].symbol){
                values++;
                vlabels.push(user[index].symbol);
                vvalues.push(Math.round(coins[index2].value*user[index].value*100)/100);
            }
        }
    }
    $.ajax({
        async: false,
        type: 'POST',
        url: 'lib/getColor.php',
        data: {json: JSON.stringify(values)},
        success: function(data) {
            colors=JSON.parse(data);
        },
        error: function(data) {
            console.log("Error creating Chart couldn't get Color Data");
        }
    });
    var udata= {
        labels: vlabels,
            datasets: [{
            label: 'User',
            data: vvalues,
            backgroundColor: colors,
        }]
    }
    myChart.config.data =udata;
    myChart.update();
}