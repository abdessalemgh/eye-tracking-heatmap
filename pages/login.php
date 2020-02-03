<?php

if (isset($_POST['submit'])) {


    //get user login name.
    $nom = !empty($_POST['nom']) ? trim($_POST['nom']) : null;
    //get user login password.
    $passwordAttempt = !empty($_POST['pass']) ? trim($_POST['pass']) : null;
    $sql = "SELECT id, nom, pass FROM users WHERE nom = :nom";
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':nom', $nom);

    $stmt->execute() or die(print_r($stmt->errorInfo(), true));

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user === false) {

        die('Incorrect username / password combination!');
    } else {

        $validPassword = password_verify($passwordAttempt, $user['pass']);

        if ($validPassword) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = time();

            header('Location: main.php');
            exit;

        } else {

            die('Incorrect username / password combination!');
        }
    }

}

?>

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
<!-- login area start -->
<div class="login-area">
    <div class="container">
        <div class="login-box ptb--100">
            <form action="login.php" method="POST">
                <div class="login-form-head">
                    <h4>Sign In</h4>

                </div>
                <div class="login-form-body">
                    <div class="form-gp">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" id="nom" name="nom">
                        <i class="ti-email"></i>
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-gp">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" id="pass" name="pass">
                        <i class="ti-lock"></i>
                        <div class="text-danger"></div>
                    </div>
                    <div class="row mb-4 rmber-area">
                        <div class="col-6">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <a href="#">Forgot Password?</a>
                        </div>
                    </div>
                    <div class="submit-btn-area">
                        <button id="form_submit" type="submit" name="submit">Submit <i class="ti-arrow-right"></i>
                        </button>

                    </div>
                    <div class="form-footer text-center mt-5">
                        <p class="text-muted">Don't have an account? <a href="/heatmap/templates/register.php">Sign
                                up</a></p>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <?php
        //Include template footer.
        include "templates/include/footer.php"
    ?>
</div>
<!-- login area end -->


</body>

<?php
    //Include template js.
    include("templates/template_js.php")
?>
