<?php
    function getAllPatients(){
        global $conn;
        
        $stmt = $conn->prepare('SELECT *
                                FROM patient
                                ORDER BY name');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getPatientById($code){
        global $conn;
        
        $stmt = $conn->prepare('SELECT *
                                FROM patient
                                WHERE code = ?');
        $stmt->execute(array($code));
        return $stmt->fetch();
    }

    function getPatientIdByName($name){
        global $conn;
        
        $stmt = $conn->prepare('SELECT code
                                FROM patient
                                WHERE name = ?');
        $stmt->execute(array($name));
        return $stmt->fetch()['code'];
    }

    function addPatient($name,$address) {
		global $conn;

		$stmt = $conn->prepare('INSERT INTO patient (code, name, address) 
                                VALUES (DEFAULT, ?,?)');
		$stmt->execute(array($name,$address));
	}

    function removePatient($code) {
		global $conn;

		$stmt = $conn->prepare('DELETE FROM patient 
                                WHERE code = ?');
		$stmt->execute(array($code));
	}

    function editPatient($code,$name,$address)
    {
        global $conn;
        $stmt = $conn->prepare('INSERT INTO patient (code, name, address) VALUES (?, ?,?)');
		$stmt->execute(array($code,$name,$address));
    }

    function getProfileByID($patientID) {
		global $conn;

		$stmt = $conn->prepare('SELECT * FROM patient WHERE id = ?');
		$stmt->execute(array($patientID));
		return $stmt->fetch();
	}
?>