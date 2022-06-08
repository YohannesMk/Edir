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

//here we create a random password and set it as a new passoword
$n = 5;
$password = bin2hex(random_bytes($n));
//PHPMailer Object
$mail = new PHPMailer(); //Argument true in constructor enables exceptions

if(isset($_POST) & !empty($_POST)){
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$sql = "SELECT * FROM `user` WHERE email = '$email'";
	$res = mysqli_query($connection, $sql);
	$count = mysqli_num_rows($res);
	if($count == 1){
		$r = mysqli_fetch_assoc($res);
		//$password = $r['password'];
        $to = $r['email'];

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
        $mail->addAddress('yohannesmengistu1@gmail.com', 'jo');
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
    $new_pass = mysqli_real_escape_string($conn, md5("'$password'"));
    $passSql = "UPDATE user SET password = '$new_pass' WHERE email = '$email'";
    $res = mysqli_query($connection, $sql);
            
    echo 'Message has been sent. New password has been sent to your email adress.';
    //header('location:auth.php');
  }
  else{
    echo 'Message could not be sent. Please check your connection and try again!';
      //to debug we can use the following line of code
      //echo 'Mailer Error: ' . $mail->ErrorInfo;
  }

}





?>


<html>
<head>
	<title>Forgot Password</title>
    
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
<div class="container">
      <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
        <form id="register-form" role="form" autocomplete="off" class="form" method="post">    
		  <div class="form-group">
			<div class="input-group">
			  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
			  <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
			</div>
		  </div>
		  <div class="form-group">
			<input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
		  </div>
		  
		  <input type="hidden" class="hide" name="token" id="token" value=""> 
		</form>
</div>
</body>
</html>



































