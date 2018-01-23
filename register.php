<?php
session_start();
require 'vendor/autoload.php';

//twig init
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header('Location:index.php');
    exit();
}

else if(isset($_SESSION['registerErr'])){
    echo $twig->render('register.twig', array('registerErr' => $_SESSION['registerErr']));
}else{
    echo $twig->render('register.twig');
}



