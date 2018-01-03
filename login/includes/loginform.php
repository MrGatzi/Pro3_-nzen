<?php
require_once 'dbconn.php';
class LoginForm extends DbConn
{
    public function checkLogin($myemail, $mypassword){
        $conf = new GlobalConf;

        try {

            $db = new DbConn;
            $tbl_user = $db->tbl_user;
            $err = '';

        } catch (PDOException $e) {

            $err = "Error: " . $e->getMessage();

        }

        $stmt = $db->conn->prepare("SELECT * FROM ".$tbl_user." WHERE email = :myemail");
        $stmt->bindParam(':myemail', $myemail);
        $stmt->execute();

        // Gets query result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Checks password entered against db password hash
            if (password_verify($mypassword, $result['password']) && $result['verified'] == '1') {
                // Register $myemail, $mypassword and return "true"
                $success = 'true';
                $_SESSION['iduser'] = $result['iduser'];

            } elseif (password_verify($mypassword, $result['password']) && $result['verified'] == '0') {

                // Account not yet verified
                $success = "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>You need to verify your email first</div>";

            } else {
                // Wrong username or password
                $success = "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Wrong Email or Password</div>";
            }

        return $success;

    }
}