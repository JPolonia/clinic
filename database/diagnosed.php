<?php

    function makeDiagnose($ref,$num) {
        global $conn;
		$stmt = $conn->prepare('INSERT INTO diagnosed(ref,num) 
                                VALUES (?,?)');
		$stmt->execute(array($ref,$num));
    }

    function removeCondition($ref,$num) {
		global $conn;
		$stmt = $conn->prepare('DELETE FROM condition(ref,num) 
                                VALUES ( ?, ?)');
		$stmt->execute(array($ref,$num));
	}
?>