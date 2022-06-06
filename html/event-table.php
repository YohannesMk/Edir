<?php
require_once 'admin-header.php';
require_once '../controller/connect.php';

$sql = "SELECT * From eventPost";
$result = mysqli_query($connection, $sql);

if(isset($_GET['search']))
  {
   $search = $_GET['search'];
  
    $query="SELECT * FROM eventpost where title like '%$search%' OR eventType like '%$search%' OR eventDescription like '%$search%'";
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
        <h3 class="box-title">Event Table</h3>
        <!-- <p class="text-muted">Add class <code>.table</code></p> -->
        <div class="table-responsive">
            <table class="table text-nowrap">
            <thead>
                <tr>
                <th class="border-top-0">User Id</th>
                <th class="border-top-0">Title</th>
                <th class="border-top-0">Event Type</th>
                <th class="border-top-0">Event Description</th>
                <th class="border-top-0">DOE</th>
                <th class="border-top-0">Date Updated</th>
                <th class="border-top-0">Slug</th>
                </tr>
            </thead>
            <tbody>
            
            <?php   // LOOP TILL END OF DATA 
                while($rows = mysqli_fetch_array($result))
                { 
                ?>
                <tr>
                <td><?php echo $rows['user_id']?></td>
                <td><?php echo $rows['title']?></td>
                <td><?php echo $rows['eventType']?></td>
                <td><?php echo $rows['eventDescription']?></td>
                <td><?php echo $rows['doe']?></td>
                <td><?php echo $rows['date_updated']?></td>
                <td><?php echo $rows['slug']?></td>
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