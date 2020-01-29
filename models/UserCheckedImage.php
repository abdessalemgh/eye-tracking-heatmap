<?php
class UserCheckedImage
{

  public $id = null;
  public $userId = null;
  public $imageId = null;

  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['userId'] ) ) $this->userId = (int) $data['userId'];
    if ( isset( $data['imageId'] ) ) $this->imageId = (int) $data['imageId'];
  }


  public static function getById( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM userscheckedimages WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new UserCheckedImage( $row );
  }

  public static function getImagesPerUser( $userId ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM images WHERE id IN (SELECT imageId FROM userscheckedimages WHERE userId = :userId)";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":userId", $userId, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    while ( $row = $st->fetch() ) {
      $image = new Image( $row );
      $list[] = $image;
    }

    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }

  public function insert() {
    if ( !is_null( $this->id ) ) trigger_error ( "Id Exists", E_USER_ERROR );

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO userscheckedimages ( userId, imageId) VALUES ( :userId, :imageId)";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":userId", $this->userId, PDO::PARAM_INT );
    $st->bindValue( ":imageId", $this->imageId, PDO::PARAM_INT );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }


  public function delete() {

    if ( is_null( $this->id ) ) trigger_error ( "Id does not Exists", E_USER_ERROR );


    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM userscheckedimages WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

}

?>