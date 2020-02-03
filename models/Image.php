<?php
class Image
{

  public $id = null;
  public $imagePath = null;
  public $imageName = null;

  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['imagePath'] ) ) $this->imagePath = $data['imagePath'];
    if ( isset( $data['imageName'] ) ) $this->imageName = $data['imageName'];
  }


  public static function getById( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM images WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new Image( $row );
  }

  public static function getAllImages() {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM images ";
    $st = $conn->prepare( $sql );
    $st->execute() or die(print_r($st->errorInfo(), true));
    $imgs = $st->fetchAll(); 
    return $imgs;
  }

  public function insert() {
    if ( !is_null( $this->id ) ) trigger_error ( "Id Exists", E_USER_ERROR );

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO images (imagePath, imageName) VALUES ( :imagePath, :imageName)";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":imagePath", $this->imagePath);
    $st->bindValue(':imageName', $this->imageName);
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }


  public function delete() {

    if ( is_null( $this->id ) ) trigger_error ( "Id does not Exists", E_USER_ERROR );


    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM images WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

}

?>