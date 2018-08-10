<?php

    function getAllThreads(){
        global $conn;
        
        $stmt = $conn->prepare('SELECT *
                                FROM thread
                                ORDER BY id');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getThreadById($id){
        global $conn;
        $stmt = $conn->prepare('SELECT *
                                FROM thread
                                WHERE id = ?');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    function getPatientOfThread($id){
        global $conn;
        
        $stmt = $conn->prepare('SELECT code
                                FROM thread
                                WHERE id=?');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    function getPatientThreads($code){
        global $conn;
        
        $stmt = $conn->prepare('SELECT *
                                FROM thread
                                WHERE code=?');
        $stmt->execute(array($code));
        return $stmt->fetchAll();
    }   

    function getPatientThreadsByName($name){
        global $conn;
        
        $stmt = $conn->prepare('SELECT *
                                FROM thread
                                JOIN patient
                                USING (code)
                                WHERE name=?');
        $stmt->execute(array($name));
        return $stmt->fetchAll();
    }
    
    function makeNewThread($topic,$code,$number,$text){
        
        global $conn;
        $stmt = $conn->prepare('INSERT INTO thread (id,date,topic,code,number,text)
                                VALUES (DEFAULT,now(),?,?,?,?)');
        $stmt->execute(array($topic,$code,$number,$text));
    }

    function deleteThread($id) {
		global $conn;

		$stmt = $conn->prepare('DELETE FROM thread 
                                WHERE number = ?');
		$stmt->execute(array($id));
	}





?>