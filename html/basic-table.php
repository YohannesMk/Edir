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

$sql = "SELECT * FROM user";
$result = mysqli_query($connection, $sql);

$sql1 = "SELECT * From eventPost";
$result1 = mysqli_query($connection, $sql1);

$sql3 = "SELECT * From service";
$result2 = mysqli_query($connection,$sql3);

$sql4 = "SELECT * From purchase";
$result3 = mysqli_query($connection,$sql4);


if(isset($_GET['search']))
  {
   $search = $_GET['search'];
  
    $query="SELECT * FROM user where fName like '%$search%' OR mName like '%$search%' OR lName like '%$search%' OR email like '%$search%'";
    $result = mysqli_query($connection, $query);
    if($result)
    {
        echo "Form Inserted Succesfully!";
    }
     
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
                            <h4 class="page-title">Basic Table</h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <div class="d-md-flex">
                                <ol class="breadcrumb ms-auto">
                                  <li><a>dashboard</a></li>
                                </ol>
                                <a href="../view/login.php" target="_blank" class="
                    btn btn-danger
                    d-none d-md-block
                    pull-right
                    ms-3
                    hidden-xs hidden-sm
                    waves-effect waves-light
                    text-white
                  ">Log Out</a
                >
              </div>
            </div>
          </div>
          <!-- /.col-lg-12 -->
        </div>
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="white-box">
                <div class="row align-items-center">
                  <h3 class="box-title">User Table</h3>
                <!-- <p class="text-muted">Add class <code>.table</code></p> -->
                  <form method="GET">
                    <input name="search" type="search" class="form-control mt-0">
                  </form>

                  <form action="../controller/export.php" method="POST">
                    <input name="eventcsv" type="submit" value="export">
                  </form>
                </div>
              
                <div class="table-responsive">
                  <table class="table text-nowrap">
                    <thead>
                      <tr>
                        <th class="border-top-10"></th>
                        <th class="border-top-0"></th>
                        <th class="border-top-0">User Id</th>
                        <th class="border-top-0">First Name</th>
                        <th class="border-top-0">Middle Name</th>
                        <th class="border-top-0">Last Name</th>
                        <th class="border-top-0">Email</th>
                        <th class="border-top-0">DOB</th>
                        <th class="border-top-0">Gender</th>
                        <th class="border-top-0">Address</th>
                        <th class="border-top-0">Phone No.</th>
                        <th class="border-top-0">House No.</th>
                        <th class="border-top-0">password</th> 
                        <th class="border-top-0">date_joined</th> 
                      </tr>
                    </thead>
                    <tbody>
                    
                    <?php   // LOOP TILL END OF DATA 
                        while($rows = mysqli_fetch_array($result))
                      { 
                      ?>
                      <tr>
                        <td>
                          <div class="col-sm-6 col-md-6 col-lg-3 f-icon">
                           <a href="editUser.php?user=<?=$rows['user_id']?> "><i class="far fa-edit"></i><span>edit</span></a>
                          </div>
                        <td>
                        <td contenteditable="true"><?php echo $rows['user_id']?></td>
                        <td><?php echo $rows['fName']?></td>
                        <td><?php echo $rows['mName']?></td>  
                        <td><?php echo $rows['lName']?></td>
                        <td><?php echo $rows['email']?></td>
                        <td><?php echo $rows['dob']?></td>
                        <td><?php echo $rows['gender']?></td>
                        <td><?php echo $rows['city']?></td>
                        <td><?php echo $rows['phoneNo']?></td>
                        <td><?php echo $rows['houseNum']?></td>
                        <td><?php echo $rows['password']?></td>
                        <td><?php echo $rows['date_joined']?></td>
                      </tr>
                      <?php
                          }
                         ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-sm-12">
              <div class="white-box">
                <h3 class="box-title">Event Table</h3>
                <!-- <p class="text-muted">Add class <code>.table</code></p> -->
                <div class="table-responsive">
                  <table class="table text-nowrap">
                    <thead>
                      <tr>
                        <th class="border-top-0">User Id</th>
                        <th class="border-top-0">Title</th>
                        <th class="border-top-0">Event Type</th>
                        <th class="border-top-0">Event Description</th>
                        <th class="border-top-0">DOE</th>
                        <th class="border-top-0">Date Updated</th>
                        <th class="border-top-0">Slug</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    <?php   // LOOP TILL END OF DATA 
                      while($rows = mysqli_fetch_array($result1))
                      { 
                      ?>
                      <tr>
                        <td><?php echo $rows['user_id']?></td>
                        <td><?php echo $rows['title']?></td>
                        <td><?php echo $rows['eventType']?></td>
                        <td><?php echo $rows['eventDescription']?></td>
                        <td><?php echo $rows['doe']?></td>
                        <td><?php echo $rows['date_updated']?></td>
                        <td><?php echo $rows['slug']?></td>
                      </tr>
                      <?php
                          }
                         ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-sm-12">
              <div class="white-box">
                <h3 class="box-title">Service Table</h3>
                <!-- <p class="text-muted">Add class <code>.table</code></p> -->
                <div class="table-responsive">
                  <table class="table text-nowrap">
                    <thead>
                      <tr>
                        <th class="border-top-0">Item Id</th>
                        <th class="border-top-0">Item Name</th>
                        <th class="border-top-0">Description</th>
                        <th class="border-top-0">Quantity</th>
                        <th class="border-top-0">Price</th>
                        <th class="border-top-0">Date Updated</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    <?php   // LOOP TILL END OF DATA 
                      while($rows = mysqli_fetch_array($result2))
                      { 
                      ?>
                      <tr>
                        <td><?php echo $rows['item_id']?></td>
                        <td><?php echo $rows['itemName']?></td>
                        <td><?php echo $rows['description']?></td>
                        <td><?php echo $rows['quantity']?></td>
                        <td><?php echo $rows['price']?></td>
                        <td><?php echo $rows['date_updated']?></td>
                      </tr>
                      <?php
                          }
                         ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-sm-12">
              <div class="white-box">
                <h3 class="box-title">Purchase Table</h3>
                <!-- <p class="text-muted">Add class <code>.table</code></p> -->
                <div class="table-responsive">
                  <table class="table text-nowrap">
                    <thead>
                      <tr>
                        <th class="border-top-0">User Id</th>
                        <th class="border-top-0">Item Id</th>
                        <th class="border-top-0">Price</th>
                        <th class="border-top-0">Date Purchase</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    <?php   // LOOP TILL END OF DATA 
                      while($rows = mysqli_fetch_array($result3))
                      { 
                      ?>
                      <tr>
                        <td><?php echo $rows['user_id']?></td>
                        <td><?php echo $rows['item_id']?></td>
                        <td><?php echo $rows['price']?></td>
                        <td><?php echo $rows['date_purchase']?></td>

                      </tr>
                      <?php
                          }
                         ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center">
          2021 © Ample Admin brought to you by
          <a href="https://www.wrappixel.com/">wrappixel.com</a>
                                </footer>
                                <!-- ============================================================== -->
                                <!-- End footer -->
                                <!-- ============================================================== -->
                            </div>
                            <!-- ============================================================== -->
                            <!-- End Page wrapper  -->
                            <!-- ============================================================== -->
                        </div>
                        <!-- ============================================================== -->
                        <!-- End Wrapper -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- All Jquery -->
                        <!-- ============================================================== -->
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