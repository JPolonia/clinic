<?php

    function getAllReplies(){
        global $conn;
        
        $stmt = $conn->prepare('SELECT *
                                FROM reply
                                ORDER BY id');
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    function getAllRepliesToThread($id){
        global $conn;
        
        $stmt = $conn->prepare('SELECT *
                                FROM reply
                                WHERE id=?');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }
    


    function makeNewReply($number,$id,$text){
        
        global $conn; 
        $stmt = $conn->prepare('INSERT INTO reply (reply_id,date,number,id,text)
                                VALUES (DEFAULT,now(),?,?,?)');
                                
        $stmt->execute(array($number,$id,$text));
        echo ok;
    }

    function deleteReply($reply_id) {
		global $conn;
		$stmt = $conn->prepare('DELETE FROM reply
                                WHERE reply_id=?');
		$stmt->execute(array($reply_id));
	}

    function editReply($reply_id,$date,$number,$id,$text) {
        global $conn;
        $stmt = $conn->prepare('INSERT INTO reply (reply_id, date,number,id,text) 
                                VALUES (?, ?,?)');
		$stmt->execute(array($reply_id,$date,$number,$id,$text));

    }



?>