<?php

require 'vendor/autoload.php';
require 'lib/dataBaseCon.php';
require 'lib/apiCon.php';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader);

    //get UserDaten !
    $tUserDaten = json_decode(getUserCoins(),true);
    /* $tUserDaten = [
        0 => array(
            "symbol" => 'BTC',
            "value" => 0.1
        ),
        1 => array(
            "symbol" => 'LTC',
            "value" => 2
        ),
    ];*/
    //get CryptoDaten !
    $tCryptoDaten = json_decode(getCrypto(),true);
    /*$tCryptoDaten = [
        0 => array(
            "symbol" => 'BTC',
            "value" => 1000
        ),
        1 => array(
            "symbol" => 'LTC',
            "value" => 60
        ),
    ];*/
    //get UsdDaten !
    //$tUsdDaten = json_decode(getUSD(),true);
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

