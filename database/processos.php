<?php
function getAllPatients()
{
    global $conn;

    $stmt = $conn->prepare('SELECT id_processo, n_proc, nome, data_nasc, sns, contacto
                                FROM BCRECORD.db_processos 
                                JOIN  BCRECORD.db_pacientes
                                USING (id_paciente)
                                WHERE activo = 1
                                ORDER BY nome');
    $stmt->execute();
    return $stmt->fetchAll();
}

function fetchLocal()
{
    global $conn;

    $stmt = $conn->prepare('SELECT id_local, abreviatura,nome, cord_x, cord_y
                                FROM BCRECORD.st_localizacao
                                ORDER BY id_local');
    $stmt->execute();

    return $stmt->fetchAll();
}

function fetchBio()
{
    global $conn;

    $stmt = $conn->prepare('SELECT id_bio, local, tecnica, tipo
                                FROM BCRECORD.st_biopsia
                                ORDER BY id_bio');
    $stmt->execute();

    return $stmt->fetchAll();
}

function getProcessById($id)
{
    global $conn;

    $stmt = $conn->prepare('SELECT  id_processo, n_proc, nome, data_nasc, sns, contacto,morada,estado_civil,data_1c,
                                    id_rastreio, n_conc_volta, data_rastreio, data_afericao, /*Rastreio*/
                                    id_local_drt, id_local_esq /*Localizacao*/
                                FROM BCRECORD.db_processos 
                                JOIN  BCRECORD.db_pacientes USING (id_paciente)
                                LEFT JOIN  BCRECORD.db_rastreios USING (id_rastreio)
                                WHERE id_processo = ?');
    $stmt->execute(array($id));
    return $stmt->fetch();
}

function getImagesById($id)
{
    global $conn;

    $stmt = $conn->prepare('SELECT  id_imagem, tipo_imagem, url_imagem, bi_rads, img_activo
                                FROM BCRECORD.db_imagens 
                                JOIN BCRECORD.db_processos USING (id_processo)
                                WHERE id_processo = ?');
    $stmt->execute(array($id));
    return $stmt->fetchAll();
}

function getBiopsiasById($id)
{
    global $conn;

    $stmt = $conn->prepare('SELECT  id_biopsia, data_biopsia, id_bio_mama_drt, id_bio_mama_esq, id_bio_axila_drt, id_bio_axila_esq,
                                    resultado_mama_drt, resultado_mama_esq,resultado_axila_drt, resultado_axila_esq, n_biopsia
                                FROM BCRECORD.db_biopsias 
                                JOIN BCRECORD.db_processos USING (id_processo)
                                WHERE id_processo = ?');
    $stmt->execute(array($id));
    return $stmt->fetchAll();
}

function addNewProcess($n_processo,$id_paciente, $id_rastreio, $data_rastreio, $data_afericao, $data_1c, $id_local_drt, $id_local_esq,$rx_pulmonar,$eco_abdominal,$cing_ossea,$tac_torax,$tac_abdominal,$tac_pelvico,$ea_total,$ea_invadidos,$metastases,$sn_total,$sn_extemp,$estadio)
{
    global $conn;

    $stmt = $conn->prepare('INSERT INTO BCRECORD.db_processos (id_processo,
        n_processo,n_proc, id_paciente, id_rastreio, data_rastreio, data_afericao, data_1c, 
        id_local_drt, id_local_esq, activo,
        rx_pulmonar,eco_abdominal,cing_ossea,tac_torax,tac_abdominal,tac_pelvico,
        ea_total,ea_invadidos,metastases,sn_total,sn_extemp,estadio) 
                                VALUES (88,?,1,?,?,?,?,?,?,?,1,?,?,?,?,?,?,?,?,?,?,?,?)');

    $stmt->execute(array($n_processo,$id_paciente, $id_rastreio, $data_rastreio, $data_afericao, $data_1c, $id_local_drt, $id_local_esq,$rx_pulmonar,$eco_abdominal,$cing_ossea,$tac_torax,$tac_abdominal,$tac_pelvico,$ea_total,$ea_invadidos,$metastases,$sn_total,$sn_extemp,$estadio));

    return $conn->lastInsertId();
}

function addNewPatient($nome, $data_nasc, $estado_civil, $morada, $sns)
{
    global $conn;

    $stmt = $conn->prepare('INSERT INTO BCRECORD.db_pacientes  (id_paciente,nome, data_nasc, estado_civil, morada, sns) 
                                VALUES (DEFAULT, ?,?,?,?,?)');

    $stmt->execute(array($nome, $data_nasc, $estado_civil, $morada, $sns));

    return $conn->lastInsertId();
}
/*
function addNewRastreio($n_conc_volta, $data_rastreio, $data_afericao)
{
    global $conn;

    $stmt = $conn->prepare('INSERT INTO BCRECORD.db_rastreios  (id_rastreio,n_conc_volta, data_rastreio, data_afericao) 
                                VALUES (DEFAULT, ?,?,?)');

    $stmt->execute(array($n_conc_volta, $data_rastreio, $data_afericao));

    return $conn->lastInsertId();
}*/

function addNewBiopsia($data_biopsia, $id_processo, $tecnica_mama_drt, $tecnica_mama_esq, $tecnica_axila_drt, $tecnica_axila_esq, $resultado_mama_drt, $resultado_mama_esq, $resultado_axila_drt, $resultado_axila_esq, $n_biopsia,$forma_mama_dta,$forma_mama_esq)
{
    global $conn;

    $stmt = $conn->prepare('INSERT INTO BCRECORD.db_biopsias  (id_biopsia,data_biopsia, id_processo, tecnica_mama_drt, tecnica_mama_esq, tecnica_axila_drt, tecnica_axila_esq, resultado_mama_drt, resultado_mama_esq, resultado_axila_drt, resultado_axila_esq, n_biopsia,forma_mama_dta,forma_mama_esq) 
                                VALUES (DEFAULT, ?,?,?,?,?,?,?,?,?,?,?,?,?)');

    $stmt->execute(array($data_biopsia, $id_processo, $id_bio_mama_drt, $id_bio_mama_esq, $id_bio_axila_drt, $id_bio_axila_esq, $resultado_mama_drt, $resultado_mama_esq, $resultado_axila_drt, $resultado_axila_esq, $n_biopsia,$forma_mama_dta,$forma_mama_esq));

    return $conn->lastInsertId();
}

function addNewCirurgia($id_processo,$n_cirurgia,$data_cirurgia,$lic,$tecnica_axiladta,$tecnica_mamadta,$tecnica_axilaesq,$tecnica_mamaesq,$recontrucao_mamadta,$recontrucao_mamaesq){
    global $conn;
    $stmt = $conn->prepare('INSERT INTO BCRECORD.db_cirurgias  (id_cirurgia,id_processo,n_cirurgia,data_cirurgia,lic,tecnica_axiladta,tecnica_mamadta,tecnica_axilaesq,tecnica_mamaesq,recontrucao_mamadta,recontrucao_mamaesq) 
                                VALUES (DEFAULT, ?,?,?,?,?,?,?,?,?,?)');

    $stmt->execute(array($id_processo,$n_cirurgia,$data_cirurgia,$lic,$tecnica_axiladta,$tecnica_mamadta,$tecnica_axilaesq,$tecnica_mamaesq,$recontrucao_mamadta,$recontrucao_mamaesq));
    
    return $conn->lastInsertId();
}

function addNewTumor($id_processo,$tamanho,$grau,$re,$rp,$ki67,$her2,$margem,$tipo_histologico){
    global $conn;

    $stmt = $conn->prepare('INSERT INTO BCRECORD.db_tumores  (id_tumor,id_processo,tamanho,grau,re,rp,ki67,her2,margem,tipo_histologico) 
                                VALUES (DEFAULT, ?,?,?,?,?,?,?,?,?)');

    $stmt->execute(array($id_processo,$tamanho,$grau,$re,$rp,$ki67,$her2,$margem,$tipo_histologico));

    return $conn->lastInsertId();
}

function addNewImagem($id_processo,$tipo_imagem,$url_imagem,$bi_rads){
    global $conn;

    $stmt = $conn->prepare('INSERT INTO BCRECORD.db_imagens  (id_imagem,id_processo,tipo_imagem,url_imagem,bi_rads) 
                                VALUES (DEFAULT, ?,?,?,?)');

    $stmt->execute(array($id_processo,$tipo_imagem,$url_imagem,$bi_rads));

    return $conn->lastInsertId();
}

function addNewTerapia($id_processo,$nome,$tipo_terapia,$data_inicio,$data_fim){
    global $conn;

    $stmt = $conn->prepare('INSERT INTO BCRECORD.db_terapias  (id_terapia,id_processo,nome,tipo_terapia,data_inicio,data_fim) 
                                VALUES (DEFAULT, ?,?,?,?,?)');

    $stmt->execute(array($id_processo,$nome,$tipo_terapia,$data_inicio,$data_fim));

    return $conn->lastInsertId();
}

?>