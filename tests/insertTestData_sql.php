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

$sql = "INSERT INTO UserValues2 (id_user, currency, c_values,date)
VALUES (5, 'BTC', '5', CURDATE())";

if (mysqli_query($conn, $sql)) {
    echo "Table UserValues updated successfully";
} else {
    echo "Error 2 table: " . mysqli_error($conn);
}
$sql = "INSERT INTO UserValues2 (id_user, currency, c_values,date)
VALUES (1, 'LTC', '2', CURDATE())";

if (mysqli_query($conn, $sql)) {
    echo "Table UserValues2 updated successfully";
} else {
    echo "Error 2 table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>