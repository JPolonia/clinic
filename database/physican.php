<?php

    function getAllMedics(){
        global $conn;
    
        $stmt = $conn->prepare('SELECT name, address
                                FROM physician
                                ORDER BY name');
        $stmt->execute();
        return $stmt->fetchAll();
}

    function getMedicById($number) {
        global $conn;
        $stmt = $conn->prepare('SELECT * 
                                FROM physician
                                WHERE number = ?');
        $stmt->execute(array($number));
        return $stmt->fetch();
    }

    function addMedic($name,$address) {
		global $conn;
		$stmt = $conn->prepare('INSERT INTO physician (number, name, address) 
                                VALUES (DEFAULT, ?,?)');
		$stmt->execute(array($name,$address));
	}

    function removeMedic($number) {
		global $conn;

		$stmt = $conn->prepare('DELETE FROM physician 
                                WHERE number = ?');
		$stmt->execute(array($number));
	}

    function editMedic($number,$name,$address)
    {
        global $conn;
        $stmt = $conn->prepare('INSERT INTO medic (number, name, address) 
                                VALUES (?, ?,?)');
		$stmt->execute(array($number,$name,$address));
    }

    function getProfileByID($medicID) {
		global $conn;

		$stmt = $conn->prepare('SELECT * FROM physician WHERE id = ?');
		$stmt->execute(array($medicID));
		return $stmt->fetch();
	}
?>