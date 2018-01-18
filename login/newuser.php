<?php
require_once 'includes/functions.php';
include_once 'config.php';
session_start();
$newuser = $_POST['email'];
$newpw = password_hash($_POST['password'], PASSWORD_DEFAULT);
$pw1 = $_POST['password'];
$pw2 = $_POST['confirmPassword'];
$username = $_POST['username'];

// Prevent MySQL injection
$newuser = stripslashes($newuser);
$username = stripslashes($username);

$getData = new getUser();

if($newuser === $getData->getUserData($newuser, "email")){
    //duplicate email
    $_SESSION['registerErr'] = "This email is already in use!";
    errorExit();

} else if ($pw1 != $pw2) {
//if passwords do not match
    $_SESSION['registerErr'] = "Passwords must match!";
    errorExit();

} else if (strlen($pw1) < 4) {
//if password is too short
    $_SESSION['registerErr'] = "Password must be at least 4 characters";
    errorExit();
} else {
    if (isset($_POST['email']) && !empty(str_replace(' ', '', $_POST['email'])) && isset($_POST['password']) && !empty(str_replace(' ', '', $_POST['password']))) {

        //Tries inserting into database and add response to variable

        $a = new NewUserForm;

        $response = $a->createUser($username, $newuser, $newpw);

        //Success
        if ($response == 'true') {


            $conf = new GlobalConf;
            $_SESSION['iduser'] = $getData->getUserData($newuser, "iduser");
            $_SESSION['loggedin'] = true;
            $_SESSION['error'] = false;
            $_SESSION['user'] = $newuser;
            $_SESSION['username'] = $username;
            unset($_SESSION['registerErr']);
            ob_end_flush();
            header('Location:../portfolio.php');
            exit();

        } else {
            //Failure
            mySqlErrors($response);

        }
    } else {
        ob_end_flush();
        header('Location:../register.php');
        exit();
    }
};

function errorExit(){
    ob_end_flush();
    header('Location:../register.php');
    exit();
}
