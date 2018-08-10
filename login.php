<?php
	include_once('config/init.php');
    include ('templates/header.php');
    if (isset($_SESSION['username'])) {
		$_SESSION['message'] = "You are already logged in!";
		die(header('Location: home.php'));
	}
	include ('templates/login.php');
	//include ('templates/footer.php');
?>