<?php

require 'vendor/autoload.php';

//twig loader
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo $twig->render('portfolio.twig', array('username' => $_SESSION['username']));
} else{
    echo $twig->render('index.twig');
}






