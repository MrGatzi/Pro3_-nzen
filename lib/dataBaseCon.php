<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 17.11.2017
 * Time: 22:37
 */
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST" ) {
    header('HTTP/1.1 200 OK');
    if(isset($_POST['safe'])){
        echo safeUserCoins();
    }
    if(isset($_POST['take'])){
        echo getUserCoins();
    }

}
function getUserCoins(){
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $iduser=$_SESSION['iduser'];


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
        $sql = "SELECT * FROM " . $tbl_coins . " where user_iduser = ".$iduser;
        $stat =$conn->query($sql);

        foreach ($stat as $row) {
            array_push($res, array("symbol" => $row['currency'],'value'=>$row['amount']));
        }

    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    //var_dump($res);
    return json_encode($res);

    }
}
function safeUserCoins(){
    /**
     * Created by PhpStorm.
     * User: Martin
     * Date: 16.11.2017
     * Time: 14:56
     */
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $iduser = $_SESSION['iduser'];// get User Id für die abfrage!!
        $host = "localhost"; // Host name
        $email = "root"; // Mysql email
        $password = ""; // Mysql password
        $db_name = "munzn"; // Database name
        $currency = 'DOGE';
        $amount = 0.1;

//DO NOT CHANGE BELOW THIS LINE UNLESS YOU CHANGE THE NAMES OF THE MEMBERS AND LOGINATTEMPTS TABLES

        $tbl_prefix = "";
        $tbl_coins = $tbl_prefix . "coins";
        try {
            $conn = new PDO('mysql:host=' . $host . ';dbname=' . $db_name . ';charset=utf8', $email, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("DELETE FROM " . $tbl_coins . " WHERE user_iduser=" .$iduser);
            $statement = $stmt->execute();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

        try {
            $conn = new PDO('mysql:host=' . $host . ';dbname=' . $db_name . ';charset=utf8', $email, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql_stmt="";
            foreach ($_POST['data'] as &$value) {
                $sql_stmt.="INSERT INTO " . $tbl_coins . " (user_iduser, currency,amount) VALUES (".$iduser.", \"".$value['symbol']."\",".$value['value'].");";
            }
            $stmt = $conn->prepare($sql_stmt);
            $statement = $stmt->execute();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        echo "saged";
    }
}