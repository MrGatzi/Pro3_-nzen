<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

$sql = "SELECT * FROM `uservalues2`";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
	var_dump($result);	
    while($row = $result->fetch_assoc()) {
      //  echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
	  var_dump($row);
	  echo $row['date'];
	  
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>