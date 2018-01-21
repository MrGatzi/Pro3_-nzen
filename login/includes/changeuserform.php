<?php
class ChangeUserForm extends DbConn
{
    public function changeUserName($iduser, $username)
    {
        try {

            $db = new DbConn;
            $tbl_user = $db->tbl_user;
            // prepare sql and bind parameters
            $stmt = $db->conn->prepare("UPDATE ".$tbl_user." SET username=:username WHERE iduser=:iduser");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':iduser', $iduser);
            $stmt->execute();

            $err = '';

        } catch (PDOException $e) {

            $err = "Error: " . $e->getMessage();

        }
        //Determines returned value ('true' or error code)
        if ($err == '') {

            $success = 'true';

        } else {

            $success = $err;

        };

        return $success;

    }
    public function checkPassword($iduser, $oldPassword)
    {
        try {

            $db = new DbConn;
            $tbl_user = $db->tbl_user;


            $err = '';


        } catch (PDOException $e) {

            $err = "Error: " . $e->getMessage();

        }

        // prepare sql and bind parameters
        $stmt = $db->conn->prepare("SELECT password FROM ".$tbl_user." WHERE iduser = :iduser");
        $stmt->bindParam(':iduser', $iduser);
        $stmt->execute();

        $pass = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!password_verify($oldPassword, $pass)){
            return false;
        }else{
            return true;
        }
    }

public function updatePassword($iduser, $password)
{
    try {

        $db = new DbConn;
        $tbl_user = $db->tbl_user;
        // prepare sql and bind parameters
        $stmt = $db->conn->prepare("UPDATE " . $tbl_user . " SET password=:password WHERE iduser=:iduser");
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':iduser', $iduser);
        $stmt->execute();

        $err = '';

    } catch (PDOException $e) {

        $err = "Error: " . $e->getMessage();

    }
    //Determines returned value ('true' or error code)
    if ($err == '') {

        $success = 'true';

    } else {

        $success = $err;

    };

    return $success;
    }
}
