<?php
require_once '../controller/connect.php';
session_start();

if(isset($_POST['submit'])){

   $phone = mysqli_real_escape_string($connection, $_POST['phone']);
   $pass = mysqli_real_escape_string($connection, md5($_POST['password']));

   $select = mysqli_query($connection, "SELECT * FROM user WHERE phoneNo = '$phone' AND password = '$pass' AND is_admin = 1") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['admin_id'] = $row['user_id'];
      header('Location:user-table.php');
   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../resource/css/login/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Admin Login</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="number" name="phone" placeholder="enter phone No." class="box" required>
      <input type="password" name="password" placeholder="enter password" class="box" required>
      <input type="submit" name="submit" value="login now" class="btn">
   </form>

</div>

</body>
</html>