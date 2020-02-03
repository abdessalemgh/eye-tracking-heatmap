<?php
ini_set( "display_errors", true );
define( "DB_DSN", "mysql:host=localhost;dbname=eye" );
define( "DB_USERNAME", "abs" );
define( "DB_PASSWORD", "root" );
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "MODELS_PATH", "models" );

function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please try later.";
  var_dump( $exception->getMessage() );
}

//Connect to dataBase.
$conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
set_exception_handler( 'handleException' );
?>