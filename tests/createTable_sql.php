

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

$sql = "CREATE TABLE UserValues2 (
id_user int UNSIGNED, 
currency VARCHAR(3) NOT NULL,
c_values float(53) NOT Null,
date DATE
);";

if (mysqli_query($conn, $sql)) {
    echo "Table UserValues created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}


mysqli_close($conn);
?>