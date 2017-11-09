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

$sql = "INSERT INTO UserValues (id_user, currency, c_values)
VALUES (1, 'BTC', '5')";

if (mysqli_query($conn, $sql)) {
    echo "Table UserValues updated successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
$sql = "INSERT INTO UserValues (id_user, currency, c_values)
VALUES (1, 'LTC', '2')";

if (mysqli_query($conn, $sql)) {
    echo "Table UserValues updated successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>