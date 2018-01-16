<?php
session_start();
require 'vendor/autoload.php';

if (isset($_SESSION['email'])) {
    session_start();
    session_destroy();
}



$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);

echo $twig->render('register.twig');

