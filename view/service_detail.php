<?php
require_once 'header.php';
require_once '../controller/connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
else{
    echo "incorrect slug";
}
$query = "SELECT * FROM service WHERE item_id = $id limit 1";
$result = mysqli_query($connection, $query);

if(mysqli_num_rows($result)==1){
    $row = mysqli_fetch_array($result);
}
?>
<div class="col-12 p-5" style="background-color:blanchedalmond">
    <div class="card p-5 rounded">
        <img class="img-thumbnail rounded" src="../assets/image/service/<?= $row['filename']?>"/>
        <div class="p-3 p-md-5">
            <h1>✏️<?= $row['itemName']?></h1>
            <h3>📝 <?= $row["description"];?></h3>
            <div class="row">
                <div class="col-md-10">
                    <div class="details-filter-row details-row-size">
                        <label for="qty">Qantity:</label>
                        <div class="product-details-quantity">
                            <input type="number" id="qty" class="form-control" value="1" min="1" max="<?= $row['quantity']?>" step="1" data-decimals="0" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="product-details-action">
                        <a href="#" class="btn-product btn-cart"><span>Add to cart</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= require_once 'footer.php'?>