<?php
session_start();
require 'vendor/autoload.php';

//twig init
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo $twig->render('portfolio.twig', array('username' => $_SESSION['username'],'tUserDaten' => $tUserDaten,'tCryptoDaten'=>$tCryptoDaten,'tUsdDaten'=>$tUsdDaten));
}

else if(isset($_SESSION['registerErr'])){
    echo $twig->render('register.twig', array('error' => $_SESSION['registerErr']));
}else{
    echo $twig->render('register.twig');
}



