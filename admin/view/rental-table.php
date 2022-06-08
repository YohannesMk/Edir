<?php

$export_id = 4;
require_once '../controller/connect.php';
require_once 'admin-header.php';

$sql = "SELECT * From purchase";
$result = mysqli_query($connection,$sql);


if(isset($_GET['search']))
  {
   $search = $_GET['search'];
  
    $query="SELECT * FROM purchase where price like '%$search%'";
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
        <h3 class="box-title">Purchase Table</h3>
        <!-- <p class="text-muted">Add class <code>.table</code></p> -->
        <div class="table-responsive">
            <table class="table text-nowrap">
            <thead>
                <tr>
                <th class="border-top-0">User Id</th>
                <th class="border-top-0">Item Id</th>
                <th class="border-top-0">Price</th>
                <th class="border-top-0">Date Purchase</th>
                </tr>
            </thead>
            <tbody>
            
            <?php   // LOOP TILL END OF DATA 
                while($rows = mysqli_fetch_array($result))
                { 
                ?>
                <tr>
                <td><?php echo $rows['user_id']?></td>
                <td><?php echo $rows['item_id']?></td>
                <td><?php echo $rows['price']?></td>
                <td><?php echo $rows['date_purchase']?></td>

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
