<?php
  require_once '../controller/connect.php';
  require_once("header_Amh.php");
  require_once '../controller/validator.php';

  if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
  } else {
    $pageno = 1;
  }

  
$no_of_records_per_page = 6;
$offset = ($pageno-1) * $no_of_records_per_page;


$total_pages_sql = "SELECT COUNT(*) FROM service";
$result = mysqli_query($connection,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

if (isset($_GET['cat'])) {
  $cat = $_GET['cat'];
  $sql = "SELECT * FROM service where itemName = '$cat' ORDER BY date_updated DESC LIMIT $offset, $no_of_records_per_page";

  if(isset($_GET['search'])){
    $search = test_input($_GET['search']);

    if(!empty($search)){
        $sql = "SELECT * FROM service where itemName like '%$search%' AND itemName = '$cat' ORDER BY date_updated DESC LIMIT $offset, $no_of_records_per_page";
    }
}

  if($cat == '' || $cat == 'all'){
  $sql = "SELECT * FROM service ORDER BY date_updated DESC LIMIT $offset, $no_of_records_per_page";

  if(!empty($search)){
    $sql = "SELECT * FROM service WHERE itemName like '%$search%' ORDER BY date_updated DESC LIMIT $offset, $no_of_records_per_page";
  }
}
  
} else {
  $cat = 'all';
  $sql = "SELECT * FROM service ORDER BY date_updated DESC LIMIT $offset, $no_of_records_per_page";

  if(isset($_GET['search'])){
    $search = test_input($_GET['search']);

    if(!empty($search)){
        $sql = "SELECT * FROM service WHERE itemName like '%$search%' ORDER BY date_updated DESC LIMIT $offset, $no_of_records_per_page";
    }
}
}

$res_data = mysqli_query($connection,$sql);

?>
  
  <section class="about py-5" id="about">
    <div class="container" >

      <div class="row">
        <div class="col-10 mx-auto col-md-6 my-5">
          <h1 class="text-capitalize">የእኛ <strong class="banner-title ">አገልግሎቶች</strong></h1>
          <p class="my-4 text-muted w-75">የእኛ ኢዲር በ ውስጥ ጥቅም ላይ የዋሉ ቁሳቁሶች የተለያዩ የኪራይ አገልግሎቶችን ይሰጣል
             ዝግጅቶችን ማደራጀት. ለኪራይ ከሚገኙት ዋና ዋና እቃዎች መካከል ዘመናዊ እና ባህላዊ ያካትታሉ
             ጎጆዎች (ዲንኳን), ምግቦች, ወንበሮች እና የተለያዩ የማብሰያ እቃዎች. <br>
             ስለመረጡን እናመሰግናለን!</p>
          <a href="#store" class="btn btn-outline-secondary btn-black text-uppercase ">ይጎብኝ</a>

        </div>
        <div class="col-10 mx-auto col-md-6 align-self-center my-5">
          <div class="about-img__container">
            <img src="../resources/images/decoration2.jpg" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end of about us -->
  <!-- store -->
  <section id="store" class="store py-5">
    <div class="container">
      <!-- section title -->
      <div class="row">
        <div class="col-10 mx-auto col-sm-6 text-center">
          <h1 class="text-capitalize">የእኛ <strong class="banner-title ">መደብር</strong></h1>
        </div>
      </div>
      <!-- end of section title -->
      <!--filter buttons -->
      <div class="row">
        <div class=" col-lg-8 mx-auto d-flex justify-content-around my-2 sortBtn flex-wrap">
          <a href="product_Amh.php" class="btn btn-outline-secondary  filter-btn m-2" data-filter="all">ሁሉም</a>
          <a href="?cat=dish<?php if(!empty($search)){echo '&search='.$search;}?>" class="btn btn-outline-secondary  filter-btn m-2" data-filter="Dish">ሳህኖች</a>
          <a href="?cat=dinkuan<?php if(!empty($search)){echo '&search='.$search;}?>" class="btn btn-outline-secondary btn-black text-uppercase filter-btn m-2" data-filter="Dinkuan">ዲንኳን</a>
          <a href="?cat=chair<?php if(!empty($search)){echo '&search='.$search;}?>" class="btn btn-outline-secondary btn-black text-uppercase filter-btn m-2" data-filter="Chair">ወንበሮች</a>
          <a href="?cat=other<?php if(!empty($search)){echo '&search='.$search;}?>" class="btn btn-outline-secondary btn-black text-uppercase filter-btn m-2" data-filter="Other">ሌሎች</a>
        </div>
      </div>
      <!-- search box -->
      <div class="row">
        <div class="col-10 mx-auto col-md-6">
          <form>
            <div class="input-group mb-3">
              <div class="input-group-prepend ">
                <span class="input-group-text search-box" id="search-icon"><i class="icon-search"></i></span>
              </div>
              <input type="text" class="form-control" name="search" placeholder=' ....' id="search-item">
            </div>
          </form>
        </div>
      </div>
      <!--end of filter buttons -->
      <!-- store  items-->
      <div class="row" class="store-items" id="store-items">  
        <?php
            while($rows = mysqli_fetch_array($res_data)){
              ?>
          <div class="col-10 col-sm-6 col-lg-4 mx-auto my-3 store-item cakes" data-item="service">
            <div class="card">
              <a href="product_detail_Amh.php?id=<?=$rows['item_id'];?>">
              <div class="img-container">
                <img src="../assets/image/service/<?= $rows['filename']?>" class="card-img-top store-img" alt="">
                <span class="store-item-icon">
                  <i class="fas fa-shopping-cart"></i>
                </span>
              </div>
              </a>
              <div class="card-body">
                <div class="card-text d-flex justify-content-between text-capitalize">
                  <h5 id="store-item-name"><?php echo $rows['itemName']?></h5>
                  <h5 class="store-item-value">$<strong id="store-item-price" class="font-weight-bold"><?php echo $rows['price']?></strong></h5>
                </div>
              </div>
            </div>
            <!-- end of card-->
          </div>

          <?php
            }
            mysqli_close($connection);
            ?>
      </div>
    </div>
  </section>
  <!--end of store items -->
  <nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
      <li class="page-item active">
        <a class="page-link" href="?pageno=1&cat=<?=$cat?><?php if(!empty($search)){echo '&search='.$search;}?>#store" tabindex="-1">መጀመሪያ</a>
      </li>
      <li class="page-item active <?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a class="page-link" href="<?php if($pageno <= 1){ echo '#store'; } else { echo "?pageno=".($pageno - 1); } ?>&cat=<?=$cat?><?php if(!empty($search)){echo '&search='.$search;}?>#store">ቀዳሚ</a>
      </li>
      <li class="page-item active <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#store'; } else { echo "?pageno=".($pageno + 1); } ?>&cat=<?=$cat?><?php if(!empty($search)){echo '&search='.$search;}?>#store">ቀጥሎ</a>
      </li>
      <li class="page-item active">
      <a class="page-link" href="?pageno=<?php echo $total_pages; ?>&cat=<?=$cat?><?php if(!empty($search)){echo '&search='.$search;}?>#store">መጨረሻ</a>
      </li>
    </ul>
  </nav>
  <!-- modal-container -->
  <div class="container-fluid ">
    <div class="row lightbox-container align-items-center">
      <div class="col-10 col-md-10 mx-auto text-right lightbox-holder">
        <span class="lightbox-close"><i class="fas fa-window-close"></i></span>
        <div class="lightbox-item"></div>
        <span class="lightbox-control btnLeft"><i class="fas fa-caret-left"></i></span>
        <span class="lightbox-control btnRight"><i class="fas fa-caret-right"></i></span>
      </div>

    </div>
  </div>

<?php 
  require_once 'footer_Amh.php' 
?>