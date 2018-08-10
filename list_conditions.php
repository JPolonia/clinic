<?php
    include_once('config/init.php');
    include ('database/condition.php');
    $conditions = getAllConditions();
    include ('templates/header.php');
    include ('templates/nav.php');
    include ('templates/list_conditions.php');
	include ('templates/footer.php');
?>
