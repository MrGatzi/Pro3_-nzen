<?php
require_once 'dbconn.php';
class getID extends DbConn
{
    public function getUserID($user){
        $conf = new GlobalConf;

        try {

            $db = new DbConn;
            $tbl_user = $db->tbl_user;
            $err = '';

        } catch (PDOException $e) {

            $err = "Error: " . $e->getMessage();

        }

        $stmt = $db->conn->prepare("SELECT * FROM ".$tbl_user." WHERE email = :myemail");
        $stmt->bindParam(':myemail', $user);
        $stmt->execute();

        // Gets query result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['iduser'];

    }
}