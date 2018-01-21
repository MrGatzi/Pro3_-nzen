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
    if (isset($_SESSION['pwdChange'])){
        echo $twig->render('portfolio.twig', array('username' => $_SESSION['username'],'tUserDaten' => $tUserDaten,'tCryptoDaten'=>$tCryptoDaten,'tUsdDaten'=>$tUsdDaten, 'error'=>$_SESSION['pwdChange']));
        unset($_SESSION['pwdChange']);
        exit();


    }else{
        echo $twig->render('portfolio.twig', array('username' => $_SESSION['username'],'tUserDaten' => $tUserDaten,'tCryptoDaten'=>$tCryptoDaten,'tUsdDaten'=>$tUsdDaten));
    }
}else {

    //opens the login window if there is a login error
    if (isset($_SESSION['error']) && $_SESSION['error'] === true){

        echo $twig->render('index.twig', array('error' => true));

        // reopens the login dialogue after the failed login attempt
        echo '<script>
              $(document).ready(function(){ 
        $(\'#loginForm\').removeAttr(\'class\').addClass(\'log\');
        $(\'body\').addClass(\'login-active\');
        $(\'main\').addClass(\'login-active\');
              });
               </script>';

        $_SESSION['error'] = false;

        //opens the login window when the user is coming from the register
    }else if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'register.php') !== false){

        echo $twig->render('index.twig', array('error' => false));

        // reopens the login dialogue after the failed login attempt
        echo '<script>
              $(document).ready(function(){ 
        $(\'#loginForm\').removeAttr(\'class\').addClass(\'log\');
        $(\'body\').addClass(\'login-active\');
        $(\'main\').addClass(\'login-active\');
              });
               </script>';

    }else{
        echo $twig->render('index.twig', array('error' => false));
    }
}

