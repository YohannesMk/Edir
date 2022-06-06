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
  echo "Connected.";

$sql = "SELECT * FROM service ORDER BY date_updated DESC limit 4; ";
$ssql = "SELECT * FROM service ORDER BY date_updated DESC;";
$sresult = mysqli_query($connection,$ssql);
$result = mysqli_query($connection, $sql);
$resultCheck = mysqli_num_rows($result);

?>
<html lang="en">
    <head>
        <title>Services: Edir-Site</title>
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
            <li><a href="timeline.php" >Timeline</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="events.php">Events</a></li>
            <li><a href="members.php">Members</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li id="login">
              <div class="box">
                <a href="login.php">Log Out</a>
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
        <h1 class="section-title"><span>popular </span>items</h1>
      </div>
      <div class="service-bottom">
        <div class="service-item">
          <div class="image"><img src="../resources/images/edir-hero.jpg" /></div>
          <h2>Web Design</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis debitis rerum, magni voluptatem sed
            architecto placeat beatae tenetur officia quod</p>
        </div>
        <div class="service-item">
          <div class="image"><img src="../resources/images/edir-hero.jpg" /></div>
          <h2>Web Design</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis debitis rerum, magni voluptatem sed
            architecto placeat beatae tenetur officia quod</p>
        </div>
        <div class="service-item">
          <div class="image"><img src="../resources/images/edir-hero.jpg" /></div>
          <h2>Web Design</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis debitis rerum, magni voluptatem sed
            architecto placeat beatae tenetur officia quod</p>
        </div>
        <div class="service-item">
          <div class="image"><img src="../resources/images/edir-hero.jpg" /></div>
          <h2>Web Design</h2>
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
        <h1 class="section-title"><span>our </span>products</h1>   
    </div>
    <div class="service-bottom">
  <section id="products">
    <div class="products">        
        <div class="product product-bottom">      
        <?php
                while($rows= $sresult -> fetch_assoc())
                { 
                    ?>
            <div class="product-item">
                <img src="../resources/images/edir-hero.jpg">

                <div class="product-content">
                    <h2><?php echo $rows['itemName']?></h2>
                    <p><?php echo $rows['description']?></p>
                    <div class="price">ETB <?php echo $rows['price']?> per day</div>
                    <div class="btn-cart">
                        <a href="" type="button" class="cta">Rent</a>
                    </div>
                </div>
            </div>
            <?php
                }
             ?>
    </div>
   </section>
    </div>
    <div class="pagination">
      <a href="#">&laquo;</a>
      <a href="#">1</a>
      <a href="#" class="active">2</a>
      <a href="#">3</a>
      <a href="#">4</a>
      <a href="#">5</a>
      <a href="#">6</a>
      <a href="#">&raquo;</a>
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
      <p>Copyright © 2020 Edir-Site. All rights reserved</p>
    </div>
  </section>
  <script src="../resources/js/app.js">
  </script>
</body>
</html>
