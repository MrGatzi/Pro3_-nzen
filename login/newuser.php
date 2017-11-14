<?php
require_once 'includes/functions.php';
include_once 'config.php';

$newuser = $_POST['email'];
$newpw = password_hash($_POST['password'], PASSWORD_DEFAULT);
$pw1 = $_POST['password'];
$pw2 = $_POST['confirmPassword'];


if ($pw1 != $pw2) {
//if passwords do not match
    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password fields must match</div><div id="returnVal" style="display:none;">false</div>';

} elseif (strlen($pw1) < 4) {
//if password is too short
    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password must be at least 4 characters</div><div id="returnVal" style="display:none;">false</div>';

} elseif (!filter_var($newuser, FILTER_VALIDATE_EMAIL) == true) {

    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Must provide a valid email address</div><div id="returnVal" style="display:none;">false</div>';

} else {

    if (isset($_POST['email']) && !empty(str_replace(' ', '', $_POST['email'])) && isset($_POST['password']) && !empty(str_replace(' ', '', $_POST['password']))) {

        //Tries inserting into database and add response to variable

        $a = new NewUserForm;

        $response = $a->createUser($newuser, $newpw);

        //Success
        if ($response == 'true') {

            echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'. $signupthanks .'</div><div id="returnVal" style="display:none;">true</div>';

        } else {
            //Failure
            mySqlErrors($response);

        }
    } else {

        echo 'An error occurred on the form... try again';
    }
};