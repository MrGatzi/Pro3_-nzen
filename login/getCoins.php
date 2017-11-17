<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 16.11.2017
 * Time: 17:09
 */
$host = "localhost"; // Host name
$email = "root"; // Mysql email
$password = ""; // Mysql password
$db_name = "munzn"; // Database name
$id = 1;
$currency = 'XRP';
$amount = 110;

//DO NOT CHANGE BELOW THIS LINE UNLESS YOU CHANGE THE NAMES OF THE MEMBERS AND LOGINATTEMPTS TABLES

$tbl_prefix = "";
$tbl_user = $tbl_prefix."user";
$tbl_coins = $tbl_prefix."coins";
$res=[];
try {
    $conn = new PDO('mysql:host=' . $host . ';dbname=' . $db_name . ';charset=utf8', $email, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM " . $tbl_coins . " where user_iduser = 1";
    foreach ($conn->query($sql) as $row) {
        array_push($res, $row);
    }

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
echo json_encode($res);