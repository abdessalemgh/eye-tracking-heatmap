<?php

//Required config parameters.
require("parameters/config.php");

//Session checker.
require("parameters/session.php");

switch ($action) {
    case 'login':
        include ('pages/login.php');
        break;
    case 'register':
        include ('pages/register.php');
        break;
    case 'logout':
        die("logout page");
        break;
    case 'home':
        die("home page");
        break;
    default:
        include ('pages/main.php');
        break;
}



function logout()
{
    unset($_SESSION['user_id']);
    header("Location: index.php");
}

?>