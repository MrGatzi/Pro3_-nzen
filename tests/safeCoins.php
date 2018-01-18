<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 16.11.2017
 * Time: 14:56
 */
$host = "localhost"; // Host name
$email = "root"; // Mysql email
$password = ""; // Mysql password
$db_name = "munzn"; // Database name
$id = 1;
$currency = 'DOGE';
$amount = 0.1;

//DO NOT CHANGE BELOW THIS LINE UNLESS YOU CHANGE THE NAMES OF THE MEMBERS AND LOGINATTEMPTS TABLES

$tbl_prefix = "";
$tbl_user = $tbl_prefix."user";
$tbl_coins = $tbl_prefix."coins";
try {
    $conn = new PDO('mysql:host=' . $host . ';dbname=' . $db_name . ';charset=utf8', $email, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO " . $tbl_coins . " (user_iduser, currency,amount) VALUES (:user_iduser, :currency,:amount)");
    $stmt->bindParam(':user_iduser', $id);
    $stmt->bindParam(':currency', $currency);
    $stmt->bindParam(':amount', $amount);
    $statement=$stmt->execute();
    print $statement;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
echo 'safed';