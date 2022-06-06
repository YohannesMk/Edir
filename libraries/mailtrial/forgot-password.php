<?php
//session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './PHPMailer-master/PHPMailer-master/src/Exception.php';
require './PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/PHPMailer-master/src/SMTP.php';

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

require_once "vendor/autoload.php";

//PHPMailer Object
$mail = new PHPMailer(); //Argument true in constructor enables exceptions

if(isset($_POST) & !empty($_POST)){
	$email = mysqli_real_escape_string($connection, $_POST['email_addy']);
	$sql = "SELECT * FROM `user` WHERE email = '$email'";
	$res = mysqli_query($connection, $sql);
	$count = mysqli_num_rows($res);
	if($count == 1){
		$r = mysqli_fetch_assoc($res);
		$password = $r['password'];
        $to = $r['email'];
        $name = $r['fName'];

        $mail->isSMTP();
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
            );
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'edir92057@gmail.com';
        $mail->Password = 'edir2000';
        //$mail->SMTPDebug = 'SMTP::DEBUG_SERVER';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;


        $mail->setFrom('edir92057@gmail.com', 'Edir');
        $mail->addReplyTo('edir92057@gmail.com', 'Edir');
        $mail->addAddress($email, $name);
        //$mail->addCC('cc1@example.com', 'Elena');
        //$mail->addBCC('bcc1@example.com', 'Alex');


        //$mail->AddBCC('bcc2@example.com', 'Anna');
        //$mail->AddBCC('bcc3@example.com', 'Mark');
        $mail->Subject = 'This is your recovery password';
        $mail->isHTML(true);
        //$x = rand(1000,10000);
        //$_SESSION['code'] = $x;

        $mailContent = "<h1>This is your confirmation password</h1>
            <h3>$password</h3>";
        $mail->Body = $mailContent;
            }
            if($mail->send()){
            
                echo 'Message has been sent';
                //header('location:auth.php');
            }
            else{
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
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
               <a id="li_291" class="subMenuHighlight" href="../../profile/register.php"><span>Register</span></a>
            </li>
         </ul>
         <ul class="panel-heading">
            <li class="panel-title">
               <a class="subMenu1" href=""><span class="subMenuHighlight">Forgot Password</span></a>
            </li>
         </ul>
         <ul class="panel-heading">
            <li class="panel-title">
               <a class="subMenu1" href="../../view/login.php"><span>Login</span></a>
            </li>
         </ul>
      </div>
      
   </div>
</div>

<!--Content-->
<div class="col-sm-9 col-md-9 col-lg-10 content equal-height">
  <div class="content-area-right">
   <div class="content-crumb-div">
      <a href="">Home</a> / <a href="">Your Account</a> / Forgot Password
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
