<?php
require_once 'header.php';
require_once '../controller/connect.php';
require_once '../controller/functions.php';

if (isset($_GET['timeline_slug'])) {
    $slug = $_GET['timeline_slug'];
}
else{
    echo "incorrect slug";
}

if (isset($_GET['search'])) {
    $search = $_GET['search'];
}else {
    $search = "";
}

if (isset($_GET['category'])) {
    $category= $_GET['category'];
} else {
    $category = "";
}

$fetch_sql = "SELECT * FROM timeline where slug = '$slug' limit 1";
$fetch_result = mysqli_query($connection, $fetch_sql);

$total_pages_sql = "SELECT COUNT(*) FROM timeline";
$result = mysqli_query($connection,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];

if(mysqli_num_rows($fetch_result)==1){
    $row = mysqli_fetch_array($fetch_result);
}

$old_sql = "SELECT * FROM timeline ORDER BY date_updated DESC limit 3";
$old_data = mysqli_query($connection,$old_sql);

$fnum = query_result_count($connection, $search,'funeral');
$wnum = query_result_count($connection, $search,'wedding');
$gnum = query_result_count($connection, $search,'graduation');

//related sql
$related_cat = $row['category'];
$related_sql = "SELECT * FROM timeline where category = '$related_cat' AND slug<> '$slug' limit 3";
$related_result = mysqli_query($connection, $related_sql);
?>

<main class="main">
    <div class="page-content mt-1">
        <div class="container">
            <figure class="entry-media">
                <div class="owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl">
                    <img src="../assets/image/timeline/<?= $row['filename']?>" alt="image desc">
                </div><!-- End .owl-carousel -->
            </figure><!-- End .entry-media -->
            <div class="row">
                <div class="col-lg-9">
                    <article class="entry single-entry">
                        <div class="entry-body">
                            <div class="entry-meta">
                                <span class="entry-author">
                                by <a href="contact.php">Edir Adminstrator</a>
                                </span>
                                <span class="meta-separator">|</span>
                                <a href="#"><?= date($row['date_updated'])?></a>
                            </div><!-- End .entry-meta -->

                            <h2 class="entry-title entry-title-big">
                                <?= $row['title']?>
                            </h2><!-- End .entry-title -->

                            <div class="entry-cats">
                                in <a href="#"><?= $row['category']?></a>
                            </div><!-- End .entry-cats -->

                            <div class="entry-content editor-content">
                                <p><?= $row['content']?></p>
                            </div><!-- End .entry-content -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->

                   

                    <div class="related-posts">
                        <h3 class="title">Related Posts</h3><!-- End .title -->
                        
                        <div class="row">
                        <?php
                            while($rows = mysqli_fetch_array($related_result)){
                            ?>
                            <div class="col-lg-3">
                                <article class="entry entry-grid text-center">
                                    <figure class="entry-media">
                                        <a href="single.html">
                                            <img src="../assets/image/timeline/<?= $rows['filename']?>" alt="image desc">
                                        </a>
                                    </figure><!-- End .entry-media -->

                                    <div class="entry-body">
                                        <div class="entry-meta">
                                            <a href="#"><?= $rows['date_updated']?></a>
                                        </div><!-- End .entry-meta -->

                                        <h2 class="entry-title">
                                            <a href="single_blog.php?timeline_slug=<?= $rows['slug']?>"><?= $rows['title']?></a>
                                        </h2><!-- End .entry-title -->

                                        <div class="entry-cats">
                                            in <a href="#"><?= $rows['category']?></a>
                                        </div><!-- End .entry-cats -->
                                    </div><!-- End .entry-body -->
                                </article><!-- End .entry -->
                            </div>
                        <?php 
                        }
                        ?>
                        </div><!-- End .owl-carousel -->
                    </div><!-- End .related-posts -->
                    <div class="reply">
                        <div class="heading">
                            <h3 class="title">Leave A Reply</h3><!-- End .title -->
                            <p class="title-desc">Your email address will not be published. Required fields are marked *</p>
                        </div><!-- End .heading -->

                        <form action="#">
                            <label for="reply-message" class="sr-only">Comment</label>
                            <textarea name="reply-message" id="reply-message" cols="30" rows="4" class="form-control" required placeholder="Comment *"></textarea>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="reply-name" class="sr-only">Name</label>
                                    <input type="text" class="form-control" id="reply-name" name="reply-name" required placeholder="Name *">
                                </div><!-- End .col-md-6 -->

                                <div class="col-md-6">
                                    <label for="reply-email" class="sr-only">Email</label>
                                    <input type="email" class="form-control" id="reply-email" name="reply-email" required placeholder="Email *">
                                </div><!-- End .col-md-6 -->
                            </div><!-- End .row -->

                            <button type="submit" class="btn btn-outline-primary-2">
                                <span>POST COMMENT</span>
                                <i class="icon-long-arrow-right"></i>
                            </button>
                        </form>
                    </div><!-- End .reply -->
                </div><!-- End .col-lg-9 -->
                <aside class="col-lg-3">
                    <div class="sidebar">
                        <div class="widget widget-search">
                            <h3 class="widget-title">Search</h3><!-- End .widget-title -->

                            <form method="GET" action="timeline.php">
                                <label for="ws" class="sr-only">Search</label>
                                <input type="search" class="form-control" id="ws" name="search" placeholder="Search in Timeline" required>
                                <button type="submit" class="btn"><i class="icon-search"></i><span class="sr-only">Search</span></button>
                            </form>
                        </div><!-- End .widget -->

                        <div class="widget widget-cats">
                            <h3 class="widget-title">Categories</h3><!-- End .widget-title -->

                            <ul>
                                <li><a href="timeline.php">All<span><?= $total_rows?></span></a></li>
                                <li><a href="timeline.php?category=wedding<?php if(!empty($search)){echo '&search='.$search;}?>">Weddding<span><?= $wnum?></span></a></li>
                                <li><a href="timeline.php?category=graduation<?php if(!empty($search)){echo '&search='.$search;}?>">Graduation<span><?= $gnum?></span></a></li>
                                <li><a href="timeline.php?category=funeral<?php if(!empty($search)){echo '&search='.$search;}?>">Funeral<span><?= $fnum?></span></a></li>
                            </ul>
                        </div><!-- End .widget -->

                        <div class="widget">
                            <h3 class="widget-title">New Posts</h3><!-- End .widget-title -->

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
                                        <h4><a href="single_blog.php?timeline_slug=<?= $rows['slug']?>"><?= $rows['title']?></a></h4>
                                    </div>
                                </li>
                                <?php
                                }
                                mysqli_close($connection);
                                ?>
                            </ul><!-- End .posts-list -->
                        </div><!-- End .widget -->
                        
                        <div class="widget widget-text">
                            <h3 class="widget-title">About Timeline</h3><!-- End .widget-title -->

                            <div class="widget-text-content">
                                <p>On the Edir Timeline, Events which have occured in the Edir society will get posted by the Edir Adminstrators. Memores, both joyful and sad, are shared among the members of the Edir.</p>
                            </div><!-- End .widget-text-content -->
                        </div><!-- End .widget -->
                    </div><!-- End .sidebar -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

<?php require_once 'footer.php'?>