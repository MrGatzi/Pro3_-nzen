<?php

require 'vendor/autoload.php';
require 'lib/dataBaseCon.php';
require 'lib/apiCon.php';

//twig init
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { //if the user is already logged in


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
    $tUsdDaten = json_decode(getUSD(),true);
  /*  $tUsdDaten = [
        "USD" => 1,
        "EUR" => 10.88,
    ];*/
    echo $twig->render('portfolio.twig', array('username' => $_SESSION['user'],'tUserDaten' => $tUserDaten,'tCryptoDaten'=>$tCryptoDaten,'tUsdDaten'=>$tUsdDaten));
}else {

    if (isset($_SESSION['error']) && $_SESSION['error'] === true){

        echo $twig->render('index.twig', array('error' => true));

        // reopens the login dialogue after the failed login attempt
        echo '<script>
              $(document).ready(function(){ 
                $(\'#loginForm\').removeAttr(\'class\').addClass(\'log\');
                $(\'body\').addClass(\'login-active\');
              });
               </script>';
        $_SESSION['error'] = false;

    }else {
        echo $twig->render('index.twig', array('error' => false));
    }

}

