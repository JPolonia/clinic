<?php
    function getAllConditions(){
        global $conn;
        $stmt = $conn->prepare('SELECT *
                                FROM condition');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getConditionFromRef($ref){
        global $conn;
        $stmt = $conn->prepare('SELECT designation
                                FROM condition
                                WHERE ref= ?');
        $stmt->execute(array($ref));
        return $stmt->fetch();
    }

    function getAllConditionsOfPacient($code){
        global $conn;
        
        $stmt = $conn->prepare('SELECT DISTINCT designation
                                FROM appointment 
                                JOIN diagnosed 
                                USING(num) 
                                JOIN condition 
                                USING (ref)
                                WHERE code = ?');
        $stmt->execute(array($code));
        return $stmt->fetch();
    }

    function getPacientsOfCondition($ref){
        global $conn;
        $stmt = $conn->prepare('SELECT DISTINCT name
                                FROM appointment 
                                JOIN diagnosed 
                                USING(num)
                                JOIN condition
                                Using (ref) 
                                JOIN patient 
                                USING (code)
                                WHERE ref = ?');
        $stmt->execute($ref);
        return $stmt->fetchAll();
    }

    function getAppointmentsOfDiagnoses($ref)
    {
        global $conn;
        $stmt = $conn->prepare('SELECT num
                                FROM appointment 
                                JOIN diagnosed 
                                USING(num)
                                JOIN condition
                                Using (ref) 
                                WHERE ref = ?');
        $stmt->execute($ref);
        return $stmt->fetchAll();
    }

    function addCondition($designation) {
		global $conn;
		$stmt = $conn->prepare('INSERT INTO condition(ref,designation) 
                                VALUES (DEFAULT, ?)');
		$stmt->execute(array($designation));
	}

    function removeCondition($ref) {
		global $conn;
		$stmt = $conn->prepare('DELETE FROM condition 
                                WHERE ref = ?');
        $stmt->execute(array($ref));
    }

?>