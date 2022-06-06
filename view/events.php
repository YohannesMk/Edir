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
   die("Connection Failed: " . $connection->connect_error);
}


  if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 6;
$offset = ($pageno-1) * $no_of_records_per_page;


$total_pages_sql = "SELECT COUNT(*) FROM eventPost";
$result = mysqli_query($connection,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT * FROM eventPost LIMIT $offset, $no_of_records_per_page";
$res_data = mysqli_query($connection,$sql);

?>
<html lang="en">
    <head>
        <title>test program</title>
        <link rel="stylesheet" href="../resources/css/styles.css">
        <link rel="stylesheet" href="../resources/css/product_purchase.css">
    </head>
<body>
      <!-- Header -->
<section id="header">
    <div class="header container">
        <div class="nav-bar">
        <div class="brand">
            <a href="index.html#hero">
            <h1>EDIR-SITE</h1>
            </a>
        </div>
        <div class="nav-list">
            <div class="hamburger">
            <div class="bar"></div>
            </div>
            <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="timeline.php">Timeline</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="events.php">Events</a></li>
            <li><a href="members.php">Members</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li id="login">
              <div class="box">
                <a href="logout.php">Log Out</a>
              </div>
            </li>
            </ul>
        </div>
        </div>
    </div>
</section>
<!-- Service Section -->

  <!-- Hero Section  -->
  <section id="hero">
    <div class="hero container">
        <div id="image__container">
            <img id="edir__image" src="../resources/images/icons/Group 21.png">
            <div class="mt-5"></div>
            <p id="intro_text">
                Website for enhancing and promoting local ceremonies
                such as Graduation, Wedding and Funeral services
                across communities with digitalized payment.
            </p>
        </div>       
    </div>
  </section>
  <!-- End Hero Section  -->

  <!-- Service Section -->
 <section id="services" class="no-margin-bottom">
    <div class="services container">
      <div class="service-top">
        <h1 class="section-title"><span>Recent </span>Events</h1>
      </div>
      <div class="service-bottom">
        <div class="service-item">
          <div class="image"><img src="../resources/images/edir-hero.jpg" /></div>
          <h2>Abebe's Wedding</h2>
          <p class="date">Feb 12, 2021</p>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis debitis rerum, magni voluptatem sed
            architecto placeat beatae tenetur officia quod</p>
        </div>
        <div class="service-item">
          <div class="image"><img src="../resources/images/edir-hero.jpg" /></div>
          <h2>Helen's Graduation</h2>
          <p class="date">Feb 12, 2021</p>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis debitis rerum, magni voluptatem sed
            architecto placeat beatae tenetur officia quod</p>
        </div>
        <div class="service-item">
          <div class="image"><img src="../resources/images/edir-hero.jpg" /></div>
          <h2>Kebede's Funeral</h2>
          <p class="date">Feb 12, 2021</p>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis debitis rerum, magni voluptatem sed
            architecto placeat beatae tenetur officia quod</p>
        </div>
        <div class="service-item">
          <div class="image"><img src="../resources/images/edir-hero.jpg" /></div>
          <h2>Somlons Wedding</h2>
          <p class="date">Feb 12, 2021</p>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis debitis rerum, magni voluptatem sed
            architecto placeat beatae tenetur officia quod</p>
        </div>
      </div>
    </div>
  </section>
    <!-- End Service Section -->  

<section id="services">
    <div class="services container">
        <div class="service-top">
        <h1 class="section-title"><span>E</span>vents</h1>   
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
           Corporis debitis rerum, magni voluptatem sed 
           architecto placeat beatae tenetur officia quod</p>
    </div>
    <div class="service-bottom">
  <section id="products">
    <div class="products">        
        <div class="product product-bottom">  
          <?php
          while($rows = mysqli_fetch_array($res_data)){
            ?>
            <div class="product-item">
            <img src="../assets/image/<?php echo $rows['filename']?>">

            <div class="product-content">
              <a href="editPost.php?data=<?=$rows['slug']?> " style="font-size: 16px; text-decoration:underline;"><?php if($_SESSION['user_id']==$rows['user_id']){
                echo 'edit';
              } ?></a>
                <h2><?php echo $rows['title']?></h2>
                <p style="color: orange;">on <?php echo $rows['doe']?></p>
                <p><?php echo $rows['eventDescription']?></p>
                <div class="btn-cart">
                <a href="" type="button" class="cta">Get Teri-Card</a>
                </div>
            </div>
        </div>
        <?php
          }
          mysqli_close($connection);
          ?>
    </div>
   </section>
    </div>
      <ul class="pagination" >
        <li><a href="?pageno=1#products">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#products'; } else { echo "?pageno=".($pageno - 1); } ?>#products">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#products'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>#products">Last</a></li>
    </ul>

    <div id="make-event" class="container">
      <a href="addpost.php" class="cta">Make Event</a>
    </div>
  </section>
  <!-- End Service Section -->
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
  <script src="../resources/js/app.js">
  </script>
</body>
</html>
