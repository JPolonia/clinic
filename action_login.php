<?php
  include ('config/init.php');
  include ('database/user.php');

  $username = $_POST['username'];
  $password = $_POST['password'];

  if (isValidUser($username, $password)) {
    $_SESSION['message'] = "Login successful! Welcome $username!";
    $_SESSION['success_message'] = 'Login successful!';
    $_SESSION['username'] = $username;
    $_SESSION['role'] = getRoleUser($username);
    //$_SESSION['role'] = admin;
  } else {
    $_SESSION['message'] = "Login failed!";
    $_SESSION['error_message'] = 'Login failed!';
    die(header('Location: index.php'));
  }

  //header('Location: list_categories.php');
  //header('Location: ' . $_SERVER['HTTP_REFERER']);
  header('Location: home.php');
?>