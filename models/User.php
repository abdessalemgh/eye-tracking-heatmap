<?php
class User
{

  public $id = null;
  public $nom = null;
  public $prenom = null;
  public $age = null;

  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['age'] ) ) $this->userId = (int) $data['age'];
    if ( isset( $data['nom'] ) ) $this->nom = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['nom'] );
    if ( isset( $data['prenom'] ) ) $this->prenom = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['prenom'] );
  }


  public static function getById( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM users WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new User( $row );
  }

  public static function getAllUsers() {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM users ";
    $row = $st->fetch();
    $conn = null;
    while ( $row = $st->fetch() ) {
      $user = new User( $row );
      $list[] = $user;
    }

    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }

  public function insert() {
    if ( !is_null( $this->id ) ) trigger_error ( "Id Exists", E_USER_ERROR );

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO users ( nom, prenom, age) VALUES ( :nom, :prenom, :age)";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":nom", $this->nom, PDO::PARAM_STR, 30);
    $st->bindValue( ":prenom", $this->prenom, PDO::PARAM_STR, 30);
    $st->bindValue( ":age", $this->age, PDO::PARAM_INT);
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }


  public function delete() {

    if ( is_null( $this->id ) ) trigger_error ( "Id does not Exists", E_USER_ERROR );


    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM users WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

}

?>