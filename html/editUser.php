<?php
session_start ();

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
//   if(isset($_POST['register']))

if (isset($_GET['user'])) {
    $user_id = $_GET['user'];
}
else{
    echo "incorrect user";
}

$fetch_sql = "SELECT * FROM user where user_id = '$user_id' limit 1";
$fetch_result = mysqli_query($connection, $fetch_sql);
if(mysqli_num_rows($fetch_result)==1){
    $fetch_row = mysqli_fetch_array($fetch_result);
}

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["update"]))
  {
    $fName= $_POST['fName'];
    $mName = $_POST['mName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phoneNo = $_POST['phoneNo'];
    $houseNum=$_POST['houseNum'];
    $password = $_POST['password'];

    $query="UPDATE user SET fname='$fName', mName='$mName', lName='$lName', email='$email', gender='$gender', city='$address', phoneNo='$phoneNo', houseNum='$houseNum', password='$password' where user_id='$user_id';";

    if(mysqli_query($connection, $query))
    {
        echo "Form Inserted Succesfully!";
        header("location:basic-table.php");
    }
     
      mysqli_close($connection);
  }

  if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["delete"]))
  {
   

    $query="DELETE from user where user_id='$user_id';";

    if(mysqli_query($connection, $query))
    {
        echo "Form Deleted Succesfully!";
        header("location:basic-table.php");
    }
     
      mysqli_close($connection);
  }

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="robots" content="noindex,nofollow" />
    <title>Edir Site Admin Dashboard</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png" />
    <!-- Custom CSS -->
    <link href="plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css" />
    <!-- Custom CSS -->
    <link href="css/style.min.css" rel="stylesheet" />
</head>

<body>
    
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard.html" aria-expanded="false">
                                <i class="far fa-clock" aria-hidden="true"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile.php" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="hide-menu">Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="basic-table.php" aria-expanded="false">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                <span class="hide-menu">Basic Table</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>

        <div class="page-wrapper">
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Profile page</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="#" class="fw-normal">Dashboard</a></li>
                            </ol>
                            <a href="../view/login.php" target="_blank" class="
                    btn btn-danger
                    d-none d-md-block
                    pull-right
                    ms-3
                    hidden-xs hidden-sm
                    waves-effect waves-light
                    text-white
                  ">Log out</a
                >
              </div>
            </div>
          </div>
          <!-- /.col-lg-12 -->
        </div>
        <div class="container-fluid">
          <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-12">
              <div class="white-box">
                <div class="user-bg">
                  <img
                    width="100%"
                    alt="user"
                    src="plugins/images/large/img1.jpg"
                  />
                  <div class="overlay-box">
                    <div class="user-content">
                      <a href="javascript:void(0)"
                        ><img
                          src="plugins/images/users/genu.jpg"
                          class="thumb-lg img-circle"
                          alt="img"/></a>
                            <h4 class="text-white mt-2">User Name</h4>
                            <h5 class="text-white mt-2">info@myadmin.com</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal form-material" method="POST">
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">First Name:</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" name="fName" value="<?php echo $fetch_row['fName'];?>" class="form-control p-0 border-0" />
                            </div>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">middle Name:</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input name="mName" type="text" value="<?php echo $fetch_row['mName'];?>" class="form-control p-0 border-0" />
                            </div>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Last Name:</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input name="lName" type="text" value="<?php echo $fetch_row['lName'];?>" class="form-control p-0 border-0" />
                            </div>
                        </div>
                       
                        <div class="form-group mb-4">
                            <label class="col-sm-12">Gender: </label>

                            <div class="col-sm-12 border-bottom">
                                <select name="gender" class="
                                    form-select
                                    shadow-none
                                    p-0
                                    border-0
                                    form-control-line
                                ">
                                <option <?php if($fetch_row['gender']=="male"){echo 'selected';}?>>Male</option>
                                <option <?php if($fetch_row['gender']=="female"){echo 'selected';}?>>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                                <label for="example-email" class="col-md-12 p-0">Email: </label>
                          <div class="col-md-12 border-bottom p-0">
                            <input name="email"
                              type="email"
                                value="<?php echo $fetch_row['email'];?>"
                              class="form-control p-0 border-0"
                            />
                          </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Address:</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input name="address" type="text" value="<?php echo $fetch_row['city'];?>" class="form-control p-0 border-0" />
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Phone No: </label>
                            <div class="col-md-12 border-bottom p-0">
                                <input name="phoneNo" type="text" value="<?php echo $fetch_row['phoneNo'];?>" class="form-control p-0 border-0" />
                            </div>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">House Number:</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input name="houseNum" type="text" value="<?php echo $fetch_row['houseNum'];?>" class="form-control p-0 border-0" />
                            </div>
                        </div>

                    <div class="form-group mb-4">
                      <label class="col-md-12 p-0">Password: </label>
                            <div class="col-md-12 border-bottom p-0">
                                <input name="password" type="password" value="<?php echo $fetch_row['password'];?>" class="form-control p-0 border-0" />
                            </div>
                        </div>
                       
                        <div class="form-group mb-4">
                            <div class="col-sm-12">
                                <button name="update" class="btn btn-success">Update Profile</button>
                                <button name="delete" class="btn btn-success">Delete Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>

    </div>
    
    <footer class="footer text-center">
        2022 © Edir Admin brought to you by
        <a href="#">G4-developers.com</a>
    </footer>
    
    </div>
    </div>
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
</body>

</html>