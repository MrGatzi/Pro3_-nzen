var data1;

$(document).ready(function(){
	
	
    $.get("api_que.php", function(data, status){
	   data1=JSON.parse(data);
       console.log(data1);
	   var symbolsArr=[];
	   for (index = 0; index < data1.length; ++index) {
			symbolsArr[index]=data1[index].symbol;
		   
		   
			//console.log(storedCoinValues[index]);
			var div = document.createElement("div");
			div.style.width = "250px";
			div.style.height = "30px";
			div.style.background = "white";
			div.style.color = "black";
			div.innerHTML = data1[index].id +" = "+ data1[index].price_usd;
			document.getElementById("1").appendChild(div);
			var x = document.getElementById("2");
			var option = document.createElement("option");
			option.text = data1[index].symbol;
			x.add(option);
		}
		
		console.log(symbolsArr);
    });
});
function myFunction1() {
	var e = document.getElementById("2");
	var crypto = e.options[e.selectedIndex].text;
	for (index = 0; index < data1.length; ++index) {
		
			if(crypto==data1[index].symbol){
				var l = document.getElementById("3");
				var k = l.value;
				console.log(k)
				
				document.getElementById("4").innerHTML=(parseInt(k)*parseFloat(data1[index].price_usd)).toString();
			}
		}
    
};