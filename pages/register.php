<?php

require("models/User.php");
if (isset($_POST['submit'])) {
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $nom = !empty($_POST['nom']) ? trim($_POST['nom']) : null;
    $prenom = !empty($_POST['prenom']) ? trim($_POST['prenom']) : null;
    $pass = !empty($_POST['pass']) ? trim($_POST['pass']) : null;
    $age = !empty($_POST['age']) ? trim($_POST['age']) : null;
    $sql = "SELECT COUNT(nom) AS num FROM users WHERE nom = :nom";
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':nom', $nom);

    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['num'] > 0) {
        die('That username already exists!');
    }
    $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
    $user_data = array("nom" => $nom, "prenom" => $prenom, "age" => $age, "pass" => $passwordHash);
    $user = new User($user_data);
    $id = $user->insert();
    if ($id != null) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['logged_in'] = time();
        header('Location: index.php');
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
            <form action="" method="POST">
                <div class="login-form-head">
                    <h4>Sign up</h4>
                    <p>Hello there, Sign up and Join with Us</p>
                </div>
                <div class="login-form-body">
                    <div class="form-gp">
                        <label for="exampleInputName1">User Name</label>
                        <input type="text" id="nom" name="nom">
                        <i class="ti-user"></i>
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-gp">
                        <label for="exampleInputEmail1">Prénom</label>
                        <input type="text" id="prenom" name="prenom">
                        <i class="ti-user"></i>
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-gp">
                        <label for="exampleInputEmail1">Age</label>
                        <input type="text" id="age" name="age">
                        <i class="ti-user"></i>
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-gp">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" id="password" name="password">
                        <i class="ti-lock"></i>
                        <div class="text-danger"></div>
                    </div>

                    <div class="submit-btn-area">
                        <button id="submit" type="submit" name="submit" value="submit">Submit <i
                                    class="ti-arrow-right"></i></button>
                    </div>
                    <div class="form-footer text-center mt-5">
                        <p class="text-muted">Don't have an account? <a href="login.php">Sign in</a></p>
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
<!-- register area end -->

<?php
//Include template js.
include("templates/template_js.php")
?>

</body>
</html>
