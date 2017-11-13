<?php
class Verify extends DbConn
{
    public function verifyUser($uid, $verify)
    {
        try {
            $vdb = new DbConn;
            $tbl_user = $vdb->tbl_user;
            $verr = '';

        // prepare sql and bind parameters
        $vstmt = $vdb->conn->prepare('UPDATE '.$tbl_user.' SET verified = :verify WHERE id = :uid');
            $vstmt->bindParam(':uid', $uid);
            $vstmt->bindParam(':verify', $verify);
            $vstmt->execute();

        } catch (PDOException $v) {

            $verr = 'Error: ' . $v->getMessage();

        }

    //Determines returned value ('true' or error code)
    $resp = ($verr == '') ? 'true' : $verr;

        return $resp;

    }
}
