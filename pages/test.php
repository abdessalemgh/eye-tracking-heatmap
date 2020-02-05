<?php
//Include template header.
include("templates/template_header.php");
require("models/User.php");
require("models/UserCheckedImage.php");
//Prepare page data.
$pageData['page-title'] = "Tests ";
$pageData['breadcrumbs'][] = array("link" => "index.php?action=test", "title" => "toutes les tests");
//Get all users to list.
$list = User::getAllUsers();
if (isset($_POST['submit'])) {

    $userid = $_POST['userSelect'];
    $data = new UserCheckedImage(array('userId' => $userid, 'imageId' => $_POST['imgSelect'],));
    $data->insert("0000");

}
?>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <?php
        include('templates/template_menu.php');
        ?>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <?php include "templates/include/header.php" ?>
            <!-- header area end -->
            <!-- page title area start -->
            <?php include "templates/include/header_breadcrumbs.php"; ?>

            <!-- page title area end -->
            <div class="main-content-inner">
            <form method="POST" action="">
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <label class="col-form-label">Sujet</label>
                            <select class="custom-select" id="userselect" name="userSelect">
                                <option selected="selected" value="sujet">Sujet</option>
                                <?php
                                foreach ($list as $user) {
                                    $row = "<option value='" . $user['id'] . "'>" . $user['nom'] . " " . $user['prenom'] . "</option>";
                                    var_dump($row);
                                    echo $row;
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <label class="col-form-label">Image</label>
                            <select class="custom-select" id="imgsperuser" name="imgSelect">
                                <option selected="selected">Image</option>


                            </select>
                            <div class=" mt-5">
                                <button id="submit" type="submit" name="submit" class="btn btn-primary " value="Submit">Assigner</button>
                            </div>
                        </div>
                    </div>
                </div>

            
            
            
            
            </form>
        </div>
                           
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <?php include "templates/include/footer.php" ?>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->

    <!-- login area end -->

    <?php
    //Include template js.
    include("templates/template_js.php")
    ?>
    <script>
        $(function(){ 
        $('#userselect').on('change', function() {
            if( $('#userselect').val != "sujet") {   
            $.ajax({method: "GET", url:"pages/imagereq.php", datatype: 'JSON', data:{"userId" : $('#userselect').children("option:selected").val()},})
            .success(function(data) {
                $('#imgsperuser').children('option:not(:first)').remove();
                var result= $.parseJSON(data);  
                console.log(result);
                var len = data.length;
               $.each( result, function( key, value ){

                    $('#imgsperuser').append(new Option(value['imageName'], value['id'])); 
                })
            })
            .error(function(xhr) {
                alert("error");
            })
            
            
        }
        });
    });
    </script>
</body>

</html>