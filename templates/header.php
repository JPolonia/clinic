<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Clinic - BC Records</title>
		<meta charset="utf-8">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css\style.css">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		
		<?php 
	switch (basename($_SERVER['PHP_SELF'])) {
		case "chat.php":
		case "home.php":
			echo '<script src="js\chat.js" defer></script>';
			break;
		case "bc_record.php":
			echo '<link rel="stylesheet" href="css\bootstrap.css">';
			echo '<link rel="stylesheet" href="css\bootstrap-table.css">';
					//echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>';
			echo '<script src="js\bootstrap.bundle.js" ></script>';
			echo '<script src="js\bootstrap-table.js" ></script>';
			echo '<script src="js\bcrecord.js?3" defer></script>';
			break;
		default:
	}
	?>
		
		<script src="main.js" defer></script>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/data.js"></script>
		
	</head>
	<body>

<?php
	//Return to login page if user is not authenticated!
if (!isset($_SESSION['username']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
	die(header('Location: login.php'));
}
?>
