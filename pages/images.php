<?php
require("models/Image.php");
//List Saved images
$list = Image::getAllImages();


if (isset($_POST['submit']) && !empty($_FILES["fileToUpload"]["name"])) {

    //get image name.
    $imgName = !empty($_POST['imgName']) ? ($_POST['imgName']) : null;
    //target folder where images will be saved
    $targetDir = "uploads/";
    // allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    //specify file name, target path
    $fileName = basename($_FILES["fileToUpload"]["name"]);
    $targetFilePath = $targetDir . date("Y_m_d") ."_" .$fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    //check if file extension is valid
    if(in_array($fileType, $allowTypes)) {
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {
            //upload image
            
            $img_data = array("imagePath" => $targetFilePath, "imageName" => $imgName);
            $image = new Image($img_data);
            $id = $image->insert();
            if ($id != null) {
                var_dump($id);
                header("Refresh:0");
            }
        }
    }else{
        die("file type is not supported");
    }
}




//Include template header.
include("templates/template_header.php");

?>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <div class="page-container">
        <?php
        include('templates/template_menu.php');
        ?>
        <div class="main-content">
            <!-- header area start -->
            <?php include "templates/include/header.php" ?>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Images</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><span>Tout les Images</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <!-- Image form start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-5 mt-5">
                                        <label for="example-text-input" class="col-form-label">Nom de l'image</label>
                                        <input class="form-control" type="text" placeholder="Nom de l'image" value="" id="example-text-input" name="imgName">
                                    </div>
                                    <div class="col-5 mt-5">
                                    </div>
                                    <div class="col-3 mt-5">
                                        <div class="custom-file">
                                            <label for="example-text-input" class="col-form-label">Text</label>
                                            <input type="file" class="custom-file-input" id="inputGroupFile02" name="fileToUpload" id="fileToUpload">
                                            <label class="custom-file-label" for="inputGroupFile02">Choose file</label>

                                        </div>

                                    </div>
                                    <div class="col-3 mt-5">
                                        <button id="submit" type="submit" name="submit" class="btn btn-primary " value="Submit">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- Image form end -->
                <!-- data table start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Les Images</h4>
                            <div class="data-tables">
                                <table id="imagesTable" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th>Nom Image</th>
                                            <th>Path Image</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($list as $image) {
                                            $row = "<tr>";
                                            $row .= "<td>" . $image['imageName'] . "</td>";
                                            $row .= "<td>" . $image['imagePath'] . "</td>";
                                            $row .= "<td>-</td>";
                                            $row .= "</tr>";

                                            echo $row;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- data table end -->
            </div>
        </div>

        <!-- main content area end -->
        <!-- footer area start-->
        <?php include "templates/include/footer.php" ?>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->

    <?php
    //Include template js.
    include("templates/template_js.php")
    ?>

    <script>
        $(function() {
            $('#imagesTable').DataTable();
        });
    </script>
</body>

</html>