<?php
    include_once('../config/init.php');
    include_once('../database/paciente.php');
    
    $id = $_REQUEST['id'];
    $patient = getPatientById($id);

    echo json_encode($patient);
?>