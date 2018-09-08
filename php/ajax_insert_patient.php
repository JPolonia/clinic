<?php
include_once('../config/init.php');
include_once('../database/processos.php');

$data = $_POST;

//Create new patient
$id_paciente = addNewPatient($data['nome'], $data['data_nasc'], $data['estado_civil'], $data['morada'], $data['sns']);

//Create new rastreio
if (isset($data['checkRastreio'])) {
    $id_rastreio = addNewRastreio($data['n_conc_volta'], $data['data_rastreio'], $data['data_afericao']);
}


//Create new processo
$id_processo = addNewProcess($id_paciente, $id_rastreio, $data['data_1c'], $data['localizacaoSelectMamaD'], $data['localizacaoSelectMamaE']);

//Create new biopsias
$id_biopsia = addNewBiopsia($data['data_biopsia'], $id_processo, $data['id_bio_mama_drt'], $data['id_bio_mama_esq'], $data['id_bio_axila_drt'], $data['id_bio_axila_esq'], $data['resultado_mama_drt'], $data['resultado_mama_esq'], $data['resultado_axila_drt'], $data['resultado_axila_esq'], 1);

/*$data = array();

$data['localList'] = fetchLocal();
$data['bioList'] = fetchBio();

$data['processo'] = getProcessById($id);
$data['images'] = getImagesById($id);
$data['biopsias'] = getBiopsiasById($id);*/

echo json_encode($id_biopsia);
?>