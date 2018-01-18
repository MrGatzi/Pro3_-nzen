<?php
require_once 'dbconn.php';
class getUser extends DbConn
{
    public function getUserData($user, $option){
        $conf = new GlobalConf;

        try {

            $db = new DbConn;
            $tbl_user = $db->tbl_user;
            $err = '';

        } catch (PDOException $e) {

            $err = "Error: " . $e->getMessage();
            return $err;

        }

        $stmt = $db->conn->prepare("SELECT * FROM ".$tbl_user." WHERE email = :myemail");
        $stmt->bindParam(':myemail', $user);
        $stmt->execute();

        // Gets query result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($option === "all"){
            return $result;
        }
        return $result[$option];
    }

}