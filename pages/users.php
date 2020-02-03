<?php

include "models/User.php";

//Prepare page data.
$pageData['page-title'] = "Les utilisateurs";
$pageData['breadcrumbs'][] = array("link"=>"index.php?action=users", "title"=> "tous les utilisateurs");


//If showing only one user.
if(isset($_GET['user'])){
    $user = User::getById($_GET['user']);
    //add show user breadcrumbs title to page data.
    $pageData['breadcrumbs'][] = array("title"=> $user->nom);
}else{
    list($users, $totalOfUsers) = User::getAllUsers();
}
//Include template header.
include("templates/template_header.php");

?>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<!-- preloader area start -->
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
        <?php include "templates/include/header.php"; ?>
        <!-- header area end -->
        <!-- page title area start -->
        <?php include "templates/include/header_breadcrumbs.php"; ?>
        <!-- page title area end -->
        <div class="main-content-inner">
            <!-- data table start -->
            <?php
                if(isset($_GET['user']))
                    include "pages/includes/user_show.php";
                else
                    include "pages/includes/users_datatable.php"
            ?>
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
    $(function () {
        $('#usersTable').DataTable();
    });
</script>
</body>
</html>
