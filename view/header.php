<?php
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location: ../profile/login.php');
};

require_once '../controller/connect.php';
require_once '../controller/functions.php';

if(isset($_GET['file'])){
    $file = $_GET['file'];
    $filename = '../assets/image/'.$file;
    exportImage($filename);
  }
  
$sql = "SELECT COUNT(*) FROM cart  WHERE user_id = '$user_id'";
$res = mysqli_query($connection, $sql);
$total_cart = mysqli_fetch_array($res)[0];
?>

<!DOCTYPE html>

<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edir-Site</title>
    <meta name="keywords" content="Edir Site">
    <meta name="description" content="Edir Site - Digitalized Edir system">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="./.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../resources/images/icons/Group 21.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../resources/images/icons/Group 21.png">
    <link rel="shortcut icon" href="../resources/images/icons/Group 21.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Plugins - File -->
    <!-- Main CSS File -->
    <link rel="stylesheet" href="../resources/css/edir.css">

    <link rel="stylesheet" href="../resources/css/style.css">
    <link rel="stylesheet" href="../resources/css/skin-demo-4.css">
    <!-- <link rel="stylesheet" href="../resources/css/body.css"> -->
    <style>
         html{
            scroll-behavior: smooth;
        }

        /*
        .mobile-nav.isActive{
                color: blue;
        }
        li>a:active{
            color: blue;
        }
         */

    </style>
</head>

<body>
    <div class="mobile-menu-overlay"></div>
    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>

            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    
                    <li>
                        <a href="timeline.php">Timeline</a>
                    </li>
                    <li>
                        <a href="product.php">Services</a>
                    </li>
                    <li>
                        <a href="event.php">Events</a>
                    </li>
                    <li>
                        <a href="members.php">Members</a>
                    </li>
                   
                </ul>
            </nav>
            <!-- End .mobile-nav -->

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
            </div>
            <!-- End .social-icons -->
        </div>
        <!-- End .mobile-menu-wrapper -->
    </div>
    <header class="header">
        <div class="header-top">
            <div class="container">
                <div class="header-left">
                    <!-- End .header-dropdown -->

                    <div class="header-dropdown">
                        <a href="#">Eng</a>
                        <div class="header-menu">
                            <ul>
                                <li><a href="./timeline.php">English</a></li>
                                <li><a href="./timeline_amh.php">Amharic</a></li>
                                <li><a href="#">Oromiffa</a></li>
                            </ul>
                        </div>
                        <!-- End .header-menu -->
                    </div>
                    <!-- End .header-dropdown -->
                </div>
                <!-- End .header-left -->

                <div class="header-right">
                    <ul class="top-menu">
                        <li>
                            <a href="#">Links</a>
                            <ul>
                                <li><a href="tel:#"><i class="icon-phone"></i>Call: +251911428051</a></li>
                                <li><a href="about.php">About Us</a></li>
                                <li><a href="contact.php">Contact Us</a></li>
                                <li><a href="../profile/home.php" data-toggle="modal"><i class="icon-user"></i>Profile</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- End .top-menu -->
                </div>
                <!-- End .header-right -->
            </div>
            <!-- End .container -->
        </div>
        <!-- End .header-top -->

        <div class="sticky-wrapper">
            <div class="header-middle sticky-header">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler active">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>

                        <a href="timeline.php" class="logo">
                            <img src="../resources/images/icons/Group 21.png" alt="Edir Logo" width="105" height="25">
                        </a>

                        <nav class="main-nav">
                            <ul class="menu" style="touch-action: pan-y;">
                                
                                <li class="">
                                    <a href="timeline.php" class="">Timeline</a>
                                    <!-- End .megamenu megamenu-md -->
                                </li>
                                <li class="">
                                    <a href="product.php" class="">Service</a>
                                    <!-- End .megamenu megamenu-sm -->
                                </li>
                                <li>
                                    <a href="event.php" class="">Events</a>
                                </li>
                                <li>
                                <a href="members.php" class="">Members</a>
                                </li>
                                
                                
                            </ul>
                            <!-- End .menu -->
                        </nav>
                        <!-- End .main-nav -->
                    </div>
                    <!-- End .header-left -->

                    <div class="header-right">
                        <div class="header">
                            <a href="makeEvent.php" class="btn btn-danger rounded" role="button"><i class="icon-edit"></i>Make Event</a>
                        </div>
                        <!-- End .header-search -->

                        <!-- End .compare-dropdown -->

                        <div class="dropdown cart-dropdown">
                            <a href="cart.php" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <i class="icon-shopping-cart"></i>
                                <span class="cart-count"><?=$total_cart?></span>
                            </a>

                            <div class="menu menu-right">
                                <!-- purchase link -->
                            </div>
                            <!-- End .dropdown-menu -->
                        </div>
                        <!-- End .cart-dropdown -->
                    </div>
                    <!-- End .header-right -->
                </div>
                <!-- End .container -->
            </div>
        </div>
        <!-- End .header-middle -->
    </header>
    <main>
