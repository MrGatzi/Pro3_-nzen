<?php
ob_start();
session_start();
include 'config.php';
require 'includes/functions.php';
include 'includes/loginform.php';

// Define $myemail and $mypassword
$email = $_POST['myemail'];
$password = $_POST['mypassword'];

// Prevent MySQL injection
$email = stripslashes($email);
$password = stripcslashes($password);

$loginCtl = new LoginForm;
$conf = new GlobalConf;
$check = $loginCtl->checkLogin($email, $password);

if($check === 'true'){
    $getData = new getUser();
    $data = $getData->getUserData($email, "all");
    $_SESSION['iduser'] = $data['iduser'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['loggedin'] = true;
    $_SESSION['error'] = false;
    $_SESSION['user'] = $email;
    ob_end_flush();
    header('Location:../index.php');
    exit();
}else{
    $_SESSION['loggedin'] = false;
    $_SESSION['error'] = true;
    ob_end_flush();
    header('Location:../index.php');
    exit();
}

