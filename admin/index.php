<?php
session_start();
$user_id = $_SESSION['admin_id'];
  header('location: ./view/user-table.php');
if(!isset($user_id)){
   header('location: ./view/login.php');
};
?>