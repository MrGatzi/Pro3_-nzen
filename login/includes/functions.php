<?php
//Class Autoloader
spl_autoload_register(function ($className) {

    $className = strtolower($className);
    $path = "includes/{$className}.php";

    if (file_exists($path)) {

        require_once($path);

    } else {

        die("The file {$className}.php could not be found.");

    }
});

function mySqlErrors($response)
{
    //custom error messages
    switch (substr($response, 0, 22)) {

        case 'Error: SQLSTATE[23000]':
            echo "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Username or email already exists</div>";
            break;

        default:
            echo "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>An error occurred... try again</div>";

    }
};