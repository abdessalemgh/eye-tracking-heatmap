<?php


if ( ! empty( $_POST ) ) {
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "heatmap";
    session_start();
    if ( isset( $_POST['email'] ) && isset( $_POST['password'] ) ) {

        $con = new mysqli($db_host, $db_user, $db_pass, $db_name);
        $stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $result = $stmt->get_result();
    	$user = $result->fetch_object();
    	echo("logged in");
    	// Verify user password and set $_SESSION
    	if ( password_verify( $_POST['password'], $user->password ) ) {
    		$_SESSION['user_id'] = $user->ID;
    	}
    }
}
?>