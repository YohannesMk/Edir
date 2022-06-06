<?php
    require_once 'header.php';
    require_once '../controller/connect.php';
    require_once '../controller/functions.php';
    
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

if (isset($_GET['cat'])) {
    $cat = $_GET['cat'];
    $sql = "SELECT * FROM eventpost where eventType = '$cat' LIMIT $offset, $no_of_records_per_page";

    if(isset($_GET['search'])){
        $search = $_GET['search'];

        if(!empty($search)){
            $sql = "SELECT * FROM eventpost where title like '%$search%' AND eventType = '$cat' LIMIT $offset, $no_of_records_per_page";
        }
    }
    
    if($cat == '' || $cat == 'all'){
        $sql = "SELECT * FROM eventpost LIMIT $offset, $no_of_records_per_page";
        
        if(!empty($search)){
            $sql = "SELECT * FROM eventpost where title like '%$search%' LIMIT $offset, $no_of_records_per_page";
        }
    }
    
  } else {
    $cat = 'all';
    $sql = "SELECT * FROM eventpost LIMIT $offset, $no_of_records_per_page";

    if(isset($_GET['search'])){
        $search = $_GET['search'];

        if(!empty($search)){
            $sql = "SELECT * FROM eventpost where title like '%$search%' LIMIT $offset, $no_of_records_per_page";
        }
    }
  }
  
$res_data = mysqli_query($connection,$sql);

?>
<div class="page-header text-center" style="background-image: url('../resources/images/edir-hero.jpg')">
    <div class="container">
        <h1 class="page-title" style="color:orange;">Event POST</h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->

<div class="page-content">
<section class="about py-5" id="about">
    <div class="container">

      <div class="row">
        <div class="col-10 mx-auto col-md-6 my-5">
          <h1 class="text-capitalize">about <strong class="banner-title ">us</strong></h1>
          <p class="my-4 text-muted w-75">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit, aliquam voluptas
            beatae vitae expedita consectetur nesciunt quia deserunt asperiores facere fuga dicta fugiat corrupti et omnis
            porro at dolorum! Ad!</p>
          <a href="#" class="btn btn-outline-secondary btn-black text-uppercase ">explore</a>

        </div>
        <div class="col-10 mx-auto col-md-6 align-self-center my-5">
          <div class="about-img__container">
            <img src="../assets/image/product-6-2.jpg" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>

    <div class="container">
         <!-- section title -->
      <div class="row">
        <div class="col-10 mx-auto col-sm-6 text-center">
          <h1 class="text-capitalize">Recent <strong class="banner-title ">EVENTS</strong></h1>
        </div>
      </div>
      <!-- end of section title -->
      <!--filter buttons -->
      <div class="row">
        <div class=" col-lg-8 mx-auto d-flex justify-content-around my-2 sortBtn flex-wrap">
          <a href="?cat=all" class="btn btn-outline-secondary  filter-btn m-2" data-filter="all">All</a>
          <a href="?cat=graduation" class="btn btn-outline-secondary  filter-btn m-2" data-filter="all">Graduation</a>
          <a href="?cat=wedding" class="btn btn-outline-secondary btn-black text-uppercase filter-btn m-2" data-filter="cakes">Wedding</a>
          <a href="?cat=funeral" class="btn btn-outline-secondary btn-black text-uppercase filter-btn m-2" data-filter="cupcakes">Funeral</a>
          <a href="?cat=other" class="btn btn-outline-secondary btn-black text-uppercase filter-btn m-2" data-filter="sweets">Other</a>
        </div>
      </div>
      <div class="row">
        <div class="col-10 mx-auto col-md-6">
          <form method="get">
            <div class="input-group mb-3">
              <div class="input-group-prepend ">
                <span class="input-group-text search-box" id="search-icon"><i class="icon-search"></i></span>
              </div>
              <input type="text" name="search" class="form-control" placeholder='event....' id="search-item">
            </div>
          </form>
        </div>
      </div>
      <!-- search box -->
      <div class="row" id="post">
        <div class="entry-container max-col-3 mt-2" data-layout="fitRows">
            <?php
            while($rows = mysqli_fetch_array($res_data)){
                ?>
            <div class="entry-item shadow m-1">
                <article class="entry entry-grid text-center">
                    <figure class="entry-media">
                        <a href="single.html">
                            <img src="../assets/image/<?php echo $rows['filename']?>" alt="image desc">
                        </a>
                    </figure><!-- End .entry-media -->

                    <div class="entry-body">
                        <div class="entry-meta">
                            <a href="#"><?= $rows['date_updated']?></a>
                            <span class="meta-separator">|</span>
                            <a href="#">by <?php
                                $ret = relateUser($connection,$rows);
                                echo $ret["fName"];
                            ?></a>
                        </div><!-- End .entry-meta -->

                        <h2 class="entry-title">
                            <a href="single.html"><?= $rows['title']?></a>
                        </h2><!-- End .entry-title -->

                        <div class="entry-cats">
                            <a href="#"><?= $rows['eventType']?></a>
                        </div><!-- End .entry-cats -->

                        <div class="entry-content">
                            <p><?php echo $rows['eventDescription']?></p>
                            <a href="single.html" class="read-more">Get Teri-Card</a>
                        </div><!-- End .entry-content -->
                    </div><!-- End .entry-body -->
                </article><!-- End .entry -->
            </div><!-- End .entry-item -->
            <?php
                }
                mysqli_close($connection);
            ?>
        </div>
    </div>
    <div class="mt-3">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
            <li class="page-item active">
                <a class="page-link" href="?pageno=1&cat=<?=$cat?><?php if(!empty($search)){echo "&search=".$search;} ?>#post" tabindex="-1">First</a>
            </li>
            <li class="page-item active <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                <a class="page-link" href="<?php if($pageno <= 1){ echo '#post'; } else { echo "?pageno=".($pageno - 1); } ?>&cat=<?=$cat?><?php if(!empty($search)){echo "&search=".$search;} ?>#">Prev</a>
            </li>
            <li class="page-item active <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#post'; } else { echo "?pageno=".($pageno + 1); } ?>&cat=<?=$cat?><?php if(!empty($search)){echo "&search=".$search;} ?>#post">Next</a>
            </li>
            <li class="page-item active">
            <a class="page-link" href="?pageno=<?php echo $total_pages; ?>&cat=<?=$cat?><?php if(!empty($search)){echo "&search=".$search;} ?>#post">Last</a>
            </li>
            </ul>
        </nav>
    </div>
</div>

<?= require_once 'footer.php'?>