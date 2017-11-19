<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 19.11.2017
 * Time: 01:34
 */
if($_SERVER['REQUEST_METHOD'] == "POST" ) {
    header('HTTP/1.1 200 OK');
    //$message = $_POST["data"];
    //$json = $_POST['data'];
    echo $_POST["data"][0]["symbol"];
}
function safeValues()
{
    //php
}