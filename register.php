<?php
session_start();

if (isset($_SESSION['email'])) {
    session_start();
    session_destroy();
}

require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);

echo $twig->render('register.twig');
?>
