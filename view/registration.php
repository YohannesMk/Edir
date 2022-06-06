<?php
 session_start ();
 if(!isset($_SESSION["login"]))
 
   header("location:login.php"); 
 
 
 
 $server="localhost";
  $user="root";
  $password="";
  $db_name="edir";


// Create connection
$connection = new mysqli($server, $user, $password, $db_name);
// Check connection
if ($connection->connect_error) {
   die("Connection failed: " . $connection->connect_error);
}
  echo "Connected successfully";

  if(isset($_POST['registration']))
  {
      $firstname=$_POST['Fname'];
      $middlename=$_POST['Mname'];
      $lastname=$_POST['Lname'];
      $gender=$_POST['gender'];
      $region=$_POST['Region'];
      $city=$_POST['City'];
      $zone=$_POST['Zone'];
      $woreda=$_POST['Woreda'];
      $hnumber=$_POST['Hnum'];
      $phone=$_POST['Pnum'];
      $email=$_POST['email'];
      $password=$_POST['Password'];
      $dob=$_POST['birthday'];



      $query="INSERT INTO signup (fname, mname, lname, dob ,gender, region, city, zone, woreda, housenum, phonenum, email, password)
      VALUES('$firstname','$middlename','$lastname','$dob','$gender','$region','$city','$zone','$woreda','$hnumber','$phonenum','$email','$password')";

      if(mysqli_query($connection, $query))
      {
          echo "Form Inserted Succesfully!";
      }
      
      mysqli_close($connection);
  }

?>