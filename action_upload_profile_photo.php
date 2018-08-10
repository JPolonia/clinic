<?php
  include ('config/init.php');
  include ('database/user.php');

  $username = $_POST['username'];
  $tmp_name = $_FILES['photo']['tmp_name'];

  $profile = getProfileByUsername($username);
  if (!$profile) die;

  move_uploaded_file($tmp_name, "images/profile/$username.jpg");
  header('Location: my_profile.php');
?>
