<?php
include_once('../config/init.php');
include_once('../database/processos.php');

$id = $_REQUEST['id'];

$data = array();

$data['localList'] = fetchLocal();
$data['bioList'] = fetchBio();

$data['processo'] = getProcessById($id);
$data['images'] = getImagesById($id);
$data['biopsias'] = getBiopsiasById($id);

echo json_encode($data);
?>