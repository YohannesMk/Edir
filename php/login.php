<?php
$host="localhost";
$username="root";
$password="";
$dbname="a2zzz";
$con=new mysqli($host,$username,$password,$dbname);
if($con->connect_error){
    die("connection faild:" . $con->connect_error);
}
if(isset($_POST['username'])){
    $username=$_POST['username'];
    $email=$_POST['email'];
 $sql="select * from register where firstname='".$username."'AND email='".$email."' limit 1";

  $result=mysqli_query($con,$sql);
  if(mysqli_num_rows($result)==1){
      echo "you have successfully logged in";
      exit();
  }
  else{
      echo "you have enter incorrect password";
}
}
?>

<!doctype html>
<html>
    <body>
        <form method="post" action="#">
           username<input type="text" name="username" ><br>
           email<input type="text" name="email">
           <input type="submit" name="submit" value="LOGIN" class="btn-login">
        </form>
    </body>
</html>

