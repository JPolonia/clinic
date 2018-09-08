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

function addNewProcess($id_paciente, $id_rastreio, $data_1c, $id_local_drt, $id_local_esq)
{
    global $conn;

    $stmt = $conn->prepare('INSERT INTO BCRECORD.db_processos (id_processo,n_proc, id_paciente, id_rastreio, data_1c, id_local_drt, id_local_esq, activo) 
                                VALUES (DEFAULT,1, ?,?,?,?,?,1)');

    $stmt->execute(array($id_paciente, $id_rastreio, $data_1c, $id_local_drt, $id_local_esq));

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

function addNewRastreio($n_conc_volta, $data_rastreio, $data_afericao)
{
    global $conn;

    $stmt = $conn->prepare('INSERT INTO BCRECORD.db_rastreios  (id_rastreio,n_conc_volta, data_rastreio, data_afericao) 
                                VALUES (DEFAULT, ?,?,?)');

    $stmt->execute(array($n_conc_volta, $data_rastreio, $data_afericao));

    return $conn->lastInsertId();
}

function addNewBiopsia($data_biopsia, $id_processo, $id_bio_mama_drt, $id_bio_mama_esq, $id_bio_axila_drt, $id_bio_axila_esq, $resultado_mama_drt, $resultado_mama_esq, $resultado_axila_drt, $resultado_axila_esq, $n_biopsia)
{
    global $conn;

    $stmt = $conn->prepare('INSERT INTO BCRECORD.db_biopsias  (id_biopsia,data_biopsia, id_processo, id_bio_mama_drt, id_bio_mama_esq, id_bio_axila_drt, id_bio_axila_esq, resultado_mama_drt, resultado_mama_esq, resultado_axila_drt, resultado_axila_esq, n_biopsia) 
                                VALUES (DEFAULT, ?,?,?,?,?,?,?,?,?,?,?)');

    $stmt->execute(array($data_biopsia, $id_processo, $id_bio_mama_drt, $id_bio_mama_esq, $id_bio_axila_drt, $id_bio_axila_esq, $resultado_mama_drt, $resultado_mama_esq, $resultado_axila_drt, $resultado_axila_esq, $n_biopsia));

    return $conn->lastInsertId();
}

?>