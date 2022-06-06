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
    <link href="css/style.min.css" rel="stylesheet"/>

</head>

<body>
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
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="user-table.php" aria-expanded="false">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                <span class="hide-menu">User Table</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="event-table.php" aria-expanded="false">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                <span class="hide-menu">Event Table</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="service-table.php" aria-expanded="false">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                <span class="hide-menu">Service Table</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="rental-table.php" aria-expanded="false">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                <span class="hide-menu">Rental Table</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="create-timeline.php" aria-expanded="false">
                                <i class="fa fa-event" aria-hidden="true"></i>
                                <span class="hide-menu">Create Timeline</span>
                            </a>
                        </li>                        
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="create-product.php" aria-expanded="false">
                                <i class="fa fa-event" aria-hidden="true"></i>
                                <span class="hide-menu">Create Service Product</span>
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
                    
                    <div class="col-lg-4 col-sm-8 col-md-6 col-xs-12 center">
                        <form role="search" class="app-search d-none d-md-block me-3">
                            <input type="text" name="search" placeholder="Search..." class="form-control mt-3">
                        </form>
                    </div>

                    <div class="col-lg-5 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                        <ol class="breadcrumb ms-auto">
                            <li><a>dashboard</a></li>
                        </ol>
                        <href="../view/login.php" target="_blank" class="
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
