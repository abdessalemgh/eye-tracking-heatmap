<?php

//Start session.
session_start();

//Get username from session.
$username = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

//Get action.
$action = isset( $_GET['action'] ) ? $_GET['action'] : "dashboard";

if ( (!$username || empty($_SESSION))  && !in_array($action, array("register","login"))) {
    //@TODO: Redirect to login page.
    header('Location: index.php?action=login');
}
?>