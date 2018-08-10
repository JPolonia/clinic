<?php
    include_once('config/init.php');
    include ('database/patient.php');
    $patients = getAllPatients();
    include ('templates/header.php');
    include ('templates/nav.php');
    include ('templates/calendar.php');
    include ('templates/list_appointments.php');
	include ('templates/footer.php');
?>