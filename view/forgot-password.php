<?php
require '../controller/mailer.php';
require_once '../controller/validator.php';

$server="localhost";
$user="root";
$password="";
$db_name="edir";

// Create connection
$connection = new mysqli($server, $user, $password, $db_name);
// Check connection
if ($connection->connect_error) {
 die("Connection Failed: " . $connection->connect_error);
}
echo "Connected.";


if(isset($_POST) & !empty($_POST)){
	$email = mysqli_real_escape_string($connection, test_input($_POST['email_addy']));
	$sql = "SELECT * FROM `user` WHERE email = '$email'";
	$res = mysqli_query($connection, $sql);
	$count = mysqli_num_rows($res);
	if($count == 1){
		$r = mysqli_fetch_assoc($res);
		$password = randomPass(5);
        $to = $r['email'];
        $name = $r['fName'];
   }
   $subj = "Dear $name,";
   $mailContent = "Use this password temporairly to log into your Edir Account and change it after you logged in.
   <h3>$password</h3>";
   
   if(send_mail($to, $subj, $mailContent)){
      $password = md5($password);
      $query="UPDATE user SET password='$password' where email='$to';";
      
      if (mysqli_query($connection, $query)){
         echo "Update Successful";
     }
     else {
         echo "Update Failed!";
         
     }
   }

}
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="../../resources/css/forgot-password.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div id="highlighted" class="hl-basic hidden-xs">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 col-lg-10 col-lg-offset-2">
            <h1>
               Forgot Password.
            </h1>
         </div>
      </div>
   </div>
</div>

<div id="content" class="interior-page">
<div class="container-fluid">
<div class="row">
<!--Sidebar-->
<div class="col-sm-3 col-md-3 col-lg-2 sidebar equal-height interior-page-nav hidden-xs">
   <div class="dynamicDiv panel-group" id="dd.0.1.0">
      <div id="subMenu" class="panel panel-default">
         <ul class="subMenuHighlight panel-heading">
            <li class="subMenuHighlight panel-title" id="subMenuHighlight">
               <a id="li_291" class="subMenuHighlight" href="../profile/register.php"><span>Register</span></a>
            </li>
         </ul>
         <ul class="panel-heading">
            <li class="panel-title">
               <a class="subMenu1" href="#"><span class="subMenuHighlight">Forgot Password</span></a>
            </li>
         </ul>
         <ul class="panel-heading">
            <li class="panel-title">
               <a class="subMenu1" href="./login.php"><span>Login</span></a>
            </li>
         </ul>
      </div>
      
   </div>
</div>

<!--Content-->
<div class="col-sm-9 col-md-9 col-lg-10 content equal-height">
  <div class="content-area-right">
   <div class="content-crumb-div">
      <!-- <a href="">Home</a> / <a href="">Your Account</a> / Forgot Password -->
   </div>
      <div class="row">
      <form role="form" autocomplete="off" method="post">  
         <div class="col-md-5 forgot-form">
            <p>
               Please enter your email address below and we will send you information to change your password.
            </p>
            <label class="label-default" for="un">Email Address</label> 
            <input id="email_addy" name="email_addy" class="form-control" type="text"><br>
            <input type="submit" id="mybad" class="btn btn-primary" role="submit" value="Reset Password">
         
         </div>
         <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
         <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
      </form>

         <div class="col-md-5 forgot-return" style="display:none;">
            <h3>
               Reset Password Sent
            </h3>
            <p>
               An email has been sent to your address with a reset password you can use to access your account.
            </p>
         </div>
      </div>
   </div>
</div>
