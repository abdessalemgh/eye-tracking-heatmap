<?php
require("../models/UserCheckedImage.php");
require("../parameters/config.php");
//Select images not yet viewed by users
$list = UserCheckedImage::getImagesPerUser($_GET['userId']);
echo json_encode($list);

?>