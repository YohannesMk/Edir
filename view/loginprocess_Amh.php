<?php
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


session_start ();

if($_SERVER["REQUEST_METHOD"]=="POST")
{
     $phone=$_POST['Pnum'];
     $password=$_POST['password'];
     $sql="SELECT * from user where phoneNo='".$phone."'AND password='".$password."' limit 1";
 
   $result=mysqli_query($connection, $sql);
   if(mysqli_num_rows($result)==1){
       echo "Logged in Successfully.";
       $_SESSION["login"]="1";
       $_SESSION["Pnum"] = $phone;
       $_SESSION['user_id'] = mysqli_fetch_array($result)['user_id'];

       header("Location: ./timeline_Amh.php");

           
       exit();
   }
   else{
    header("location:login_Amh.php?err=1");  
    echo "Incorrect password";
   }
/*
if(isset($_REQUEST['submit']))
{
$a = $_REQUEST['Pnum'];
$b = $_REQUEST['password'];

$res = mysqli_query($mysqli , "SELECT * from users where phonenum='$a'and pass='$b'");
*/
//$result=mysqli_fetch_array($res);
//$result=mysqli_query($mysqli, $res);

/*
if($res)
{
	
	$_SESSION["login"]="1";
	header("location:index.php");
}
else	
{
	header("location:login_Amh.php?err=1");
	
}*/
}
?>
