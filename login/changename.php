<?php
require_once 'includes/functions.php';
include_once 'config.php';
session_start();

$iduser = $_SESSION['iduser'];
$username = $_POST['newName'];

// Prevent MySQL injection
$username = stripslashes($username);

        $a = new ChangeUserForm();

        $response = $a->changeUserName($username, $iduser);

        //Success
        if ($response == 'true') {
            $_SESSION['username'] = htmlspecialchars($username);
            ob_end_flush();
            //save data
            header('Location:../index.php');
            exit();

        } else {
            //Failure
            mySqlErrors($response);


}
