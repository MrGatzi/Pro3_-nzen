$(document).ready(function(){
    $.get("api_que.php", function(data, status){
	   data1=JSON.parse(data);
       console.log(data1);
	   for (index = 0; index < data1.length; ++index) {
			console.log(data1[index]);
			var div = document.createElement("div");
			div.style.width = "250px";
			div.style.height = "30px";
			div.style.background = "white";
			div.style.color = "black";
			div.innerHTML = data1[index].id +" = "+ data1[index].price_usd;
			document.getElementById("1").appendChild(div);
		}
    });
});