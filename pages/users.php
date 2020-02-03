<?php

//get user login name.
$nom = !empty($_POST['nom']) ? trim($_POST['nom']) : null;

//get user login password.
$passwordAttempt = !empty($_POST['pass']) ? trim($_POST['pass']) : null;


$sql = "SELECT * FROM users";
$stmt = $conn->prepare($sql);

$stmt->execute() or die(print_r($stmt->errorInfo(), true));

$users = $stmt->fetchAll();

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
                        <h4 class="page-title pull-left">Utilisateurs</h4>
                        <ul class="breadcrumbs pull-left">
                            <li><span>tous les utilisateurs</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- page title area end -->
        <div class="main-content-inner">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Les sujets</h4>
                        <div class="data-tables">
                            <table id="usersTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>Nom</th>
                                    <th>prénom</th>
                                    <th>Age</th>
                                    <th>Téle</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($users as $user) {
                                    $row = "<tr>";
                                    $row .= "<td>" . $user['nom'] . "</td>";
                                    $row .= "<td>" . $user['prenom'] . "</td>";
                                    $row .= "<td>" . $user['age'] . "</td>";
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
    $(function () {
        $('#usersTable').DataTable();
    });
</script>
</body>
</html>
