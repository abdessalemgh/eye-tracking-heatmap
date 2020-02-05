<?php
class UserCheckedImage
{

  public $id = null;
  public $userId = null;
  public $imageId = null;
  public $heatdata = null;
  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['userId'] ) ) $this->userId = (int) $data['userId'];
    if ( isset( $data['imageId'] ) ) $this->imageId = (int) $data['imageId'];
    if ( isset( $data['heatdata'] ) ) $this->heatdata = $data['heatdata'];
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
    $sql = "SELECT * FROM images WHERE id NOT IN (SELECT imageId FROM userscheckedimages WHERE userId = :userId)";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":userId", $userId, PDO::PARAM_INT );
    $st->execute();
    $list = $st->fetchAll(PDO::FETCH_ASSOC);
    return $list;

  }

  public function insert($heatdata) {
    if ( !is_null( $this->id ) ) trigger_error ( "Id Exists", E_USER_ERROR );
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO userscheckedimages ( userId, imageId, heatData) VALUES ( :userId, :imageId, :heatdata)";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":userId", $this->userId, PDO::PARAM_INT );
    $st->bindValue( ":imageId", $this->imageId, PDO::PARAM_INT );
    $st->bindValue( ":heatdata", $heatdata, PDO::PARAM_STR);
    $st->execute() or die((print_r($st->errorInfo(), true)));
    $this->id = $conn->lastInsertId();
    $this->heatdata = $heatdata;
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