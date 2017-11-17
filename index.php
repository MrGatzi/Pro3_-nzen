<?php

require 'vendor/autoload.php';
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader);
    //get UserDaten !
    //get CryptoDaten !
    //get UsdDaten !

    //testdaten
    $tUserDaten = [
        0 => array(
            "symbol" => 'BTC',
            "value" => 0.1
        ),
        1 => array(
            "symbol" => 'LTC',
            "value" => 2
        ),
        2 => array(
            "symbol" => 'DOGE',
            "value" => 4
        ),
    ];
    $tCryptoDaten = [
        "BTC" => array(
            "symbol" => 'BTC',
            "value" => 1000
        ),
        "LTC" => array(
            "symbol" => 'LTC',
            "value" => 60
        ),
        "DOGE" => array(
            "symbol" => 'DOGE',
            "value" => 0.01
        ),
    ];
    $tUsdDaten = [
        "USD" => array(
            "value" => 1
        ),
        "EUR" => array(
            "value" => 0.88
        ),
    ];

    echo $twig->render('portfolio.twig', array('username' => $_SESSION['user'],'tUserDaten' => $tUserDaten,'tCryptoDaten'=>$tCryptoDaten,'tUsdDaten'=>$tUsdDaten));
}else {

    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader);


    echo $twig->render('index.twig');
}

