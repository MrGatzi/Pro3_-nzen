<?php
ob_start();

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

echo $resp;
if($resp = 'true'){
    echo 'true';
    unset($resp, $jsonResp);
    ob_end_flush();
    header('Location:../index.php');
    exit();
}

