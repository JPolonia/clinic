<?php
include_once('../config/init.php');
include_once('../database/processos.php');
$patients = getAllPatients();
echo json_encode($patients);
?>