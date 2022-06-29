<?php
require_once 'header_Amh.php';
require_once '../controller/connect.php';
require_once '../controller/functions.php';

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
}else {
    $pageno = 1;
}


if (isset($_GET['search'])) {
    $search = $_GET['search'];
}else {
    $search = "";
}

$no_of_records_per_page = 6;
$offset = ($pageno-1) * $no_of_records_per_page;

$total_pages_sql = "SELECT COUNT(*) FROM timeline";
$result = mysqli_query($connection,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

if (isset($_GET['category'])) {
    $cat = $_GET['category'];
    $sql = "SELECT * FROM timeline where category = '$cat' ORDER BY date_updated desc LIMIT $offset, $no_of_records_per_page";

    if(isset($_GET['search'])){
        $search = $_GET['search'];

        if(!empty($search)){
            $sql = "SELECT * FROM timeline where title like '%$search%' AND category = '$cat' ORDER BY date_updated desc LIMIT $offset, $no_of_records_per_page";
        }
    }
    
    if($cat == '' || $cat == 'all'){
        $sql = "SELECT * FROM timeline ORDER BY date_updated desc LIMIT $offset, $no_of_records_per_page";
        
        if(!empty($search)){
            $sql = "SELECT * FROM timeline where title like '%$search%' ORDER BY date_updated desc LIMIT $offset, $no_of_records_per_page";
        }
    }
    
  } else {
    $cat = 'all';
    $sql = "SELECT * FROM timeline ORDER BY date_updated desc LIMIT $offset, $no_of_records_per_page";

    if(isset($_GET['search'])){
        $search = $_GET['search'];

        if(!empty($search)){
            $sql = "SELECT * FROM timeline where title like '%$search%' ORDER BY date_updated desc LIMIT $offset, $no_of_records_per_page";
        }
    }
  }

$res_data = mysqli_query($connection,$sql);

$old_sql = "SELECT * FROM timeline ORDER BY date_updated DESC limit 3";
$old_data = mysqli_query($connection, $old_sql);

$fnum = query_result_count($connection, $search, 'funeral');
$wnum = query_result_count($connection, $search, 'wedding');
$gnum = query_result_count($connection, $search, 'graduation');

?>

<div class="page-header text-center" style="background-image: url('../resources/images/ethiopia.jpg')">
    <div class="container">
        <h1 class="page-title">እድር የጊዜ መስመር<span></span></h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->


<div class="page-content mt-5">
    <div class="container">
        <div class="row">
           <div class="col-lg-9">
            <?php
                while($rows = mysqli_fetch_array($res_data)){
                ?>
                <article class="entry entry-list">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <figure class="entry-media">
                                <a href="single_blog_Amh.php?timeline_slug=<?= $rows['slug']?>">
                                    <img src="../assets/image/timeline/<?= $rows['filename'];?>" alt="image desc">
                                </a>
                            </figure><!-- End .entry-media -->
                        </div><!-- End .col-md-5 -->

                        <div class="col-md-7">
                            <div class="entry-body">
                                <div class="entry-meta">
                                    <span class="entry-author">
                                    በ <a href="contact_Amh.php">እድር አስተዳዳሪ</a>
                                    </span>
                                    <span class="meta-separator">|</span>
                                    <a href="#"><?= $rows['date_updated'];?></a>
                                </div><!-- End .entry-meta -->

                                <h2 class="entry-title">
                                    <a href="single_blog_Amh.php?timeline_slug=<?= $rows['slug']?>"><?= $rows['title'];?></a>
                                </h2><!-- End .entry-title -->

                                <div class="entry-cats">
                                     <a href="#"><?= $rows['category'];?> ውስጥ</a>
                                </div><!-- End .entry-cats -->

                                <div class="entry-content mr-4">
                                    <p><?php
                                        if(strlen($rows['content'])>200){
                                            $stringCut = substr($rows['content'], 0, 200);
                                            $endPoint = strrpos($stringCut, '.');
                                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                            echo $string;
                                        } 
                                        else{
                                            echo $rows['content'];
                                        }
                                        ?></p>
                                    <a href="single_blog_Amh.php?timeline_slug=<?= $rows['slug']?>" class="read-more">ማንበብ ይቀጥሉ</a>
                                </div><!-- End .entry-content -->
                            </div><!-- End .entry-body -->
                        </div><!-- End .col-md-7 -->
                    </div><!-- End .row -->
                </article><!-- End .entry -->
                <?php
                }
                ?>

                <nav aria-label="Page navigation">
                    <ul class="pagination">
                    <li class="page-item active">
                        <a class="page-link" href="?pageno=1&category=<?=$cat?><?php if(!empty($search)){echo "&search=".$search;} ?>#post" tabindex="-1">መጀመሪያ</a>
                    </li>
                    <li class="page-item active <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                        <a class="page-link" href="<?php if($pageno <= 1){ echo '#post'; } else { echo "?pageno=".($pageno - 1); } ?>&category=<?=$cat?><?php if(!empty($search)){echo "&search=".$search;} ?>#">ቀዳሚ</a>
                    </li>
                    <li class="page-item active <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                        <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#post'; } else { echo "?pageno=".($pageno + 1); } ?>&category=<?=$cat?><?php if(!empty($search)){echo "&search=".$search;} ?>#post">ቀጥሎ</a>
                    </li>
                    <li class="page-item active">
                    <a class="page-link" href="?pageno=<?php echo $total_pages; ?>&category=<?=$cat?><?php if(!empty($search)){echo "&search=".$search;} ?>#post">መጨረሻ</a>
                    </li>
                    </ul>
                 </nav>
            </div><!-- End .col-lg-9 -->

            <aside class="col-lg-3">
                <div class="sidebar">
                    <div class="widget widget-search">
                        <h3 class="widget-title">ፈልግ</h3><!-- End .widget-title -->

                        <form method="GET">
                            <label for="ws" class="sr-only">ፈልግ</label>
                            <input type="search" class="form-control" id="ws" name="search" placeholder="በጊዜ መስመር ውስጥ ይፈልጉ" required>
                            <button type="submit" class="btn"><i class="icon-search"></i><span class="sr-only">ፈልግ</span></button>
                        </form>
                    </div><!-- End .widget -->

                    <div class="widget widget-cats">
                        <h3 class="widget-title">ምድቦች</h3><!-- End .widget-title -->

                        <ul>
                            <li><a href="timeline_Amh.php">ሁሉም<span><?= $total_rows?></span></a></li>
                            <li><a href="?category=wedding<?php if(!empty($search)){echo '&search='.$search;}?>">ጋብቻ<span><?= $wnum?></span></a></li>
                            <li><a href="?category=graduation<?php if(!empty($search)){echo '&search='.$search;}?>">ምረቃ<span><?= $gnum?></span></a></li>
                            <li><a href="?category=funeral<?php if(!empty($search)){echo '&search='.$search;}?>">ቀብር<span><?= $fnum?></span></a></li>
                        </ul>
                    </div><!-- End .widget -->

                    <div class="widget">
                        <h3 class="widget-title">አዲስ ልጥፎች</h3><!-- End .widget-title -->

                        <ul class="posts-list">
                        <?php
                            while($rows = mysqli_fetch_array($old_data)){
                            ?>
                            <li>
                                <figure>
                                    <a href="#">
                                        <img src="../assets/image/timeline/<?= $rows['filename']?>" alt="post">
                                    </a>
                                </figure>

                                <div>
                                    <span><?= $rows['date_updated']?></span>
                                    <h4><a href="single_blog_Amh.php?timeline_slug=<?= $rows['slug']?>"><?= $rows['title']?></a></h4>
                                </div>
                            </li>
                            <?php
                            }
                            mysqli_close($connection);
                            ?>
                        </ul><!-- End .posts-list -->
                    </div><!-- End .widget -->
                    
                    <div class="widget widget-text">
                        <h3 class="widget-title">ስለ የጊዜ መስመር</h3><!-- End .widget-title -->

                        <div class="widget-text-content">
                            <p>በኢዲር የጊዜ መስመር ላይ፣ በኢዲር ማህበረሰብ ውስጥ የተከሰቱ ክስተቶች በአዲር አስተዳዳሪዎች ይለጠፋሉ። ትዝታ፣ አስደሳች እና ሀዘን፣ ከኢዲር አባላት ጋር ይጋራሉ።</p>
                        </div><!-- End .widget-text-content -->
                    </div><!-- End .widget -->
                </div><!-- End .sidebar -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .page-content -->
<?php require_once 'footer_Amh.php'?>