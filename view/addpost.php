<?php

session_start ();
if(!isset($_SESSION["login"]))
	header("location:login.php"); 


require_once '../controller/functions.php';
  $server="localhost";
  $user="root";
  $password="";
  $db_name="edir";

  
  // check if the user has clicked the button "UPLOAD" 
  

// Create connection
$connection = new mysqli($server, $user, $password, $db_name);
// Check connection
if ($connection->connect_error) {
   die("Connection Failed: " . $connection->connect_error);
}
  echo "Connected.";
//   if(isset($_POST['register']))



if($_SERVER["REQUEST_METHOD"]=="POST")

  {

    $user = $_SESSION['user_id'];
    $title= $_POST ['title'];
    $eventType = $_POST['eventType'];
    $description=$_POST['description'];
    $doe=$_POST['doe'];
    $slug = create_slug($eventType.' '.$title);

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"]; 
 
    $folder = "../assets/image/".$filename;
 
    if (move_uploaded_file($tempname, $folder))  {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
  }

    $query="INSERT INTO eventpost (user_id, eventType, title, eventDescription, filename, doe, slug) VALUES('$user','$eventType','$title' ,'$description','$filename', '$doe', '$slug')";

    if(mysqli_query($connection, $query))
    {
        echo "Form Inserted Succesfully!";
        header("Location:events.php");
    }
     
      mysqli_close($connection);
  }

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../resources/css/styles.css">

<link rel="stylesheet" href="../resources/css/addPost.css">
</head>
<body>
  <section id="header">
    <div class="header container">
      <div class="nav-bar">
        <div class="brand">
          <a href="#hero">
            <h1>EDIR-SITE</h1>
          </a>
        </div>
        <div class="nav-list">
          <div class="hamburger">
            <div class="bar"></div>
          </div>
          <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="timeline.html" >Timeline</a></li>
            <li><a href="services.html">Services</a></li>
            <li><a href="events.html">Events</a></li>
            <li><a href="members.html">Members</a></li>
            <li><a href="contact.html">Contact</a></li>

            <li id="login">
                <div class="box">
                  <a href="login.html">Login</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- End Header -->
  <div class="post-container">
  <form method="post"  enctype="multipart/form-data">
    <h1 class="header-text">Post An Event</h1>
    <div class="post-row">
      <div class="col-25">
        <label for="eventType">Event Type</label>
      </div>
      <div class="col-75">
        <select required id="eventType" name="eventType">
          <option value="Graduation">Graduation</option>
          <option value="Wedding">Wedding</option>
          <option value="Funeral">Funeral</option>
        </select>
      </div>
    </div>

    <div class="post-row">
      <div class="col-25">
        <label for="title">Title</label>
      </div>
      <div class="col-75">
        <input required name="title" id="title"  style="height: 30;">
      </div>
    </div>
  <div class="post-row">
    <div class="col-25">
            <input type="file"
                   name="uploadfile"
                   value="" />
</div>
    <div class="post-row">
      <div class="col-25">
            <label for="DOE">Date of Event</label>
        </div>
        <div class="col-75">
            <input required name="doe" id="DOE" type="date">
        </div>
    </div>


    <div class="post-row">
      <div class="col-25">
        <label for="subject">Event Description</label>
      </div>
      <div class="col-75">
        <textarea name="description" required id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
      </div>
    </div>
    <div class="post-row">
      <a href=""><input type="submit" name="submit" value="Submit"></a>
    </div>
      </form>
</div>
<section id="footer">
  <div class="footer container">
    <div class="brand">
      <h1><span>E</span>dir <span>S</span>ite</h1>
    </div>
    <h2>Digitalized Edir System</h2>
    <div class="social-icon">
      <div class="social-item">
        <a href="#"><img src="https://img.icons8.com/bubbles/100/000000/facebook-new.png" /></a>
      </div>
      <div class="social-item">
        <a href="#"><img src="https://img.icons8.com/bubbles/100/000000/instagram-new.png" /></a>
      </div>
      <div class="social-item">
        <a href="#"><img src="https://img.icons8.com/bubbles/100/000000/twitter.png" /></a>
      </div>
      <div class="social-item">
        <a href="#"><img src="https://img.icons8.com/bubbles/100/000000/behance.png" /></a>
      </div>
    </div>
    <p>Copyright © 2022 Edir-Site. All rights reserved</p>
  </div>
</section>
<script src="../resources/js/contact.js"></script>
</body>
</html>
