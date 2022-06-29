<?php
    require_once 'header_Amh.php';
    require_once '../controller/connect.php';
    require_once '../controller/functions.php';
    require_once '../controller/validator.php';
    
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

$no_of_records_per_page = 6;
$offset = ($pageno-1) * $no_of_records_per_page;


$total_pages_sql = "SELECT COUNT(*) FROM user ORDER BY date_joined DESC";
$result = mysqli_query($connection,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT * FROM user ORDER BY date_joined DESC LIMIT $offset, $no_of_records_per_page";

if(isset($_GET['search'])){
  $search = test_input($_GET['search']);

  if(!empty($search)){
      $sql = "SELECT * FROM user where fName like '%$search%' OR  lName like '%$search%' ORDER BY date_joined DESC LIMIT $offset, $no_of_records_per_page";
  }
} else {
    
    $sql = "SELECT * FROM user ORDER BY date_joined DESC LIMIT $offset, $no_of_records_per_page";

  }
  
$res_data = mysqli_query($connection,$sql);

?>
<div class="page-header text-center" style="background-image: url('../resources/images/edir-hero.jpg')">
    <div class="container">
        <h1 class="page-title font-weight-bold" STYLE="color: orange">አባላት</h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->

<div class="page-content">
  <section class="about py-5" id="about">
    <div class="container">

      <div class="row">
        <div class="col-10 mx-auto col-md-6 my-5">
          <h1 class="text-capitalize">እድር <strong class="banner-title ">አባላት</strong></h1>
          <p class="my-4 text-muted w-75">ይህ እያንዳንዱን የእድር አባል የሚያገኙበት ገፅ ነው።</p>
          <a href="#exp" class="btn btn-outline-secondary btn-black text-uppercase ">ይጎብኝ</a>

        </div>
        <div class="col-10 mx-auto col-md-6 align-self-center my-5">
          <div class="about-img__container">
            <img src="../resources/images/edir-hero.jpg" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>

    <div class="container">
         <!-- section title -->
      <div class="row">
        <div class="col-10 mx-auto col-sm-6 text-center">
          <h1 class="text-capitalize" id="exp" STYLE= "color: white" >እድር <strong class="banner-title ">አባላት</strong></h1>
        </div>
      </div>
      <!-- end of section title -->
      <!--filter buttons -->
      <div class="row">
        <div class="col-10 mx-auto col-md-6">
          <form method="get">
            <div class="input-group mb-3">
              <div class="input-group-prepend ">
                <span class="input-group-text search-box" id="search-icon"><i class="icon-search"></i></span>
              </div>
              <input type="text" name="search" class="form-control" placeholder='አባላት....' id="search-item">
            </div>
          </form>
        </div>
      </div>
      <!-- search box -->
      <div class="row">
        
        <div class="container">
          <div class="row justify-content-center" id="post">
            <?php
                while($rows = mysqli_fetch_array($res_data)){
                  ?>
                     <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                      <div class="card shadow mb-4">
                        <div class="card-body justify-content-center text-center">
                          <img src="../profile/uploaded_img/<?= $rows['profile']?>" alt="avatar"
                            class="rounded-circle  img-fluid" style="width: 150px;">
                          <h5 class="my-3"><?= $rows['fName']." ".$rows['lName']?></h5>
                          <p class="text-muted mb-1">አድራሻ: <?= $rows['address']?></p>
                          <p class="text-muted mb-4">ስልክ ቁጥር: <?= $rows['phoneNo']?></p>
                        </div>
                      </div>
                     </div>
                <?php
                    }
                    mysqli_close($connection);
                ?>
          </div>
        </div>
      </div>

    <div class="mt-3">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
            <li class="page-item active">
                <a class="page-link" href="?pageno=1<?php if(!empty($search)){echo "&search=".$search;} ?>#post" tabindex="-1">መጀመሪያ</a>
            </li>
            <li class="page-item active <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                <a class="page-link" href="<?php if($pageno <= 1){ echo '#post'; } else { echo "?pageno=".($pageno - 1); } ?><?php if(!empty($search)){echo "&search=".$search;} ?>#">ቀዳሚ</a>
            </li>
            <li class="page-item active <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#post'; } else { echo "?pageno=".($pageno + 1); } ?><?php if(!empty($search)){echo "&search=".$search;} ?>#post">ቀጥሎ</a>
            </li>
            <li class="page-item active">
            <a class="page-link" href="?pageno=<?php echo $total_pages; ?><?php if(!empty($search)){echo "&search=".$search;} ?>#post">የመጨረሻ</a>
            </li>
            </ul>
        </nav>
    </div>
</div>

<?= require_once 'footer_Amh.php'?>