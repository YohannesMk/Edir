<?php
    require_once 'header.php';
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


$total_pages_sql = "SELECT COUNT(*) FROM eventPost ORDER BY doe DESC";
$result = mysqli_query($connection,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT * FROM eventPost ORDER BY doe DESC LIMIT $offset, $no_of_records_per_page";

if (isset($_GET['cat'])) {
    $cat = $_GET['cat'];
    $sql = "SELECT * FROM eventpost where eventType = '$cat' ORDER BY doe DESC LIMIT $offset, $no_of_records_per_page";

    if(isset($_GET['search'])){
        $search = test_input($_GET['search']);

        if(!empty($search)){
            $sql = "SELECT * FROM eventpost where title like '%$search%' AND eventType = '$cat' ORDER BY doe DESC LIMIT $offset, $no_of_records_per_page";
        }
    }
    
    if($cat == '' || $cat == 'all'){
        $sql = "SELECT * FROM eventpost ORDER BY doe DESC LIMIT $offset, $no_of_records_per_page";
        
        if(!empty($search)){
            $sql = "SELECT * FROM eventpost where title like '%$search%' ORDER BY doe DESC LIMIT $offset, $no_of_records_per_page";
        }
    }
    
  } else {
    $cat = 'all';
    $sql = "SELECT * FROM eventpost ORDER BY doe DESC LIMIT $offset, $no_of_records_per_page";

    if(isset($_GET['search'])){
        $search = test_input($_GET['search']);

        if(!empty($search)){
            $sql = "SELECT * FROM eventpost where title like '%$search%' ORDER BY doe DESC LIMIT $offset, $no_of_records_per_page";
        }
    }
  }
  
$res_data = mysqli_query($connection,$sql);

?>
<div class="page-header text-center" style="background-image: url('../resources/images/arts.jpg'); ">
    <div class="container">
        <h1 class="page-title font-weight-bold" STYLE="color: Black">Event POST</h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->

<div class="page-content">
  <section class="about py-5" id="about">
    <div class="container">

      <div class="row">
        <div class="col-10 mx-auto col-md-6 my-5">
          <h1 class="text-capitalize">Edir <strong class="banner-title ">Events</strong></h1>
          <p class="my-4 text-muted w-75">Here, in the Edir Events page, you can see coming events that are posted by the edir
            members. In addition to this, you can create and edit events of your own and attach an invitation card (ጥሪ ወረቀት) in which 
            users can download and use it as an entrance paper.
          </p>
          <a href="#events" class="btn btn-outline-secondary btn-black text-uppercase ">explore</a>

        </div>
        <div class="col-10 mx-auto col-md-6 align-self-center my-5">
          <div class="about-img__container">
            <img src="../resources/images/events2.jpg" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>

    <div class="container">
         <!-- section title -->
      <div class="row" id = events>
        <div class="col-10 mx-auto col-sm-6 text-center">
          <h1 class="text-capitalize">Recent <strong class="banner-title ">EVENTS</strong></h1>
        </div>
      </div>
      <!-- end of section title -->
      <!--filter buttons -->
      <div class="row">
        <div class=" col-lg-8 mx-auto d-flex justify-content-around my-2 sortBtn flex-wrap">
          <a href="event.php" class="btn btn-outline-secondary  filter-btn m-2" data-filter="all">All</a>
          <a href="?cat=graduation<?php if(!empty($search)){echo '&search='.$search;}?>" class="btn btn-outline-secondary  filter-btn m-2" data-filter="all">Graduation</a>
          <a href="?cat=wedding<?php if(!empty($search)){echo '&search='.$search;}?>" class="btn btn-outline-secondary btn-black text-uppercase filter-btn m-2" data-filter="Wedding">Wedding</a>
          <a href="?cat=funeral<?php if(!empty($search)){echo '&search='.$search;}?>" class="btn btn-outline-secondary btn-black text-uppercase filter-btn m-2" data-filter="Funeral">Funeral</a>
          <a href="?cat=other<?php if(!empty($search)){echo '&search='.$search;}?>" class="btn btn-outline-secondary btn-black text-uppercase filter-btn m-2" data-filter="Other">Other</a>
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
      <div class="row">
        
        <div class="products">
          <div class="row justify-content-center" id="post">
            <?php
                while($rows = mysqli_fetch_array($res_data)){
                  ?>
                  <div class="col-6 col-md-4 col-lg-4 col-xl-3" data-layout="fitRows">
                <div class="product product-7 text-center">
                    <article class="entry entry-grid text-center">
                        <figure class="entry-media">
                            <a>
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
                                <span class="meta-separator">|</span>
                                <a href="editEvent.php?slug=<?=$rows['slug']?>"><?php if($_SESSION['user_id']==$rows['user_id']){echo 'edit';}?></a>
                            </div>
  
                            <h2 class="entry-title">
                                <a href="single.html"><?= $rows['title']?></a>
                            </h2><!-- End .entry-title -->
  
                            <div class="entry-cats">
                                <a href="#"><?= $rows['eventType']?></a>
                            </div><!-- End .entry-cats -->
  
                            <div class="entry-content">
                                <p><?php echo $rows['eventDescription']?></p>
                                <a href="?file=<?= $rows['filename']?>" class="read-more">Get Teri-Card</a>
                            </div><!-- End .entry-content -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->
                </div><!-- End .entry-item -->
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