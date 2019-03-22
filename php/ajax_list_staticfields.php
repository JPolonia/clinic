<?php
include_once('../config/init.php');
include_once('../database/processos.php');

$data = array();

$data['localList'] = fetchLocal();
//$data['bioList'] = fetchBio();

echo json_encode($data);
?>