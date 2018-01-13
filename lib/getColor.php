<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 13.01.2018
 * Time: 14:08
 */
if(isset($_POST['json'])) {
    $directions = json_decode($_POST['json']);
    mt_srand(450);
    $res = [];
    // array_push($res, random_color());
    for ($i = 1; $i <= $directions; $i++) {
        array_push($res, "#".random_color());
    }
    echo json_encode($res);
} else {
    echo "Noooooooo";
}

function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}