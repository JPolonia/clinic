<?php
include_once('../config/init.php');
include_once('../database/processos.php');

$data = $_POST;

//Create new patient
$id_paciente = addNewPatient($data['nome'], $data['data_nasc'], $data['estado_civil'], $data['morada'], $data['sns']);

//Create new processo
$id_processo = addNewProcess($data['n_processo'],$id_paciente, $id_rastreio, $data['data_rastreio'], $data['data_afericao'], 
    $data['data_1c'], $data['localizacaoSelectMamaD'], $data['localizacaoSelectMamaE'],
    $data['rx_pulmonar'],$data['eco_abdominal'],$data['cing_ossea'],$data['tac_torax'],$data['tac_abdominal'],$data['tac_pelvico'],
    $data['ea_total'],$data['ea_invadidos'],$data['metastases'],$data['sn_total'],$data['sn_extemp'],$data['estadio']);


$i=1;
while (isset($data['data_biopsia' + $i])){
    //Create new biopsias
    $id_biopsia = addNewBiopsia($data['data_biopsia' + $i], $id_processo, 
        $data['tipoBiopsiaSelectMamaDta' + $i], $data['tipoBiopsiaSelectMamaEsq' + $i], $data['tipoBiopsiaSelectAxilaDta' + $i], $data['tipoBiopsiaSelectAxilaEsq' + $i], 
        $data['resultadoSelectMamaDta' + $i], $data['resultadoSelectMamaEsq' + $i], $data['resultadoSelectAxilaDta' + $i], $data['resultadoSelectAxilaEsq' + $i], 
        $i,$data['formaBiopsiaSelectMamaDta' + $i],$data['formaBiopsiaSelectMamaEsq'+$i]);
    
    $i++;
}


$i=1;
while (isset($data['data_cirurgia' + $i])){
    //Create new cirurgia
    $id_cirurgia = addNewCirurgia($id_processo,$i,$data['data_cirurgia'+$i],$data['lic'+$i],
        $data['tecnicaCirSelectAxilaDta'+$i],$data['tecnicaCirSelectMamaDta'+$i],$data['tecnicaCirSelectAxilaEsq'+$i],$data['tecnicaCirSelectMamaEsq'+$i],
        $data['reconstrucaoCirSelectMamaDta'],$data['reconstrucaoCirSelectMamaEsq']);
    $i++;
}

//Create new tumor
$id_tumor = addNewTumor($id_processo,$data['tamanho'],$data['grau'],$data['re'],$data['rp'],$data['ki67'],$data['her2'],$data['margem'],$data['tipo_histologico']);

//Create new image
$id_imagem = addNewImagem($id_processo,$data['tipo_imagem'],$data['url_imagem'],$data['bi_rads']);

//Create new terapia
$id_terapia = addNewTerapia($id_processo,$data['nome'],$data['tipo_terapia'],$data['data_inicio'],$data['data_fim']);

$output = [
    "id_paciente" => $id_paciente,
    "id_processo" => $id_processo,
    "id_biopsia" => $id_biopsia,
    "id_cirurgia" => $id_cirurgia,
    "id_tumor" => $id_tumor,
    "id_imagem" => $id_imagem,
    "id_terapia" => $id_terapia
];

echo json_encode($output);
?>