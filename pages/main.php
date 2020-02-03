<?php
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
        <?php include "templates/include/header.php" ?>
        <!-- header area end -->
        <!-- page title area start -->
        <div class="page-title-area">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="breadcrumbs-area clearfix">
                        <h4 class="page-title pull-left">Dashboard</h4>
                        <ul class="breadcrumbs pull-left">
                            <li><span>Dashboard</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- page title area end -->
        <div class="main-content-inner">
            <!-- sales report area start -->

            <!-- sales report area end -->
            <!-- overview area start -->

            <!-- overview area end -->
            <!-- market value area start -->

            <!-- market value area end -->
            <!-- row area start -->

            <!-- row area start-->
        </div>
    </div>
    <!-- main content area end -->
    <!-- footer area start-->
    <?php include "templates/include/footer.php" ?>
    <!-- footer area end-->
</div>
<!-- page container area end -->
<?php
//Include template footer.
include "templates/include/footer.php"
?>
<!-- login area end -->

<?php
//Include template js.
include("templates/template_js.php")
?>
</body>
</html>