<?php
require_once 'header_Amh.php';
require_once '../controller/functions.php';
require_once '../controller/connect.php';
require_once '../controller/validator.php';

if (isset($_GET['slug'])) {
    $slug = $_GET['slug'];
}
else{
    echo "incorrect slug";
}

$fetch_sql = "SELECT * FROM eventPost where slug = '$slug' limit 1";
$fetch_result = mysqli_query($connection, $fetch_sql);

if(mysqli_num_rows($fetch_result)==1){
    $row = mysqli_fetch_array($fetch_result);
}

if($_SERVER["REQUEST_METHOD"]=="POST")
  {

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"]; 
 
    $folder = "../assets/image/".$filename;
 
    if (move_uploaded_file($tempname, $folder))  {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
  }

    $title= test_input($_POST['title']));
    $eventType = test_input($_POST['eventType']);
    $description=test_input($_POST['description']);
    $doe=$_POST['doe'];

    $query="UPDATE eventpost SET title='$title', eventDescription='$description', filename= '$filename', doe='$doe', eventType='$eventType' where slug='$slug';";

    if (mysqli_query($connection, $query)){
        echo "Update Successful";
    }
    else {
        echo "Update Failed!";
        
    }
   
  }

  $sql = "SELECT * FROM eventPost WHERE user_id = '$user_id' ORDER BY date_updated DESC";
  $result = mysqli_query($connection,$sql);

?>

<main class="main">
    <div class="page-header text-center" style="background-image: url('../resources/images/edir-hero.jpg')">
        <div class="container">
            <h1 class="page-title">ዝግጅት ይፍጠሩ</h1>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .page-header -->


    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <!-- End .checkout-discount -->
                <div class="row mt-2">
                    <div class="col-lg-8">
                        <form method="POST" enctype="multipart/form-data">
                            <h2 class="widget-title">ዝግጅት ይፍጠሩ</h2>
                            <!-- End .checkout-title -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>ርዕስ *</label>
                                    <input type="text" name="title" value="<?=$row['title']?>" class="form-control" required>
                                </div>
                                <!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label>የዝግጅቱ ቀን *</label>
                                    <input type="date" name="doe" value="<?=$row['doe']?>" class="form-control" required>
                                </div>
                                <!-- End .col-sm-6 -->
                            </div>
                            <!-- End .row -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>የክስተት አይነት *</label>
                                    <select class="form-control" name="eventType">
                                        <option value="Graduation" <?php if($row['eventType']=="Graduation"){echo 'selected';}?>>ምረቃ</option>
                                        <option value="Wedding"    <?php if($row['eventType']=="Wedding"){echo 'selected';}?>>ጋብቻ</option>
                                        <option value="Funeral"    <?php if($row['eventType']=="Funeral"){echo 'selected';}?>>ቀብር</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>ምስል *</label>
                                    <input type="file" accept="image/*" name="uploadfile" class="form-control" required>
                                </div>
                            </div>
                            
                            <label>መግለጫ (አማራጭ)</label>
                            <textarea class="form-control" name="description" cols="30" rows="4"><?=$row['eventDescription']?></textarea>

                            <button type="submit" name="submit" class="btn btn-outline-primary-2 btn-block">
                            ክስተት ይለጥፉ
                            </button>
                        </form>
                    </div>
                        <!-- End .col-lg-9 -->
                        
                    <aside class="col-lg-3">
                        <div class="sidebar">
                            <div class="widget">
                                <h3 class="widget-title">የእርስዎ ልጥፎች</h3><!-- End .widget-title -->

                                <ul class="posts-list">
                                <?php
                                    while($rows = mysqli_fetch_array($result)){
                                    ?>
                                    <li>
                                        <figure>
                                            <a href="#">
                                                <img src="../assets/image/<?= $rows['filename']?>" alt="post">
                                            </a>
                                        </figure>

                                        <div>
                                            <span><?= $rows['date_updated']?></span>
                                            <h4><a href="editEvent_Amh.php?slug=<?= $rows['slug']?>"><?= $rows['title']?></a></h4>
                                        </div>
                                    </li>
                                    <?php
                                    }
                                    mysqli_close($connection);
                                    ?>
                                </ul><!-- End .posts-list -->
                            </div><!-- End .widget -->
                            
                            <div class="widget widget-text">
                                <h3 class="widget-title">ክስተት መለወጥ</h3><!-- End .widget-title -->

                                <div class="widget-text-content">
                                    <p>እዚህ፣ በቀረበው ቅጽ ላይ ያለውን ፋይል የመጫኛ አማራጭ በመጠቀም ልጥፎችን እና የግብዣ ካርዶችን ማርትዕ ይችላሉ።
                                      ነገር ግን፣ የግብዣ ካርድ ግዴታ ካልሆነ፣ የፍላጎትዎን ገላጭ ምስል ብቻ መስቀል ይችላሉ።</p>
                                </div><!-- End .widget-text-content -->
                            </div><!-- End .widget -->
                        </div><!-- End .sidebar -->
                    </aside><!-- End .col-lg-3 -->

                </div>
            </div>
            <!-- End .container -->
        </div>
        <!-- End .checkout -->
    </div>
    <!-- End .page-content -->
</main>
<!-- End .main -->