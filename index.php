<?php
session_start();
$user_id = $_SESSION['user_id'];
  header('location: ./view/timeline.php');
if(!isset($user_id)){
   header('location: ./view/login.php');
};
?>