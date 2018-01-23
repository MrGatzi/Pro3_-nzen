<?php

require 'vendor/autoload.php';
session_start();

//twig loader
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);


if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'register.php') !== false && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    echo $twig->render('save.twig', array('username' => $_SESSION['username']));
}
else
{
    header('Location:index.php');
    exit();
}






