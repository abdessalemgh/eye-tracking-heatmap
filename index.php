<?php

require( "config.php" );
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : "";

if ( $action != "login" && $action != "logout" && !$username ) {
  login();
  exit;
}

switch ( $action ) {
  case 'login':
    login();
    break;
  case 'logout':
    logout();
    break;
  case 'home':
    Home();
    break;
  default:
    Home();
    break;
}


function login() {

  $results = array();
  if ( isset( $_POST['login'] ) ) {
      
      $results['errorMessage'] = "Incorrect username or password. Please try again.";
      header( "Location: /heatmap/templates/login.php" );
    

  } else {

    header( "Location: /heatmap/templates/login.php" );
  }

}


function logout() {
  unset( $_SESSION['user_id'] );
  header( "Location: index.php" );
}

function homepage() {
    require( TEMPLATE_PATH . "/main.php" );
  }

?>