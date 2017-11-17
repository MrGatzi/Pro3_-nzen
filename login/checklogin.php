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

$resp = new RespObj($email, $loginCtl->checkLogin($email, $password));
$jsonResp = json_encode($resp);
echo $jsonResp;

if($resp = 'true'){
    $_SESSION['loggedin'] = true;
    $_SESSION['user'] = $email;
    unset($resp, $jsonResp);
    ob_end_flush();
    header('Location:../index.php');
    exit();
}


