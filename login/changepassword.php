<?php
ob_start();
session_start();
include 'config.php';
require 'includes/functions.php';

// Define $myemail and $mypassword
$iduser = $_SESSION['iduser'];
$oldPassword = $_POST['oldPassword'];
$newPassword = $_POST['newPassword'];
$repeatPassword = $_POST['repeatPassword'];
$newpw = password_hash($newPassword, PASSWORD_DEFAULT);

if(strlen($newPassword) < 5){
    $_SESSION['pwdChange'] = "Passwords have to have at least 4 characters";
    error();
}else if ($newPassword != $repeatPassword) {
    $_SESSION['pwdChange'] = "Passwords do not match";
    ob_end_flush();
    header('Location:../index.php');
    error();
}else{
    $a = new ChangeUserForm();

    if($a->checkPassword($iduser, $oldPassword)){
        $_SESSION['pwdChange'] = "Old password is wrong";
        error();
    }else if($a->updatePassword($iduser, $newpw) === 'true'){
    ob_end_flush();
    header('Location:../index.php');
    exit();
    }
}

function error(){
    ob_end_flush();
    header('Location:../index.php');
    exit();
}