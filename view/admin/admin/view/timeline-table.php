<?php
$export_id = 5;
require_once 'admin-header.php';
require_once '../controller/connect.php';

$sql = "SELECT * From timeline";
$result = mysqli_query($connection, $sql);

if(isset($_GET['search']))
  {
   $search = $_GET['search'];
  
    $query="SELECT * FROM timeline where title like '%$search%' OR category like '%$search%' OR content like '%$search%'";
    $result = mysqli_query($connection, $query);
    if($result)
    {
        echo "Form Inserted Succesfully!";
    }
  }
?>
<div class="container-fluid">
    <div class="row">
    <div class="col-sm-12">
    <div class="white-box">
        <h3 class="box-title">Timeline Table</h3>
        <!-- <p class="text-muted">Add class <code>.table</code></p> -->
        <div class="table-responsive">
            <table class="table text-nowrap">
            <thead>
                <tr>
                <th class="border-top-0"></th>
                <th class="border-top-0">Title</th>
                <th class="border-top-0">Category</th>
                <th class="border-top-0">Content</th>
                <th class="border-top-0">Filename</th>
                <th class="border-top-0">Slug</th>
                <th class="border-top-0">date_updated</th>
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
                        <a href="updateTimeline.php?timeline_slug=<?=$rows['slug']?>"><i class="far fa-edit"></i><span>edit</span></a>
                    </div>
                </td>
                <td><?php echo $rows['title']?></td>
                <td><?php echo $rows['category']?></td>
                <td><?php echo $rows['content']?></td>
                <td><?php echo $rows['filename']?></td>
                <td><?php echo $rows['slug']?></td>
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
    </div>
</div>
<?= require_once 'admin-footer.php'?>