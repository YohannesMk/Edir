<?php 
require_once '../controller/connect.php';
require_once 'admin-header.php';

if(isset($_GET['item_id'])){
    $item_id = $_GET['item_id'];

    $fetch_sql = "SELECT * FROM service where item_id = '$item_id' limit 1";
    $fetch_result = mysqli_query($connection, $fetch_sql);
    if(mysqli_num_rows($fetch_result)==1){
        $rows = mysqli_fetch_array($fetch_result);
}
}
else{
    echo '<div class="error">incorrect item_id!</div>';
}


if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $itemName = $_POST ['item-name'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $description = $_POST['description'];

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"]; 
 
    $folder = "../assets/image/service/".$filename;
 
    if (move_uploaded_file($tempname, $folder)){
        $msg = "Image uploaded successfully";
    }
    else{
        $msg = "Failed to upload image";
    }

    $query="UPDATE service SET itemName = '$itemName', description = '$description', price = '$price', quantity = '$qty', filename = '$filename' where item_id = '$item_id'";

    if(mysqli_query($connection, $query))
    {
        echo "Form Inserted Succesfully!";
    }
     
      mysqli_close($connection);
  }
?>
<div class="col-12 p-3">
<div class="card p-3 p-md-5">
<h3>Update Product</h3>
<form action="" method="post" enctype="multipart/form-data">
<div class="row">
    <div class="col-md-6">
        <label for="title">Item Name:</label>
        <input class="form-control mb-1" type="text" value="<?=$rows['itemName'];?>" name="item-name" id="title" required>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
            <div class="details-filter-row details-row-size">
                <label for="price">Price:</label>
                <div class="product-details-quantity">
                    <input type="number" name="price" id="price" class="form-control" value="<?=$rows['price'];?>" step="1" data-decimals="0" required>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-1">
        <div class="col-md-2">
            <div class="details-filter-row details-row-size">
                <label for="qty">Qty:</label>
                <div class="product-details-quantity">
                    <input type="number" id="qty" name="qty" class="form-control" value="<?=$rows['quantity'];?>" min="1" step="1" data-decimals="0" required>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <label for="cover">image:</label>
            <input class="form-control mb-1" type="file" name="uploadfile" id="cover">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="content">Description:</label>
            <textarea class="form-control mb-1" rows="5" type="text" name="description" id="content"><?=$rows['description'];?></textarea>
        </div>
    </div>
    <div class="p-1 text-end"><button class="float-end btn btn-dark col-12 col-md-4 btn-lg" type="submit" name="submit">Publish Post</button></div>
</form>
</div></div>


