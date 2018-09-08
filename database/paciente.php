<?php
function getAllPatients()
{
    global $conn;

    $stmt = $conn->prepare('SELECT *
                                FROM BCRECORD.db_pacientes
                                ORDER BY nome');
    $stmt->execute();
    return $stmt->fetchAll();
}

function getPatientById($id)
{
    global $conn;

    $stmt = $conn->prepare('SELECT *
                                FROM BCRECORD.db_pacientes
                                WHERE id_paciente = ?');
    $stmt->execute(array($id));
    return $stmt->fetch();
}


//Old queries...
function getPatientIdByName($name)
{
    global $conn;

    $stmt = $conn->prepare('SELECT code
                                FROM patient
                                WHERE name = ?');
    $stmt->execute(array($name));
    return $stmt->fetch()['code'];
}

function addPatient($name, $address)
{
    global $conn;

    $stmt = $conn->prepare('INSERT INTO patient (code, name, address) 
                                VALUES (DEFAULT, ?,?)');
    $stmt->execute(array($name, $address));
}

function removePatient($code)
{
    global $conn;

    $stmt = $conn->prepare('DELETE FROM patient 
                                WHERE code = ?');
    $stmt->execute(array($code));
}

function editPatient($code, $name, $address)
{
    global $conn;
    $stmt = $conn->prepare('INSERT INTO patient (code, name, address) VALUES (?, ?,?)');
    $stmt->execute(array($code, $name, $address));
}

function getProfileByID($patientID)
{
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM patient WHERE id = ?');
    $stmt->execute(array($patientID));
    return $stmt->fetch();
}
?>