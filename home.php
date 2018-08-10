<?php
    include_once('config/init.php');
    include ('database/condition.php');
    include ('templates/header.php');
    $conditions = getAllConditions();
    include ('templates/nav.php');
    include ('templates/calendar.php');
    include ('templates/home.php');
    //include ('templates/chat.php');
	include ('templates/footer.php');
?>
