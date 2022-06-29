<?php
require_once 'header_Amh.php';
require_once '../controller/functions.php';
require_once '../controller/connect.php';
require_once '../controller/validator.php';

if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $user = $_SESSION['user_id'];
    $title= test_input($_POST ['title']);
    $eventType = test_input($_POST['eventType']);
    $description=test_input($_POST['description']);
    $doe=$_POST['doe'];
    $slug = create_slug($eventType.' '.$title);

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"]; 
 
    $folder = "../assets/image/".$filename;
 
    if (move_uploaded_file($tempname, $folder))  {
        $msg = "Image uploaded successfully";
    }
    else{
        $msg = "Failed to upload image";
  }

    $query="INSERT INTO eventpost (user_id, eventType, title, eventDescription, filename, doe, slug) VALUES('$user','$eventType','$title' ,'$description','$filename', '$doe', '$slug')";

    if(mysqli_query($connection, $query))
    {
        echo "Event Created Successfully!";
    }
    else{
        echo "Event Creation is not successful. Please enter an appropriate and non-duplicated data.";
    }
     
  }

  $sql = "SELECT * FROM eventPost WHERE user_id = '$user_id' ORDER BY date_updated DESC";
  $result = mysqli_query($connection,$sql);
?>

<main class="main">
    <div class="page-header text-center" style="background-image: url('../resources/images/edir-hero.jpg')">
        <div class="container">
            <h1 class="page-title" STYLE="color: Black">ዝግጅት ይፍጠሩ</h1>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .page-header -->


    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <!-- End .checkout-discount -->
                <div class="row mt-2">
                    <div class="col-lg-9">
                        <form method="POST" enctype="multipart/form-data">
                            <h2 class="widget-title">ዝግጅት ይፍጠሩ</h2>
                            <!-- End .checkout-title -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>ርዕስ *</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                                <!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label>የዝግጅቱ ቀን *</label>
                                    <input type="date" name="doe" class="form-control" required>
                                </div>
                                <!-- End .col-sm-6 -->
                            </div>
                            <!-- End .row -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>የክስተት አይነት *</label>
                                    <select class="form-control" name="eventType">
                                        <option selected>የክስተት አይነትን ይምረጡ</option>
                                        <option value="Graduation">ምረቃ</option>
                                        <option value="Wedding">ጋብቻ</option>
                                        <option value="Funeral">ቀብር</option>
                                        <option value="Other">ሌሎች</option>
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
                            <textarea class="form-control" name="description" cols="30" rows="4"></textarea>

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
                                <h3 class="widget-title">ስለ ክስተት</h3><!-- End .widget-title -->

                                <div class="widget-text-content">
                                    <p> እዚህ፣ በቀረበው ቅጽ ላይ ያለውን ፋይል የመጫኛ አማራጭ በመጠቀም ልጥፎችን ማከል እና የግብዣ ካርዶችን መላክ ይችላሉ።
                                      ነገር ግን፣ የግብዣ ካርድ ግዴታ ካልሆነ፣ የፍላጎትዎን ገላጭ ምስል ብቻ መስቀል ይችላሉ። </p>
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