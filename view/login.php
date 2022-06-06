
  <?php

  session_start();

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

   if($_SERVER["REQUEST_METHOD"]=="POST")
   {
        $phone=$_POST['Pnum'];
        $password = md5($_POST['password']);
        // password_verify($password,$_POST['password']);
     $sql="SELECT * from user where phoneNo='".$phone."'AND password='".$password."' limit 1";
      $result=mysqli_query($connection, $sql);
      if(mysqli_num_rows($result)==1){
          $_SESSION['user_id'] = mysqli_fetch_array($result)['user_id'];
          echo "Logged in Successfully.";
          header("Location: ../index.php");
          exit();
      }
      else{
          echo "Incorrect password";
      }
    }
    ?>
   <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../resources/css/login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
  
  </head>
  <body>
 
      <form class="login-form" action="loginprocess.php" method="post">
        <h1>Login</h1>

        <div class="txtb">
          <input type="text" id="id-input" name="Pnum">
          <span data-placeholder="Id"></span>
        </div>

        <div class="txtb">
          <input type="password" name="password" >
          <span data-placeholder="Password"></span>
        </div>

        <input type="submit" name="submit"  class="logbtn" id="pssword-input" >

        <div class="bottom-text" style="font-size:16px">
          Forgot Password?<a href="../libraries/mailtrial/forgot-password.php"> Reset password</a>
          <br>
          You Dont Have An Account?<a href="../profile/register.php"> Sign-up</a>
        </div>

      </form>

      <script src=".../resources/js/app.js"></script>
      <script type="text/javascript">
      $(".txtb input").on("focus",function(){
        $(this).addClass("focus");
      });

      $(".txtb input").on("blur",function(){
        if($(this).val() == "")
        $(this).removeClass("focus");
      });

      </script>

  </body>
</html>
