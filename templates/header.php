<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Clinic - BC Records</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css\style.css">
		<link rel="stylesheet" href="css\bootstrap.css">
		<link rel="stylesheet" href="css\bootstrap-table.css">
		<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->		
		<script src="chat.js" defer></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<!--<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script> old version?? 
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
		<script src="js\bootstrap.bundle.js" ></script>
		<script src="js\bootstrap-table.js" ></script>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/data.js"></script>
		<script src="main.js"></script>
	</head>
	<body>

<?php
	//Return to login page if user is not authenticated!
	if (!isset($_SESSION['username']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
		die(header('Location: login.php'));
	}
?>
