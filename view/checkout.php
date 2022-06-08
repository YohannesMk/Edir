<?php
require_once '../controller/connect.php';
require_once '../controller/functions.php';
require_once 'header.php';

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

$subtotal_query = "SELECT * FROM cart where user_id = '$user_id'";
$sub_result = mysqli_query($connection, $subtotal_query);
$subtotal_price = 0;

while($cart_rows = mysqli_fetch_array($sub_result)){
    $days = 6;
    $return = relateService($connection, $cart_rows);
    $subtotal_price += (double)$return['price'] * (double)$cart_rows['quantity'] * $days;
}

$no_of_records_per_page = 6;
$offset = ($pageno-1) * $no_of_records_per_page;

$total_pages_sql = "SELECT COUNT(*) FROM Cart where user_id = '$user_id'";
$result = mysqli_query($connection, $total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

if(isset($_POST['proceed'])){
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $bankAcc = $_POST['bacc'];
    $payCode = $_POST['pcode'];

    $allCart = "SELECT * FROM cart where user_id = '$user_id'";
    $allRes = mysqli_query($connection, $allCart);

    while($cart_rows = mysqli_fetch_array($allRes)){
              
        $cart_id = $cart_rows['cart_id'];

        $item_id = $cart_rows['item_id'];
        $qty = $cart_rows['quantity'];

        $existingSql = "SELECT * from service where item_id = '$item_id'";
        $exisRes = mysqli_query($connection, $existingSql);
        $existingQty = mysqli_fetch_array($exisRes)['quantity'];
        $leftQty = $existingQty - $qty;
        
        $quantityDes = "UPDATE service set quantity ='$leftQty' where item_id = '$item_id'";
        mysqli_query($connection,$quantityDes);

        $paysql = "INSERT INTO purchase(cart_id, fName, lName, bankAcc, payCode) VALUES ('$cart_id', '$fName', '$lName','$bankAcc', '$payCode')";
        if(mysqli_query($connection, $paysql)){
            echo '<script>alert("form inserted successfully");</script>';
        }

    }

}

$sql = "SELECT * FROM Cart where user_id = '$user_id' LIMIT $offset, $no_of_records_per_page"; 
$res_data = mysqli_query($connection,$sql);

?>

<div class="page-header text-center" style="background-image: url('../resources/images/dinkuan.jpg')">
    <div class="container">
    <h1 class="page-title font-weight-bold" STYLE="color: orange">Shopping Cart Checkout</h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->

<div class="page-content">
    <div class="cart">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mt-3">
                        <form method="POST">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h2 class="widget-title">Billing Details</h2>
                                    <!-- End .checkout-title -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>First Name *</label>
                                            <input type="text" name="fName" class="form-control" required>
                                        </div>
                                        <!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Last Name *</label>
                                            <input type="text" name="lName" class="form-control" required>
                                        </div>
                                        <!-- End .col-sm-6 -->
                                    </div>
                                   
                                    <label>Bank Account No. *</label>
                                    <input type="number" name="bacc" class="form-control" required>
                                    
                                    <label>Payment Code. *</label>
                                    <input type="text" name="pcode" class="form-control" required>

			            			<button type="submit" name="proceed" class="btn btn-outline-dark-2"><span>PROCEED</span><i class="icon-long-arrow-right"></i></button>
                                </div>
                                <!-- End .col-lg-9 -->
                            </div>
                            <!-- End .row -->
                        </form>
                        </tbody>
                    </table><!-- End .table table-wishlist -->
                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-3">
                        <div class="summary summary-cart">
                            <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                            <table class="table table-summary">
                                <tbody>
                                    <tr class="summary-shipping">
                                        <td>Items:</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php $sub_result = mysqli_query($connection, $subtotal_query);
                                            updateCart($connection,$subtotal_query ,$user_id);
                                            while($crow = mysqli_fetch_array($sub_result)){?>

                                    <tr class="summary-shipping-row">
                                        <td>
                                            <div class="">
                                                    <label class="" for="standart-shipping"><?php echo relateService($connection,$crow)['itemName'];?>:</label>
                                                </div>
                                            </td>
                                        <td>$<?php
                                            $return = relateService($connection, $crow);
                                            $total_price =  (double)$return['price'] * (double)$crow['quantity'];
                                            echo $total_price;
                                        ?></td>
                                    </tr><!-- End .summary-shipping-row -->

                                    <?php }
                                        mysqli_close($connection);
                                    ?>
                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td>$<?=$subtotal_price?></td>
                                    </tr><!-- End .summary-total -->
                                </tbody>
                            </table><!-- End .table table-summary -->

                            <a href="cart.php" class="btn btn-outline-primary-2 btn-order btn-block">BACK TO CART</a>
                        </div><!-- End .summary -->

                        <a href="product.php" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                    </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .cart -->
</div><!-- End .page-content -->

<?php require_once 'footer.php'; ?>