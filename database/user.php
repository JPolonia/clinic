<?php

  function isValidUser($username, $password) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($username));
    
    $user = $stmt->fetch();

    return $user !== false && password_verify($password, $user['password']);
  }

  function createUser($username, $password) {
    global $conn;

    $options = [
        'cost' => 12,
    ];


    $hash = password_hash($password , PASSWORD_DEFAULT, $options);

    /*echo $username;
    echo '<br>';
    echo $password;
    echo '<br>';
    echo $hash;
    echo '<br>';*/

    $stmt = $conn->prepare('INSERT INTO users (username,password) VALUES (?, ?)');
    $stmt->execute(array($username, $hash));
  }

  function getRoleUser($username) {
    global $conn;

    $stmt = $conn->prepare('SELECT role FROM users WHERE username = ?');
    $stmt->execute(array($username));
    
    $role = $stmt->fetch();
    return $role['role'];
  }
  function getProfileByUserid($user) {
		global $conn;

		$stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
		$stmt->execute(array($user));
		return $stmt->fetch();
	}

?>