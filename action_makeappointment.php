<?php
  include ('config/init.php');
  include ('database/appointment.php');
  include ('database/patient.php');

  //if (!isset($_SESSION['number']))
  //  die(header('Location: show_threads.php'));
  $day = $_POST['day'];
  $month = $_POST['month'];
  $year = $_POST['year'];
  $minute = $_POST['min'];
  $hour= $_POST['hour'];
  $room= $_POST['room'];
  $patient=$_POST['patient'];

  
  $timestamp = mktime($hour,$minute,0, $month, $day, $year);
  
  echo $room;
  echo $patient;
  
    
  makeAppointment(99030,getPatientIdByName($patient),$timestamp,$room);

  header('Location: makeappointment.php?day='.$day.'&month='.$month.'&year='.$year);

?>