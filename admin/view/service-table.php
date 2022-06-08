<?php
$export_id = 3;
require_once '../controller/connect.php';
require_once 'admin-header.php';

$sql = "SELECT * From service";
$result = mysqli_query($connection,$sql);

if(isset($_GET['search']))
  {
   $search = $_GET['search'];
  
    $query="SELECT * FROM service where itemName like '%$search%' OR description like '%search%'";
    $result = mysqli_query($connection, $query);
     
  }
?>
<div class="container-fluid">
    <div class="row">
    <div class="col-sm-12">
        <div class="white-box">
        <h3 class="box-title">Service Table</h3>
        <div class="table-responsive">
            <table class="table text-nowrap">
            <thead>
                <tr>
                <th></th>
                <th class="border-top-0">Item Id</th>
                <th class="border-top-0">Item Name</th>
                <th class="border-top-0">Description</th>
                <th class="border-top-0">Quantity</th>
                <th class="border-top-0">Price</th>
                <th class="border-top-0">Date Updated</th>
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
                        <a href="editProduct.php?item_id=<?=$rows['item_id']?> "><i class="far fa-edit"></i><span>edit</span></a>
                    </div>
                </td>
                <td><?php echo $rows['item_id']?></td>
                <td><?php echo $rows['itemName']?></td>
                <td><?php echo $rows['description']?></td>
                <td><?php echo $rows['quantity']?></td>
                <td><?php echo $rows['price']?></td>
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
