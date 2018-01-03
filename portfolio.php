<?php

require 'vendor/autoload.php';
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader);

    echo $twig->render('portfolio.twig');

}

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);

echo $twig->render('index.twig');


