var data1;

$(document).ready(function(){

    $.get("tests/api_que.php", function(data, status){
        data1=JSON.parse(data);
        console.log(data1);
        var symbolsArr=[];
        for (index = 0; index < data1.length; ++index) {
            symbolsArr[index]=data1[index].symbol;

            var parent = document.getElementsByClassName('crypto')[0];
            var option = document.createElement("option");
            option.text = data1[index].symbol;
            parent.add(option);
        }

        console.log(symbolsArr);
    });
});