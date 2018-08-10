<?php
    include_once('../config/init.php');
    include_once('../database/paciente.php');
    $patients = getAllPatients(); 
    echo json_encode($patients);
?>