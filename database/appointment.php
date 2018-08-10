<?php

    function getAppointmentFromMedic($number) {
        global $conn;
        $stmt = $conn->prepare('SELECT *
                                FROM appointment
                                WHERE number = ?');
        $stmt->execute(array($number));
        return $stmt->fetchAll();
    }
  

    function getAppointmentById($num) {
	  global $conn;
      $stmt = $conn->prepare('SELECT * 
                              FROM appointment
                              WHERE num = ?');
      $stmt->execute(array($num));
      return $stmt->fetch();
    }

    function getAppointmentCountFromMedic($number) {
        global $conn;
        $stmt = $conn->prepare('SELECT COUNT(*)
                                AS count 
                                FROM appointment 
                                WHERE number = ?');
        $stmt->execute(array($number));
        return $stmt->fetch()['count'];
    }

    function getAppointmentsInDay($date) {
        global $conn;
        $stmt = $conn->prepare('SELECT *
                                FROM appointment
                                WHERE EXTRACT(day FROM to_timestamp(date))=EXTRACT(day FROM to_timestamp(?))
                                AND EXTRACT(month FROM to_timestamp(date))=EXTRACT(month FROM to_timestamp(?))
                                AND EXTRACT(year FROM to_timestamp(date))=EXTRACT(year FROM to_timestamp(?))
                                ORDER BY date');
        $stmt->execute(array($date,$date,$date));
        return $stmt->fetchAll();
    }

    function getAppointmentsOfPatient($code) {
        global $conn;
        $stmt = $conn->prepare('SELECT *
                                FROM appointment
                                JOIN patient
                                USING (code)
                                WHERE code = ?');
        $stmt->execute(array($code));
        return $stmt->fetchAll();
    }

    function getAppointmentsOfRoom($room) {
        global $conn;
        $stmt = $conn->prepare('SELECT *
                                FROM appointment
                                WHERE room = ?');
        $stmt->execute(array($room));
        return $stmt->fetchAll();
    }

    function getLastAppointment(){
        global $conn;
        $stmt = $conn->prepare('SELECT MAX(num)
                                FROM appointment');
        $stmt->execute(array());
        return $stmt->fetch();

    }

    function makeAppointment($number,$code,$date, $room) {
        global $conn;
        
        $stmt = $conn->prepare('INSERT INTO appointment (num, date, room, number, code) 
                                VALUES (DEFAULT,?,?,?,?)');
        $stmt->execute(array($date,$room,$number,$code));
    }

    function deleteAppointment($num) {
		global $conn;
		$stmt = $conn->prepare('DELETE FROM appointment 
                                WHERE num = ?');
		$stmt->execute(array($number));
	}
?>